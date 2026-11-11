<!DOCTYPE html>

<html class="scroll-smooth" lang="ms"><head>
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


<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><title>Kolej Profesional MARA Beranang - Student Hub</title><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,300..900;1,8..60,300..900&amp;display=swap" rel="stylesheet"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{colors:{"on-tertiary":"#ffffff","surface-container-lowest":"#ffffff","primary-fixed":"#d6e3ff","secondary-fixed-dim":"#e9c349","outline":"#74777f","surface-tint":"#465f88","on-surface-variant":"#44474e","on-tertiary-fixed":"#181c20","tertiary-fixed":"#e0e3e8","on-secondary":"#ffffff","outline-variant":"#c4c6cf","primary-container":"#002147","surface-container":"#f0eded","surface-dim":"#dcd9d9","error":"#ba1a1a","on-secondary-fixed":"#241a00","on-primary-container":"#708ab5","on-tertiary-fixed-variant":"#43474b","tertiary-container":"#1e2226","on-primary":"#ffffff","surface-bright":"#fcf9f8","on-secondary-fixed-variant":"#574500","secondary":"#735c00","on-surface":"#1c1b1b","surface":"#fcf9f8","on-tertiary-container":"#85898e","inverse-primary":"#aec7f6","inverse-on-surface":"#f3f0ef","on-primary-fixed":"#001b3d","primary":"#000a1e","surface-container-highest":"#e5e2e1","tertiary-fixed-dim":"#c3c7cc","on-background":"#1c1b1b","secondary-container":"#fed65b","surface-container-low":"#f6f3f2","surface-variant":"#e5e2e1","surface-container-high":"#eae7e7","on-primary-fixed-variant":"#2d476f","on-error-container":"#93000a","on-secondary-container":"#745c00","background":"#fcf9f8","on-error":"#ffffff","error-container":"#ffdad6","primary-fixed-dim":"#aec7f6","tertiary":"#070b0f","inverse-surface":"#313030","secondary-fixed":"#ffe088"},borderRadius:{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},spacing:{},fontFamily:{headline:["Hanken Grotesk"],display:["Hanken Grotesk"],body:["\"Source Serif 4\""],label:["Hanken Grotesk"]},fontSize:{}}}}</script></head><body class="bg-surface font-body text-on-surface antialiased">@include('student.partials.sidebar')<div class="student-page-shell">
@include('student.partials.topbar')<main class="w-full pt-0 bg-surface min-h-[calc(100vh-80px)]"><div class="flex flex-col w-full">
@if (session('success'))
  <div class="mx-6 mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">{{ session('success') }}</div>
@endif
@if ($errors->any())
  <div class="mx-6 mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
    <p class="font-semibold">Sila semak maklumat berikut:</p>
    <ul class="mt-1 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
  </div>
@endif
<!-- Top Utility Sub-Header & Breadcrumb Bar -->
<section class="w-full bg-surface-container-low/80 py-4 px-6">
<div class="max-w-[1280px] mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-3">
<!-- Breadcrumb Navigation -->
<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-label text-on-surface-variant flex-wrap">
<a class="hover:text-primary transition-colors" href="{{ url('/') }}">Kolej Profesional MARA Beranang</a>
<span class="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span>
<a class="hover:text-primary transition-colors" href="{{ route('student.dashboard') }}">Portal Pelajar</a>
<span class="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span>
<span class="font-semibold text-primary">Profil Pelajar</span>
</nav>
<!-- Badges: Status & Matric -->
<div class="flex items-center gap-2.5 flex-wrap">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-lowest text-primary text-xs font-label font-semibold shadow-sm">
<span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
          Status: {{ Auth::user()->status === 'active' ? 'Aktif' : 'Tidak aktif' }}
        </span>
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-container text-on-primary text-xs font-label font-medium shadow-sm">
<span class="material-symbols-outlined text-[14px] text-secondary-container">badge</span>
          No. Matrik: {{ $student?->student_id ?? 'Belum tersedia' }}
        </span>
</div>
</div>
</section>
<!-- Hero Identity Showcase Container -->
<div class="max-w-[1280px] mx-auto w-full px-6 py-8">
<div class="bg-surface-container-lowest rounded-xl p-6 lg:p-8 shadow-sm flex flex-col gap-8">
<!-- Top Row: Student Avatar, Identity Info & Quick Actions -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
<!-- Student Avatar -->
<div class="relative shrink-0">
    @if ($student?->profile_picture)
        <img
            class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl object-cover shadow-md"
            src="{{ asset('storage/' . $student->profile_picture) }}"
            alt="Gambar profil {{ $student->student_name }}"
        />
    @else
        <div
            class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl bg-primary text-white flex items-center justify-center text-3xl font-bold shadow-md"
            aria-label="Gambar profil belum dimuat naik"
        >
            {{ strtoupper(substr($student?->student_name ?? Auth::user()->name, 0, 1)) }}
        </div>
    @endif

    <span
        class="absolute -bottom-1.5 -right-1.5 flex items-center justify-center p-1 bg-surface-container-lowest rounded-full shadow-sm"
        title="Status akaun"
    >
        <span class="w-3.5 h-3.5 bg-emerald-600 rounded-full"></span>
    </span>
</div>
<!-- Name, Program & Faculty -->
<div class="space-y-1.5 min-w-0">
<div class="flex items-center gap-2 flex-wrap">
<h1 class="font-headline font-bold text-2xl sm:text-3xl text-primary tracking-tight">
                {{ $student?->student_name ?? Auth::user()->name }}
              </h1>
<span class="px-2 py-0.5 rounded text-[11px] font-label font-semibold bg-secondary-container text-on-secondary-container">
                DEKAN LIST
              </span>
</div>
<p class="font-headline text-sm font-semibold text-primary/80">
              {{ $student?->programme ?? 'Program pengajian belum tersedia' }}
            </p>
<p class="font-body text-xs text-on-surface-variant flex items-center gap-1.5">
<span class="material-symbols-outlined text-[15px] text-outline">account_balance</span>
              Jabatan Sains Komputer, Kolej Profesional MARA Beranang
            </p>
</div>
</div>
<!-- Action Buttons -->
<div class="flex flex-wrap lg:flex-nowrap items-center gap-2.5 shrink-0">
<a href="{{ route('student.profile.print') }}" target="_blank" rel="noopener"
   class="inline-flex items-center justify-center gap-2 px-3.5 py-2.5 rounded bg-primary text-on-primary text-xs font-label font-semibold shadow-sm hover:bg-primary-container transition-all">
<span class="material-symbols-outlined text-[17px] text-secondary-container">print</span>
<span>Cetak Butiran Pelajar</span>
</a>
<button id="openProfileEdit" class="inline-flex items-center justify-center gap-2 px-3.5 py-2.5 rounded bg-surface-container text-primary text-xs font-label font-semibold hover:bg-surface-container-high transition-all" type="button">
<span class="material-symbols-outlined text-[17px]">edit</span>
<span>Kemaskini Butiran</span>
</button>

</div>
</div>
</div>
</div>
</div>
<!-- Interactive Profile Tabs Bar -->
<div class="max-w-[1280px] mx-auto w-full px-6 mb-6">
<div class="bg-surface-container-lowest rounded-lg p-1.5 shadow-sm flex items-center gap-1.5 overflow-x-auto no-scrollbar">
<button class="tab-btn px-4 py-2 rounded text-xs font-label font-semibold bg-primary text-on-primary shadow-sm shrink-0 flex items-center gap-2" type="button" aria-current="true" data-target="profile-personal">
<span class="material-symbols-outlined text-[16px]">person</span>
<span>Maklumat Peribadi &amp; Waris</span>
</button>
<button class="tab-btn px-4 py-2 rounded text-xs font-label text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all shrink-0 flex items-center gap-2" type="button" aria-current="false" data-target="profile-academic">
<span class="material-symbols-outlined text-[16px]">grade</span>
<span>Rekod Akademik &amp; Peperiksaan (SMPA)</span>
</button>
<button class="tab-btn px-4 py-2 rounded text-xs font-label text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all shrink-0 flex items-center gap-2" type="button" aria-current="false" data-target="profile-subjects">
<span class="material-symbols-outlined text-[16px]">auto_stories</span>
<span>Subjek Berdaftar Sesi Semasa</span>
</button>
</div>
</div>
<!-- Main Content 2-Column Grid -->
<div class="max-w-[1280px] mx-auto w-full px-6 pb-16">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
<!-- LEFT COLUMN: Primary Profile Information (8 Cols / ~68%) -->
<div class="lg:col-span-8 flex flex-col gap-6">
<!-- SECTION 1: Maklumat Peribadi & Pengenalan Diri -->
<div id="profile-personal" class="bg-surface-container-lowest rounded-xl p-6 sm:p-7 shadow-sm scroll-mt-6">
<div class="flex items-center justify-between pb-4 border-b border-surface-container mb-6">
<div class="flex items-center gap-3">
<div class="w-2.5 h-6 bg-primary rounded-sm"></div>
<div>
<h2 class="font-headline font-bold text-lg text-primary">Maklumat Peribadi &amp; Pengenalan Diri</h2>
<p class="font-body text-xs text-on-surface-variant">Maklumat yang tersedia dalam rekod sistem</p>
</div>
</div>
<span class="inline-flex items-center gap-1 text-[11px] font-label font-medium px-2 py-1 rounded bg-surface-container text-on-surface-variant">
<span class="material-symbols-outlined text-[13px] text-emerald-600">verified</span> Maklumat belum disahkan
            </span>
</div>
<!-- Metadata Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- Item 1 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">No. Kad Pengenalan (MyKad)</span>
<div class="flex items-center justify-between">
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
<span class="text-[10px] font-label font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">Belum tersedia</span>
</div>
</div>
<!-- Item 2 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Tarikh Lahir &amp; Umur</span>
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
</div>
<!-- Item 3 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Jantina &amp; Etnik</span>
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
</div>
<!-- Item 4 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Kewarganegaraan</span>
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
</div>
<!-- Item 5 -->
<div class="bg-surface-container-low p-3.5 rounded-lg sm:col-span-2">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Emel Rasmi Kolej (SSO Microsoft 365)</span>
<div class="flex items-center justify-between flex-wrap gap-2">
<span class="font-headline font-semibold text-sm text-primary">{{ $student?->email ?? Auth::user()->email ?? 'Belum tersedia' }}</span>
<button class="text-xs font-label text-primary hover:text-secondary flex items-center gap-1" onclick="navigator.clipboard.writeText(@js($student?->email ?? Auth::user()->email ?? ''))" type="button">
<span class="material-symbols-outlined text-[15px]">content_copy</span> Salin Emel
                </button>
</div>
</div>
<!-- Item 6 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Emel Peribadi Alternatif</span>
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
</div>
<!-- Item 7 -->
<div class="bg-surface-container-low p-3.5 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">No. Telefon Bimbit</span>
<div class="flex items-center gap-2">
<span class="font-headline font-semibold text-sm text-primary">{{ $student?->phone_number ?? 'Belum dikemas kini' }}</span>
<span class="text-[10px] font-label font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">SMS Sah</span>
</div>
</div>
<!-- Item 8 -->
<div class="bg-surface-container-low p-3.5 rounded-lg sm:col-span-2">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Alamat Kediaman Tetap (Keluarga)</span>
<p class="font-body text-sm text-primary leading-snug whitespace-pre-line">
                {{ $student?->home_address ?: 'Belum dikemas kini' }}
              </p>
</div>
<!-- Item 9 -->
<div class="bg-surface-container-low p-3.5 rounded-lg sm:col-span-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
<div>
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Status Kediaman Kolej Semasa</span>
<span class="font-headline font-semibold text-sm text-primary">Belum tersedia</span>
</div>
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-surface-container-highest text-primary text-xs font-label font-semibold shrink-0">
<span class="material-symbols-outlined text-[15px] text-secondary">hotel</span>
                Maklumat kediaman belum tersedia
              </span>
</div>
</div>
</div>
<!-- SECTION 2: Maklumat Waris & Kecemasan -->
<div class="bg-surface-container-lowest rounded-xl p-6 sm:p-7 shadow-sm">
<div class="flex items-center gap-3 pb-4 border-b border-surface-container mb-6">
<div class="w-2.5 h-6 bg-secondary-container rounded-sm"></div>
<div>
<h2 class="font-headline font-bold text-lg text-primary">Maklumat Waris &amp; Hubungan Kecemasan</h2>
<p class="font-body text-xs text-on-surface-variant">Hubungan utama yang dihubungi sekiranya berlaku kecemasan di kolej</p>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
<div class="bg-surface-container-low p-4 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Nama Waris / Penjaga</span>
<p class="font-headline font-semibold text-sm text-primary">{{ $student?->guardian_name ?: 'Belum dikemas kini' }}</p>
<span class="inline-block mt-1 text-[11px] font-label text-on-surface-variant">{{ $student?->guardian_relationship ?: 'Hubungan belum dikemas kini' }}</span>
</div>
<div class="bg-surface-container-low p-4 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">No. Telefon Kecemasan</span>
<p class="font-headline font-semibold text-sm text-primary">{{ $student?->guardian_phone ?: 'Belum dikemas kini' }}</p>
<span class="inline-flex items-center gap-1 mt-1 text-[11px] font-label text-emerald-700">
<span class="material-symbols-outlined text-[14px]">phone_enabled</span> Boleh Dihubungi 24 Jam
              </span>
</div>
<div class="bg-surface-container-low p-4 rounded-lg">
<span class="block font-label text-[11px] uppercase tracking-wide text-on-surface-variant mb-1">Pekerjaan &amp; Majikan</span>
<p class="font-headline font-semibold text-sm text-primary">{{ $student?->guardian_occupation ?: 'Belum dikemas kini' }}</p>
<span class="inline-block mt-1 text-[11px] font-label text-on-surface-variant">{{ $student?->guardian_employer ?: 'Majikan belum dikemas kini' }}</span>
</div>
</div>
</div>
<!-- Academic records placeholder: no confirmed result records are shown in this profile yet. -->
<div id="profile-academic" class="bg-surface-container-lowest rounded-xl p-6 sm:p-7 shadow-sm scroll-mt-6">
  <div class="flex items-center gap-3 pb-4 border-b border-surface-container mb-6">
    <div class="w-2.5 h-6 bg-primary rounded-sm"></div>
    <div>
      <h2 class="font-headline font-bold text-lg text-primary">Rekod Akademik &amp; Peperiksaan (SMPA)</h2>
      <p class="font-body text-xs text-on-surface-variant">Paparan berdasarkan rekod keputusan akademik yang tersedia dalam sistem.</p>
    </div>
  </div>
  <div class="rounded-lg bg-surface-container-low p-6 text-center">
    <span class="material-symbols-outlined text-3xl text-on-surface-variant">school</span>
    <p class="font-headline font-bold text-sm text-primary mt-2">Rekod akademik belum tersedia</p>
    <p class="font-body text-xs text-on-surface-variant mt-1">Keputusan peperiksaan tidak dipaparkan sehingga rekod yang sah tersedia dalam sistem.</p>
  </div>
</div>
<!-- SECTION 4: Subjek Berdaftar Sesi Semasa -->
<div id="profile-subjects" class="bg-surface-container-lowest rounded-xl p-6 sm:p-7 shadow-sm scroll-mt-6">
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-surface-container mb-6">
<div class="flex items-center gap-3">
<div class="w-2.5 h-6 bg-secondary rounded-sm"></div>
<div>
<h2 class="font-headline font-bold text-lg text-primary">Subjek Berdaftar Sesi Semasa</h2>
<p class="font-body text-xs text-on-surface-variant">Senarai berdasarkan rekod pendaftaran subjek dalam sistem.</p>
</div>
</div>
<span class="font-label text-xs font-semibold px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container self-start sm:self-auto">
Semester {{ $student?->semester ?? '—' }}
</span>
</div>
@if ($registeredSubjects->isEmpty())
<div class="rounded-lg bg-surface-container-low p-6 text-center">
<span class="material-symbols-outlined text-3xl text-on-surface-variant">school</span>
<p class="font-headline font-bold text-sm text-primary mt-2">Tiada subjek diluluskan untuk dipaparkan</p>
<p class="font-body text-xs text-on-surface-variant mt-1">Subjek yang berstatus approved akan dipaparkan di sini.</p>
</div>
@else
<div class="overflow-x-auto rounded-lg border border-surface-container">
<table class="w-full text-left text-xs">
<thead class="bg-surface-container-low text-on-surface-variant"><tr><th class="px-4 py-3 font-semibold">Kod / Subjek</th><th class="px-4 py-3 font-semibold">Semester</th><th class="px-4 py-3 font-semibold">Status</th></tr></thead>
<tbody class="divide-y divide-surface-container">
@foreach ($registeredSubjects as $registration)
<tr class="text-primary"><td class="px-4 py-3"><span class="block font-semibold">{{ $registration->subject?->subject_code ?? '—' }}</span><span class="block mt-1 text-on-surface-variant">{{ $registration->subject?->subject_name ?? 'Nama subjek tidak tersedia' }}</span></td><td class="px-4 py-3">{{ $registration->semester }}</td><td class="px-4 py-3"><span class="rounded bg-emerald-100 px-2 py-1 font-semibold text-emerald-800">Diluluskan</span></td></tr>
@endforeach
</tbody></table></div>
@endif
</div>
</div>
<!-- RIGHT COLUMN: Virtual ID Card & Sidebar Auxiliaries (4 Cols / ~32%) -->
<div class="lg:col-span-4 flex flex-col gap-6">
<!-- SUB-PANEL A: Decorative Digital Student Profile -->
<div class="bg-gradient-to-br from-primary via-primary-container to-primary rounded-xl text-on-primary p-6 shadow-xl relative overflow-hidden">
  <!-- Decorative ambient orbs -->
  <div class="absolute -right-16 -top-16 w-44 h-44 bg-secondary-container/20 rounded-full blur-2xl pointer-events-none"></div>
  <div class="absolute -left-12 -bottom-12 w-36 h-36 bg-surface-tint/20 rounded-full blur-2xl pointer-events-none"></div>

  <!-- Profile Header -->
  <div class="relative z-10 flex items-start justify-between gap-3 pb-4 border-b border-on-primary/10">
    <div class="space-y-0.5">
      <span class="block font-headline font-bold text-xs tracking-wider text-secondary-container uppercase">
        DIGITAL STUDENT PROFILE
      </span>
      <p class="font-headline text-[11px] text-primary-fixed tracking-tight">KOLEJ PROFESIONAL MARA BERANANG</p>
    </div>
  </div>

  <!-- Student Details -->
  <div class="relative z-10 my-5 flex items-center gap-4">
    @if ($student?->profile_picture)
      <img
        class="w-20 h-24 rounded-lg object-cover bg-surface-container-high border-2 border-secondary-container/80 shadow-md shrink-0"
        src="{{ asset('storage/' . $student->profile_picture) }}"
        alt="Gambar profil {{ $student->student_name }}"
      />
    @else
      <div class="w-20 h-24 rounded-lg bg-surface-container-high border-2 border-secondary-container/80 shadow-md shrink-0 flex items-center justify-center text-primary text-2xl font-bold">
        {{ strtoupper(substr($student?->student_name ?? Auth::user()->name, 0, 1)) }}
      </div>
    @endif
    <div class="min-w-0 space-y-1">
      <span class="text-[10px] uppercase font-label tracking-widest text-primary-fixed block">Pelajar Diploma</span>
      <h3 class="font-headline font-bold text-sm text-on-primary truncate">{{ $student?->student_name ?? Auth::user()->name }}</h3>
      <p class="font-label text-xs text-secondary-container font-semibold">{{ $student?->student_id ?? 'Belum tersedia' }}</p>
      <p class="font-body text-[11px] text-primary-fixed/80 line-clamp-1">{{ $student?->programme ?? 'Program belum tersedia' }}</p>
    </div>
  </div>

  <!-- Decorative Profile Panel (not a scannable code) -->
  <div class="relative z-10 bg-surface-container-lowest p-3 rounded-lg text-primary flex flex-col items-center justify-center gap-2">
    <span class="material-symbols-outlined text-3xl text-primary/60">school</span>
    <span class="text-[10px] font-label text-on-surface-variant text-center tracking-wide">KPMB STUDENT HUB</span>
  </div>
</div>
<!-- SECTION 3: Penasihat Akademik (Mentor) -->
<div class="bg-surface-container-lowest rounded-xl p-6 sm:p-7 shadow-sm">

    @php
        $mentor = $mentorAssignment?->lecturerDirectory;
    @endphp

    <!-- Section Header -->
    <div class="flex items-center justify-between pb-4 border-b border-surface-container mb-6">
        <div class="flex items-center gap-3">
            <div class="w-2.5 h-6 bg-primary-container rounded-sm"></div>

            <div>
                <h2 class="font-headline font-bold text-lg text-primary">
                    Penasihat Akademik (Mentor)
                </h2>

                <p class="font-body text-xs text-on-surface-variant">
                    Bimbingan modul akademik, kerjaya, dan pemantauan prestasi semester
                </p>
            </div>
        </div>

        <span class="px-2.5 py-1 rounded-full text-xs font-label font-semibold bg-primary-fixed text-on-primary-fixed">
            Maklumat mentor
        </span>
    </div>

    <!-- Mentor Information Card -->
    <div class="bg-surface-container-low rounded-lg p-4 sm:p-5">

        <div class="flex items-start gap-4">

            <!-- Mentor Photo -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                @if ($mentor?->photo_path)
                    <img
                        src="{{ asset('storage/lecturers/' . $mentor->photo_path) }}"
                        alt="{{ $mentor->lecturer_name }}"
                        class="w-full h-full object-cover"
                        onerror="this.onerror=null; this.style.display='none';"
                    >
                @else
                    <span class="material-symbols-outlined text-3xl">person</span>
                @endif
            </div>

            <!-- Mentor Details -->
            <div class="flex-1 min-w-0 space-y-1">
                <h3 class="font-headline font-bold text-base sm:text-lg leading-snug text-primary break-words">
                    {{ $mentor?->lecturer_name ?? 'Belum ditetapkan' }}
                </h3>

                <p class="font-label text-sm text-on-surface-variant">
                    {{ $mentor?->position ?? 'Jawatan belum tersedia' }}
                </p>

                <div class="flex items-start gap-2 pt-2 text-sm text-on-surface-variant">
                    <span class="material-symbols-outlined text-base shrink-0 mt-0.5">domain</span>
                    <span class="min-w-0 break-words">{{ $mentor?->department ?? 'Jabatan belum tersedia' }}</span>
                </div>

                <div class="flex items-start gap-2 pt-1 text-sm text-on-surface-variant">
                    <span class="material-symbols-outlined text-base shrink-0 mt-0.5">mail</span>
                    <span class="min-w-0 break-all">{{ $mentor?->email ?? 'E-mel belum tersedia' }}</span>
                </div>
            </div>
        </div>

        <!-- Assignment Status: separate row to avoid squeezing mentor details -->
        <div class="mt-4 border-t border-surface-container pt-3">
            @if ($mentorAssignment && $mentor)
                <span class="inline-flex max-w-full flex-wrap items-center gap-2 rounded-lg bg-surface-container-highest px-3 py-2 text-xs font-label text-on-surface-variant">
                    <span class="material-symbols-outlined text-base">event_available</span>
                    <span>
                        Dilantik
                        @if ($mentorAssignment->assigned_at)
                            {{ $mentorAssignment->assigned_at->format('d/m/Y') }}
                        @endif
                    </span>
                </span>
            @else
                <span class="inline-flex items-center gap-2 rounded-lg bg-surface-container-highest px-3 py-2 text-xs font-label text-on-surface-variant">
                    <span class="material-symbols-outlined text-base">info</span>
                    Belum dilantik
                </span>
            @endif
        </div>

    </div>
</div>
<!-- Edit Student Profile Modal -->
<div id="profileEditModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-primary/60 p-4" role="dialog" aria-modal="true" aria-labelledby="profileEditTitle">
  <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-surface-container-lowest p-6 shadow-2xl sm:p-8">
    <div class="mb-6 flex items-start justify-between gap-4 border-b border-surface-container pb-4">
      <div>
        <h2 id="profileEditTitle" class="font-headline text-xl font-bold text-primary">Kemaskini Profil Pelajar</h2>
        <p class="mt-1 font-body text-sm text-on-surface-variant">Kemaskini maklumat peribadi dan maklumat waris anda.</p>
      </div>
      <button id="closeProfileEdit" type="button" class="rounded p-1 text-on-surface-variant hover:bg-surface-container" aria-label="Tutup borang">
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>

    <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-6">
      @csrf
      @method('PUT')
      <div>
        <h3 class="mb-3 font-headline font-bold text-primary">Maklumat Peribadi</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Nama penuh
            <input name="student_name" required maxlength="100" value="{{ old('student_name', $student?->student_name ?? Auth::user()->name) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary" autocomplete="name">
            @error('student_name')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Alamat e-mel
            <input type="email" name="email" required maxlength="100" value="{{ old('email', $student?->email ?? Auth::user()->email) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary" autocomplete="email">
            @error('email')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant sm:col-span-2">Nombor telefon
            <input name="phone_number" maxlength="20" value="{{ old('phone_number', $student?->phone_number) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary" autocomplete="tel">
            @error('phone_number')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant sm:col-span-2">Alamat kediaman tetap
            <textarea name="home_address" rows="3" maxlength="2000" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary" autocomplete="street-address">{{ old('home_address', $student?->home_address) }}</textarea>
            @error('home_address')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
        </div>
      </div>

      <div>
        <h3 class="mb-3 font-headline font-bold text-primary">Maklumat Waris &amp; Kecemasan</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Nama waris / penjaga
            <input name="guardian_name" maxlength="100" value="{{ old('guardian_name', $student?->guardian_name) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary">
            @error('guardian_name')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Hubungan dengan pelajar
            <input name="guardian_relationship" maxlength="50" value="{{ old('guardian_relationship', $student?->guardian_relationship) }}" placeholder="Contoh: Bapa, Ibu, Penjaga" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary">
            @error('guardian_relationship')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Nombor telefon waris
            <input name="guardian_phone" maxlength="20" value="{{ old('guardian_phone', $student?->guardian_phone) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary" autocomplete="tel">
            @error('guardian_phone')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant">Pekerjaan waris
            <input name="guardian_occupation" maxlength="100" value="{{ old('guardian_occupation', $student?->guardian_occupation) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary">
            @error('guardian_occupation')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
          <label class="block text-xs font-label font-semibold text-on-surface-variant sm:col-span-2">Majikan waris
            <input name="guardian_employer" maxlength="150" value="{{ old('guardian_employer', $student?->guardian_employer) }}" class="mt-1.5 w-full rounded-lg border border-outline-variant bg-surface px-3 py-2.5 text-sm text-primary outline-none focus:border-primary">
            @error('guardian_employer')<span class="mt-1 block text-xs text-error">{{ $message }}</span>@enderror
          </label>
        </div>
      </div>

      <div class="flex flex-col-reverse gap-2 border-t border-surface-container pt-5 sm:flex-row sm:justify-end">
        <button id="cancelProfileEdit" type="button" class="rounded-lg bg-surface-container px-4 py-2.5 text-xs font-label font-semibold text-primary hover:bg-surface-container-high">Batal</button>
        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-xs font-label font-semibold text-on-primary hover:bg-primary-container">
          <span class="material-symbols-outlined text-[16px]">save</span>Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  // Profile edit modal interaction
  const profileEditModal = document.getElementById('profileEditModal');
  const openProfileEdit = document.getElementById('openProfileEdit');
  const closeProfileEdit = document.getElementById('closeProfileEdit');
  const cancelProfileEdit = document.getElementById('cancelProfileEdit');

  function openProfileModal() {
    profileEditModal.classList.remove('hidden');
    profileEditModal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
  }
  function closeProfileModal() {
    profileEditModal.classList.add('hidden');
    profileEditModal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
  }
  openProfileEdit?.addEventListener('click', openProfileModal);
  closeProfileEdit?.addEventListener('click', closeProfileModal);
  cancelProfileEdit?.addEventListener('click', closeProfileModal);
  profileEditModal?.addEventListener('click', function (event) {
    if (event.target === profileEditModal) closeProfileModal();
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && profileEditModal && !profileEditModal.classList.contains('hidden')) {
      closeProfileModal();
    }
  });

  // Reopen the modal if validation failed.
  @if ($errors->any())
    openProfileModal();
  @endif

  // Profile category navigation: scroll to the relevant section and update the active category.
  const profileCategoryButtons = document.querySelectorAll('.tab-btn[data-target]');
  const defaultTabClass = 'tab-btn px-4 py-2 rounded text-xs font-label text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all shrink-0 flex items-center gap-2';
  const activeTabClass = 'tab-btn px-4 py-2 rounded text-xs font-label font-semibold bg-primary text-on-primary shadow-sm shrink-0 flex items-center gap-2';

  profileCategoryButtons.forEach(button => {
    button.addEventListener('click', function () {
      const target = document.getElementById(this.dataset.target);
      if (!target) return;

      profileCategoryButtons.forEach(item => {
        item.className = defaultTabClass;
        item.setAttribute('aria-current', 'false');
      });

      this.className = activeTabClass;
      this.setAttribute('aria-current', 'true');
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
</script></main><footer class="w-full bg-surface-container-low text-on-surface-variant font-label text-sm mt-16 shadow-[0_-1px_6px_rgba(0,10,30,0.03)]"><div class="max-w-[1280px] mx-auto px-6 py-12 lg:py-16"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10"><div class="space-y-4"><div class="flex items-center gap-2"><div class="w-2 h-6 bg-secondary-container rounded-sm"></div><span class="font-headline font-bold text-primary text-base">Kolej Profesional MARA Beranang</span></div><p class="font-body text-xs text-on-surface-variant leading-relaxed">Lot 2333, Jalan Enam, Kawasan Perindustrian Beranang, 43700 Beranang, Selangor Darul Ehsan, Malaysia.</p><div class="space-y-1 font-label text-xs"><p><span class="font-semibold text-primary">Tel:</span> +603-8766 8466 / 8467</p><p><span class="font-semibold text-primary">Faks:</span> +603-8766 8470</p><p><span class="font-semibold text-primary">E-mel:</span> kpmberanang@mara.gov.my</p></div></div><div class="space-y-3"><h3 class="font-headline font-bold text-primary text-sm uppercase tracking-wider">Pautan Akademik</h3><ul class="space-y-2 text-xs"><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" data-path="jadual-kuliah" href="#">Sistem Maklumat Kuliah &amp; Kalendar</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" href="#">Garis Panduan Peperiksaan Akhir</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" href="#">Portal e-Pembelajaran MARA (Moodle)</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" data-path="direktori-pensyarah" href="#">Konsultasi Pensyarah &amp; Fakulti</a></li></ul></div><div class="space-y-3"><h3 class="font-headline font-bold text-primary text-sm uppercase tracking-wider">Perkhidmatan Pelajar</h3><ul class="space-y-2 text-xs"><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" href="#">Hal Ehwal Pelajar (HEP)</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" href="#">Pengurusan Kolej Kediaman &amp; Asrama</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" data-path="cari-fasiliti" href="#">Tempahan Gelanggang &amp; Dewan Serbaguna</a></li><li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span><a class="hover:text-primary transition-colors" href="#">Bimbingan, Kerjaya &amp; Kaunseling</a></li></ul></div><div class="space-y-3"><h3 class="font-headline font-bold text-primary text-sm uppercase tracking-wider">Talian Kecemasan Kampus</h3><div class="p-4 rounded-lg bg-surface-container space-y-2 text-xs"><p class="text-error font-semibold flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">warning</span>Pos Kawalan Keselamatan Utama</p><p class="font-headline font-bold text-primary text-sm">+603-8766 8499 (24 Jam)</p><div class="pt-2 border-t border-outline-variant/30"><p class="text-on-surface-variant font-medium">Pusat Kesihatan &amp; Pertolongan Cemas:</p><p class="font-headline font-semibold text-primary">+603-8766 8455</p></div></div></div></div><div class="mt-12 pt-6 border-t border-outline-variant/40 flex flex-col md:flex-row items-center justify-between text-xs gap-4"><p>© 2025 Kolej Profesional MARA Beranang (KPMB). Hak Cipta Terpelihara. Bahagian Pendidikan Tinggi MARA.</p><div class="flex items-center gap-6"><a class="hover:text-primary transition-colors" href="#">Dasar Privasi</a><a class="hover:text-primary transition-colors" href="#">Dasar Keselamatan</a><a class="hover:text-primary transition-colors" href="#">Penafian</a></div></div></div></footer></div></body></html>