<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer | KPMB Student Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        outline: '#74777f',
                        'surface-container-highest': '#e5e2e1',
                        'surface': '#fcf9f8',
                        'surface-container': '#f0eded',
                        'secondary': '#735c00',
                        'primary-container': '#002147',
                        'secondary-container': '#fed65b',
                        'surface-container-low': '#f6f3f2',
                        'error': '#ba1a1a',
                        'error-container': '#ffdad6',
                        'primary': '#000a1e',
                        'surface-container-lowest': '#ffffff',
                        'on-primary': '#ffffff',
                        'on-surface': '#1c1b1b',
                        'on-surface-variant': '#44474e',
                        'outline-variant': '#c4c6cf',
                        'on-secondary-container': '#745c00',
                        'secondary-fixed': '#ffe088'
                    },
                    fontFamily: {
                        headline: ['Hanken Grotesk'],
                        display: ['Hanken Grotesk'],
                        body: ['Source Serif 4'],
                        label: ['Hanken Grotesk']
                    }
                }
            }
        };
    </script>
    <style>
        html, body { margin: 0; padding: 0; }
        body { overscroll-behavior: none; }
        ::-webkit-scrollbar { display: none; }
        .ambient-orb { position: absolute; border-radius: 9999px; filter: blur(2px); pointer-events: none; will-change: transform; }
        .orb-one { width: 18rem; height: 18rem; top: 5%; right: 4%; background: radial-gradient(circle, rgba(254,214,91,.20) 0%, rgba(254,214,91,0) 72%); animation: float-one 17s ease-in-out infinite; }
        .orb-two { width: 24rem; height: 24rem; left: 4%; bottom: 1%; background: radial-gradient(circle, rgba(0,33,71,.09) 0%, rgba(0,33,71,0) 72%); animation: float-two 21s ease-in-out infinite; }
        .orb-three { width: 12rem; height: 12rem; right: 35%; bottom: 12%; background: radial-gradient(circle, rgba(115,92,0,.08) 0%, rgba(115,92,0,0) 72%); animation: float-one 24s ease-in-out infinite reverse; }
        @keyframes float-one { 0%,100% { transform: translate3d(0,0,0); } 50% { transform: translate3d(-18px,22px,0); } }
        @keyframes float-two { 0%,100% { transform: translate3d(0,0,0); } 50% { transform: translate3d(20px,-18px,0); } }
        @media (prefers-reduced-motion: reduce) { .ambient-orb { animation: none !important; } }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen">
    <!-- Sidebar: same visual structure as the supplied RegisCert template, adapted for KPMB UPP -->
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

    <div class="pl-72 flex flex-col min-h-screen">
        @include('upp.partials.topbar')

        <main class="relative isolate w-full pt-16 bg-surface flex-1 px-8 py-8 overflow-hidden">
            <!-- Soft animated background decoration. Kept behind content and intentionally subtle. -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10" aria-hidden="true">
                <div class="ambient-orb orb-one"></div><div class="ambient-orb orb-two"></div><div class="ambient-orb orb-three"></div>
                <div class="absolute inset-0 opacity-[0.18]" style="background-image: radial-gradient(rgba(0,10,30,.13) .6px, transparent .6px); background-size: 22px 22px;"></div>
            </div>

            <div class="relative z-10 flex flex-col w-full max-w-7xl mx-auto">
                <!-- Page title and actions follow the supplied edit-page layout -->
                <div class="w-full mb-8">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-xs font-label text-on-surface-variant">
                                <span>KPMB Student Hub</span><span class="material-symbols-outlined text-xs text-outline">chevron_right</span>
                                <span>Manage Lecturers</span><span class="material-symbols-outlined text-xs text-outline">chevron_right</span>
                                <span class="text-primary font-semibold">Edit {{ $lecturer->lecturer_id }}</span>
                            </div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <h1 class="font-headline font-bold text-2xl md:text-3xl text-primary tracking-tight">Edit Lecturer Record</h1>
                                <span class="px-2.5 py-0.5 rounded-full bg-secondary-container/30 text-on-secondary-container text-xs font-label font-semibold flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>Update Existing Record</span>
                            </div>
                            <p class="font-body text-sm text-on-surface-variant max-w-2xl mt-1">Review and update the lecturer's registered details. The lecturer ID is read-only.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('upp.lecturers.index') }}" class="px-4 py-2.5 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high font-label text-xs font-semibold tracking-wide flex items-center gap-2 transition-all"><span class="material-symbols-outlined text-base">arrow_back</span><span>Back to Lecturer List</span></a>
                            <button type="submit" form="lecturerForm" class="relative group overflow-hidden px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label text-xs font-semibold tracking-wide shadow-md hover:shadow-lg transition-all flex items-center gap-2"><span class="absolute inset-0 w-1/2 h-full bg-white/10 -skew-x-12 -translate-x-full group-hover:translate-x-[300%] transition-transform duration-1000 ease-out"></span><span class="material-symbols-outlined text-base text-secondary-fixed">save</span><span>Update Record</span></button>
                        </div>
                    </div>

                    <!-- Quick status strip -->
                    <div class="w-full bg-surface-container-lowest rounded-xl p-4 shadow-sm flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-primary text-secondary-container flex items-center justify-center shadow-sm ring-2 ring-surface-container overflow-hidden">@if ($lecturer->directory_photo_url)<img src="{{ $lecturer->directory_photo_url }}" alt="{{ $lecturer->lecturer_name }}" class="w-full h-full object-cover" loading="lazy">@else<span class="material-symbols-outlined text-3xl">person</span>@endif</div>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2 flex-wrap"><span class="font-headline font-bold text-base text-primary">{{ $lecturer->lecturer_name }}</span><span class="px-2 py-0.5 rounded text-[10px] font-label font-bold uppercase tracking-wider bg-surface-container text-on-surface-variant">Lecturer</span></div>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-on-surface-variant mt-0.5"><span class="font-mono text-[11px] font-medium text-secondary">ID: {{ $lecturer->lecturer_id }}</span><span>•</span><span>{{ $lecturer->department }}</span><span>•</span><span class="flex items-center gap-1 text-[11px]"><span class="w-1.5 h-1.5 rounded-full {{ optional($lecturer->user)->status === 'active' ? 'bg-secondary' : 'bg-outline' }}"></span>{{ $lecturer->user->status ?? 'No linked account' }}</span></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 p-1 bg-surface-container rounded-lg"><span class="px-3 py-1.5 rounded-md text-xs font-label font-semibold bg-surface-container-lowest text-primary shadow-sm">Edit Mode</span><span class="px-3 py-1.5 text-xs font-label font-medium text-on-surface-variant">Lecturer Details</span></div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-5 rounded-lg border border-secondary/20 bg-secondary-container/20 px-4 py-3 text-sm font-label text-on-secondary-container flex items-start gap-2"><span class="material-symbols-outlined text-lg">check_circle</span><span>{{ session('success') }}</span></div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-error/20 bg-error-container/40 px-4 py-3 text-sm font-label text-error" role="alert">
                        <div class="flex items-center gap-2 font-bold mb-2"><span class="material-symbols-outlined text-lg">error</span>Please correct the following errors:</div>
                        <ul class="list-disc pl-6 space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <!-- Main bento layout: form on left, contextual summary on right -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full">
                    <div class="lg:col-span-7 flex flex-col gap-6">
                        <section class="w-full bg-surface-container-lowest rounded-xl p-6 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-secondary-container via-secondary to-primary-container"></div>
                            <div class="flex items-center justify-between gap-4 pb-4 mb-6 border-b border-surface-container">
                                <div><h2 class="font-headline font-bold text-lg text-primary">Core Identity &amp; Contact Details</h2><p class="font-body text-xs text-on-surface-variant mt-0.5">Update the lecturer information stored in the KPMB registry.</p></div>
                                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-container text-[11px] font-label font-medium text-on-surface shrink-0"><span class="material-symbols-outlined text-xs text-secondary">lock</span><span>Lecturer ID Locked</span></div>
                            </div>

                            <form id="lecturerForm" action="{{ route('upp.lecturers.update', $lecturer->lecturer_id) }}" method="POST" class="space-y-5">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1.5">
                                        <label class="block font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant" for="lecturer_id">Lecturer ID</label>
                                        <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container text-on-surface font-mono text-xs font-bold cursor-not-allowed" id="lecturer_id" value="{{ $lecturer->lecturer_id }}" readonly>
                                        <span class="text-[10px] text-on-surface-variant block font-label">Unique registry identifier; cannot be changed.</span>
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="block font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant" for="department">Department <span class="text-error">*</span></label>
                                        <select class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-on-surface font-label text-sm focus:bg-surface-container-lowest focus:ring-2 focus:ring-secondary/40 outline-none transition-all" id="department" name="department" required>
    <option value="">Select department</option>
    @foreach ($departments as $departmentOption)
        <option value="{{ $departmentOption }}" @selected(old('department', $lecturer->department) === $departmentOption)>{{ $departmentOption }}</option>
    @endforeach
</select>
                                        @error('department')<span class="text-[11px] text-error font-label">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant" for="lecturer_name">Lecturer Name <span class="text-error">*</span></label>
                                    <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-on-surface font-label text-sm font-semibold focus:bg-surface-container-lowest focus:ring-2 focus:ring-secondary/40 outline-none transition-all" id="lecturer_name" name="lecturer_name" type="text" maxlength="100" value="{{ old('lecturer_name', $lecturer->lecturer_name) }}" required>
                                    <div class="flex items-center justify-between gap-3 text-[11px] text-on-surface-variant"><span>Enter the lecturer's full registered name.</span><span>Required field</span></div>
                                    @error('lecturer_name')<span class="text-[11px] text-error font-label">{{ $message }}</span>@enderror
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1.5">
                                        <label class="block font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant" for="email">Email Address <span class="text-error">*</span></label>
                                        <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-on-surface font-label text-xs focus:bg-surface-container-lowest focus:ring-2 focus:ring-secondary/40 outline-none transition-all" id="email" name="email" type="email" maxlength="100" value="{{ old('email', $lecturer->email) }}" required>
                                        <span class="text-[10px] text-on-surface-variant block font-label">Email used for lecturer contact.</span>
                                        @error('email')<span class="text-[11px] text-error font-label">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="block font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant" for="phone_number">Phone Number</label>
                                        <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-on-surface font-mono text-xs focus:bg-surface-container-lowest focus:ring-2 focus:ring-secondary/40 outline-none transition-all" id="phone_number" name="phone_number" type="text" maxlength="20" value="{{ old('phone_number', $lecturer->phone_number) }}">
                                        <span class="text-[10px] text-on-surface-variant block font-label">Optional contact number.</span>
                                        @error('phone_number')<span class="text-[11px] text-error font-label">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-surface-container flex flex-wrap items-center justify-between gap-4">
                                    <div class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary">info</span><span class="text-[11px] font-label text-on-surface-variant">Check the details before saving changes.</span></div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('upp.lecturers.index') }}" class="px-4 py-2.5 rounded-lg text-primary hover:bg-surface-container font-label text-xs font-semibold tracking-wide transition-colors">Cancel</a>
                                        <button type="submit" class="px-6 py-3 rounded-lg bg-primary-container text-on-primary font-label text-xs font-bold tracking-wider uppercase shadow-md hover:shadow-lg hover:bg-primary transition-all flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-container">save</span><span>Update Lecturer</span></button>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="p-4 rounded-lg bg-surface-container text-on-surface text-xs font-label flex items-start gap-3"><span class="material-symbols-outlined text-[20px] text-secondary mt-0.5">verified_user</span><div><div class="font-bold text-primary mb-1 text-xs">Lecturer Record Notice</div><p class="text-[11px] text-on-surface-variant leading-relaxed">Only the lecturer details shown in this form are editable here. The lecturer ID is fixed to help preserve the record's identity.</p></div></section>
                    </div>

                    <div class="lg:col-span-5 flex flex-col gap-6">
                        <section class="w-full bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col">
                            <div class="flex items-center justify-between pb-3 mb-4 border-b border-surface-container"><div><h3 class="font-headline font-bold text-sm text-primary">Record Overview</h3><p class="font-body text-[11px] text-on-surface-variant">Current lecturer information</p></div><span class="material-symbols-outlined text-secondary text-xl">badge</span></div>
                            <div class="space-y-3">
                                <div class="p-3.5 rounded-lg bg-surface-container-low"><div class="text-[10px] font-label font-bold uppercase tracking-wider text-on-surface-variant mb-1">Lecturer ID</div><div class="font-mono text-sm font-bold text-primary break-all">{{ $lecturer->lecturer_id }}</div></div>
                                <div class="p-3.5 rounded-lg bg-surface-container-low"><div class="text-[10px] font-label font-bold uppercase tracking-wider text-on-surface-variant mb-1">Department</div><div class="font-label text-sm font-semibold text-primary">{{ $lecturer->department }}</div></div>
                                <div class="p-3.5 rounded-lg bg-surface-container-low"><div class="text-[10px] font-label font-bold uppercase tracking-wider text-on-surface-variant mb-1">Linked Account Status</div><div class="flex items-center gap-2 font-label text-sm font-semibold text-primary"><span class="w-2 h-2 rounded-full {{ optional($lecturer->user)->status === 'active' ? 'bg-secondary' : 'bg-outline' }}"></span>{{ $lecturer->user->status ?? 'No linked account' }}</div></div>
                            </div>
                            <div class="mt-5 p-3 rounded-lg bg-secondary-container/20 flex items-start gap-2"><span class="material-symbols-outlined text-secondary text-lg mt-0.5">tips_and_updates</span><p class="text-[11px] font-body text-on-secondary-container leading-relaxed">After updating, you will return to the lecturer list. If validation fails, the entered values will remain available for correction.</p></div>
                            <a href="{{ route('upp.lecturers.index') }}" class="mt-4 w-full px-4 py-2.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label text-xs font-semibold flex items-center justify-center gap-2 transition-all"><span class="material-symbols-outlined text-base">list_alt</span>View Lecturer List</a>
                        </section>

                        <section class="w-full bg-primary rounded-xl p-6 shadow-sm text-on-primary relative overflow-hidden">
                            <div class="absolute -right-8 -bottom-10 w-40 h-40 rounded-full bg-secondary/20 blur-2xl pointer-events-none"></div>
                            <div class="relative z-10 flex items-center justify-between mb-3"><div><div class="text-[10px] font-label font-bold uppercase tracking-widest text-secondary-fixed">KPMB Student Hub</div><h3 class="font-headline font-bold text-base mt-1">Academic Staff Registry</h3></div><span class="material-symbols-outlined text-secondary-fixed text-2xl">account_balance</span></div>
                            <p class="relative z-10 text-[11px] font-body leading-relaxed text-white/80">Keep lecturer contact and department details accurate so the UPP registry remains consistent.</p>
                            <div class="relative z-10 mt-5 pt-4 border-t border-white/15 flex items-center justify-between text-[10px] font-label"><span class="text-white/70">Record reference</span><span class="font-mono font-bold text-secondary-fixed">{{ $lecturer->lecturer_id }}</span></div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
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
