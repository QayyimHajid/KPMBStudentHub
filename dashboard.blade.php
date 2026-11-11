<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard UPP | KPMB Student Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Source+Serif+4:wght@400;600&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: '#000a1e', 'primary-container': '#002147',
                    secondary: '#735c00', 'secondary-container': '#fed65b',
                    'secondary-fixed': '#ffe088', surface: '#fcf9f8',
                    'surface-container-low': '#f6f3f2', 'surface-container': '#f0eded',
                    'surface-container-high': '#eae7e7', 'on-surface-variant': '#44474e',
                    outline: '#74777f'
                },
                fontFamily: { headline: ['Hanken Grotesk'], body: ['Source Serif 4'] }
            }}
        };
    </script>
    <style>
        html, body { margin:0; min-height:100%; }
        body { background:#fcf9f8; color:#1c1b1b; font-family:'Source Serif 4',serif; }
        .material-symbols-outlined { font-variation-settings:'FILL' 0,'wght' 500,'GRAD' 0,'opsz' 24; }
        .font-headline { font-family:'Hanken Grotesk',sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display:none; }
        @media(max-width: 900px) {
            .sidebar { transform:translateX(-100%); }
            .main-shell { margin-left:0!important; }
            .topbar { left:0!important; }
        }
    </style>
</head>
<body>
@php
    $pending = (int) ($pendingRegistrations ?? 0);
    $approved = (int) ($approvedRegistrations ?? 0);
    $rejected = (int) ($rejectedRegistrations ?? 0);
    $total = (int) ($totalRegistrations ?? ($pending + $approved + $rejected));
    $processed = $approved + $rejected;
    $processedRate = $total > 0 ? round(($processed / $total) * 100) : 0;
    $displaySession = $academicSession ?? $currentAcademicSession ?? 'Sesi akademik belum ditetapkan';
    $userName = auth()->user()->name ?? 'Pegawai UPP';
@endphp

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

<div class="main-shell ml-72 flex min-h-screen flex-col">
    @include('upp.partials.topbar')

    <main class="w-full flex-1 px-4 pb-8 pt-24 sm:px-8">
        <div class="mx-auto flex w-full max-w-[1800px] flex-col gap-7">
            <section class="relative overflow-hidden rounded-xl bg-primary text-white shadow-lg">
                <div class="pointer-events-none absolute -right-20 -top-24 h-80 w-80 rounded-full bg-secondary-container/10 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 right-1/3 h-64 w-64 rounded-full bg-blue-400/10 blur-3xl"></div>
                <div class="relative z-10 flex flex-col gap-6 p-6 sm:p-8 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-3xl space-y-4">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 font-headline text-xs font-semibold tracking-wide text-secondary-container">
                            <span class="h-2 w-2 rounded-full bg-secondary-container"></span> PEMANTAUAN AKADEMIK
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-secondary-container text-primary shadow-md"><span class="material-symbols-outlined text-3xl">school</span></div>
                            <div>
                                <h1 class="font-headline text-2xl font-bold tracking-tight sm:text-3xl">Dashboard UPP</h1>
                                <p class="mt-1 font-headline text-sm font-semibold uppercase tracking-wider text-secondary-container">Unit Pengurusan Pengajian</p>
                                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-200">Selamat datang, {{ $userName }}. Pantau pengurusan pelajar, pensyarah, subjek, pendaftaran dan laporan akademik melalui satu paparan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex shrink-0 flex-col gap-2 sm:flex-row lg:flex-col">
                        <a href="{{ url('/upp/registration-report') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-secondary-container px-4 py-3 font-headline text-xs font-bold text-primary shadow-sm transition hover:bg-secondary-fixed"><span class="material-symbols-outlined text-lg">summarize</span>Laporan Pendaftaran</a>
                        <a href="{{ url('/upp/result-report') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white/10 px-4 py-3 font-headline text-xs font-semibold text-white transition hover:bg-white/20"><span class="material-symbols-outlined text-lg">analytics</span>Laporan Keputusan</a>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <a href="{{ url('/upp/subject-registrations') }}" class="group flex min-h-[170px] flex-col justify-between rounded-xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="mb-3 flex items-center justify-between"><span class="font-headline text-xs font-semibold uppercase tracking-wider text-slate-500">Jumlah Pendaftaran</span><span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-primary"><span class="material-symbols-outlined text-xl">app_registration</span></span></div>
                    <div><div class="font-headline text-4xl font-bold tracking-tight text-primary">{{ number_format($total, 0) }}</div><p class="mt-2 text-xs text-slate-500">Semua permohonan dalam sistem</p></div>
                </a>
                <a href="{{ url('/upp/subject-registrations') }}?status=pending" class="group flex min-h-[170px] flex-col justify-between rounded-xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="mb-3 flex items-center justify-between"><span class="font-headline text-xs font-semibold uppercase tracking-wider text-slate-500">Menunggu Tindakan Mentor</span><span class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-700"><span class="material-symbols-outlined text-xl">pending_actions</span></span></div>
                    <div><div class="font-headline text-4xl font-bold tracking-tight text-primary">{{ number_format($pending, 0) }}</div><p class="mt-2 text-xs text-slate-500">Untuk pemantauan sahaja; kelulusan dibuat oleh mentor</p></div>
                </a>
                <a href="{{ url('/upp/registration-report') }}" class="group flex min-h-[170px] flex-col justify-between rounded-xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="mb-3 flex items-center justify-between"><span class="font-headline text-xs font-semibold uppercase tracking-wider text-slate-500">Diluluskan</span><span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"><span class="material-symbols-outlined text-xl">check_circle</span></span></div>
                    <div><div class="font-headline text-4xl font-bold tracking-tight text-primary">{{ number_format($approved, 0) }}</div><p class="mt-2 text-xs text-slate-500">Permohonan yang telah diluluskan</p></div>
                </a>
                <a href="{{ url('/upp/registration-report') }}" class="group flex min-h-[170px] flex-col justify-between rounded-xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="mb-3 flex items-center justify-between"><span class="font-headline text-xs font-semibold uppercase tracking-wider text-slate-500">Ditolak</span><span class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-700"><span class="material-symbols-outlined text-xl">cancel</span></span></div>
                    <div><div class="font-headline text-4xl font-bold tracking-tight text-primary">{{ number_format($rejected, 0) }}</div><p class="mt-2 text-xs text-slate-500">Permohonan yang ditolak mentor</p></div>
                </a>
            </section>

            <section class="grid grid-cols-1 items-start gap-6 xl:grid-cols-12">
                <div class="space-y-6 xl:col-span-8">
                    <div class="rounded-xl bg-white p-5 shadow-sm sm:p-6">
                        <div class="flex flex-col justify-between gap-3 pb-5 sm:flex-row sm:items-center">
                            <div>
                                <div class="flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-secondary-container"></span><h2 class="font-headline text-lg font-bold text-primary">Pendaftaran Terkini</h2></div>
                                <p class="mt-1 text-xs text-slate-500">Rekod terbaru untuk rujukan dan pemantauan UPP.</p>
                            </div>
                            <a href="{{ url('/upp/registration-report') }}" class="inline-flex items-center gap-1 font-headline text-xs font-bold uppercase tracking-wider text-secondary hover:text-primary">Lihat Laporan <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[680px] border-collapse text-left">
                                <thead><tr class="bg-primary font-headline text-[11px] uppercase tracking-wider text-white">
                                    <th class="rounded-l-lg px-3 py-3">ID Pelajar</th><th class="px-3 py-3">Nama Pelajar</th><th class="px-3 py-3">Subjek</th><th class="px-3 py-3">Tarikh</th><th class="rounded-r-lg px-3 py-3">Status</th>
                                </tr></thead>
                                <tbody class="text-sm">
                                @forelse(($recentRegistrations ?? collect()) as $registration)
                                    <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                                        <td class="px-3 py-3 font-headline text-xs font-semibold text-primary">{{ $registration->student->student_id ?? $registration->student_id ?? '—' }}</td>
                                        <td class="px-3 py-3">{{ $registration->student->student_name ?? 'Tidak tersedia' }}</td>
                                        <td class="px-3 py-3"><div class="font-headline text-xs font-semibold text-primary">{{ $registration->subject->subject_code ?? '—' }}</div><div class="mt-0.5 text-xs text-slate-500">{{ $registration->subject->subject_name ?? 'Subjek tidak tersedia' }}</div></td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-slate-500">{{ $registration->registration_date?->format('d/m/Y') ?? '—' }}</td>
                                        <td class="px-3 py-3">
                                            @if($registration->registration_status === 'pending')
                                                <span class="inline-flex whitespace-nowrap rounded-full bg-amber-100 px-2.5 py-1 font-headline text-[11px] font-bold text-amber-800">Menunggu mentor</span>
                                            @elseif($registration->registration_status === 'approved')
                                                <span class="inline-flex whitespace-nowrap rounded-full bg-emerald-100 px-2.5 py-1 font-headline text-[11px] font-bold text-emerald-800">Diluluskan</span>
                                            @else
                                                <span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-2.5 py-1 font-headline text-[11px] font-bold text-red-800">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-3 py-10 text-center text-sm text-slate-500"><span class="material-symbols-outlined mb-2 block text-3xl text-slate-300">inbox</span>Tiada rekod pendaftaran untuk dipaparkan.</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex flex-col gap-2 border-t border-slate-100 pt-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                            <span>Memaparkan sehingga 5 rekod terkini.</span>
                            <a href="{{ url('/upp/registration-report') }}" class="font-headline font-bold text-primary hover:text-secondary">Buka laporan penuh →</a>
                        </div>
                    </div>

                    <div class="rounded-xl bg-white p-5 shadow-sm sm:p-6">
                        <div class="mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-2xl text-secondary">donut_small</span><h2 class="font-headline text-lg font-bold text-primary">Ringkasan Status Pendaftaran</h2></div>
                        <div class="mb-4 h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="flex h-full w-full">
                                <div class="bg-emerald-600" style="width: {{ $total ? ($approved / $total * 100) : 0 }}%"></div>
                                <div class="bg-amber-400" style="width: {{ $total ? ($pending / $total * 100) : 0 }}%"></div>
                                <div class="bg-red-500" style="width: {{ $total ? ($rejected / $total * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div class="flex items-center gap-2 rounded-lg bg-emerald-50 p-3"><span class="h-2.5 w-2.5 rounded-full bg-emerald-600"></span><div><div class="font-headline text-xs font-semibold text-emerald-800">Diluluskan</div><div class="font-headline text-xl font-bold text-primary">{{ $approved }}</div></div></div>
                            <div class="flex items-center gap-2 rounded-lg bg-amber-50 p-3"><span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span><div><div class="font-headline text-xs font-semibold text-amber-800">Menunggu mentor</div><div class="font-headline text-xl font-bold text-primary">{{ $pending }}</div></div></div>
                            <div class="flex items-center gap-2 rounded-lg bg-red-50 p-3"><span class="h-2.5 w-2.5 rounded-full bg-red-500"></span><div><div class="font-headline text-xs font-semibold text-red-800">Ditolak</div><div class="font-headline text-xl font-bold text-primary">{{ $rejected }}</div></div></div>
                        </div>
                        <p class="mt-3 text-xs leading-relaxed text-slate-500">Carta ini berdasarkan semua rekod pendaftaran yang dibekalkan oleh controller dashboard.</p>
                    </div>
                </div>

                <div class="space-y-6 xl:col-span-4">
                    <div class="rounded-xl bg-white p-5 shadow-sm sm:p-6">
                        <div class="mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-2xl text-secondary">apps</span><h2 class="font-headline text-lg font-bold text-primary">Pautan Pantas</h2></div>
                        <div class="space-y-2">
                            <a href="{{ url('/upp/students') }}" class="group flex items-center justify-between rounded-lg bg-surface-container-low p-3 transition hover:bg-surface-container"><div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-white"><span class="material-symbols-outlined">groups</span></span><div><span class="block font-headline text-xs font-bold text-primary">Pengurusan Pelajar</span><span class="text-[11px] text-slate-500">Semak rekod pelajar</span></div></div><span class="material-symbols-outlined text-slate-400">chevron_right</span></a>
                            <a href="{{ url('/upp/lecturers') }}" class="group flex items-center justify-between rounded-lg bg-surface-container-low p-3 transition hover:bg-surface-container"><div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-white"><span class="material-symbols-outlined">badge</span></span><div><span class="block font-headline text-xs font-bold text-primary">Pengurusan Pensyarah</span><span class="text-[11px] text-slate-500">Semak rekod pensyarah</span></div></div><span class="material-symbols-outlined text-slate-400">chevron_right</span></a>
                            <a href="{{ url('/upp/subjects') }}" class="group flex items-center justify-between rounded-lg bg-surface-container-low p-3 transition hover:bg-surface-container"><div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-white"><span class="material-symbols-outlined">menu_book</span></span><div><span class="block font-headline text-xs font-bold text-primary">Pengurusan Subjek</span><span class="text-[11px] text-slate-500">Katalog subjek</span></div></div><span class="material-symbols-outlined text-slate-400">chevron_right</span></a>
                            <a href="{{ url('/upp/assessment-schemes') }}" class="group flex items-center justify-between rounded-lg bg-surface-container-low p-3 transition hover:bg-surface-container"><div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-white"><span class="material-symbols-outlined">fact_check</span></span><div><span class="block font-headline text-xs font-bold text-primary">Skim Penilaian</span><span class="text-[11px] text-slate-500">Paparan untuk pemantauan</span></div></div><span class="material-symbols-outlined text-slate-400">chevron_right</span></a>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-xl bg-primary p-6 text-white shadow-sm">
                        <div class="pointer-events-none absolute -right-10 -top-10 h-36 w-36 rounded-full bg-secondary-container/10 blur-2xl"></div>
                        <div class="relative">
                            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 text-secondary-container"><span class="material-symbols-outlined text-2xl">insights</span></div>
                            <h2 class="font-headline text-base font-bold">Prestasi Pemprosesan</h2>
                            <p class="mt-1 text-xs text-slate-300">Bahagian pendaftaran yang telah mempunyai keputusan mentor.</p>
                            <div class="mt-4 flex items-end justify-between gap-3">
                                <div class="font-headline text-4xl font-bold">{{ $processedRate }}<span class="text-2xl">%</span></div>
                                <div class="text-right font-headline text-xs text-slate-300">{{ $processed }} daripada {{ $total }} diproses</div>
                            </div>
                            <div class="mt-3 h-2 overflow-hidden rounded-full bg-white/15"><div class="h-full rounded-full bg-secondary-container" style="width: {{ $processedRate }}%"></div></div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-2xl text-secondary">info</span>
                            <div><h3 class="font-headline text-sm font-bold text-primary">Peranan UPP</h3><p class="mt-1 text-xs leading-relaxed text-slate-500">UPP memantau rekod akademik dan laporan. Kelulusan pendaftaran subjek dibuat oleh mentor, manakala skim penilaian dipaparkan kepada UPP untuk rujukan.</p></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="mt-auto flex flex-col items-center justify-between gap-2 bg-surface-container-low px-5 py-4 font-headline text-xs text-slate-500 sm:flex-row sm:px-8">
        <span>© Kolej Profesional MARA Beranang · KPMB Student Hub</span>
        <span class="font-semibold text-secondary">Portal Pengurusan Akademik UPP</span>
    </footer>
</div>

</body>
</html>
