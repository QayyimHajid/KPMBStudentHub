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


<meta charset="utf-8"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta content="web_standard" name="shell-type"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"><link href="https://fonts.googleapis.com" rel="preconnect"><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"><link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@500;600;700;800&amp;family=IBM+Plex+Sans:wght@500;600;700&amp;family=Work+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">tailwind.config={"darkMode":"class","theme":{"extend":{"colors":{"on-error-container":"#93000a","surface-dim":"#dcd9d9","inverse-surface":"#313030","on-error":"#ffffff","surface":"#fcf9f8","inverse-primary":"#aec7f6","primary":"#000a1e","on-tertiary":"#ffffff","on-tertiary-container":"#85898e","surface-container-high":"#eae7e7","error-container":"#ffdad6","tertiary-fixed-dim":"#c3c7cc","error":"#ba1a1a","surface-container":"#f0eded","on-primary-fixed-variant":"#2d476f","outline-variant":"#c4c6cf","tertiary":"#070b0f","on-primary":"#ffffff","surface-bright":"#fcf9f8","primary-container":"#002147","on-tertiary-fixed-variant":"#43474b","on-primary-fixed":"#001b3d","tertiary-container":"#1e2226","outline":"#74777f","on-secondary":"#ffffff","on-secondary-container":"#745c00","surface-container-highest":"#e5e2e1","on-secondary-fixed-variant":"#574500","background":"#fcf9f8","surface-tint":"#465f88","primary-fixed":"#d6e3ff","surface-variant":"#e5e2e1","surface-container-lowest":"#ffffff","on-primary-container":"#708ab5","on-background":"#1c1b1b","tertiary-fixed":"#e0e3e8","secondary-fixed-dim":"#e9c349","secondary-fixed":"#ffe088","secondary-container":"#fed65b","secondary":"#735c00","on-surface":"#1c1b1b","on-tertiary-fixed":"#181c20","surface-container-low":"#f6f3f2","on-secondary-fixed":"#241a00","primary-fixed-dim":"#aec7f6","on-surface-variant":"#44474e","inverse-on-surface":"#f3f0ef"},"borderRadius":{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},"spacing":{},"fontFamily":{"headline":["Hanken Grotesk"],"display":["Hanken Grotesk"],"body":["Work Sans","sans-serif"],"label":["Hanken Grotesk"]},"fontSize":{}}}}</script></head><body class="bg-surface font-body text-on-surface antialiased">@include('student.partials.sidebar')<div class="student-page-shell">
@include('student.partials.topbar')<main class="w-full pt-0 bg-surface min-h-[calc(100vh-140px)]">
@if(($registrationState ?? '') === 'alternative_assignment_pending')
<div class="mx-6 mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">{{ $stateMessage }}</div>
@endif
<div class="flex flex-col w-full">
@if (session('success'))
<div class="mx-6 mt-4 lg:mx-10 rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
@endif
@if (session('error'))
<div class="mx-6 mt-4 lg:mx-10 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="mx-6 mt-4 lg:mx-10 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-800"><ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<!-- Subject Registration Page Content -->
<section class="relative w-full px-6 lg:px-10 pt-8 pb-7 bg-surface-container-lowest border-b border-surface-container-high overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#002147 1px, transparent 1px), radial-gradient(#002147 1px, #ffffff 1px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-primary via-primary-container to-secondary"></div>
    <div class="relative max-w-[1280px] mx-auto flex flex-col gap-5">
        <div class="flex flex-wrap items-center justify-between gap-3 text-xs font-label text-on-surface-variant">
            <div class="flex items-center gap-2 tracking-wide font-medium"><span>Portal Akademik KPMB</span><span class="material-symbols-outlined text-xs text-outline-variant">chevron_right</span><span>Semester {{ $upcomingSemester }}</span><span class="material-symbols-outlined text-xs text-outline-variant">chevron_right</span><span class="text-primary font-bold">Pengesahan Subjek Pratetap</span></div>
            <span class="inline-flex items-center gap-1 text-[11px] font-label font-bold text-secondary px-2.5 py-1 rounded bg-secondary-container/30 border border-secondary/30"><span class="material-symbols-outlined text-[13px]">assignment_turned_in</span>Pendaftaran Subjek</span>
        </div>
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2.5 mb-1"><span class="text-[11px] font-label font-bold tracking-widest uppercase px-2.5 py-0.5 bg-primary text-on-primary rounded">{{ $student->programme ?? 'Program belum ditetapkan' }}</span><span class="text-xs font-label uppercase tracking-wider text-outline font-semibold">Struktur Program Pengajian</span></div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-headline font-bold text-primary tracking-tight">Pendaftaran Subjek Semester {{ $upcomingSemester }}</h1>
                <p class="text-sm text-on-surface-variant">Semua subjek wajib dipaparkan secara automatik. Semak senarai sebelum mengesahkan pendaftaran.</p>
            </div>
            <div class="flex items-center gap-2 shrink-0"><span class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-label font-bold text-primary bg-surface-container-low border border-surface-container-high rounded"><span class="material-symbols-outlined text-[17px]">school</span>Semester semasa: {{ $student->semester ?? '-' }}</span></div>
        </div>
        <div class="flex items-start gap-3 px-4 py-3 bg-primary-container/5 border-l-4 border-primary rounded-r text-xs text-on-surface"><div class="w-8 h-8 rounded-full bg-primary-container text-on-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-[18px]">info</span></div><p><strong class="text-primary">Makluman:</strong> Sistem menetapkan subjek wajib berdasarkan programme structure anda. Anda tidak perlu memilih subjek atau kelas. Maklumat pensyarah dan jadual waktu akan disediakan kemudian apabila ditetapkan oleh pihak kolej.</p></div>
        @if ($nextClassGroup)
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 rounded-lg border border-emerald-200 bg-emerald-50/80 px-4 py-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-700 text-white flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-xl">groups</span></div>
                    <div>
                        <span class="block text-[10px] font-label font-bold uppercase tracking-wider text-emerald-800">Kumpulan Kelas Semester Seterusnya</span>
                        <span class="block text-lg font-headline font-bold text-primary">{{ $nextClassGroup->group_name }}</span>
                        <span class="block text-[11px] text-on-surface-variant">Semester {{ $upcomingSemester }} · Dipadankan secara automatik berdasarkan kumpulan semasa</span>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 self-start sm:self-center rounded-full border border-emerald-300 bg-white px-3 py-1.5 text-[11px] font-label font-bold text-emerald-800"><span class="material-symbols-outlined text-sm">check_circle</span>Dipadankan</span>
            </div>
        @endif
    </div>
</section>

<section class="w-full px-6 lg:px-10 py-5 bg-surface-container-lowest border-b border-surface-container-high">
    <div class="max-w-[1280px] mx-auto grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 rounded-lg bg-surface-container-low border border-surface-container-high flex items-center gap-4"><div class="w-12 h-12 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-2xl">library_books</span></div><div><span class="text-[11px] font-label font-semibold text-outline uppercase tracking-wider">Subjek Wajib</span><div class="text-xl font-headline font-bold text-primary">{{ $requiredSubjectIds->count() }}</div><span class="text-[11px] text-on-surface-variant">Semester {{ $upcomingSemester }}</span></div></div>
        <div class="p-4 rounded-lg bg-surface-container-low border border-surface-container-high flex items-center gap-4"><div class="w-12 h-12 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-2xl">credit_score</span></div><div><span class="text-[11px] font-label font-semibold text-outline uppercase tracking-wider">Jumlah Jam Kredit</span><div class="text-xl font-headline font-bold text-primary">{{ $classes->unique('subject_id')->sum(fn ($class) => (int) ($class->subject->credit_hour ?? 0)) }}</div><span class="text-[11px] text-on-surface-variant">Berdasarkan subjek tersedia</span></div></div>
        <div class="p-4 rounded-lg bg-surface-container-low border border-surface-container-high flex items-center gap-4"><div class="w-12 h-12 rounded-lg bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-2xl">fact_check</span></div><div><span class="text-[11px] font-label font-semibold text-outline uppercase tracking-wider">Status Pendaftaran</span><div class="text-base font-headline font-bold text-primary">@if($registrationState === 'already_registered')Telah Didaftarkan @elseif($registrationState === 'available')Menunggu Pengesahan @elseTidak Tersedia @endif</div><span class="text-[11px] text-on-surface-variant">Pengesahan sekali sahaja</span></div></div>
    </div>
</section>

<section class="w-full px-6 lg:px-10 py-8">
    <div class="max-w-[1280px] mx-auto flex flex-col gap-6">
        @if ($registrationState !== 'available' && $registrationState !== 'already_registered' && $registrationState !== 'industrial_training')
            <div class="flex items-start gap-3 rounded-lg border {{ $registrationState === 'final_semester' ? 'border-emerald-300 bg-emerald-50 text-emerald-900' : 'border-amber-300 bg-amber-50 text-amber-900' }} px-5 py-4">
                <span class="material-symbols-outlined text-2xl">{{ $registrationState === 'final_semester' ? 'check_circle' : 'info' }}</span>
                <div><h2 class="font-headline font-bold">{{ $registrationState === 'final_semester' ? 'Pendaftaran Subjek Tidak Diperlukan' : 'Pendaftaran Belum Tersedia' }}</h2><p class="mt-1 text-sm">{{ $stateMessage }}</p></div>
            </div>
        @elseif ($registrationState === 'already_registered')
            <div class="flex items-start gap-3 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-900 px-5 py-4"><span class="material-symbols-outlined text-2xl">check_circle</span><div><h2 class="font-headline font-bold">Pendaftaran Telah Direkodkan</h2><p class="mt-1 text-sm">{{ $stateMessage }}</p></div></div>
        @elseif ($registrationState === 'industrial_training')
            <div class="flex items-start gap-3 rounded-lg border border-blue-300 bg-blue-50 text-blue-900 px-5 py-4">
                <span class="material-symbols-outlined text-2xl">school</span>

                <div>
                    <h2 class="font-headline font-bold">Latihan Industri (LI)</h2>

                    <p class="mt-1 text-sm">{{ $stateMessage }}</p>

                    <p class="mt-2 text-sm font-semibold">
                        Semester LI: {{ $industrialTrainingSemester }}
                    </p>
                </div>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3"><div><h2 class="text-xl font-headline font-bold text-primary">Senarai Subjek Wajib</h2><p class="text-xs text-on-surface-variant mt-1">Senarai ini dijana berdasarkan programme structure dan semester pendaftaran anda.</p></div><button class="px-3.5 py-2 text-xs font-label font-semibold bg-surface-container hover:bg-surface-container-high text-primary rounded transition-colors flex items-center gap-1.5" onclick="window.print()" type="button"><span class="material-symbols-outlined text-base">print</span>Cetak Senarai</button></div>

        <div class="w-full overflow-hidden bg-surface-container-lowest border border-surface-container-high rounded-lg shadow-sm"><div class="overflow-x-auto"><table class="w-full text-left text-xs font-body divide-y divide-surface-container-high"><thead><tr class="bg-surface-container-low text-on-surface-variant font-label uppercase text-[10px] tracking-wider"><th class="py-3.5 px-4 font-bold text-primary">Bil.</th><th class="py-3.5 px-4 font-bold text-primary min-w-[270px]">Kod &amp; Nama Subjek</th><th class="py-3.5 px-3 font-bold text-center text-primary">Kategori</th><th class="py-3.5 px-3 font-bold text-center text-primary">Jam Kredit</th><th class="py-3.5 px-4 font-bold text-primary">Semester</th><th class="py-3.5 px-4 font-bold text-center text-primary">Status</th></tr></thead><tbody class="divide-y divide-surface-container-high">
            @forelse ($classes as $class)
                @php
                    $subject = $class->subject;
                    $registration = $registrations->get($class->subject_id);
                    $category = $subject->subject_category ?? $subject->category ?? $subject->subject_type ?? 'Belum ditetapkan';
                @endphp
                <tr class="hover:bg-surface-container-low/70 transition-colors border-l-4 {{ $registration ? 'border-emerald-600' : 'border-primary' }}"><td class="py-4 px-4 align-top font-headline font-bold text-primary">{{ $loop->iteration }}</td><td class="py-4 px-4 align-top"><div class="flex flex-col gap-1"><span class="font-headline font-bold text-primary text-sm">{{ $subject->subject_code ?? 'Tiada kod' }}</span><span class="font-headline font-semibold text-on-surface text-[13px]">{{ $subject->subject_name ?? 'Nama subjek belum ditetapkan' }}</span><span class="text-[11px] text-on-surface-variant">Maklumat kelas dan pensyarah akan ditetapkan kemudian.</span></div></td><td class="py-4 px-3 text-center align-top"><span class="inline-block px-2 py-1 rounded text-[10px] font-label font-bold bg-primary-container text-on-primary">{{ $category }}</span></td><td class="py-4 px-3 text-center align-top"><span class="inline-flex items-center justify-center min-w-10 p-2 rounded bg-surface-container-low border border-surface-container font-headline font-extrabold text-primary">{{ (int) ($subject->credit_hour ?? 0) }}</span></td><td class="py-4 px-4 align-top text-on-surface">Semester {{ $upcomingSemester }}</td><td class="py-4 px-4 text-center align-top">@if ($registration)<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-label font-bold bg-emerald-100 text-emerald-800 border border-emerald-300"><span class="material-symbols-outlined text-sm">check_circle</span>{{ ucfirst($registration->registration_status ?? 'pending') }}</span>@else<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-label font-bold bg-surface-container text-on-surface-variant border border-outline-variant"><span class="material-symbols-outlined text-sm">pending</span>Belum dihantar</span>@endif</td></tr>
            @empty
                <tr><td colspan="6" class="py-12 px-6 text-center"><span class="material-symbols-outlined text-4xl text-outline-variant">event_busy</span><p class="mt-3 font-headline font-bold text-primary">Tiada subjek untuk dipaparkan</p><p class="mt-1 text-sm text-on-surface-variant">Semak status pendaftaran di atas atau hubungi pihak pentadbiran akademik.</p></td></tr>
            @endforelse
        </tbody></table></div></div>

        @if ($registrationState === 'available' && $classes->isNotEmpty())
            <form method="POST" action="{{ route('student.subject-registration.store') }}" onsubmit="return window.confirm('Sahkan pendaftaran untuk semua {{ $requiredSubjectIds->count() }} subjek wajib Semester {{ $upcomingSemester }}?')">
                @csrf
                <div class="w-full bg-emerald-50/70 border-l-4 border-emerald-600 p-4 sm:px-6 sm:py-4 rounded-r flex flex-col md:flex-row md:items-center justify-between gap-4 border border-emerald-200"><div class="flex items-center gap-3.5"><div class="w-10 h-10 rounded-full bg-emerald-700 text-white flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-2xl">event_available</span></div><div><h3 class="font-headline font-bold text-primary text-sm sm:text-base">Semakan Sebelum Pengesahan</h3><p class="text-xs text-on-surface-variant mt-1">Dengan menekan butang pengesahan, semua subjek wajib yang dipaparkan akan dihantar untuk kelulusan. Anda tidak perlu memilih subjek secara individu.</p></div></div><button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded text-xs font-label font-bold text-on-primary bg-primary hover:bg-primary-container transition-colors shrink-0"><span class="material-symbols-outlined text-base">how_to_reg</span>Confirm Subject Registration</button></div>
            </form>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-1"><div class="border-l-2 border-primary pl-4 py-1 text-xs text-on-surface-variant"><div class="flex items-center gap-1.5 mb-1"><span class="material-symbols-outlined text-base text-primary">rule</span><span class="font-label font-bold text-primary uppercase tracking-wide text-[11px]">Dasar Pendaftaran Subjek</span></div><p class="leading-relaxed">Subjek wajib ditentukan berdasarkan programme structure pelajar. Pendaftaran dihantar untuk semakan dan kelulusan.</p></div><div class="border-l-2 border-secondary pl-4 py-1 text-xs text-on-surface-variant"><div class="flex items-center gap-1.5 mb-1"><span class="material-symbols-outlined text-base text-secondary">calendar_month</span><span class="font-label font-bold text-primary uppercase tracking-wide text-[11px]">Jadual Kuliah</span></div><p class="leading-relaxed">Maklumat kelas, pensyarah dan jadual waktu akan dipaparkan melalui bahagian berkaitan selepas ditetapkan oleh pihak kolej.</p></div></div>
    </div>
</section>
<section class="sticky bottom-0 left-0 w-full bg-surface-container-lowest/95 backdrop-blur-md border-t-2 border-primary shadow-[0_-6px_20px_rgba(0,10,30,0.08)] z-40 py-4 px-6 lg:px-10"><div class="max-w-[1280px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-3"><div class="flex items-center gap-3"><span class="material-symbols-outlined text-2xl text-secondary">info</span><div class="flex flex-col"><span class="font-headline font-bold text-primary text-sm">Pendaftaran Subjek</span><span class="text-xs text-on-surface-variant">Sahkan semua subjek wajib melalui satu tindakan.</span></div></div><a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-label font-bold text-primary border border-outline-variant rounded hover:bg-surface-container-low transition-colors"><span class="material-symbols-outlined text-base">dashboard</span>Papan Pemuka</a></div></section>
</div>
</main><footer class="w-full bg-surface-container-low border-t border-surface-container-high mt-auto py-10"><div class="w-full px-6 lg:px-10 flex flex-col gap-6 max-w-[1280px] mx-auto"><div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-surface-container-high"><div class="flex flex-col sm:flex-row items-center gap-3 text-center sm:text-left"><span class="text-xs font-headline font-bold text-primary uppercase tracking-wider">Kolej Profesional MARA Beranang</span><span class="hidden sm:inline text-outline-variant">•</span><span class="text-xs text-on-surface-variant font-body">Lot 2333, Jalan Kajang-Seremban, 43700 Beranang, Selangor Darul Ehsan</span></div><div class="flex items-center gap-2 text-xs font-label text-primary font-semibold"><span class="material-symbols-outlined text-[18px] text-secondary">phone_in_talk</span><span class="">Talian Meja Bantuan Akademik: 03-8921 5111 / 5000</span></div></div><div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-on-surface-variant font-body"><p class="">© 2025 Bahagian Pendidikan Tinggi MARA. Hak Cipta Terpelihara.</p><div class="flex items-center gap-6"><a class="hover:text-primary transition-colors" href="{{ route('student.dashboard') }}">Polisi Privasi</a><a class="hover:text-primary transition-colors" href="{{ route('student.dashboard') }}">Meja Bantuan ICT KPMB</a><a class="hover:text-primary transition-colors" href="{{ route('student.dashboard') }}">Hal Ehwal Pelajar (HEP)</a><a class="hover:text-primary transition-colors" href="{{ route('student.dashboard') }}">Garis Panduan Senat MARA</a></div></div></div></footer>


</div></body></html>