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
    </style>
</head>
<body class="min-h-screen bg-surface text-slate-800">
@php
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
            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-error-container px-4 py-3 text-sm text-red-900">
                    <strong>Sila semak maklumat yang dimasukkan.</strong>
                    <ul class="ml-5 mt-1 list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <a href="{{ route('upp.classes.index') }}" class="mb-3 inline-flex items-center gap-1 text-xs font-label font-semibold text-slate-500 hover:text-primary">
                        <span class="material-symbols-outlined text-base">arrow_back</span> Kembali ke Pengurusan Kelas
                    </a>
                    <h1 class="font-headline text-3xl font-bold tracking-tight text-primary">{{ $group->group_name }}</h1>
                    <p class="mt-1 text-sm text-on-surface-variant">Maklumat kumpulan dan senarai pelajar.</p>
                </div>
                <div class="rounded-xl bg-primary px-5 py-4 text-white shadow-sm">
                    <div class="text-xs text-white/70">Jumlah pelajar</div>
                    <div class="font-headline text-3xl font-bold">{{ $group->students_count }}</div>
                </div>
            </div>

            <section class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-3">
                    <span class="material-symbols-outlined rounded-xl bg-amber-100 p-2 text-amber-800">edit_note</span>
                    <div>
                        <h2 class="font-headline text-lg font-bold text-primary">Maklumat Class Group</h2>
                        <p class="text-xs text-on-surface-variant">Kemaskini maklumat kumpulan kelas.</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('upp.classes.update', $group->group_id) }}" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1 block text-xs font-label font-semibold">Nama kumpulan</label>
                        <input name="group_name" value="{{ old('group_name', $group->group_name) }}" required maxlength="50" class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-label font-semibold">Programme</label>
                        <select name="programme_id" required class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->programme_id }}" @selected(old('programme_id', $group->programme_id) == $programme->programme_id)>{{ $programme->programme_code }} — {{ $programme->programme_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-label font-semibold">Semester</label>
                        <select name="semester" required class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                            @for($semester=1;$semester<=8;$semester++)
                                <option value="{{ $semester }}" @selected(old('semester', $group->semester) == $semester)>Semester {{ $semester }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-label font-semibold">Sesi akademik</label>
                        <input name="academic_session" value="{{ old('academic_session', $group->academic_session) }}" required maxlength="20" class="w-full rounded-lg border-slate-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <button class="rounded-lg bg-primary px-5 py-3 font-label text-sm font-semibold text-white transition hover:bg-primary-container">Simpan perubahan</button>
                    </div>
                </form>
            </section>

            <section class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="mb-5 flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="font-headline text-lg font-bold text-primary">Senarai Pelajar</h2>
                        <p class="text-xs text-on-surface-variant">Pelajar yang ditempatkan dalam {{ $group->group_name }}.</p>
                    </div>
                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-label font-semibold text-amber-800">{{ $group->students_count }} pelajar</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left text-sm">
                        <thead class="border-b border-slate-200 bg-surface-container-low text-[11px] font-label uppercase tracking-wider text-slate-600">
                            <tr>
                                <th class="px-4 py-3">Student ID</th>
                                <th class="px-4 py-3">Student Name</th>
                                <th class="px-4 py-3">Phone Number</th>
                                <th class="px-4 py-3">Mentor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($group->students as $student)
                                @php
                                    $mentorAssignment = $student->currentMentorAssignment;
                                    $mentorName = $mentorAssignment?->lecturerDirectory?->lecturer_name
                                        ?? $mentorAssignment?->lecturer?->lecturer_name
                                        ?? 'Belum ditetapkan';
                                @endphp
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-4 font-label font-semibold text-primary">{{ $student->student_id }}</td>
                                    <td class="px-4 py-4">{{ $student->student_name }}</td>
                                    <td class="px-4 py-4">{{ $student->phone_number ?: '—' }}</td>
                                    <td class="px-4 py-4">{{ $mentorName }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-300">groups</span>
                                        <p class="mt-2 font-label font-semibold text-slate-600">Tiada pelajar dalam kumpulan ini</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>
