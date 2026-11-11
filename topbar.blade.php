{{-- Topbar UPP: reka bentuk baharu dengan identiti KPMB.
     Letakkan logo rasmi di public/images/kpmb-logo.png. --}}
<header class="upp-topbar fixed left-72 right-0 top-0 z-[60] border-b border-slate-200 bg-white/95 shadow-[0_4px_18px_rgba(7,27,54,0.08)] backdrop-blur">
    <div class="flex min-h-[88px] items-center justify-between gap-4 px-5 sm:px-7 lg:px-8">
        <div class="flex min-w-0 items-center gap-3 lg:gap-4">
            <a href="{{ url('/upp/dashboard') }}" class="flex shrink-0 items-center gap-2.5" aria-label="Kolej Profesional MARA Beranang">
                <img alt="Logo MARA" class="h-8 w-auto object-contain" src="{{ asset('images/Majlis_Amanah_Rakyat_logo.png') }}"/>
                <img alt="Logo KPM" class="h-8 w-auto object-contain" src="{{ asset('images/LogoKPM-1.png') }}"/>
                <div class="flex flex-col"><span class="font-headline font-bold text-base tracking-tight text-primary leading-tight">Kolej Profesional MARA</span><span class="font-label text-xs font-semibold text-secondary tracking-wide uppercase leading-tight">Beranang, Selangor</span></div>
            </a>
            <div class="hidden items-center gap-3 rounded-xl border border-slate-200 bg-[#f7f8fb] px-3.5 py-2.5 md:flex lg:px-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#071b36] text-[#ffd65a] shadow-sm"><span class="material-symbols-outlined text-xl">calendar_month</span></span>
                <span class="min-w-0">
                    <span class="block text-[9px] font-bold uppercase tracking-[0.14em] text-slate-500">Sesi Akademik</span>
                    <span class="font-headline text-xs sm:text-sm font-extrabold text-[#002147] whitespace-nowrap">Sesi 2, 2025/2026</span>
                </span>
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-3 sm:gap-4 lg:gap-6">
            <div class="flex items-center gap-3 rounded-xl bg-[#071b36] px-3.5 py-2.5 text-white shadow-sm sm:px-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-[#ffd65a]/60 bg-white/10 text-[#ffd65a]"><span class="material-symbols-outlined text-xl">schedule</span></span>
                <span class="min-w-[108px]">
                    <span id="live-clock" class="block whitespace-nowrap font-mono text-base font-bold leading-5 tracking-wide text-white sm:text-lg">--:--:--</span>
                    <span id="live-date" class="mt-1 block whitespace-nowrap text-[10px] font-medium text-slate-300">Memuatkan tarikh...</span>
                </span>
                <span class="ml-1 hidden h-8 w-px bg-white/20 lg:block"></span>
                <span class="hidden text-right lg:block"><span class="block text-[9px] font-bold uppercase tracking-[0.12em] text-[#ffd65a]">Waktu Tempatan</span><span class="mt-0.5 block text-[10px] text-slate-300">Malaysia · MYT</span></span>
            </div>

            <div class="hidden h-10 w-px bg-slate-200 xl:block"></div>
            <div class="hidden max-w-[165px] text-right sm:block">
                <div class="truncate font-headline text-xs font-bold text-[#071b36]">{{ $userName ?? auth()->user()->name ?? 'Pegawai UPP' }}</div>
                <div class="mt-0.5 font-headline text-[11px] text-slate-500">Pegawai UPP</div>
            </div>
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-2 border-[#f4d66b] bg-[#071b36] font-headline text-sm font-bold text-white shadow-sm">{{ mb_strtoupper(mb_substr($userName ?? auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <form action="{{ route('logout') }}" method="POST" class="shrink-0">@csrf
                <button type="submit" class="flex h-10 items-center gap-2 rounded-xl border border-red-200 bg-white px-3 font-headline text-xs font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50 sm:px-4"><span class="material-symbols-outlined text-base">logout</span><span class="hidden sm:inline">Log Keluar</span></button>
            </form>
        </div>
    </div>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200');
    html, body { min-height:100%; }
    body, body *:not(.material-symbols-outlined) { font-family:'Hanken Grotesk',sans-serif !important; }
    body { background:#f7f8fb !important; color:#172235; }
    .material-symbols-outlined { font-family:'Material Symbols Outlined' !important; font-weight:normal; font-style:normal; line-height:1; }
    .upp-topbar { min-height:88px; }
    main { padding-top:112px !important; }
    .main-shell, body > .pl-72, body > div.pl-72 { min-height:100vh; }
    main .rounded-xl[class*="bg-white"], main .rounded-2xl[class*="bg-white"], main .rounded-lg[class*="bg-white"],
    main .rounded-xl[class*="bg-surface"], main .rounded-2xl[class*="bg-surface"], main .rounded-lg[class*="bg-surface"],
    main .rounded-xl[class*="bg-background"], main .rounded-2xl[class*="bg-background"] {
        border:1px solid #d5dce7 !important;
        box-shadow:0 3px 12px rgba(7,27,54,.055);
    }
    @media(max-width:1023px) {
        .upp-topbar { left:0 !important; }
        .sidebar { transform:translateX(-100%); }
        .sidebar.is-open { transform:translateX(0); }
        .main-shell, body > .pl-72, body > div.pl-72 { margin-left:0 !important; padding-left:0 !important; }
        main { padding-top:104px !important; }
    }
</style>
<script>
(function () {
    function updateUppClock() {
        const clock = document.getElementById('live-clock');
        const date = document.getElementById('live-date');
        if (!clock || !date) return;
        const now = new Date();
        const time = new Intl.DateTimeFormat('en-MY', { timeZone:'Asia/Kuala_Lumpur', hour:'2-digit', minute:'2-digit', second:'2-digit', hour12:true }).format(now);
        const dayDate = new Intl.DateTimeFormat('ms-MY', { timeZone:'Asia/Kuala_Lumpur', weekday:'long', day:'numeric', month:'short', year:'numeric' }).format(now);
        clock.textContent = time;
        date.textContent = dayDate;
    }
    updateUppClock();
    if (!window.uppClockInterval) window.uppClockInterval = window.setInterval(updateUppClock, 1000);
})();
</script>
