<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengurusan Kelas Subjek | KPMB Student Hub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    midnight: { DEFAULT:'#002147', 50:'#f0f5fc', 100:'#e0ecf8', 800:'#001a38', 900:'#001329' },
                    gold: { DEFAULT:'#C5A059', dark:'#9E7E38', light:'#F5EDDF' }
                },
                fontFamily: { sans:['"Plus Jakarta Sans"','"Inter"','sans-serif'] },
                boxShadow: {
                    card:'0 4px 20px -2px rgba(0,33,71,.06),0 2px 6px -1px rgba(0,33,71,.03)',
                    subtle:'0 1px 3px rgba(0,0,0,.04)'
                }
            }}
        };
    </script>
    <style>
        body { font-family:'Plus Jakarta Sans','Inter',sans-serif; background:#F8FAFC; color:#1E293B; -webkit-font-smoothing:antialiased; }
        select,input { background-image:none; }
        .custom-scrollbar::-webkit-scrollbar { width:6px;height:6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background:#CBD5E1;border-radius:4px; }
        @media print {
            aside, nav, header, .no-print, form button, form select { display:none !important; }
            .pl-72 { padding-left:0 !important; }
            main { padding:0 !important; }
            body { background:#fff !important; }
            section { break-inside:avoid; box-shadow:none !important; }
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
@include('upp.partials.sidebar')
<div class="pl-72 min-h-screen">
    @include('upp.partials.topbar')
    <main class="p-6 lg:p-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <section class="space-y-2 border-b border-slate-200/80 pb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="mb-1.5 flex items-center gap-2">
                            <span class="rounded border border-amber-200/60 bg-amber-50 px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-amber-700">Pengurusan Akademik</span>
                            <span class="text-xs text-slate-400">/</span>
                            <span class="text-xs font-medium text-slate-500">Jadual Waktu & Penugasan Staf</span>
                        </div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-midnight sm:text-3xl">Pengurusan Kelas Subjek</h1>
                        <p class="mt-1 max-w-3xl text-sm leading-relaxed text-slate-500 sm:text-base">Tetapkan subjek kepada kumpulan kelas dan pilih pensyarah daripada direktori rasmi jabatan.</p>
                    </div>
                    <div class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3.5 py-1.5 text-xs font-semibold text-amber-800">UPP · Subject Class Management</div>
                </div>
            </section>

            @if(session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <p class="font-bold">Sila semak maklumat berikut:</p>
                    <ul class="mt-1 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            @php
                $assignedCount = $classes->count();
                $unassignedCount = $classes->filter(fn($class) => !$class->lecturer_directory_id)->count();
            @endphp

            <!-- Section 1: Programme filters and create assignment -->
            <section class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-card">
                <div class="border-b border-slate-100 bg-slate-50/60 px-6 py-5">
                    <h2 class="flex items-center gap-2 text-lg font-bold tracking-tight text-midnight"><span class="flex h-6 w-6 items-center justify-center rounded-full bg-midnight text-xs font-bold text-white">1</span>Programme, Class Filters & Create Subject Class</h2>
                    <p class="mt-1 pl-8 text-xs text-slate-500 sm:text-sm">Class group mewakili cohort pelajar. Programme structure ditentukan berdasarkan programme dan semester cohort; semester yang dipilih digunakan untuk memaparkan subjek.</p>
                </div>
                <div class="space-y-6 p-6">
                    <form method="GET" action="{{ route('upp.subject-classes.index') }}" class="grid grid-cols-1 items-end gap-4 md:grid-cols-12">
                        <div class="space-y-1.5 md:col-span-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600" for="programme_id">Programme <span class="text-red-500">*</span></label>
                            <select id="programme_id" name="programme_id" class="w-full rounded-lg border-slate-300 bg-white px-3 py-2.5 pr-10 text-sm font-medium text-slate-800 shadow-sm focus:border-midnight focus:ring-1 focus:ring-midnight">
                                <option value="">Pilih programme</option>
                                @foreach($programmes as $programme)<option value="{{ $programme->programme_id }}" @selected(($filters['programme_id'] ?? '') == $programme->programme_id)>{{ $programme->programme_code }} — {{ $programme->programme_name }}</option>@endforeach
                            </select>
                        </div>
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600" for="semester">Semester <span class="text-red-500">*</span></label>
                            <select id="semester" name="semester" class="w-full rounded-lg border-slate-300 bg-white px-3 py-2.5 pr-10 text-sm font-medium text-slate-800 shadow-sm focus:border-midnight focus:ring-1 focus:ring-midnight">
                                <option value="">Pilih semester</option>
                                @for($i=1;$i<=8;$i++)<option value="{{ $i }}" @selected(($filters['semester'] ?? '') == $i)>Semester {{ $i }}</option>@endfor
                            </select>
                        </div>
                        <div class="space-y-1.5 md:col-span-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600" for="group_id">Actual Class Group <span class="text-red-500">*</span></label>
                            <select id="group_id" name="group_id" class="w-full rounded-lg border-slate-300 bg-white px-3 py-2.5 pr-10 text-sm font-medium text-slate-800 shadow-sm focus:border-midnight focus:ring-1 focus:ring-midnight">
                                <option value="">Pilih class group</option>
                                @foreach($groups as $group)<option value="{{ $group->group_id }}" @selected(($filters['group_id'] ?? '') == $group->group_id)>{{ $group->group_name }}</option>@endforeach
                            </select>
                        </div>
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Academic Session</label>
                            <input name="academic_session" value="{{ $filters['academic_session'] }}" class="w-full rounded-lg border-slate-300 bg-slate-100 px-3.5 py-2.5 text-sm font-semibold text-slate-700 shadow-inner">
                        </div>
                        <div class="md:col-span-2">
                            <button class="inline-flex h-[42px] w-full items-center justify-center rounded-lg bg-midnight px-4 text-sm font-semibold text-white shadow-md transition hover:bg-midnight-800">Load Subjects</button>
                        </div>
                    </form>

                    <div class="border-t border-slate-100 pt-4">
                        <div class="mb-3 flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
                            <div><h3 class="text-sm font-bold tracking-tight text-slate-900">Create Subject Class</h3><p class="text-xs text-slate-500">Regular dan Repeat kedua-duanya dikaitkan dengan actual class group pelajar.</p></div>
                            <span class="inline-flex items-center rounded-md border border-slate-200 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700"><span class="font-bold text-midnight">{{ $subjects->count() }} subjects</span><span class="mx-1.5 text-slate-300">•</span><span class="font-bold text-midnight">{{ $groups->count() }} groups</span><span class="mx-1.5 text-slate-300">•</span><span class="font-bold text-midnight">{{ $lecturers->count() }} lecturers</span></span>
                        </div>
                        @if(!$selectedProgramme || empty($filters['semester']) || !$selectedGroup)
                            <div class="rounded-xl border border-dashed border-slate-300 bg-gradient-to-r from-slate-50 to-blue-50/30 p-5 text-center text-sm font-medium text-slate-600">Pilih programme, semester dan actual class group, kemudian tekan <span class="font-bold text-midnight">Load Subjects</span> untuk memaparkan subjek yang boleh di-assign.</div>
                        @elseif($structureWarning)
                            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">{{ $structureWarning }}</div>
                        @elseif($subjects->isEmpty())
                            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">Tiada subjek aktif ditemui dalam programme structure cohort untuk semester subjek ini.</div>
                        @elseif($lecturers->isEmpty())
                            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">Tiada pensyarah ditemui dalam direktori rasmi.</div>
                        @else
                            <form method="POST" action="{{ route('upp.subject-classes.store', request()->query()) }}" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                                @csrf
                                <input type="hidden" name="programme_id" value="{{ $selectedProgramme->programme_id }}">
                                <input type="hidden" name="semester" value="{{ $filters['semester'] }}">
                                <input type="hidden" name="academic_session" value="{{ $filters['academic_session'] }}">
                                <input type="hidden" name="group_id" value="{{ $selectedGroup->group_id }}">
                                <div class="space-y-1.5"><label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Class Type</label><select name="class_type" id="assignment_class_type" required class="w-full rounded-lg border-slate-300 bg-white py-2.5 text-sm focus:border-midnight focus:ring-midnight"><option value="regular">Regular</option><option value="repeat">Repeat</option></select></div>
                                <div class="space-y-1.5"><label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Subject</label><select name="subject_id" required class="w-full rounded-lg border-slate-300 bg-white py-2.5 text-sm focus:border-midnight focus:ring-midnight"><option value="">Pilih subjek</option>@foreach($subjects as $row)<option value="{{ $row->subject_id }}">{{ $row->subject->subject_code }} — {{ $row->subject->subject_name }}</option>@endforeach</select></div>
                                <div class="space-y-1.5"><label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Lecturer</label><select name="lecturer_directory_id" required class="w-full rounded-lg border-slate-300 bg-white py-2.5 text-sm focus:border-midnight focus:ring-midnight"><option value="">Pilih pensyarah</option>@foreach($lecturers as $lecturer)<option value="{{ $lecturer->id }}">{{ $lecturer->lecturer_name }}@if($lecturer->position) — {{ $lecturer->position }}@endif</option>@endforeach</select></div>
                                <div class="flex items-end"><button class="w-full rounded-lg bg-gold px-4 py-2.5 text-sm font-bold text-midnight transition hover:bg-amber-400">+ Create Assignment</button></div>
                            </form>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Section 2: Existing assignments -->
            <section class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-card">
                <div class="border-b border-slate-100 bg-slate-50/60 px-6 py-5">
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                        <div>
                            <h2 class="flex items-center gap-2 text-lg font-bold tracking-tight text-midnight"><span class="flex h-6 w-6 items-center justify-center rounded-full bg-midnight text-xs font-bold text-white">2</span>Existing Subject Class Assignments</h2>
                            <p class="mt-1 pl-8 text-xs text-slate-500 sm:text-sm"><span class="font-bold text-slate-700">{{ $classes->count() }} assignments</span> • Academic session <span class="font-semibold text-slate-700">{{ $filters['academic_session'] }}</span></p>
                        </div>
                        <div class="no-print flex items-center gap-2 md:self-auto">
                            <button type="button" onclick="exportAssignmentsCsv()" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-subtle transition hover:bg-slate-50">↓ Eksport CSV</button>
                            <button type="button" onclick="window.print()" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-subtle transition hover:bg-slate-50">▣ Cetak Senarai</button>
                        </div>
                    </div>
                </div>
                <div class="no-print border-b border-slate-200 bg-slate-50/30 px-6 py-4">
                    <form method="GET" action="{{ route('upp.subject-classes.index') }}" class="grid grid-cols-1 items-end gap-3 sm:grid-cols-2 lg:grid-cols-6">
                        <input type="hidden" name="academic_session" value="{{ $filters['academic_session'] }}">
                        <div class="space-y-1"><label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500">Programme</label><select name="filter_programme_id" class="w-full rounded-lg border-slate-300 bg-white px-2.5 py-2 text-xs font-medium shadow-sm focus:border-midnight focus:ring-midnight"><option value="">All programmes</option>@foreach($programmes as $programme)<option value="{{ $programme->programme_id }}" @selected(($filters['filter_programme_id'] ?? '') == $programme->programme_id)>{{ $programme->programme_code }}</option>@endforeach</select></div>
                        <div class="space-y-1"><label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500">Semester</label><select name="filter_semester" class="w-full rounded-lg border-slate-300 bg-white px-2.5 py-2 text-xs font-medium shadow-sm focus:border-midnight focus:ring-midnight"><option value="">All semesters</option>@for($i=1;$i<=12;$i++)<option value="{{ $i }}" @selected(($filters['filter_semester'] ?? '') == $i)>Semester {{ $i }}</option>@endfor</select></div>
                        <div class="space-y-1"><label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500">Class Group</label><select name="filter_group_id" class="w-full rounded-lg border-slate-300 bg-white px-2.5 py-2 text-xs font-medium shadow-sm focus:border-midnight focus:ring-midnight"><option value="">All class groups</option>@foreach($allGroups as $group)<option value="{{ $group->group_id }}" @selected(($filters['filter_group_id'] ?? '') == $group->group_id)>{{ $group->group_name }}</option>@endforeach</select></div>
                        <div class="space-y-1"><label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500">Class Type</label><select name="filter_class_type" class="w-full rounded-lg border-slate-300 bg-white px-2.5 py-2 text-xs font-medium shadow-sm focus:border-midnight focus:ring-midnight"><option value="all" @selected(($filters['filter_class_type'] ?? 'all') === 'all')>All types</option><option value="regular" @selected(($filters['filter_class_type'] ?? '') === 'regular')>Regular</option><option value="repeat" @selected(($filters['filter_class_type'] ?? '') === 'repeat')>Repeat</option></select></div>
                        <div class="flex items-center gap-2 lg:col-span-2"><button class="h-[38px] flex-1 rounded-lg bg-midnight px-4 text-xs font-semibold text-white shadow-sm transition hover:bg-midnight-800">Apply Filters</button><a href="{{ route('upp.subject-classes.index', ['academic_session' => $filters['academic_session']]) }}" class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-subtle transition hover:bg-slate-100">Reset</a></div>
                    </form>
                </div>
                <div class="custom-scrollbar overflow-x-auto">
                    <table id="subjectAssignmentsTable" class="w-full border-collapse text-left">
                        <thead><tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500"><th class="px-6 py-3.5">Class Type</th><th class="px-6 py-3.5">Class Group / Class</th><th class="px-6 py-3.5">Subject</th><th class="px-4 py-3.5 text-center">Semester</th><th class="min-w-[280px] px-6 py-3.5">Assigned Lecturer</th><th class="px-6 py-3.5 text-right">Action</th></tr></thead>
                        <tbody class="divide-y divide-slate-200/80 text-sm">
                        @forelse($classes as $class)
                            <tr class="group transition-colors hover:bg-slate-50/80">
                                <td class="whitespace-nowrap px-6 py-4">@if($class->class_type === 'repeat')<span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">Repeat</span>@else<span class="inline-flex items-center rounded-full border border-sky-200 bg-sky-50 px-2.5 py-0.5 text-xs font-semibold text-sky-700">Regular</span>@endif</td>
                                <td class="whitespace-nowrap px-6 py-4 font-bold text-slate-900"><div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full {{ $class->class_type === 'repeat' ? 'bg-amber-500' : 'bg-emerald-500' }}"></span><span>{{ $class->classGroup->group_name ?? $class->class_name }}</span></div></td>
                                <td class="px-6 py-4"><span class="block font-bold tracking-tight text-midnight">{{ $class->subject->subject_code ?? '—' }}</span><span class="text-xs text-slate-500">{{ $class->subject->subject_name ?? '—' }}</span></td>
                                <td class="whitespace-nowrap px-4 py-4 text-center"><span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs font-bold text-slate-700">{{ $class->semester }}</span></td>
                                <td class="min-w-[280px] px-6 py-4">
                                    <form method="POST" action="{{ $class->class_type === 'repeat' ? route('upp.repeat-classes.update', array_merge(['classId'=>$class->class_id], request()->query())) : route('upp.subject-classes.update', array_merge(['classId'=>$class->class_id], request()->query())) }}" class="flex items-center gap-2">
                                        @csrf @method('PUT')
                                        <select name="lecturer_directory_id" class="min-w-0 flex-1 rounded-lg border-slate-300 bg-white px-3 py-2 text-xs shadow-sm focus:border-midnight focus:ring-midnight">
                                            @foreach($lecturers as $lecturer)<option value="{{ $lecturer->id }}" @selected($class->lecturer_directory_id == $lecturer->id)>{{ $lecturer->lecturer_name }}</option>@endforeach
                                        </select>
                                        <button class="rounded-lg bg-midnight px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-midnight-800">Save</button>
                                    </form>
                                </td>                
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($class->class_type === 'repeat')
                                            <a
                                                href="{{ route('upp.subject-classes.index', array_merge(
                                                    request()->query(),
                                                    ['manage_repeat_class_id' => $class->class_id]
                                                )) }}"
                                                class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-800 transition hover:bg-amber-100"
                                            >
                                                Manage Students
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ $class->class_type === 'repeat' ? route('upp.repeat-classes.destroy', array_merge(['classId'=>$class->class_id], request()->query())) : route('upp.subject-classes.destroy', array_merge(['classId'=>$class->class_id], request()->query())) }}" onsubmit="return confirm('Padam assignment ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 shadow-subtle transition hover:border-red-300 hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">Belum ada subject class untuk filter ini.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-center justify-between gap-3 border-t border-slate-200 bg-slate-50/40 px-6 py-4 text-xs text-slate-500 sm:flex-row">
                    <div>Memaparkan <span class="font-bold text-slate-800">{{ $classes->count() }}</span> daripada <span class="font-bold text-slate-800">{{ $classes->count() }}</span> rekod penugasan</div>
                    <span class="text-slate-400">Sesi {{ $filters['academic_session'] }}</span>
                </div>
            </section>

            @if($managedRepeatClass)
            <section
                id="manage-students-section"
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-card"
            >

                <div class="border-b border-slate-100 bg-slate-50/60 px-6 py-5">
                    <h2 class="text-lg font-bold text-midnight">
                        Manage Students — Repeat Class
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $managedRepeatClass->class_name }}
                        |
                        {{ $managedRepeatClass->subject->subject_code ?? '—' }}
                    </p>
                </div>

                <div class="overflow-x-auto p-6">
                    <p class="mb-4 text-sm text-slate-600">
                        Approved repeat students:
                        <strong>{{ $repeatStudents->count() }}</strong>
                    </p>

                    <table class="w-full text-left text-sm">
                        <thead class="border-b bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3">Student ID</th>
                                <th class="px-4 py-3">Student</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse($repeatStudents as $registration)
                                <tr>
                                    <td class="px-4 py-3">
                                        {{ $registration->student_id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $registration->student->student_name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="font-semibold text-emerald-700">
                                            Approved
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="px-4 py-8 text-center text-slate-500">
                                        Belum ada pelajar yang diluluskan
                                        untuk repeat class ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
            @endif
        </div>
    </main>
</div>

<script>

function exportAssignmentsCsv() {
    const table = document.getElementById('subjectAssignmentsTable');
    if (!table) return;
    const rows = Array.from(table.querySelectorAll('tr'));
    const csv = rows.map(row => Array.from(row.querySelectorAll('th,td')).map(cell => {
        const select = cell.querySelector('select');
        const value = select ? select.options[select.selectedIndex]?.text : cell.innerText;
        return '"' + String(value || '').replace(/"/g, '""').replace(/\s+/g, ' ').trim() + '"';
    }).join(',')).join('\r\n');
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'subject-class-assignments.csv';
    link.click();
    URL.revokeObjectURL(url);
}

document.addEventListener('DOMContentLoaded', function () {
    const manageStudentsSection = document.getElementById('manage-students-section');

    if (manageStudentsSection) {
        manageStudentsSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
});
</script>
</body>
</html>
