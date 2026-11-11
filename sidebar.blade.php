@php
    $user = auth()->user();
    $role = strtolower($user?->role ?? '');
    $student = $user?->student;

    $studentLinks = [
        ['label' => 'Papan Pemuka', 'icon' => 'dashboard', 'route' => 'student.dashboard', 'active' => 'student.dashboard', 'group' => 'Kawalan Utama'],
        ['label' => 'Profil Pelajar', 'icon' => 'contactless', 'route' => 'student.profile', 'active' => 'student.profile', 'group' => 'Kawalan Utama'],
        ['label' => 'Jadual Kuliah', 'icon' => 'schedule', 'route' => 'student.timetable', 'active' => 'student.timetable', 'group' => 'Kawalan Utama'],
        ['label' => 'Keputusan Akademik', 'icon' => 'school', 'route' => 'student.academic-results', 'active' => 'student.academic-results', 'group' => 'Kawalan Utama'],
        ['label' => 'Pendaftaran Subjek', 'icon' => 'menu_book', 'route' => 'student.subject-registration', 'active' => 'student.subject-registration*', 'group' => 'Pengurusan Akademik'],
        ['label' => 'Pengumuman & Acara', 'icon' => 'campaign', 'route' => 'student.announcements-events', 'active' => 'student.announcements-events', 'group' => 'Pengurusan Akademik'],
        ['label' => 'Direktori Pensyarah', 'icon' => 'contacts', 'route' => 'lecturers.index', 'active' => 'lecturers.*', 'group' => 'Kemudahan Kampus'],
        ['label' => 'Cari Fasiliti', 'icon' => 'apartment', 'route' => 'facilities.index', 'active' => 'facilities.*', 'group' => 'Kemudahan Kampus'],
        ['label' => 'Peta Kampus', 'icon' => 'map', 'route' => 'campus-map.index', 'active' => 'campus-map.*', 'group' => 'Kemudahan Kampus'],
    ];

    $roleLinks = match ($role) {
        'lecturer' => [
            ['label' => 'Papan Pemuka', 'icon' => 'dashboard', 'route' => 'lecturer.dashboard', 'active' => 'lecturer.dashboard', 'group' => 'Kawalan Utama'],
            ['label' => 'Pendaftaran Subjek Pelajar', 'icon' => 'fact_check', 'route' => 'lecturer.subject-registrations.index', 'active' => 'lecturer.subject-registrations.*', 'group' => 'Pengurusan Akademik'],
            ['label' => 'Peta Kampus & Fasiliti', 'icon' => 'map', 'route' => 'facilities.index', 'active' => 'facilities.*', 'group' => 'Kemudahan Kampus'],
        ],
        'upp' => [
            ['label' => 'Papan Pemuka', 'icon' => 'dashboard', 'route' => 'upp.dashboard', 'active' => 'upp.dashboard', 'group' => 'Kawalan Utama'],
            ['label' => 'Pendaftaran Subjek', 'icon' => 'fact_check', 'route' => 'upp.subject-registrations.index', 'active' => 'upp.subject-registrations.*', 'group' => 'Pengurusan Akademik'],
            ['label' => 'Peta Kampus & Fasiliti', 'icon' => 'map', 'route' => 'facilities.index', 'active' => 'facilities.*', 'group' => 'Kemudahan Kampus'],
        ],
        default => $studentLinks,
    };

    $sidebarGroups = collect($roleLinks)->groupBy('group');
    $displayName = $user?->name ?: 'Pelajar KPMB';
    $studentNumber = $student?->student_id ?? $student?->student_number ?? null;
    $programName = $student?->program?->name ?? $student?->programme?->name ?? 'Diploma Sains Komputer';
    $semester = $student?->semester;
    $semesterProgress = is_numeric($semester) ? min(100, max(0, ((int) $semester / 6) * 100)) : 0;
@endphp

<aside class="student-sidebar fixed left-0 top-0 z-50 flex h-screen w-72 flex-col justify-between overflow-hidden border-r border-[#002147] bg-gradient-to-b from-[#000a1e] via-[#002147] to-[#000a1e] p-4 text-white shadow-xl">
    {{-- Accent light bar from V1 template --}}
    <div class="pointer-events-none absolute left-0 right-0 top-0 h-1 bg-gradient-to-r from-transparent via-amber-300 to-transparent opacity-80"></div>

    <div class="relative flex min-h-0 flex-1 flex-col overflow-y-auto pr-0.5">
        {{-- Institution header --}}
        <div class="mb-4 flex items-center justify-between border-b border-white/10 pb-4">
            <div class="flex min-w-0 items-center gap-2.5">
                <img
                    src="{{ asset('images/kpmb-student-hub-icon_student.svg') }}"
                    alt="Logo KPMB Student Hub"
                    class="h-10 w-10 shrink-0 object-contain"
                >
                <div class="min-w-0">
                    <h3 class="truncate text-xs font-bold tracking-tight text-white">KPMB Student Hub</h3>
                    <span class="text-[10px] tracking-wider text-slate-300">Portal Pelajar</span>
                </div>
            </div>
        </div>

        {{-- Authenticated user profile --}}
        <div class="mb-4 rounded-xl bg-white/5 p-3.5 shadow-sm backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <div class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#17365d] shadow-inner overflow-hidden">
                    @if ($student?->profile_picture)
                        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Gambar profil {{ $displayName }}" class="h-full w-full object-cover">
                    @else
                        <span class="font-bold text-lg text-amber-200">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($displayName, 0, 1)) }}</span>
                    @endif
                    <span class="absolute -bottom-1 -right-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-emerald-500 ring-2 ring-[#002147]" title="Pengguna aktif"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="truncate text-sm font-bold text-white">{{ $displayName }}</h4>
                        <span class="shrink-0 rounded bg-emerald-950/60 px-1.5 py-0.5 text-[10px] font-semibold text-emerald-400">Aktif</span>
                    </div>
                    <p class="truncate text-[11px] text-slate-300">{{ $studentNumber ?: strtoupper($role ?: 'USER') }}</p>
                    <p class="truncate text-[10px] font-medium text-amber-200">
                        @if ($role === 'student')
                            {{ $programName }}{{ $semester ? ' (Sem ' . $semester . ')' : '' }}
                        @else
                            {{ ucfirst($role ?: 'Pengguna') }} KPMB
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Categorised navigation from the existing sidebar --}}
        <div class="space-y-4 pb-4">
            @foreach ($sidebarGroups as $groupName => $links)
                <div>
                    <span class="px-2 text-[10px] font-bold uppercase tracking-wider text-slate-300/60">{{ $groupName }}</span>
                    <nav class="mt-1 space-y-1" aria-label="{{ $groupName }}">
                        @foreach ($links as $link)
                            @if (\Illuminate\Support\Facades\Route::has($link['route']))
                                @php $isActive = request()->routeIs($link['active']); @endphp
                                <a href="{{ route($link['route']) }}"
                                   @if ($isActive) aria-current="page" @endif
                                   class="flex items-center justify-between rounded-lg px-3 py-2 text-xs transition-colors {{ $isActive ? 'bg-white/10 font-semibold text-amber-200' : 'text-white hover:bg-white/5' }}">
                                    <span class="flex min-w-0 items-center gap-2.5">
                                        <span class="material-symbols-outlined shrink-0 text-[18px] {{ $isActive ? 'text-amber-200' : 'text-slate-300' }}">{{ $link['icon'] }}</span>
                                        <span class="truncate">{{ $link['label'] }}</span>
                                    </span>
                                    @if ($isActive)
                                        <span class="ml-2 h-1.5 w-1.5 shrink-0 rounded-full bg-amber-200"></span>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </nav>
                </div>
            @endforeach
        </div>

        {{-- Semester progress uses the signed-in student's current semester, not demo values --}}
        @if ($role === 'student' && is_numeric($semester))
            <div class="mt-auto rounded-lg bg-white/5 p-2.5">
                <div class="mb-1.5 flex items-center justify-between text-[10px] text-slate-300">
                    <span>Kemajuan Semester</span>
                    <span class="font-bold text-amber-200">{{ $semester }} / 6</span>
                </div>
                <div class="h-1.5 w-full overflow-hidden rounded-full bg-white/10">
                    <div class="h-1.5 rounded-full bg-amber-200" style="width: {{ $semesterProgress }}%"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- Footer: live Malaysia time and working Laravel logout action --}}
    <div class="relative mt-4 space-y-3 border-t border-white/10 pt-4">
        <div class="flex items-center justify-between gap-2 px-2 text-[10px] font-mono text-slate-300">
            <div class="flex items-center gap-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                <span id="student-sidebar-myt">MYT --:--:--</span>
            </div>
            @if (\Illuminate\Support\Facades\Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-xs text-slate-300 transition-colors hover:text-white">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        <span>Log Keluar</span>
                    </button>
                </form>
            @endif
        </div>
        <div class="text-center text-[10px] text-slate-400">© {{ date('Y') }} Majlis Amanah Rakyat</div>
    </div>
</aside>

<style>
    @media (min-width: 768px) {
        body > header#student-academic-topbar {
            margin-left: 18rem;
            width: calc(100% - 18rem);
        }
        body > main {
            margin-left: 18rem;
            width: calc(100% - 18rem);
        }
    }

    @media (max-width: 767px) {
        aside.student-sidebar {
            position: relative;
            width: 100%;
            height: auto;
            min-height: auto;
        }
    }
</style>

<script>
    (() => {
        const clock = document.getElementById('student-sidebar-myt');
        if (!clock) return;
        const updateMalaysiaTime = () => {
            const time = new Intl.DateTimeFormat('en-MY', {
                timeZone: 'Asia/Kuala_Lumpur',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                hour12: true
            }).format(new Date());
            clock.textContent = `MYT ${time}`;
        };
        updateMalaysiaTime();
        window.setInterval(updateMalaysiaTime, 1000);
    })();
</script>
