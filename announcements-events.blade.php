<!DOCTYPE html><html lang="ms"><head>
<style id="student-page-shell-width-fix">
  html, body { width: 100%; max-width: 100%; margin: 0; }
  body { min-width: 0; overflow-x: hidden; }
  .student-sidebar { width: 18rem !important; }
  .student-page-shell {
    width: calc(100% - 18rem);
    max-width: calc(100% - 18rem);
    margin-left: 18rem;
    min-width: 0;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
  }
  .student-page-shell > header,
  .student-page-shell > main,
  .student-page-shell > footer {
    width: 100%;
    max-width: 100%;
    min-width: 0;
    box-sizing: border-box;
  }
  .student-page-shell > main { overflow-x: hidden; }
  .student-page-shell img,
  .student-page-shell svg,
  .student-page-shell video,
  .student-page-shell iframe { max-width: 100%; }
  .student-page-shell .grid,
  .student-page-shell .grid > *,
  .student-page-shell .flex > * { min-width: 0; }
  @media (max-width: 767px) {
    .student-page-shell {
      width: 100%;
      max-width: 100%;
      margin-left: 0;
    }
  }
</style>


<meta charset="utf-8"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta content="web_standard" name="shell-type"><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600&amp;family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "on-surface": "#1c1b1b", "tertiary-container": "#1e2226", "surface-dim": "#dcd9d9", "tertiary-fixed": "#e0e3e8", "on-background": "#1c1b1b", "tertiary": "#070b0f", "outline-variant": "#c4c6cf", "outline": "#74777f", "on-surface-variant": "#44474e", "on-tertiary": "#ffffff", "primary-fixed": "#d6e3ff", "surface-tint": "#465f88", "surface-container-highest": "#e5e2e1", "on-secondary-fixed-variant": "#574500", "surface-bright": "#fcf9f8", "secondary": "#735c00", "surface-container-low": "#f6f3f2", "surface-container-lowest": "#ffffff", "on-secondary": "#ffffff", "secondary-fixed-dim": "#e9c349", "on-error-container": "#93000a", "inverse-primary": "#aec7f6", "on-primary-fixed-variant": "#2d476f", "primary-container": "#002147", "surface-container-high": "#eae7e7", "background": "#fcf9f8", "on-secondary-fixed": "#241a00", "surface-variant": "#e5e2e1", "inverse-on-surface": "#f3f0ef", "on-tertiary-fixed": "#181c20", "surface": "#fcf9f8", "on-error": "#ffffff", "error": "#ba1a1a", "primary": "#000a1e", "secondary-container": "#fed65b", "on-tertiary-container": "#85898e", "on-primary-fixed": "#001b3d", "inverse-surface": "#313030", "on-tertiary-fixed-variant": "#43474b", "tertiary-fixed-dim": "#c3c7cc", "on-secondary-container": "#745c00", "error-container": "#ffdad6", "primary-fixed-dim": "#aec7f6", "secondary-fixed": "#ffe088", "on-primary": "#ffffff", "surface-container": "#f0eded", "on-primary-container": "#708ab5" }, "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }, "spacing": {}, "fontFamily": { "headline": [ "Hanken Grotesk" ], "display": [ "Hanken Grotesk" ], "body": [ "\"Source Serif 4\"" ], "label": [ "Hanken Grotesk" ] }, "fontSize": {} } } }</script></head><body class="bg-surface font-body text-on-surface">@include('student.partials.sidebar')<div class="student-page-shell">
@include('student.partials.topbar')<main class="w-full pt-0 bg-surface min-h-[calc(100vh-20rem)]"><div class="flex flex-col w-full">
<!-- Seksyen 1: Hero Header & Bento Metric Deck (Variant 2 Restructuring) -->
<section class="w-full bg-surface-container-low pt-8 pb-10 border-b border-outline-variant/30">
<div class="max-w-[1280px] mx-auto px-6 lg:px-12">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-label text-on-surface-variant mb-5">
<a class="hover:text-primary transition-colors" href="#">Kolej Profesional MARA Beranang</a>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<a class="hover:text-primary transition-colors" href="#">Hal Ehwal Pelajar &amp; Akademik</a>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<span class="text-primary font-semibold">Hebahan &amp; Acara Rasmi</span>
</nav>
<!-- Tajuk & Tindakan Utama -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6">
<div class="space-y-3 max-w-3xl">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container text-primary font-label text-xs font-semibold">
<span class="w-2 h-2 rounded-full bg-secondary"></span>
Pusat Maklumat Rasmi KPM Beranang
</div>
<h1 class="font-headline font-bold text-3xl sm:text-4xl lg:text-5xl text-primary tracking-tight leading-tight">
Hebahan &amp; Takwim Acara Kampus
</h1>
<p class="font-body text-base sm:text-lg text-on-surface-variant leading-relaxed">
Dapatkan hebahan rasmi kolej dan maklumat acara kampus yang akan datang dalam satu halaman.
</p>
</div>
<div class="flex flex-wrap items-center gap-3 shrink-0">
<a href="{{ asset('documents/takwim-akademik-sesi-2-2026-2027.pdf') }}" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary text-on-primary font-label font-semibold text-xs shadow-sm hover:bg-primary-container transition-colors">
<span class="material-symbols-outlined text-[18px]">download</span>
Muat Turun Takwim PDF
</a>
<a href="#senarai-acara" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-highest text-primary font-label font-semibold text-xs hover:bg-surface-dim transition-colors">
<span class="material-symbols-outlined text-[18px]">event</span>
Lihat Acara Kampus
</a>
</div>
</div>
<!-- Top Bento Deck (Horizontal 4-Stat Strip) -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-3.5 pt-2">
<div class="p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between shadow-xs">
<div class="flex items-center justify-between">
<span class="text-xs font-label text-on-surface-variant uppercase tracking-wider font-semibold">Hebahan Aktif</span>
<span class="material-symbols-outlined text-primary text-[18px]">campaign</span>
</div>
<div class="flex items-baseline gap-1 mt-3">
<span class="font-headline text-3xl font-bold text-primary">{{ $activeAnnouncementsCount }}</span>
<span class="text-xs font-label text-secondary font-medium">notis</span>
</div>
<span class="text-[11px] font-label text-on-surface-variant mt-1.5">Jumlah hebahan yang diterbitkan</span>
</div>
<div class="p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between shadow-xs">
<div class="flex items-center justify-between">
<span class="text-xs font-label text-on-surface-variant uppercase tracking-wider font-semibold">Acara Bulan Ini</span>
<span class="material-symbols-outlined text-secondary text-[18px]">event</span>
</div>
<div class="flex items-baseline gap-1 mt-3">
<span class="font-headline text-3xl font-bold text-primary">{{ $monthlyEventsCount }}</span>
<span class="text-xs font-label text-secondary font-medium">agenda</span>
</div>
<span class="text-[11px] font-label text-on-surface-variant mt-1.5">{{ now()->translatedFormat('F Y') }}</span>
</div>
<div class="p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between shadow-xs">
<div class="flex items-center justify-between">
<span class="text-xs font-label text-on-surface-variant uppercase tracking-wider font-semibold">Sesi Akademik</span>
<span class="material-symbols-outlined text-on-surface-variant text-[18px]">school</span>
</div>
<div class="mt-3">
<span class="font-headline text-lg sm:text-xl font-bold text-primary">Sesi 2 2026 / 2027</span>
</div>
<span class="text-[11px] font-label text-on-surface-variant mt-1.5">Sesi akademik semasa KPM Beranang</span>
</div>
<div class="p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between shadow-xs">
<div class="flex items-center justify-between">
<span class="text-xs font-label text-on-surface-variant uppercase tracking-wider font-semibold">Pengesahan</span>
<span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<div class="mt-3">
<span class="font-headline text-base font-bold text-primary">HEA &amp; HEP</span>
</div>
<span class="text-[11px] font-label text-on-surface-variant mt-1.5">Saluran Sah MARA</span>
</div>
</div>
</div>
</section>
<!-- Data hebahan dan acara diambil daripada database melalui controller -->
@php
    $announcementPosts = $announcements->getCollection()->map(function ($announcement) {
        return [
            'title' => $announcement->title,
            'date' => $announcement->date_published?->translatedFormat('d M Y') ?? '',
            'image' => $announcement->image_path,
            'summary' => \Illuminate\Support\Str::limit(strip_tags($announcement->content), 180),
            'content' => $announcement->content,
        ];
    })->values()->all();

    $eventPosts = $events->getCollection()->map(function ($event) {
        return [
            'title' => $event->event_name,
            'date' => $event->created_at?->translatedFormat('d M Y') ?? '',
            'event_date' => $event->event_date?->translatedFormat('d M Y') ?? '',
            'image' => $event->image_path,
            'venue' => $event->venue ?? 'Tempat akan dimaklumkan',
            'summary' => \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 180),
            'content' => $event->description ?? '',
        ];
    })->values()->all();
@endphp
<!-- Seksyen 2: Sorotan terkini - hebahan paling baharu di sebelah kanan -->
<section class="max-w-[1280px] mx-auto px-6 lg:px-12 mt-8 w-full">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
@if (!empty($eventPosts))
    @php
        $featuredEventPost = $eventPosts[0];
    @endphp
<article class="lg:col-span-7 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md flex flex-col justify-between group border border-outline-variant/20">
<button type="button" class="post-open relative min-h-64 sm:min-h-72 w-full overflow-hidden bg-primary-container text-left"
    data-post-title="{{ $featuredEventPost['title'] }}"
    data-post-content="{{ $featuredEventPost['content'] }}"
    data-post-image="{{ $featuredEventPost['image'] ? asset('images/announcements_events/' . $featuredEventPost['image']) : '' }}"
    data-post-date="Disiarkan {{ $featuredEventPost['date'] }}" data-post-type="Acara Kampus">
    @if ($featuredEventPost['image'])
        <img src="{{ asset('images/announcements_events/' . $featuredEventPost['image']) }}" alt="{{ $featuredEventPost['title'] }}" class="absolute inset-0 w-full h-full object-cover opacity-60" loading="eager">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/60 to-primary/10"></div>
    <div class="relative flex flex-col justify-end p-6 sm:p-8 text-white min-h-64 sm:min-h-72">
        <span class="inline-flex w-fit px-3 py-1 rounded bg-secondary text-primary font-label text-xs font-bold uppercase mb-3">Sorotan Acara</span>
        <h2 class="font-headline font-bold text-2xl sm:text-3xl leading-tight">{{ $featuredEventPost['title'] }}</h2>
        <p class="font-body text-sm sm:text-base mt-3 text-white/90">{{ $featuredEventPost['summary'] }}</p>
        <div class="mt-4 flex flex-wrap gap-4 text-xs sm:text-sm font-label">
            <span><span class="material-symbols-outlined align-middle text-base">calendar_month</span> Tarikh acara: {{ $featuredEventPost['event_date'] }}</span>
            <span><span class="material-symbols-outlined align-middle text-base">location_on</span> {{ $featuredEventPost['venue'] }}</span>
        </div>
        <span class="mt-4 text-xs font-label font-semibold underline underline-offset-4">Buka post penuh →</span>
    </div>
</button>
</article>
@else
<article class="lg:col-span-7 bg-surface-container-lowest rounded-xl border border-outline-variant/20 p-6 sm:p-8 flex items-center">
    <div class="space-y-2">
        <span class="inline-flex px-3 py-1 rounded bg-secondary-fixed text-on-secondary-fixed-variant font-label text-xs font-bold uppercase">Sorotan Acara</span>
        <h2 class="font-headline font-bold text-xl text-primary">Tiada acara akan datang</h2>
        <p class="font-body text-sm text-on-surface-variant">Acara kampus yang akan datang akan dipaparkan di sini apabila tersedia.</p>
    </div>
</article>
@endif

@if (!empty($announcementPosts))
    @php
        $featuredAnnouncementPost = $announcementPosts[0];
    @endphp
<article class="lg:col-span-5 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md flex flex-col justify-between border border-outline-variant/20">
<button type="button" class="post-open block text-left w-full"
    data-post-title="{{ $featuredAnnouncementPost['title'] }}"
    data-post-content="{{ $featuredAnnouncementPost['content'] }}"
    data-post-image="{{ $featuredAnnouncementPost['image'] ? asset('images/announcements_events/' . $featuredAnnouncementPost['image']) : '' }}"
    data-post-date="Diterbitkan {{ $featuredAnnouncementPost['date'] }}" data-post-type="Hebahan Rasmi">
    @if ($featuredAnnouncementPost['image'])
        <img src="{{ asset('images/announcements_events/' . $featuredAnnouncementPost['image']) }}" alt="{{ $featuredAnnouncementPost['title'] }}" class="w-full max-h-64 object-contain bg-surface-container-low" loading="eager">
    @endif
    <div class="p-6 sm:p-8">
        <div class="flex items-center gap-2 mb-4"><span class="material-symbols-outlined text-secondary text-2xl">campaign</span><span class="font-label text-xs font-bold uppercase tracking-wider text-secondary">Hebahan Terkini · {{ $featuredAnnouncementPost['date'] }}</span></div>
        <h2 class="font-headline font-bold text-xl sm:text-2xl text-primary leading-tight">{{ $featuredAnnouncementPost['title'] }}</h2>
        <p class="font-body text-sm text-on-surface-variant leading-relaxed mt-3 whitespace-pre-line">{{ $featuredAnnouncementPost['summary'] }}</p>
        <div class="mt-5 pt-4 border-t border-outline-variant/20 flex items-center justify-between gap-3"><span class="text-xs font-label text-on-surface-variant">Diterbitkan {{ $featuredAnnouncementPost['date'] }}</span><span class="text-xs font-label font-semibold text-secondary">Baca hebahan penuh ↓</span></div>
    </div>
</button>
</article>
@else
<article class="lg:col-span-5 bg-surface-container-lowest rounded-xl border border-outline-variant/20 p-6 sm:p-8 flex items-center">
    <div class="space-y-2">
        <span class="material-symbols-outlined text-secondary text-2xl">campaign</span>
        <h2 class="font-headline font-bold text-xl text-primary">Tiada hebahan terkini</h2>
        <p class="font-body text-sm text-on-surface-variant">Hebahan rasmi yang diterbitkan akan dipaparkan di sini.</p>
    </div>
</article>
@endif
</div></section>
<!-- Seksyen 3: Carian & penapis ringkas -->
<section class="max-w-[1280px] mx-auto px-6 lg:px-12 mt-10 w-full">
  <div class="bg-surface-container-lowest p-4 sm:p-5 rounded-xl shadow-sm border border-outline-variant/30">
    <div class="grid grid-cols-1 md:grid-cols-[minmax(0,1fr)_220px] gap-3 items-center">
      <div class="relative">
        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
        <input class="w-full pl-10 pr-4 py-3 rounded-lg bg-surface-container-low text-sm font-label text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-secondary/50 border border-transparent focus:border-secondary" id="keyword-search" placeholder="Cari tajuk hebahan, acara atau lokasi..." type="search">
      </div>
      <select id="post-type-filter" class="w-full px-4 py-3 rounded-lg bg-surface-container-low text-sm font-label text-primary border border-transparent focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary">
        <option value="all">Semua hebahan &amp; acara</option>
        <option value="announcement">Hebahan rasmi sahaja</option>
        <option value="event">Acara kampus sahaja</option>
      </select>
    </div>
  </div>
</section>
<!-- Seksyen 4: Split-Stream 50/50 Dual Dossier Workspaces -->
<section class="max-w-[1280px] mx-auto px-6 lg:px-12 mt-8 mb-16 w-full">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8 items-start">
<!-- Dossier Sebelah Kiri: Senarai Hebahan Rasmi & Pekeliling -->
<div class="lg:col-span-7 space-y-6">
<div class="flex items-center justify-between pb-2 border-b border-outline-variant/30">
<div>
<h2 class="font-headline font-bold text-2xl text-primary tracking-tight">Senarai Hebahan &amp; Pekeliling</h2>
<p class="font-body text-xs text-on-surface-variant mt-0.5">Hebahan rasmi dipaparkan mengikut tarikh siaran, daripada yang terkini hingga terdahulu</p>
</div>
<span class="text-xs font-label font-semibold text-secondary bg-secondary-fixed/40 px-2.5 py-1 rounded">{{ $announcements->total() }} Hebahan Rasmi</span>
</div>
<div class="space-y-4" id="senarai-hebahan">
@if (empty($announcementPosts))
<div class="p-5 rounded-xl bg-surface-container-low border border-outline-variant/20 space-y-2">
    <h3 class="font-headline font-bold text-base text-primary">Tiada hebahan terkini</h3>
    <p class="font-body text-sm text-on-surface-variant">Hebahan rasmi yang diterbitkan akan dipaparkan di sini.</p>
</div>
@else
@foreach ($announcementPosts as $announcementPost)
@if (!$loop->first)
<article class="announcement-card bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group border border-outline-variant/20" data-post-kind="announcement" data-search="{{ strtolower($announcementPost['title'] . ' ' . $announcementPost['content']) }}">
<button type="button" class="post-open block w-full text-left" data-post-title="{{ $announcementPost['title'] }}" data-post-content="{{ $announcementPost['content'] }}" data-post-image="{{ asset('images/announcements_events/' . $announcementPost['image']) }}" data-post-date="{{ $announcementPost['date'] }}" data-post-type="Hebahan Rasmi">
<img src="{{ asset('images/announcements_events/' . $announcementPost['image']) }}" alt="{{ $announcementPost['title'] }}" class="w-full aspect-[4/3] object-contain bg-surface-container-low" loading="lazy">
</button>
<div class="p-5"><div class="flex flex-wrap items-center gap-2 mb-2"><span class="px-2.5 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed-variant font-label text-xs font-bold uppercase">Hebahan Rasmi</span><span class="text-xs font-label text-on-surface-variant">• {{ $announcementPost['date'] }}</span></div>
<h3 class="font-headline font-semibold text-lg text-primary group-hover:text-secondary transition-colors mb-2">{{ $announcementPost['title'] }}</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed mb-4 whitespace-pre-line">{{ $announcementPost['summary'] }}</p>
<button type="button" class="post-open inline-flex items-center gap-2 text-xs font-label font-semibold text-secondary hover:underline" data-post-title="{{ $announcementPost['title'] }}" data-post-content="{{ $announcementPost['content'] }}" data-post-image="{{ asset('images/announcements_events/' . $announcementPost['image']) }}" data-post-date="Diterbitkan {{ $announcementPost['date'] }}" data-post-type="Hebahan Rasmi"><span class="material-symbols-outlined text-base">open_in_new</span> Baca hebahan penuh</button>
<div class="flex flex-wrap items-center justify-between gap-3 mt-4 pt-3 bg-surface-container-low p-3 rounded-lg"><div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span class="material-symbols-outlined text-base text-primary">campaign</span><span>Hebahan KPM Beranang</span></div><span class="text-xs font-label text-on-surface-variant">Diterbitkan {{ $announcementPost['date'] }}</span></div></div></article>
@endif
@endforeach
@endif

</div>
</div>
<!-- Dossier Sebelah Kanan: Takwim Interaktif & Acara Kampus -->
<aside aria-label="Takwim Acara Kampus" class="lg:col-span-5 space-y-6">
<!-- Widget Kalendar Dinamik -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/30">
<div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant/20"><div><h3 class="font-headline font-bold text-xl text-primary">Takwim Kampus</h3><p class="font-body text-xs text-on-surface-variant">{{ now()->translatedFormat('F Y') }}</p></div><span class="material-symbols-outlined text-secondary text-2xl">calendar_month</span></div>
<div class="grid grid-cols-7 gap-1 text-center font-label text-xs mb-2"><span class="text-on-surface-variant font-medium py-1">Ah</span><span class="text-on-surface-variant font-medium py-1">Is</span><span class="text-on-surface-variant font-medium py-1">Se</span><span class="text-on-surface-variant font-medium py-1">Ra</span><span class="text-on-surface-variant font-medium py-1">Kh</span><span class="text-on-surface-variant font-medium py-1">Ju</span><span class="text-on-surface-variant font-medium py-1">Sa</span></div>
<div class="grid grid-cols-7 gap-1 text-center font-label text-xs">
@php
    $calendarMonth = now()->startOfMonth();
@endphp
@for ($blank = 0; $blank < $calendarMonth->dayOfWeek; $blank++)
    <span class="py-2"></span>
@endfor

@for ($day = 1; $day <= $calendarMonth->daysInMonth; $day++)
    @php
        $hasEvent = collect($eventPosts)->contains(function ($calendarEvent) use ($day, $calendarMonth) {
            $rawDate = $calendarEvent['event_date'] ?? null;
            if (!$rawDate) {
                return false;
            }

            try {
                if ($rawDate instanceof \Carbon\CarbonInterface) {
                    $eventDate = $rawDate;
                } else {
                    $normalizedDate = str_replace(
                        ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis'],
                        ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        (string) $rawDate
                    );
                    $eventDate = \Carbon\Carbon::parse($normalizedDate);
                }

                return $eventDate->isSameMonth($calendarMonth) && $eventDate->day === $day;
            } catch (\Throwable $exception) {
                return false;
            }
        });
    @endphp

    @if ($hasEvent)
        <span title="Acara kampus" class="py-2 rounded bg-secondary text-primary font-bold shadow-xs">{{ $day }}</span>
    @else
        <span class="py-2 rounded {{ $day === now()->day ? 'bg-primary-container text-on-primary font-bold' : 'text-on-surface hover:bg-surface-container' }}">{{ $day }}</span>
    @endif
@endfor
</div>
<div class="mt-4 pt-3 border-t border-outline-variant/20 flex flex-wrap items-center gap-3 text-[11px] font-label text-on-surface-variant"><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-secondary"></span> Hari yang mempunyai acara</span><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-primary-container"></span> Hari ini</span></div>
</div>
<!-- Senarai Hebahan & Acara PERDIQMA / MPP -->
<div id="senarai-acara" class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/30 space-y-4 scroll-mt-24">
<div class="flex items-center justify-between pb-2 border-b border-outline-variant/20">
<div>
<h3 class="font-headline font-bold text-lg text-primary">Hebahan & Acara PERDIQMA / MPP</h3>
<p class="font-body text-xs text-on-surface-variant">Termasuk rekod acara terdahulu berdasarkan tarikh siaran rasmi</p>
</div>
<a class="text-xs font-label font-semibold text-secondary hover:underline" href="#senarai-acara">Semua Acara →</a>
</div>
<div class="space-y-3">
@if (empty($eventPosts))
<div class="p-5 rounded-lg bg-surface-container-low space-y-2">
    <h4 class="font-headline font-bold text-base text-primary">Tiada acara akan datang</h4>
    <p class="font-body text-sm text-on-surface-variant">Acara kampus yang akan datang akan dipaparkan di sini apabila tersedia.</p>
</div>
@else
@foreach ($eventPosts as $eventPost)
<div class="event-card p-3.5 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors flex gap-3 items-start" data-post-kind="event" data-search="{{ strtolower($eventPost['title'] . ' ' . $eventPost['content'] . ' ' . $eventPost['venue']) }}">
<button type="button" class="post-open shrink-0 w-20 h-28 rounded-lg overflow-hidden" data-post-title="{{ $eventPost['title'] }}" data-post-content="{{ $eventPost['content'] }}" data-post-image="{{ asset('images/announcements_events/' . $eventPost['image']) }}" data-post-date="Disiarkan {{ $eventPost['date'] }}" data-post-type="Acara Kampus"><img src="{{ asset('images/announcements_events/' . $eventPost['image']) }}" alt="{{ $eventPost['title'] }}" class="w-full h-full object-contain bg-white" loading="lazy"></button>
<div class="min-w-0 flex-1"><div class="flex items-center gap-2 mb-1 flex-wrap"><span class="text-[10px] font-label font-bold uppercase px-2 py-0.5 rounded bg-surface-container-highest text-primary">Acara Kampus</span><span class="text-[11px] font-label text-on-surface-variant">Disiarkan {{ $eventPost['date'] }}</span></div>
<h4 class="font-headline font-semibold text-sm text-primary">{{ $eventPost['title'] }}</h4><p class="font-body text-xs text-on-surface-variant mt-0.5">{{ $eventPost['venue'] }} · Tarikh acara: {{ $eventPost['event_date'] }}</p><p class="font-body text-xs text-on-surface-variant mt-1">{{ $eventPost['summary'] }}</p>
<button type="button" class="post-open mt-2 text-xs font-label font-semibold text-secondary hover:underline" data-post-title="{{ $eventPost['title'] }}" data-post-content="{{ $eventPost['content'] }}" data-post-image="{{ asset('images/announcements_events/' . $eventPost['image']) }}" data-post-date="Disiarkan {{ $eventPost['date'] }}" data-post-type="Acara Kampus">Lihat post penuh →</button></div></div>
@endforeach
@endif

<!-- Tempahan Ruang Acara & Sokongan Logistik Kampus -->

</div>
</div>
</aside>
</div>
</section>
<!-- Seksyen 5: Bottom Service Dock (Horizontal 3-Column Shortcuts) -->

<!-- Modal post gaya Instagram untuk hebahan/acara -->
<div id="post-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 p-4" role="dialog" aria-modal="true" aria-labelledby="post-modal-title">
  <div class="relative flex max-h-[90vh] w-full max-w-5xl flex-col overflow-hidden rounded-2xl bg-white shadow-2xl md:flex-row">
    <button type="button" id="post-modal-close" aria-label="Tutup" class="absolute right-3 top-3 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/70 text-white hover:bg-black">✕</button>
    <div id="post-modal-image-wrap" class="flex max-h-[55vh] items-center justify-center bg-black md:max-h-[90vh] md:w-1/2">
      <img id="post-modal-image" src="" alt="" class="max-h-[55vh] w-full object-contain md:max-h-[90vh]">
    </div>
    <div class="flex min-h-0 flex-col md:w-1/2">
      <div class="border-b border-gray-200 p-5">
        <p id="post-modal-type" class="text-xs font-bold uppercase tracking-wider text-amber-700"></p>
        <h2 id="post-modal-title" class="mt-2 text-xl font-bold text-slate-900"></h2>
        <p id="post-modal-date" class="mt-1 text-xs text-slate-500"></p>
      </div>
      <div id="post-modal-content" class="overflow-y-auto whitespace-pre-line p-5 text-sm leading-7 text-slate-700"></div>
      <div class="mt-auto border-t border-gray-200 p-4 text-xs text-slate-500">Kolej Profesional MARA Beranang</div>
    </div>
  </div>
</div>

<!-- Skrip Interaktif: Penapis Kategori & Carian Teks Segera -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Modal post bergambar
  const postModal = document.getElementById('post-modal');
  const closePostModal = () => {
    postModal.classList.add('hidden');
    postModal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
  };
  document.querySelectorAll('.post-open').forEach((button) => {
    button.addEventListener('click', () => {
      const title = button.dataset.postTitle || 'Hebahan & Acara';
      const content = button.dataset.postContent || '';
      const image = button.dataset.postImage || '';
      document.getElementById('post-modal-title').textContent = title;
      document.getElementById('post-modal-content').textContent = content;
      document.getElementById('post-modal-date').textContent = button.dataset.postDate || '';
      document.getElementById('post-modal-type').textContent = button.dataset.postType || '';
      const imageElement = document.getElementById('post-modal-image');
      const imageWrap = document.getElementById('post-modal-image-wrap');
      imageElement.src = image;
      imageElement.alt = title;
      imageWrap.classList.toggle('hidden', !image);
      postModal.classList.remove('hidden');
      postModal.classList.add('flex');
      document.body.classList.add('overflow-hidden');
    });
  });
  document.getElementById('post-modal-close')?.addEventListener('click', closePostModal);
  postModal?.addEventListener('click', (event) => {
    if (event.target === postModal) closePostModal();
  });
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closePostModal();
  });

  // Carian dan penapis jenis kandungan
  const searchInput = document.getElementById('keyword-search');
  const typeFilter = document.getElementById('post-type-filter');
  const cards = document.querySelectorAll('.announcement-card, .event-card');
  const applyFilters = () => {
    const keyword = (searchInput?.value || '').toLocaleLowerCase('ms').trim();
    const selectedType = typeFilter?.value || 'all';
    cards.forEach((card) => {
      const text = (card.dataset.search || card.innerText || '').toLocaleLowerCase('ms');
      const matchesKeyword = !keyword || text.includes(keyword);
      const matchesType = selectedType === 'all' || card.dataset.postKind === selectedType;
      card.style.display = matchesKeyword && matchesType ? '' : 'none';
    });
  };
  searchInput?.addEventListener('input', applyFilters);
  typeFilter?.addEventListener('change', applyFilters);
});
</script>
</div></main><footer class="w-full bg-surface-container-low text-on-surface mt-20"><div class="max-w-[1280px] mx-auto px-6 lg:px-12 pt-16 pb-12"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10"><div class="space-y-4"><div class="flex items-center gap-3"><img alt="Logo_kpm.gif" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1VRFAFkayvMpJpwSVvn4_p8P_BFxUzF7o6Y09TTzXN4DTK56xOg8hXuYhJDDdr0dopzlsdEJFgTpa1nLs1MRiSC_gLIUSy_cKINPE2OmufNwCKF7WcfZgmq1MATa1ig_KjQVUCO_TwXzXY3sv536XHQciKP8J9yBag_1FfYg7cunEmyjOn0GyP4Sk_cfeHLRIaWKProHkdhT589IrEOlfmVEi3CDV49UisCXR5XbO3Gt0Lx9QiA7V_nvC78hRmxpCKHQt7TKiwi"><span class="font-headline font-bold text-primary text-base">KPM Beranang</span></div><p class="font-body text-sm text-on-surface-variant leading-relaxed">Institusi pendidikan MARA yang komited melahirkan modal insan profesional berintegriti, berdaya saing, dan berwibawa.</p><div class="space-y-1 text-xs font-label text-on-surface-variant"><p class="font-semibold text-primary">Kolej Profesional MARA Beranang</p><p class="">Lot 2333, Jalan Kajang-Seremban</p><p class="">43700 Beranang, Selangor Darul Ehsan</p></div></div><div class="space-y-3"><h3 class="font-headline font-semibold text-primary text-sm uppercase tracking-wider">Pautan Akademik</h3><ul class="space-y-2 text-sm font-label text-on-surface-variant"><li class=""><a class="hover:text-primary transition-colors" href="#">Kalendar Akademik</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Sistem Pengurusan Pelajar (SPP)</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">e-Learning &amp; Bahan Kuliah</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Garis Panduan Peperiksaan</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Perpustakaan Al-Ghazali</a></li></ul></div><div class="space-y-3"><h3 class="font-headline font-semibold text-primary text-sm uppercase tracking-wider">Perkhidmatan Pelajar</h3><ul class="space-y-2 text-sm font-label text-on-surface-variant"><li class=""><a class="hover:text-primary transition-colors" href="#">Hal Ehwal Pelajar (HEP)</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Unit Kaunseling &amp; Kerjaya</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Penginapan &amp; Kediaman</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Kesihatan &amp; Keselamatan</a></li><li class=""><a class="hover:text-primary transition-colors" href="#">Aduan &amp; Maklum Balas</a></li></ul></div><div class="space-y-3"><h3 class="font-headline font-semibold text-primary text-sm uppercase tracking-wider">Talian Kecemasan &amp; Bantuan</h3><div class="space-y-2 text-xs font-label text-on-surface-variant"><div class="bg-surface-container rounded-lg p-3 space-y-1"><p class="text-primary font-bold">Pos Kawalan Keselamatan (24 Jam)</p><p class="text-on-surface">+603-8766 8282 / 8283</p></div><div class="bg-surface-container rounded-lg p-3 space-y-1"><p class="text-primary font-bold">Unit Kesihatan &amp; Kecemasan</p><p class="text-on-surface">+603-8766 8111</p></div><div class="bg-surface-container rounded-lg p-3 space-y-1"><p class="text-primary font-bold">Emel Rasmi Pentadbiran</p><p class="text-on-surface">info.kpmb@mara.gov.my</p></div></div></div></div><div class="mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-label text-on-surface-variant"><p class="">© {{ now()->year }} Kolej Profesional MARA Beranang. Hak Cipta Terpelihara Majlis Amanah Rakyat (MARA).</p><div class="flex items-center gap-6"><a class="hover:text-primary transition-colors" href="#">Dasar Privasi</a><a class="hover:text-primary transition-colors" href="#">Dasar Keselamatan</a><a class="hover:text-primary transition-colors" href="#">Penafian</a></div></div></div></footer>

</div></body></html>