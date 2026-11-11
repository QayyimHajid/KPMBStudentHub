@php
    $topbarUser = auth()->user();
    $topbarStudent = $topbarUser?->student;
    $topbarProfilePicture = $topbarStudent?->profile_picture;
    $topbarName = $topbarUser?->name ?? 'Pelajar';
    $topbarProgramme = $topbarStudent?->programme?->programme_name
        ?? $topbarStudent?->programme_name
        ?? $topbarStudent?->program
        ?? $topbarStudent?->programme
        ?? 'Pelajar KPMB';
    $topbarSemester = $topbarStudent?->semester ?? $topbarStudent?->current_semester;
    $topbarStudentNo = $topbarStudent?->student_id
        ?? $topbarStudent?->student_number
        ?? $topbarUser?->username;
    $topbarProfileText = trim(($topbarProgramme ?: 'Pelajar KPMB') . ($topbarSemester ? ' • Semester ' . $topbarSemester : ''));
@endphp

<header class="w-full shadow-md z-30 select-none" id="student-academic-topbar">
    {{-- Deck 1: Telemetry strip and live Malaysia time --}}
    <div class="w-full bg-[#000a1e] text-white text-xs font-headline py-1 px-4 lg:px-8 border-b border-white/5">
        <div class="max-w-[1440px] mx-auto flex flex-wrap items-center justify-between gap-y-1.5 text-[11.5px] tracking-wide">
            <div class="flex items-center gap-2.5 min-w-0">
                <span class="relative flex h-2 w-2 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#ffe088] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#ffe088]"></span>
                </span>
                <div class="flex items-center gap-1.5 font-medium text-white/90 min-w-0">
                    <span class="font-bold tracking-tight text-[#ffe088] hidden sm:inline">KPMB STUDENT HUB:</span>
                    <span class="truncate max-w-[280px] sm:max-w-none text-white/80">Portal Maklumat &amp; Perkhidmatan Pelajar</span>
                </div>
                <span class="text-white/30 hidden md:inline">•</span>
                <span class="text-white/60 hidden md:inline">Kolej Profesional MARA Beranang</span>
            </div>
            <div class="flex items-center gap-3 sm:gap-4 ml-auto">
                <div class="flex items-center gap-2 text-white/90 border-r border-white/10 pr-3 sm:pr-4" id="student-date-bar">
                    <span class="text-[#ffe088] font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                        <span id="student-gregorian-date">{{ now()->timezone('Asia/Kuala_Lumpur')->locale('ms')->translatedFormat('l, d M Y') }}</span>
                    </span>
                </div>
                <div class="flex items-center gap-2.5 bg-gradient-to-r from-[#002147]/90 via-[#002147] to-[#001736] px-2.5 py-1 rounded-lg border border-white/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1),0_2px_6px_rgba(0,0,0,0.35)]">
                    {{-- Analog clock face retained from the supplied template --}}
                    <div class="relative w-8 h-8 shrink-0 flex items-center justify-center filter drop-shadow-sm" title="Waktu Malaysia (MYT)">
                        <svg class="w-8 h-8" viewBox="0 0 100 100" aria-hidden="true">
                            <defs>
                                <radialGradient cx="50%" cy="40%" id="studentDialGrad" r="50%"><stop offset="0%" stop-color="#002b5c"/><stop offset="65%" stop-color="#001838"/><stop offset="100%" stop-color="#000e24"/></radialGradient>
                                <linearGradient id="studentBezelGrad" x1="0%" x2="100%" y1="0%" y2="100%"><stop offset="0%" stop-color="#fed65b"/><stop offset="35%" stop-color="#ffffff"/><stop offset="65%" stop-color="#b48316"/><stop offset="100%" stop-color="#fed65b"/></linearGradient>
                            </defs>
                            <circle cx="50" cy="50" fill="url(#studentBezelGrad)" r="48"/><circle cx="50" cy="50" fill="#000a1e" r="45"/><circle cx="50" cy="50" fill="url(#studentDialGrad)" r="43"/>
                            <circle cx="50" cy="50" fill="none" opacity="0.6" r="39" stroke="#708ab5" stroke-dasharray="0.8, 3.39" stroke-width="0.5"/><circle cx="50" cy="50" fill="none" opacity="0.25" r="33" stroke="#aec7f6" stroke-width="0.4"/>
                            <rect fill="#fed65b" height="7.5" rx="1" width="3" x="48.5" y="11"/><rect fill="#fed65b" height="3" rx="1" width="7.5" x="81.5" y="48.5"/><rect fill="#fed65b" height="7.5" rx="1" width="3" x="48.5" y="81.5"/><rect fill="#fed65b" height="3" rx="1" width="7.5" x="11" y="48.5"/>
                            <g opacity="0.85" stroke="#e0e3e8" stroke-linecap="round" stroke-width="1.8"><line x1="69.5" x2="66.5" y1="16.2" y2="21.4"/><line x1="83.8" x2="78.6" y1="30.5" y2="33.5"/><line x1="83.8" x2="78.6" y1="69.5" y2="66.5"/><line x1="69.5" x2="66.5" y1="83.8" y2="78.6"/><line x1="30.5" x2="33.5" y1="83.8" y2="78.6"/><line x1="16.2" x2="21.4" y1="69.5" y2="66.5"/><line x1="16.2" x2="21.4" y1="30.5" y2="33.5"/><line x1="30.5" x2="33.5" y1="16.2" y2="21.4"/></g>
                            <text fill="#aec7f6" font-family="'Hanken Grotesk', sans-serif" font-size="4.2" font-weight="700" letter-spacing="0.5" text-anchor="middle" x="50" y="32">KPMB</text><text fill="#fed65b" font-family="'Hanken Grotesk', sans-serif" font-size="3.5" font-weight="600" letter-spacing="0.4" text-anchor="middle" x="50" y="70">MYT</text>
                            <g id="student-analog-hour-hand" transform="rotate(0 50 50)"><line stroke="#ffffff" stroke-linecap="round" stroke-width="2.8" x1="50" x2="50" y1="56" y2="26"/><line stroke="#fed65b" stroke-linecap="round" stroke-width="1.2" x1="50" x2="50" y1="52" y2="27"/></g>
                            <g id="student-analog-minute-hand" transform="rotate(0 50 50)"><line stroke="#ffffff" stroke-linecap="round" stroke-width="2.2" x1="50" x2="50" y1="58" y2="17"/><line stroke="#aec7f6" stroke-linecap="round" stroke-width="0.8" x1="50" x2="50" y1="54" y2="18"/></g>
                            <g id="student-analog-second-hand" transform="rotate(0 50 50)"><line stroke="#fed65b" stroke-linecap="round" stroke-width="1" x1="50" x2="50" y1="62" y2="13"/><circle cx="50" cy="20" fill="#fed65b" r="1.6"/><circle cx="50" cy="58" fill="#fed65b" r="1.8"/></g>
                            <circle cx="50" cy="50" fill="#fed65b" r="2.8" stroke="#000a1e" stroke-width="0.8"/><circle cx="50" cy="50" fill="#ffffff" r="1.2"/>
                        </svg>
                        <span class="absolute -top-0.5 -right-0.5 w-1.5 h-1.5 rounded-full bg-emerald-400 border border-[#000a1e]"></span>
                    </div>
                    <div class="flex flex-col leading-none">
                        <div class="flex items-center gap-1.5 font-mono text-[12px] text-white"><span class="font-bold tracking-wider tabular-nums" id="student-live-hms">--:--:--</span><span class="text-[9px] font-headline font-bold text-[#ffe088] uppercase tracking-wider px-1.5 py-0.5 rounded bg-black/40 border border-white/10" id="student-tz-pill">MYT</span></div>
                        <div class="flex items-center gap-1 text-[8.5px] font-headline text-white/50 tracking-tight mt-0.5"><span class="text-[#ffe088] font-semibold">UTC+8</span><span>•</span><span class="truncate">WAKTU MALAYSIA</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Deck 2: KPMB identity, student welcome context and profile actions --}}
    <div class="w-full bg-white text-[#1c1b1b] py-2.5 px-4 lg:px-8">
        <div class="max-w-[1440px] mx-auto flex flex-wrap lg:flex-nowrap items-center gap-4">
            <a href="{{ Route::has('student.dashboard') ? route('student.dashboard') : url('/') }}" class="flex items-center gap-3 shrink-0 min-w-0 no-underline" aria-label="Kolej Profesional MARA Beranang">
                <img alt="Logo MARA" class="h-8 w-auto object-contain" src="{{ asset('images/Majlis_Amanah_Rakyat_logo.png') }}"/>
                <img src="{{ asset('images/LogoKPM-1.png') }}" alt="Logo Kolej Profesional MARA" class="w-12 h-12 object-contain shrink-0">
                <span class="flex flex-col leading-tight min-w-0">
                    <span class="font-headline font-black text-[15px] tracking-tight text-[#000a1e] whitespace-nowrap">Kolej Profesional MARA</span>
                    <span class="text-[11px] font-headline text-[#735c00] font-semibold tracking-wide">BERANANG, SELANGOR</span>
                </span>
            </a>

            {{-- Centre suggestion: welcome message with existing programme and semester data --}}
            <div class="hidden lg:flex flex-1 min-w-0 justify-center px-4">
                <div class="flex items-center gap-3 min-w-0 rounded-xl border border-[#e7e1d8] bg-[#fbfaf8] px-4 py-2">
                    <span class="w-9 h-9 rounded-lg bg-[#fff1c2] text-[#735c00] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">waving_hand</span>
                    </span>
                    <div class="flex flex-col min-w-0 leading-tight">
                        <span class="font-headline font-bold text-[12px] text-[#000a1e]">Selamat kembali, {{ $topbarName }}</span>
                        <span class="text-[11px] text-[#626262] truncate">{{ $topbarProgramme ?: 'Pelajar KPMB' }}{{ $topbarSemester ? ' • Semester ' . $topbarSemester : '' }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0 ml-auto">
                @if (Route::has('student.announcements-events'))
                    <a href="{{ route('student.announcements-events') }}" class="relative w-10 h-10 rounded-xl border border-[#e7e1d8] bg-[#f8f6f4] flex items-center justify-center text-[#1c1b1b] hover:bg-[#f0eded] transition-colors" title="Pengumuman & Acara" aria-label="Pengumuman dan acara">
                        <span class="material-symbols-outlined text-[21px]">notifications</span>
                    </a>
                @endif
                <div class="flex items-center gap-2.5 pl-3 py-1.5 pr-2 border border-[#e7e1d8] bg-[#fbfaf8] hover:bg-[#f6f3f2] rounded-xl transition-all">
                    <div class="flex flex-col text-right hidden sm:flex leading-none">
                        <span class="font-headline font-bold text-[12.5px] text-[#1c1b1b]">{{ $topbarName }}</span>
                        <span class="font-headline text-[10px] text-[#626262] mt-1">{{ $topbarStudentNo ? $topbarStudentNo . ' • ' : '' }}Pelajar</span>
                    </div>
                    <div class="relative w-9 h-9 rounded-full overflow-hidden bg-[#aec7f6] flex items-center justify-center text-[#002147]">
                        @if ($topbarProfilePicture)
                            <img src="{{ asset('storage/' . $topbarProfilePicture) }}" alt="Gambar profil {{ $topbarName }}" class="w-full h-full object-cover">
                        @else
                            <span class="font-headline font-bold text-sm">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($topbarName, 0, 1)) }}</span>
                        @endif
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-[#16a34a] rounded-full border border-white"></span>
                    </div>
                    <span class="material-symbols-outlined text-[18px] text-[#44474e]">person</span>
                </div>
            </div>
        </div>
    </div>

</header>

<script>
(function () {
    const root = document.getElementById('student-academic-topbar');
    if (!root || root.dataset.clockReady === '1') return;
    root.dataset.clockReady = '1';

    const hms = root.querySelector('#student-live-hms');
    const date = root.querySelector('#student-gregorian-date');
    const hourHand = root.querySelector('#student-analog-hour-hand');
    const minuteHand = root.querySelector('#student-analog-minute-hand');
    const secondHand = root.querySelector('#student-analog-second-hand');

    const timeFormatter = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Asia/Kuala_Lumpur', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
    });
    const dateFormatter = new Intl.DateTimeFormat('ms-MY', {
        timeZone: 'Asia/Kuala_Lumpur', weekday: 'long', day: '2-digit', month: 'short', year: 'numeric'
    });

    function updateClock() {
        const now = new Date();
        const parts = new Intl.DateTimeFormat('en-GB', {
            timeZone: 'Asia/Kuala_Lumpur', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
        }).formatToParts(now).reduce((acc, part) => { acc[part.type] = part.value; return acc; }, {});
        const hours = Number(parts.hour) % 24;
        const minutes = Number(parts.minute);
        const seconds = Number(parts.second);
        if (hms) hms.textContent = timeFormatter.format(now);
        if (date) date.textContent = dateFormatter.format(now);
        if (hourHand) hourHand.setAttribute('transform', `rotate(${((hours % 12) + minutes / 60 + seconds / 3600) * 30} 50 50)`);
        if (minuteHand) minuteHand.setAttribute('transform', `rotate(${(minutes + seconds / 60) * 6} 50 50)`);
        if (secondHand) secondHand.setAttribute('transform', `rotate(${seconds * 6} 50 50)`);
    }
    updateClock();
    window.setInterval(updateClock, 1000);
})();
</script>
