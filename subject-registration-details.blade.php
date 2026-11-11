<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butiran Permohonan Pendaftaran | KPMB Student Hub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0,1&display=swap" rel="stylesheet">
    <style>body{font-family:'Hanken Grotesk',sans-serif}.material-symbols-outlined{font-family:'Material Symbols Outlined'}</style>
</head>
<body class="min-h-screen bg-[#fcf9f8] text-slate-800">
@include('upp.partials.sidebar')
<div class="pl-72">
    @include('upp.partials.topbar')
    <main class="relative min-h-screen bg-[#fcf9f8] pt-24 md:pt-28">
        <div class="mx-auto w-full max-w-7xl space-y-6 px-5 pb-10 md:px-8">
            <a href="{{ route('upp.subject-registrations.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#002147] hover:underline">
                <span class="material-symbols-outlined text-lg">arrow_back</span>Kembali ke Pemantauan Pendaftaran
            </a>

            @php
                $statusLabel = match ($application->application_status) {
                    'approved' => 'Diluluskan',
                    'rejected' => 'Ditolak',
                    default => 'Menunggu Kelulusan',
                };
                $statusClass = match ($application->application_status) {
                    'approved' => 'bg-emerald-100 text-emerald-800',
                    'rejected' => 'bg-red-100 text-red-800',
                    default => 'bg-amber-100 text-amber-800',
                };
            @endphp

            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-start">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-amber-700">Butiran Permohonan #{{ $application->application_id }}</p>
                        <h1 class="mt-2 text-2xl font-extrabold text-[#002147]">Permohonan Pendaftaran Subjek</h1>
                        <p class="mt-2 text-sm text-slate-500">Maklumat pelajar dan senarai subjek yang dihantar dalam satu permohonan.</p>
                    </div>
                    <span class="inline-flex w-fit rounded-full px-3 py-1.5 text-xs font-bold {{ $statusClass }}">{{ $statusLabel }}</span>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-4 border-t border-slate-100 pt-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div><p class="text-xs text-slate-500">Student ID</p><p class="mt-1 font-semibold text-slate-900">{{ $application->student_id }}</p></div>
                    <div><p class="text-xs text-slate-500">Nama Pelajar</p><p class="mt-1 font-semibold text-slate-900">{{ $application->student->student_name ?? 'Tidak tersedia' }}</p></div>
                    <div><p class="text-xs text-slate-500">Semester Dipohon</p><p class="mt-1 font-semibold text-slate-900">{{ $application->semester }}</p></div>
                    <div><p class="text-xs text-slate-500">Sesi Akademik</p><p class="mt-1 font-semibold text-slate-900">{{ $application->academic_session }}</p></div>
                    <div><p class="text-xs text-slate-500">Tarikh Permohonan</p><p class="mt-1 font-semibold text-slate-900">{{ $application->submitted_at?->format('d/m/Y H:i') ?? '—' }}</p></div>
                    <div><p class="text-xs text-slate-500">Jumlah Subjek</p><p class="mt-1 font-semibold text-slate-900">{{ $application->registrations->count() }}</p></div>
                    @if($application->reviewed_at)
                    <div><p class="text-xs text-slate-500">Tarikh Semakan Mentor</p><p class="mt-1 font-semibold text-slate-900">{{ $application->reviewed_at->format('d/m/Y H:i') }}</p></div>
                    @endif
                    @if($application->remarks)
                    <div class="sm:col-span-2"><p class="text-xs text-slate-500">Catatan Mentor</p><p class="mt-1 text-sm text-slate-700">{{ $application->remarks }}</p></div>
                    @endif
                </div>
            </section>

            <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h2 class="font-bold text-[#002147]">Senarai Subjek Didaftarkan</h2>
                    <p class="mt-1 text-xs text-slate-500">Semua subjek yang terkandung dalam permohonan ini.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-600">
                            <tr>
                                <th class="px-5 py-3">No.</th>
                                <th class="px-5 py-3">Subject Code</th>
                                <th class="px-5 py-3">Subject Name</th>
                                <th class="px-5 py-3 text-center">Semester</th>
                                <th class="px-5 py-3">Registration Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($application->registrations->sortBy(fn($registration) => $registration->subject->subject_code ?? '') as $registration)
                                @php
                                    $subjectStatusLabel = match ($registration->registration_status) {
                                        'approved' => 'Diluluskan',
                                        'rejected' => 'Ditolak',
                                        default => 'Menunggu Kelulusan',
                                    };
                                    $subjectStatusClass = match ($registration->registration_status) {
                                        'approved' => 'bg-emerald-100 text-emerald-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        default => 'bg-amber-100 text-amber-800',
                                    };
                                @endphp
                                <tr>
                                    <td class="px-5 py-4 text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 font-mono font-semibold text-[#002147]">{{ $registration->subject->subject_code ?? '—' }}</td>
                                    <td class="px-5 py-4 font-medium text-slate-900">{{ $registration->subject->subject_name ?? 'Tidak tersedia' }}</td>
                                    <td class="px-5 py-4 text-center">{{ $registration->semester ?? $application->semester }}</td>
                                    <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $subjectStatusClass }}">{{ $subjectStatusLabel }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-5 py-10 text-center text-slate-500">Tiada subjek direkodkan dalam permohonan ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                Halaman ini untuk pemantauan UPP sahaja. Kelulusan atau penolakan permohonan dikendalikan oleh Mentor.
            </div>
        </div>
    </main>
</div>
</body>
</html>
