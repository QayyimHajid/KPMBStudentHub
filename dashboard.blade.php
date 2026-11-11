<!DOCTYPE html>
<html lang="ms">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Lecturer | KPMB Student Hub</title>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@300;400;500;600;700;800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
tailwind.config={theme:{extend:{colors:{
"primary":"#002147","primary-container":"#001633","on-primary":"#ffffff",
"secondary":"#735c00","secondary-container":"#fed65b","secondary-fixed":"#ffe088",
"surface":"#fcf9f8","surface-container-lowest":"#ffffff","surface-container-low":"#f6f3f2",
"surface-container":"#f0eded","surface-container-high":"#eae7e7","surface-container-highest":"#e5e2e1",
"on-surface":"#1c1b1b","on-surface-variant":"#44474e","outline":"#74777f",
"outline-variant":"#c4c6cf","error":"#ba1a1a","error-container":"#ffdad6",
"academic-gold":"#b38808","academic-gold-soft":"#fdf7e7","academic-navy":"#002147","academic-navy-light":"#0a2f5c"
},fontFamily:{headline:["Hanken Grotesk","sans-serif"],body:["Source Serif 4","serif"],label:["Hanken Grotesk","sans-serif"],sans:["Hanken Grotesk","sans-serif"]},borderRadius:{"DEFAULT":"0.375rem","lg":"0.5rem","xl":"0.75rem","2xl":"1rem","full":"9999px"}}}};
</script>
<style>
html,body{margin:0;padding:0;font-family:'Hanken Grotesk',sans-serif}
body{overscroll-behavior:none}
::-webkit-scrollbar{display:none}
</style>
</head>
<body class="bg-surface text-on-surface antialiased font-sans selection:bg-secondary-fixed selection:text-secondary">
@php
    $user = auth()->user();
@endphp

@include('lecturer.partials.sidebar')

<div class="pl-72">
    <!-- Top Header -->
    @include('lecturer.partials.topbar')

    <main class="relative pt-20 w-full min-h-screen bg-surface">
        <div class="px-8 py-8 max-w-[1440px] mx-auto w-full flex flex-col gap-8">
            <!-- Welcome panel -->
            <div class="bg-surface-container-lowest border border-surface-container-high/70 rounded-xl p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
                <div class="flex flex-col gap-2 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded bg-secondary-fixed/50 text-secondary text-xs font-label font-bold uppercase tracking-wider w-fit"><span class="material-symbols-outlined text-[14px]">verified</span> KPMB Student Hub • Lecturer Portal</div>
                    <h1 class="text-3xl font-headline font-extrabold text-primary tracking-tight">Dashboard Lecturer &amp; Mentor</h1>
                    <p class="text-base font-body text-on-surface">Selamat datang, <strong class="font-bold text-primary">{{ $user->name ?? 'Lecturer' }}</strong>.</p>
                    <p class="text-sm font-body text-on-surface-variant leading-relaxed">Dashboard ini membantu anda mengurus pendaftaran subjek mentee, mengakses kelas yang ditugaskan, merekod markah dan menyemak prestasi akademik pelajar.</p>
                </div>
                <div class="flex flex-col sm:flex-row md:flex-col gap-3 shrink-0">
                    <a href="{{ route('lecturer.subject-registrations.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white hover:bg-academic-navy-light font-label text-sm font-bold shadow-sm transition-all"><span class="material-symbols-outlined text-[18px] text-secondary-fixed">how_to_reg</span>Semak Pendaftaran Mentee</a>
                    <a href="{{ route('lecturer.record-marks.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-surface-container-low border border-surface-container-high hover:bg-surface-container text-primary font-label text-sm font-semibold transition-all"><span class="material-symbols-outlined text-[18px]">edit_document</span>Rekod Markah Pelajar</a>
                </div>
            </div>

            <!-- Summary cards: counts are intentionally linked to actual pages rather than fabricated figures -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <a href="{{ route('lecturer.student-records.index') }}" class="bg-surface-container-lowest border border-surface-container-high/70 rounded-xl p-5 shadow-sm flex flex-col gap-3 hover:border-primary/30 transition-all">
                    <div class="flex items-center justify-between"><span class="font-label text-xs font-bold uppercase tracking-wider text-outline">Student Records</span><div class="w-9 h-9 rounded-lg bg-surface-container-low flex items-center justify-center text-primary"><span class="material-symbols-outlined text-[20px]">supervisor_account</span></div></div>
                    <div class="font-headline text-xl font-bold text-primary">View Students</div><span class="font-label text-xs text-on-surface-variant">Access available student records</span>
                </a>
                <a href="{{ route('lecturer.subject-registrations.index') }}" class="bg-surface-container-lowest border border-secondary/40 rounded-xl p-5 shadow-sm flex flex-col gap-3 hover:border-secondary transition-all">
                    <div class="flex items-center justify-between"><span class="font-label text-xs font-bold uppercase tracking-wider text-secondary">Subject Registrations</span><div class="w-9 h-9 rounded-lg bg-secondary-fixed/40 flex items-center justify-center text-secondary"><span class="material-symbols-outlined text-[20px]">pending_actions</span></div></div>
                    <div class="font-headline text-xl font-bold text-primary">Review Requests</div><span class="font-label text-xs text-on-surface-variant">Review mentee registration requests</span>
                </a>
                <a href="{{ route('lecturer.record-marks.index') }}" class="bg-surface-container-lowest border border-surface-container-high/70 rounded-xl p-5 shadow-sm flex flex-col gap-3 hover:border-primary/30 transition-all">
                    <div class="flex items-center justify-between"><span class="font-label text-xs font-bold uppercase tracking-wider text-outline">Marks Entry</span><div class="w-9 h-9 rounded-lg bg-surface-container-low flex items-center justify-center text-primary"><span class="material-symbols-outlined text-[20px]">fact_check</span></div></div>
                    <div class="font-headline text-xl font-bold text-primary">Record Marks</div><span class="font-label text-xs text-on-surface-variant">Enter marks for your assigned classes</span>
                </a>
                <a href="{{ route('lecturer.performance-report.index') }}" class="bg-surface-container-lowest border border-surface-container-high/70 rounded-xl p-5 shadow-sm flex flex-col gap-3 hover:border-primary/30 transition-all">
                    <div class="flex items-center justify-between"><span class="font-label text-xs font-bold uppercase tracking-wider text-outline">Class Performance</span><div class="w-9 h-9 rounded-lg bg-surface-container-low flex items-center justify-center text-primary"><span class="material-symbols-outlined text-[20px]">analytics</span></div></div>
                    <div class="font-headline text-xl font-bold text-primary">View Reports</div><span class="font-label text-xs text-on-surface-variant">Review class and student performance</span>
                </a>
            </div>

            <!-- Quick Actions -->
            <section class="flex flex-col gap-4">
                <div class="flex items-center justify-between"><div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[20px]">bolt</span><h2 class="text-lg font-headline font-bold text-primary">Quick Actions &amp; Workflows</h2></div><span class="font-label text-xs text-outline">Core academic lecturer modules</span></div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('lecturer.record-marks.index') }}" class="bg-surface-container-lowest hover:bg-surface-container-low border border-surface-container-high/70 hover:border-surface-container-high p-5 rounded-xl flex flex-col gap-3 transition-all shadow-sm group"><div class="w-10 h-10 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-secondary-fixed text-primary flex items-center justify-center transition-colors"><span class="material-symbols-outlined text-[22px]">calendar_month</span></div><div class="flex flex-col gap-1"><span class="font-headline font-bold text-base text-primary">My Classes &amp; Marks</span><span class="font-body text-xs text-on-surface-variant leading-relaxed">Open your assigned classes and mark-entry pages.</span></div></a>
                    <a href="{{ route('lecturer.subject-registrations.index') }}" class="bg-surface-container-lowest hover:bg-surface-container-low border border-surface-container-high/70 hover:border-surface-container-high p-5 rounded-xl flex flex-col gap-3 transition-all shadow-sm group"><div class="w-10 h-10 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-secondary-fixed text-primary flex items-center justify-center transition-colors"><span class="material-symbols-outlined text-[22px]">how_to_reg</span></div><div class="flex flex-col gap-1"><span class="font-headline font-bold text-base text-primary">Mentee Registrations</span><span class="font-body text-xs text-on-surface-variant leading-relaxed">Semak permohonan pendaftaran subjek mentee.</span></div></a>
                    <a href="{{ route('lecturer.record-marks.index') }}" class="bg-surface-container-lowest hover:bg-surface-container-low border border-surface-container-high/70 hover:border-surface-container-high p-5 rounded-xl flex flex-col gap-3 transition-all shadow-sm group"><div class="w-10 h-10 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-secondary-fixed text-primary flex items-center justify-center transition-colors"><span class="material-symbols-outlined text-[22px]">edit_document</span></div><div class="flex flex-col gap-1"><span class="font-headline font-bold text-base text-primary">Record Student Marks</span><span class="font-body text-xs text-on-surface-variant leading-relaxed">Record marks for classes assigned to you.</span></div></a>
                    <a href="{{ route('lecturer.performance-report.index') }}" class="bg-surface-container-lowest hover:bg-surface-container-low border border-surface-container-high/70 hover:border-surface-container-high p-5 rounded-xl flex flex-col gap-3 transition-all shadow-sm group"><div class="w-10 h-10 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-secondary-fixed text-primary flex items-center justify-center transition-colors"><span class="material-symbols-outlined text-[22px]">analytics</span></div><div class="flex flex-col gap-1"><span class="font-headline font-bold text-base text-primary">Class Performance Report</span><span class="font-body text-xs text-on-surface-variant leading-relaxed">Review academic performance for permitted classes.</span></div></a>
                </div>
            </section>

            <!-- Recent activity panel: keep it factual and avoid invented student records -->
            <section class="bg-surface-container-lowest border border-surface-container-high/70 rounded-xl shadow-sm flex flex-col overflow-hidden">
                <div class="px-6 py-5 border-b border-surface-container-high/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex flex-col gap-1"><div class="flex items-center gap-2"><h3 class="font-headline text-lg font-bold text-primary">Academic Management Overview</h3></div><p class="font-body text-xs text-on-surface-variant">Pilih modul di bawah untuk meneruskan tugasan akademik anda.</p></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                    <a href="{{ route('lecturer.subject-registrations.index') }}" class="flex items-start gap-3 p-4 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-primary">assignment_turned_in</span><span><span class="block font-bold text-sm text-primary">Registration Review</span><span class="block text-xs text-on-surface-variant mt-1">Semak permohonan dan status pendaftaran.</span></span></a>
                    <a href="{{ route('lecturer.student-records.index') }}" class="flex items-start gap-3 p-4 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-primary">groups</span><span><span class="block font-bold text-sm text-primary">Student Records</span><span class="block text-xs text-on-surface-variant mt-1">Lihat rekod pelajar yang boleh diakses.</span></span></a>
                    <a href="{{ route('lecturer.performance-report.index') }}" class="flex items-start gap-3 p-4 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-primary">query_stats</span><span><span class="block font-bold text-sm text-primary">Performance Report</span><span class="block text-xs text-on-surface-variant mt-1">Semak laporan prestasi kelas.</span></span></a>
                </div>
            </section>
            <footer class="text-center text-xs text-outline pb-2">KPMB Student Hub · Lecturer Portal</footer>
        </div>
    </main>
</div>
</body>
</html>
