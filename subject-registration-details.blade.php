@extends('layouts.app')

@section('title', 'Butiran Permohonan Pendaftaran Subjek | KPMB Student Hub')

@section('content')
@php
    $mentorUser = auth()->user();
    $mentorName = $mentorUser->name ?? 'Tidak tersedia';
    $registrationRows = $application->registrations;
@endphp

<div class="mx-auto flex w-full max-w-[1720px] flex-col gap-6">
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm">
        <a href="{{ route('lecturer.dashboard') }}" class="text-slate-500 hover:text-primary">Faculty Portal</a>
        <span class="material-symbols-outlined text-base text-slate-400">chevron_right</span>
        <a href="{{ route('lecturer.subject-registrations.index') }}" class="text-slate-500 hover:text-primary">Kelulusan Pendaftaran Subjek Mentee</a>
        <span class="material-symbols-outlined text-base text-slate-400">chevron_right</span>
        <span class="rounded-md bg-slate-100 px-2 py-1 font-semibold text-primary">Butiran Permohonan</span>
    </nav>

    <div class="flex flex-col gap-4">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div class="flex items-center gap-3.5">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary text-white shadow-sm">
                    <span class="material-symbols-outlined text-3xl">fact_check</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-primary">Butiran Permohonan Pendaftaran Subjek</h1>
                    <p class="mt-1 text-sm text-slate-600">Semak maklumat pelajar dan semua subjek yang dimohon sebelum membuat keputusan.</p>
                </div>
            </div>
            <a href="{{ route('lecturer.subject-registrations.index') }}" class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Kembali ke Senarai
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                <span class="material-symbols-outlined">check_circle</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <span class="material-symbols-outlined">error</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <p class="mb-2 font-semibold">Sila semak maklumat berikut:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">person</span>
            <h2 class="text-base font-bold text-primary">Maklumat Pelajar dan Permohonan</h2>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">ID Pelajar</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $application->student_id }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Nama Pelajar</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $application->student->student_name ?? 'Tidak tersedia' }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Semester</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">Semester {{ $application->semester }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Sesi Akademik</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $application->academic_session }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Tarikh Permohonan</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $application->submitted_at?->format('d/m/Y h:i A') ?? '-' }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Status Permohonan</span>
                <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                    {{ $application->application_status === 'pending' ? 'bg-amber-50 text-amber-700' : ($application->application_status === 'approved' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                    {{ $application->application_status === 'pending' ? 'Menunggu Kelulusan' : ($application->application_status === 'approved' ? 'Diluluskan' : 'Ditolak') }}
                </span>
            </div>
        </div>
    </section>

    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-5">
            <h2 class="text-lg font-bold text-primary">Senarai Subjek Dimohon</h2>
            <p class="mt-1 text-xs text-slate-500">Semua subjek di bawah merupakan sebahagian daripada permohonan yang sama.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left">
                <thead class="bg-primary text-xs uppercase tracking-wider text-white">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Bil.</th>
                        <th class="px-5 py-4 font-semibold">Kod Subjek</th>
                        <th class="px-5 py-4 font-semibold">Nama Subjek</th>
                        <th class="px-5 py-4 font-semibold">Kelas</th>
                        <th class="px-5 py-4 font-semibold">Jam Kredit</th>
                        <th class="px-5 py-4 font-semibold">Status Subjek</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach ($registrationRows as $row)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-5 py-4 font-semibold text-primary">{{ $row->subject->subject_code ?? '-' }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $row->subject->subject_name ?? 'Tidak tersedia' }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $row->classModel?->classGroup?->group_name ?? 'Belum ditetapkan' }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $row->subject->credit_hour ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $row->registration_status === 'pending' ? 'bg-amber-50 text-amber-700' : ($row->registration_status === 'approved' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                                    {{ $row->registration_status === 'pending' ? 'Menunggu' : ($row->registration_status === 'approved' ? 'Diluluskan' : 'Ditolak') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50 px-5 py-3 text-sm sm:flex-row sm:justify-between">
            <span class="font-semibold text-slate-700">Jumlah subjek: {{ $registrationRows->count() }}</span>
            <span class="text-slate-500">Jumlah jam kredit: {{ $registrationRows->sum(fn ($row) => (int) ($row->subject->credit_hour ?? 0)) }}</span>
        </div>
    </section>

    @if ($application->application_status === 'rejected' && $application->remarks)
        <section class="rounded-xl border border-red-200 bg-red-50 p-5">
            <div class="mb-2 flex items-center gap-2 text-red-800">
                <span class="material-symbols-outlined">comment</span>
                <h2 class="text-base font-bold">Remarks Penolakan Terdahulu</h2>
            </div>
            <p class="whitespace-pre-line text-sm text-red-800">{{ $application->remarks }}</p>
            <p class="mt-2 text-xs text-red-600">Permohonan ini telah dihantar semula oleh pelajar. Remarks terdahulu dipaparkan untuk rujukan.</p>
        </section>
    @endif

    @if ($application->application_status === 'pending')
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">rate_review</span>
                <div>
                    <h2 class="text-lg font-bold text-primary">Keputusan Permohonan</h2>
                    <p class="mt-1 text-xs text-slate-500">Permohonan ini akan diproses secara keseluruhan, termasuk semua subjek yang disenaraikan.</p>
                </div>
            </div>
            <form id="application-review-form" action="{{ route('lecturer.subject-registrations.update', $application->application_id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="remarks" class="mb-1.5 block text-sm font-semibold text-slate-700">Remarks / Sebab Penolakan</label>
                    <textarea id="remarks" name="remarks" rows="4" maxlength="2000" placeholder="Wajib diisi jika permohonan ditolak. Untuk kelulusan, ruangan ini boleh dibiarkan kosong." class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-primary focus:ring-primary">{{ old('remarks') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">Sila berikan sebab yang jelas supaya pelajar boleh membuat pembetulan jika permohonan ditolak.</p>
                </div>
                <div class="flex flex-wrap justify-end gap-2">
                    <button type="submit" name="application_status" value="rejected" form="application-review-form" onclick="return confirm('Tolak keseluruhan permohonan ini?')" class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-700 transition hover:bg-red-50">
                        <span class="material-symbols-outlined text-lg">close</span>
                        Tolak Permohonan
                    </button>
                    <button type="submit" name="application_status" value="approved" onclick="return confirm('Luluskan keseluruhan permohonan ini?')" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        <span class="material-symbols-outlined text-lg">check</span>
                        Luluskan Permohonan
                    </button>
                </div>
            </form>
        </section>
    @else
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-base font-bold text-primary">Maklumat Semakan</h2>
            <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="rounded-lg bg-slate-50 px-4 py-3">
                    <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Tarikh Disemak</span>
                    <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $application->reviewed_at?->format('d/m/Y h:i A') ?? '-' }}</span>
                </div>
                <div class="rounded-lg bg-slate-50 px-4 py-3">
                    <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Remarks</span>
                    <span class="mt-1 block whitespace-pre-line text-sm text-slate-800">{{ $application->remarks ?: 'Tiada remarks.' }}</span>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
