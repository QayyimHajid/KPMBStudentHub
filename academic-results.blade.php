<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keputusan Akademik - KPMB Student Hub</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@300;400;500;600;700;800&family=Source+Serif+4:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#002147','primary-container':'#002147','secondary-container':'#fed65b','surface':'#fcf9f8','surface-container-low':'#f6f3f2','surface-container':'#f0eded','on-surface':'#1c1b1b','on-surface-variant':'#44474e'},fontFamily:{headline:['Hanken Grotesk'],body:['Source Serif 4']}}}}</script>
    <style>body{font-family:'Hanken Grotesk',sans-serif}.student-page-shell{width:calc(100% - 18rem);margin-left:18rem;min-width:0}@media(max-width:767px){.student-page-shell{width:100%;margin-left:0}}</style>
</head>
<body class="bg-surface text-on-surface">
@include('student.partials.sidebar')
<div class="student-page-shell min-h-screen">
    @include('student.partials.topbar')
    <main class="px-5 py-7 md:px-8 max-w-[1440px] mx-auto">
        <nav class="mb-5 flex items-center gap-2 text-xs text-on-surface-variant">
            <a href="{{ route('student.dashboard') }}" class="hover:text-primary">Portal Pelajar</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-semibold text-primary">Keputusan Akademik</span>
        </nav>

        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.18em] text-amber-700">Maklumat Akademik</p>
                <h1 class="mt-1 text-2xl font-extrabold text-primary md:text-3xl">Keputusan Akademik</h1>
                <p class="mt-1 text-sm text-on-surface-variant">Paparan keputusan peperiksaan berdasarkan rekod markah rasmi.</p>
            </div>
            <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                <span class="material-symbols-outlined text-sm">visibility</span> Read-only
            </span>
        </div>

        <form method="GET" action="{{ route('student.academic-results') }}" class="mb-6 rounded-xl border border-black/5 bg-white p-4 shadow-sm">
            <div class="grid gap-3 md:grid-cols-[1fr_1fr_auto] md:items-end">
                <label class="block text-xs font-semibold text-on-surface-variant">Semester
                    <select name="semester" class="mt-1.5 w-full rounded-lg border-gray-200 bg-white text-sm text-gray-800 focus:border-primary focus:ring-primary">
                        <option value="">Semua semester</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester }}" @selected((string)$selectedSemester === (string)$semester)>Semester {{ $semester }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-xs font-semibold text-on-surface-variant">Sesi Akademik
                    <select name="session" class="mt-1.5 w-full rounded-lg border-gray-200 bg-white text-sm text-gray-800 focus:border-primary focus:ring-primary">
                        <option value="">Semua sesi</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session }}" @selected($selectedSession === $session)>{{ $session }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="flex gap-2">
                    <a href="{{ route('student.academic-results') }}" class="rounded-lg bg-gray-100 px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-200">Reset</a>
                    <button class="rounded-lg bg-primary px-5 py-2.5 text-xs font-bold text-white hover:bg-[#00152f]" type="submit">Tapis</button>
                </div>
            </div>
        </form>

        <div class="mb-6 grid gap-4 sm:grid-cols-2">
            <section class="rounded-xl bg-primary p-5 text-white shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-blue-100">GPA — Rekod Dipilih</p>
                <p class="mt-2 text-3xl font-extrabold">{{ $gpa !== null ? number_format($gpa, 2) : '—' }}</p>
                <p class="mt-1 text-xs text-blue-100">{{ $gpa !== null ? number_format($gpaHours, 1).' jam kredit' : 'Pilih semester dan sesi untuk melihat GPA' }}</p>
            </section>
            <section class="rounded-xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-800">CGPA — Keseluruhan</p>
                <p class="mt-2 text-3xl font-extrabold text-primary">{{ $cgpa !== null ? number_format($cgpa, 2) : '—' }}</p>
                <p class="mt-1 text-xs text-amber-800">{{ number_format($cgpaHours, 1) }} jam kredit terkumpul</p>
            </section>
        </div>

        <section class="overflow-hidden rounded-xl border border-black/5 bg-white shadow-sm">
            <div class="flex flex-col gap-1 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-bold text-primary">Senarai Keputusan Subjek</h2>
                    <p class="text-xs text-on-surface-variant">{{ $filteredMarks->count() }} rekod dipaparkan</p>
                </div>
                <span class="text-[11px] text-gray-500">Keputusan dipaparkan sahaja dan tidak boleh diubah.</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px] text-left text-sm">
                    <thead class="bg-gray-50 text-[11px] uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-5 py-3">Kod Subjek</th>
                            <th class="px-5 py-3">Nama Subjek</th>
                            <th class="px-5 py-3 text-center">Kredit</th>
                            <th class="px-5 py-3 text-right">Markah</th>
                            <th class="px-5 py-3 text-center">Gred</th>
                            <th class="px-5 py-3 text-right">Mata Gred</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($filteredMarks as $mark)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 font-semibold text-primary">{{ $mark->subject?->subject_code ?? '—' }}</td>
                                <td class="px-5 py-3">{{ $mark->subject?->subject_name ?? '—' }}</td>
                                <td class="px-5 py-3 text-center">{{ number_format($mark->calculated_credit_hours, 1) }}</td>
                                <td class="px-5 py-3 text-right">{{ number_format((float)$mark->marks, 2) }}</td>
                                <td class="px-5 py-3 text-center"><span class="inline-flex min-w-9 justify-center rounded-md bg-blue-50 px-2 py-1 font-bold text-primary">{{ $mark->calculated_grade }}</span></td>
                                <td class="px-5 py-3 text-right">{{ number_format((float)$mark->calculated_grade_point, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-12 text-center text-sm text-gray-500">Tiada rekod keputusan untuk pilihan semester atau sesi ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <p class="mt-4 text-[11px] leading-relaxed text-gray-500">Nota: GPA dikira berdasarkan rekod yang dipaparkan selepas tapisan. CGPA dikira berdasarkan semua rekod keputusan pelajar. Keputusan yang belum lengkap tidak dipaparkan sebagai keputusan akhir.</p>
    </main>
</div>
</body>
</html>
