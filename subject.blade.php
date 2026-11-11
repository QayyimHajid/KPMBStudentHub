<!DOCTYPE html>

<html lang="en"><head>
<title>Subject Record | KPMB Student Hub</title><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_dashboard" name="shell-type"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&amp;display=swap" rel="stylesheet"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "on-secondary-container": "#745c00", "on-secondary": "#ffffff", "inverse-surface": "#313030", "tertiary": "#070b0f", "on-surface-variant": "#44474e", "primary-container": "#002147", "secondary-fixed": "#ffe088", "on-tertiary-fixed": "#181c20", "on-background": "#1c1b1b", "surface-container-low": "#f6f3f2", "surface-container-high": "#eae7e7", "on-primary": "#ffffff", "on-primary-fixed-variant": "#2d476f", "inverse-primary": "#aec7f6", "on-tertiary-fixed-variant": "#43474b", "tertiary-container": "#1e2226", "surface-variant": "#e5e2e1", "on-error": "#ffffff", "outline-variant": "#c4c6cf", "error": "#ba1a1a", "on-error-container": "#93000a", "secondary-fixed-dim": "#e9c349", "on-tertiary-container": "#85898e", "tertiary-fixed-dim": "#c3c7cc", "surface": "#fcf9f8", "surface-dim": "#dcd9d9", "surface-bright": "#fcf9f8", "primary-fixed-dim": "#aec7f6", "primary": "#000a1e", "on-secondary-fixed-variant": "#574500", "surface-tint": "#465f88", "on-primary-container": "#708ab5", "surface-container-highest": "#e5e2e1", "surface-container-lowest": "#ffffff", "on-secondary-fixed": "#241a00", "surface-container": "#f0eded", "primary-fixed": "#d6e3ff", "secondary-container": "#fed65b", "secondary": "#735c00", "on-surface": "#1c1b1b", "on-tertiary": "#ffffff", "tertiary-fixed": "#e0e3e8", "on-primary-fixed": "#001b3d", "inverse-on-surface": "#f3f0ef", "background": "#fcf9f8", "error-container": "#ffdad6", "outline": "#74777f" }, "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }, "spacing": {}, "fontFamily": { "headline": [ "Hanken Grotesk" ], "display": [ "Hanken Grotesk" ], "body": [ "\"Source Serif 4\"" ], "label": [ "Hanken Grotesk" ] }, "fontSize": {} } } }</script></head><body class="bg-surface font-body text-on-surface min-h-screen relative selection:bg-secondary-container selection:text-primary">@php
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

@include('upp.partials.sidebar')<div class="pl-72 flex flex-col min-h-screen relative">@include('upp.partials.topbar')<main class="w-full pt-16 bg-surface flex-1 px-8 py-8 relative"><div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_80%_60%_at_50%_0%,rgba(254,214,91,0.06),transparent)]"></div><div class="flex flex-col w-full max-w-6xl mx-auto relative z-10">
@if (session('success'))
<div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-label text-emerald-800">{{ session('success') }}</div>
@endif
@if (session('error'))
<div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-label text-red-800">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-label text-red-800"><p class="font-bold mb-1">Please correct the following errors:</p><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<!-- Premium Page Header -->
<div class="mb-8 relative">
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-outline-variant/40 relative">
<div class="flex items-center gap-4">
<div class="w-14 h-14 rounded-xl bg-primary-container border-2 border-secondary/50 flex items-center justify-center shadow-md shadow-primary/10 relative">
<div class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-secondary ring-2 ring-surface"></div>
<span class="material-symbols-outlined text-secondary-container text-3xl">menu_book</span>
</div>
<div>
<div class="flex items-center gap-2 mb-1">
<h1 class="text-3xl lg:text-4xl font-headline font-bold text-primary tracking-tight">Subject Record</h1>
<span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded text-[11px] font-label font-semibold bg-primary/5 text-primary border border-primary/15 uppercase tracking-wide">UPP REGISTRY</span>
</div>
<p class="font-label text-sm text-on-surface-variant">Manage academic subjects and course information</p>
</div>
</div>
<div class="flex items-center gap-2 self-start sm:self-center">
<span class="h-9 px-3.5 rounded bg-surface-container border border-outline-variant/60 text-primary font-label text-xs font-semibold flex items-center gap-1.5 shadow-sm opacity-70" title="Export is not part of the current subject workflow"><span class="material-symbols-outlined text-base text-secondary">file_download</span><span>Export Catalog</span></span>
<span class="h-9 px-3.5 rounded bg-surface-container border border-outline-variant/60 text-primary font-label text-xs font-semibold flex items-center gap-1.5 shadow-sm opacity-70" title="Audit history is not part of the current subject workflow"><span class="material-symbols-outlined text-base text-secondary">history</span><span>Audit History</span></span>
</div>
<div class="absolute bottom-0 left-0 w-32 h-[2px] bg-gradient-to-r from-secondary via-secondary-container to-transparent"></div>
</div>
</div>
<!-- Add New Subject & Overview Cards Section -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8 items-start">
<!-- Left: Add New Subject Form (7 Cols) -->
<section class="lg:col-span-7 bg-surface-container-lowest rounded-xl p-6 lg:p-7 shadow-sm border border-outline-variant/40 relative overflow-hidden">
<div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-container via-secondary to-primary-container"></div>
<div class="flex items-center justify-between mb-5">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container text-xl">library_add</span>
<h2 class="text-xl font-headline font-bold text-primary">Add New Subject</h2>
</div>
<span class="text-xs font-label text-on-surface-variant">All fields required</span>
</div>
<form class="space-y-4" id="addSubjectForm" action="{{ route('upp.subjects.store') }}" method="POST">
@csrf
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div><label class="block font-label text-xs text-on-surface font-semibold mb-1.5 uppercase tracking-wider" for="subjectCode">Subject Code</label><input class="w-full h-10 px-3.5 rounded bg-surface-container-lowest border border-outline-variant text-on-surface font-label text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all" id="subjectCode" name="subject_code" value="{{ old('subject_code') }}" placeholder="e.g. CSC2854" required type="text"/>@error('subject_code')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block font-label text-xs text-on-surface font-semibold mb-1.5 uppercase tracking-wider" for="creditHour">Credit Hour</label><input class="w-full h-10 px-3.5 rounded bg-surface-container-lowest border border-outline-variant text-on-surface font-label text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all" id="creditHour" name="credit_hour" value="{{ old('credit_hour') }}" placeholder="e.g. 3" min="1" required type="number"/>@error('credit_hour')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
</div>
<div><label class="block font-label text-xs text-on-surface font-semibold mb-1.5 uppercase tracking-wider" for="subjectName">Subject Name</label><input class="w-full h-10 px-3.5 rounded bg-surface-container-lowest border border-outline-variant text-on-surface font-label text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all" id="subjectName" name="subject_name" value="{{ old('subject_name') }}" placeholder="e.g. Cybersecurity Fundamentals" required type="text"/>@error('subject_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div><label class="block font-label text-xs text-on-surface font-semibold mb-1.5 uppercase tracking-wider" for="semester">Semester</label><input class="w-full h-10 px-3.5 rounded bg-surface-container-lowest border border-outline-variant text-on-surface font-label text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all" id="semester" name="semester" value="{{ old('semester') }}" placeholder="e.g. 6" min="1" required type="number"/>@error('semester')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block font-label text-xs text-on-surface font-semibold mb-1.5 uppercase tracking-wider" for="status">Status</label><div class="relative"><select class="w-full h-10 pl-3.5 pr-8 rounded bg-surface-container-lowest border border-outline-variant text-on-surface font-label text-sm focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 appearance-none cursor-pointer transition-all" id="status" name="status" required><option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option><option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option></select><span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">expand_more</span></div>@error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
</div>
<div class="pt-2 flex items-center justify-between"><p class="text-[11px] font-label text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-xs text-secondary">verified_user</span> Subject records are saved to the system</p><button class="h-10 px-5 rounded bg-primary-container text-on-primary hover:bg-primary font-label text-sm font-semibold transition-all shadow-sm active:scale-[0.99] flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-secondary" type="submit"><span class="material-symbols-outlined text-[18px]">add_circle</span><span>Add Subject</span></button></div>
</form>
</section>
<!-- Right: 4 Subject Overview Cards (5 Cols) -->
<div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- Card 1: Total Subjects -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-outline-variant/40 relative overflow-hidden flex flex-col justify-between hover:border-secondary/40 transition-colors">
<div class="absolute -right-2 -bottom-2 text-primary/5 pointer-events-none">
<span class="material-symbols-outlined text-7xl">subject</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="text-xs font-label uppercase tracking-wider font-semibold text-on-surface-variant">Total Subjects</span>
<span class="p-1.5 rounded-lg bg-surface-container text-secondary flex items-center justify-center">
<span class="material-symbols-outlined text-base">auto_stories</span>
</span>
</div>
<div>
<div class="text-2xl lg:text-3xl font-headline font-bold text-primary">{{ $subjects->total() }} Subjects</div>
<div class="flex items-center gap-1 text-[11px] font-label text-on-surface-variant mt-1 font-medium"><span class="material-symbols-outlined text-xs">database</span><span>Total matching records</span></div>
</div>
</div>
<!-- Card 2: Total Programmes -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-outline-variant/40 relative overflow-hidden flex flex-col justify-between hover:border-secondary/40 transition-colors">
<div class="absolute -right-2 -bottom-2 text-primary/5 pointer-events-none">
<span class="material-symbols-outlined text-7xl">school</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="text-xs font-label uppercase tracking-wider font-semibold text-on-surface-variant">Total Programmes</span>
<span class="p-1.5 rounded-lg bg-surface-container text-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-base">account_balance</span>
</span>
</div>
<div>
<div class="text-2xl lg:text-3xl font-headline font-bold text-primary">{{ $subjects->getCollection()->pluck('semester')->filter()->unique()->count() }}</div>
<div class="flex items-center gap-1 text-[11px] font-label text-on-surface-variant mt-1"><span>Semesters on this page</span></div>
</div>
</div>
<!-- Card 3: Total Credit Hours -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-outline-variant/40 relative overflow-hidden flex flex-col justify-between hover:border-secondary/40 transition-colors">
<div class="absolute -right-2 -bottom-2 text-primary/5 pointer-events-none">
<span class="material-symbols-outlined text-7xl">grade</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="text-xs font-label uppercase tracking-wider font-semibold text-on-surface-variant">Total Credit Hours</span>
<span class="p-1.5 rounded-lg bg-secondary-container/20 text-secondary flex items-center justify-center">
<span class="material-symbols-outlined text-base">award_star</span>
</span>
</div>
<div>
<div class="text-2xl lg:text-3xl font-headline font-bold text-primary">{{ $subjects->getCollection()->sum('credit_hour') }} CH</div>
<div class="flex items-center gap-1 text-[11px] font-label text-on-surface-variant mt-1"><span>Credit hours on this page</span></div>
</div>
</div>
<!-- Card 4: Recently Added -->
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-outline-variant/40 relative overflow-hidden flex flex-col justify-between border-l-4 border-l-secondary hover:border-secondary/40 transition-colors">
<div class="flex items-center justify-between mb-1.5">
<span class="text-xs font-label uppercase tracking-wider font-semibold text-secondary">Recently Added</span>
<span class="px-1.5 py-0.5 rounded text-[10px] font-label font-bold uppercase bg-surface-container text-primary">New</span>
</div>
<div>
<div class="font-headline font-bold text-sm text-primary leading-tight">{{ $subjects->getCollection()->last() ? $subjects->getCollection()->last()->subject_name : 'No records yet' }}</div>
<div class="text-[11px] font-label text-on-surface-variant mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs text-outline">schedule</span><span>Latest record on this page</span></div>
</div>
</div>
</div>
</div>
<!-- Search & Filter Panel (Elevated Card) -->
<section class="bg-surface-container-lowest rounded-xl p-4 lg:p-5 shadow-sm border border-outline-variant/40 mb-6">
<form action="{{ route('upp.subjects.index') }}" method="GET" id="subjectSearchForm">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-lg">tune</span>
<h3 class="font-headline font-bold text-sm text-primary">Search &amp; Catalog Filters</h3>
</div>
<div class="text-xs font-label text-on-surface-variant">
Search subject code or name
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
<!-- Search Input (5 Cols) -->
<div class="md:col-span-4 relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
<input class="w-full h-10 pl-9 pr-3 rounded bg-surface border border-outline-variant text-on-surface placeholder:text-on-surface-variant/70 font-label text-xs focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all" id="searchInput" name="search" value="{{ $search }}" placeholder="Search by subject code or name..." type="text"/>
</div>
<div class="md:col-span-3 relative">
<select name="programme" class="w-full h-10 px-3 rounded bg-surface border border-outline-variant text-on-surface font-label text-xs focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all">
<option value="">All Programmes</option>
@foreach ($programmes as $programmeOption)
<option value="{{ $programmeOption->programme_code }}" @selected($programme === $programmeOption->programme_code)>{{ $programmeOption->programme_code }} — {{ $programmeOption->programme_name }}</option>
@endforeach
</select>
</div>
<div class="md:col-span-2 relative">
<select name="semester" class="w-full h-10 px-3 rounded bg-surface border border-outline-variant text-on-surface font-label text-xs focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all">
<option value="">All Semesters</option>
@foreach ($semesters as $semesterOption)
<option value="{{ $semesterOption }}" @selected((string) $semester === (string) $semesterOption)>Semester {{ $semesterOption }}</option>
@endforeach
</select>
</div>
<!-- Action Buttons (3 Cols) -->
<div class="md:col-span-3 flex items-center justify-end gap-2">
<button class="h-10 px-4 rounded bg-primary-container hover:bg-primary text-on-primary font-label text-xs font-semibold transition-all shadow-sm flex items-center justify-center gap-1 w-full md:w-auto" id="searchBtn" type="submit">
<span class="material-symbols-outlined text-sm">filter_alt</span>
<span>Filter</span>
</button>
<a class="h-10 px-3 flex items-center text-secondary hover:text-primary font-label text-xs font-semibold underline transition-colors whitespace-nowrap" id="clearBtn" href="{{ route('upp.subjects.index') }}">Clear</a>
</div>
</div>
</form>
</section>
<!-- More Lively Primary Subject Table -->
<section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/40 overflow-hidden mb-4">
<div class="overflow-x-auto">
<table class="w-full text-left font-label text-sm border-collapse" id="subjectsTable">
<thead>
<tr class="border-b border-outline-variant/60 bg-surface-container-low/80">
<th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider border-r border-outline-variant/30 w-36">Subject Code</th>
<th class="py-3.5 px-5 font-headline font-bold text-primary text-xs uppercase tracking-wider border-r border-outline-variant/30">Subject Name &amp; Classification</th>
<th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider border-r border-outline-variant/30 text-center w-36">Credit Hour</th>
<th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider border-r border-outline-variant/30 text-center w-28">Semester</th>
<th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider border-r border-outline-variant/30 text-center w-28">Status</th>
<th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider text-center w-48">Course Coordinator</th><th class="py-3.5 px-4 font-headline font-bold text-primary text-xs uppercase tracking-wider text-center w-36">Action</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30 text-on-surface">
@forelse ($subjects as $subject)
<tr class="hover:bg-amber-50/40 transition-colors group">
<td class="py-3.5 px-4 font-semibold text-primary border-r border-outline-variant/30"><div class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-secondary"></span><span class="font-mono text-xs font-bold text-primary group-hover:text-secondary transition-colors">{{ $subject->subject_code }}</span></div></td>
<td class="py-3.5 px-5 border-r border-outline-variant/30"><div class="flex items-center gap-2.5"><div class="w-7 h-7 rounded bg-surface-container flex items-center justify-center text-primary-container flex-shrink-0"><span class="material-symbols-outlined text-[17px]">menu_book</span></div><div><div class="font-medium text-primary leading-tight">{{ $subject->subject_name }}</div><div class="flex items-center gap-1.5 mt-0.5"><span class="px-1.5 py-0.5 rounded text-[9px] font-bold tracking-wider uppercase bg-primary/10 text-primary">SUBJECT</span><span class="text-[11px] text-on-surface-variant font-normal">Semester {{ $subject->semester }}</span></div></div></div></td>
<td class="py-3.5 px-4 border-r border-outline-variant/30 text-center"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-surface-container text-on-surface border border-outline-variant/40">{{ $subject->credit_hour }} {{ $subject->credit_hour == 1 ? 'Credit' : 'Credits' }}</span></td>
<td class="py-3.5 px-4 border-r border-outline-variant/30 text-center"><span class="font-medium text-on-surface">Sem {{ $subject->semester }}</span></td>
<td class="py-3.5 px-4 border-r border-outline-variant/30 text-center">@if (strtolower($subject->status) === 'active')<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Active</span>@else<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-surface-container text-on-surface-variant border border-outline-variant/50"><span class="w-1.5 h-1.5 rounded-full bg-outline"></span>{{ ucfirst($subject->status) }}</span>@endif</td>
<td class="py-3.5 px-4 border-r border-outline-variant/30 text-center">@if ($subject->coordinatorLecturer)<div class="text-xs font-semibold text-primary">{{ $subject->coordinatorLecturer->name }}</div><div class="text-[10px] text-on-surface-variant">{{ $subject->coordinatorLecturer->lecturer_id }}</div>@else<span class="inline-flex px-2 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-semibold">Not assigned</span>@endif</td><td class="py-3.5 px-4 text-center"><div class="inline-flex items-center gap-1.5 justify-center"><a href="{{ route('upp.subjects.edit', $subject->subject_id) }}" class="px-2.5 py-1 rounded-full bg-surface-container hover:bg-surface-container-high text-primary font-medium text-xs border border-outline-variant/60 transition-colors flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">edit</span><span>Edit</span></a><form action="{{ route('upp.subjects.destroy', $subject->subject_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subject?')">@csrf @method('DELETE')<button type="submit" class="px-2.5 py-1 rounded-full bg-surface-container hover:bg-error-container hover:text-error text-on-surface-variant font-medium text-xs border border-outline-variant/60 transition-colors flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">delete</span><span>Delete</span></button></form></div></td>
</tr>
@empty
<tr><td colspan="7" class="py-8 px-4 text-center text-sm text-on-surface-variant">No subject records found.</td></tr>
@endforelse
</tbody>
</table>
</div>
<!-- Pagination Controls -->
<div class="px-5 py-3.5 bg-surface-container-low/60 border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-label">
<div class="text-on-surface-variant">Showing <span class="font-bold text-primary">{{ $subjects->firstItem() ?? 0 }}</span> to <span class="font-bold text-primary">{{ $subjects->lastItem() ?? 0 }}</span> of <span class="font-bold text-primary">{{ $subjects->total() }}</span> Subjects</div>
<div class="text-xs">{{ $subjects->appends(request()->query())->links() }}</div>
</div>
</section>
</div>
</main><footer class="w-full bg-surface-container-low py-6 px-8 border-t border-outline-variant/30 shadow-[0_-1px_6px_rgba(0,10,30,0.02)]"><div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-label text-on-surface-variant"><div class="flex flex-col sm:flex-row items-center gap-2"><span>© {{ date('Y') }} KPMB Student Hub. All rights reserved.</span><span class="hidden sm:inline text-outline">•</span><span class="font-medium text-primary">Academic Management • KPMB — Examination &amp; Certification Unit (UPP)</span></div><div class="flex items-center gap-6"><span class="">Subject Management</span><span class="">Records Protected</span><span class="">Authorized Access Only</span></div></div></footer></div>
<script>
  // Submit search to Laravel so pagination and search stay in sync.
  const searchInput = document.getElementById('searchInput');
  const searchForm = document.getElementById('subjectSearchForm');
  const searchBtn = document.getElementById('searchBtn');
  if (searchInput && searchForm && searchBtn) {
    searchInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') searchForm.requestSubmit();
    });
  }
</script>
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