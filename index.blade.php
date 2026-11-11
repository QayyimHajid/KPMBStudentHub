@extends('layouts.app')

@section('title', 'View Student Record')

@push('styles')
<style>
@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}
::-webkit-scrollbar{display:none;}
</style>
@endpush

@section('content')
<div class="flex flex-col w-full">
    <div class="p-8 flex flex-col gap-6 max-w-[1720px] mx-auto w-full">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2">
            <span class="font-label text-xs text-on-surface-variant">Faculty Portal</span>
            <span class="material-symbols-outlined text-[14px] text-outline">chevron_right</span>
            <span class="font-label text-xs text-on-surface-variant">Student Management</span>
            <span class="material-symbols-outlined text-[14px] text-outline">chevron_right</span>
            <span class="font-label text-xs text-primary-container font-semibold bg-surface-container px-2 py-0.5 rounded">View Student Record</span>
        </nav>

        <div class="flex flex-col gap-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-primary-container text-white flex items-center justify-center shadow-sm">
                        <span class="material-symbols-outlined text-[28px]">groups</span>
                    </div>
                    <div>
                        <h1 class="font-headline text-2xl font-bold text-on-surface tracking-tight">View Student Record</h1>
                        <p class="font-body text-sm text-on-surface-variant">Browse student information across all programmes, classes and semesters.</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-surface-container border border-outline-variant/30 text-xs font-label font-medium text-on-surface">
                    <span class="material-symbols-outlined text-[16px] text-primary-container">visibility</span>
                    Read-only access
                </span>
            </div>

            <div class="flex items-start gap-3 p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">info</span>
                <p class="flex-1 text-xs font-label leading-relaxed text-on-surface-variant"><span class="font-semibold text-primary-container">Information: </span>Lecturers can view student records from every programme, class and semester. Academic marks and registration information are displayed for reference only; access to record or modify marks is managed separately.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 shadow-sm flex items-center gap-4">
                <div class="w-11 h-11 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container border border-outline-variant/20"><span class="material-symbols-outlined text-[24px]">groups</span></div>
                <div><span class="block font-label text-xs font-semibold text-outline uppercase tracking-wider">Total Students</span><span class="block font-headline text-2xl font-bold text-on-surface mt-0.5">{{ number_format($totalStudents) }}</span><span class="font-label text-xs text-on-surface-variant">Across all programmes</span></div>
            </div>
            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 shadow-sm flex items-center gap-4">
                <div class="w-11 h-11 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container border border-outline-variant/20"><span class="material-symbols-outlined text-[24px]">account_tree</span></div>
                <div><span class="block font-label text-xs font-semibold text-outline uppercase tracking-wider">Programmes</span><span class="block font-headline text-2xl font-bold text-on-surface mt-0.5">{{ $programmes->count() }}</span><span class="font-label text-xs text-on-surface-variant">Programmes represented</span></div>
            </div>
            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 shadow-sm flex items-center gap-4">
                <div class="w-11 h-11 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container border border-outline-variant/20"><span class="material-symbols-outlined text-[24px]">filter_list</span></div>
                <div><span class="block font-label text-xs font-semibold text-outline uppercase tracking-wider">Displayed Records</span><span class="block font-headline text-2xl font-bold text-on-surface mt-0.5">{{ $students->total() }}</span><span class="font-label text-xs text-on-surface-variant">Matching current filters</span></div>
            </div>
        </div>

        <form method="GET" action="{{ route('lecturer.student-records.index') }}" class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant/30 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3 items-end">
                <div class="xl:col-span-2">
                    <label for="search" class="block text-xs font-label font-semibold text-on-surface-variant mb-1.5">Search Student</label>
                    <div class="relative"><span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[18px]">search</span><input id="search" name="search" value="{{ $search }}" type="text" placeholder="Student ID, name or email..." class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg pl-9 pr-3 py-2.5 text-sm text-on-surface outline-none focus:ring-1 focus:ring-primary-container"></div>
                </div>
                <div>
                    <label for="programme" class="block text-xs font-label font-semibold text-on-surface-variant mb-1.5">Programme</label>
                    <select id="programme" name="programme" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg px-3 py-2.5 text-sm text-on-surface outline-none focus:ring-1 focus:ring-primary-container">
                        <option value="">All Programmes</option>
                        @foreach($programmes as $programme)<option value="{{ $programme }}" @selected(($validated['programme'] ?? '') === $programme)>{{ $programme }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label for="semester" class="block text-xs font-label font-semibold text-on-surface-variant mb-1.5">Semester</label>
                    <select id="semester" name="semester" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg px-3 py-2.5 text-sm text-on-surface outline-none focus:ring-1 focus:ring-primary-container">
                        <option value="">All Semesters</option>
                        @foreach($semesters as $semester)<option value="{{ $semester }}" @selected((string)($validated['semester'] ?? '') === (string)$semester)>Semester {{ $semester }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label for="group_id" class="block text-xs font-label font-semibold text-on-surface-variant mb-1.5">Class Group</label>
                    <select id="group_id" name="group_id" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg px-3 py-2.5 text-sm text-on-surface outline-none focus:ring-1 focus:ring-primary-container">
                        <option value="">All Classes</option>
                        @foreach($classGroups as $group)<option value="{{ $group->group_id }}" @selected((string)($validated['group_id'] ?? '') === (string)$group->group_id)>{{ $group->group_name }}</option>@endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap justify-end gap-2 mt-4">
                <a href="{{ route('lecturer.student-records.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-outline-variant/40 text-on-surface-variant hover:bg-surface-container text-xs font-label font-semibold"><span class="material-symbols-outlined text-[16px]">restart_alt</span>Reset</a>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-container text-white hover:bg-primary text-xs font-label font-semibold shadow-sm"><span class="material-symbols-outlined text-[16px]">filter_alt</span>Apply Filters</button>
            </div>
        </form>

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-5 border-b border-outline-variant/30">
                <div><h2 class="font-headline text-lg font-bold text-primary">Student Directory</h2><p class="text-xs text-on-surface-variant mt-1">Select a student to view their complete available record.</p></div>
                <span class="text-xs font-label text-on-surface-variant">{{ $students->firstItem() ?? 0 }}–{{ $students->lastItem() ?? 0 }} of {{ $students->total() }} records</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-primary-container text-white"><tr class="font-label text-xs uppercase tracking-wider"><th class="py-3.5 px-5 font-semibold">Student</th><th class="py-3.5 px-5 font-semibold">Programme</th><th class="py-3.5 px-5 font-semibold text-center">Semester</th><th class="py-3.5 px-5 font-semibold">Class Group</th><th class="py-3.5 px-5 font-semibold">Email</th><th class="py-3.5 px-5 font-semibold text-center">Action</th></tr></thead>
                    <tbody class="divide-y divide-outline-variant/20 text-sm">
                        @forelse($students as $student)
                            <tr class="hover:bg-surface-container-low/60 transition-colors">
                                <td class="py-4 px-5"><div class="flex items-center gap-3"><div class="w-9 h-9 shrink-0 rounded-full bg-surface-container text-primary-container flex items-center justify-center font-bold">{{ strtoupper(substr($student->student_name ?? 'S', 0, 1)) }}</div><div><span class="block font-semibold text-on-surface">{{ $student->student_name }}</span><span class="block text-xs text-on-surface-variant font-mono">{{ $student->student_id }}</span></div></div></td>
                                <td class="py-4 px-5 text-on-surface-variant">{{ $student->programme ?? '—' }}</td>
                                <td class="py-4 px-5 text-center"><span class="inline-flex px-2.5 py-1 rounded-full bg-surface-container text-on-surface text-xs font-label font-semibold">{{ $student->semester ? 'Sem '.$student->semester : '—' }}</span></td>
                                <td class="py-4 px-5 text-on-surface-variant">{{ $student->classGroup?->group_name ?? '—' }}</td>
                                <td class="py-4 px-5 text-on-surface-variant">{{ $student->email ?? $student->user?->email ?? '—' }}</td>
                                <td class="py-4 px-5 text-center"><a href="{{ route('lecturer.student-records.show', $student->student_id) }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-primary-container text-white hover:bg-primary text-xs font-label font-semibold"><span class="material-symbols-outlined text-[16px]">visibility</span>View Record</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-12 px-6 text-center"><span class="material-symbols-outlined text-4xl text-outline">person_search</span><p class="mt-2 font-semibold text-on-surface">No students found</p><p class="mt-1 text-xs text-on-surface-variant">Try changing your search term or filters.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($students->hasPages())<div class="px-5 py-4 border-t border-outline-variant/30">{{ $students->links() }}</div>@endif
        </div>
        <footer class="text-center text-xs text-outline py-2">KPMB Student Hub · Lecturer Portal</footer>
    </div>
</div>
@endsection
