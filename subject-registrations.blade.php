<!DOCTYPE html><html class="light" lang="ms"><head><meta charset="utf-8"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta content="web_dashboard" name="shell-type"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"><link href="https://fonts.googleapis.com" rel="preconnect"><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{"colors":{"surface-bright":"#fcf9f8","error":"#ba1a1a","on-background":"#1c1b1b","primary":"#000a1e","on-tertiary-fixed-variant":"#43474b","on-error-container":"#93000a","surface":"#fcf9f8","surface-container-high":"#eae7e7","inverse-primary":"#aec7f6","primary-fixed":"#d6e3ff","secondary-fixed":"#ffe088","secondary-container":"#fed65b","tertiary-fixed-dim":"#c3c7cc","secondary":"#735c00","primary-fixed-dim":"#aec7f6","secondary-fixed-dim":"#e9c349","on-secondary-container":"#745c00","surface-container-low":"#f6f3f2","surface-tint":"#465f88","on-tertiary-container":"#85898e","on-tertiary-fixed":"#181c20","on-secondary-fixed":"#241a00","on-secondary":"#ffffff","on-primary-fixed":"#001b3d","tertiary-container":"#1e2226","on-error":"#ffffff","surface-container-lowest":"#ffffff","surface-variant":"#e5e2e1","inverse-on-surface":"#f3f0ef","on-primary-fixed-variant":"#2d476f","primary-container":"#002147","tertiary":"#070b0f","surface-container-highest":"#e5e2e1","on-surface":"#1c1b1b","on-tertiary":"#ffffff","on-primary-container":"#708ab5","on-secondary-fixed-variant":"#574500","error-container":"#ffdad6","on-primary":"#ffffff","outline":"#74777f","background":"#fcf9f8","surface-container":"#f0eded","surface-dim":"#dcd9d9","inverse-surface":"#313030","tertiary-fixed":"#e0e3e8","outline-variant":"#c4c6cf","on-surface-variant":"#44474e"},"borderRadius":{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},"spacing":{},"fontFamily":{"headline":["Hanken Grotesk"],"display":["Hanken Grotesk"],"body":["\"Source Serif 4\""],"label":["Hanken Grotesk"]},"fontSize":{}}}}</script>
<style>
@media print {
    @page { size: A4 landscape; margin: 12mm; }

    body {
        background: #fff !important;
        color: #111827 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    body * { visibility: hidden !important; }

    #printArea, #printArea * {
        visibility: visible !important;
    }

    #printArea {
        position: absolute !important;
        inset: 0 auto auto 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        overflow: visible !important;
        background: #fff !important;
    }

    #printArea .print-only { display: block !important; }

    #jadualPermohonan {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 10pt !important;
    }

    #jadualPermohonan thead { display: table-header-group; }
    #jadualPermohonan tr { break-inside: avoid; page-break-inside: avoid; }

    #jadualPermohonan th,
    #jadualPermohonan td {
        padding: 8px 9px !important;
        border: 1px solid #d1d5db !important;
        color: #111827 !important;
        background: #fff !important;
        white-space: normal !important;
    }

    /* Print only columns No. through Tarikh Permohonan. */
    #jadualPermohonan th:nth-child(n+7),
    #jadualPermohonan td:nth-child(n+7) {
        display: none !important;
    }

    #jadualPermohonan thead tr {
        background: #f3f4f6 !important;
    }

    .no-print { display: none !important; }
}
.print-only { display: none; }
</style>

</head><body class="bg-background font-body text-on-surface antialiased">@php
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
                ['label' => 'Skim Penilaian', 'icon' => 'fact_check', 'url' => '/upp/assessment-schemes', 'patterns' => ['upp/assessment-schemes*']],
            ],
        ],
        [
            'label' => 'PENDAFTARAN & PEMANTAUAN',
            'items' => [
                ['label' => 'Pemantauan Pendaftaran', 'icon' => 'how_to_reg', 'url' => '/upp/subject-registrations', 'patterns' => ['upp/subject-registrations*']],
                ['label' => 'Laporan Pendaftaran', 'icon' => 'summarize', 'url' => '/upp/registration-report', 'patterns' => ['upp/registration-report*']],
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

@include('upp.partials.sidebar')<div class="pl-72">@include('upp.partials.topbar')<main class="relative pt-20 bg-background min-h-screen"><div class="flex flex-col w-full px-8 py-8 space-y-6">
<!-- 1. HEADER / PAGE TITLE SECTION -->
<div class="relative overflow-hidden bg-surface-container-lowest rounded-xl border border-surface-container-high/60 shadow-[0_4px_20px_rgba(0,33,71,0.06)] p-6 transition-all duration-300 hover:shadow-[0_8px_28px_rgba(0,33,71,0.1)]">
  <div class="absolute -right-16 -top-16 w-64 h-64 bg-gradient-to-br from-primary-fixed/30 via-secondary-container/20 to-transparent rounded-full blur-3xl pointer-events-none"></div>
  <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="space-y-2">
      <div class="flex flex-wrap items-center gap-2.5">
        <div class="w-11 h-11 rounded-xl bg-primary text-secondary-fixed flex items-center justify-center shadow-sm border border-secondary-container/40 shrink-0"><span class="material-symbols-outlined text-[24px]">how_to_reg</span></div><h1 class="font-headline font-bold text-3xl text-primary tracking-tight">Laporan Pendaftaran</h1>
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-[11px] font-headline font-semibold shadow-xs">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
          </span>
          <span class="">Sistem Aktif &amp; Terhubung</span>
        </div>
      </div>
      <p class="font-body text-base text-on-surface-variant leading-relaxed max-w-3xl">
        Halaman ini digunakan oleh pihak UPP untuk menyemak dan mengurus permohonan pendaftaran subjek pelajar.
      </p>
      <div class="pt-1">
        <a class="group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-headline font-semibold text-secondary hover:text-on-secondary-container bg-secondary-container/15 hover:bg-secondary-container/30 transition-all duration-200 border border-secondary-container/40" href="{{ route('upp.dashboard') }}">
          <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:-translate-x-1">arrow_back</span>
          <span class="">Kembali ke Dashboard UPP</span>
        </a>
      </div>
    </div>
    <div class="flex items-center gap-3 shrink-0 self-start md:self-center">
      <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low/80 border border-surface-container-high/60 shadow-xs">
        <div class="w-10 h-10 rounded-lg bg-primary-container text-secondary-fixed flex items-center justify-center shadow-xs">
          <span class="material-symbols-outlined text-[22px]">assignment_turned_in</span>
        </div>
        <div class="flex flex-col pr-1">
          <span class="text-[11px] font-headline text-on-surface-variant uppercase tracking-wider font-semibold">UPP Gateway</span>
          <span class="text-xs font-headline font-bold text-primary">Sesi Akademik 2026/2027</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 2. SEARCH AND FILTER SECTION -->
<div class="bg-surface-container-lowest rounded-xl border border-surface-container-high/60 shadow-[0_2px_12px_rgba(0,33,71,0.04)] p-6 transition-all duration-300 hover:shadow-[0_4px_20px_rgba(0,33,71,0.08)]">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 mb-4 border-b border-surface-container-high gap-3">
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 rounded-lg bg-primary/5 text-primary flex items-center justify-center">
        <span class="material-symbols-outlined text-[20px]">tune</span>
      </div>
      <h2 class="font-headline font-bold text-xl text-primary tracking-tight">Carian dan Penapisan Permohonan</h2>
    </div>
    <div class="flex flex-wrap items-center gap-2">
      <button type="button" onclick="window.location.href='{{ route('upp.subject-registrations.index') }}'" class="filter-chip inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-headline font-semibold bg-surface-container text-on-surface hover:bg-surface-container-high border border-outline-variant/50 transition-all cursor-pointer" id="chip-all">
        <span class="material-symbols-outlined text-[15px]">view_list</span>
        <span class="">Jumlah: <strong class="text-primary" id="count-all">{{ $totalApplications }}</strong></span>
      </button>
      <button type="button" onclick="window.location.href='{{ route('upp.subject-registrations.index', ['status' => 'approved']) }}'" class="filter-chip inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-headline font-semibold bg-secondary-container/20 text-on-secondary-container hover:bg-secondary-container/40 border border-secondary-container/50 transition-all cursor-pointer" id="chip-approved">
        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
        <span class="">Diluluskan: <strong class="text-secondary" id="count-approved">{{ $approvedApplications }}</strong></span>
      </button>
      <button type="button" onclick="window.location.href='{{ route('upp.subject-registrations.index', ['status' => 'rejected']) }}'" class="filter-chip inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-headline font-semibold bg-error-container/30 text-on-error-container hover:bg-error-container/50 border border-error-container/60 transition-all cursor-pointer" id="chip-rejected">
        <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
        <span class="">Ditolak: <strong class="text-error" id="count-rejected">{{ $rejectedApplications }}</strong></span>
      </button>
    </div>
  </div>

  <form class="space-y-4" id="filterForm" action="{{ route('upp.subject-registrations.index') }}" method="GET">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
      <div>
        <label class="block font-headline text-xs font-semibold text-on-surface-variant mb-1.5 flex items-center justify-between" for="cariPermohonan">
          <span class="flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[15px] text-primary">search</span>
            <span class="">Cari permohonan:</span>
          </span>
          <span class="text-[11px] font-normal text-on-surface-variant/70">ID pelajar, nama, atau kod</span>
        </label>
        <div class="relative group">
          <input class="w-full h-10 pl-10 pr-3.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface placeholder:text-on-surface-variant/60 focus:outline-none focus:ring-2 focus:ring-primary/30 border border-surface-container-high focus:border-primary transition-all duration-200 shadow-inner" id="cariPermohonan" name="search" value="{{ $search ?? request('search') }}" placeholder="ID pelajar, nama pelajar, kod atau nama subjek..." type="text">
          <span class="material-symbols-outlined text-[18px] text-outline absolute left-3 top-2.5 transition-colors group-focus-within:text-primary pointer-events-none">search</span>
        </div>
      </div>
      <div>
        <label class="block font-headline text-xs font-semibold text-on-surface-variant mb-1.5 flex items-center gap-1.5" for="programmeFilter">
          <span class="material-symbols-outlined text-[15px] text-primary">school</span>
          <span>Programme:</span>
        </label>
        <select class="w-full h-10 px-3.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 border border-surface-container-high focus:border-primary transition-all cursor-pointer" id="programmeFilter" name="programme">
          <option value="">Semua Programme</option>
          @foreach($programmeOptions as $programmeOption)
            <option value="{{ $programmeOption }}" {{ ($programme ?? request('programme', '')) === $programmeOption ? 'selected' : '' }}>{{ $programmeOption }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block font-headline text-xs font-semibold text-on-surface-variant mb-1.5 flex items-center gap-1.5" for="semesterFilter">
          <span class="material-symbols-outlined text-[15px] text-primary">calendar_month</span>
          <span>Semester:</span>
        </label>
        <select class="w-full h-10 px-3.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 border border-surface-container-high focus:border-primary transition-all cursor-pointer" id="semesterFilter" name="semester">
          <option value="">Semua Semester</option>
          @foreach($semesterOptions as $semesterOption)
            <option value="{{ $semesterOption }}" {{ (string)($semester ?? request('semester', '')) === (string)$semesterOption ? 'selected' : '' }}>Semester {{ $semesterOption }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block font-headline text-xs font-semibold text-on-surface-variant mb-1.5 flex items-center gap-1.5" for="statusPermohonan">
          <span class="material-symbols-outlined text-[15px] text-primary">filter_alt</span>
          <span class="">Status permohonan:</span>
        </label>
        <div class="relative">
          <select class="w-full h-10 px-3.5 bg-surface-container-low rounded-lg text-xs font-headline text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 border border-surface-container-high focus:border-primary transition-all duration-200 cursor-pointer" id="statusPermohonan" name="status">
            <option value="" {{ ($status ?? request('status', '')) === '' ? 'selected' : '' }}>Semua Status</option>
            <option value="approved" {{ ($status ?? request('status', '')) === 'approved' ? 'selected' : '' }}>Diluluskan</option>
            <option value="rejected" {{ ($status ?? request('status', '')) === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            <option value="pending" {{ ($status ?? request('status', '')) === 'pending' ? 'selected' : '' }}>Menunggu Kelulusan</option>
          </select>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-between pt-1">
      <div class="flex items-center gap-2.5">
        <button class="h-9 px-4 rounded-lg bg-primary hover:bg-primary-container text-on-primary transition-all duration-200 font-headline text-xs font-semibold shadow-sm hover:shadow-md active:scale-95 flex items-center gap-1.5 cursor-pointer" id="submitFilterBtn" type="submit">
          <span class="material-symbols-outlined text-[16px]">filter_list</span>
          <span class="">Cari / Tapis</span>
        </button>
        <button class="h-9 px-3.5 rounded-lg text-xs font-headline font-semibold text-secondary hover:text-on-secondary-container hover:bg-secondary-container/20 transition-all duration-200 flex items-center gap-1 border border-transparent hover:border-secondary-container/30 active:scale-95 cursor-pointer" id="resetBtn" type="reset">
          <span class="material-symbols-outlined text-[16px]">restart_alt</span>
          <span class="">Reset</span>
        </button>
      </div>
      <span class="text-[11px] font-headline text-on-surface-variant/80 italic hidden sm:inline-flex items-center gap-1">
        <span class="material-symbols-outlined text-[14px] text-primary">info</span>
        <span class="">Paparan pemantauan rekod pendaftaran</span>
      </span>
    </div>
  </form>
</div>
<!-- 3. STUDENT SUBJECT REGISTRATION TABLE -->
<div class="bg-surface-container-lowest rounded-xl border border-surface-container-high/60 shadow-[0_2px_12px_rgba(0,33,71,0.04)] overflow-hidden transition-all duration-300 hover:shadow-[0_4px_20px_rgba(0,33,71,0.08)]">
  <div class="no-print flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-surface-container-high">
    <div class="flex items-center gap-2">
      <span class="material-symbols-outlined text-primary">print</span>
      <span class="font-headline text-sm font-semibold text-primary">Cetakan Senarai Permohonan</span>
      <span class="text-xs text-on-surface-variant">Kolum No. hingga Tarikh Permohonan sahaja, termasuk Programme</span>
    </div>
    <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-xs font-headline font-semibold text-white shadow-sm hover:bg-primary-container transition">
      <span class="material-symbols-outlined text-[17px]">print</span>
      <span>Cetak Senarai</span>
    </button>
  </div>
  <div id="printArea" class="overflow-x-auto">
    <div class="print-only px-4 pb-4">
      <h1 class="text-xl font-bold text-primary">Laporan Pendaftaran Subjek</h1>
      <p class="mt-1 text-xs text-slate-600">Senarai permohonan pendaftaran subjek pelajar</p>
      <p class="mt-1 text-xs text-slate-600">Tarikh cetakan: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    <table class="w-full text-left border-collapse" id="jadualPermohonan">
      <thead>
        <tr class="bg-surface-container text-on-surface-variant font-headline text-xs uppercase tracking-wider font-semibold border-b border-surface-container-high">
          <th class="py-3.5 px-4">No.</th>
          <th class="py-3.5 px-4">ID Pelajar</th>
          <th class="py-3.5 px-4">Nama Pelajar</th>
          <th class="py-3.5 px-4">Programme</th>
          <th class="py-3.5 px-4">Semester</th>
          <th class="py-3.5 px-4 text-center">Subjek</th>
          <th class="py-3.5 px-4">Tarikh Permohonan</th>
          <th class="py-3.5 px-4">Status</th>
          <th class="py-3.5 px-4">Catatan</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-surface-container font-headline text-xs text-on-surface">
        @forelse ($applications as $application)
          @php
            $statusLabel = match ($application->application_status) {
              'approved' => 'Diluluskan',
              'rejected' => 'Ditolak',
              default => 'Menunggu Kelulusan',
            };
            $statusClass = match ($application->application_status) {
              'approved' => 'bg-secondary-container text-on-secondary-container border-secondary/20',
              'rejected' => 'bg-error-container text-on-error-container border-error/20',
              default => 'bg-amber-50 text-amber-800 border-amber-200',
            };
          @endphp
          <tr class="group hover:bg-surface-container-low/80 transition-all duration-150 border-l-2 border-l-transparent hover:border-l-secondary">
            <td class="py-3.5 px-4 font-semibold text-on-surface-variant">{{ $applications->firstItem() + $loop->index }}</td>
            <td class="py-3.5 px-4 font-mono font-medium text-primary-container">{{ $application->student_id }}</td>
            <td class="py-3.5 px-4 font-semibold text-primary">{{ $application->student->student_name ?? 'Tidak tersedia' }}</td>
            <td class="py-3.5 px-4 whitespace-nowrap">{{ $application->student->programme ?? '—' }}</td>
            <td class="py-3.5 px-4 text-center font-bold text-primary">{{ $application->semester }}</td>
            <td class="py-3.5 px-4 text-center"><span class="inline-flex rounded-full bg-surface-container px-2.5 py-1 font-semibold">{{ $application->registrations->count() }} subjek</span></td>
            <td class="py-3.5 px-4 text-on-surface-variant">{{ $application->submitted_at?->format('d/m/Y') ?? '—' }}</td>
            <td class="py-3.5 px-4 whitespace-nowrap"><span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold border {{ $statusClass }}"><span class="w-1.5 h-1.5 rounded-full bg-current"></span>{{ $statusLabel }}</span></td>
            <td class="py-3.5 px-4 whitespace-nowrap">
              <a href="{{ route('upp.subject-registrations.show', $application->application_id) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-primary px-3 py-2 text-[11px] font-semibold text-white hover:bg-primary-container transition">
                <span class="material-symbols-outlined text-[15px]">visibility</span>
                <span>View Application</span>
              </a>
            </td>
          </tr>
        @empty
          <tr><td colspan="9" class="px-6 py-12 text-center"><div class="flex flex-col items-center gap-2 text-on-surface-variant"><span class="material-symbols-outlined text-4xl">inbox</span><span class="font-headline font-semibold text-sm">Tiada permohonan ditemui</span><span class="text-xs">Cuba ubah carian atau penapis status.</span></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  </div>
  <!-- Table Footer Summary -->
  <div class="no-print px-4 py-3 bg-surface-container-low/60 border-t border-surface-container-high flex flex-col sm:flex-row items-center justify-between text-xs font-headline text-on-surface-variant gap-2">
    <div class="flex items-center gap-2">
      <span class="material-symbols-outlined text-[16px] text-secondary">shield</span>
      <span class="">Paparan pemantauan sahaja. Kelulusan dan penolakan permohonan diuruskan oleh Mentor.</span>
    </div>
    <div class="font-mono text-[11px] text-on-surface-variant/80">
      Jumlah permohonan dipaparkan: <span id="displayedCount" class="font-bold text-primary">{{ $applications->count() }}</span> / {{ $totalApplications }} rekod
    </div>
  </div>
</div>
<script>
  document.getElementById('resetBtn')?.addEventListener('click', function () {
    window.location.href = @json(route('upp.subject-registrations.index'));
  });
</script>
</div></main><footer class="w-full bg-surface-container-low py-10 shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="w-full px-8 max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6"><div class="flex flex-col gap-1 text-center md:text-left"><div class="flex items-center justify-center md:justify-start gap-2"><span class="font-headline font-bold text-sm text-primary">RegisCert Academic Collegiate Registry</span><span class="text-xs text-on-surface-variant">•</span><span class="text-xs font-headline font-medium text-on-surface-variant">Unit Peperiksaan dan Persijilan (UPP)</span></div><p class="font-body text-xs text-on-surface-variant">© 2026 Unit Peperiksaan &amp; Persijilan. Hak Cipta Terpelihara.</p></div><div class="flex flex-wrap items-center justify-center gap-4 text-xs font-headline text-on-surface-variant"><a class="hover:text-primary transition-colors" href="#">Peraturan Akademik</a><span class="text-outline-variant">•</span><a class="hover:text-primary transition-colors" href="#">Dashboard UPP</a><span class="text-outline-variant">•</span><a class="hover:text-primary transition-colors" href="#">Bantuan Sistem</a></div></div></footer></div>



</body></html>