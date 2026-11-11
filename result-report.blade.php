<!DOCTYPE html>

<html class="light" lang="ms"><head><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_dashboard" name="shell-type"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{"colors":{"surface-bright":"#fcf9f8","error":"#ba1a1a","on-background":"#1c1b1b","primary":"#000a1e","on-tertiary-fixed-variant":"#43474b","on-error-container":"#93000a","surface":"#fcf9f8","surface-container-high":"#eae7e7","inverse-primary":"#aec7f6","primary-fixed":"#d6e3ff","secondary-fixed":"#ffe088","secondary-container":"#fed65b","tertiary-fixed-dim":"#c3c7cc","secondary":"#735c00","primary-fixed-dim":"#aec7f6","secondary-fixed-dim":"#e9c349","on-secondary-container":"#745c00","surface-container-low":"#f6f3f2","surface-tint":"#465f88","on-tertiary-container":"#85898e","on-tertiary-fixed":"#181c20","on-secondary-fixed":"#241a00","on-secondary":"#ffffff","on-primary-fixed":"#001b3d","tertiary-container":"#1e2226","on-error":"#ffffff","surface-container-lowest":"#ffffff","surface-variant":"#e5e2e1","inverse-on-surface":"#f3f0ef","on-primary-fixed-variant":"#2d476f","primary-container":"#002147","tertiary":"#070b0f","surface-container-highest":"#e5e2e1","on-surface":"#1c1b1b","on-tertiary":"#ffffff","on-primary-container":"#708ab5","on-secondary-fixed-variant":"#574500","error-container":"#ffdad6","on-primary":"#ffffff","outline":"#74777f","background":"#fcf9f8","surface-container":"#f0eded","surface-dim":"#dcd9d9","inverse-surface":"#313030","tertiary-fixed":"#e0e3e8","outline-variant":"#c4c6cf","on-surface-variant":"#44474e"},"borderRadius":{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},"spacing":{},"fontFamily":{"headline":["Hanken Grotesk"],"display":["Hanken Grotesk"],"body":["\"Source Serif 4\""],"label":["Hanken Grotesk"]},"fontSize":{}}}}</script>
<style>
    .print-only { display: none; }

    @media print {
        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        html, body {
            background: #fff !important;
            color: #111827 !important;
            overflow: visible !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Remove application navigation and screen-only controls. */
        aside, nav, header,
        .pl-72 > footer,
        .no-print,
        button,
        form {
            display: none !important;
        }

        .pl-72 {
            padding-left: 0 !important;
            margin: 0 !important;
        }

        main {
            min-height: 0 !important;
            padding-top: 0 !important;
            background: #fff !important;
        }

        main > div,
        main > div > div {
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .print-only {
            display: block !important;
        }

        /* The report itself is the print document; omit dashboard summaries
           and filters so the result ledger gets the available page space. */
        #results-report-card {
            display: block !important;
            box-shadow: none !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0 !important;
            overflow: visible !important;
            break-inside: auto;
        }

        #results-report-card > div:first-child {
            background: #f3f4f6 !important;
            border-bottom: 1px solid #9ca3af !important;
        }

        #results-report-card > div:nth-child(2) {
            background: #fff !important;
            border-bottom: 1px solid #d1d5db !important;
        }

        #resultsTable {
            width: 100% !important;
            min-width: 0 !important;
            border-collapse: collapse !important;
            white-space: normal !important;
            font-size: 7pt !important;
        }

        #resultsTable thead {
            display: table-header-group;
        }

        #resultsTable tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        #resultsTable th,
        #resultsTable td {
            padding: 5px 4px !important;
            border: 1px solid #d1d5db !important;
            color: #111827 !important;
            background: #fff !important;
            overflow-wrap: anywhere;
        }

        #resultsTable thead th {
            background: #e5e7eb !important;
            color: #111827 !important;
            font-size: 6.5pt !important;
        }

         #results-report-card > div:last-child {
            background: #f9fafb !important;
            border-top: 1px solid #9ca3af !important;
        }

         #report-verification {
            display: block !important;
            margin-top: 10px !important;
            padding: 12px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            break-inside: avoid;
        }

         #report-verification .absolute {
            display: none !important;
        }

        footer {
            display: none !important;
        }

        a {
            color: inherit !important;
            text-decoration: none !important;
        }
    }
</style>
</head><body class="bg-background font-body text-on-surface antialiased">@php
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

@include('upp.partials.sidebar')<div class="pl-72">@include('upp.partials.topbar')<main class="relative pt-20 bg-background min-h-screen"><div class="flex flex-col w-full">
<div class="px-8 py-8 max-w-[1480px] w-full mx-auto space-y-6">
<div class="print-only mb-5 border-b-2 border-gray-800 pb-3">
    <h1 class="text-xl font-bold text-gray-900">KPMB STUDENT HUB</h1>
    <h2 class="mt-1 text-lg font-semibold text-gray-900">Laporan Keputusan Akademik Pelajar</h2>
    <p class="mt-1 text-xs text-gray-700">Unit Pembangunan Pengajian (UPP) &amp; Unit Peperiksaan dan Persijilan</p>
    <div class="mt-3 grid grid-cols-3 gap-3 text-xs text-gray-700">
        <p><strong>Program:</strong> {{ $programme ?: 'Semua Program' }}</p>
        <p><strong>Semester:</strong> {{ $semester ? 'Semester ' . $semester : 'Semua Semester' }}</p>
        <p><strong>Sesi Akademik:</strong> {{ $session ?: 'Semua Sesi' }}</p>
        <p><strong>Kelas:</strong> {{ ($classId ?? '') !== '' ? (($classes ?? collect())->firstWhere('class_id', $classId)?->class_name ?? 'Kelas dipilih') : 'Semua Kelas' }}</p>
        <p><strong>Carian:</strong> {{ $search ?: 'Tiada' }}</p>
        <p><strong>Tarikh Cetakan:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>
<!-- Top Action & Navigation Row -->
<div class="no-print flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
<div class="flex items-center gap-4">
<div class="w-14 h-14 rounded-xl bg-primary-container flex items-center justify-center text-on-primary shadow-md shrink-0">
<span class="material-symbols-outlined text-[30px] text-secondary-fixed">military_tech</span>
</div>
<div class="flex flex-col">
<div class="flex items-center gap-2.5">
<h1 class="font-headline font-bold text-2xl md:text-3xl text-primary tracking-tight">Result Report</h1>
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-headline font-semibold bg-secondary-container text-on-secondary-container">
<span class="material-symbols-outlined text-[13px]">verified</span>
              Laporan Akademik
            </span>
</div>
<p class="font-body text-sm text-on-surface-variant mt-0.5">
            KPMB Student Hub — Unit Pembangunan Pengajian (UPP) &amp; Peperiksaan
          </p>
</div>
</div>
<!-- Action Buttons -->
<div class="flex items-center gap-2.5 self-start md:self-auto">
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-headline font-medium text-on-surface-variant bg-surface-container hover:bg-surface-container-high transition-colors shadow-sm" onclick="history.back()" type="button">
<span class="material-symbols-outlined text-[18px]">arrow_back</span>
<span>Back to Dashboard</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-headline font-medium text-primary bg-surface-container-lowest hover:bg-surface-container-low transition-colors shadow-sm" onclick="exportTableToCSV('KPMB_Result_Report.csv')" type="button">
<span class="material-symbols-outlined text-[18px] text-primary">download</span>
<span>Export CSV</span>
</button>
<button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-xs font-headline font-semibold text-on-primary bg-primary-container hover:bg-primary transition-all shadow-md active:scale-95" onclick="window.print()" type="button">
<span class="material-symbols-outlined text-[18px] text-secondary-fixed">print</span>
<span>Print Report</span>
</button>
</div>
</div>
<!-- Key Metrics / Summary Ribbon (Unified Horizontal Container) -->
<div class="no-print w-full bg-surface-container-lowest rounded-xl shadow-sm p-5 md:p-6">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
<!-- Metric 1: Total Records -->
<div class="flex flex-col pl-2">
<div class="flex items-center gap-2 text-on-surface-variant mb-1">
<span class="material-symbols-outlined text-[18px] text-surface-tint">folder_managed</span>
<span class="text-xs font-headline uppercase tracking-wider font-semibold">Jumlah Rekod Keputusan</span>
</div>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-headline font-bold text-3xl text-primary" id="metric-total-records">{{ $marks->count() }}</span>
<span class="text-xs font-headline font-medium text-on-surface-variant">Submitted Modules</span>
</div>
<div class="w-full bg-surface-container-high h-1.5 rounded-full mt-3 overflow-hidden">
<div class="bg-primary-container h-full rounded-full w-full"></div>
</div>
</div>
<!-- Metric 2: Pelajar dengan Keputusan -->
<div class="flex flex-col pl-2">
<div class="flex items-center gap-2 text-on-surface-variant mb-1">
<span class="material-symbols-outlined text-[18px] text-surface-tint">groups</span>
<span class="text-xs font-headline uppercase tracking-wider font-semibold">Pelajar dengan Keputusan</span>
</div>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-headline font-bold text-3xl text-primary" id="metric-distinct-students">{{ $marks->pluck("student_id")->unique()->count() }}</span>
<span class="text-xs font-headline font-medium text-on-surface-variant">Distinct Candidate</span>
</div>
<div class="w-full bg-surface-container-high h-1.5 rounded-full mt-3 overflow-hidden">
<div class="bg-secondary-container h-full rounded-full w-full"></div>
</div>
</div>
<!-- Metric 3: Purata GPA -->
<div class="flex flex-col pl-2">
<div class="flex items-center gap-2 text-on-surface-variant mb-1">
<span class="material-symbols-outlined text-[18px] text-secondary">workspace_premium</span>
<span class="text-xs font-headline uppercase tracking-wider font-semibold">Purata GPA</span>
</div>
<div class="flex items-baseline gap-2 mt-1">
<span class="font-headline font-bold text-3xl text-primary">{{ number_format(collect($gpaResults)->pluck("gpa")->filter(fn ($v) => $v !== null)->avg() ?? 0, 2) }}</span>
<span class="px-2 py-0.5 rounded text-[11px] font-headline font-semibold bg-secondary-fixed text-on-secondary-fixed">
              High Distinction
            </span>
</div>
<div class="w-full bg-surface-container-high h-1.5 rounded-full mt-3 overflow-hidden">
<div class="bg-secondary h-full rounded-full w-[96%]"></div>
</div>
</div>
<!-- Metric 4: Verification Status -->
<div class="flex flex-col pl-2">
<div class="flex items-center gap-2 text-on-surface-variant mb-1">
<span class="material-symbols-outlined text-[18px] text-secondary">gavel</span>
<span class="text-xs font-headline uppercase tracking-wider font-semibold">Status Rekod</span>
</div>
<div class="flex items-center gap-2 mt-1">
<span class="font-headline font-bold text-2xl text-primary">{{ $marks->count() ? "Tersedia" : "Tiada Data" }}</span>
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-headline font-semibold bg-primary-fixed text-on-primary-fixed">
<span class="material-symbols-outlined text-[14px]">done_all</span>
              Data Keputusan
            </span>
</div>
<div class="w-full bg-surface-container-high h-1.5 rounded-full mt-3 overflow-hidden">
<div class="bg-primary h-full rounded-full w-full"></div>
</div>
</div>
</div>
</div>
<!-- Filter & Search Panel -->
<div class="no-print bg-surface-container-lowest rounded-xl shadow-sm p-6 space-y-4">
<div class="flex items-center justify-between pb-2"><div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[20px]">filter_alt</span><span class="font-headline font-bold text-sm text-primary uppercase tracking-wider">Tapis Rekod Keputusan</span></div><span class="text-[11px] font-headline text-on-surface-variant">{{ $session ?: 'Semua Sesi Akademik' }}</span></div>
<form method="GET" action="{{ route('upp.result-report.index') }}" class="space-y-3">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-3">
<div class="lg:col-span-2 relative"><span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant">search</span><input class="w-full pl-10 pr-4 py-2.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface" name="search" value="{{ $search ?? '' }}" placeholder="Cari ID pelajar, nama atau subjek..." type="text"/></div>
<div><select name="programme" class="w-full px-3 py-2.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface"><option value="">Semua Program</option>@foreach (($programmes ?? collect()) as $item)<option value="{{ $item }}" {{ ($programme ?? '') === $item ? 'selected' : '' }}>{{ $item }}</option>@endforeach</select></div>
<div><select name="semester" class="w-full px-3 py-2.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface"><option value="">Semua Semester</option>@foreach (($semesters ?? collect()) as $item)<option value="{{ $item }}" {{ (string) ($semester ?? '') === (string) $item ? 'selected' : '' }}>Semester {{ $item }}</option>@endforeach</select></div>
<div><select name="session" class="w-full px-3 py-2.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface"><option value="">Semua Sesi</option>@foreach (($sessions ?? collect()) as $item)<option value="{{ $item }}" {{ ($session ?? '') === $item ? 'selected' : '' }}>{{ $item }}</option>@endforeach</select></div>
<div><select name="class_id" class="w-full px-3 py-2.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface"><option value="">Semua Kelas</option>@foreach (($classes ?? collect()) as $item)<option value="{{ $item->class_id }}" {{ (string) ($classId ?? '') === (string) $item->class_id ? 'selected' : '' }}>{{ $item->class_name }}</option>@endforeach</select></div>
</div>
<div class="flex items-center justify-between gap-3 pt-2"><div class="text-xs font-body text-on-surface-variant">Memaparkan <strong class="font-headline font-semibold text-primary">{{ $marks->count() }}</strong> rekod keputusan.</div><div class="flex items-center gap-2"><a href="{{ route('upp.result-report.index') }}" class="px-4 py-2 text-xs font-headline font-medium text-on-surface-variant bg-surface-container rounded-lg">Reset</a><button type="submit" class="px-5 py-2 text-xs font-headline font-semibold text-on-primary bg-primary-container rounded-lg">Tapis Rekod</button></div></div>
</form></div>
<!-- High Fidelity Tabular Presentation of Results -->
<div id="results-report-card" class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<!-- Table Header Bar / Title -->
<div class="px-6 py-4 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-primary-container flex items-center justify-center text-on-primary">
<span class="material-symbols-outlined text-[18px] text-secondary-fixed">fact_check</span>
</div>
<div>
<h2 class="font-headline font-bold text-sm text-primary">Rekod Keputusan Akademik Pelajar</h2>
<p class="font-body text-xs text-on-surface-variant">Senarai markah, gred, nilai mata kredit, GPA dan CGPA pelajar.</p>
</div>
</div>
<div class="flex items-center gap-2">
<span class="px-2.5 py-1 rounded-md text-[11px] font-headline font-semibold bg-surface-container text-on-surface-variant">
            Official Transcript Ledger
          </span>
<span class="px-2.5 py-1 rounded-md text-[11px] font-headline font-semibold bg-secondary-container text-on-secondary-container">
            Sesi 2 2026/2027
          </span>
</div>
</div>
<!-- Reference Image Verification Banner (Subtle Collapsible/Preview Anchor) -->
<div class="px-6 py-2.5 bg-surface-container/60 flex items-center justify-between text-xs font-headline text-on-surface-variant">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
<span>Paparan berdasarkan rekod markah dalam KPMB Student Hub.</span>
</div>
<div class="flex items-center gap-3">
<span class="text-[11px] text-on-surface-variant">Disahkan oleh: <strong>Pendaftar Peperiksaan UPP</strong></span>
<span class="text-outline-variant">•</span>
<span class="text-[11px] text-on-surface-variant">Tarikh Cetak: <strong>{{ now()->format('d/m/Y') }}</strong></span>
</div>
</div>
<!-- Responsive Table Container -->
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse text-xs whitespace-nowrap" id="resultsTable">
<thead>
<tr class="bg-primary-container text-on-primary font-headline font-semibold uppercase text-[11px] tracking-wider select-none">
<th class="py-3.5 px-3 text-center" scope="col">No.</th>
<th class="py-3.5 px-3" scope="col">Student ID</th>
<th class="py-3.5 px-4" scope="col">Student Name</th>
<th class="py-3.5 px-4" scope="col">Programme</th>
<th class="py-3.5 px-3 text-center" scope="col">Sem</th>
<th class="py-3.5 px-3.5" scope="col">Academic Session</th>
<th class="py-3.5 px-3 text-center" scope="col">Subject Code</th>
<th class="py-3.5 px-4" scope="col">Subject Name</th>
<th class="py-3.5 px-3 text-center" scope="col">Credit Hour</th>
<th class="py-3.5 px-3 text-right" scope="col">Marks</th>
<th class="py-3.5 px-3 text-center" scope="col">Grade</th>
<th class="py-3.5 px-3 text-right" scope="col">Grade Point</th>
<th class="py-3.5 px-3 text-right" scope="col">Credit Points</th>
<th class="py-3.5 px-3 text-right" scope="col">GPA</th>
<th class="py-3.5 px-3 text-right" scope="col">CGPA</th>
<th class="py-3.5 px-4 text-center" scope="col">Status</th>
</tr>
</thead>
<tbody class="font-headline divide-y divide-surface-container-high/60 bg-surface-container-lowest" id="resultsTableBody">
@forelse ($marks as $mark)
@php
$key = $mark->student_id . '|' . $mark->academic_session . '|' . ($mark->classModel?->semester ?? 0);
$gpa = $gpaResults[$key]['gpa'] ?? null;
$cgpa = $cgpaResults[$mark->student_id]['cgpa'] ?? null;
@endphp
<tr class="hover:bg-surface-container-low transition-colors duration-150 group">
<td class="py-3.5 px-3 text-center">{{ $loop->iteration }}</td>
<td class="py-3.5 px-3 font-semibold text-primary">{{ $mark->student?->student_id ?? '-' }}</td>
<td class="py-3.5 px-4">{{ $mark->student?->student_name ?? '-' }}</td>
<td class="py-3.5 px-4">{{ $mark->student?->programme ?? '-' }}</td>
<td class="py-3.5 px-3 text-center">{{ $mark->classModel?->semester ?? '-' }}</td>
<td class="py-3.5 px-3.5">{{ $mark->academic_session ?? '-' }}</td>
<td class="py-3.5 px-3 text-center">{{ $mark->subject?->subject_code ?? '-' }}</td>
<td class="py-3.5 px-4">{{ $mark->subject?->subject_name ?? '-' }}</td>
<td class="py-3.5 px-3 text-center">{{ $mark->calculated_credit_hours }}</td>
<td class="py-3.5 px-3 text-right">{{ number_format((float) $mark->marks, 2) }}</td>
<td class="py-3.5 px-3 text-center">{{ $mark->calculated_grade }}</td>
<td class="py-3.5 px-3 text-right">{{ number_format((float) $mark->calculated_grade_point, 2) }}</td>
<td class="py-3.5 px-3 text-right">{{ number_format((float) $mark->calculated_credit_points, 2) }}</td>
<td class="py-3.5 px-3 text-right">{{ $gpa !== null ? number_format($gpa, 2) : '-' }}</td>
<td class="py-3.5 px-3 text-right">{{ $cgpa !== null ? number_format($cgpa, 2) : '-' }}</td>
<td class="py-3.5 px-4 text-center">{{ $mark->calculated_status }}</td>
</tr>
@empty
<tr><td class="py-12 px-6 text-center" colspan="16">Tiada rekod keputusan dijumpai.</td></tr>
@endforelse
</tbody>
</table>
</div>
<!-- Table Summary Footer Totals -->
<div class="px-6 py-4 bg-surface-container-low flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs font-headline">
<div class="flex items-center gap-4 text-on-surface-variant">
<span>Jumlah Jam Kredit Rekod: <strong class="text-primary font-bold">{{ number_format($marks->sum(fn ($m) => (float) $m->calculated_credit_hours), 1) }} Jam</strong></span>
<span>•</span>
<span>Jumlah Nilai Mata: <strong class="text-primary font-bold">{{ number_format($marks->sum(fn ($m) => (float) $m->calculated_credit_points), 2) }}</strong></span>
<span>•</span>
<span>Purata GPA: <strong class="text-secondary font-bold">{{ number_format(collect($gpaResults)->pluck("gpa")->filter(fn ($v) => $v !== null)->avg() ?? 0, 2) }}</strong></span>
</div>
<div class="flex items-center gap-2">
<span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-primary text-on-primary">
            Keputusan Sah &amp; Dimuktamadkan
          </span>
</div>
</div>
</div>
<!-- Statutory Audit & Institutional Ledger Verification Bar -->
<div id="report-verification" class="bg-surface-container-lowest rounded-xl shadow-sm p-6 relative overflow-hidden">
<!-- Decorative background watermark badge -->
<div class="absolute -right-6 -bottom-6 w-36 h-36 rounded-full bg-surface-container-high/40 pointer-events-none flex items-center justify-center">
<span class="material-symbols-outlined text-[72px] text-surface-dim">verified</span>
</div>
<div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
<div class="flex items-start gap-4">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary shrink-0 mt-1">
<span class="material-symbols-outlined text-[26px] text-secondary">security</span>
</div>
<div class="space-y-1">
<div class="flex items-center gap-2">
<span class="font-headline font-bold text-sm text-primary uppercase tracking-wide">
                Unit Pembangunan Pengajian (UPP) Academic Ledger Verification
              </span>
<span class="px-2 py-0.5 rounded text-[10px] font-headline font-semibold bg-surface-container text-on-surface-variant">
                KPMB Student Hub
              </span>
</div>
<p class="font-body text-xs text-on-surface-variant max-w-2xl leading-relaxed">
              Keputusan peperiksaan ini disahkan secara digital oleh Unit Peperiksaan &amp; Pensijilan (UPP) KPMB Student Hub. Segala maklumat transkrip adalah rasmi dan dilindungi di bawah Akta Rahsia Rasmi serta Peraturan Akademik Kolej KPMB.
            </p>
<div class="flex flex-wrap items-center gap-x-4 gap-y-1 pt-1 text-[11px] font-headline text-on-surface-variant">
<span>Pegawai Pengesahan: <strong class="text-primary">Ketua Unit Peperiksaan &amp; Pensijilan</strong></span>
<span>•</span>
<span>Tarikh Cetakan &amp; Audit: <strong class="text-primary">{{ now()->format('d/m/Y H:i:s') }}</strong></span>
<span>•</span>
<span>Integriti Hash: <span class="font-mono text-surface-tint">Rekod sistem</span></span>
</div>
</div>
</div>
<div class="flex items-center gap-3 shrink-0 self-start lg:self-center">
<div class="p-2.5 rounded-lg bg-surface-container flex flex-col items-center justify-center text-center">
<span class="material-symbols-outlined text-secondary text-[24px]">qr_code_2</span>
<span class="text-[9px] font-headline font-medium text-on-surface-variant uppercase mt-0.5">Sijil Digital</span>
</div>
<div class="flex flex-col">
<span class="text-[10px] font-headline uppercase font-semibold text-on-surface-variant tracking-wider">Status Kelulusan</span>
<span class="text-xs font-headline font-bold text-secondary flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-secondary inline-block"></span>
              STATUS: LULUS &amp; TAMAT
            </span>
<span class="text-[10px] font-headline text-on-surface-variant">Unit Pembangunan Pengajian</span>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function exportTableToCSV(filename) {
    const table = document.getElementById('resultsTable');

    if (!table) {
        alert('Jadual laporan tidak ditemui.');
        return;
    }

    const escapeCSV = (value) => {
        const cleaned = String(value ?? '').replace(/\s+/g, ' ').trim();
        return '"' + cleaned.replace(/"/g, '""') + '"';
    };

    const headerCells = Array.from(table.querySelectorAll('thead th'));
    const dataRows = Array.from(table.querySelectorAll('tbody tr'))
        .filter(row => row.querySelectorAll('td').length === headerCells.length);

    if (dataRows.length === 0) {
        alert('Tiada rekod keputusan untuk dieksport.');
        return;
    }

    const rows = [
        headerCells.map(cell => escapeCSV(cell.innerText)).join(','),
        ...dataRows.map(row =>
            Array.from(row.querySelectorAll('td'))
                .map(cell => escapeCSV(cell.innerText))
                .join(',')
        )
    ];

    // UTF-8 BOM improves compatibility when opening the CSV in Microsoft Excel.
    const csvContent = '\uFEFF' + rows.join('\r\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');

    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(url);
}
</script></main><footer class="w-full bg-surface-container-low py-10 shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="w-full px-8 max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6"><div class="flex flex-col gap-1 text-center md:text-left"><div class="flex items-center justify-center md:justify-start gap-2"><span class="font-headline font-bold text-sm text-primary">KPMB Student Hub Academic Collegiate Registry</span><span class="text-xs text-on-surface-variant">•</span><span class="text-xs font-headline font-medium text-on-surface-variant">Unit Peperiksaan dan Persijilan (UPP)</span></div><p class="font-body text-xs text-on-surface-variant">© 2026 Unit Peperiksaan &amp; Persijilan. Hak Cipta Terpelihara.</p></div><div class="flex flex-wrap items-center justify-center gap-4 text-xs font-headline text-on-surface-variant"><a class="hover:text-primary transition-colors" href="{{ route('upp.dashboard') }}">Peraturan Akademik</a><span class="text-outline-variant">•</span><a class="hover:text-primary transition-colors" href="{{ route('upp.dashboard') }}">Dashboard UPP</a><span class="text-outline-variant">•</span><a class="hover:text-primary transition-colors" href="{{ route('upp.dashboard') }}">Bantuan Sistem</a></div></div></footer></div>
</body></html>