<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\Subject;
use App\Support\AcademicSession;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LecturerAssessmentSchemeController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = $this->coordinatorOrAbort();
        $subjectIds = $lecturer->coordinatorSubjects()->pluck('subject_id');

        $search = trim($request->input('search', ''));
        $status = $request->input('status', '');

        $schemes = AssessmentScheme::query()
            ->whereIn('subject_id', $subjectIds)
            ->with(['subject', 'assessments'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->whereHas('subject', function ($subjectQuery) use ($search) {
                        $subjectQuery->where('subject_code', 'like', "%{$search}%")
                            ->orWhere('subject_name', 'like', "%{$search}%");
                    })->orWhere('academic_session', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['draft', 'active', 'archived'], true),
                fn ($query) => $query->where('status', $status))
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        $subjects = Subject::query()
            ->whereIn('subject_id', $subjectIds)
            ->where('status', 'active')
            ->orderBy('subject_code')
            ->get(['subject_id', 'subject_code', 'subject_name']);

        return view('lecturer.assessment-schemes.index', compact(
            'schemes', 'subjects', 'search', 'status'
        ));
    }

    public function store(Request $request)
    {
        $lecturer = $this->coordinatorOrAbort();
        $validated = $this->validateScheme($request);
        $subject = $lecturer->coordinatorSubjects()
            ->where('subject_id', $validated['subject_id'])
            ->firstOrFail();

        if (strtolower((string) $subject->status) !== 'active') {
            throw ValidationException::withMessages([
                'subject_id' => 'Only active subjects can have an assessment scheme.',
            ]);
        }

        $exists = AssessmentScheme::where('subject_id', $subject->subject_id)
            ->where('academic_session', trim($validated['academic_session']))
            ->whereIn('status', ['draft', 'active'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'academic_session' => 'A scheme already exists for this subject and academic session. Open the existing scheme instead.',
            ]);
        }

        DB::transaction(function () use ($validated, $subject) {
            $scheme = AssessmentScheme::create([
                'subject_id' => $subject->subject_id,
                'academic_session' => trim($validated['academic_session']),
                'status' => 'draft',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($validated['assessments'] as $index => $assessmentData) {
                $scheme->assessments()->create([
                    'assessment_name' => trim($assessmentData['assessment_name']),
                    'assessment_type' => $assessmentData['assessment_type'],
                    'max_marks' => $assessmentData['max_marks'],
                    'weight_percentage' => $assessmentData['weight_percentage'],
                    'sort_order' => $index + 1,
                    'description' => $assessmentData['description'] ?? null,
                ]);
            }
        });

        return redirect()->route('lecturer.assessment-schemes.index')
            ->with('success', 'Assessment scheme created as Draft. Review the total weight before activating it.');
    }

    public function show(string $schemeId)
    {
        $lecturer = $this->coordinatorOrAbort();
        $scheme = AssessmentScheme::with(['subject', 'assessments.marks'])
            ->whereHas('subject', fn ($query) => $query->where(
                'coordinator_lecturer_id',
                $lecturer->lecturer_id
            ))
            ->findOrFail($schemeId);

        return view('lecturer.assessment-schemes.show', compact('scheme'));
    }

    public function update(Request $request, string $schemeId)
    {
        $lecturer = $this->coordinatorOrAbort();
        $scheme = AssessmentScheme::with('assessments')
            ->whereHas('subject', fn ($query) => $query->where(
                'coordinator_lecturer_id',
                $lecturer->lecturer_id
            ))
            ->findOrFail($schemeId);

        if ($scheme->status !== 'draft') {
            return back()->with('error', 'Only Draft schemes can be edited. Active or archived schemes are locked.');
        }

        $validated = $this->validateScheme($request, $scheme->academic_session);

        if ((int) $validated['subject_id'] !== (int) $scheme->subject_id
            || trim($validated['academic_session']) !== $scheme->academic_session) {
            $duplicate = AssessmentScheme::where('subject_id', $validated['subject_id'])
                ->where('academic_session', trim($validated['academic_session']))
                ->whereIn('status', ['draft', 'active'])
                ->where('scheme_id', '!=', $scheme->scheme_id)
                ->exists();

            if ($duplicate) {
                throw ValidationException::withMessages([
                    'academic_session' => 'A scheme already exists for this subject and academic session.',
                ]);
            }
        }

        $subject = $lecturer->coordinatorSubjects()
            ->where('subject_id', $validated['subject_id'])
            ->firstOrFail();
        if (strtolower((string) $subject->status) !== 'active') {
            throw ValidationException::withMessages([
                'subject_id' => 'Only active subjects can have an assessment scheme.',
            ]);
        }

        DB::transaction(function () use ($scheme, $validated, $subject) {
            $scheme->update([
                'subject_id' => $subject->subject_id,
                'academic_session' => trim($validated['academic_session']),
                'notes' => $validated['notes'] ?? null,
            ]);

            // Draft schemes have no assessment marks, so replacing their component list is safe.
            $scheme->assessments()->delete();

            foreach ($validated['assessments'] as $index => $assessmentData) {
                $scheme->assessments()->create([
                    'assessment_name' => trim($assessmentData['assessment_name']),
                    'assessment_type' => $assessmentData['assessment_type'],
                    'max_marks' => $assessmentData['max_marks'],
                    'weight_percentage' => $assessmentData['weight_percentage'],
                    'sort_order' => $index + 1,
                    'description' => $assessmentData['description'] ?? null,
                ]);
            }
        });

        return redirect()->route('lecturer.assessment-schemes.show', $scheme->scheme_id)
            ->with('success', 'Draft assessment scheme updated successfully.');
    }

    public function activate(string $schemeId)
    {
        $lecturer = $this->coordinatorOrAbort();
        $scheme = AssessmentScheme::with('assessments')
            ->whereHas('subject', fn ($query) => $query->where(
                'coordinator_lecturer_id',
                $lecturer->lecturer_id
            ))
            ->findOrFail($schemeId);

        if ($scheme->status !== 'draft') {
            return back()->with('error', 'Only Draft schemes can be activated.');
        }

        if ($scheme->assessments->isEmpty()) {
            return back()->with('error', 'Add at least one assessment before activation.');
        }

        $hasPa = $scheme->assessments->contains(
            fn ($assessment) => strtoupper((string) $assessment->assessment_type) === 'PA'
        );

        if (!$hasPa) {
            return back()->with(
                'error',
                'At least one PA assessment component is required before activation.'
            );
        }

        $totalWeight = round((float) $scheme->assessments->sum('weight_percentage'), 2);
        if ($totalWeight !== 100.0) {
            return back()->with('error', 'The total assessment weight must equal exactly 100%. Current total: ' . number_format($totalWeight, 2) . '%.');
        }

        $activeSchemeExists = AssessmentScheme::where('subject_id', $scheme->subject_id)
            ->where('academic_session', $scheme->academic_session)
            ->where('status', 'active')
            ->where('scheme_id', '!=', $scheme->scheme_id)
            ->exists();

        if ($activeSchemeExists) {
            return back()->with(
                'error',
                'An active assessment scheme already exists for this subject and academic session.'
            );
        }

        $scheme->update(['status' => 'active']);

        return redirect()->route('lecturer.assessment-schemes.show', $scheme->scheme_id)
            ->with('success', 'Assessment scheme activated. Its assessment components are now locked.');
    }

    public function archive(string $schemeId)
    {
        $lecturer = $this->coordinatorOrAbort();
        $scheme = AssessmentScheme::whereHas('subject', fn ($query) => $query->where(
                'coordinator_lecturer_id',
                $lecturer->lecturer_id
            ))
            ->findOrFail($schemeId);

        if ($scheme->status !== 'active') {
            return back()->with('error', 'Only Active schemes can be archived.');
        }

        // Archiving is a status change only; assessment records and marks are retained.
        $scheme->update(['status' => 'archived']);

        return redirect()->route('lecturer.assessment-schemes.show', $scheme->scheme_id)
            ->with('success', 'Assessment scheme archived. Existing assessment records were retained.');
    }

    private function coordinatorOrAbort(): Lecturer
    {
        $lecturer = auth()->user()?->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        // Only lecturers assigned as Subject Coordinator can manage schemes.
        if (!$lecturer->coordinatorSubjects()->exists()) {
            abort(403, 'Access denied. You are not assigned as a Subject Coordinator.');
        }

        return $lecturer;
    }

    private function validateScheme(Request $request, ?string $existingSession = null): array
    {
        $request->merge([
            'academic_session' => trim((string) $request->input('academic_session', '')),
            'notes' => trim((string) $request->input('notes', '')),
        ]);

        return $request->validate([
            'subject_id' => ['required', 'integer', 'exists:subjects,subject_id'],
            'academic_session' => AcademicSession::rules($existingSession),
            'notes' => ['nullable', 'string', 'max:500'],
            'assessments' => ['required', 'array', 'min:1', 'max:20'],
            'assessments.*.assessment_name' => ['required', 'string', 'max:100'],
            'assessments.*.assessment_type' => ['required', 'in:PB,PA'],
            'assessments.*.max_marks' => ['required', 'numeric', 'gt:0', 'max:99999.99'],
            'assessments.*.weight_percentage' => ['required', 'numeric', 'gt:0', 'lte:100'],
            'assessments.*.description' => ['nullable', 'string', 'max:5000'],
        ]);
    }
}
