<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Scheme Management | KPMB Student Hub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary:'#00132D', 'primary-container':'#082344', secondary:'#E6B422', 'on-secondary':'#211700', 'secondary-fixed':'#FFD75E', 'secondary-container':'#E6B422', 'surface-container-low':'#F5F3F2', 'surface-container-lowest':'#FFFFFF', 'surface-container-highest':'#DCE2EA', 'on-primary':'#F8FAFC' }, fontFamily: { headline:['Hanken Grotesk','sans-serif'] } } } };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0,1&display=swap" rel="stylesheet">
    <style>body{font-family:'Hanken Grotesk',sans-serif}.navy{background:#002147}.gold{color:#b58a00}.field{width:100%;border:1px solid #c4c6cf;border-radius:.5rem;padding:.65rem .75rem;background:white}.field:focus{outline:2px solid #ffe088;border-color:#b58a00}
        .sidebar { background-color:#00132D !important; color:#F8FAFC !important; }
        .sidebar .text-white { color:#fff !important; }
        .sidebar .text-slate-200 { color:#e2e8f0 !important; }
        .sidebar .text-slate-300 { color:#cbd5e1 !important; }
        .sidebar .text-slate-400 { color:#94a3b8 !important; }
        .sidebar .text-secondary-fixed { color:#FFD75E !important; }
        .sidebar > div:first-child > div:first-child { background-color:rgba(8,35,68,.75) !important; }
        .topbar { background:rgba(255,255,255,.96) !important; color:#0f172a; }
        .material-symbols-outlined { font-family:'Material Symbols Outlined'; font-weight:normal; font-style:normal; font-size:24px; line-height:1; letter-spacing:normal; text-transform:none; display:inline-block; white-space:nowrap; word-wrap:normal; direction:ltr; -webkit-font-feature-settings:'liga'; -webkit-font-smoothing:antialiased; }
</style>
</head>
<body class="bg-[#fcf9f8] text-slate-800 min-h-screen">
<div class="min-h-screen md:flex">
    @php
    $userName = auth()->user()->name ?? 'Pegawai UPP';
    $displaySession = $academicSession ?? $currentAcademicSession ?? 'Sesi akademik belum ditetapkan';

    $uppSidebarGroups = [
        [
            'label' => 'PENGURUSAN UTAMA',
            'items' => [
                ['label' => 'Dashboard UPP', 'icon' => 'dashboard', 'url' => '/upp/dashboard', 'patterns' => ['upp/dashboard']],
            ],
        ],
        [
            'label' => 'PENGURUSAN PELAJAR & PENSYARAH',
            'items' => [
                ['label' => 'Pengurusan Pelajar', 'icon' => 'groups', 'url' => '/upp/students', 'patterns' => ['upp/students*']],
                ['label' => 'Pengurusan Pensyarah', 'icon' => 'badge', 'url' => '/upp/lecturers', 'patterns' => ['upp/lecturers*']],
            ],
        ],
        [
            'label' => 'PENGURUSAN AKADEMIK',
            'items' => [
                ['label' => 'Pengurusan Subjek', 'icon' => 'menu_book', 'url' => '/upp/subjects', 'patterns' => ['upp/subjects*']],
                ['label' => 'Pengurusan Kelas', 'icon' => 'meeting_room', 'url' => '/upp/classes', 'patterns' => ['upp/classes*']],
                ['label' => 'Skim Penilaian', 'icon' => 'fact_check', 'url' => '/upp/assessment-schemes', 'patterns' => ['upp/assessment-schemes*']],
            ],
        ],
        [
            'label' => 'PENDAFTARAN & PEMANTAUAN',
            'items' => [
                ['label' => 'Pemantauan Pendaftaran', 'icon' => 'how_to_reg', 'url' => '/upp/subject-registrations', 'patterns' => ['upp/subject-registrations*']],
                ['label' => 'Laporan Pendaftaran', 'icon' => 'summarize', 'url' => '/upp/registration-report', 'patterns' => ['upp/registration-report*']],
            ],
        ],
        [
            'label' => 'KEPUTUSAN & LAPORAN',
            'items' => [
                ['label' => 'Laporan Keputusan', 'icon' => 'analytics', 'url' => '/upp/result-report', 'patterns' => ['upp/result-report*']],
            ],
        ],
    ];
@endphp

@include('upp.partials.sidebar')
@include('upp.partials.topbar')
    <main class="md:ml-72 flex-1 px-5 pb-8 pt-28 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-6 mb-6">
                <div><div class="text-xs uppercase tracking-widest gold font-bold mb-2">Evaluation &amp; Records</div><h1 class="text-3xl font-extrabold text-[#002147]">Assessment Scheme Management</h1><p class="mt-2 text-slate-500">Review assessment schemes and monitor their weightage for each subject and academic session.</p></div>
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm"><strong class="text-[#002147]">Monitoring rule</strong><div class="text-slate-600">Check that total weight equals 100%.</div></div>
            </div>

            @if(session('success'))<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-800 text-sm">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-red-800 text-sm">{{ session('error') }}</div>@endif
            @if($errors->any())<div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-red-800 text-sm"><strong>Please fix these errors:</strong><ul class="list-disc pl-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-7">
                <div class="navy text-white p-5 flex items-center gap-3">
                    <span aria-hidden="true" class="text-2xl text-yellow-200">◉</span>
                    <div>
                        <h2 class="font-bold text-lg">Assessment Scheme Monitoring</h2>
                        <p class="text-blue-100 text-sm">View schemes and monitor their status. Only the assigned Subject Coordinator can create or manage a scheme.</p>
                    </div>
                </div>
                <div class="p-5 text-sm text-slate-600">
                    UPP access is read-only on this page. You can search schemes, review assessment components and check their total weightage without changing the records.
                </div>
            </section>

            <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-200"><h2 class="text-lg font-bold text-[#002147]">Existing Schemes</h2><p class="text-sm text-slate-500 mt-1">Open a scheme to review its assessment components and status.</p></div>
                <form method="GET" action="{{ route('upp.assessment-schemes.index') }}" class="p-4 bg-slate-50 border-b grid grid-cols-1 md:grid-cols-12 gap-3">
                    <input class="field md:col-span-7" name="search" value="{{ $search }}" placeholder="Search subject code, subject name or session">
                    <select class="field md:col-span-3" name="status"><option value="">All statuses</option><option value="draft" @selected($status==='draft')>Draft</option><option value="active" @selected($status==='active')>Active</option><option value="archived" @selected($status==='archived')>Archived</option></select>
                    <div class="md:col-span-2 flex gap-2"><button class="navy text-white rounded-lg px-4 py-2 text-sm font-semibold">Search</button><a class="border rounded-lg px-3 py-2 text-sm bg-white" href="{{ route('upp.assessment-schemes.index') }}">Clear</a></div>
                </form>
                <div class="overflow-x-auto"><table class="w-full min-w-[760px] text-sm"><thead class="navy text-white"><tr><th class="p-3 text-left">Subject</th><th class="p-3 text-left">Session</th><th class="p-3 text-center">Components</th><th class="p-3 text-center">Total Weight</th><th class="p-3 text-center">Status</th><th class="p-3 text-center">Action</th></tr></thead><tbody>
                    @forelse($schemes as $scheme)
                    @php($weight = (float) $scheme->assessments->sum('weight_percentage'))
                    <tr class="border-t hover:bg-amber-50/30"><td class="p-3"><div class="font-bold text-[#002147]">{{ $scheme->subject->subject_code ?? 'Unknown subject' }}</div><div class="text-slate-500">{{ $scheme->subject->subject_name ?? '' }}</div></td><td class="p-3">{{ $scheme->academic_session }}</td><td class="p-3 text-center">{{ $scheme->assessments->count() }}</td><td class="p-3 text-center"><span class="{{ abs($weight-100) < 0.001 ? 'text-emerald-700' : 'text-amber-700' }} font-bold">{{ number_format($weight, 2) }}%</span></td><td class="p-3 text-center"><span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $scheme->status==='active' ? 'bg-emerald-100 text-emerald-800' : ($scheme->status==='archived' ? 'bg-slate-200 text-slate-700' : 'bg-amber-100 text-amber-800') }}">{{ ucfirst($scheme->status) }}</span></td><td class="p-3 text-center"><a class="inline-flex items-center gap-1 rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold hover:bg-slate-50" href="{{ route('upp.assessment-schemes.show', $scheme->scheme_id) }}"><span aria-hidden="true" class="text-sm">◉</span> View</a></td></tr>
                    @empty
                    <tr><td colspan="6" class="p-8 text-center text-slate-500">No assessment schemes found.</td></tr>
                    @endforelse
                </tbody></table></div>
                <div class="p-4 border-t bg-slate-50 flex flex-col sm:flex-row items-center justify-between gap-2 text-sm"><span class="text-slate-500">Showing {{ $schemes->firstItem() ?? 0 }}–{{ $schemes->lastItem() ?? 0 }} of {{ $schemes->total() }} schemes</span>{{ $schemes->links() }}</div>
            </section>
        </div>
    </main>
</div>

</body>
</html>
