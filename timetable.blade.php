<!DOCTYPE html>

<html lang="ms"><head>
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



<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="web_standard" name="shell-type"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<style>
    @layer base {
      html, body {
        margin: 0;
        padding: 0;
        font-family: 'Hanken Grotesk', sans-serif;
      }
      body {
        overscroll-behavior: none;
      }
    }
    ::-webkit-scrollbar {
      display: none;
    }
  </style>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "surface-container": "#f0eded",
            "on-primary-fixed": "#001b3d",
            "tertiary": "#070b0f",
            "on-secondary-container": "#745c00",
            "error": "#ba1a1a",
            "primary-fixed-dim": "#aec7f6",
            "on-primary-container": "#708ab5",
            "on-background": "#1c1b1b",
            "primary-container": "#002147",
            "surface-container-high": "#eae7e7",
            "primary": "#002147",
            "on-error-container": "#93000a",
            "on-secondary-fixed-variant": "#574500",
            "outline-variant": "#c4c6cf",
            "inverse-surface": "#313030",
            "surface-bright": "#fcf9f8",
            "on-tertiary-container": "#85898e",
            "surface-variant": "#e5e2e1",
            "surface-container-highest": "#e5e2e1",
            "secondary-container": "#fed65b",
            "surface": "#fcf9f8",
            "on-tertiary": "#ffffff",
            "tertiary-container": "#1e2226",
            "surface-container-low": "#f6f3f2",
            "primary-fixed": "#d6e3ff",
            "tertiary-fixed-dim": "#c3c7cc",
            "surface-dim": "#dcd9d9",
            "outline": "#74777f",
            "surface-tint": "#465f88",
            "on-primary-fixed-variant": "#2d476f",
            "secondary": "#735c00",
            "on-secondary-fixed": "#241a00",
            "surface-container-lowest": "#ffffff",
            "on-primary": "#ffffff",
            "on-tertiary-fixed-variant": "#43474b",
            "on-secondary": "#ffffff",
            "on-surface": "#1c1b1b",
            "error-container": "#ffdad6",
            "secondary-fixed": "#ffe088",
            "on-surface-variant": "#44474e",
            "background": "#fcf9f8",
            "inverse-on-surface": "#f3f0ef",
            "on-tertiary-fixed": "#181c20",
            "secondary-fixed-dim": "#e9c349",
            "tertiary-fixed": "#e0e3e8",
            "inverse-primary": "#aec7f6",
            "on-error": "#ffffff"
          },
          borderRadius: {
            "DEFAULT": "0.5rem",
            "sm": "0.375rem",
            "md": "0.5rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "2xl": "1rem",
            "full": "9999px"
          },
          fontFamily: {
            "headline": ["Hanken Grotesk", "sans-serif"],
            "display": ["Hanken Grotesk", "sans-serif"],
            "body": ["Hanken Grotesk", "sans-serif"],
            "serif": ["\"Source Serif 4\"", "serif"],
            "label": ["Hanken Grotesk", "sans-serif"]
          }
        }
      }
    }
  </script>
</head>
<body class="bg-surface font-body text-on-surface antialiased selection:bg-primary-container selection:text-white">
<!-- Main Institutional Header -->
@include('student.partials.sidebar')<div class="student-page-shell">
@include('student.partials.topbar')
<!-- Main Timetable Content Shell -->
<main class="w-full pt-0 bg-surface">
<div class="flex flex-col w-full">
<!-- Top Header & Academic Overview Hero Banner -->
<section class="w-full bg-surface-container-lowest border-b border-surface-dim/70 shadow-sm relative overflow-hidden">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 pt-8 pb-7">
<!-- Academic Pathway Breadcrumb -->
<div class="flex items-center flex-wrap gap-2 text-xs font-label uppercase tracking-widest text-on-surface-variant mb-4">
<span class="hover:text-primary transition-colors cursor-pointer font-medium">Kolej Profesional MARA Beranang</span>
<span class="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span>
<span class="hover:text-primary transition-colors cursor-pointer font-medium">Jadual Waktu Akademik</span>
<span class="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span>
<span class="font-bold text-primary flex items-center gap-1.5 bg-primary-fixed/30 border border-primary-fixed-dim/60 px-2.5 py-0.5 rounded-md">
<span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
              {{ $selectedGroup ? 'SESI ' . $selectedGroup->academic_session . ' (SEMESTER ' . $selectedGroup->semester . ')' : 'JADUAL WAKTU AKADEMIK' }}
            </span>
</div>
<!-- Title Area + Action Toolset -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6">
<div class="max-w-3xl space-y-2">
<h1 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-primary leading-tight">
                Jadual Waktu Kuliah &amp; Makmal Akademik
              </h1>
<p class="font-body text-sm sm:text-base text-on-surface-variant leading-relaxed">
                Sistem semakan jadual waktu interaktif mengikut program pengajian, semester, dan kumpulan kelas. Kemaskini rasmi disahkan oleh Bahagian Hal Ehwal Akademik (HEA).
              </p>
</div>
<!-- Quick Document Actions -->
<div class="flex flex-wrap items-center gap-2.5 self-start lg:self-auto shrink-0">
<button class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-surface-container-low hover:bg-surface-container text-primary font-label text-xs uppercase tracking-wider font-bold rounded-lg border border-surface-dim transition-all active:scale-95 shadow-sm" onclick="window.print()" type="button">
<span class="material-symbols-outlined text-[18px]">print</span>
<span>Cetak</span>
</button>
<button class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-surface-container-low hover:bg-surface-container text-primary font-label text-xs uppercase tracking-wider font-bold rounded-lg border border-surface-dim transition-all active:scale-95 shadow-sm" type="button">
<span class="material-symbols-outlined text-[18px] text-secondary">calendar_add_on</span>
<span>Eksport iCal / G-Cal</span>
</button>
<button class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-container hover:bg-primary text-on-primary font-label text-xs uppercase tracking-wider font-bold rounded-lg shadow-sm transition-all active:scale-95" type="button">
<span class="material-symbols-outlined text-[18px] text-secondary-fixed">download</span>
<span>Muat Turun PDF Rasmi</span>
</button>
</div>
</div>
<!-- Academic Distinction KPI Metric Strip -->
<div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-3 pt-5 bg-surface-container-low border border-surface-dim/60 rounded-lg px-4 py-3.5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-surface-container-lowest border border-surface-dim flex items-center justify-center text-primary-container shadow-sm">
<span class="material-symbols-outlined text-xl">school</span>
</div>
<div>
<p class="font-headline text-lg font-bold text-primary leading-none">{{ $programmes->count() }} Program</p>
<p class="font-body text-[11px] text-on-surface-variant mt-1">Pengajian Ditawarkan</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-surface-container-lowest border border-surface-dim flex items-center justify-center text-secondary shadow-sm">
<span class="material-symbols-outlined text-xl">event_upcoming</span>
</div>
<div>
<p class="font-headline text-lg font-bold text-primary leading-none">{{ $timetable->count() }} Sesi</p>
<p class="font-body text-[11px] text-on-surface-variant mt-1">Kuliah &amp; Makmal Seminggu</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-surface-container-lowest border border-surface-dim flex items-center justify-center text-emerald-800 shadow-sm">
<span class="material-symbols-outlined text-xl">verified_user</span>
</div>
<div>
<div class="flex items-center gap-1.5">
<span class="w-2 h-2 rounded-full bg-emerald-600"></span>
<p class="font-headline text-xs font-bold text-primary leading-none">Jadual Kumpulan</p>
</div>
<p class="font-body text-[11px] text-on-surface-variant mt-1">Berkuatkuasa Sesi Semasa</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-surface-container-lowest border border-surface-dim flex items-center justify-center text-primary-container shadow-sm">
<span class="material-symbols-outlined text-xl">schedule</span>
</div>
<div>
<p class="font-headline text-xs font-bold text-primary leading-none">08:00 AM – 06:00 PM</p>
<p class="font-body text-[11px] text-on-surface-variant mt-1">Waktu Sesi Isnin – Jumaat</p>
</div>
</div>
</div>
</div>
</section>
<!-- Sticky Filter & Selection Controller Toolbar -->
<section class="sticky top-20 z-30 bg-surface-bright/95 backdrop-blur-md px-4 sm:px-6 lg:px-10 py-4 border-b border-surface-dim shadow-sm">
<div class="max-w-7xl mx-auto flex flex-col xl:flex-row items-stretch xl:items-center justify-between gap-4">
<!-- Primary Controls (Program & Semester) -->
<form id="timetableFilters" method="GET" action="{{ route('student.timetable') }}" class="contents">
<div class="flex flex-wrap items-center gap-3">
<!-- Program Selector -->
<div class="relative min-w-[280px] sm:min-w-[320px]">
<label class="block font-label text-[10px] uppercase font-bold tracking-wider text-on-surface-variant mb-1 ml-0.5">Program Pengajian</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">terminal</span>
<select class="w-full pl-9 pr-9 py-2 bg-surface-container-lowest text-on-surface font-body text-xs font-medium rounded-lg border border-surface-dim shadow-sm focus:outline-none focus:ring-2 focus:ring-primary appearance-none cursor-pointer" id="programSelector" name="programme_id" onchange="this.form.group_id.value=''; this.form.semester.value=''; this.form.submit()">
@foreach ($programmes as $programme)
<option value="{{ $programme->programme_id }}" @selected((string)($selectedProgrammeId ?? $studentProgrammeId) === (string)$programme->programme_id)>{{ $programme->programme_name }} ({{ $programme->programme_code }})</option>
@endforeach
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
<!-- Semester Selector Pills -->
<div>
<label class="block font-label text-[10px] uppercase font-bold tracking-wider text-on-surface-variant mb-1 ml-0.5">Semester</label>
<input type="hidden" name="group_id" value="{{ $selectedGroup?->group_id }}">
<div class="inline-flex p-1 bg-surface-container-low border border-surface-dim rounded-lg gap-1">
@foreach ($availableSemesters as $sem)
<button class="sem-btn px-2.5 py-1.5 text-xs font-label uppercase rounded-md transition-colors {{ (int)($selectedGroup?->semester ?? 0) === (int)$sem ? 'font-bold bg-primary-container text-on-primary shadow-sm' : 'font-medium text-on-surface-variant hover:text-primary' }}" name="semester" value="{{ $sem }}" type="submit">Sem {{ $sem }}</button>
@endforeach
</div>
</div>
</div>
<!-- Group Toggle & View Layout Selector -->
<div class="flex flex-wrap items-center justify-between xl:justify-end gap-4">
<!-- Group Pills -->
<div>
<label class="block font-label text-[10px] uppercase font-bold tracking-wider text-on-surface-variant mb-1 ml-0.5">Kumpulan Kuliah (Kelas)</label>
<div class="inline-flex p-1 bg-surface-container-low border border-surface-dim rounded-lg gap-1 shadow-inner">
@foreach ($groups as $group)
<a href="{{ route('student.timetable', ['programme_id' => $group->programme_id, 'group_id' => $group->group_id, 'semester' => $group->semester]) }}" class="px-3.5 py-1.5 text-xs font-label rounded-md transition-all flex items-center gap-1.5 {{ (string)($selectedGroup?->group_id ?? '') === (string)$group->group_id ? 'font-bold bg-primary-container text-on-primary shadow-sm' : 'font-medium text-on-surface-variant hover:text-primary' }}">
@if ((string)($selectedGroup?->group_id ?? '') === (string)$group->group_id)<span class="w-1.5 h-1.5 rounded-full bg-secondary-fixed"></span>@endif
{{ $group->group_name }}
</a>
@endforeach
</div>
</div>
<!-- Mode View Switch -->
<div>
<label class="block font-label text-[10px] uppercase font-bold tracking-wider text-on-surface-variant mb-1 ml-0.5">Mod Paparan</label>
<div class="inline-flex p-1 bg-surface-container-low border border-surface-dim rounded-lg gap-1">
<button class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-bold bg-surface-container-lowest text-primary rounded-md shadow-sm border border-surface-dim" id="viewGridBtn" onclick="toggleView('grid')" type="button">
<span class="material-symbols-outlined text-[16px]">calendar_view_week</span>
<span class="hidden sm:inline">Grid Kalendar</span>
</button>
<button class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-medium text-on-surface-variant hover:text-primary rounded-md" id="viewListBtn" onclick="toggleView('list')" type="button">
<span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
<span class="hidden sm:inline">Senarai Subjek</span>
</button>
</div>
</div>
</form>
</div>
</div>
<!-- Active Context Strip -->
<div class="max-w-7xl mx-auto mt-3 pt-2.5 border-t border-surface-dim/60 flex flex-wrap items-center justify-between gap-3 text-xs text-on-surface-variant">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">info</span>
<span id="classCohortInfo">Memaparkan jadual untuk: <strong class="text-primary font-semibold">{{ $selectedGroup?->programme?->programme_name ?? 'Program belum dipilih' }} • Semester {{ $selectedGroup?->semester ?? '-' }} • {{ $selectedGroup?->group_name ?? 'Kumpulan belum ditetapkan' }}</strong></span>
</div>
<div class="flex items-center gap-2"><span class="material-symbols-outlined text-[16px] text-primary">badge</span><span>Sesi Akademik: <strong class="text-primary font-semibold">{{ $selectedGroup?->academic_session ?? 'Belum ditetapkan' }}</strong></span></div>
</div>
</section>
<!-- Main Schedule Content Body -->
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-6 space-y-8">
<!-- Legend Strip -->
<div class="w-full bg-surface-container-lowest border border-surface-dim p-3.5 rounded-lg flex flex-wrap items-center justify-between gap-3 text-xs shadow-sm">
<div class="flex flex-wrap items-center gap-2.5">
<span class="font-label font-bold uppercase tracking-wider text-[11px] text-on-surface">Kategori Subjek:</span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-indigo-50 border border-indigo-200/60 text-indigo-900 font-label text-[11px] font-semibold">
<span class="w-2 h-2 rounded-full bg-indigo-700"></span> Pengaturcaraan &amp; CS
            </span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-cyan-50 border border-cyan-200/60 text-cyan-900 font-label text-[11px] font-semibold">
<span class="w-2 h-2 rounded-full bg-cyan-700"></span> Pangkalan Data &amp; Web
            </span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-200/60 text-emerald-900 font-label text-[11px] font-semibold">
<span class="w-2 h-2 rounded-full bg-emerald-700"></span> Statistik &amp; Matematik
            </span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 border border-amber-200/60 text-amber-900 font-label text-[11px] font-semibold">
<span class="w-2 h-2 rounded-full bg-amber-700"></span> Bahasa, Am &amp; Pengurusan
            </span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant text-[11px]">
<span class="material-symbols-outlined text-sm text-outline">touch_app</span>
<span>Layangkan kursor pada blok kelas untuk butiran lengkap</span>
</div>
</div>
<!-- TIMETABLE GRID VIEW -->
<div class="w-full bg-surface-container-lowest rounded-lg border border-surface-dim shadow-sm overflow-hidden" id="gridScheduleView">
@if ($groupAssignmentMissing)
<div class="m-5 sm:m-6 rounded-lg border border-amber-300 bg-amber-50 p-5 sm:p-6 flex items-start gap-3 text-amber-950" role="status">
<span class="material-symbols-outlined text-2xl text-amber-700">info</span>
<div><h3 class="font-headline text-sm font-bold">Kumpulan kelas belum ditetapkan</h3>
<p class="font-body text-sm mt-1 leading-relaxed">Akaun anda belum mempunyai kumpulan kelas. Sila hubungi pihak UPP untuk menetapkan kumpulan anda supaya jadual waktu yang betul dapat dipaparkan. Anda masih boleh memilih kumpulan lain melalui penapis di atas untuk melihat jadualnya.</p></div>
</div>
@elseif (!$scheduleAvailable)
<div class="m-5 sm:m-6 rounded-lg border border-amber-300 bg-amber-50 p-5 sm:p-6 flex items-start gap-3 text-amber-950" role="status">
<span class="material-symbols-outlined text-2xl text-amber-700">event_busy</span>
<div><h3 class="font-headline text-sm font-bold">Jadual belum tersedia</h3>
<p class="font-body text-sm mt-1 leading-relaxed">Nama kelas ini telah disenaraikan untuk rujukan. Butiran hari, masa, subjek dan lokasi belum tersedia dalam sumber jadual yang dimasukkan.</p></div>
</div>
@else
<div class="overflow-x-auto"><div class="min-w-[1100px] w-full">
<div class="grid grid-cols-11 bg-primary-container text-on-primary text-xs font-label uppercase tracking-wider py-3 px-2 text-center items-center">
<div class="font-bold text-left pl-3 text-secondary-fixed">HARI \ MASA</div>
@foreach ([8,9,10,11,12,13,14,15,16,17] as $hour)
<div @if($hour === 13) class="bg-primary/80 py-1 rounded-md text-secondary-fixed text-[11px] font-bold" @endif>{{ sprintf('%02d:00', $hour) }} - {{ sprintf('%02d:00', $hour + 1) }}@if($hour === 13)<br/><span class="text-[9px] font-normal opacity-90">REHAT / SOLAT</span>@endif</div>
@endforeach
</div>
@php($days = ['Monday' => 'ISNIN', 'Tuesday' => 'SELASA', 'Wednesday' => 'RABU', 'Thursday' => 'KHAMIS', 'Friday' => 'JUMAAT'])
@foreach ($days as $dayKey => $dayLabel)
@php($dayItems = $timetable->filter(fn($item) => strtolower($item->day) === strtolower($dayKey) || strtolower($item->day) === strtolower($dayLabel))->sortBy('start_time')->values())
<div class="grid grid-cols-11 min-h-[110px] py-2 px-2 items-stretch gap-1.5 bg-surface-container-lowest border-b border-surface-dim/60 hover:bg-surface-container-low/40 transition-colors">
<div class="flex flex-col justify-center items-start pl-3 font-headline font-bold text-primary text-sm"><span>{{ $dayLabel }}</span><span class="text-[10px] font-body text-on-surface-variant font-normal">Jadual Kuliah</span></div>
@php($hour = 8)
@while ($hour < 18)
@php($item = $dayItems->first(fn($entry) => (int)\Illuminate\Support\Carbon::parse($entry->start_time)->format('G') === $hour))
@if ($item)
@php($startHour = (int)\Illuminate\Support\Carbon::parse($item->start_time)->format('G'))
@php($endHour = (int)\Illuminate\Support\Carbon::parse($item->end_time)->format('G'))
@php($span = max(1, min(18, $endHour) - $startHour))
<div class="col-span-{{ $span }} rounded-lg bg-cyan-50/80 border border-cyan-200 text-cyan-950 p-2.5 flex flex-col justify-between shadow-sm hover:shadow-md transition-all cursor-pointer group" title="{{ $item->subject?->subject_name }} | {{ $item->lecturer?->lecturer_name }} | {{ $item->venue }}">
<div><div class="flex items-center justify-between gap-1 mb-1"><span class="font-headline font-bold text-xs text-cyan-900 group-hover:text-primary transition-colors">{{ $item->subject?->subject_code ?? 'AKTIVITI' }}</span><span class="px-1.5 py-0.5 rounded-md bg-cyan-200/70 text-[10px] font-label font-bold text-cyan-900">{{ $span }}J</span></div><h4 class="font-headline text-xs font-semibold leading-tight">{{ $item->subject?->subject_name ?? $item->class_name }}</h4></div>
<div class="pt-2 text-[10px] space-y-0.5 text-cyan-800"><p class="flex items-center gap-1 truncate"><span class="material-symbols-outlined text-[13px]">schedule</span>{{ \Illuminate\Support\Carbon::parse($item->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($item->end_time)->format('H:i') }}</p><p class="flex items-center gap-1 truncate"><span class="material-symbols-outlined text-[13px]">person</span>{{ $item->lecturer?->lecturer_name ?? 'Pensyarah belum ditetapkan' }}</p><p class="flex items-center gap-1 truncate"><span class="material-symbols-outlined text-[13px]">room</span>{{ $item->venue ?: 'Lokasi belum ditetapkan' }}</p></div>
</div>
@php($hour += $span)
@else
<div class="rounded-lg bg-surface-container-low/60 border border-dashed border-surface-dim p-2 flex items-center justify-center text-outline text-[11px] italic">-</div>
@php($hour++)
@endif
@endwhile
</div>
@endforeach
</div></div>
@endif
<!-- Bottom Meta Note -->
<div class="px-4 py-2.5 bg-surface-container-low border-t border-surface-dim flex flex-wrap items-center justify-between text-[11px] text-on-surface-variant">
<span>* Tertakluk kepada pindaan rasmi dari semasa ke semasa oleh Hal Ehwal Akademik MARA.</span>
<span class="font-mono text-primary font-semibold">Sesi: {{ $selectedGroup?->academic_session ?? 'Belum ditetapkan' }}</span>
</div>
</div>
<!-- ALTERNATIVE LIST VIEW -->
<div class="hidden w-full space-y-3" id="listScheduleView">
<div class="bg-surface-container-lowest rounded-lg border border-surface-dim p-5 sm:p-6 shadow-sm">
<h3 class="font-headline text-base font-bold text-primary mb-4">Senarai Kuliah Mengikut Hari ({{ $selectedGroup?->group_name ?? 'Kumpulan' }})</h3>
<div class="space-y-3">
@if ($groupAssignmentMissing)
<div class="rounded-lg border border-amber-300 bg-amber-50 p-5 flex items-start gap-3 text-amber-950" role="status"><span class="material-symbols-outlined text-2xl text-amber-700">info</span><div><h3 class="font-headline text-sm font-bold">Kumpulan kelas belum ditetapkan</h3><p class="font-body text-sm mt-1">Sila hubungi pihak UPP untuk menetapkan kumpulan kelas anda. Anda boleh memilih kumpulan lain di atas untuk melihat jadualnya.</p></div></div>
@else
@forelse ($timetable as $item)
<div class="p-3.5 bg-surface-container-low border border-surface-dim rounded-lg flex flex-col md:flex-row md:items-center justify-between gap-3"><div class="flex items-start gap-3"><span class="px-2.5 py-1 bg-primary text-on-primary font-headline font-bold text-xs rounded-md">{{ strtoupper($item->day) }}</span><div><h4 class="font-headline text-sm font-bold text-primary">{{ \Illuminate\Support\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($item->end_time)->format('H:i') }} • {{ $item->subject?->subject_code }}: {{ $item->subject?->subject_name }}</h4><p class="font-body text-xs text-on-surface-variant">{{ $item->lecturer?->lecturer_name ?? 'Pensyarah belum ditetapkan' }} • {{ $item->venue ?: 'Lokasi belum ditetapkan' }}</p></div></div><span class="px-2.5 py-1 rounded-md bg-cyan-100 border border-cyan-300 text-cyan-950 font-label text-xs font-semibold self-start md:self-auto">{{ max(1, \Illuminate\Support\Carbon::parse($item->start_time)->diffInHours(\Illuminate\Support\Carbon::parse($item->end_time))) }} Jam</span></div>
@empty
<p class="text-sm text-on-surface-variant">{{ $scheduleAvailable ? 'Tiada slot jadual direkodkan untuk kumpulan ini.' : 'Jadual untuk kelas ini belum tersedia dalam sumber yang dimasukkan.' }}</p>
@endforelse
@endif
</div></div></div>
<!-- COURSE BREAKDOWN & DIRECTORY SUMMARY TABLE -->
<section class="w-full bg-surface-container-lowest rounded-lg border border-surface-dim shadow-sm p-5 sm:p-6">
<div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 gap-2 border-b border-surface-dim/70">
<div>
<h2 class="font-headline text-lg sm:text-xl font-bold text-primary">Pecahan Kursus &amp; Direktori Pensyarah {{ $selectedGroup?->group_name ?? 'Kumpulan' }}</h2>
<p class="font-body text-xs text-on-surface-variant">Ringkasan bebanan jam kredit, bilik kuliah dan maklumat pensyarah penasihat subjek.</p>
</div>
<span class="self-start sm:self-auto px-3 py-1 bg-surface-container-low text-primary text-xs font-mono rounded-md border border-surface-dim font-bold">
              {{ $classes->count() }} Kelas
            </span>
</div>
<div class="overflow-x-auto mt-4">
<table class="w-full text-left text-xs">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-label uppercase text-[11px] tracking-wider border-y border-surface-dim">
<th class="py-3 px-3.5 rounded-l-md">Kod Kursus</th>
<th class="py-3 px-3.5">Nama Kursus Penuh</th>
<th class="py-3 px-2 text-center">Kredit</th>
<th class="py-3 px-3.5">Nama Pensyarah</th>
<th class="py-3 px-3.5">Lokasi Utama</th>
<th class="py-3 px-3.5">Mod / Kategori</th>
<th class="py-3 px-3 rounded-r-md text-right">Tindakan</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-dim/60 font-body">
@forelse ($classes as $class)
@php($subject = $class->subject)
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3.5 px-3.5 font-headline font-bold text-primary">{{ $subject?->subject_code ?? '—' }}</td>
<td class="py-3.5 px-3.5 font-medium text-on-surface">{{ $subject?->subject_name ?? 'Subjek tidak dinyatakan' }}</td>
<td class="py-3.5 px-2 text-center font-bold text-primary">{{ $subject?->credit_hour ?? '—' }}</td>
<td class="py-3.5 px-3.5"><span class="font-semibold text-primary block">{{ $class?->lecturerDirectory?->lecturer_name ?? $class?->lecturer?->lecturer_name ?? 'Belum ditetapkan' }}</span><span class="text-[11px] text-on-surface-variant">{{ $class?->lecturerDirectory?->email ?? $class?->lecturer?->email ?? '' }}</span></td>
<td class="py-3.5 px-3.5">{{ $class?->classTimetables->first()?->venue ?? 'Belum ditetapkan' }}</td>
<td class="py-3.5 px-3.5"><span class="inline-block px-2.5 py-0.5 rounded-md bg-cyan-50 border border-cyan-200 text-cyan-900 text-[11px] font-semibold">{{ $class ? 'Kuliah / Makmal' : 'Belum dijadualkan' }}</span></td>
<td class="py-3.5 px-3 text-right">@if($class?->lecturerDirectory?->email ?? $class?->lecturer?->email)<a class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-surface-container rounded-md transition-colors" title="Hubungi Pensyarah" href="mailto:{{ $class->lecturerDirectory?->email ?? $class->lecturer?->email }}"><span class="material-symbols-outlined text-base">mail</span></a>@endif</td>
</tr>
@empty
<tr><td colspan="7" class="py-6 text-center text-on-surface-variant">{{ $scheduleAvailable ? 'Tiada subjek ditemui untuk kumpulan ini.' : 'Butiran subjek belum tersedia untuk kelas ini.' }}</td></tr>
@endforelse
</tbody>
</table>
</div>
</section>
<!-- Campus Facility Guidance Banner -->
<div class="w-full bg-primary-container text-on-primary rounded-lg p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm border border-primary-container relative overflow-hidden">
<div class="relative z-10 max-w-2xl space-y-2">
<span class="text-xs font-label uppercase tracking-widest text-secondary-fixed font-bold">Bantuan Pandu Arah Kampus</span>
<h3 class="font-headline text-2xl font-bold leading-tight">Perlukan Panduan Lokasi Makmal atau Bilik Kuliah?</h3>
<p class="font-body text-sm text-surface-container-low leading-relaxed">
              Gunakan Peta Interaktif Kampus KPM Beranang untuk mencari laluan terpantas ke Makmal Komputer Blok C, Dewan Kuliah Bestari, atau Dewan Gemilang.
            </p>
</div>
<div class="relative z-10 shrink-0">
<a class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-surface-container-lowest text-primary hover:bg-surface-bright font-label text-xs uppercase tracking-wider font-bold shadow-sm transition-all active:scale-95 border border-surface-dim" data-path="cari-fasiliti" href="#">
<span class="material-symbols-outlined text-secondary text-lg">explore</span>
<span>Buka Peta Kampus Beranang</span>
</a>
</div>
</div>
</div>
</div>
</main>
<!-- Institutional Global Footer -->
<footer class="w-full bg-primary-container text-on-primary pt-14 pb-8 border-t border-primary/20">
<div class="w-full px-6 lg:px-10 max-w-7xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
<div class="space-y-4">
<div class="flex items-center gap-3">
<img alt="Logo KPM" class="h-8 w-auto object-contain brightness-0 invert" src="https://lh3.googleusercontent.com/aida/AEtjO1Xi6G0r1-IJpA0kEOd6aQYZ-TPhd0UFgzfyOkHiS6LFEIjczyT8iZLRJw3pxwVUh5_MMUWHOBHcskij021x9hePg2CXxtiBIewZZombbfJ6JDV2kgrh_MYaVJXy8bh3s_iW9ugsibHgnPgNB3mktpHtzyEnWD_QNVkWm_bbxYPle2KbXyPmms-Zb85lYHpZaGXPNyyzWhsiBQQVvfK974W_BEBit6dGXv4CgHnl0XhDvjGaC_kiykQZOSM43u8fgWaYGYDrveyU"/>
<span class="font-headline font-bold text-base tracking-tight text-on-primary">KPM Beranang</span>
</div>
<p class="font-body text-sm text-surface-container-high leading-relaxed">
            Institusi kecemerlangan pendidikan tinggi di bawah Bahagian Pendidikan Tinggi MARA bagi melahirkan modal insan berintegriti dan berdaya saing global.
          </p>
<div class="flex items-center gap-2 text-xs font-label tracking-wide text-secondary-fixed">
<span class="material-symbols-outlined text-sm">verified</span>
<span>Akreditasi MQA &amp; ISO 9001:2015</span>
</div>
</div>
<div class="space-y-3">
<h3 class="font-headline text-sm font-semibold uppercase tracking-wider text-on-primary">Alamat Kampus</h3>
<p class="font-body text-sm text-surface-container-high leading-relaxed">
            Kolej Profesional MARA Beranang,<br/>Lot 2333, Jalan Kajang-Seremban,<br/>43700 Beranang, Selangor Darul Ehsan,<br/>Malaysia.
          </p>
<p class="font-body text-xs text-surface-container-high pt-1">Faks: +603-8766 8400</p>
</div>
<div class="space-y-3">
<h3 class="font-headline text-sm font-semibold uppercase tracking-wider text-on-primary">Perkhidmatan Akademik</h3>
<ul class="font-body text-sm text-surface-container-high space-y-2">
<li><a class="hover:text-on-primary transition-colors" href="#">Hal Ehwal Akademik (HEA)</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sistem Maklumat Pengurusan Pelajar</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Pusat Sumber &amp; Repositori Digital</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kalendar &amp; Takwim Peperiksaan</a></li>
</ul>
</div>
<div class="space-y-3">
<h3 class="font-headline text-sm font-semibold uppercase tracking-wider text-on-primary">Talian Kecemasan &amp; Bantuan</h3>
<div class="p-3.5 bg-primary/40 rounded-lg space-y-2.5 border border-primary-fixed-dim/20">
<div class="flex items-start gap-2.5">
<span class="material-symbols-outlined text-secondary-fixed text-base mt-0.5">emergency</span>
<div>
<p class="font-label text-xs font-bold text-on-primary">Pusat Kawalan Keselamatan 24 Jam</p>
<p class="font-body text-xs text-surface-container-high">+603-8766 8444 / +603-8766 8455</p>
</div>
</div>
<div class="flex items-start gap-2.5 pt-1.5 border-t border-primary-fixed-dim/10">
<span class="material-symbols-outlined text-secondary-fixed text-base mt-0.5">support_agent</span>
<div>
<p class="font-label text-xs font-bold text-on-primary">Meja Bantuan ICT &amp; e-Portal</p>
<p class="font-body text-xs text-surface-container-high">helpdesk.kpmb@mara.gov.my</p>
</div>
</div>
</div>
</div>
</div>
<div class="pt-8 border-t border-primary/20 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-body text-surface-container-high">
<p>© 2025 Kolej Profesional MARA Beranang. Hak Cipta Terpelihara.</p>
<div class="flex items-center gap-6">
<a class="hover:text-on-primary transition-colors" href="#">Dasar Privasi</a>
<a class="hover:text-on-primary transition-colors" href="#">Penafian</a>
<a class="hover:text-on-primary transition-colors" href="#">Bantuan Portal</a>
</div>
</div>
</div>
</footer>
<script>
    // Toggle between Grid Calendar & List View
    function toggleView(viewType) {
      const grid = document.getElementById('gridScheduleView');
      const list = document.getElementById('listScheduleView');
      const gridBtn = document.getElementById('viewGridBtn');
      const listBtn = document.getElementById('viewListBtn');

      if (viewType === 'list') {
        grid.classList.add('hidden');
        list.classList.remove('hidden');

        gridBtn.className = "flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-medium text-on-surface-variant hover:text-primary rounded-md";
        listBtn.className = "flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-bold bg-surface-container-lowest text-primary rounded-md shadow-sm border border-surface-dim";
      } else {
        grid.classList.remove('hidden');
        list.classList.add('hidden');

        gridBtn.className = "flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-bold bg-surface-container-lowest text-primary rounded-md shadow-sm border border-surface-dim";
        listBtn.className = "flex items-center gap-1.5 px-3 py-1.5 text-xs font-label font-medium text-on-surface-variant hover:text-primary rounded-md";
      }
    }

  </script>
</div></body></html>