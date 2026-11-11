@extends('layouts.app')

@section('title', 'Kelulusan Pendaftaran Subjek Mentee | KPMB Student Hub')

@section('content')
@php
    $mentorUser = auth()->user();
    $mentorName = $mentorUser->name ?? 'Tidak tersedia';
@endphp

<div class="mx-auto flex w-full max-w-[1720px] flex-col gap-6">
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm">
        <a href="{{ route('lecturer.dashboard') }}" class="text-slate-500 hover:text-primary">Faculty Portal</a>
        <span class="material-symbols-outlined text-base text-slate-400">chevron_right</span>
        <span class="rounded-md bg-slate-100 px-2 py-1 font-semibold text-primary">Kelulusan Pendaftaran Subjek Mentee</span>
    </nav>

    <div class="flex flex-col gap-4">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div class="flex items-center gap-3.5">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary text-white shadow-sm">
                    <span class="material-symbols-outlined text-3xl">how_to_reg</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-primary">Kelulusan Pendaftaran Subjek Mentee</h1>
                    <p class="mt-1 text-sm text-slate-600">Semak permohonan pendaftaran subjek mentee dan urus status kelulusan.</p>
                </div>
            </div>
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

    {{-- Mentor information panel, matching the reference's mentor-group section. --}}
    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">groups</span>
            <h2 class="text-base font-bold text-primary">Maklumat Kumpulan Mentor</h2>
        </div>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Nama Mentor</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $mentorName }}</span>
            </div>
            <div class="rounded-lg bg-slate-50 px-4 py-3">
                <span class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Nama Kumpulan</span>
                <span class="mt-1 block text-sm font-semibold text-slate-900">
                    {{ data_get($mentorUser, 'mentor_group_name') ?? data_get($mentorUser, 'lecturer.mentor_group_name') ?? data_get($mentorUser, 'lecturer.group_name') ?? 'Belum ditetapkan' }}
                </span>
            </div>
        </div>
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">filter_alt</span>
            <div>
                <h2 class="text-lg font-bold text-primary">Carian dan Penapisan</h2>
                <p class="mt-1 text-xs text-slate-500">Cari mentee atau tapis permohonan mengikut status.</p>
            </div>
        </div>

        <form action="{{ route('lecturer.subject-registrations.index') }}" method="GET" class="flex flex-col gap-3 lg:flex-row lg:items-end">
            <div class="flex-1">
                <label for="search" class="mb-1.5 block text-xs font-semibold text-slate-600">Carian</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="ID atau nama pelajar"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm focus:border-primary focus:ring-primary"
                    >
                </div>
            </div>

            <div class="w-full lg:w-64">
                <label for="status" class="mb-1.5 block text-xs font-semibold text-slate-600">Status Permohonan</label>
                <select id="status" name="status" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-primary focus:ring-primary">
                    <option value="" @selected($status === '')>Semua Status</option>
                    <option value="pending" @selected($status === 'pending')>Menunggu Kelulusan</option>
                    <option value="approved" @selected($status === 'approved')>Diluluskan</option>
                    <option value="rejected" @selected($status === 'rejected')>Ditolak</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-dark">
                    <span class="material-symbols-outlined text-lg">search</span>
                    Cari / Tapis
                </button>
                <a href="{{ route('lecturer.subject-registrations.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <span class="material-symbols-outlined text-lg">restart_alt</span>
                    Reset
                </a>
            </div>
        </form>
    </section>

    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col justify-between gap-2 border-b border-slate-200 p-5 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-primary">Senarai Permohonan Mentee</h2>
                <p class="mt-1 text-xs text-slate-500">Maklumat kelas, status dan tindakan bagi setiap permohonan.</p>
            </div>
            <span class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-primary">
                <span class="material-symbols-outlined text-base">format_list_bulleted</span>
                {{ method_exists($registrations, 'total') ? $registrations->total() : $registrations->count() }} permohonan
            </span>
        </div>

        @if ($registrations->isEmpty())
            <div class="p-10 text-center">
                <span class="material-symbols-outlined text-5xl text-slate-300">inbox</span>
                <h3 class="mt-3 text-base font-bold text-primary">Tiada permohonan ditemui</h3>
                <p class="mt-1 text-sm text-slate-500">Tiada permohonan yang sepadan dengan carian atau penapis.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-left">
                    <thead class="bg-primary text-xs uppercase tracking-wider text-white">
                        <tr>
                            <th class="px-5 py-4 font-semibold">ID Pelajar</th>
                            <th class="px-5 py-4 font-semibold">Nama Pelajar</th>
                            <th class="px-5 py-4 font-semibold">Kelas</th>
                            <th class="px-5 py-4 font-semibold">Semester</th>
                            <th class="px-5 py-4 font-semibold">Tarikh Permohonan</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 text-center font-semibold">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($registrations as $registration)
                            @php
                                $registrationRows = $registration->registrations;
                                $classNames = $registrationRows ->pluck('classModel.classGroup.group_name') ->filter() ->unique() ->values();
                                $firstRegistration = $registrationRows->first();
                            @endphp
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="rounded-md bg-slate-100 px-2 py-1 font-mono text-xs font-semibold text-primary">{{ $registration->student_id }}</span>
                                </td>
                                <td class="px-5 py-4 font-semibold text-slate-800">
                                    {{ $registration->student->student_name ?? 'Tidak tersedia' }}
                                </td>
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $classNames->isNotEmpty() ? $classNames->join(', ') : 'Tidak tersedia' }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Sem {{ $registration->semester ?? '—' }}</span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                    {{ $registration->submitted_at?->format('d/m/Y') ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($registration->application_status === 'pending')
                                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Menunggu Kelulusan</span>
                                    @elseif ($registration->application_status === 'approved')
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Diluluskan</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('lecturer.subject-registrations.show', $registration->application_id) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary px-3 py-2 text-xs font-semibold text-white transition hover:bg-primary-dark">
                                            <span class="material-symbols-outlined text-base">visibility</span>
                                            Lihat Permohonan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-5 py-4">
                {{ $registrations->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
