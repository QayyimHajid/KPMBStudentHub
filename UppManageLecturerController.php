<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lecturer;
use App\Models\LecturerDirectory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UppManageLecturerController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
        ]);

        $search = trim($validated['search'] ?? '');
        $department = $validated['department'] ?? '';

        $lecturers = Lecturer::with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('lecturer_id', 'like', "%{$search}%")
                        ->orWhere('lecturer_name', 'like', "%{$search}%");
                });
            })
            ->when($department !== '', fn ($query) => $query->where('department', $department))
            ->orderBy('lecturer_id')
            ->paginate(10)
            ->withQueryString();

        $this->attachDirectoryPhotos($lecturers);

        $departments = $this->departmentOptions();

        return view(
            'upp.lecturer',
            compact('lecturers', 'search', 'department', 'departments')
        );
    }

    public function store(Request $request)
    {
        $request->merge([
            'lecturer_id' => strtoupper(
                trim($request->input('lecturer_id', ''))
            ),
            'lecturer_name' => trim(
                $request->input('lecturer_name', '')
            ),
            'department' => trim(
                $request->input('department', '')
            ),
            'email' => strtolower(
                trim($request->input('email', ''))
            ),
            'phone_number' => trim(
                $request->input('phone_number', '')
            ),
        ]);

        $validated = $request->validate([
            'lecturer_id' => [
                'required',
                'string',
                'max:20',
                Rule::unique('lecturers', 'lecturer_id'),
                Rule::unique('users', 'username'),
            ],
            'lecturer_name' => [
                'required',
                'string',
                'max:100',
            ],
            'department' => [
                'required',
                'string',
                Rule::in($this->departmentOptions()->all()),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('lecturers', 'email'),
                Rule::unique('users', 'email'),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        $temporaryPassword = Str::random(16);

        DB::transaction(function () use (
            $validated,
            $temporaryPassword
        ) {
            $user = User::create([
                'username' => $validated['lecturer_id'],
                'name' => $validated['lecturer_name'],
                'email' => $validated['email'],
                'password' => $temporaryPassword,
                'role' => 'lecturer',
                'status' => 'active',
            ]);

            Lecturer::create([
                'lecturer_id' => $validated['lecturer_id'],
                'user_id' => $user->id,
                'lecturer_name' => $validated['lecturer_name'],
                'department' => $validated['department'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?: null,
            ]);
        });

        return redirect()
            ->route('upp.lecturers.index')
            ->with('success', 'Lecturer record and login account created successfully.')
            ->with('temporary_password', $temporaryPassword)
            ->with('temporary_username', $validated['lecturer_id']);
    }

    public function edit(string $lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);
        $this->attachDirectoryPhotos(collect([$lecturer]));

        $departments = $this->departmentOptions();

        // Keep a legacy department selectable if it no longer exists in the directory.
        if ($lecturer->department && !$departments->contains($lecturer->department)) {
            $departments->push($lecturer->department);
            $departments = $departments->sort()->values();
        }

        return view('upp.lecturer-edit', compact('lecturer', 'departments'));
    }

    public function update(Request $request, string $lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);

        $request->merge([
            'lecturer_name' => trim(
                $request->input('lecturer_name', '')
            ),
            'department' => trim(
                $request->input('department', '')
            ),
            'email' => strtolower(
                trim($request->input('email', ''))
            ),
            'phone_number' => trim(
                $request->input('phone_number', '')
            ),
        ]);

        $validated = $request->validate([
            'lecturer_name' => [
                'required',
                'string',
                'max:100',
            ],
            'department' => [
                'required',
                'string',
                Rule::in(array_values(array_unique(array_merge(
                    $this->departmentOptions()->all(),
                    [$lecturer->department]
                )))),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('lecturers', 'email')
                    ->ignore($lecturer->lecturer_id, 'lecturer_id'),
                Rule::unique('users', 'email')
                    ->ignore($lecturer->user_id, 'id'),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        DB::transaction(function () use ($lecturer, $validated) {
            $lecturer->update([
                'lecturer_name' => $validated['lecturer_name'],
                'department' => $validated['department'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?: null,
            ]);

            if ($lecturer->user) {
                $lecturer->user->update([
                    'name' => $validated['lecturer_name'],
                    'email' => $validated['email'],
                ]);
            }
        });

        return redirect()
            ->route('upp.lecturers.index')
            ->with('success', 'Lecturer record and account updated successfully.');
    }

    public function destroy(string $lecturerId)
    {
        $result = DB::transaction(function () use ($lecturerId) {
            $lecturer = Lecturer::where('lecturer_id', $lecturerId)
                ->lockForUpdate()
                ->firstOrFail();

            // Prevent deletion if related academic records exist.
            if (
                $lecturer->classes()->exists()
                || $lecturer->studentMarks()->exists()
                || $lecturer->mentorAssignments()->exists()
            ) {
                return 'related_records';
            }

            // Delete the linked login account, if one exists.
            $user = $lecturer->user;

            if ($user) {
                $user->delete();
            }

            // Delete the lecturer record.
            $lecturer->delete();

            return 'deleted';
        });

        if ($result === 'related_records') {
            return redirect()
                ->route('upp.lecturers.index')
                ->with(
                    'error',
                    'This lecturer cannot be deleted because related academic records still exist.'
                );
        }

        return redirect()
            ->route('upp.lecturers.index')
            ->with(
                'success',
                'Lecturer record and linked login account deleted successfully.'
            );
    }



    /**
     * Get the distinct department names maintained in Lecturer Directory.
     */
    private function departmentOptions()
    {
        return LecturerDirectory::query()
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');
    }

    /**
     * Attach a lecturer directory photo URL when exactly one directory
     * record matches the lecturer's normalized name.
     *
     * The initials/person-icon fallback remains in the Blade views when
     * no unique match or no stored photo is available.
     */
    private function attachDirectoryPhotos($lecturers): void
    {
        $directoryRecords = LecturerDirectory::query()
            ->get(['id', 'lecturer_name', 'photo_path']);

        foreach ($lecturers as $lecturer) {
            $lecturerName = $this->normalizeLecturerName(
                $lecturer->lecturer_name
            );

            $matches = $directoryRecords->filter(function ($directory) use ($lecturerName) {
                return $this->normalizeLecturerName(
                    $directory->lecturer_name
                ) === $lecturerName;
            });

            $lecturer->setAttribute('directory_photo_url', null);

            if ($matches->count() !== 1) {
                continue;
            }

            $photoPath = trim((string) $matches->first()->photo_path, '/');

            if ($photoPath === '') {
                continue;
            }

            // lecturer_directory.photo_path stores paths such as
            // "DSC/azeyrah_ramli.png", while the actual files are stored
            // under storage/app/public/lecturers/{department}/.
            if (!Str::startsWith($photoPath, 'lecturers/')) {
                $photoPath = 'lecturers/' . $photoPath;
            }

            if (!Storage::disk('public')->exists($photoPath)) {
                continue;
            }

            $lecturer->setAttribute(
                'directory_photo_url',
                Storage::disk('public')->url($photoPath)
            );
        }
    }

    /**
     * Normalize common Malay name variants to support directory matching.
     */
    private function normalizeLecturerName(?string $name): string
    {
        $name = Str::lower(trim((string) $name));
        $name = preg_replace('/\bbinti\b/u', 'bt', $name);
        $name = preg_replace('/\bbin\b/u', 'b', $name);
        $name = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $name);
        $name = preg_replace('/\s+/u', ' ', $name);

        return trim($name);
    }

}
