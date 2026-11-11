<!DOCTYPE html>

<html class="h-full" lang="ms"><head>
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


<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><title>Kolej Profesional MARA Beranang - Student Hub</title><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&amp;display=swap" rel="stylesheet"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "tertiary-fixed": "#e0e3e8", "on-tertiary-fixed": "#181c20", "on-primary": "#ffffff", "surface": "#fcf9f8", "primary-fixed": "#d6e3ff", "outline": "#74777f", "inverse-on-surface": "#f3f0ef", "on-secondary-fixed-variant": "#574500", "secondary-container": "#fed65b", "background": "#fcf9f8", "tertiary-fixed-dim": "#c3c7cc", "surface-container-highest": "#e5e2e1", "primary": "#000a1e", "surface-container": "#f0eded", "on-secondary": "#ffffff", "error": "#ba1a1a", "on-tertiary": "#ffffff", "secondary": "#735c00", "on-secondary-container": "#745c00", "surface-container-lowest": "#ffffff", "secondary-fixed": "#ffe088", "inverse-surface": "#313030", "on-surface-variant": "#44474e", "on-primary-fixed": "#001b3d", "on-primary-fixed-variant": "#2d476f", "tertiary": "#070b0f", "secondary-fixed-dim": "#e9c349", "on-background": "#1c1b1b", "primary-container": "#002147", "on-error-container": "#93000a", "on-secondary-fixed": "#241a00", "surface-dim": "#dcd9d9", "on-tertiary-container": "#85898e", "on-surface": "#1c1b1b", "on-primary-container": "#708ab5", "surface-bright": "#fcf9f8", "surface-container-high": "#eae7e7", "surface-variant": "#e5e2e1", "tertiary-container": "#1e2226", "error-container": "#ffdad6", "surface-tint": "#465f88", "primary-fixed-dim": "#aec7f6", "surface-container-low": "#f6f3f2", "on-tertiary-fixed-variant": "#43474b", "outline-variant": "#c4c6cf", "inverse-primary": "#aec7f6", "on-error": "#ffffff" }, "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }, "spacing": {}, "fontFamily": { "headline": [ "Hanken Grotesk" ], "display": [ "Hanken Grotesk" ], "body": [ "\"Source Serif 4\"" ], "label": [ "Hanken Grotesk" ] }, "fontSize": {} } } }</script></head><body class="bg-surface font-body text-on-surface antialiased flex flex-col min-h-full">@include('student.partials.sidebar')<div class="student-page-shell">
@include('student.partials.topbar')<main class="w-full pt-0 bg-surface flex-1"><div class="max-w-[1280px] mx-auto px-6 py-8"><div class="flex flex-col w-full gap-8">
<!-- Pengepala Selamat Datang Peribadi (Welcome Banner) -->
<section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary via-primary-container to-primary text-on-primary shadow-xl p-7 md:p-9">
<div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-secondary/15 blur-3xl pointer-events-none"></div>
<div class="absolute right-1/3 -bottom-20 w-64 h-64 rounded-full bg-primary-fixed/10 blur-2xl pointer-events-none"></div>
<div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
<div class="flex flex-col gap-3">
<div class="flex flex-wrap items-center gap-2.5">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label font-semibold bg-secondary-container text-on-secondary-container shadow-sm">
<span class="w-2 h-2 rounded-full bg-secondary animate-ping"></span>
            Status: {{ Auth::user()->status === "active" ? "Aktif" : "Tidak aktif" }}
          </span>
<span class="px-3 py-1 rounded-full text-xs font-label font-medium bg-tertiary-container text-primary-fixed">
            Semester {{ $student?->semester ?? "—" }}
          </span>
<span class="hidden sm:inline-flex items-center gap-1 text-xs font-label text-tertiary-fixed">
<span class="material-symbols-outlined text-[15px] text-secondary-fixed">location_on</span>
            Kampus KPM Beranang, Selangor
          </span>
</div>
<div class="space-y-1">
<h1 class="font-headline font-bold text-2xl md:text-3xl lg:text-4xl tracking-tight text-on-primary">
            Selamat Kembali, {{ $student?->student_name ?? Auth::user()->name }}!
          </h1>
<p class="font-body text-sm md:text-base text-tertiary-fixed max-w-2xl leading-relaxed">
            No. Matrik: <span class="font-label font-semibold text-secondary-fixed">{{ $student?->student_id ?? "Belum tersedia" }}</span> • {{ $student?->programme ?? "Program belum dikemas kini" }}. Semak pendaftaran subjek, jadual waktu dan maklumat akademik anda di sini.
          </p>
</div>
</div>
<!-- Tindakan Pantas: jadual mingguan sebenar -->
<div class="flex flex-wrap items-center gap-2.5 sm:self-start lg:self-center shrink-0">
<a class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest/15 hover:bg-surface-container-lowest/25 text-on-primary transition-all font-label text-xs font-medium backdrop-blur-sm" href="{{ route('student.timetable') }}">
<span class="material-symbols-outlined text-[18px] text-primary-fixed">calendar_month</span>
Jadual Waktu
</a>
</div>
</div>
</section>
<!-- Kad Statistik Akademik -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
  
  <!-- Kelas Saya -->
  <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between relative overflow-hidden">
      <div class="absolute top-0 left-0 right-0 h-1 bg-secondary"></div>
      <div>
          <div class="flex items-center justify-between">
              <span class="font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Kelas Saya</span>
              <span class="p-1.5 rounded-lg bg-secondary-container/40 text-on-secondary-container"><span class="material-symbols-outlined text-[18px]">groups</span></span>
          </div>
          <div class="mt-3">
              <span class="font-headline font-bold text-2xl text-primary tracking-tight">{{ $studentGroup?->group_name ?? 'Belum ditetapkan' }}</span>
          </div>
      </div>
      <div class="mt-4 pt-3 text-xs font-label text-on-surface-variant">Kumpulan kelas yang ditetapkan kepada anda.</div>
  </div>

  <!-- Status Permohonan Pendaftaran -->
  <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-1 bg-primary-container"></div>
    <div>
      <div class="flex items-center justify-between">
        <span class="font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Pendaftaran Subjek</span>
        <span class="p-1.5 rounded-lg bg-surface-container text-primary"><span class="material-symbols-outlined text-[18px]">app_registration</span></span>
      </div>
      <div class="mt-3">
        <span class="font-headline font-bold text-2xl text-primary tracking-tight">{{ $registrationApplicationStatus }}</span>
      </div>
    </div>
    <div class="mt-4 pt-3 text-xs font-label text-on-surface-variant">
      Semester {{ $upcomingSemester }} · {{ $upcomingRegistrationCount }} subjek dalam permohonan.
    </div>
  </div>

  <!-- Subjek Diluluskan -->
  <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-1 bg-secondary"></div>
    <div>
      <div class="flex items-center justify-between">
        <span class="font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Subjek Diluluskan</span>
        <span class="p-1.5 rounded-lg bg-secondary-container/40 text-on-secondary-container"><span class="material-symbols-outlined text-[18px]">task_alt</span></span>
      </div>
      <div class="mt-3"><span class="font-headline font-bold text-3xl text-primary tracking-tight">{{ $approvedRegistrations }}</span><span class="ml-2 font-label text-xs text-on-surface-variant">subjek</span></div>
    </div>
    <div class="mt-4 pt-3 text-xs font-label text-on-surface-variant">Permohonan semester {{ $upcomingSemester }} yang telah diluluskan.</div>
  </div>

  <!-- Menunggu Kelulusan -->
  <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-1 bg-primary-container"></div>
    <div>
      <div class="flex items-center justify-between">
        <span class="font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Menunggu Kelulusan</span>
        <span class="p-1.5 rounded-lg bg-surface-container text-primary"><span class="material-symbols-outlined text-[18px]">hourglass_top</span></span>
      </div>
      <div class="mt-3"><span class="font-headline font-bold text-3xl text-primary tracking-tight">{{ $pendingRegistrations }}</span><span class="ml-2 font-label text-xs text-on-surface-variant">permohonan</span></div>
    </div>
    <div class="mt-4 pt-3 text-xs font-label text-on-surface-variant">Permohonan semester {{ $upcomingSemester }} yang masih menunggu keputusan.</div>
  </div>
</section>
<!-- Susun Atur Dwi-Lajur Pintar (Main 68% + Utility 32%) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- ==================== LAJUR KIRI (68% - 8 Cols) ==================== -->
<div class="lg:col-span-8 flex flex-col gap-8">
<!-- Jadual Kuliah & Makmal Hari Ini -->
<section class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col gap-5">
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[22px]">event_note</span>
</div>
<div>
<div class="flex items-center gap-2">
<h2 class="font-headline font-bold text-lg text-primary">Jadual Kuliah &amp; Makmal Hari Ini</h2>
<span class="px-2 py-0.5 rounded text-[10px] font-label font-bold bg-secondary-container text-on-secondary-container">{{ $todayDayName ?? 'Hari ini' }}</span>
</div>
<p class="font-body text-xs text-on-surface-variant">{{ $today?->translatedFormat('d F Y') ?? 'Jadual harian anda' }} · Ringkasan berdasarkan kumpulan kelas anda.</p>
</div>
</div>
<a class="inline-flex items-center gap-1 font-label text-xs font-bold text-secondary hover:text-on-secondary-container transition-colors self-start sm:self-auto" href="{{ route('student.timetable') }}">
Jadual Penuh Mingguan
<span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>

<div class="flex flex-col gap-3.5">
@if(!$studentGroup)
  <div class="rounded-xl border border-dashed border-outline-variant bg-surface-container-low p-6 text-center">
    <span class="material-symbols-outlined text-3xl text-outline">event_busy</span>
    <h3 class="mt-2 font-headline font-bold text-sm text-primary">Kumpulan kelas belum ditetapkan</h3>
    <p class="mt-1 font-body text-xs text-on-surface-variant">Jadual harian akan dipaparkan selepas kumpulan kelas anda ditetapkan dalam sistem.</p>
  </div>
@elseif(!$hasAnyTimetable)
  <div class="rounded-xl border border-dashed border-outline-variant bg-surface-container-low p-6 text-center">
    <span class="material-symbols-outlined text-3xl text-outline">calendar_month</span>
    <h3 class="mt-2 font-headline font-bold text-sm text-primary">Jadual belum tersedia</h3>
    <p class="mt-1 font-body text-xs text-on-surface-variant">Kumpulan {{ $studentGroup->group_name }} belum mempunyai rekod jadual kuliah atau makmal.</p>
  </div>
@elseif($todayClasses->isEmpty())
  <div class="rounded-xl border border-dashed border-outline-variant bg-surface-container-low p-6 text-center">
    <span class="material-symbols-outlined text-3xl text-outline">free_cancellation</span>
    <h3 class="mt-2 font-headline font-bold text-sm text-primary">Tiada kelas dijadualkan hari ini</h3>
    <p class="mt-1 font-body text-xs text-on-surface-variant">Tiada kuliah atau makmal direkodkan untuk hari {{ ($todayDayName) }} bagi kumpulan {{ $studentGroup->group_name }}.</p>
  </div>
@else
  @foreach($todayClasses as $class)
    @php
      $isCurrent = $class->status === 'Sedang berlangsung';
      $isUpcoming = $class->status === 'Akan datang';
    @endphp
    <div class="relative bg-surface-container-low rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all hover:bg-surface-container">
      <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $isCurrent ? 'bg-secondary' : ($isUpcoming ? 'bg-primary-container' : 'bg-outline-variant') }} rounded-l-xl"></div>
      <div class="flex items-start gap-3.5 pl-1.5">
        <div class="flex flex-col items-center justify-center {{ $isCurrent ? 'bg-primary-container text-on-primary' : 'bg-surface-container-high text-on-surface' }} rounded-lg px-2.5 py-2 min-w-[78px] shrink-0 text-center">
          <span class="font-headline font-bold text-xs tracking-tight">{{ $class->start_display }}</span>
          <span class="font-label text-[10px] {{ $isCurrent ? 'text-tertiary-fixed' : 'text-on-surface-variant' }}">{{ $class->end_display }}</span>
          <span class="mt-1 px-1.5 py-0.5 rounded text-[9px] font-semibold {{ $isCurrent ? 'bg-secondary text-on-secondary' : ($isUpcoming ? 'bg-primary-fixed text-on-primary-fixed' : 'bg-surface-container-highest text-on-surface-variant') }}">{{ $class->status }}</span>
        </div>
        <div class="space-y-1">
          <div class="flex flex-wrap items-center gap-2">
            <span class="font-label font-bold text-xs text-primary px-2 py-0.5 rounded bg-surface-container-highest">{{ $class->class_name }}</span>
            <h3 class="font-headline {{ $isCurrent ? 'font-bold' : 'font-semibold' }} text-sm text-primary">{{ $class->subject_name }}</h3>
          </div>
          <p class="font-body text-xs text-on-surface-variant flex flex-wrap items-center gap-x-3 gap-y-1">
            <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[15px] text-secondary">room</span>{{ $class->venue ?: 'Lokasi belum ditetapkan' }}</span>
            @if($class->lecturer_name)
              <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[15px] text-secondary">person</span>{{ $class->lecturer_name }}</span>
            @endif
          </p>
        </div>
      </div>
      <span class="text-xs font-label text-on-surface-variant bg-surface-container px-2.5 py-1 rounded-md self-start sm:self-center">{{ $isCurrent ? 'Sedang berlangsung' : ($isUpcoming ? 'Akan datang' : 'Selesai') }}</span>
    </div>
  @endforeach
@endif
</div>
</section>

<!-- Kalendar Akademik -->
<section id="kalendar-akademik" class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col gap-4">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-lg bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0">
        <span class="material-symbols-outlined text-[22px]">calendar_month</span>
      </div>
      <div>
        <h2 class="font-headline font-bold text-lg text-primary">Kalendar Akademik</h2>
        <p class="font-body text-xs text-on-surface-variant">Pilih tarikh untuk menyemak hari dan merancang aktiviti akademik.</p>
      </div>
    </div>
    <a href="{{ route('student.timetable') }}" class="inline-flex items-center gap-1 font-label text-xs font-bold text-secondary hover:text-on-secondary-container transition-colors">
      Lihat Jadual Waktu <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
    </a>
  </div>

  <div id="student-calendar" class="rounded-xl bg-surface-container-low p-4 sm:p-5"
       data-today="{{ now()->timezone('Asia/Kuala_Lumpur')->format('Y-m-d') }}">
    <div class="flex items-center justify-between gap-3 mb-4">
      <button type="button" id="calendar-prev" aria-label="Bulan sebelumnya" class="w-9 h-9 rounded-lg bg-white hover:bg-surface-container-high flex items-center justify-center text-primary transition-colors">
        <span class="material-symbols-outlined">chevron_left</span>
      </button>
      <div class="text-center">
        <h3 id="calendar-month-label" class="font-headline font-bold text-base sm:text-lg text-primary"></h3>
        <p id="calendar-selected-label" class="font-label text-xs text-on-surface-variant mt-0.5" aria-live="polite"></p>
      </div>
      <button type="button" id="calendar-next" aria-label="Bulan seterusnya" class="w-9 h-9 rounded-lg bg-white hover:bg-surface-container-high flex items-center justify-center text-primary transition-colors">
        <span class="material-symbols-outlined">chevron_right</span>
      </button>
    </div>
    <div class="grid grid-cols-7 gap-1 text-center mb-2" aria-hidden="true">
      @foreach(['Isn', 'Sel', 'Rab', 'Kha', 'Jum', 'Sab', 'Aha'] as $weekday)
        <span class="py-2 text-[10px] sm:text-xs font-label font-bold text-on-surface-variant">{{ $weekday }}</span>
      @endforeach
    </div>
    <div id="calendar-days" class="grid grid-cols-7 gap-1" role="grid" aria-label="Tarikh dalam bulan"></div>
    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-4 pt-3 border-t border-outline-variant/40 text-[11px] font-label text-on-surface-variant">
      <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-primary"></span> Hari dipilih</span>
      <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-secondary-container border border-secondary/30"></span> Hari ini</span>
    </div>
    <div class="mt-3 rounded-lg bg-white p-3 flex items-start gap-2">
      <span class="material-symbols-outlined text-secondary text-[18px]">event_available</span>
      <div>
        <p id="calendar-date-title" class="font-label font-bold text-sm text-primary"></p>
        <p id="calendar-date-description" class="font-body text-xs text-on-surface-variant mt-0.5">Buka Jadual Waktu untuk melihat butiran kelas bagi tarikh pilihan.</p>
      </div>
    </div>
  </div>
</section>

<!-- Subjek Berdaftar Sesi Semasa -->
<section class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col gap-4">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0">
        <span class="material-symbols-outlined text-[22px]">menu_book</span>
      </div>
      <div>
        <h2 class="font-headline font-bold text-lg text-primary">Subjek Berdaftar Sesi Semasa</h2>
        <p class="font-body text-xs text-on-surface-variant">Subjek yang telah diluluskan, bersama maklumat pengajaran dan kredit.</p>
      </div>
    </div>
  </div>

  @php
    $approvedSubjectRegistrations = collect($currentSemesterRegistrations ?? []);
  @endphp

  @if($approvedSubjectRegistrations->isNotEmpty())
    <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
      <table class="w-full min-w-[680px] text-left">
        <thead class="bg-surface-container-low">
          <tr>
            <th scope="col" class="px-4 py-3 font-label text-[11px] font-bold uppercase tracking-wide text-on-surface-variant">Kod Subjek</th>
            <th scope="col" class="px-4 py-3 font-label text-[11px] font-bold uppercase tracking-wide text-on-surface-variant">Nama Subjek</th>
            <th scope="col" class="px-4 py-3 font-label text-[11px] font-bold uppercase tracking-wide text-on-surface-variant">Pensyarah</th>
            <th scope="col" class="px-4 py-3 font-label text-[11px] font-bold uppercase tracking-wide text-on-surface-variant text-right">Jam Kredit</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant/30">
          @foreach($approvedSubjectRegistrations as $registration)
            @php
              $subject = $registration->subject ?? null;
              $classModel = $registration->classModel ?? null;
              // Use the official lecturer directory, not the system lecturer account/coordinator fallback.
              $lecturerName = data_get($classModel, 'lecturerDirectory.lecturer_name')
                  ?? data_get($classModel, 'lecturer.lecturer_name')
                  ?? 'Belum ditetapkan';
              $creditHours = data_get($subject, 'credit_hour');
            @endphp
            <tr class="hover:bg-surface-container-low/70 transition-colors">
              <td class="px-4 py-3 align-top">
                <span class="font-label font-bold text-xs text-primary">{{ data_get($subject, 'subject_code') ?? data_get($subject, 'code') ?? '—' }}</span>
              </td>
              <td class="px-4 py-3 align-top">
                <p class="font-headline font-semibold text-sm text-primary">{{ data_get($subject, 'subject_name') ?? data_get($subject, 'name') ?? 'Nama subjek belum tersedia' }}</p>
              </td>
              <td class="px-4 py-3 align-top">
                <span class="font-body text-sm text-on-surface-variant">{{ $lecturerName ?: 'Belum ditetapkan' }}</span>
              </td>
              <td class="px-4 py-3 align-top text-right">
                <span class="font-label font-semibold text-sm text-primary">{{ $creditHours !== null && $creditHours !== '' ? $creditHours : '—' }}</span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <p class="text-[11px] font-body text-on-surface-variant">Maklumat pensyarah dan jam kredit dipaparkan jika telah direkodkan dalam database.</p>
  @else
    <div class="rounded-xl border border-dashed border-outline-variant bg-surface-container-low p-6 text-center">
      <span class="material-symbols-outlined text-3xl text-outline">library_books</span>
      <h3 class="mt-2 font-headline font-bold text-sm text-primary">Tiada subjek diluluskan lagi</h3>
      <p class="mt-1 font-body text-xs text-on-surface-variant">Subjek yang telah diluluskan untuk semester semasa akan dipaparkan di sini.</p>
      <a href="{{ route('student.subject-registration') }}" class="mt-3 inline-flex items-center gap-1 text-xs font-label font-bold text-secondary hover:text-on-secondary-container">
        Semak pendaftaran <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
      </a>
    </div>
  @endif
</section>
</div>
<!-- ==================== LAJUR KANAN (32% - 4 Cols) ==================== -->
<div class="lg:col-span-4 flex flex-col gap-6">
<!-- Penasihat Akademik daripada pelantikan mentor aktif -->
<section class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-4">
  <div class="flex items-center justify-between">
    <span class="font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant">Penasihat Akademik</span>
    <span class="inline-flex items-center gap-1 text-[11px] font-label font-semibold text-secondary">
      <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span> Mentor Aktif
    </span>
  </div>
  @if($mentor && $mentor->lecturer_name)
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container-highest shrink-0 flex items-center justify-center">
        @if($mentor->photo_path)
          <img class="w-full h-full object-cover" alt="Gambar {{ $mentor->lecturer_name }}" src="{{ asset('storage/lecturers/' . $mentor->photo_path) }}">
        @else
          <span class="material-symbols-outlined text-2xl text-on-surface-variant">person</span>
        @endif
      </div>
      <div class="min-w-0">
        <h4 class="font-headline font-bold text-sm text-primary">{{ $mentor->lecturer_name }}</h4>
        <p class="font-body text-xs text-on-surface-variant">{{ $mentor->position ?? 'Pensyarah' }}</p>
        <p class="font-label text-[11px] text-on-surface-variant mt-0.5">{{ $mentor->department ?? 'Jabatan belum tersedia' }}</p>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-2 pt-1">
      @if($mentor->email)
        <a class="px-3 py-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors" href="mailto:{{ $mentor->email }}">
          <span class="material-symbols-outlined text-[16px]">mail</span> E-mel Mentor
        </a>
      @else
        <span class="px-3 py-2 rounded-lg bg-surface-container text-on-surface-variant font-label text-xs flex items-center justify-center gap-1.5"><span class="material-symbols-outlined text-[16px]">mail</span> E-mel tiada</span>
      @endif
      <a class="px-3 py-2 rounded-lg bg-primary text-on-primary hover:bg-primary/90 font-label text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors" href="{{ route('lecturers.index') }}">
        <span class="material-symbols-outlined text-[16px]">groups</span> Direktori Pensyarah
      </a>
    </div>
  @else
    <div class="rounded-lg bg-surface-container-low p-4 text-center">
      <span class="material-symbols-outlined text-2xl text-on-surface-variant">person_search</span>
      <h4 class="font-headline font-bold text-sm text-primary mt-1">Mentor belum ditetapkan</h4>
      <p class="font-body text-xs text-on-surface-variant mt-1">Maklumat penasihat akademik akan dipaparkan selepas pelantikan direkodkan.</p>
    </div>
    <a class="px-3 py-2 rounded-lg bg-primary text-on-primary hover:bg-primary/90 font-label text-xs font-semibold flex items-center justify-center gap-1.5" href="{{ route('lecturers.index') }}">
      <span class="material-symbols-outlined text-[16px]">groups</span> Lihat Direktori Pensyarah
    </a>
  @endif
</section>
<!-- Navigasi & Peta Pintar Kampus Beranang -->
<section class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-3.5">
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[18px] text-secondary">near_me</span>
<h3 class="font-headline font-bold text-sm text-primary">Navigasi Pantas Kampus</h3>
</div>
<span class="text-[11px] font-label text-on-surface-variant">Peta Kampus</span>
</div>
<!-- Mini Kampus Map Visual Container -->
<div class="relative w-full h-36 rounded-lg bg-surface-container-high overflow-hidden shadow-inner flex flex-col justify-end p-3" data-location="Kolej Profesional MARA Beranang, Selangor, Malaysia" style="">
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/30 to-transparent"></div>
<div class="relative z-10 flex items-center justify-between text-on-primary">
<div>
<p class="font-headline font-bold text-xs text-on-primary">Dewan Gemilang Ilmu</p>
<p class="font-label text-[10px] text-tertiary-fixed">Lihat lokasi dalam peta kampus</p>
</div>
<button class="px-2.5 py-1 rounded bg-secondary text-on-secondary font-label text-[11px] font-bold" onclick="window.location.href='{{ route('campus-map.index') }}'" type="button">
              Buka Peta
            </button>
</div>
</div>
<div class="space-y-1.5 text-xs font-body text-on-surface-variant">
<div class="flex items-center justify-between py-1">
<span class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[14px] text-secondary">local_library</span>
              Perpustakaan Ibnu Khaldun
            </span>
<span class="font-label font-semibold text-primary">Maklumat belum tersedia</span>
</div>
<div class="flex items-center justify-between py-1">
<span class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-[14px] text-secondary">restaurant</span>
              Kafeteria Siswa &amp; Siswi
            </span>
<span class="font-label font-semibold text-primary">Maklumat belum tersedia</span>
</div>
</div>
</section>
<!-- Hebahan & Notis Terkini Kampus -->
<section class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-4">

    <div class="flex items-center justify-between">
        <h3 class="font-headline font-bold text-sm text-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px] text-secondary">campaign</span>
            Hebahan Terkini Kampus
        </h3>

        <button
            class="font-label text-xs font-bold text-secondary hover:underline"
            onclick="window.location.href='{{ route('student.announcements-events') }}'"
            type="button">
            Lihat Semua →
        </button>
    </div>

    {{-- Pengumuman daripada database --}}
    <div class="space-y-3">

        @forelse ($announcements as $announcement)
            <div class="p-3 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors space-y-2">

                @if ($announcement->image_path)
                    <img
                        src="{{ asset('images/announcements_events/' . $announcement->image_path) }}"
                        alt="Poster {{ $announcement->title }}"
                        class="w-full h-24 object-cover rounded-md">
                @endif

                <div class="flex items-center justify-between">
                    <span class="px-2 py-0.5 rounded text-[10px] font-label font-bold bg-primary-fixed text-on-primary-fixed">
                        HEBAHAN
                    </span>

                    <span class="font-label text-[10px] text-on-surface-variant">
                        {{ \Carbon\Carbon::parse($announcement->date_published)->format('d M Y') }}
                    </span>
                </div>

                <h5 class="font-headline font-bold text-xs text-primary leading-tight">
                    {{ $announcement->title }}
                </h5>

                <p class="font-body text-[11px] text-on-surface-variant line-clamp-2">
                    {{ $announcement->content }}
                </p>

            </div>
        @empty
            <div class="p-3 rounded-lg bg-surface-container-low space-y-1">
                <h5 class="font-headline font-bold text-xs text-primary">
                    Tiada pengumuman untuk dipaparkan
                </h5>

                <p class="font-body text-[11px] text-on-surface-variant">
                    Tiada pengumuman terkini buat masa ini.
                </p>
            </div>
        @endforelse

    </div>

    {{-- Acara akan datang daripada database --}}
    <div class="border-t border-outline-variant/30 pt-4 flex flex-col gap-3">

        <h4 class="font-headline font-bold text-xs text-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px] text-secondary">event</span>
            Acara Kampus
        </h4>

        @forelse ($events as $event)
            <div class="p-3 rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors space-y-2">

                @if ($event->image_path)
                    <img
                        src="{{ asset('images/announcements_events/' . $event->image_path) }}"
                        alt="Poster {{ $event->event_name }}"
                        class="w-full h-24 object-cover rounded-md">
                @endif

                <div class="flex items-center justify-between">
                    <span class="px-2 py-0.5 rounded text-[10px] font-label font-bold {{ $event->event_date->isPast() && !$event->event_date->isToday() ? 'bg-surface-container-high text-on-surface-variant' : 'bg-secondary-fixed text-on-secondary-fixed' }}">
                        {{ $event->event_date->isPast() && !$event->event_date->isToday() ? 'SELEPAS' : 'ACARA' }}
                    </span>

                    <span class="font-label text-[10px] text-on-surface-variant">
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </span>
                </div>

                <h5 class="font-headline font-bold text-xs text-primary leading-tight">
                    {{ $event->event_name }}
                </h5>

                <p class="font-body text-[11px] text-on-surface-variant line-clamp-2">
                    {{ $event->description }}
                </p>

                @if ($event->start_time)
                    <p class="font-label text-[10px] text-on-surface-variant">
                        <span class="material-symbols-outlined align-middle text-[12px]">schedule</span>
                        {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}

                        @if ($event->end_time)
                            – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                        @endif
                    </p>
                @endif

            </div>
        @empty
            <div class="p-3 rounded-lg bg-surface-container-low space-y-1">
                <h5 class="font-headline font-bold text-xs text-primary">
                    Acara belum tersedia
                </h5>

                <p class="font-body text-[11px] text-on-surface-variant">
                    Acara akan datang yang direkodkan akan dipaparkan di sini.
                </p>
            </div>
        @endforelse

    </div>

</section>
<!-- Akses Pantas Student Hub -->
<section class="bg-surface-container-lowest rounded-xl p-5 shadow-sm flex flex-col gap-3">
  <div class="flex items-center gap-2">
    <span class="material-symbols-outlined text-[18px] text-secondary">apps</span>
    <h3 class="font-headline font-bold text-sm text-primary">Akses Pantas Student Hub</h3>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
    <a href="{{ route('student.profile') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">person</span> Profil Pelajar</a>
    <a href="{{ route('student.subject-registration') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">app_registration</span> Pendaftaran Subjek</a>
    <a href="{{ route('student.timetable') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">calendar_month</span> Jadual Waktu</a>
    <a href="{{ route('campus-map.index') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">map</span> Peta Kampus</a>
    <a href="{{ route('facilities.index') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">domain</span> Kemudahan Kampus</a>
    <a href="{{ route('lecturers.index') }}" class="rounded-lg bg-surface-container-low p-3 hover:bg-surface-container transition-colors flex items-center gap-2 text-xs font-label font-semibold text-primary"><span class="material-symbols-outlined text-[18px] text-secondary">groups</span> Direktori Pensyarah</a>
  </div>
</section>
</div>
</div>
</div></div></main><footer class="w-full bg-primary text-on-primary pt-14 pb-8 mt-auto shadow-[0_-1px_8px_rgba(0,0,0,0.06)]"><div class="max-w-[1280px] mx-auto px-6"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12"><div class="flex flex-col gap-4"><div class="flex items-center gap-3"><div class="p-1.5 rounded-lg bg-surface-container-lowest inline-flex"><img alt="Logo_kpm.gif" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1VzhNdbnl7ulvPiELqxz79OTdcr7HVNVRuOHBPXHanYD97uVOzqFO-38Juzrfokzoxp3Z1pmzcuOxIOx4j721PEiZ0MFBGRc9Iutt_QZROLbrxkBN2t722qFbBAWEWpGDloghDsXlQzNWb73xh0AQoH6qhtx0GTmraG6quelidvRYrPr-MREk4a1oNt1v3yKB80_ijfAgdHkycahpXuVSBuLkeTu-dp5o-SeUmxmszFMBqJGCyUQR9H162abId5efAcn4K1Jkjp"/></div><div class="flex flex-col"><span class="font-headline font-bold text-sm tracking-tight text-on-primary uppercase leading-tight">KPM Beranang</span><span class="font-label text-[11px] text-secondary-fixed font-medium uppercase">Amanah Rakyat</span></div></div><p class="font-body text-xs text-tertiary-fixed leading-relaxed">Institusi pendidikan tinggi terunggul di bawah Majlis Amanah Rakyat (MARA), melahirkan modal insan dinamik, kompetitif, dan berintegriti.</p><div class="flex flex-col gap-1 text-xs text-tertiary-fixed"><span class="font-label font-semibold text-on-primary text-[11px] uppercase tracking-wider">Alamat Kampus:</span><span>Lot 2064, Jalan Semenyih, 43700 Beranang, Selangor Darul Ehsan</span></div></div><div class="flex flex-col gap-3"><h3 class="font-headline text-xs font-bold uppercase tracking-wider text-secondary-fixed">Pautan Akademik</h3><ul class="flex flex-col gap-2 font-label text-xs text-tertiary-fixed"><li class="hover:text-on-primary transition-colors cursor-pointer">• Kalendar Akademik 2024/2025</li><li class="hover:text-on-primary transition-colors cursor-pointer">• e-Semakan Keputusan Peperiksaan</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Sistem Maklumat Pembelajaran (i-Learn)</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Muat Turun Borang Rasmi HEP</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Skim Pinjaman Pelajaran MARA</li></ul></div><div class="flex flex-col gap-3"><h3 class="font-headline text-xs font-bold uppercase tracking-wider text-secondary-fixed">Hal Ehwal Pelajar (HEP)</h3><ul class="flex flex-col gap-2 font-label text-xs text-tertiary-fixed"><li class="hover:text-on-primary transition-colors cursor-pointer">• Majlis Perwakilan Pelajar (MPP)</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Penginapan &amp; Kediaman Asrama</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Kaunseling &amp; Kebajikan Siswa</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Aktiviti Kelab &amp; Persatuan Sukan</li><li class="hover:text-on-primary transition-colors cursor-pointer">• Aduan &amp; Maklum Balas Pelajar</li></ul></div><div class="flex flex-col gap-3"><h3 class="font-headline text-xs font-bold uppercase tracking-wider text-secondary-fixed">Bantuan &amp; Keselamatan 24 Jam</h3><div class="p-4 rounded-xl bg-primary-container text-on-primary flex flex-col gap-2"><div class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary-fixed text-[20px]">emergency</span><span class="font-headline font-semibold text-xs tracking-wide uppercase">Hotline Bilik Kawalan</span></div><p class="font-headline font-bold text-sm tracking-tight text-primary-fixed">03-8921 5000 / 5111</p><p class="font-body text-[11px] text-tertiary-fixed">Sedia berkhidmat sepanjang waktu untuk kecemasan, bantuan perubatan, dan kawalan kampus.</p></div><div class="flex flex-wrap items-center gap-2 pt-1"><span class="px-2.5 py-1 rounded bg-tertiary-container text-tertiary-fixed text-[10px] font-label font-semibold">Akreditasi MQA</span><span class="px-2.5 py-1 rounded bg-tertiary-container text-tertiary-fixed text-[10px] font-label font-semibold">ISO 9001:2015</span></div></div></div><div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-label text-tertiary-fixed"><p>© {{ date("Y") }} Kolej Profesional MARA Beranang. Hak Cipta Terpelihara.</p><div class="flex items-center gap-6"><span class="hover:text-on-primary transition-colors cursor-pointer">Dasar Privasi</span><span class="hover:text-on-primary transition-colors cursor-pointer">Terma Penggunaan</span><span class="hover:text-on-primary transition-colors cursor-pointer">Peta Laman</span></div></div></div></footer></div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const root = document.getElementById('student-calendar');
  if (!root) return;
  const daysContainer = document.getElementById('calendar-days');
  const monthLabel = document.getElementById('calendar-month-label');
  const selectedLabel = document.getElementById('calendar-selected-label');
  const dateTitle = document.getElementById('calendar-date-title');
  const dateDescription = document.getElementById('calendar-date-description');
  const todayString = root.dataset.today;
  const today = new Date(todayString + 'T12:00:00');
  let displayedMonth = new Date(today.getFullYear(), today.getMonth(), 1);
  let selectedDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());
  const monthFormatter = new Intl.DateTimeFormat('ms-MY', { month: 'long', year: 'numeric' });
  const fullDateFormatter = new Intl.DateTimeFormat('ms-MY', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });

  function sameDate(a, b) {
    return a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
  }

  function renderCalendar() {
    monthLabel.textContent = monthFormatter.format(displayedMonth);
    daysContainer.innerHTML = '';
    const firstDay = new Date(displayedMonth.getFullYear(), displayedMonth.getMonth(), 1);
    const mondayOffset = (firstDay.getDay() + 6) % 7;
    const daysInMonth = new Date(displayedMonth.getFullYear(), displayedMonth.getMonth() + 1, 0).getDate();
    const totalCells = Math.ceil((mondayOffset + daysInMonth) / 7) * 7;

    for (let i = 0; i < totalCells; i++) {
      const dayNumber = i - mondayOffset + 1;
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'min-h-[38px] sm:min-h-[42px] rounded-lg text-xs sm:text-sm font-label transition-colors focus:outline-none focus:ring-2 focus:ring-secondary';
      if (dayNumber < 1 || dayNumber > daysInMonth) {
        button.disabled = true;
        button.className += ' invisible';
        button.setAttribute('aria-hidden', 'true');
      } else {
        const date = new Date(displayedMonth.getFullYear(), displayedMonth.getMonth(), dayNumber);
        const isToday = sameDate(date, today);
        const isSelected = sameDate(date, selectedDate);
        button.textContent = String(dayNumber);
        button.setAttribute('aria-label', fullDateFormatter.format(date));
        button.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
        button.className += isSelected ? ' bg-primary text-on-primary font-bold shadow-sm' : (isToday ? ' bg-secondary-container text-on-secondary-container font-bold' : ' text-primary hover:bg-white');
        button.addEventListener('click', function () {
          selectedDate = date;
          renderCalendar();
        });
      }
      daysContainer.appendChild(button);
    }
    selectedLabel.textContent = 'Tarikh dipilih: ' + fullDateFormatter.format(selectedDate);
    dateTitle.textContent = fullDateFormatter.format(selectedDate);
    dateDescription.textContent = sameDate(selectedDate, today)
      ? 'Hari ini. Buka Jadual Waktu untuk melihat butiran kelas dan makmal yang direkodkan.'
      : 'Untuk menyemak kelas pada tarikh ini, buka Jadual Waktu. Butiran kelas tidak dipaparkan dalam kalendar ini lagi.';
  }

  document.getElementById('calendar-prev').addEventListener('click', function () {
    displayedMonth = new Date(displayedMonth.getFullYear(), displayedMonth.getMonth() - 1, 1);
    renderCalendar();
  });
  document.getElementById('calendar-next').addEventListener('click', function () {
    displayedMonth = new Date(displayedMonth.getFullYear(), displayedMonth.getMonth() + 1, 1);
    renderCalendar();
  });
  renderCalendar();
});
</script>
</body></html>