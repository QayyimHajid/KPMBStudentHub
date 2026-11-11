<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LecturerSubjectRegistrationController;
use App\Http\Controllers\CampusFacilityController;
use App\Http\Controllers\CampusMapController;
use App\Http\Controllers\LecturerDirectoryController;
use App\Http\Controllers\StudentAnnouncementEventController;
use App\Http\Controllers\StudentTimetableController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UppManageStudentController;
use App\Http\Controllers\UppManageLecturerController;
use App\Http\Controllers\UppManageSubjectController;
use App\Http\Controllers\UppSubjectRegistrationController;
use App\Http\Controllers\UppRepeatSubjectApplicationController;
use App\Http\Controllers\UppAlternativeSubjectController;
use App\Http\Controllers\UppRegistrationReportController;
use App\Http\Controllers\UppResultReportController;
use App\Http\Controllers\UppAssessmentSchemeController;
use App\Http\Controllers\UppManageClassGroupController;
use App\Http\Controllers\UppManageSubjectClassController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LecturerStudentRecordController;
use App\Http\Controllers\LecturerRecordStudentMarksController;
use App\Http\Controllers\LecturerClassPerformanceReportController;
use App\Http\Controllers\LecturerAssessmentSchemeController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::get('/signup', [SignUpController::class, 'show'])->name('signup');
    
    Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/change-password', [
        ChangePasswordController::class,
        'show'
    ])->name('password.edit');

    Route::put('/change-password', [
        ChangePasswordController::class,
        'update'
    ])->name('password.update');
});

Route::get('/facilities', [CampusFacilityController::class, 'index'])
    ->name('facilities.index');

Route::get('/campus-map', [CampusMapController::class, 'index'])
    ->name('campus-map.index');    

Route::get('/lecturers', [LecturerDirectoryController::class, 'index'])
    ->name('lecturers.index');

// Student Dashboard & Profile
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', function () {
        $student = auth()->user()->student;

        // Semester registration is for the next semester, based on the existing registration workflow.
        $upcomingSemester = $student ? ((int) $student->semester + 1) : 0;
        $registrations = $student
            ? $student->subjectRegistrations()
                ->with(['subject', 'classModel.lecturerDirectory', 'classModel.lecturer',])
                ->where('semester', $upcomingSemester)
                ->get()
            : collect();

        // Approved subjects for the student's current semester.
        // This is separate from next-semester registration statistics above.
        $currentSemesterRegistrations = $student
            ? $student->subjectRegistrations()
                ->with(['subject', 'classModel.lecturer', 'classModel.lecturerDirectory'])
                ->where('semester', (int) $student->semester)
                ->where('registration_status', 'approved')
                ->orderBy('subject_id')
                ->get()
            : collect();

        $upcomingRegistrationCount = $registrations->count();
        $approvedRegistrations = $registrations->where('registration_status', 'approved')->count();
        $pendingRegistrations = $registrations->where('registration_status', 'pending')->count();
        $rejectedRegistrations = $registrations->where('registration_status', 'rejected')->count();

        if ($upcomingRegistrationCount === 0) {
            $registrationApplicationStatus = 'Belum dihantar';
        } elseif ($pendingRegistrations === $upcomingRegistrationCount) {
            $registrationApplicationStatus = 'Menunggu kelulusan';
        } elseif ($approvedRegistrations === $upcomingRegistrationCount) {
            $registrationApplicationStatus = 'Diluluskan';
        } elseif ($rejectedRegistrations === $upcomingRegistrationCount) {
            $registrationApplicationStatus = 'Ditolak';
        } else {
            $registrationApplicationStatus = 'Dalam semakan';
        }

        $registeredCreditHours = $registrations
            ->where('registration_status', 'approved')
            ->sum(fn ($registration) => (float) ($registration->subject?->credit_hour ?? 0));

        // Today's schedule uses the same class-group timetable records as the weekly timetable page.
        // Use Malaysia local time consistently so the displayed day matches the timetable.
        $today = \Illuminate\Support\Carbon::now('Asia/Kuala_Lumpur');
        $todayDayName = [
            1 => 'Isnin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Khamis',
            5 => 'Jumaat',
            6 => 'Sabtu',
            7 => 'Ahad',
        ][$today->dayOfWeekIso];

        $studentGroup = $student?->group_id
            ? \App\Models\ClassGroup::query()
                ->with(['classes.subject', 'classes.lecturer', 'classes.classTimetables'])
                ->where('group_id', $student->group_id)
                ->first()
            : null;

        $todayClasses = collect();
        $hasAnyTimetable = false;

        if ($studentGroup) {
            $allSchedules = $studentGroup->classes->flatMap(function ($class) {
                return $class->classTimetables->map(function ($schedule) use ($class) {
                    return (object) [
                        'day' => $schedule->day,
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'venue' => $schedule->venue,
                        'class_name' => $class->class_name,
                        'subject_name' => $class->subject?->subject_name ?? $class->subject?->subject_code ?? 'Subjek',
                        'lecturer_name' => $class->lecturer?->lecturer_name ?? null,
                    ];
                });
            });

            $hasAnyTimetable = $allSchedules->isNotEmpty();

            $dayAliases = [
                1 => ['monday', 'isnin'],
                2 => ['tuesday', 'selasa'],
                3 => ['wednesday', 'rabu'],
                4 => ['thursday', 'khamis'],
                5 => ['friday', 'jumaat'],
                6 => ['saturday', 'sabtu'],
                7 => ['sunday', 'ahad'],
            ];

            $todayClasses = $allSchedules
                ->filter(fn ($schedule) => in_array(
                    mb_strtolower(trim((string) $schedule->day)),
                    $dayAliases[$today->dayOfWeekIso],
                    true
                ))
                ->map(function ($schedule) use ($today) {
                    // Time columns may be cast to Carbon objects with a default date;
                    // combine their clock time with today's date for correct status checks.
                    $startClock = $schedule->start_time instanceof \DateTimeInterface
                        ? $schedule->start_time->format('H:i:s')
                        : (string) $schedule->start_time;
                    $endClock = $schedule->end_time instanceof \DateTimeInterface
                        ? $schedule->end_time->format('H:i:s')
                        : (string) $schedule->end_time;

                    $startTime = $today->copy()->setTimeFromTimeString($startClock);
                    $endTime = $today->copy()->setTimeFromTimeString($endClock);

                    $status = $today->lt($startTime)
                        ? 'Akan datang'
                        : ($today->lt($endTime) ? 'Sedang berlangsung' : 'Selesai');

                    $schedule->start_display = $startTime->format('H:i');
                    $schedule->end_display = $endTime->format('H:i');
                    $schedule->status = $status;

                    return $schedule;
                })
                ->sortBy('start_display')
                ->values();
        }

        // Active academic mentor linked to this student; directory data is the preferred display source.
        $mentor = null;
        if ($student) {
            $mentor = \Illuminate\Support\Facades\DB::table('student_mentor_assignments as sma')
                ->leftJoin('lecturer_directory as ld', 'ld.id', '=', 'sma.lecturer_directory_id')
                ->leftJoin('lecturers as l', 'l.lecturer_id', '=', 'sma.lecturer_id')
                ->where('sma.student_id', $student->student_id)
                ->whereNull('sma.ended_at')
                ->orderByDesc('sma.assigned_at')
                ->selectRaw('COALESCE(ld.lecturer_name, l.lecturer_name) as lecturer_name')
                ->selectRaw('COALESCE(ld.department, l.department) as department')
                ->selectRaw('COALESCE(ld.email, l.email) as email')
                ->addSelect('ld.photo_path', 'ld.position', 'ld.department_code')
                ->first();
        }

        $announcements = \App\Models\Announcement::query()
            ->where('status', 'published')
            ->whereDate('date_published', '<=', $today->toDateString())
            ->orderByDesc('date_published')
            ->take(3)
            ->get();

        // Prioritise upcoming events. If fewer than three are available,
        // fill the remaining slots with the most recently held past events.
        $events = \App\Models\Event::query()
            ->whereDate('event_date', '>=', $today->toDateString())
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->take(3)
            ->get();

        if ($events->count() < 3) {
            $remainingSlots = 3 - $events->count();

            $pastEvents = \App\Models\Event::query()
                ->whereDate('event_date', '<', $today->toDateString())
                ->orderByDesc('event_date')
                ->orderByDesc('start_time')
                ->take($remainingSlots)
                ->get();

            $events = $events->concat($pastEvents)->values();
        }

        return view('student.dashboard', compact(
            'student',
            'announcements',
            'events',
            'pendingRegistrations',
            'approvedRegistrations',
            'rejectedRegistrations',
            'registrationApplicationStatus',
            'upcomingRegistrationCount',
            'upcomingSemester',
            'registrations',
            'currentSemesterRegistrations',
            'mentor',
            'today',
            'todayDayName',
            'todayClasses',
            'studentGroup',
            'hasAnyTimetable'
        ));
    })->name('student.dashboard');

    Route::get('/student/profile', [StudentProfileController::class, 'show'])
        ->name('student.profile');

    Route::get('/student/academic-results', [\App\Http\Controllers\StudentAcademicResultController::class, 'index'])
        ->name('student.academic-results');

    Route::put('/student/profile', [StudentProfileController::class, 'update'])
        ->name('student.profile.update');

    Route::get('/student/profile/print', [StudentProfileController::class, 'printDetails'])
    ->name('student.profile.print');

    Route::get('/student/subject-registration', [
        \App\Http\Controllers\SubjectRegistrationController::class,
        'index'
    ])->name('student.subject-registration');

    Route::post('/student/subject-registration', [
        \App\Http\Controllers\SubjectRegistrationController::class,
        'store'
    ])->name('student.subject-registration.store');

    Route::get('/student/repeat-subjects', [\App\Http\Controllers\StudentRepeatSubjectController::class, 'index'])
        ->name('student.repeat-subjects');

    Route::post('/student/repeat-subjects', [\App\Http\Controllers\StudentRepeatSubjectController::class, 'store'])
        ->name('student.repeat-subjects.store');

    Route::get(
        '/student/announcements-events',
        [StudentAnnouncementEventController::class, 'index']
    )->name('student.announcements-events');

    Route::get(
        '/student/timetable',
        [StudentTimetableController::class, 'index']
    )->name('student.timetable');

});

// Lecturer Dashboard & Mentee Subject Registration
Route::middleware(['auth', 'role:lecturer'])->group(function () {

    Route::get('/lecturer/dashboard', function () {
        return view('lecturer.dashboard');
    })->name('lecturer.dashboard');

    Route::get(
        '/lecturer/subject-registrations',
        [LecturerSubjectRegistrationController::class, 'index']
    )->name('lecturer.subject-registrations.index');

    Route::get(
        '/lecturer/subject-registrations/{applicationId}',
        [LecturerSubjectRegistrationController::class, 'show']
    )->name('lecturer.subject-registrations.show');

    Route::patch(
        '/lecturer/subject-registrations/{applicationId}',
        [LecturerSubjectRegistrationController::class, 'updateStatus']
    )->name('lecturer.subject-registrations.update');

    Route::get(
        '/lecturer/student-records',
        [LecturerStudentRecordController::class, 'index']
    )->name('lecturer.student-records.index');

    Route::get(
        '/lecturer/student-records/{studentId}',
        [LecturerStudentRecordController::class, 'show']
    )->name('lecturer.student-records.show');

    Route::get(
        '/lecturer/record-marks',
        [LecturerRecordStudentMarksController::class, 'index']
    )->name('lecturer.record-marks.index');

    Route::get(
        '/lecturer/record-marks/{classId}',
        [LecturerRecordStudentMarksController::class, 'show']
    )->name('lecturer.record-marks.show');

    Route::post(
        '/lecturer/record-marks/{classId}',
        [LecturerRecordStudentMarksController::class, 'store']
    )->name('lecturer.record-marks.store');

    Route::get(
        '/lecturer/performance-report',
        [LecturerClassPerformanceReportController::class, 'index']
    )->name('lecturer.performance-report.index');

    Route::get(
        '/lecturer/performance-report/{classId}',
        [LecturerClassPerformanceReportController::class, 'show']
    )->name('lecturer.performance-report.show');

    Route::get('/lecturer/assessment-schemes', [LecturerAssessmentSchemeController::class, 'index'])
        ->name('lecturer.assessment-schemes.index');
    
    Route::post('/lecturer/assessment-schemes', [LecturerAssessmentSchemeController::class, 'store'])
        ->name('lecturer.assessment-schemes.store');
    
    Route::get('/lecturer/assessment-schemes/{schemeId}', [LecturerAssessmentSchemeController::class, 'show'])
        ->name('lecturer.assessment-schemes.show');
    
    Route::put('/lecturer/assessment-schemes/{schemeId}', [LecturerAssessmentSchemeController::class, 'update'])
        ->name('lecturer.assessment-schemes.update');
    
    Route::post('/lecturer/assessment-schemes/{schemeId}/activate', [LecturerAssessmentSchemeController::class, 'activate'])
        ->name('lecturer.assessment-schemes.activate');
    
    Route::post('/lecturer/assessment-schemes/{schemeId}/archive', [LecturerAssessmentSchemeController::class, 'archive'])
        ->name('lecturer.assessment-schemes.archive');
});

// UPP Dashboard
Route::middleware(['auth', 'role:upp'])->group(function () {
    Route::get('/upp/dashboard', function () {
        $totalRegistrations = \App\Models\SubjectRegistration::count();

        $pendingRegistrations = \App\Models\SubjectRegistration::where(
            'registration_status',
            'pending'
        )->count();

        $approvedRegistrations = \App\Models\SubjectRegistration::where(
            'registration_status',
            'approved'
        )->count();

        $rejectedRegistrations = \App\Models\SubjectRegistration::where(
            'registration_status',
            'rejected'
        )->count();

        $recentRegistrations = \App\Models\SubjectRegistration::with([
            'student',
            'subject',
            'classModel',
        ])
            ->latest('registration_date')
            ->latest('registration_id')
            ->take(5)
            ->get();

        return view('upp.dashboard', compact(
            'totalRegistrations',
            'pendingRegistrations',
            'approvedRegistrations',
            'rejectedRegistrations',
            'recentRegistrations'
        ));
    })->name('upp.dashboard');

    Route::get('/upp/subject-registrations', [
        UppSubjectRegistrationController::class,
        'index'
    ])->name('upp.subject-registrations.index');

    Route::get('/subject-registrations/{applicationId}', [UppSubjectRegistrationController::class, 'show'])
    ->name('upp.subject-registrations.show');
    
    Route::get('/upp/alternative-subjects', [UppAlternativeSubjectController::class, 'index'])
        ->name('upp.alternative-subjects.index');

    Route::put('/upp/alternative-subjects/{studentId}', [UppAlternativeSubjectController::class, 'update'])
        ->name('upp.alternative-subjects.update');

    Route::get('/upp/students', [UppManageStudentController::class, 'index'])
    ->name('upp.students.index');

    Route::post('/upp/students', [UppManageStudentController::class, 'store'])
    ->name('upp.students.store');

    Route::post('/upp/students/{studentId}/mentor', [UppManageStudentController::class, 'assignMentor'])
        ->name('upp.students.assign-mentor');

    Route::get('/upp/students/{studentId}/edit', [
        UppManageStudentController::class,
        'edit'
    ])->name('upp.students.edit');

    Route::put('/upp/students/{studentId}', [
        UppManageStudentController::class,
        'update'
    ])->name('upp.students.update');

    Route::delete('/upp/students/{studentId}', [
        UppManageStudentController::class,
        'destroy'
    ])->name('upp.students.destroy');

    Route::get('/upp/lecturers', [
        UppManageLecturerController::class,
        'index'
    ])->name('upp.lecturers.index');

    Route::post('/upp/lecturers', [
        UppManageLecturerController::class,
        'store'
    ])->name('upp.lecturers.store');

    Route::get('/upp/lecturers/{lecturerId}/edit', [
        UppManageLecturerController::class,
        'edit'
    ])->name('upp.lecturers.edit');

    Route::put('/upp/lecturers/{lecturerId}', [
        UppManageLecturerController::class,
        'update'
    ])->name('upp.lecturers.update');

    Route::delete('/upp/lecturers/{lecturerId}', [
        UppManageLecturerController::class,
        'destroy'
    ])->name('upp.lecturers.destroy');

    Route::get('/upp/subjects', [
        UppManageSubjectController::class,
        'index'
    ])->name('upp.subjects.index');

    Route::post('/upp/subjects', [
        UppManageSubjectController::class,
        'store' 
    ])->name('upp.subjects.store');

    Route::get('/upp/subjects/{subjectId}/edit', [
        UppManageSubjectController::class,
        'edit'
    ])->name('upp.subjects.edit');

    Route::put('/upp/subjects/{subjectId}', [
        UppManageSubjectController::class,
        'update'
    ])->name('upp.subjects.update');

    Route::delete('/upp/subjects/{subjectId}', [
        UppManageSubjectController::class,
        'destroy'
    ])->name('upp.subjects.destroy');


        // UPP Result Report
    Route::get('/upp/result-report', [
        UppResultReportController::class,
        'index'
    ])->name('upp.result-report.index');

    Route::get('/upp/assessment-schemes', [UppAssessmentSchemeController::class, 'index'])
        ->name('upp.assessment-schemes.index');
    
    Route::get('/upp/assessment-schemes/{schemeId}', [UppAssessmentSchemeController::class, 'show'])
        ->name('upp.assessment-schemes.show');

    Route::get('/upp/classes', [UppManageClassGroupController::class, 'index'])
        ->name('upp.classes.index');

    Route::post('/upp/classes', [UppManageClassGroupController::class, 'store'])
        ->name('upp.classes.store');

    Route::get('/upp/classes/{groupId}', [UppManageClassGroupController::class, 'show'])
        ->name('upp.classes.show');

    Route::put('/upp/classes/{groupId}', [UppManageClassGroupController::class, 'update'])
        ->name('upp.classes.update');

    Route::delete('/upp/classes/{groupId}', [UppManageClassGroupController::class, 'destroy'])
        ->name('upp.classes.destroy');

    Route::get('/upp/subject-classes', [UppManageSubjectClassController::class, 'index'])->name('upp.subject-classes.index');
    
    Route::post('/upp/subject-classes', [UppManageSubjectClassController::class, 'store'])->name('upp.subject-classes.store');
    
    Route::put('/upp/subject-classes/{classId}', [UppManageSubjectClassController::class, 'update'])->name('upp.subject-classes.update');
    
    Route::delete('/upp/subject-classes/{classId}', [UppManageSubjectClassController::class, 'destroy'])->name('upp.subject-classes.destroy');
    Route::post('/upp/repeat-classes', [UppManageSubjectClassController::class, 'storeRepeat'])->name('upp.repeat-classes.store');
    Route::put('/upp/repeat-classes/{classId}', [UppManageSubjectClassController::class, 'updateRepeat'])->name('upp.repeat-classes.update');
    Route::delete('/upp/repeat-classes/{classId}', [UppManageSubjectClassController::class, 'destroyRepeat'])->name('upp.repeat-classes.destroy');    

    // UPP review for repeat subject applications (separate from regular subject registration).
    Route::get('/upp/repeat-subject-applications', [UppRepeatSubjectApplicationController::class, 'index'])
        ->name('upp.repeat-subject-applications.index');

    Route::post('/upp/repeat-subject-applications/{applicationId}/approve', [UppRepeatSubjectApplicationController::class, 'approve'])
        ->whereNumber('applicationId')
        ->name('upp.repeat-subject-applications.approve');

    Route::post('/upp/repeat-subject-applications/{applicationId}/reject', [UppRepeatSubjectApplicationController::class, 'reject'])
        ->whereNumber('applicationId')
        ->name('upp.repeat-subject-applications.reject');
}); 