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
                ['label' => 'Penetapan Subjek Alternatif', 'icon' => 'rule', 'url' => '/upp/alternative-subjects', 'patterns' => ['upp/alternative-subjects*']],
                ['label' => 'Skim Penilaian', 'icon' => 'fact_check', 'url' => '/upp/assessment-schemes', 'patterns' => ['upp/assessment-schemes*']],
                ['label' => 'Pengurusan Kelas Subjek', 'icon' => 'class', 'url' => '/upp/subject-classes', 'patterns' => ['upp/subject-classes*']],
            ],
        ],
        [
            'label' => 'PENDAFTARAN & PEMANTAUAN',
            'items' => [
                ['label' => 'Laporan Pendaftaran', 'icon' => 'how_to_reg', 'url' => '/upp/subject-registrations', 'patterns' => ['upp/subject-registrations*']],
                ['label' => 'Semakan Repeat Subject', 'icon' => 'fact_check', 'url' => '/upp/repeat-subject-applications', 'patterns' => ['upp/repeat-subject-applications*']],
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

<aside class="sidebar fixed left-0 top-0 z-50 flex h-screen w-72 flex-col bg-[#071b36] text-white shadow-[0_1px_12px_rgba(0,10,30,0.16)] transition-transform">
    <div class="flex min-h-0 flex-1 flex-col overflow-hidden">
        <div class="flex shrink-0 items-center gap-3 border-b border-white/10 bg-[#102b4c] px-5 py-5">
            <div class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-white/10 shadow-inner">
                <span class="material-symbols-outlined text-3xl text-[#ffe088]">school</span>
                <span class="absolute -bottom-1 -right-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#ffe088] text-[8px] font-black text-primary">★</span>
            </div>
            <div class="flex min-w-0 flex-col">
                <div class="flex items-center gap-1.5">
                    <span class="truncate font-headline text-base font-bold leading-tight tracking-tight text-white">KPMB Student Hub</span>
                    <span class="rounded bg-[#fed65b] px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[#071b36]">RASMI</span>
                </div>
                <span class="truncate font-headline text-[11px] font-semibold uppercase tracking-wider text-[#ffe088]">Portal UPP</span>
            </div>
        </div>

        <div class="shrink-0 px-6 pb-3 pt-5">
            <span class="font-headline text-[10px] font-bold uppercase tracking-[0.14em] text-slate-300">Sistem Pengurusan UPP</span>
        </div>

        <nav class="upp-sidebar-nav min-h-0 flex-1 overflow-y-auto overscroll-contain px-3 pb-5 font-headline" aria-label="Navigasi UPP">
            @foreach ($uppSidebarGroups as $group)
                <div class="mb-5 last:mb-0">
                    <span class="block px-3 text-[10px] font-bold uppercase tracking-[0.12em] leading-relaxed text-slate-400">{{ $group['label'] }}</span>
                    <div class="mt-2 space-y-1">
                        @foreach ($group['items'] as $item)
                            @php
                                $isActive = collect($item['patterns'])->contains(fn ($pattern) => request()->is($pattern));
                            @endphp
                            <a href="{{ url($item['url']) }}"
                               @if ($isActive) aria-current="page" @endif
                               class="flex min-h-11 items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-sm transition-colors duration-150 {{ $isActive ? 'bg-white/10 text-[#ffe088] font-bold ring-1 ring-inset ring-secondary-fixed/20' : 'text-slate-200 hover:bg-white/10 hover:text-white' }}">
                                <span class="flex min-w-0 items-center gap-2.5">
                                    <span class="material-symbols-outlined shrink-0 text-xl">{{ $item['icon'] }}</span>
                                    <span class="truncate">{{ $item['label'] }}</span>
                                </span>
                                @if ($isActive)
                                    <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#ffe088]"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>
    </div>

    <div class="mx-3 mb-3 mt-2 shrink-0 space-y-2.5 rounded-xl border-t border-white/10 bg-[#102b4c] px-3 pb-3 pt-4">
        <div class="flex items-center justify-between gap-2">
            <span class="font-headline text-[10px] font-bold uppercase tracking-wider text-[#ffe088]">Sesi Akademik Semasa</span>
            <span class="inline-flex items-center gap-1 rounded bg-[#fed65b]/20 px-1.5 py-0.5 font-mono text-[9px] font-bold text-white">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#ffe088]"></span> AKTIF
            </span>
        </div>
        <div class="break-words font-headline text-xs font-semibold leading-relaxed text-slate-100">{{ $displaySession }}</div>
        <div class="h-1.5 w-full overflow-hidden rounded-full bg-white/15">
            <div class="h-full w-3/4 rounded-full bg-[#ffe088]"></div>
        </div>
        <div class="text-right font-headline text-[9px] text-slate-300">Portal Pengurusan Akademik</div>
    </div>
    <style>
        .upp-sidebar-nav {
            scrollbar-width: thin;
            scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        }

        .upp-sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .upp-sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .upp-sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.35);
            border-radius: 9999px;
        }

        .upp-sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(203, 213, 225, 0.65);
        }
    </style>
</aside>

<style>
.sidebar { background:#071b36 !important; color:#fff !important; border-right:1px solid rgba(255,255,255,.08); }
.sidebar, .sidebar *:not(.material-symbols-outlined) { font-family:'Hanken Grotesk',sans-serif !important; }
.sidebar .material-symbols-outlined { font-family:'Material Symbols Outlined' !important; }
.sidebar nav a { border:1px solid transparent; }
.sidebar nav a[aria-current="page"] { background:rgba(255,224,136,.13) !important; border-color:rgba(255,224,136,.28) !important; color:#ffe088 !important; }
.sidebar nav a:hover { background:rgba(255,255,255,.09) !important; }
</style>
