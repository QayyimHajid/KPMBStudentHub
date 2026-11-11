@php
    $topbarUser = auth()->user();
    $topbarLecturer = $topbarUser?->lecturer;
    $topbarIsCoordinator = $topbarLecturer && $topbarLecturer->coordinatorSubjects()->exists();
@endphp

<header class="lecturer-topbar-shell fixed top-0 left-72 right-0 h-[88px] bg-white/95 backdrop-blur-xl z-40 flex items-center justify-between gap-5 px-6 border-b border-slate-200/80 shadow-[0_2px_14px_rgba(0,33,71,0.07)]">
    <div class="flex items-center gap-5 shrink-0 min-w-0">
        <a href="{{ route('lecturer.dashboard') }}" class="flex items-center gap-3 shrink-0" aria-label="KPMB Student Hub">
            <img alt="Logo MARA" class="h-8 w-auto object-contain" src="{{ asset('images/Majlis_Amanah_Rakyat_logo.png') }}"/>
            <img alt="Logo KPM" class="h-8 w-auto object-contain" src="{{ asset('images/LogoKPM-1.png') }}"/>
            <div class="flex flex-col"><span class="font-headline font-bold text-base tracking-tight text-primary leading-tight">Kolej Profesional MARA</span><span class="font-label text-xs font-semibold text-secondary tracking-wide uppercase leading-tight">Beranang, Selangor</span></div>
        </a>

        <div class="h-10 w-px bg-slate-200 hidden xl:block"></div>

        <div class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-[#f8f7f6] px-3.5 py-2.5 shadow-sm shrink-0">
            <span class="material-symbols-outlined text-[#8a6b08] text-xl">event</span>
            <div class="flex flex-col leading-tight">
                <span class="font-headline text-xs sm:text-sm font-extrabold text-[#002147] whitespace-nowrap">Sesi 2, 2025/2026</span>
            </div>
        </div>
    </div>

    <div class="lecturer-clock-card flex items-center justify-center gap-4 px-5 py-2 rounded-2xl border border-slate-200/80 bg-gradient-to-br from-white to-[#f5f6f8] shadow-[0_2px_10px_rgba(0,33,71,0.06)] min-w-0 flex-1 max-w-[570px]">
        <div class="relative w-11 h-11 rounded-full bg-gradient-to-b from-[#001630] to-[#002147] flex items-center justify-center shadow-inner shrink-0 border border-[#c59b27]/50">
            <span class="absolute top-1 w-0.5 h-1 bg-[#c59b27]/90 rounded-full"></span>
            <span class="absolute bottom-1 w-0.5 h-1 bg-[#c59b27]/70 rounded-full"></span>
            <span class="absolute right-1 h-0.5 w-1 bg-[#c59b27]/70 rounded-full"></span>
            <span class="absolute left-1 h-0.5 w-1 bg-[#c59b27]/70 rounded-full"></span>
            <div class="absolute w-0.5 h-3 bg-white rounded-full origin-bottom" id="lecturer-analog-hour" style="transform:rotate(315deg) translateY(-50%);"></div>
            <div class="absolute w-0.5 h-3.5 bg-[#e4bb42] rounded-full origin-bottom" id="lecturer-analog-minute" style="transform:rotate(190deg) translateY(-50%);"></div>
            <div class="absolute w-px h-4 bg-rose-400 rounded-full origin-bottom" id="lecturer-analog-second" style="transform:rotate(45deg) translateY(-50%);"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-[#c59b27] border border-[#002147] z-10"></div>
        </div>

        <div class="flex flex-col min-w-0 flex-1">
            <div class="flex items-baseline gap-1.5 whitespace-nowrap">
                <time id="lecturer-live-clock" class="font-mono text-xl xl:text-[25px] font-bold tracking-tight text-[#002147] leading-none tabular-nums" aria-live="off">--:--:--</time>
                <span id="lecturer-clock-ampm" class="font-mono text-xs font-bold text-[#b38808] uppercase tracking-wider">--</span>
            </div>
            <div class="flex items-center gap-1.5 mt-1 text-xs font-semibold text-slate-600 whitespace-nowrap">
                <span class="material-symbols-outlined text-sm text-slate-400">calendar_month</span>
                <time id="lecturer-live-date">Loading date...</time>
            </div>
        </div>

        <div class="hidden 2xl:flex flex-col items-start justify-center border-l border-slate-200 pl-4 self-stretch min-w-[112px]">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#002147]">Waktu Malaysia</span>
            <span class="text-[11px] font-semibold text-slate-500 mt-1">MYT · UTC+8</span>
            <span class="inline-flex items-center gap-1.5 text-[9px] font-bold text-emerald-700 mt-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 lecturer-pulse-dot"></span>MASA NYATA</span>
        </div>
    </div>

    <div class="flex items-center gap-3 shrink-0">
        <div class="hidden lg:flex flex-col text-right max-w-[210px]">
            <span class="font-headline text-sm font-extrabold text-[#002147] leading-tight truncate">{{ $topbarUser->name ?? 'Lecturer' }}</span>
            <span class="font-label text-[10px] font-semibold text-slate-500">{{ $topbarIsCoordinator ? 'Pensyarah • Penyelaras Subjek' : 'Pensyarah' }}</span>
        </div>
        <div class="relative w-10 h-10 rounded-full border-2 border-[#c59b27] bg-[#f8f7f6] flex items-center justify-center text-[#002147] font-extrabold shadow-sm">
            {{ strtoupper(substr($topbarUser->name ?? 'L', 0, 1)) }}
            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white"></span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-red-200 bg-red-50/70 text-red-700 hover:bg-red-100 text-xs font-bold transition-colors whitespace-nowrap">
                <span class="material-symbols-outlined text-lg">power_settings_new</span>
                <span class="hidden xl:inline">Log Keluar</span>
            </button>
        </form>
    </div>
</header>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap");
    /* Shared lecturer visual system: navy, academic gold, soft neutral canvas. */
    html, body { font-family: 'Hanken Grotesk', sans-serif !important; }
    body { background: #f6f3f2 !important; color: #1c1b1b; }
    main {
        background:
            radial-gradient(ellipse at 12% 0%, rgba(197,155,39,.075), transparent 34rem),
            radial-gradient(ellipse at 92% 18%, rgba(0,33,71,.045), transparent 32rem),
            #f6f3f2;
        min-height: calc(100vh - 5rem);
    }
    main h1, main h2 { color: #002147; }
    main .bg-white { border-color: #e5e7eb; box-shadow: 0 2px 10px rgba(0,33,71,.045); }
    main input:focus, main select:focus, main textarea:focus { --tw-ring-color: rgba(197,155,39,.45); border-color: #c59b27; }
    main a, main button { transition: background-color .18s ease, border-color .18s ease, color .18s ease; }
    .lecturer-sidebar-shell { font-family: 'Hanken Grotesk', sans-serif !important; }
    .lecturer-sidebar-shell a, .lecturer-sidebar-shell button { transition: background-color .18s ease, color .18s ease, transform .18s ease; }
    .lecturer-sidebar-shell nav a:hover { transform: translateX(2px); }
    .lecturer-topbar-shell { font-family: 'Hanken Grotesk', sans-serif !important; }
    .lecturer-pulse-dot { box-shadow: 0 0 0 0 rgba(34,197,94,.55); animation: lecturer-pulse-ring 2s infinite cubic-bezier(.66,0,0,1); }
    @keyframes lecturer-pulse-ring { 0%{box-shadow:0 0 0 0 rgba(34,197,94,.55)} 70%{box-shadow:0 0 0 6px rgba(34,197,94,0)} 100%{box-shadow:0 0 0 0 rgba(34,197,94,0)} }
    @media(max-width:1279px) {
        .lecturer-topbar-shell { left: 18rem; padding-left: 1rem; padding-right: 1rem; gap: .75rem; }
        .lecturer-clock-card { max-width: 390px; gap: .65rem; padding: .5rem .7rem; }
        .lecturer-clock-card #lecturer-live-clock { font-size: 1.15rem; }
    }
    @media(max-width:1023px) {
        .lecturer-topbar-shell { height: 76px; }
        .lecturer-clock-card { display: none !important; }
    }
</style>

<script>
(function () {
    const clock = document.getElementById('lecturer-live-clock');
    const ampm = document.getElementById('lecturer-clock-ampm');
    const date = document.getElementById('lecturer-live-date');
    const hourHand = document.getElementById('lecturer-analog-hour');
    const minuteHand = document.getElementById('lecturer-analog-minute');
    const secondHand = document.getElementById('lecturer-analog-second');

    function updateClock() {
        const now = new Date();
        const parts = new Intl.DateTimeFormat('en-GB', {
            timeZone: 'Asia/Kuala_Lumpur',
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
        }).formatToParts(now);
        const part = type => parts.find(item => item.type === type)?.value ?? '00';
        const hours = Number(part('hour')) % 24;
        const minutes = Number(part('minute'));
        const seconds = Number(part('second'));
        const twelveHour = hours % 12 || 12;

        if (clock) clock.textContent = `${String(twelveHour).padStart(2, '0')}:${part('minute')}:${part('second')}`;
        if (ampm) ampm.textContent = hours >= 12 ? 'PM' : 'AM';
        if (date) date.textContent = new Intl.DateTimeFormat('en-GB', {
            timeZone: 'Asia/Kuala_Lumpur', weekday: 'long', day: 'numeric', month: 'short', year: 'numeric'
        }).format(now);

        if (hourHand) hourHand.style.transform = `rotate(${(hours % 12) * 30 + minutes * .5}deg) translateY(-50%)`;
        if (minuteHand) minuteHand.style.transform = `rotate(${minutes * 6 + seconds * .1}deg) translateY(-50%)`;
        if (secondHand) secondHand.style.transform = `rotate(${seconds * 6}deg) translateY(-50%)`;
    }
    updateClock();
    window.setInterval(updateClock, 1000);
})();
</script>
