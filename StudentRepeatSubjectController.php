<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ProgrammeStructureSubject;
use App\Models\RepeatSubjectApplication;
use App\Services\RepeatSubjectEligibilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StudentRepeatSubjectController extends Controller
{
    public function __construct(
        private readonly RepeatSubjectEligibilityService $eligibility
    ) {
    }

    public function index()
    {
        $student = auth()->user()->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if (!$student->structure_id) {
            return view('student.repeat-subjects', [
                'student' => $student,
                'candidates' => collect(),
                'pageMessage' => 'Programme structure anda belum ditetapkan. Sila hubungi pihak pentadbiran akademik.',
            ]);
        }

        $mappedSubjects = ProgrammeStructureSubject::with('subject')
            ->where('structure_id', $student->structure_id)
            ->whereBetween('semester', [1, 6])
            ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
            ->orderBy('semester')
            ->get();

        $candidates = collect();

        foreach ($mappedSubjects as $mapping) {
            if (!$mapping->subject) {
                continue;
            }

            $decision = $this->eligibility->evaluate(
                $student,
                (int) $mapping->subject_id,
                (int) $mapping->semester
            );

            if (!$decision['eligible']) {
                continue;
            }

            $repeatClasses = ClassModel::with('lecturerDirectory')
                ->where('class_type', 'repeat')
                ->where('structure_id', $student->structure_id)
                ->where('subject_id', $mapping->subject_id)
                ->where('semester', $mapping->semester)
                ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
                ->orderBy('academic_session')
                ->orderBy('class_id')
                ->get();

            $existingApplication = RepeatSubjectApplication::query()
                ->where('student_id', $student->student_id)
                ->where('subject_id', $mapping->subject_id)
                ->whereIn('application_status', ['pending', 'approved'])
                ->latest('repeat_application_id')
                ->first();

            $candidates->push((object) [
                'mapping' => $mapping,
                'subject' => $mapping->subject,
                'decision' => $decision,
                'classes' => $repeatClasses,
                'existing_application' => $existingApplication,
            ]);
        }

        return view('student.repeat-subjects', [
            'student' => $student,
            'candidates' => $candidates,
            'pageMessage' => null,
        ]);
    }

    public function store(Request $request)
    {
        $student = auth()->user()->student;

        if (!$student || !$student->structure_id) {
            abort(403, 'Student profile or programme structure not found.');
        }

        $validated = $request->validate([
            'class_id' => ['required', 'integer', 'exists:classes,class_id'],
        ]);

        $class = ClassModel::with('subject')
            ->where('class_id', $validated['class_id'])
            ->where('class_type', 'repeat')
            ->where('structure_id', $student->structure_id)
            ->firstOrFail();

        // Revalidate subject status on submission; the page listing alone
        // must not be the only protection against inactive subjects.
        if (!$class->subject || $class->subject->status !== 'active') {
            throw ValidationException::withMessages([
                'class_id' => 'Subjek ini tidak aktif dan tidak boleh dimohon untuk repeat.',
            ]);
        }

        $mapping = ProgrammeStructureSubject::query()
            ->where('structure_id', $student->structure_id)
            ->where('subject_id', $class->subject_id)
            ->where('semester', $class->semester)
            ->first();

        if (!$mapping) {
            throw ValidationException::withMessages([
                'class_id' => 'Subjek ini bukan sebahagian daripada programme structure anda.',
            ]);
        }
             
        DB::transaction(function () use ($student, $class) {

            // Lock the student record to prevent simultaneous duplicate submissions.
            DB::table('students')
                ->where('student_id', $student->student_id)
                ->lockForUpdate()
                ->first();

            // Recheck eligibility during submission.
            $decision = $this->eligibility->evaluate(
                $student,
                (int) $class->subject_id,
                (int) $class->semester
            );

            if (!$decision['eligible']) {
                throw ValidationException::withMessages([
                    'class_id' => $decision['message'],
                ]);
            }

            // Check for existing pending or approved applications.
            $existing = RepeatSubjectApplication::query()
                ->where('student_id', $student->student_id)
                ->where('subject_id', $class->subject_id)
                ->whereIn('application_status', ['pending', 'approved'])
                ->exists();

            if ($existing) {
                throw ValidationException::withMessages([
                    'class_id' => 'Anda sudah mempunyai permohonan pending atau pendaftaran repeat yang diluluskan untuk subjek ini.',
                ]);
            }

            RepeatSubjectApplication::create([
                'student_id' => $student->student_id,
                'subject_id' => $class->subject_id,
                'class_id' => $class->class_id,
                'structure_id' => $student->structure_id,
                'student_current_semester' => (int) $student->semester,
                'subject_semester' => (int) $class->semester,
                'academic_session' => (string) $class->academic_session,
                'eligibility_basis' => $decision['basis'],
                'eligibility_grade' => $decision['grade'],
                'pb_percentage' => $decision['pb_percentage'],
                'application_status' => 'pending',
                'submitted_at' => now(),
            ]);
        });

        return redirect()
            ->route('student.repeat-subjects')
            ->with('success', 'Permohonan repeat subject berjaya dihantar dan sedang menunggu semakan UPP.');
    }
}
