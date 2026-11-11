<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {theme:{extend:{colors:{
            primary:"#000a1e","primary-container":"#002147","secondary":"#735c00",
            "secondary-container":"#fed65b","surface":"#fcf9f8",
            "surface-container-low":"#f6f3f2","surface-container-high":"#eae7e7",
            "on-surface-variant":"#44474e","error-container":"#ffdad6"
        },fontFamily:{headline:["Hanken Grotesk"],body:["Source Serif 4"],label:["Hanken Grotesk"]}}}};
    </script>
    <style>
        body{font-family:"Source Serif 4",serif}
        .font-label,.font-headline{font-family:"Hanken Grotesk",sans-serif}
        @media(prefers-reduced-motion:no-preference){.ambient{animation:float 18s ease-in-out infinite alternate}@keyframes float{to{transform:translate(-18px,16px) scale(1.04)}}}
    </style>
</head>
<body class="min-h-screen bg-surface text-slate-800">
@php
    $userName = auth()->user()->name ?? 'Pegawai UPP';
    $displaySession = $currentAcademicSession ?? 'Pengurusan akademik';
    $uppSidebarGroups = [
        ['label'=>'PENGURUSAN UTAMA','items'=>[
            ['label'=>'Dashboard UPP','icon'=>'dashboard','url'=>'/upp/dashboard','patterns'=>['upp/dashboard']],
        ]],
        ['label'=>'PENGURUSAN PELAJAR & PENSYARAH','items'=>[
            ['label'=>'Pengurusan Pelajar','icon'=>'groups','url'=>'/upp/students','patterns'=>['upp/students*']],
            ['label'=>'Pengurusan Pensyarah','icon'=>'badge','url'=>'/upp/lecturers','patterns'=>['upp/lecturers*']],
        ]],
        ['label'=>'PENGURUSAN AKADEMIK','items'=>[
            ['label'=>'Pengurusan Subjek','icon'=>'menu_book','url'=>'/upp/subjects','patterns'=>['upp/subjects*']],
            ['label'=>'Pengurusan Kelas','icon'=>'meeting_room','url'=>'/upp/classes','patterns'=>['upp/classes*']],
            ['label'=>'Skim Penilaian','icon'=>'fact_check','url'=>'/upp/assessment-schemes','patterns'=>['upp/assessment-schemes*']],
        ]],
        ['label'=>'PENDAFTARAN & PEMANTAUAN','items'=>[
            ['label'=>'Pemantauan Pendaftaran','icon'=>'how_to_reg','url'=>'/upp/subject-registrations','patterns'=>['upp/subject-registrations*']],
            ['label'=>'Laporan Pendaftaran','icon'=>'summarize','url'=>'/upp/registration-report','patterns'=>['upp/registration-report*']],
        ]],
        ['label'=>'KEPUTUSAN & LAPORAN','items'=>[
            ['label'=>'Laporan Keputusan','icon'=>'analytics','url'=>'/upp/result-report','patterns'=>['upp/result-report*']],
        ]],
    ];
@endphp
@include('upp.partials.sidebar')
<div class="min-h-screen pl-72 flex flex-col">
    @include('upp.partials.topbar')
    <main class="flex-1 bg-surface px-8 pb-12 pt-24">
        <div class="mx-auto max-w-7xl space-y-6">
            @if(session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-xl border border-red-200 bg-error-container px-4 py-3 text-sm text-red-900">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-error-container px-4 py-3 text-sm text-red-900">
                    <strong>Sila semak maklumat yang dimasukkan.</strong>
                    <ul class="ml-5 mt-1 list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <section class="relative overflow-hidden rounded-2xl bg-white p-7 shadow-sm">
                <div class="ambient pointer-events-none absolute -right-12 -top-24 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>
                <div class="relative flex flex-col justify-between gap-5 md:flex-row md:items-center">
                    <div>
                        <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-[11px] font-label font-bold uppercase tracking-wider text-amber-800">
                            <span class="h-2 w-2 rounded-full bg-amber-600"></span> UPP Academic Registry
                        </div>
                        <h1 class="font-headline text-3xl font-bold tracking-tight text-primary">Pengurusan Kelas</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-on-surface-variant">Urus kumpulan kelas mengikut programme, semester dan sesi akademik.</p>
                    </div>
                    <div class="rounded-xl bg-primary px-5 py-4 text-white shadow-sm">
                        <div class="text-xs text-white/70">Jumlah kumpulan dipaparkan</div>
                        <div class="font-headline text-3xl font-bold">{{ $groups->total() }}</div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-sm xl:col-span-1">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="material-symbols-outlined rounded-xl bg-amber-100 p-2 text-amber-800">add_home_work</span>
                        <div>
                            <h2 class="font-headline text-lg font-bold text-primary">Tambah Class Group</h2>
                            <p class="text-xs text-on-surface-variant">Daftarkan kumpulan baharu</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('upp.classes.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="mb-1 block text-xs font-label font-semibold">Nama kumpulan</label>
                            <input name="group_name" value="{{ old('group_name') }}" required maxlength="50" placeholder="Contoh: DBS 2A" class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-label font-semibold">Programme</label>
                            <select name="programme_id" required class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                                <option value="">Pilih programme</option>
                                @foreach($programmes as $programme)
                                    <option value="{{ $programme->programme_id }}" @selected(old('programme_id') == $programme->programme_id)>{{ $programme->programme_code }} — {{ $programme->programme_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-label font-semibold">Semester</label>
                            <select name="semester" required class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                                <option value="">Pilih semester</option>
                                @for($semester=1;$semester<=8;$semester++)
                                    <option value="{{ $semester }}" @selected(old('semester') == $semester)>Semester {{ $semester }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-label font-semibold">Sesi akademik</label>
                            <input name="academic_session" value="{{ old('academic_session') }}" required maxlength="20" placeholder="Contoh: 2 2026/2027" class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                        </div>
                        <button class="flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-4 py-3 font-label text-sm font-semibold text-white transition hover:bg-primary-container">
                            <span class="material-symbols-outlined text-lg">add</span> Simpan Class Group
                        </button>
                    </form>
                    <p class="mt-4 rounded-lg bg-amber-50 p-3 text-xs leading-relaxed text-amber-900">Nama kumpulan perlu unik dalam sesi akademik yang sama. Kumpulan yang sudah mempunyai pelajar atau kelas tidak boleh dipadam.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm xl:col-span-2">
                    <div class="mb-5">
                        <h2 class="font-headline text-lg font-bold text-primary">Senarai Class Group</h2>
                        <p class="text-xs text-on-surface-variant">Tapis rekod mengikut programme, semester dan sesi akademik.</p>
                    </div>
                    <form method="GET" action="{{ route('upp.classes.index') }}" class="mb-5 grid grid-cols-1 gap-3 md:grid-cols-4">
                        <select name="programme_id" class="rounded-lg border-slate-300 text-sm">
                            <option value="">Semua programme</option>
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->programme_id }}" @selected(($filters['programme_id'] ?? '') == $programme->programme_id)>{{ $programme->programme_code }}</option>
                            @endforeach
                        </select>
                        <select name="semester" class="rounded-lg border-slate-300 text-sm">
                            <option value="">Semua semester</option>
                            @for($semester=1;$semester<=8;$semester++)
                                <option value="{{ $semester }}" @selected(($filters['semester'] ?? '') == $semester)>Semester {{ $semester }}</option>
                            @endfor
                        </select>
                        <select name="academic_session" class="rounded-lg border-slate-300 text-sm">
                            <option value="">Semua sesi</option>
                            @foreach($academicSessions as $session)
                                <option value="{{ $session }}" @selected(($filters['academic_session'] ?? '') == $session)>{{ $session }}</option>
                            @endforeach
                        </select>
                        <div class="flex gap-2">
                            <button class="flex-1 rounded-lg bg-primary px-3 py-2 font-label text-xs font-semibold text-white">Tapis</button>
                            <a href="{{ route('upp.classes.index') }}" class="rounded-lg border border-slate-300 px-3 py-2 font-label text-xs font-semibold text-slate-600">Reset</a>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[650px] text-left text-sm">
                            <thead class="border-b border-slate-200 bg-surface-container-low text-[11px] font-label uppercase tracking-wider text-slate-600">
                                <tr><th class="px-3 py-3">Kumpulan</th><th class="px-3 py-3">Programme</th><th class="px-3 py-3">Semester</th><th class="px-3 py-3">Sesi</th><th class="px-3 py-3">Rekod</th><th class="px-3 py-3 text-right">Tindakan</th></tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($groups as $group)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-3 py-4"><div class="font-label font-bold text-primary">{{ $group->group_name }}</div><div class="text-[11px] text-slate-500">ID: {{ $group->group_id }}</div></td>
                                        <td class="px-3 py-4"><div class="font-semibold">{{ $group->programme?->programme_code ?? '—' }}</div><div class="max-w-[180px] text-xs text-slate-500">{{ $group->programme?->programme_name ?? 'Programme tidak tersedia' }}</div></td>
                                        <td class="px-3 py-4">Semester {{ $group->semester }}</td>
                                        <td class="px-3 py-4">{{ $group->academic_session }}</td>
                                        <td class="px-3 py-4"><div class="text-xs">{{ $group->students_count }} pelajar</div></td>
                                        <td class="px-3 py-4 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('upp.classes.show', $group->group_id) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-label text-xs font-semibold text-primary transition hover:bg-slate-100">View</a>
                                                <form method="POST" action="{{ route('upp.classes.destroy', $group->group_id) }}" onsubmit="return confirm('Padam class group ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="rounded-lg border border-red-200 px-3 py-2 font-label text-xs font-semibold text-red-700 transition hover:bg-red-50">Padam</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-4 py-12 text-center"><span class="material-symbols-outlined text-4xl text-slate-300">meeting_room</span><p class="mt-2 font-label font-semibold text-slate-600">Tiada class group dijumpai</p><p class="text-xs text-slate-400">Tambah kumpulan baharu atau ubah tapisan.</p></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $groups->links() }}</div>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>
