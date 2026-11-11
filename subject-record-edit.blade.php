<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Subject Record | KPMB Student Hub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: {
            colors: {
                'primary-container': '#002147', primary: '#000a1e', secondary: '#735c00',
                'secondary-container': '#fed65b', surface: '#fcf9f8',
                'surface-container-low': '#f6f3f2', 'surface-container-lowest': '#ffffff',
                'surface-container': '#f0eded', 'surface-container-high': '#eae7e7',
                'on-surface': '#1c1b1b', 'on-surface-variant': '#44474e',
                'outline-variant': '#c4c6cf', outline: '#74777f'
            },
            fontFamily: { headline: ['Hanken Grotesk'], label: ['Hanken Grotesk'], body: ['Source Serif 4'] }
        } } };
    </script>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen">
    @php
        $userName = auth()->user()->name ?? 'Pegawai UPP';
        $displaySession = $academicSession ?? $currentAcademicSession ?? 'Sesi akademik belum ditetapkan';
        $pageTitle = 'Edit Subject Record';

        $uppSidebarGroups = [
            ['label' => 'PENGURUSAN UTAMA', 'items' => [
                ['label' => 'Dashboard UPP', 'icon' => 'dashboard', 'url' => '/upp/dashboard', 'patterns' => ['upp/dashboard']],
            ]],
            ['label' => 'PENGURUSAN PELAJAR & PENSYARAH', 'items' => [
                ['label' => 'Pengurusan Pelajar', 'icon' => 'groups', 'url' => '/upp/students', 'patterns' => ['upp/students*']],
                ['label' => 'Pengurusan Pensyarah', 'icon' => 'badge', 'url' => '/upp/lecturers', 'patterns' => ['upp/lecturers*']],
            ]],
            ['label' => 'PENGURUSAN AKADEMIK', 'items' => [
                ['label' => 'Pengurusan Subjek', 'icon' => 'menu_book', 'url' => '/upp/subjects', 'patterns' => ['upp/subjects*']],
                ['label' => 'Pengurusan Kelas', 'icon' => 'meeting_room', 'url' => '/upp/classes', 'patterns' => ['upp/classes*']],
                ['label' => 'Skim Penilaian', 'icon' => 'fact_check', 'url' => '/upp/assessment-schemes', 'patterns' => ['upp/assessment-schemes*']],
            ]],
            ['label' => 'PENDAFTARAN & PEMANTAUAN', 'items' => [
                ['label' => 'Pemantauan Pendaftaran', 'icon' => 'how_to_reg', 'url' => '/upp/subject-registrations', 'patterns' => ['upp/subject-registrations*']],
                ['label' => 'Laporan Pendaftaran', 'icon' => 'summarize', 'url' => '/upp/registration-report', 'patterns' => ['upp/registration-report*']],
            ]],
            ['label' => 'KEPUTUSAN & LAPORAN', 'items' => [
                ['label' => 'Laporan Keputusan', 'icon' => 'analytics', 'url' => '/upp/result-report', 'patterns' => ['upp/result-report*']],
            ]],
        ];
    @endphp

    @include('upp.partials.sidebar')
    <div class="pl-72 min-h-screen flex flex-col">
        @include('upp.partials.topbar')
        <main class="flex-1 px-6 py-8 pt-24">
            <div class="max-w-4xl mx-auto">
                <div class="mb-7 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-outline-variant/50 pb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl bg-primary-container flex items-center justify-center border-2 border-secondary/50">
                            <span class="material-symbols-outlined text-secondary-container text-3xl">edit_document</span>
                        </div>
                        <div>
                            <p class="text-xs font-label font-semibold tracking-widest text-secondary uppercase">UPP Registry</p>
                            <h1 class="text-3xl font-headline font-bold text-primary">Edit Subject Record</h1>
                            <p class="text-sm font-label text-on-surface-variant">Update academic subject information</p>
                        </div>
                    </div>
                    <a href="{{ route('upp.subjects.index') }}" class="inline-flex items-center gap-2 h-10 px-4 rounded border border-outline-variant bg-surface-container-lowest text-primary font-label text-sm font-semibold hover:bg-surface-container transition">
                        <span class="material-symbols-outlined text-lg">arrow_back</span> Back to Subjects
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-label text-red-800">
                        <p class="font-bold mb-1">Please correct the following errors:</p>
                        <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <section class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 shadow-sm overflow-hidden">
                    <div class="h-1 bg-gradient-to-r from-primary-container via-secondary to-primary-container"></div>
                    <form action="{{ route('upp.subjects.update', $subject->subject_id) }}" method="POST" class="p-6 lg:p-8 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="subject_code" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Subject Code</label>
                                <input id="subject_code" name="subject_code" type="text" maxlength="20" required value="{{ old('subject_code', $subject->subject_code) }}" class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                @error('subject_code')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="credit_hour" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Credit Hour</label>
                                <input id="credit_hour" name="credit_hour" type="number" min="1" required value="{{ old('credit_hour', $subject->credit_hour) }}" class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                @error('credit_hour')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="subject_name" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Subject Name</label>
                                <input id="subject_name" name="subject_name" type="text" maxlength="100" required value="{{ old('subject_name', $subject->subject_name) }}" class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                @error('subject_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="semester" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Semester</label>
                                <input id="semester" name="semester" type="number" min="1" required value="{{ old('semester', $subject->semester) }}" class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                @error('semester')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="status" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Status</label>
                                <select id="status" name="status" required class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                    <option value="active" @selected(old('status', $subject->status) === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status', $subject->status) === 'inactive')>Inactive</option>
                                </select>
                                @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="coordinator_lecturer_id" class="block mb-2 text-xs font-label font-bold uppercase tracking-wider text-on-surface">Course Coordinator</label>
                            <select id="coordinator_lecturer_id" name="coordinator_lecturer_id" class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white text-sm font-label focus:border-secondary focus:ring-2 focus:ring-secondary/20">
                                <option value="">Not assigned</option>
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->lecturer_id }}" @selected(old('coordinator_lecturer_id', $subject->coordinator_lecturer_id) == $lecturer->lecturer_id)>
                                        {{ $lecturer->lecturer_name }} ({{ $lecturer->lecturer_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('coordinator_lecturer_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            <p class="mt-2 text-xs font-label text-on-surface-variant">Assign a lecturer to manage the Scheme of Work for this subject. A lecturer may coordinate multiple subjects.</p>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-outline-variant/40 pt-5">
                            <p class="text-xs font-label text-on-surface-variant">Subject ID: {{ $subject->subject_id }}</p>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('upp.subjects.index') }}" class="h-10 px-4 rounded border border-outline-variant text-on-surface-variant font-label text-sm font-semibold flex items-center hover:bg-surface-container transition">Cancel</a>
                                <button type="submit" class="h-10 px-5 rounded bg-primary-container hover:bg-primary text-white font-label text-sm font-semibold flex items-center gap-2 transition">
                                    <span class="material-symbols-outlined text-lg">save</span> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
