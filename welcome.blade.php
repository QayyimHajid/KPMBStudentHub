<!DOCTYPE html>

<html lang="ms"><head><meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&amp;display=swap" rel="stylesheet"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{colors:{"on-tertiary-container":"#85898e","tertiary-container":"#1e2226","on-tertiary-fixed-variant":"#43474b","on-surface-variant":"#44474e","primary":"#000a1e","surface-bright":"#fcf9f8","inverse-surface":"#313030","primary-container":"#002147","secondary-fixed-dim":"#e9c349","on-secondary-fixed-variant":"#574500","inverse-on-surface":"#f3f0ef","background":"#fcf9f8","secondary":"#735c00","surface-container-high":"#eae7e7","on-surface":"#1c1b1b","secondary-fixed":"#ffe088","outline":"#74777f","on-secondary-fixed":"#241a00","surface-container-highest":"#e5e2e1","tertiary-fixed":"#e0e3e8","primary-fixed-dim":"#aec7f6","secondary-container":"#fed65b","surface-variant":"#e5e2e1","surface-container-low":"#f6f3f2","error-container":"#ffdad6","surface-dim":"#dcd9d9","on-error":"#ffffff","on-background":"#1c1b1b","on-secondary-container":"#745c00","surface-container":"#f0eded","on-tertiary":"#ffffff","on-primary-container":"#708ab5","on-tertiary-fixed":"#181c20","surface-container-lowest":"#ffffff","on-secondary":"#ffffff","error":"#ba1a1a","on-primary-fixed-variant":"#2d476f","on-primary-fixed":"#001b3d","on-error-container":"#93000a","surface-tint":"#465f88","primary-fixed":"#d6e3ff","tertiary-fixed-dim":"#c3c7cc","surface":"#fcf9f8","tertiary":"#070b0f","outline-variant":"#c4c6cf","inverse-primary":"#aec7f6","on-primary":"#ffffff"},borderRadius:{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},spacing:{},fontFamily:{headline:["Hanken Grotesk"],display:["Hanken Grotesk"],body:["\"Source Serif 4\""],label:["Hanken Grotesk"]},fontSize:{}}}}</script></head><body class="bg-surface font-body text-on-surface antialiased">@include('layouts.partials.visitor-topbar')<main id="utama" class="w-full pt-20 bg-surface"><div class="flex flex-col w-full">
<!-- HERO SECTION -->
<section id="mengenai-kpmb" class="relative w-full overflow-hidden text-on-primary" style="background-image: linear-gradient(135deg, rgba(0,10,30,.94), rgba(0,33,71,.84)), url('{{ asset('images/landing/hero-background.jpg') }}'); background-size: cover; background-position: center;">
<!-- Ambient Glow & Pattern Elements -->
<div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-secondary/15 blur-3xl pointer-events-none"></div>
<div class="absolute top-1/2 -right-32 w-[30rem] h-[30rem] rounded-full bg-primary-fixed-dim/10 blur-3xl pointer-events-none"></div>
<div class="absolute inset-0 bg-[radial-gradient(#fed65b_1px,transparent_1px)] [background-size:28px_28px] opacity-5 pointer-events-none"></div>
<div class="relative max-w-7xl mx-auto px-6 lg:px-12 pt-12 pb-20 lg:pt-16 lg:pb-28">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
<!-- Hero Text -->
<div class="lg:col-span-7 flex flex-col gap-6">
<div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-surface-container-lowest/10 backdrop-blur-md text-secondary-fixed text-xs sm:text-sm font-label font-semibold tracking-wide border-0 shadow-sm w-fit">
<span class="inline-block w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
<span>Institusi Pendidikan Tinggi TVET Terulung MARA</span>
</div>
<h1 class="font-headline font-extrabold text-3xl sm:text-4xl lg:text-5xl xl:text-6xl text-white tracking-tight leading-[1.12]">
            Membina Masa Depan <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-fixed via-secondary-container to-secondary-fixed-dim">Digital &amp; Kepimpinan</span> Profesional Bumiputera
          </h1>
<p class="font-body text-base sm:text-lg lg:text-xl text-primary-fixed leading-relaxed max-w-2xl">
            Pintu gerbang bersepadu warga Kolej Profesional MARA Beranang (KPMB) — memperkasa pendidikan tinggi berasaskan teknologi industri, inovasi perisian pintar, dan kemahiran TVET bertaraf antarabangsa.
          </p>
<!-- Dual CTAs -->
<div class="flex flex-wrap items-center gap-4 pt-2">
<a class="group inline-flex items-center justify-center gap-3 px-6 py-3.5 rounded-lg bg-secondary-container text-on-secondary-container font-label text-sm sm:text-base font-bold shadow-lg shadow-secondary-container/20 hover:brightness-105 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200" href="#portal-gateway">
<span>Terokai Portal Siswa &amp; Staf</span>
<span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
</a>
<a class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-lg bg-surface-container-lowest/10 hover:bg-surface-container-lowest/20 backdrop-blur-md text-white font-label text-sm sm:text-base font-semibold transition-all" href="{{ url('/campus-map') }}">
<span class="material-symbols-outlined text-secondary-fixed text-xl">map</span>
<span>Peta Kampus 3D Interaktif</span>
</a>
</div>
<!-- Micro Highlights -->
<div class="pt-6 grid grid-cols-2 sm:grid-cols-3 gap-4">
<div class="flex flex-col">
<span class="font-headline font-bold text-2xl text-white">1,077</span>
<span class="font-label text-xs text-primary-fixed-dim">Enrolmen Pelajar</span>
</div>
<div class="flex flex-col">
<span class="font-headline font-bold text-2xl text-secondary-fixed">1,230</span>
<span class="font-label text-xs text-primary-fixed-dim">Fasiliti Akademik</span>
</div>
<div class="flex flex-col">
<span class="font-headline font-bold text-2xl text-white">127</span>
<span class="font-label text-xs text-primary-fixed-dim">Staf KPMB</span>
</div>
</div>
<p class="mt-3 font-label text-[10px] text-primary-fixed-dim">Sumber: Statistik rasmi KPMB, 31 Ogos 2026.</p>
</div>
<!-- Hero Visual Showcase: 3-slide carousel -->
<div class="lg:col-span-5 relative">
  <!-- Keep the original card width, padding and 4:3 image ratio -->
  <div class="relative mx-auto max-w-md lg:max-w-none rounded-2xl overflow-hidden bg-primary-container/80 shadow-2xl p-2.5 backdrop-blur-xl">
    <div id="hero-showcase" class="relative rounded-xl overflow-hidden aspect-[4/3] bg-tertiary-container">
      <div id="hero-showcase-track" class="flex h-full transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">

        <!-- Slide 1: Existing campus image -->
        <div class="relative w-full h-full shrink-0">
          <img class="w-full h-full object-cover" alt="Pelajar Kolej Profesional MARA Beranang" src="{{ asset('images/landing/hero-campus.jpg') }}"/>
          <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 right-4">
            <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-primary/80 backdrop-blur-md">
              <span class="font-label text-xs font-semibold text-white">Pelajar DLH</span>
            </div>
          </div>
        </div>

        <!-- Slide 2: Placeholder for the next image -->
        <div class="relative w-full h-full shrink-0">
          <img class="w-full h-full object-cover" alt="Pelajar Kolej Profesional MARA Beranang" src="{{ asset('images/landing/intra.jpg') }}"/>
          <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 right-4">
            <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-primary/80 backdrop-blur-md">
              <span class="font-label text-xs font-semibold text-white">KASUKMA 2025</span>
            </div>
          </div>
        </div>

        <!-- Slide 3: Placeholder for the third image -->
        <div class="relative w-full h-full shrink-0 flex items-center justify-center bg-gradient-to-br from-[#20334b] via-[#10233c] to-[#07152b]">
          <div class="absolute inset-0 bg-[radial-gradient(#fed65b_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
          <div class="relative z-10 flex flex-col items-center text-center px-8">
            <span class="material-symbols-outlined text-5xl text-secondary-fixed">photo_library</span>
            <span class="mt-3 font-label text-xs font-bold uppercase tracking-wider text-secondary-fixed">Placeholder 03</span>
            <span class="mt-2 font-headline text-lg font-bold text-white">Masukkan gambar dan deskripsi di sini</span>
          </div>
        </div>

      </div>

      <!-- Previous / next buttons -->
      <button id="hero-showcase-prev" type="button" aria-label="Gambar sebelumnya"
        class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-primary/75 hover:bg-primary text-white border border-white/20 backdrop-blur-md flex items-center justify-center shadow-lg transition-colors">
        <span class="material-symbols-outlined text-2xl">chevron_left</span>
      </button>
      <button id="hero-showcase-next" type="button" aria-label="Gambar seterusnya"
        class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-primary/75 hover:bg-primary text-white border border-white/20 backdrop-blur-md flex items-center justify-center shadow-lg transition-colors">
        <span class="material-symbols-outlined text-2xl">chevron_right</span>
      </button>

      <!-- Slide indicators -->
      <div class="absolute bottom-3 right-4 z-20 flex items-center gap-2">
        <button type="button" aria-label="Pergi ke gambar 1" data-hero-slide="0" class="hero-showcase-dot w-7 h-2 rounded-full bg-secondary-container transition-all"></button>
        <button type="button" aria-label="Pergi ke gambar 2" data-hero-slide="1" class="hero-showcase-dot w-2 h-2 rounded-full bg-white/60 transition-all"></button>
        <button type="button" aria-label="Pergi ke gambar 3" data-hero-slide="2" class="hero-showcase-dot w-2 h-2 rounded-full bg-white/60 transition-all"></button>
      </div>
    </div>
  </div>
</div>
</div> <!-- close hero grid -->
</div> <!-- close hero content container -->
<!-- Live Micro-Stats Ticker Strip -->
<div class="block w-full min-w-full bg-tertiary text-white py-3.5 px-6 overflow-hidden" style="width:100%;min-width:100%;display:block;box-sizing:border-box;">
  <div class="w-full max-w-7xl mx-auto flex flex-col md:flex-row md:flex-wrap items-start md:items-center justify-between gap-4 font-label text-xs sm:text-sm" style="width:100%;box-sizing:border-box;">
    <div class="flex shrink-0 items-center gap-2 text-secondary-fixed font-bold tracking-wider uppercase">
      <span class="material-symbols-outlined text-sm">campaign</span>
      <span>Maklumat Terkini Kampus:</span>
    </div>
    <div class="flex flex-1 min-w-0 flex-wrap items-center gap-x-6 gap-y-2 sm:gap-x-10 text-on-tertiary-container">
      <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 shrink-0 rounded-full bg-secondary-container"></span> Permohonan Kemasukan Sesi II 2025/2026 Kini Dibuka</span>
      <span class="hidden md:inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 shrink-0 rounded-full bg-secondary-container"></span> Karnival Inovasi &amp; TVET KPMB pada 18–20 Ogos</span>
      <span class="hidden lg:inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 shrink-0 rounded-full bg-secondary-container"></span> Portal Pelajar versi 4.2 telah dikemaskini</span>
    </div>
    <a class="shrink-0 text-secondary-fixed font-semibold hover:underline inline-flex items-center gap-1" href="#hebahan">
      <span>Lihat Semua</span>
      <span class="material-symbols-outlined text-[14px]">chevron_right</span>
    </a>
  </div>
</div>
</section>
<!-- PORTAL GATEWAY SECTION -->
<section class="w-full py-16 lg:py-24 px-6 lg:px-12 bg-surface" id="portal-gateway">
<div class="max-w-7xl mx-auto flex flex-col gap-12">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div class="flex flex-col gap-2 max-w-2xl">
<div class="flex items-center gap-2 text-secondary font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-[18px]">apps</span>
<span>Hab Akses Berpusat</span>
</div>
<h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
            Portal Warga Kampus &amp; Sistem Pengurusan
          </h2>
<p class="font-body text-base text-on-surface-variant">
            Pilih peranan anda untuk mengakses papan pemuka akademik, rekod elaun, semakan fasiliti, atau panduan lawatan rasmi.
          </p>
</div>
<div class="flex items-center gap-2 shrink-0">
<span class="font-label text-xs font-medium text-on-surface-variant">Status Sistem:</span>
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-xs font-semibold text-emerald-800">
<span class="w-2 h-2 rounded-full bg-emerald-600"></span> Semua Pelayan Beroperasi
          </span>
</div>
</div>
<!-- Role Selection Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Student Hub -->
<div class="group relative flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest hover:bg-surface-container-lowest shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
<div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container via-secondary to-primary rounded-t-2xl"></div>
<div class="flex flex-col gap-4">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-xl bg-primary text-secondary-fixed flex items-center justify-center shadow-md">
<span class="material-symbols-outlined text-2xl">school</span>
</div>
<span class="px-2.5 py-1 rounded-full bg-secondary-fixed/30 text-on-secondary-fixed text-xs font-label font-bold">Akses Pantas</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-primary-container transition-colors">Portal Siswa (Student Hub)</h3>
<p class="font-body text-xs text-on-surface-variant leading-relaxed">
                Papan pemuka jadual kelas, pendaftaran kursus semester, semakan slip keputusan SPM/SMPA, semakan status elaun BPT MARA, dan aktiviti persatuan siswa.
              </p>
</div>
<ul class="flex flex-col gap-1.5 font-label text-xs text-on-surface-variant pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Semakan Slip Peperiksaan (SMPA)</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Jadual Kuliah &amp; Kehadiran QR</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Penyata Elaun Bulanan MARA</span>
</li>
</ul>
</div>
<div class="pt-6">
<a class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-primary text-white font-label text-xs font-bold hover:bg-primary-container transition-all" data-path="log-masuk-portal" href="/login">
<span>Log Masuk Siswa</span>
<span class="material-symbols-outlined text-sm">login</span>
</a>
</div>
</div>
<!-- Staff / Lecturer -->
<div class="group relative flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest hover:bg-surface-container-lowest shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
<div class="absolute top-0 left-0 right-0 h-1.5 bg-primary rounded-t-2xl"></div>
<div class="flex flex-col gap-4">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-2xl">badge</span>
</div>
<span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-label font-bold">Akses Staf</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-headline font-bold text-lg text-primary">Portal Pensyarah &amp; Staf</h3>
<p class="font-body text-xs text-on-surface-variant leading-relaxed">
                Pengurusan kurikulum akademik, permohonan cuti e-HR, input markah pentaksiran berterusan, peruntukan makmal teknologi, dan mesyuarat senat kolej.
              </p>
</div>
<ul class="flex flex-col gap-1.5 font-label text-xs text-on-surface-variant pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Sistem Gred &amp; Pentaksiran Kursus</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Pengurusan Modul &amp; Bahan Kuliah</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Sistem Pentadbiran Sumber Manusia</span>
</li>
</ul>
</div>
<div class="pt-6">
<a class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container text-primary hover:bg-primary hover:text-white font-label text-xs font-bold transition-all" data-path="log-masuk-portal" href="/login">
<span>Log Masuk Staf</span>
<span class="material-symbols-outlined text-sm">badge</span>
</a>
</div>
</div>
<!-- Visitors & Corporate -->
<div class="group relative flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest hover:bg-surface-container-lowest shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
<div class="flex flex-col gap-4">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-xl bg-surface-container-high text-secondary flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-2xl">domain</span>
</div>
<span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-label font-bold">Umum</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-headline font-bold text-lg text-primary">Pelawat &amp; Rakan Industri</h3>
<p class="font-body text-xs text-on-surface-variant leading-relaxed">
                Pendaftaran pas pelawat pintu hadapan, panduan tempat meletak kenderaan, pendaftaran program padanan industri TVET, dan direktori direktori pegawai jabatan.
              </p>
</div>
<ul class="flex flex-col gap-1.5 font-label text-xs text-on-surface-variant pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Pra-Pendaftaran Pelawat Rasmi</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Peta Pandu Arah &amp; Zon Parkir</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Jaringan Industri &amp; Penempatan Latihan</span>
</li>
</ul>
</div>
<div class="pt-6">
<a class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container text-primary hover:bg-primary hover:text-white font-label text-xs font-bold transition-all" href="#panduan-pelawat">
<span>Panduan Pelawat</span>
<span class="material-symbols-outlined text-sm">info</span>
</a>
</div>
</div>
<!-- UPP & Facility Management -->
<div class="group relative flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest hover:bg-surface-container-lowest shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
<div class="flex flex-col gap-4">
<div class="flex items-center justify-between">
<div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-2xl">event_available</span>
</div>
<span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-label font-bold">Fasiliti</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-headline font-bold text-lg text-primary">Sistem Pengurusan Fasiliti (UPP)</h3>
<p class="font-body text-xs text-on-surface-variant leading-relaxed">
                E-tempahan Dewan Gemilang Ilmu, makmal komputer, auditorium kuliah, padang sukan, dan aduan penyelenggaraan fasiliti kampus secara digital.
              </p>
</div>
<ul class="flex flex-col gap-1.5 font-label text-xs text-on-surface-variant pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Tempahan Dewan &amp; Peralatan AV</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Bilik Seminar &amp; Makmal Komputer</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span>Borang Aduan Kerosakan Online</span>
</li>
</ul>
</div>
<div class="pt-6">
<a class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container text-primary hover:bg-primary hover:text-white font-label text-xs font-bold transition-all" href="#">
<span>E-Tempahan Fasiliti</span>
<span class="material-symbols-outlined text-sm">open_in_new</span>
</a>
</div>
</div>
</div>
</div>
</section>
<!-- INTERACTIVE CAMPUS LIFE & FACILITIES SLIDESHOW -->
<section class="w-full py-16 lg:py-24 px-6 lg:px-12 bg-surface-container-low">
<div class="max-w-7xl mx-auto flex flex-col gap-10">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-secondary font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-[18px]">view_carousel</span>
<span>Prasarana Pembelajaran &amp; Kehidupan Siswa</span>
</div>
<h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
            Sorotan Kehidupan Kampus Berprestasi Tinggi
          </h2>
</div>
<!-- Carousel Navigation Controls -->
<div class="flex items-center gap-3">
<button aria-label="Slide Terdahulu" class="w-11 h-11 rounded-full bg-surface-container-lowest text-primary shadow-sm hover:bg-primary hover:text-white flex items-center justify-center transition-colors" id="carousel-prev" type="button">
<span class="material-symbols-outlined text-xl">arrow_back</span>
</button>
<button aria-label="Slide Seterusnya" class="w-11 h-11 rounded-full bg-surface-container-lowest text-primary shadow-sm hover:bg-primary hover:text-white flex items-center justify-center transition-colors" id="carousel-next" type="button">
<span class="material-symbols-outlined text-xl">arrow_forward</span>
</button>
</div>
</div>
<!-- Slideshow Container -->
<div class="relative overflow-hidden rounded-2xl bg-surface-container-lowest shadow-md">
<div class="flex transition-transform duration-500 ease-out" id="carousel-track" style="transform: translateX(0%);">
<!-- Slide 1: Dewan Gemilang Ilmu -->
<div class="w-full shrink-0 grid grid-cols-1 lg:grid-cols-12 min-h-[460px]">
<div class="lg:col-span-7 relative h-72 lg:h-auto overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Dewan Gemilang Ilmu Kolej Profesional MARA Beranang, huge contemporary auditorium packed with university students attending an AI innovation summit, glowing large stage screens with blue tech presentation graphics, modern architectural seats" src="{{ asset('images/facility_pics/Dewan Gemilang/dewan_V2.jpg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent"></div>
<span class="absolute top-4 left-4 px-3 py-1 rounded-md bg-primary/80 backdrop-blur-md text-white font-label text-xs font-bold">Fasiliti Utama #01</span>
</div>
<div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-between">
<div class="flex flex-col gap-4">
<span class="text-xs font-label uppercase font-bold text-secondary">Auditorium Perdana KPM Beranang</span>
<h3 class="font-headline font-bold text-2xl lg:text-3xl text-primary leading-tight">Dewan Gemilang Ilmu</h3>
<p class="font-body text-sm lg:text-base text-on-surface-variant leading-relaxed">
                  Pusat tumpuan konvokesyen, seminar kepimpinan bumiputera, dan persidangan antarabangsa berkapasiti 1,200 orang. Dilengkapi sistem akustik studio bertaraf antarabangsa, pentas modular, dan pencahayaan teater digital berdefinisi tinggi.
                </p>
<div class="flex flex-wrap gap-2 pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Kapasiti 1,200 Tempat Duduk</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Sistem Audio Bose Line-Array</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Skrin LED 4K 16x9 Meter</span>
</div>
</div>
<div class="pt-6">
<a class="inline-flex items-center gap-2 text-primary font-label font-bold text-sm hover:text-secondary transition-colors" href="#peta-kampus">
<span>Lihat Lokasi Dalam Peta Kampus</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</div>
<!-- Slide 2: Makmal AI & TVET -->
<div class="w-full shrink-0 grid grid-cols-1 lg:grid-cols-12 min-h-[460px]">
<div class="lg:col-span-7 relative h-72 lg:h-auto overflow-hidden">
<img class="w-full h-full object-cover" data-alt="High-tech university computer laboratory at Kolej Profesional MARA Beranang, dual monitor workstations with coding lines and AI models, Malaysian IT students collaborating in modern laboratory, sleek dark interior with warm ambient LED accents" src="{{ asset('images/facility_pics/Makmal & Bengkel ICT/makmal2_V2.jpg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent"></div>
<span class="absolute top-4 left-4 px-3 py-1 rounded-md bg-primary/80 backdrop-blur-md text-white font-label text-xs font-bold">Fasiliti Utama #02</span>
</div>
<div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-between">
<div class="flex flex-col gap-4">
<span class="text-xs font-label uppercase font-bold text-secondary">Blok Akademik M &amp; B</span>
<h3 class="font-headline font-bold text-2xl lg:text-3xl text-primary leading-tight">Makmal &amp; Hab Pengkomputeran</h3>
<p class="font-body text-sm lg:text-base text-on-surface-variant leading-relaxed">
                  Ruang pengajaran praktikal dengan 40 workstation berprestasi tinggi berkuasa cip pemproses Nvidia RTX. Dikhususkan untuk simulasi pengaturcaraan, keselamatan siber, analisis data raya, serta pembangunan aplikasi web dan sistem enterprise.
                </p>
<div class="flex flex-wrap gap-2 pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">40 Unit Workstation GPU</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Akses Cloud AWS &amp; Azure</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Rangkaian Gentian Optik 10Gbps</span>
</div>
</div>
<div class="pt-6">
<a class="inline-flex items-center gap-2 text-primary font-label font-bold text-sm hover:text-secondary transition-colors" href="#peta-kampus">
<span>Lihat Lokasi Dalam Peta Kampus</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</div>
<!-- Slide 3: Perpustakaan Digital Ibnu Khaldun -->
<div class="w-full shrink-0 grid grid-cols-1 lg:grid-cols-12 min-h-[460px]">
<div class="lg:col-span-7 relative h-72 lg:h-auto overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Modern college digital library interior with tall bookshelves, glass study pods, ergonomic chairs, students quietly reading and working on laptops, bright natural sunlight streaming from floor to ceiling windows, clean academic architecture" src="{{ asset('images/facility_pics/Perpustakaan Zaba/zaba.jpg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent"></div>
<span class="absolute top-4 left-4 px-3 py-1 rounded-md bg-primary/80 backdrop-blur-md text-white font-label text-xs font-bold">Fasiliti Utama #03</span>
</div>
<div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-between">
<div class="flex flex-col gap-4">
<span class="text-xs font-label uppercase font-bold text-secondary">Pusat Sumber Pengetahuan</span>
<h3 class="font-headline font-bold text-2xl lg:text-3xl text-primary leading-tight">Perpustakaan Zaba</h3>
<p class="font-body text-sm lg:text-base text-on-surface-variant leading-relaxed">
                  Hab pembelajaran hibrid yang menempatkan lebih 25,000 rujukan fizikal dan akses portal jurnal antarabangsa IEEE, Springer, dan Emerald. Dilengkapi bilik perbincangan pintar, zon senyap, dan kafe santai siswa.
                </p>
<div class="flex flex-wrap gap-2 pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Akses 25,000+ E-Buku</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">8 Bilik Perbincangan Pintar</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Kaunter Peminjaman RFID Pintar</span>
</div>
</div>
<div class="pt-6">
<a class="inline-flex items-center gap-2 text-primary font-label font-bold text-sm hover:text-secondary transition-colors" href="#peta-kampus">
<span>Lihat Lokasi Dalam Peta Kampus</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</div>
<!-- Slide 4: Kompleks Sukan & Kamsis -->
<div class="w-full shrink-0 grid grid-cols-1 lg:grid-cols-12 min-h-[460px]">
<div class="lg:col-span-7 relative h-72 lg:h-auto overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Vibrant outdoor athletic complex at Malaysian university campus, green football turf field with red running tracks, basketball court, students doing sports in the golden late afternoon light with tropical green trees around" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBSFpHuFvYQGxHDY5BCEKnQ3O3g47L6r1Xt_jWy0csBx148xK0GJXx-aAhUbSZEb0qfV0hF71MbSxmysrWuUkECuYmjDXZhY8EOIMSmbnNQfYohwQckJDbxD6Sa7oS03nxojhpn7ZcditaDm7a1kqjVvGDQKHulcoObpmFWFNb_dOaFYQtVhBG2CsKJ4zVf55iot4VLEWSKB95iAuyyWMqKi8UPlX9z2dC8-ob4LrIFZ2KX6W_hENA8"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent"></div>
<span class="absolute top-4 left-4 px-3 py-1 rounded-md bg-primary/80 backdrop-blur-md text-white font-label text-xs font-bold">Fasiliti Utama #04</span>
</div>
<div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-between">
<div class="flex flex-col gap-4">
<span class="text-xs font-label uppercase font-bold text-secondary">Kesihatan &amp; Pembangunan Sahsiah</span>
<h3 class="font-headline font-bold text-2xl lg:text-3xl text-primary leading-tight">Kompleks Sukan &amp; Padang Utama</h3>
<p class="font-body text-sm lg:text-base text-on-surface-variant leading-relaxed">
                  Menawarkan padang bola sepak berspesifikasi kejohanan, balapan larian sintetik, gelanggang bola keranjang, bola tampar, dan dewan badminton berhawa dingin bagi menggalakkan gaya hidup cergas warga kolej.
                </p>
<div class="flex flex-wrap gap-2 pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Padang Utama &amp; Balapan Larian</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Gelanggang Futsal &amp; Keranjang</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-xs font-label font-medium text-primary">Gimnasium Kecergasan Siswa/Siswi</span>
</div>
</div>
<div class="pt-6">
<a class="inline-flex items-center gap-2 text-primary font-label font-bold text-sm hover:text-secondary transition-colors" href="#peta-kampus">
<span>Lihat Lokasi Dalam Peta Kampus</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</div>
</div>
<!-- Pagination Indicators -->
<div class="flex items-center justify-center gap-2 pb-6 pt-2 bg-surface-container-lowest">
<button aria-label="Pergi ke Slaid 1" class="carousel-dot w-8 h-2 rounded-full bg-secondary-container transition-all" type="button"></button>
<button aria-label="Pergi ke Slaid 2" class="carousel-dot w-2 h-2 rounded-full bg-surface-container-highest transition-all" type="button"></button>
<button aria-label="Pergi ke Slaid 3" class="carousel-dot w-2 h-2 rounded-full bg-surface-container-highest transition-all" type="button"></button>
<button aria-label="Pergi ke Slaid 4" class="carousel-dot w-2 h-2 rounded-full bg-surface-container-highest transition-all" type="button"></button>
</div>
</div>
</div>
</section>
<!-- 3D ISOMETRIC CAMPUS MAP SPOTLIGHT -->
<section class="w-full py-16 lg:py-24 px-6 lg:px-12 bg-surface" id="peta-kampus">
<div class="max-w-7xl mx-auto flex flex-col gap-10">
<div class="relative overflow-hidden rounded-3xl bg-primary text-white p-8 lg:p-14 shadow-xl">
<!-- Background Lighting FX -->
<div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-secondary/20 blur-3xl pointer-events-none"></div>
<div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-primary-fixed-dim/15 blur-3xl pointer-events-none"></div>
<div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
<div class="lg:col-span-6 flex flex-col gap-6">
<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container-lowest/10 text-secondary-fixed text-xs font-label font-bold w-fit">
<span class="material-symbols-outlined text-sm">explore</span>
<span>Navigasi Kampus Pintar KPMB</span>
</div>
<h2 class="font-headline font-extrabold text-2xl sm:text-3xl lg:text-4xl leading-tight">
              Peta Isometrik Interaktif Kampus Beranang
            </h2>
<p class="font-body text-sm sm:text-base text-primary-fixed leading-relaxed">
              Keluasan kampus seluas 35 ekar kini dalam capaian digital anda. Terokai kedudukan blok akademik, laluan pejalan kaki berbumbung, surau, dewan peperiksaan, dan tempat meletak kenderaan pelawat dengan panduan zon berlabel lengkap.
            </p>
<!-- Quick Zone Guide -->
<div class="grid grid-cols-2 gap-3 pt-2 font-label text-xs">
<div class="flex items-center gap-2.5 p-3 rounded-lg bg-surface-container-lowest/5">
<span class="w-2.5 h-2.5 rounded-full bg-secondary-container"></span>
<span class="text-white font-medium">Laluan Pejalan Kaki Berbumbung</span>
</div>
<div class="flex items-center gap-2.5 p-3 rounded-lg bg-surface-container-lowest/5">
<span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
<span class="text-white font-medium">Dewan Gemilang Ilmu</span>
</div>
<div class="flex items-center gap-2.5 p-3 rounded-lg bg-surface-container-lowest/5">
<span class="w-2.5 h-2.5 rounded-full bg-sky-300"></span>
<span class="text-white font-medium">Kolej Library &amp; Pentadbiran</span>
</div>
<div class="flex items-center gap-2.5 p-3 rounded-lg bg-surface-container-lowest/5">
<span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
<span class="text-white font-medium">Kamsis Farabi, Amar &amp; Aisyah</span>
</div>
</div>
<div class="flex flex-wrap items-center gap-4 pt-4">
<a class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-lg bg-secondary-container text-on-secondary-container font-label text-sm font-bold shadow-lg shadow-secondary/20 hover:brightness-105 transition-all" data-path="peta-interaktif" href="#peta-kampus">
<span class="material-symbols-outlined text-lg">explore</span>
<span>Lancar Peta Kampus Interaktif Penuh</span>
</a>
<div class="flex items-center gap-2 text-xs text-primary-fixed-dim">
<span class="material-symbols-outlined text-secondary-fixed text-sm">schedule</span>
<span>Dikemaskini Sesi 2025</span>
</div>
</div>
</div>
<!-- Isometric Map Preview Card -->
<div class="lg:col-span-6 relative">
<div class="group relative rounded-2xl overflow-hidden bg-tertiary-container shadow-2xl transition-transform duration-300 hover:scale-[1.01]">
<img class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105" data-alt="Detailed 3D isometric overview map of Kolej Profesional MARA Beranang educational campus showing marked zones including Blok B, Blok M, Dewan Gemilang Ilmu, College Library, sports complex football field, running track, covered yellow walkways, and student hostels surrounded by green lush trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA37G3j8D6QwMP4jsSBc7DJnLEJCrRqOZ1FR_IZGyY2xD20Uq0CTcRWvuGlsuOrxJXhEVnuU_22tcgMTDaAcmxyaRc1iob0rbwDc99yi8SGq08B8ggIRlPPfn8J0qfsmGwRhKfs-yxxNLYkM0V2fDt08jmuJK3ub4iq0uj6qzf4bDV6nN1lD_4k7EBibdWs3ZLiBRSunLvOyioclVh0cIAvkHpAIBxF7u0nRxB9Eh_Pp7U5HrCy82OI"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent pointer-events-none"></div>
<!-- Interactive Floating Pin Overlay -->
<div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
<div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary/90 backdrop-blur-md text-white text-xs font-label">
<span class="material-symbols-outlined text-secondary-fixed text-sm">pin_drop</span>
<span>Kamsis • Dewan • Makmal • Kompleks Sukan</span>
</div>
<span class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container text-[11px] font-label font-bold">Zon Interaktif</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- BENTO STATS & INSTITUTIONAL EXCELLENCE -->
<section class="w-full py-16 px-6 lg:px-12 bg-surface-container-low">
<div class="max-w-7xl mx-auto flex flex-col gap-10">
<div class="flex flex-col gap-2 max-w-2xl">
<span class="text-xs font-label uppercase font-bold text-secondary tracking-wider">Kecemerlangan Berterusan</span>
<h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
          Statistik Rasmi KPMB
        </h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Statistik rasmi KPMB: data 31 Ogos 2026 -->
<div class="flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest shadow-sm">
<div class="flex items-center justify-between"><span class="material-symbols-outlined text-3xl text-secondary">groups</span><span class="text-xs font-label font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">Data rasmi</span></div>
<div class="flex flex-col gap-1 mt-6"><span class="font-headline font-extrabold text-3xl lg:text-4xl text-primary">1,077</span><span class="font-headline font-semibold text-sm text-primary">Enrolmen</span><p class="font-body text-xs text-on-surface-variant pt-2">Jumlah enrolmen yang dilaporkan dalam statistik rasmi KPMB.</p></div>
</div>
<div class="flex flex-col justify-between p-6 rounded-2xl bg-surface-container-lowest shadow-sm">
<div class="flex items-center justify-between"><span class="material-symbols-outlined text-3xl text-secondary">domain</span><span class="text-xs font-label font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">Data rasmi</span></div>
<div class="flex flex-col gap-1 mt-6"><span class="font-headline font-extrabold text-3xl lg:text-4xl text-primary">1,230</span><span class="font-headline font-semibold text-sm text-primary">Fasiliti Akademik</span><p class="font-body text-xs text-on-surface-variant pt-2">Jumlah fasiliti akademik yang dipaparkan oleh KPMB.</p></div>
</div>
<div class="flex flex-col justify-between p-6 rounded-2xl bg-primary text-white shadow-sm">
<div class="flex items-center justify-between"><span class="material-symbols-outlined text-3xl text-secondary-fixed">badge</span><span class="text-xs font-label font-bold bg-secondary-container text-on-secondary-container px-2 py-0.5 rounded">Data rasmi</span></div>
<div class="flex flex-col gap-1 mt-6"><span class="font-headline font-extrabold text-3xl lg:text-4xl text-secondary-fixed">127</span><span class="font-headline font-semibold text-sm text-white">Staf KPMB</span><p class="font-body text-xs text-primary-fixed pt-2">Jumlah staf yang dilaporkan dalam statistik rasmi KPMB.</p></div>
</div>
</div>
<p class="mt-4 font-label text-xs text-on-surface-variant">Sumber: Statistik rasmi KPMB, 31 Ogos 2026.</p></div>
</div>
</section>
<!-- HEBAHAN TERKINI & KALENDAR AKADEMIK -->
<section class="w-full py-16 lg:py-24 px-6 lg:px-12 bg-surface" id="hebahan">
<div class="max-w-7xl mx-auto flex flex-col gap-10">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-secondary font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-[18px]">newspaper</span>
<span>Berita &amp; Hebahan Warga</span>
</div>
<h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">Perkembangan Semasa KPM Beranang</h2>
<p class="font-body text-sm text-on-surface-variant">Berita dan hebahan berdasarkan penerbitan rasmi Kolej Profesional MARA Beranang.</p>
</div>
<div class="flex items-center gap-1.5 p-1 rounded-xl bg-surface-container font-label text-xs font-semibold overflow-x-auto max-w-full">
<button class="tab-btn px-3.5 py-1.5 rounded-lg bg-surface-container-lowest text-primary shadow-sm whitespace-nowrap" data-category="all" type="button">Semua (6)</button>
<button class="tab-btn px-3.5 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface whitespace-nowrap" data-category="akademik" type="button">Akademik</button>
<button class="tab-btn px-3.5 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface whitespace-nowrap" data-category="industri" type="button">Kerjaya &amp; Industri</button>
<button class="tab-btn px-3.5 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface whitespace-nowrap" data-category="siswa" type="button">Aktiviti Siswa</button>
</div>
</div>
<div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
<!-- 1: Anugerah Remaja Perdana Rakan Muda -->
<article data-news-category="siswa" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-500" alt="Poster tahniah kepada pelajar KPM Beranang penerima Tahap Emas Anugerah Remaja Perdana Rakan Muda 2026" src="{{ asset('images/landing/berita-arprm.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-primary/85 text-white text-[11px] font-label font-bold">Aktiviti Siswa</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>17 Oktober 2026</span><span>•</span><span>Pencapaian Pelajar</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Syabas! Pelajar KPM Beranang Menerima Tahap Emas ARPRM 2026</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">Tahniah kepada Muhammad Aqil Zuhair bin Noorazizan, pelajar Diploma in Business Studies, atas pengiktirafan Tahap Emas Anugerah Remaja Perdana Rakan Muda 2026.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
<!-- 2: EC-Council Ethical Hacking -->
<article data-news-category="akademik" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Pelajar KPM Beranang menyertai aktiviti dan bengkel keselamatan siber" src="{{ asset('images/landing/berita-ethical-hacking.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-primary/85 text-white text-[11px] font-label font-bold">Akademik</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>16 Oktober 2026</span><span>•</span><span>Bengkel Kemahiran</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Bengkel EC-Council Ethical Hacking 2026</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">Bengkel bersama Intellize dan EC-Council memberi pendedahan kepada pelajar tentang ethical hacking, pengesanan kelemahan sistem dan keselamatan rangkaian digital.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
<!-- 3: Lawatan rasmi ProBiz ke BPU -->
<article data-news-category="industri" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Lawatan rasmi wakil KPM Beranang ke Bahagian Pembangunan Usahawan Desa" src="{{ asset('images/landing/berita-lawatan-probiz.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container text-[11px] font-label font-bold">Kerjaya &amp; Industri</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>20 Oktober 2026</span><span>•</span><span>Jaringan Industri</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Lawatan ProBiz ke Bahagian Pembangunan Usahawan Desa</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">Lawatan rasmi ke BPU, KKDW bertujuan mendapatkan maklumat tentang peluang geran dan pembiayaan bagi usahawan di bawah Program Diploma Profesional Perniagaan.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
<!-- 4: Jawatan kosong guru matematik -->
<article data-news-category="industri" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-500" alt="Poster iklan kekosongan jawatan guru Matematik sambilan di Kolej Profesional MARA Beranang" src="{{ asset('images/landing/berita-jawatan-kosong.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container text-[11px] font-label font-bold">Peluang Kerjaya</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>21 Oktober 2026</span><span>•</span><span>Jawatan Kosong</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Peluang Kerjaya: Guru Matematik Sambilan</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">KPM Beranang membuka satu kekosongan guru Matematik sambilan selama tiga bulan. Tarikh tutup permohonan ialah 6 November 2026, jam 4.30 petang.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
<!-- 5: ProBiz Smart Agro -->
<article data-news-category="industri" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Lawatan jaringan industri ProBiz Smart Agro dan pemantauan latihan industri di Petani Kota NZ Resources" src="{{ asset('images/landing/berita-probiz-smart-agro.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container text-[11px] font-label font-bold">Kerjaya &amp; Industri</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>22 Oktober 2026</span><span>•</span><span>Kerjasama Industri</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Jaringan Industri ProBiz Smart Agro &amp; Pemantauan Latihan Industri</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">Lawatan ke Petani Kota NZ Resources mengukuhkan hubungan industri, memantau latihan industri pelajar dan meneroka peluang kolaborasi dalam bidang agro dan keusahawanan.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
<!-- 6: Tarikh penting kemasukan -->
<article data-news-category="akademik" class="news-card flex flex-col rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-lg transition-all group">
<div class="relative h-56 sm:h-60 overflow-hidden bg-surface-container flex items-center justify-center">
<img loading="lazy" class="w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-500" alt="Infografik tarikh penting kemasukan Kolej Profesional MARA sesi November 2026/2027" src="{{ asset('images/landing/berita-tarikh-penting.jpg') }}"/>
<span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-primary/85 text-white text-[11px] font-label font-bold">Kemasukan</span>
</div>
<div class="p-6 flex flex-col justify-between flex-1 gap-4"><div class="flex flex-col gap-2">
<div class="flex items-center gap-2 text-xs font-label text-on-surface-variant"><span>15 Oktober 2026</span><span>•</span><span>Sesi November 2026/2027</span></div>
<h3 class="font-headline font-bold text-lg text-primary group-hover:text-secondary transition-colors">Tarikh Penting Kemasukan KPM Sesi November 2026/2027</h3>
<p class="font-body text-xs text-on-surface-variant line-clamp-3 leading-relaxed">Rujuk jadual rasmi untuk pengesahan temuduga, ujian, semakan keputusan, rayuan dan pendaftaran pelajar baharu bagi sesi November 2026/2027.</p>
</div><div class="pt-2"><a class="inline-flex items-center gap-1.5 text-xs font-label font-bold text-primary hover:text-secondary transition-colors" href="https://beranang.kpm.edu.my" target="_blank" rel="noopener noreferrer"><span>Lihat Laman Rasmi KPMB</span><span class="material-symbols-outlined text-[16px]">arrow_outward</span></a></div></div>
</article>
</div>
</div>
</section>
<!-- PANDUAN PELAWAT & FAQ EXPANDABLE SECTION -->
<section id="hubungi" class="w-full py-16 lg:py-24 px-6 lg:px-12 bg-surface-container-low" id="panduan-pelawat">
<div class="max-w-4xl mx-auto flex flex-col gap-10">
<div class="text-center flex flex-col items-center gap-2">
<span class="text-xs font-label uppercase font-bold text-secondary tracking-wider">Soalan Lazim &amp; Panduan</span>
<h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
          Panduan Pantas Pengunjung &amp; Siswa Baru
        </h2>
<p class="font-body text-sm text-on-surface-variant max-w-xl">
          Maklumat penting mengenai urusan pendaftaran, syarat kemasukan, kemudahan penginapan kolej, dan tatacara pelawat rasmi di pintu kawalan KPMB.
        </p>
</div>
<!-- Accordion Container -->
<div class="flex flex-col gap-3">
<!-- FAQ 1 -->
<div class="faq-item rounded-xl bg-surface-container-lowest overflow-hidden shadow-sm transition-all">
<button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-headline font-semibold text-base text-primary" type="button">
<span>Bagaimanakah prosedur pendaftaran pertama kali bagi Portal Siswa (Student Hub)?</span>
<span class="material-symbols-outlined text-secondary transition-transform duration-300">expand_more</span>
</button>
<div class="faq-content hidden px-6 pb-5 pt-1 text-sm font-body text-on-surface-variant leading-relaxed">
            Setiap pelajar baharu yang mendaftar di KPM Beranang akan menerima No. Matrik rasmi dan kata laluan sementara melalui e-mel tawaran MARA. Sila klik pautan "Log Masuk Portal Siswa" di bahagian atas laman ini, pilih "Pendaftaran Kali Pertama", dan lengkapkan pengesahan identiti MyKad untuk mengaktifkan profil digital anda.
          </div>
</div>
<!-- FAQ 2 -->
<div class="faq-item rounded-xl bg-surface-container-lowest overflow-hidden shadow-sm transition-all">
<button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-headline font-semibold text-base text-primary" type="button">
<span>Apakah kemudahan asrama (Kamsis) yang disediakan untuk pelajar?</span>
<span class="material-symbols-outlined text-secondary transition-transform duration-300">expand_more</span>
</button>
<div class="faq-content hidden px-6 pb-5 pt-1 text-sm font-body text-on-surface-variant leading-relaxed">
            KPMB menyediakan kemudahan asrama penuh (Kamsis Farabi, Kamsis Amar, dan Kamsis Aisyah) yang mampu menampung keseluruhan pelajar semester 1 hingga semester akhir. Setiap blok dilengkapi bilik berhawa nyaman, sambungan Wi-Fi kampus tanpa had, bilik dobi layan diri, dewan makan berpusat, dan kawalan keselamatan 24 jam berpagar.
          </div>
</div>
<!-- FAQ 3 -->
<div class="faq-item rounded-xl bg-surface-container-lowest overflow-hidden shadow-sm transition-all">
<button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-headline font-semibold text-base text-primary" type="button">
<span>Bagaimana tatacara untuk ibu bapa atau pelawat korporat memasuki kawasan kampus?</span>
<span class="material-symbols-outlined text-secondary transition-transform duration-300">expand_more</span>
</button>
<div class="faq-content hidden px-6 pb-5 pt-1 text-sm font-body text-on-surface-variant leading-relaxed">
            Semua pelawat luar diminta memperlahankan kenderaan di Pondok Guard (Pintu Utama) dan mendaftar menggunakan MyKad atau pas memandu. Pegawai keselamatan akan memberikan pas pelawat kenderaan yang sah serta memandu arah anda ke petak parkir pelawat di hadapan Dewan Gemilang Ilmu atau Pejabat Pentadbiran Kolej.
          </div>
</div>
<!-- FAQ 4 -->
<div class="faq-item rounded-xl bg-surface-container-lowest overflow-hidden shadow-sm transition-all">
<button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-headline font-semibold text-base text-primary" type="button">
<span>Adakah kolej ini mengenakan sebarang yuran pengajian untuk kursus TVET?</span>
<span class="material-symbols-outlined text-secondary transition-transform duration-300">expand_more</span>
</button>
<div class="faq-content hidden px-6 pb-5 pt-1 text-sm font-body text-on-surface-variant leading-relaxed">
            Tidak. Pengajian diploma di Kolej Profesional MARA Beranang adalah ditaja sepenuhnya oleh Majlis Amanah Rakyat (MARA) dengan yuran pendaftaran dan tuisyen percuma bagi warganegara Bumiputera yang layak. Selain itu, pelajar turut menerima elaun sara diri bulanan (BPT MARA) sepanjang tempoh semester aktif pengajian.
          </div>
</div>
</div>
</div>
</section>
<!-- QUICK ACTION CONTACT BANNER -->
<section class="w-full py-12 px-6 lg:px-12 bg-primary text-white">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-2xl">support_agent</span>
</div>
<div class="flex flex-col">
<h3 class="font-headline font-bold text-lg text-white">Perlukan Bantuan Segera atau Pertanyaan Akademik?</h3>
<p class="font-body text-xs text-primary-fixed-dim">Kaunter perkhidmatan pelanggan KPMB beroperasi setiap Isnin - Jumaat, 8.00 pagi - 5.00 petang.</p>
</div>
</div>
<div class="flex items-center gap-3 shrink-0">
<a class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-container-lowest/10 hover:bg-surface-container-lowest/20 text-white font-label text-xs font-bold transition-colors" href="tel:+60387668400">
<span class="material-symbols-outlined text-sm">call</span>
<span>+603-8766 8400</span>
</a>
<a class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-secondary-container text-on-secondary-container font-label text-xs font-bold hover:brightness-105 transition-all" data-path="hubungi" href="https://docs.google.com/forms/d/e/1FAIpQLSd-thl0kwWfiVEpfjqiURdFdbLApCd2bbhHsYshLPSumwudIA/viewform" target="_blank">
<span class="material-symbols-outlined text-sm">mail</span>
<span>Hubungi Meja Bantuan</span>
</a>
</div>
</div>
</section>
</div>
<!-- CLIENT MICRO-INTERACTIONS SCRIPT -->
<script>
  (function() {
    // Landing hero carousel: 3 slides, automatic and manual navigation.
    const heroTrack = document.getElementById('hero-showcase-track');
    const heroPrev = document.getElementById('hero-showcase-prev');
    const heroNext = document.getElementById('hero-showcase-next');
    const heroDots = document.querySelectorAll('.hero-showcase-dot');
    const heroWrapper = document.getElementById('hero-showcase');
    const heroTotal = heroTrack ? heroTrack.children.length : 0;
    let heroIndex = 0;
    let heroTimer = null;

    function showHeroSlide(index) {
      if (!heroTrack || heroTotal === 0) return;
      heroIndex = (index + heroTotal) % heroTotal;
      heroTrack.style.transform = `translateX(-${heroIndex * 100}%)`;

      heroDots.forEach((dot, dotIndex) => {
        dot.classList.toggle('w-7', dotIndex === heroIndex);
        dot.classList.toggle('w-2', dotIndex !== heroIndex);
        dot.classList.toggle('bg-secondary-container', dotIndex === heroIndex);
        dot.classList.toggle('bg-white/60', dotIndex !== heroIndex);
      });
    }

    function stopHeroAutoSlide() {
      if (heroTimer) {
        clearInterval(heroTimer);
        heroTimer = null;
      }
    }

    function startHeroAutoSlide() {
      stopHeroAutoSlide();
      if (heroTotal > 1) {
        heroTimer = setInterval(() => showHeroSlide(heroIndex + 1), 5000);
      }
    }

    if (heroTrack && heroPrev && heroNext) {
      heroPrev.addEventListener('click', () => {
        showHeroSlide(heroIndex - 1);
        startHeroAutoSlide();
      });

      heroNext.addEventListener('click', () => {
        showHeroSlide(heroIndex + 1);
        startHeroAutoSlide();
      });

      heroDots.forEach(dot => {
        dot.addEventListener('click', () => {
          showHeroSlide(Number(dot.dataset.heroSlide || 0));
          startHeroAutoSlide();
        });
      });

      if (heroWrapper) {
        heroWrapper.addEventListener('mouseenter', stopHeroAutoSlide);
        heroWrapper.addEventListener('mouseleave', startHeroAutoSlide);
        heroWrapper.addEventListener('focusin', stopHeroAutoSlide);
        heroWrapper.addEventListener('focusout', startHeroAutoSlide);
      }

      showHeroSlide(0);
      startHeroAutoSlide();
    }
  })();

  (function() {
    // Carousel interactive controls
    const track = document.getElementById('carousel-track');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    const dots = document.querySelectorAll('.carousel-dot');
    let currentSlide = 0;
    const totalSlides = 4;

    function updateCarousel(index) {
      currentSlide = (index + totalSlides) % totalSlides;
      if (track) {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
      }
      dots.forEach((dot, idx) => {
        if (idx === currentSlide) {
          dot.classList.remove('w-2', 'bg-surface-container-highest');
          dot.classList.add('w-8', 'bg-secondary-container');
        } else {
          dot.classList.remove('w-8', 'bg-secondary-container');
          dot.classList.add('w-2', 'bg-surface-container-highest');
        }
      });
    }

    if (prevBtn && nextBtn) {
      prevBtn.addEventListener('click', () => updateCarousel(currentSlide - 1));
      nextBtn.addEventListener('click', () => updateCarousel(currentSlide + 1));
    }

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => updateCarousel(idx));
    });

    // Auto-advance carousel smoothly
    let carouselInterval = setInterval(() => {
      updateCarousel(currentSlide + 1);
    }, 6500);

    const carouselWrapper = track?.parentElement;
    if (carouselWrapper) {
      carouselWrapper.addEventListener('mouseenter', () => clearInterval(carouselInterval));
      carouselWrapper.addEventListener('mouseleave', () => {
        carouselInterval = setInterval(() => updateCarousel(currentSlide + 1), 6500);
      });
    }

    // Interactive Accordion for FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
      const toggle = item.querySelector('.faq-toggle');
      const content = item.querySelector('.faq-content');
      const icon = toggle?.querySelector('.material-symbols-outlined');

      if (toggle && content) {
        toggle.addEventListener('click', () => {
          const isOpen = !content.classList.contains('hidden');
          // Close others
          faqItems.forEach(other => {
            other.querySelector('.faq-content')?.classList.add('hidden');
            const otherIcon = other.querySelector('.faq-toggle .material-symbols-outlined');
            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
          });

          if (!isOpen) {
            content.classList.remove('hidden');
            if (icon) icon.style.transform = 'rotate(180deg)';
          }
        });
      }
    });

    // News category filter: filter the six official KPMB news cards.
    const filterBtns = document.querySelectorAll('.tab-btn');
    const newsCards = document.querySelectorAll('.news-card');
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const category = btn.dataset.category || 'all';
        filterBtns.forEach(b => {
          b.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
          b.classList.add('text-on-surface-variant');
        });
        btn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        btn.classList.remove('text-on-surface-variant');
        newsCards.forEach(card => {
          card.classList.toggle('hidden', category !== 'all' && card.dataset.newsCategory !== category);
        });
      });
    });
  })();
</script></main><footer class="w-full bg-surface-container-low text-on-surface mt-20">
<div class="max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-12">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12 border-b border-surface-container-high">
    <div class="lg:col-span-4 flex flex-col gap-4">
      <div class="flex items-center gap-3"><img alt="Logo KPMB" class="h-8 w-auto object-contain" src="{{ asset('images/LogoKPM-1.png') }}"/><span class="font-headline font-bold text-lg text-primary">KPM Beranang, Selangor.</span></div>
      <p class="font-body text-sm text-on-surface-variant leading-relaxed">Institusi pendidikan tinggi terkemuka di bawah Majlis Amanah Rakyat (MARA), komited memperkasa kecemerlangan akademik, modal insan berintegriti, dan daya saing global dalam bidang pengajian profesional.</p>
      <div class="flex items-center gap-3 pt-2 text-on-surface-variant">
        <a aria-label="Facebook rasmi KPM Beranang" class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors font-bold" href="https://www.facebook.com/KPMBERANANGSELANGOR" target="_blank" rel="noopener noreferrer">f</a>
        <a aria-label="TikTok rasmi KPM Beranang" class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" href="https://www.tiktok.com/@kpmberanang" target="_blank" rel="noopener noreferrer"><span class="material-symbols-outlined text-[18px]">music_note</span></a>
        <a aria-label="Instagram rasmi KPM Beranang" class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" href="https://www.instagram.com/kpm_beranang/" target="_blank" rel="noopener noreferrer"><span class="material-symbols-outlined text-[18px]">photo_camera</span></a>
      </div>
    </div>
    <div class="lg:col-span-2 flex flex-col gap-3"><h3 class="font-headline font-semibold text-sm uppercase tracking-wider text-primary">Pautan Dalaman</h3>
      <ul class="flex flex-col gap-2 font-label text-sm text-on-surface-variant"><li><a class="hover:text-primary transition-colors" href="https://beranang.kpm.edu.my/" target="_blank" rel="noopener noreferrer">JKKP KPMB</a></li></ul>
    </div>
    <div class="lg:col-span-2 flex flex-col gap-3"><h3 class="font-headline font-semibold text-sm uppercase tracking-wider text-primary">Pautan Pantas</h3>
      <ul class="flex flex-col gap-2 font-label text-sm text-on-surface-variant">
        <li><a class="hover:text-primary transition-colors" href="https://www.mara.gov.my/" target="_blank" rel="noopener noreferrer">Laman Rasmi MARA</a></li>
        <li><a class="hover:text-primary transition-colors" href="https://www.mqa.gov.my/" target="_blank" rel="noopener noreferrer">Malaysian Qualifications Agency</a></li>
        <li><a class="hover:text-primary transition-colors" href="https://www.mara.gov.my/" target="_blank" rel="noopener noreferrer">MARA Quality System</a></li>
        <li><a class="hover:text-primary transition-colors" href="#panduan-pantas">FAQ</a></li>
      </ul>
    </div>
    <div class="lg:col-span-4 flex flex-col gap-3"><h3 class="font-headline font-semibold text-sm uppercase tracking-wider text-primary">Hubungi Kami</h3>
      <div class="flex flex-col gap-3 font-body text-sm text-on-surface-variant">
        <div class="flex items-start gap-2.5"><span class="material-symbols-outlined text-secondary text-[20px] shrink-0 mt-0.5">location_on</span><span>Kolej Profesional MARA Beranang,<br>Lot 2333 Jalan Kajang Seremban,<br>43700 Beranang, Selangor, Malaysia</span></div>
        <div class="flex items-start gap-2.5"><span class="material-symbols-outlined text-secondary text-[20px] shrink-0 mt-0.5">schedule</span><span>Waktu Operasi:<br>8.00 pagi–5.30 petang<br>Rehat: 1.00–2.00 petang (Isnin–Khamis)<br>12.15 tengahari–2.45 petang (Jumaat)<br>Tutup: Sabtu, Ahad &amp; Cuti Umum</span></div>
        <div class="flex items-center gap-2.5"><span class="material-symbols-outlined text-secondary text-[20px] shrink-0">call</span><span>+6 (03) 876 68935 / 36</span></div>
        <div class="flex items-center gap-2.5"><span class="material-symbols-outlined text-secondary text-[20px] shrink-0">fax</span><span>+6 (03) 876 68940</span></div>
        <div class="flex items-center gap-2.5"><span class="material-symbols-outlined text-secondary text-[20px] shrink-0">mail</span><a class="hover:text-primary transition-colors" href="mailto:info@beranang.kpm.edu.my">info@beranang.kpm.edu.my</a></div>
      </div>
      <a href="https://www.google.com/maps/search/?api=1&query=Kolej+Profesional+MARA+Beranang" target="_blank" rel="noopener noreferrer" aria-label="Lihat lokasi KPMB di Google Maps" class="block mt-1 w-full max-w-xs overflow-hidden rounded-lg border border-surface-container-high"><div class="flex items-center gap-2 bg-surface-container-high px-3 py-2 text-xs font-label text-on-surface-variant"><span class="material-symbols-outlined text-secondary text-[16px]">map</span>Lihat lokasi KPMB di Google Maps<span class="material-symbols-outlined text-[14px] ml-auto">open_in_new</span></div><div class="h-28 bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined text-4xl text-secondary">location_on</span><span class="ml-2 text-sm font-label text-on-surface-variant">Kolej Profesional MARA Beranang</span></div></a>
    </div>
  </div>
  <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 font-label text-xs text-on-surface-variant"><p>© 2025 Kolej Profesional MARA Beranang (KPMB). Hak Cipta Terpelihara MARA.</p><div class="flex items-center gap-6"><a class="hover:text-on-surface transition-colors" href="#">Dasar Privasi</a><a class="hover:text-on-surface transition-colors" href="#">Dasar Keselamatan</a><a class="hover:text-on-surface transition-colors" href="#">Penafian</a></div></div>
</div></footer><script>
(function(){
 const days=['Ahad','Isnin','Selasa','Rabu','Khamis','Jumaat','Sabtu'];
 const months=['Jan','Feb','Mac','Apr','Mei','Jun','Jul','Ogo','Sep','Okt','Nov','Dis'];
 function updateKpmbClock(){
  const now=new Date();
  const parts=new Intl.DateTimeFormat('en-GB',{timeZone:'Asia/Kuala_Lumpur',hour:'2-digit',minute:'2-digit',second:'2-digit',hourCycle:'h23',day:'2-digit',month:'2-digit',year:'numeric'}).formatToParts(now);
  const get=(type)=>parts.find(p=>p.type===type)?.value;
  const hours=Number(get('hour')), minutes=Number(get('minute')), seconds=Number(get('second'));
  const day=Number(get('day')), month=Number(get('month'))-1, year=get('year');
  const weekday=new Intl.DateTimeFormat('en-US',{timeZone:'Asia/Kuala_Lumpur',weekday:'short'}).format(now);
  const weekdayIndex=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].indexOf(weekday);
  const time=document.getElementById('kpmb-live-time'), date=document.getElementById('kpmb-live-date');
  if(time){const h=hours%12||12;time.textContent=String(h).padStart(2,'0')+':'+String(minutes).padStart(2,'0')+':'+String(seconds).padStart(2,'0')+' '+(hours>=12?'PM':'AM');}
  if(date)date.textContent=days[weekdayIndex]+', '+day+' '+months[month]+' '+year;
  const sh=document.getElementById('analog-sec-hand'), mh=document.getElementById('analog-min-hand'), hh=document.getElementById('analog-hour-hand');
  if(sh)sh.setAttribute('transform','rotate('+(seconds*6)+' 50 50)');
  if(mh)mh.setAttribute('transform','rotate('+(minutes*6+seconds*0.1)+' 50 50)');
  if(hh)hh.setAttribute('transform','rotate('+((hours%12)*30+minutes*0.5)+' 50 50)');
 }
 updateKpmbClock();setInterval(updateKpmbClock,1000);
})();
</script>
</body></html>