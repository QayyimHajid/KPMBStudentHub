<!DOCTYPE html>

<html lang="en"><head>
<meta name="csrf-token" content="{{ csrf_token() }}"><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_dashboard" name="shell-type"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&amp;display=swap" rel="stylesheet"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>
@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}
::-webkit-scrollbar{display:none;}

/* Subtle collegiate ambient background animation */
@keyframes meshDrift {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -20px) scale(1.05); }
  66% { transform: translate(-20px, 20px) scale(0.97); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.collegiate-ambient-mesh {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 0;
  overflow: hidden;
  opacity: 0.6;
}
.glow-blob-1 {
  position: absolute;
  top: 5%;
  right: 15%;
  width: 520px;
  height: 520px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(254, 214, 91, 0.08) 0%, rgba(254, 214, 91, 0) 70%);
  animation: meshDrift 18s ease-in-out infinite;
  filter: blur(50px);
}
.glow-blob-2 {
  position: absolute;
  bottom: 10%;
  left: 20%;
  width: 600px;
  height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0, 33, 71, 0.05) 0%, rgba(0, 33, 71, 0) 70%);
  animation: meshDrift 22s ease-in-out infinite reverse;
  filter: blur(60px);
}
.glow-blob-3 {
  position: absolute;
  top: 45%;
  left: 55%;
  width: 400px;
  height: 400px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(115, 92, 0, 0.04) 0%, rgba(115, 92, 0, 0) 70%);
  animation: meshDrift 15s ease-in-out infinite alternate;
  filter: blur(40px);
}
@media (prefers-reduced-motion: reduce) { .glow-blob-1, .glow-blob-2, .glow-blob-3 { animation: none !important; } }
</style><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{colors:{"on-primary":"#ffffff","on-tertiary-fixed":"#181c20","on-surface-variant":"#44474e","on-tertiary":"#ffffff","on-primary-fixed-variant":"#2d476f","on-secondary-container":"#745c00","on-error-container":"#93000a","tertiary-fixed":"#e0e3e8","surface-dim":"#dcd9d9","tertiary":"#070b0f","secondary-container":"#fed65b","surface-container-low":"#f6f3f2","on-surface":"#1c1b1b","outline":"#74777f","primary-fixed":"#d6e3ff","surface-variant":"#e5e2e1","primary-container":"#002147","on-error":"#ffffff","inverse-on-surface":"#f3f0ef","surface-container-highest":"#e5e2e1","on-tertiary-fixed-variant":"#43474b","surface":"#fcf9f8","secondary-fixed-dim":"#e9c349","inverse-surface":"#313030","error":"#ba1a1a","surface-bright":"#fcf9f8","on-secondary":"#ffffff","on-primary-container":"#708ab5","on-secondary-fixed-variant":"#574500","error-container":"#ffdad6","secondary":"#735c00","surface-container":"#f0eded","on-secondary-fixed":"#241a00","on-primary-fixed":"#001b3d","inverse-primary":"#aec7f6","surface-container-lowest":"#ffffff","secondary-fixed":"#ffe088","surface-tint":"#465f88","on-background":"#1c1b1b","surface-container-high":"#eae7e7","background":"#fcf9f8","primary-fixed-dim":"#aec7f6","tertiary-container":"#1e2226","outline-variant":"#c4c6cf","tertiary-fixed-dim":"#c3c7cc","on-tertiary-container":"#85898e","primary":"#000a1e"},borderRadius:{DEFAULT:"0.25rem",lg:"0.5rem",xl:"0.75rem",full:"9999px"},spacing:{},fontFamily:{headline:["Hanken Grotesk"],display:["Hanken Grotesk"],body:["\"Source Serif 4\""],label:["Hanken Grotesk"]},fontSize:{}}}}</script></head><body class="bg-surface font-body text-on-surface antialiased relative">
<!-- Subtle Animated Background Elements -->
<div aria-hidden="true" class="collegiate-ambient-mesh">
<div class="glow-blob-1"></div>
<div class="glow-blob-2"></div>
<div class="glow-blob-3"></div>
</div>
@php
    $userName = auth()->user()->name ?? 'Pegawai UPP';
    $displaySession = $academicSession ?? $currentAcademicSession ?? 'Sesi akademik belum ditetapkan';

    $uppSidebarGroups = [
        [
            'label' => 'PENGURUSAN UTAMA',
            'items' => [
                ['label' => 'Dashboard UPP', 'icon' => 'dashboard', 'url' => '/upp/dashboard', 'patterns' => ['upp/dashboard']],
            ],
        ],
        [
            'label' => 'PENGURUSAN PELAJAR & PENSYARAH',
            'items' => [
                ['label' => 'Pengurusan Pelajar', 'icon' => 'groups', 'url' => '/upp/students', 'patterns' => ['upp/students*']],
                ['label' => 'Pengurusan Pensyarah', 'icon' => 'badge', 'url' => '/upp/lecturers', 'patterns' => ['upp/lecturers*']],
            ],
        ],
        [
            'label' => 'PENGURUSAN AKADEMIK',
            'items' => [
                ['label' => 'Pengurusan Subjek', 'icon' => 'menu_book', 'url' => '/upp/subjects', 'patterns' => ['upp/subjects*']],
                ['label' => 'Pengurusan Kelas', 'icon' => 'meeting_room', 'url' => '/upp/classes', 'patterns' => ['upp/classes*']],
                ['label' => 'Skim Penilaian', 'icon' => 'fact_check', 'url' => '/upp/assessment-schemes', 'patterns' => ['upp/assessment-schemes*']],
            ],
        ],
        [
            'label' => 'PENDAFTARAN & PEMANTAUAN',
            'items' => [
                ['label' => 'Pemantauan Pendaftaran', 'icon' => 'how_to_reg', 'url' => '/upp/subject-registrations', 'patterns' => ['upp/subject-registrations*']],
                ['label' => 'Laporan Pendaftaran', 'icon' => 'summarize', 'url' => '/upp/registration-report', 'patterns' => ['upp/registration-report*']],
            ],
        ],
        [
            'label' => 'KEPUTUSAN & LAPORAN',
            'items' => [
                ['label' => 'Laporan Keputusan', 'icon' => 'analytics', 'url' => '/upp/result-report', 'patterns' => ['upp/result-report*']],
            ],
        ],
    ];
@endphp

@include('upp.partials.sidebar')
<div class="pl-72 min-h-screen flex flex-col relative z-10">@include('upp.partials.topbar')
<main class="w-full pt-16 bg-transparent flex-1 pb-28"><div class="flex flex-col w-full">
<!-- Toast Feedback Simulation Container -->
<div class="fixed top-20 right-10 z-50 transform translate-y-[-120%] opacity-0 transition-all duration-300 pointer-events-none flex items-center gap-3 px-5 py-3.5 rounded-lg shadow-xl bg-primary text-on-primary font-label text-sm" id="toastNotification">
<span class="material-symbols-outlined text-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
<span class="" id="toastMessage">Student record updated successfully.</span>
</div>
<!-- Header Breadcrumb & Title Banner -->
<section class="relative px-8 py-7 bg-surface-container-low/90 backdrop-blur-sm shadow-sm border-b border-surface-container">
<div class="absolute right-12 top-2 opacity-5 pointer-events-none select-none">
<span class="material-symbols-outlined text-[120px] text-primary">edit_square</span>
</div>
<div class="max-w-6xl mx-auto relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
<div class="space-y-1">
<div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded text-[11px] font-label font-bold uppercase tracking-wider bg-secondary-container text-on-secondary-container">
<span class="material-symbols-outlined text-[14px]">school</span> KPMB STUDENT RECORD
</div>
<h1 class="text-2xl sm:text-3xl font-headline font-bold text-primary tracking-tight">Edit Student</h1>
<p class="text-xs sm:text-sm font-label text-on-surface-variant">Update the student details recorded in KPMB Student Hub.</p>
</div>
<div class="flex items-center gap-2 shrink-0">
<a class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-outline-variant hover:bg-surface-container-high text-xs font-label font-semibold text-on-surface transition-colors" href="{{ route('upp.students.index') }}">
<span class="material-symbols-outlined text-base">arrow_back</span>
<span>Back to Student Records</span>
</a>
</div>
</div>
</section>
<!-- Content Container: 2-Column Collegiate Layout -->
<div class="px-8 py-8 max-w-6xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Left: Targeted Edit Student Section (Span 7/12) -->
<div class="lg:col-span-7 bg-surface-container-lowest/95 backdrop-blur-md rounded-2xl p-7 sm:p-8 shadow-sm border border-surface-container space-y-6">
<!-- 3. STUDENT IDENTITY CARD AT THE TOP OF THE FORM -->
<div class="relative overflow-hidden rounded-xl border border-secondary/30 bg-gradient-to-br from-primary-container via-[#001733] to-primary p-5 text-on-primary shadow-sm">
<div class="absolute -right-6 -bottom-8 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[110px] text-secondary-fixed">school</span>
</div>
<div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div class="flex items-center gap-4">
<!-- Avatar with subtle gold accent ring -->
<div class="relative shrink-0">
<div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center font-headline font-bold text-lg text-secondary-fixed shadow-md ring-2 ring-secondary-container/80 ring-offset-2 ring-offset-primary-container overflow-hidden" id="topAvatar">
          @if ($student->student?->profile_picture)
            <img src="{{ asset('storage/' . $student->student->profile_picture) }}" alt="{{ $student->student_name }}" class="w-full h-full object-cover">
          @else
            <span>{{ collect(explode(' ', old('student_name', $student->student_name)))->filter()->take(2)->map(fn($part) => mb_substr($part, 0, 1))->implode('') }}</span>
          @endif
        </div>
<span class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full bg-emerald-500 border-2 border-primary-container flex items-center justify-center" title="Student Record">
<span class="material-symbols-outlined text-[10px] text-white font-bold">check</span>
</span>
</div>
<!-- Info Header -->
<div class="min-w-0">
<div class="flex items-center gap-2">
<span class="text-[11px] font-mono font-bold text-secondary-fixed tracking-wider px-2 py-0.5 rounded bg-surface-container-lowest/10 border border-secondary-fixed/20" id="topStudentIdBadge">{{ $student->student_id }}</span>
<span class="text-[10px] font-label text-slate-300 uppercase tracking-widest hidden sm:inline">STUDENT RECORD</span>
</div>
<h2 class="text-base sm:text-lg font-headline font-bold text-white tracking-tight truncate mt-1" id="topStudentName">{{ old('student_name', $student->student_name) }}</h2>
<div class="text-xs font-label text-slate-300 truncate mt-0.5" id="topProgramme">{{ old('programme', $student->programme) }}</div>
<div class="text-[11px] font-label text-secondary-fixed/90 mt-0.5 flex items-center gap-1.5">
<span class="material-symbols-outlined text-[13px]">calendar_today</span>
<span id="topSemester">Semester {{ str_pad((string) old('semester', $student->semester), 2, '0', STR_PAD_LEFT) }}</span>
</div>
</div>
</div>
<!-- Dynamic Unsaved Changes Indicator Pill -->
<div class="self-start sm:self-center shrink-0">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label font-semibold transition-all duration-200 bg-emerald-950/60 text-emerald-300 border border-emerald-500/30" id="unsavedStatusBadge">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span id="unsavedStatusText">Semua Perubahan Disimpan</span>
</span>
</div>
</div>
</div>
<div class="flex items-center justify-between pb-3 border-b border-surface-container">
<div>
<h3 class="text-sm font-headline font-bold text-primary">Student Information</h3>
<p class="text-xs font-label text-on-surface-variant">Update the student details below</p>
</div>
<span class="px-2.5 py-1 rounded bg-surface-container text-primary font-mono text-[11px] font-bold">KPMB • UPP</span>
</div>
<!-- 4. INTERACTIVE FORM FIELDS (Strictly containing ONLY the 4 requested fields) -->
<form class="space-y-5" id="editStudentForm" action="{{ route('upp.students.update', $student->student_id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
@if ($errors->any())
<div class="rounded-lg border border-error/30 bg-error-container/40 p-4 text-sm text-on-error-container" role="alert">
<strong>Please correct the following errors:</strong>
<ul class="mt-2 list-disc pl-5">
@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
</ul>
</div>
@endif
<!-- 1. Student ID Field -->
<div class="space-y-1.5">
<label class="block text-xs font-label font-bold text-primary tracking-wide flex items-center justify-between" for="studentId">
<span class="flex items-center gap-1.5">Student ID <span class="text-error">*</span></span>
<span class="text-[11px] font-normal text-on-surface-variant">Student identifier</span>
</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-lg">badge</span>
</div>
<input class="w-full h-11 pl-10 pr-3.5 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-mono font-semibold focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all" id="studentId" type="text" value="{{ $student->student_id }}" readonly aria-readonly="true"/>
</div>
<p class="text-[11px] font-label text-error hidden" id="studentIdError">Student ID cannot be empty and must follow collegiate format (e.g. KPMB-STU-XXXX-XXXX).</p>
</div>
<!-- 2. Student Name Field -->
<div class="space-y-1.5">
<label class="block text-xs font-label font-bold text-primary tracking-wide flex items-center justify-between" for="studentName">
<span class="flex items-center gap-1.5">Student Name <span class="text-error">*</span></span>
<span class="text-[11px] font-normal text-on-surface-variant">Enter the student’s full name</span>
</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-lg">person</span>
</div>
<input class="w-full h-11 pl-10 pr-3.5 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-label font-medium focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all" id="studentName" name="student_name" oninput="handleInputChange()" required type="text" maxlength="100" value="{{ old('student_name', $student->student_name) }}"/>
</div>
<p class="text-[11px] font-label text-error hidden" id="studentNameError">Student Name cannot be empty and must match official identity records.</p>
</div>
<!-- 3. Programme Field -->
<div class="space-y-1.5">
<label class="block text-xs font-label font-bold text-primary tracking-wide flex items-center justify-between" for="programme">
<span class="flex items-center gap-1.5">Programme <span class="text-error">*</span></span>
<span class="text-[11px] font-normal text-on-surface-variant">Registered programme</span>
</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-lg">school</span>
</div>
<select class="w-full h-11 pl-10 pr-10 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all appearance-none" id="programme" name="programme" onchange="handleInputChange(); handleProgrammeChange()" required>
    <option value="">-- Select Programme --</option>
    <option value="Diploma in Accounting" @selected(old('programme', $student->programme) === 'Diploma in Accounting')>DIA — Diploma in Accounting</option>
    <option value="Diploma in Business Studies" @selected(old('programme', $student->programme) === 'Diploma in Business Studies')>DBS — Diploma in Business Studies</option>
    <option value="Diploma in Computer Science" @selected(old('programme', $student->programme) === 'Diploma in Computer Science')>DCS — Diploma in Computer Science</option>
    <option value="Diploma in Landscape and Horticulture" @selected(old('programme', $student->programme) === 'Diploma in Landscape and Horticulture')>DLH — Diploma in Landscape and Horticulture</option>
    <option value="Certificate in Finance, Accounting and Business" @selected(old('programme', $student->programme) === 'Certificate in Finance, Accounting and Business')>CFAB — Certificate in Finance, Accounting and Business</option>
</select>
<div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-on-surface-variant">
    <span class="material-symbols-outlined text-lg">expand_more</span>
</div>
</div>
<p class="text-[11px] font-label text-error hidden" id="programmeError">Please select a valid accredited academic programme.</p>
</div>
<!-- 4. Semester Field -->
<div class="space-y-1.5">
<label class="block text-xs font-label font-bold text-primary tracking-wide flex items-center justify-between" for="semester">
<span class="flex items-center gap-1.5">Semester <span class="text-error">*</span></span>
<span class="text-[11px] font-normal text-on-surface-variant">Current semester</span>
</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-lg">calendar_view_week</span>
</div>
<input class="w-full h-11 pl-10 pr-3.5 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all" id="semester" name="semester" oninput="handleInputChange(); filterClassGroups()" required type="number" min="1" value="{{ old('semester', $student->semester) }}"/>
</div>
<p class="text-[11px] font-label text-error hidden" id="semesterError">Please specify the current registered semester term.</p>
</div>

{{-- 5. Class Group Assignment --}}
@if ($student->student)
<div class="space-y-1.5">
    <label
        class="block text-xs font-label font-bold text-primary tracking-wide"
        for="group_id"
    >
        Current Class Group
    </label>

    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
            <span class="material-symbols-outlined text-lg">groups</span>
        </div>

        <select
            class="w-full h-11 pl-10 pr-3.5 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all"
            id="group_id"
            name="group_id"
            onchange="handleInputChange()"
        >
            <option value="">-- Belum ditetapkan --</option>

            @foreach ($classGroups as $group)
                @php
                    preg_match('/([A-Z]+)$/', strtoupper(trim($group->group_name)), $sectionMatch);
                    $groupSection = $sectionMatch[1] ?? '';
                @endphp
                <option
                    value="{{ $group->group_id }}"
                    data-semester="{{ $group->semester }}"
                    data-section="{{ $groupSection }}"
                    @selected(
                        (string) old('group_id', $student->student?->group_id ?? '') === (string) $group->group_id
                    )
                >
                    {{ $group->group_name }}
                    — Semester {{ $group->semester }}
                    ({{ $group->academic_session }})
                </option>
            @endforeach
        </select>
    </div>

    <p class="text-[11px] font-label text-on-surface-variant">
        Kumpulan kelas mengikut semester semasa. Apabila semester ditukar, sistem akan mencadangkan seksyen kelas yang sama jika tersedia.
    </p>

    @error('group_id')
        <p class="text-xs text-error">{{ $message }}</p>
    @enderror
</div>
@endif

{{-- 6. Programme Structure Field --}}
<div class="space-y-1.5">
    <label
        class="block text-xs font-label font-bold text-primary tracking-wide"
        for="structure_id"
    >
        Programme Structure
    </label>

    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
            <span class="material-symbols-outlined text-lg">account_tree</span>
        </div>

        <select
            class="w-full h-11 pl-10 pr-3.5 rounded-lg bg-surface border border-outline-variant hover:border-outline text-on-surface text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all"
            id="structure_id"
            name="structure_id"
            onchange="handleInputChange()"
        >
            <option value="">-- Belum ditetapkan --</option>

            @foreach ($programmeStructures as $structure)
                <option
                    value="{{ $structure->structure_id }}"
                    @selected(
                        (string) old(
                            'structure_id',
                            $student->student?->structure_id
                        ) === (string) $structure->structure_id
                    )
                >
                    {{ $structure->intake_code }}
                    — Version {{ $structure->version }}
                    ({{ ucfirst($structure->status) }})
                </option>
            @endforeach
        </select>
    </div>

    <p class="text-[11px] font-label text-on-surface-variant">
        Pilih programme structure yang sepadan dengan intake pelajar.
        Struktur draft digunakan untuk pembangunan dan pengujian.
    </p>

    @error('structure_id')
        <p class="text-xs text-error">{{ $message }}</p>
    @enderror
</div>

{{-- Additional personal information and profile picture are available for linked student accounts. --}}
@if ($student->student)
    <div class="pt-5 mt-2 border-t border-surface-container space-y-5">
        <div>
            <h3 class="text-sm font-headline font-bold text-primary">Personal Information</h3>
            <p class="text-xs font-label text-on-surface-variant">Maklumat hubungan pelajar dan penjaga, serta gambar profil.</p>
        </div>

        <div class="space-y-2">
            <label for="profile_picture" class="block text-xs font-label font-bold text-primary tracking-wide">Profile Picture</label>
            <div class="flex items-center gap-4">
                <div id="profilePicturePreview" class="w-20 h-20 rounded-full overflow-hidden bg-surface-container border border-outline-variant flex items-center justify-center text-primary font-bold text-xl shrink-0">
                    @if ($student->student->profile_picture)
                        <img src="{{ asset('storage/' . $student->student->profile_picture) }}" alt="Current student profile picture" class="w-full h-full object-cover">
                    @else
                        {{ collect(explode(' ', old('student_name', $student->student_name)))->filter()->take(2)->map(fn($part) => mb_substr($part, 0, 1))->implode('') }}
                    @endif
                </div>
                <div class="min-w-0 space-y-1.5">
                    <input type="file" name="profile_picture" id="profile_picture" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="block w-full text-xs font-label text-on-surface-variant file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-primary" onchange="previewStudentPicture(event)">
                    <p class="text-[11px] font-label text-on-surface-variant">JPG, PNG atau WebP. Saiz maksimum 2 MB. Biarkan kosong untuk kekalkan gambar semasa.</p>
                    @error('profile_picture') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-label font-bold text-primary">Email</label>
                <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="email" name="email" type="email" maxlength="100" value="{{ old('email', $student->student->email) }}" autocomplete="email">
                @error('email') <p class="text-xs text-error">{{ $message }}</p> @enderror
            </div>
            <div class="space-y-1.5">
                <label for="phone_number" class="block text-xs font-label font-bold text-primary">Phone Number</label>
                <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="phone_number" name="phone_number" type="text" maxlength="20" value="{{ old('phone_number', $student->student->phone_number) }}" autocomplete="tel">
                @error('phone_number') <p class="text-xs text-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="home_address" class="block text-xs font-label font-bold text-primary">Home Address</label>
            <textarea class="w-full px-3.5 py-3 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="home_address" name="home_address" rows="3" maxlength="2000">{{ old('home_address', $student->student->home_address) }}</textarea>
            @error('home_address') <p class="text-xs text-error">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4 border-t border-surface-container">
            <h4 class="text-xs font-label font-bold uppercase tracking-wide text-primary mb-3">Guardian Information</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="guardian_name" class="block text-xs font-label font-bold text-primary">Guardian Name</label>
                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="guardian_name" name="guardian_name" maxlength="100" value="{{ old('guardian_name', $student->student->guardian_name) }}">
                    @error('guardian_name') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="guardian_relationship" class="block text-xs font-label font-bold text-primary">Relationship</label>
                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="guardian_relationship" name="guardian_relationship" maxlength="50" value="{{ old('guardian_relationship', $student->student->guardian_relationship) }}">
                    @error('guardian_relationship') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="guardian_phone" class="block text-xs font-label font-bold text-primary">Guardian Phone</label>
                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="guardian_phone" name="guardian_phone" maxlength="20" value="{{ old('guardian_phone', $student->student->guardian_phone) }}">
                    @error('guardian_phone') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="guardian_occupation" class="block text-xs font-label font-bold text-primary">Guardian Occupation</label>
                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="guardian_occupation" name="guardian_occupation" maxlength="100" value="{{ old('guardian_occupation', $student->student->guardian_occupation) }}">
                    @error('guardian_occupation') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-1.5 sm:col-span-2">
                    <label for="guardian_employer" class="block text-xs font-label font-bold text-primary">Guardian Employer</label>
                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface border border-outline-variant text-sm font-label focus:border-amber-500 focus:ring-2 focus:ring-amber-400/50 focus:outline-none" id="guardian_employer" name="guardian_employer" maxlength="150" value="{{ old('guardian_employer', $student->student->guardian_employer) }}">
                    @error('guardian_employer') <p class="text-xs text-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
@else
    <div class="rounded-xl border border-amber-500/30 bg-amber-500/10 p-4 text-xs font-label text-amber-900">
        Maklumat peribadi tambahan dan gambar profil boleh diurus selepas pelajar mempunyai akaun berdaftar yang dipautkan.
    </div>
@endif
</form>
</div>
<!-- 5. RECORD OVERVIEW NEXT TO THE FORM (Span 5/12) -->
<div class="lg:col-span-5 space-y-5">
<div class="bg-surface-container-lowest/95 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-surface-container space-y-5">
<div class="flex items-center justify-between pb-3.5 border-b border-surface-container">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-xl">folder_shared</span>
<h3 class="text-xs font-label font-bold uppercase tracking-wider text-primary">Record Overview</h3>
</div>
<!-- Account Status Badge -->
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-label font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
<span>Record Loaded</span>
</span>
</div>
<!-- Structured Overview Data -->
<div class="space-y-3.5">
<div class="p-3.5 rounded-xl bg-surface-container-low border border-surface-container space-y-1">
<span class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">Matriculation Key &amp; Docket</span>
<div class="text-sm font-mono font-bold text-primary" id="overviewStudentId">{{ $student->student_id }}</div>
<div class="text-xs font-label font-medium text-on-surface pt-1" id="overviewProgramme">{{ old('programme', $student->programme) }}</div>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="p-3 rounded-xl bg-surface-container-low border border-surface-container">
<span class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">Current Semester</span>
<div class="text-xs font-headline font-bold text-primary mt-1" id="overviewSemester">Semester {{ str_pad((string) old('semester', $student->semester), 2, '0', STR_PAD_LEFT) }}</div>
</div>
<div class="p-3 rounded-xl bg-surface-container-low border border-surface-container">
<span class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">Record Type</span>
<div class="text-xs font-headline font-bold text-secondary flex items-center gap-1 mt-1">
<span class="material-symbols-outlined text-sm">verified_user</span> Student
          </div>
</div>
</div>
<!-- Live Changes Delta Tracker -->
<div class="p-3.5 rounded-xl border border-surface-container bg-surface-container-low/70 space-y-2" id="deltaContainer">
<div class="flex items-center justify-between">
<span class="text-[11px] font-label font-bold text-primary flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm text-secondary">sync</span>
<span>Modification Summary</span>
</span>
<span class="text-[10px] font-mono px-2 py-0.5 rounded bg-surface-container text-on-surface-variant font-medium" id="deltaBadge">0 Edits</span>
</div>
<p class="text-xs font-label text-on-surface-variant" id="deltaDescription">No unsaved modifications detected in this active session.</p>
</div>
<!-- Brief Advisory Note -->
<div class="flex items-start gap-2.5 p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-950">
<span class="material-symbols-outlined text-secondary text-base shrink-0 mt-0.5">info</span>
<p class="text-[11px] font-label text-amber-900 leading-relaxed">
          Changes will be saved to the student record when you select Save Changes.
        </p>
</div>
</div>
</div>
<!-- Governance Footer Note -->
<div class="bg-surface-container-lowest/95 backdrop-blur-md rounded-2xl p-5 shadow-sm border border-surface-container space-y-2.5 text-xs font-label">
<div class="flex items-center gap-2 font-bold text-primary uppercase tracking-wide text-[11px]">
<span class="material-symbols-outlined text-base text-secondary">security</span>
<span>Student Record Information</span>
</div>
<div class="flex items-center justify-between text-on-surface-variant">
<span>Managed by:</span>
<span class="font-semibold text-primary">UPP Officer</span>
</div>
<div class="flex items-center justify-between text-on-surface-variant">
<span>Record ID:</span>
<span class="font-mono text-[11px] font-semibold text-primary">{{ $student->student_id }}</span>
</div>
</div>
</div>
</div>
<!-- 6. STICKY ACTION BAR -->
<div class="fixed bottom-0 left-72 right-0 bg-surface/90 backdrop-blur-md border-t border-surface-container py-3.5 px-8 z-40 shadow-lg flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="inline-flex items-center gap-2 text-xs font-label text-on-surface-variant">
<span class="w-2 h-2 rounded-full" id="statusBarDot" style="background-color: #10b981;"></span>
<span class="font-medium" id="statusBarMessage">No unsaved changes.</span>
</span>
</div>
<div class="flex items-center gap-3">
<!-- Cancel Button -->
<button class="h-10 px-5 rounded-lg border border-outline-variant hover:bg-surface-container hover:text-on-surface text-on-surface-variant text-xs font-label font-bold transition-all flex items-center justify-center gap-2 cursor-pointer" onclick="handleCancelClick(event)" type="button">
<span class="material-symbols-outlined text-base">close</span>
<span>Cancel</span>
</button>
<!-- Save Changes / Update Student Button -->
<button class="h-10 px-6 rounded-lg bg-primary-container text-on-primary text-xs font-label font-bold transition-all duration-200 shadow-sm flex items-center justify-center gap-2 border-b-2 border-secondary opacity-50 cursor-not-allowed" disabled="" id="saveChangesBtn" onclick="submitStudentRecord()" type="button">
<span class="material-symbols-outlined text-secondary-container text-base" style="font-variation-settings: 'FILL' 1;">check_circle</span>
<span class="tracking-wide">Save Changes</span>
</button>
</div>
</div>
<!-- Cancel Confirmation Modal -->
<div class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4" id="cancelConfirmModal">
<div class="bg-surface-container-lowest max-w-md w-full rounded-2xl p-6 shadow-2xl border border-surface-container space-y-4 animate-scaleIn">
<div class="flex items-center gap-3 text-secondary">
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined text-xl">warning</span>
</div>
<div>
<h4 class="text-base font-headline font-bold text-primary">Unsaved Changes Pending</h4>
<p class="text-xs font-label text-on-surface-variant">Your changes have not been saved</p>
</div>
</div>
<p class="text-xs font-body text-on-surface-variant leading-relaxed">
      You have unsaved changes. Leaving now will discard your edits.
    </p>
<div class="pt-3 border-t border-surface-container flex items-center justify-end gap-3">
<button class="px-4 py-2 rounded-lg border border-outline-variant hover:bg-surface-container text-xs font-label font-semibold text-on-surface transition-colors cursor-pointer" onclick="closeCancelModal()" type="button">
        Keep Editing
      </button>
<button class="px-4 py-2 rounded-lg bg-error hover:bg-red-700 text-white text-xs font-label font-semibold transition-colors shadow-sm cursor-pointer" onclick="confirmDiscardChanges()" type="button">
        Discard Changes
      </button>
</div>
</div>
</div>
<!-- Client-side Interactive Logic -->
<script>
  // Baseline initial state
  const baseline = {
    studentId: @json($student->student_id),
    studentName: @json(old('student_name', $student->student_name)),
    programme: @json(old('programme', $student->programme)),
    semester: @json((string) old('semester', $student->semester)),
    structureId: @json(
    (string) old('structure_id', $student->student?->structure_id ?? '')
),
    groupId: @json(
    (string) old('group_id', $student->student?->group_id ?? '')
)
  };

  let hasUnsavedChanges = false;

  let preferredGroupSection = null;

  function getGroupSection(option) {
    return option && option.value ? (option.dataset.section || null) : null;
  }

  function filterClassGroups() {
    const semesterInput = document.getElementById('semester');
    const groupSelect = document.getElementById('group_id');
    if (!semesterInput || !groupSelect) return;

    const selectedBeforeFilter = groupSelect.selectedOptions[0];
    const selectedSection = getGroupSection(selectedBeforeFilter);
    if (selectedSection) preferredGroupSection = selectedSection;

    const targetSemester = Number(semesterInput.value);
    const matchingOptions = [];

    Array.from(groupSelect.options).forEach(option => {
      if (!option.value) return;
      const matchesSemester = Number(option.dataset.semester) === targetSemester;
      option.hidden = !matchesSemester;
      option.disabled = !matchesSemester;
      if (matchesSemester) matchingOptions.push(option);
    });

    // Keep the selected group if it is still in the chosen semester.
    if (selectedBeforeFilter && selectedBeforeFilter.value &&
        Number(selectedBeforeFilter.dataset.semester) === targetSemester) {
      return;
    }

    // When the semester changes, prefer the same section (e.g. DBS 3A -> DBS 4A).
    const preferredOption = matchingOptions.find(option =>
      preferredGroupSection && option.dataset.section === preferredGroupSection
    );

    groupSelect.value = preferredOption ? preferredOption.value : '';
  }

  function getInitials(name) {
    if (!name) return 'ST';
    return name
      .split(' ')
      .filter(n => n.length > 0)
      .map(n => n[0])
      .slice(0, 2)
      .join('')
      .toUpperCase();
  }

  function handleInputChange() {
    const idVal = document.getElementById('studentId').value.trim();
    const nameVal = document.getElementById('studentName').value.trim();
    const progVal = document.getElementById('programme').value;
    const semSelect = document.getElementById('semester');
    const semVal = semSelect.value;
    const semText = semVal ? `Semester ${String(semVal).padStart(2, '0')}` : 'Semester not set';
    const structureSelect = document.getElementById('structure_id');
    const structureVal = structureSelect.value;
    const isStructureChanged = structureVal !== baseline.structureId;

    const groupSelect = document.getElementById('group_id');
    const groupVal = groupSelect ? groupSelect.value : baseline.groupId;
    const isGroupChanged = groupVal !== baseline.groupId;

    // Validate inputs
    let isValid = true;
    const idError = document.getElementById('studentIdError');
    const nameError = document.getElementById('studentNameError');

    if (!idVal) {
      idError.classList.remove('hidden');
      isValid = false;
    } else {
      idError.classList.add('hidden');
    }

    if (!nameVal) {
      nameError.classList.remove('hidden');
      isValid = false;
    } else {
      nameError.classList.add('hidden');
    }

    // Check if changed from baseline
    const isIdChanged = idVal !== baseline.studentId;
    const isNameChanged = nameVal !== baseline.studentName;
    const isProgChanged = progVal !== baseline.programme;
    const isSemChanged = semVal !== baseline.semester;

    const changedCount = [isIdChanged, isNameChanged, isProgChanged, isSemChanged, isStructureChanged, isGroupChanged].filter(Boolean).length;
    hasUnsavedChanges = changedCount > 0;

    // Update Top Student Identity Card
    document.getElementById('topStudentIdBadge').innerText = idVal || 'N/A';
    document.getElementById('topStudentName').innerText = nameVal || 'Unnamed Student';
    document.getElementById('topProgramme').innerText = progVal;
    document.getElementById('topSemester').innerText = semText;
    const topAvatar = document.getElementById('topAvatar');
    if (topAvatar && !topAvatar.querySelector('img')) {
      topAvatar.textContent = getInitials(nameVal);
    }

    // Update Record Overview
    document.getElementById('overviewStudentId').innerText = idVal || 'N/A';
    document.getElementById('overviewProgramme').innerText = progVal;
    document.getElementById('overviewSemester').innerText = semText;

    // Update Unsaved Changes Badge in Identity Card
    const statusBadge = document.getElementById('unsavedStatusBadge');
    const statusText = document.getElementById('unsavedStatusText');
    const saveBtn = document.getElementById('saveChangesBtn');
    const deltaBadge = document.getElementById('deltaBadge');
    const deltaDesc = document.getElementById('deltaDescription');
    const statusBarDot = document.getElementById('statusBarDot');
    const statusBarMsg = document.getElementById('statusBarMessage');

    if (hasUnsavedChanges) {
      // Identity Card Pill
      statusBadge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label font-semibold transition-all duration-200 bg-amber-500/20 text-secondary-fixed border border-secondary-fixed/40';
      statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-secondary-fixed animate-ping"></span><span>Unsaved Changes Pending</span>';

      // Delta Tracker
      deltaBadge.innerText = `${changedCount} Unsaved ${changedCount === 1 ? 'Edit' : 'Edits'}`;
      deltaBadge.className = 'text-[10px] font-mono px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-bold';
      
      let changedLabels = [];
      if (isIdChanged) changedLabels.push('Student ID');
      if (isNameChanged) changedLabels.push('Full Name');
      if (isProgChanged) changedLabels.push('Curriculum Programme');
      if (isSemChanged) changedLabels.push('Semester Cohort');
      if (isStructureChanged) { changedLabels.push('Programme Structure');}
      if (isGroupChanged) changedLabels.push('Class Group');
      deltaDesc.innerHTML = `<span class="font-semibold text-primary">Pending updates:</span> ${changedLabels.join(', ')}.`;

      // Sticky Action Bar
      statusBarDot.style.backgroundColor = '#f59e0b';
      statusBarMsg.innerHTML = '<span class="text-amber-700 font-semibold">Unsaved changes detected</span> (Pending review)';
      saveBtn.disabled = !isValid;
      if (isValid) {
        saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        saveBtn.classList.add('hover:bg-primary', 'hover:shadow-lg', 'cursor-pointer');
      } else {
        saveBtn.classList.add('opacity-50', 'cursor-not-allowed');
        saveBtn.classList.remove('hover:bg-primary', 'hover:shadow-lg', 'cursor-pointer');
      }
    } else {
      // Identity Card Pill
      statusBadge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label font-semibold transition-all duration-200 bg-emerald-950/60 text-emerald-300 border border-emerald-500/30';
      statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span><span>Semua Perubahan Disimpan</span>';

      // Delta Tracker
      deltaBadge.innerText = '0 Edits';
      deltaBadge.className = 'text-[10px] font-mono px-2 py-0.5 rounded bg-surface-container text-on-surface-variant font-medium';
      deltaDesc.innerText = 'No unsaved modifications detected in this active session.';

      // Sticky Action Bar
      statusBarDot.style.backgroundColor = '#10b981';
      statusBarMsg.innerText = 'No unsaved changes.';
      saveBtn.disabled = true;
      saveBtn.classList.add('opacity-50', 'cursor-not-allowed');
      saveBtn.classList.remove('hover:bg-primary', 'hover:shadow-lg', 'cursor-pointer');
    }
  }

  function previewStudentPicture(event) {
    const file = event.target.files && event.target.files[0];
    const preview = document.getElementById('profilePicturePreview');
    if (!file || !preview) return;

    if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
      event.target.value = '';
      triggerNotification('Please choose a JPG, PNG or WebP image.');
      return;
    }
    if (file.size > 2 * 1024 * 1024) {
      event.target.value = '';
      triggerNotification('The profile picture must not exceed 2 MB.');
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      preview.innerHTML = '';
      const img = document.createElement('img');
      img.src = e.target.result;
      img.alt = 'Selected profile picture preview';
      img.className = 'w-full h-full object-cover';
      preview.appendChild(img);

      const topAvatar = document.getElementById('topAvatar');
      if (topAvatar) {
        topAvatar.innerHTML = '';
        const topImg = document.createElement('img');
        topImg.src = e.target.result;
        topImg.alt = 'Student profile picture';
        topImg.className = 'w-full h-full object-cover';
        topAvatar.appendChild(topImg);
      }

      hasUnsavedChanges = true;
      const saveBtn = document.getElementById('saveChangesBtn');
      saveBtn.disabled = false;
      saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
      saveBtn.classList.add('hover:bg-primary', 'hover:shadow-lg', 'cursor-pointer');
      document.getElementById('statusBarDot').style.backgroundColor = '#f59e0b';
      document.getElementById('statusBarMessage').innerText = 'Unsaved changes detected';
      document.getElementById('unsavedStatusText').innerText = 'Unsaved Changes Pending';
    };
    reader.readAsDataURL(file);
  }

  function handleProgrammeChange() {
    const structureSelect = document.getElementById('structure_id');
    const groupSelect = document.getElementById('group_id');

    // Existing structure/group options are scoped to the current programme.
    // Clear them when the programme changes so an incompatible assignment is not submitted.
    if (structureSelect) structureSelect.value = '';
    if (groupSelect) groupSelect.value = '';

    handleInputChange();
  }

  // Toast Notification helper
  function triggerNotification(msg) {
    const toast = document.getElementById('toastNotification');
    const text = document.getElementById('toastMessage');
    if (toast && text) {
      text.innerText = msg;
      toast.classList.remove('translate-y-[-120%]', 'opacity-0');
      toast.classList.add('translate-y-0', 'opacity-100');
      setTimeout(() => {
        toast.classList.add('translate-y-[-120%]', 'opacity-0');
        toast.classList.remove('translate-y-0', 'opacity-100');
      }, 3500);
    }
  }

  // Submit through Laravel so CSRF, validation and the existing controller remain in use.
  function submitStudentRecord() {
    const form = document.getElementById('editStudentForm');
    if (form && form.reportValidity()) form.requestSubmit();
  }

  function handleFormSubmit(e) {
    // Laravel handles the actual update. This helper is retained for template compatibility.
  }

  // Cancel handling with confirmation modal if changes exist
  function handleCancelClick(e) {
    if (e) e.preventDefault();
    if (hasUnsavedChanges) {
      document.getElementById('cancelConfirmModal').classList.remove('hidden');
    } else {
      window.location.href = @json(route('upp.students.index'));
    }
  }

  function closeCancelModal() {
    document.getElementById('cancelConfirmModal').classList.add('hidden');
  }

  function confirmDiscardChanges() {
    document.getElementById('studentId').value = baseline.studentId;
    document.getElementById('studentName').value = baseline.studentName;
    document.getElementById('programme').value = baseline.programme;
    document.getElementById('semester').value = baseline.semester;
    document.getElementById('structure_id').value = baseline.structureId;
    const groupSelect = document.getElementById('group_id');
    if (groupSelect) groupSelect.value = baseline.groupId;
    closeCancelModal();
    window.location.href = @json(route('upp.students.index'));
  }

  function markAdditionalChange() {
    hasUnsavedChanges = true;
    const saveBtn = document.getElementById('saveChangesBtn');
    saveBtn.disabled = false;
    saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    saveBtn.classList.add('hover:bg-primary', 'hover:shadow-lg', 'cursor-pointer');
    document.getElementById('statusBarDot').style.backgroundColor = '#f59e0b';
    document.getElementById('statusBarMessage').innerText = 'Unsaved changes detected';
    document.getElementById('unsavedStatusText').innerText = 'Unsaved Changes Pending';
    document.getElementById('deltaBadge').innerText = 'Unsaved Edits';
    document.getElementById('deltaDescription').innerText = 'Personal information or profile picture has been modified.';
  }

  document.addEventListener('DOMContentLoaded', () => {
    const groupSelect = document.getElementById('group_id');
    if (groupSelect) {
      preferredGroupSection = getGroupSection(groupSelect.selectedOptions[0]);
      groupSelect.addEventListener('change', () => {
        preferredGroupSection = getGroupSection(groupSelect.selectedOptions[0]);
        handleInputChange();
      });
    }
    filterClassGroups();
    handleInputChange();
    document.querySelectorAll('#editStudentForm input[name="email"], #editStudentForm input[name="phone_number"], #editStudentForm textarea[name="home_address"], #editStudentForm input[name^="guardian_"]').forEach((field) => {
      field.addEventListener('input', markAdditionalChange);
      field.addEventListener('change', markAdditionalChange);
    });
  });
</script>
</div></main></div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('uppNotificationsToggle');
  const menu = document.getElementById('uppNotificationsMenu');
  const close = document.getElementById('uppNotificationsClose');
  if (!toggle || !menu) return;
  const setOpen = (open) => { menu.classList.toggle('hidden', !open); toggle.setAttribute('aria-expanded', String(open)); };
  toggle.addEventListener('click', () => setOpen(menu.classList.contains('hidden')));
  if (close) close.addEventListener('click', () => setOpen(false));
  document.addEventListener('click', (event) => { if (!menu.contains(event.target) && !toggle.contains(event.target)) setOpen(false); });
  document.addEventListener('keydown', (event) => { if (event.key === 'Escape') setOpen(false); });
});
</script>
</body></html>