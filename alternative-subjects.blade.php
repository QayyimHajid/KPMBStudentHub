<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Penetapan Subjek Alternatif</title>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-['Hanken_Grotesk']">
@include('upp.partials.sidebar')
<div class="pl-72 min-h-screen">
    @include('upp.partials.topbar')
    <main class="p-6 lg:p-8 space-y-6">
        <div>
            <p class="text-xs font-semibold tracking-widest text-slate-500">PENGURUSAN AKADEMIK</p>
            <h1 class="text-2xl font-bold text-slate-900 mt-1">Penetapan Subjek Alternatif</h1>
            <p class="text-sm text-slate-500 mt-1">UPP menetapkan satu pilihan subjek alternatif bagi setiap pelajar untuk semester akan datang.</p>
        </div>

        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="GET" class="bg-white border border-slate-200 rounded-xl p-4 flex flex-wrap items-center gap-3">
            <input name="search" value="{{ $search }}" placeholder="Cari nama atau ID pelajar"
                   class="border border-slate-300 rounded-lg px-3 py-2.5 text-sm flex-1 min-w-56">
            <select name="programme" class="border border-slate-300 rounded-lg px-3 py-2.5 text-sm min-w-48">
                <option value="">Semua programme</option>
                @foreach($programmeOptions as $option)
                    <option value="{{ $option->programme_code }}" @selected($programme === $option->programme_code)>{{ $option->programme_code }} — {{ $option->programme_name }}</option>
                @endforeach
            </select>
            <select name="semester" class="border border-slate-300 rounded-lg px-3 py-2.5 text-sm min-w-36">
                <option value="">Semua semester</option>
                @foreach($semesterOptions as $option)
                    <option value="{{ $option }}" @selected((string)$semesterFilter === (string)$option)>Semester {{ $option }}</option>
                @endforeach
            </select>
            <button type="submit" class="rounded-lg bg-slate-900 text-white px-5 py-2.5 text-sm font-semibold">Tapis</button>
            <a href="{{ route('upp.alternative-subjects.index') }}" class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm">Reset</a>
        </form>

        <section class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 flex flex-wrap justify-between items-center gap-2">
                <div>
                    <h2 class="font-bold text-slate-900">Senarai Pelajar</h2>
                    <p class="text-xs text-slate-500 mt-1">Pelajar yang mempunyai kumpulan subjek alternatif untuk semester seterusnya dipaparkan dahulu.</p>
                </div>
                <div class="text-xs text-slate-500">{{ $students->total() }} rekod pelajar</div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600 text-xs uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Maklumat Pelajar</th>
                            <th class="px-4 py-3 font-semibold">Programme / Kumpulan</th>
                            <th class="px-4 py-3 font-semibold">Semester</th>
                            <th class="px-4 py-3 font-semibold">Subjek Alternatif</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                    @forelse($students as $student)
                        @php($data = $groupsByStudent[$student->student_id])
                        @php($programmeCode = $student->programmeStructure?->programme?->programme_code ?? $student->programme)
                        <tr class="{{ $data['groups']->isNotEmpty() ? 'bg-white' : 'bg-slate-50/60' }} hover:bg-slate-50">
                            <td class="px-4 py-4 min-w-52">
                                <div class="font-semibold text-slate-900">{{ $student->student_name }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ $student->student_id }}</div>
                            </td>
                            <td class="px-4 py-4 min-w-40">
                                <span class="inline-flex rounded bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ $programmeCode }}</span>
                                <div class="text-xs text-slate-500 mt-1">{{ $student->classGroup?->group_name ?? '—' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium">Semasa {{ $student->semester }}</div>
                                <div class="text-xs text-slate-500 mt-1">Akan datang {{ $data['semester'] }}</div>
                            </td>
                            <td class="px-4 py-4 min-w-72">
                                @if($data['groups']->isEmpty())
                                    <span class="text-xs text-slate-400">Tiada kumpulan alternatif ditetapkan</span>
                                @else
                                    <form id="alternative-form-{{ $student->student_id }}" method="POST" action="{{ route('upp.alternative-subjects.update', $student->student_id) }}" class="space-y-2">
                                        @csrf
                                        @method('PUT')
                                        @foreach($data['groups'] as $group)
                                            @php($currentChoice = $data['choices']->get($group->alternative_group_id)?->subject_id)
                                            <label class="block">
                                                <span class="block text-xs font-semibold text-slate-700 mb-1">{{ $group->group_name }}</span>
                                                <select name="choices[{{ $group->alternative_group_id }}]" required class="w-full border border-slate-300 rounded-md px-2.5 py-2 text-xs bg-white">
                                                    <option value="">Pilih subjek</option>
                                                    @foreach($group->subjectMappings as $mapping)
                                                        <option value="{{ $mapping->subject_id }}" @selected((string)$currentChoice === (string)$mapping->subject_id)>{{ $mapping->subject?->subject_code }} — {{ $mapping->subject?->subject_name }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        @endforeach
                                    </form>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($data['groups']->isNotEmpty())
                                    @php($savedCount = $data['choices']->count())
                                    @if($savedCount >= $data['groups']->count())
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">● Lengkap</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 text-amber-700 px-2.5 py-1 text-xs font-semibold">● Perlu penetapan</span>
                                    @endif
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 text-slate-500 px-2.5 py-1 text-xs">Belum eligible</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right whitespace-nowrap">
                                @if($data['groups']->isNotEmpty())
                                    <button type="submit" form="alternative-form-{{ $student->student_id }}" class="rounded-md bg-slate-900 hover:bg-slate-700 text-white px-3 py-2 text-xs font-semibold">Simpan</button>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">Tiada pelajar dengan programme structure ditemui.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-slate-200">{{ $students->links() }}</div>
        </section>
    </main>
</div>
</body>
</html>
