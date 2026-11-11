<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Scheme Details | KPMB Student Hub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        /* Define the theme tokens used by the original Gaya 1 sidebar/topbar. */
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00132D',
                        'primary-container': '#082344',
                        secondary: '#E6B422',
                        'on-secondary': '#211700',
                        'secondary-fixed': '#FFD75E',
                        'secondary-container': '#E6B422',
                        'surface-container-low': '#F5F3F2',
                        'surface-container-lowest': '#FFFFFF',
                        'surface-container-highest': '#DCE2EA',
                        'on-primary': '#F8FAFC'
                    },
                    fontFamily: {
                        headline: ['Hanken Grotesk', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0,1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        .navy { background: #00132D; }
        .field { width: 100%; border: 1px solid #c4c6cf; border-radius: .5rem; padding: .65rem .75rem; background: white; }
        .sidebar { background: #00132D; color: #f8fafc; }
        .topbar { background: rgba(255,255,255,.94); }
        .upp-sidebar-nav { scrollbar-width: thin; scrollbar-color: rgba(148,163,184,.45) transparent; }
        .upp-sidebar-nav::-webkit-scrollbar { width: 5px; }
        .upp-sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .upp-sidebar-nav::-webkit-scrollbar-thumb { background: rgba(148,163,184,.35); border-radius: 9999px; }
        .upp-sidebar-nav::-webkit-scrollbar-thumb:hover { background: rgba(203,213,225,.65); }
        @media (max-width: 767px) {
            .sidebar { width: 17rem; }
            .topbar { left: 0; }
        }
    
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

<div class="ml-0 md:ml-72 max-w-5xl mx-auto px-5 pb-8 pt-24 md:px-8 md:pt-28">
    <a href="{{ route('upp.assessment-schemes.index') }}" class="text-sm text-[#002147] font-semibold hover:underline">← Kembali ke Skim Penilaian</a>
    <header class="mt-5 mb-6 pb-5 border-b border-slate-200 flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div><div class="text-xs uppercase tracking-widest text-amber-700 font-bold">Skim Penilaian #{{ $scheme->scheme_id }}</div><h1 class="text-3xl font-extrabold text-[#002147] mt-2">{{ $scheme->subject->subject_code ?? 'Subject' }} — {{ $scheme->subject->subject_name ?? '' }}</h1><p class="text-slate-500 mt-2">Sesi akademik: <strong>{{ $scheme->academic_session }}</strong></p></div>
        <span class="rounded-full px-4 py-2 text-sm font-bold {{ $scheme->status==='active' ? 'bg-emerald-100 text-emerald-800' : ($scheme->status==='archived' ? 'bg-slate-200 text-slate-700' : 'bg-amber-100 text-amber-800') }}">{{ ucfirst($scheme->status) }}</span>
    </header>

    @php($totalWeight = (float) $scheme->assessments->sum('weight_percentage'))
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border rounded-xl p-5"><div class="text-xs uppercase tracking-wider text-slate-500">Komponen</div><div class="text-3xl font-extrabold text-[#002147] mt-2">{{ $scheme->assessments->count() }}</div></div>
        <div class="bg-white border rounded-xl p-5"><div class="text-xs uppercase tracking-wider text-slate-500">Jumlah Wajaran</div><div class="text-3xl font-extrabold mt-2 {{ abs($totalWeight-100)<0.001 ? 'text-emerald-700' : 'text-amber-700' }}">{{ number_format($totalWeight,2) }}%</div></div>
        <div class="bg-white border rounded-xl p-5"><div class="text-xs uppercase tracking-wider text-slate-500">Markah Direkodkan</div><div class="text-3xl font-extrabold text-[#002147] mt-2">{{ $scheme->assessments->sum(fn($assessment) => $assessment->marks->count()) }}</div></div>
    </section>

    <section class="bg-white rounded-xl border shadow-sm overflow-hidden mb-6">
        <div class="navy text-white p-4 font-bold">Assessment Komponen</div>
        <div class="overflow-x-auto"><table class="w-full min-w-[700px] text-sm"><thead class="bg-slate-50"><tr><th class="p-3 text-left">#</th><th class="p-3 text-left">Penilaian</th><th class="p-3 text-left">Kategori</th><th class="p-3 text-right">Markah Maksimum</th><th class="p-3 text-right">Wajaran</th><th class="p-3 text-left">Penerangan</th></tr></thead><tbody>
        @forelse($scheme->assessments as $assessment)
            <tr class="border-t"><td class="p-3">{{ $assessment->sort_order }}</td><td class="p-3 font-semibold">{{ $assessment->assessment_name }}</td><td class="p-3"><span class="inline-flex rounded-full px-2 py-1 text-xs font-bold {{ ($assessment->assessment_type ?? 'PB') === 'PA' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800' }}">{{ $assessment->assessment_type ?? 'PB' }}</span></td><td class="p-3 text-right">{{ number_format((float)$assessment->max_marks,2) }}</td><td class="p-3 text-right font-bold">{{ number_format((float)$assessment->weight_percentage,2) }}%</td><td class="p-3 text-slate-500">{{ $assessment->description ?: '—' }}</td></tr>
        @empty
            <tr><td colspan="6" class="p-6 text-center text-slate-500">Tiada komponen penilaian ditambah.</td></tr>
        @endforelse
        </tbody></table></div>
        @if($scheme->notes)<div class="border-t p-4 text-sm"><strong>Catatan:</strong> {{ $scheme->notes }}</div>@endif
    </section>

    <section class="bg-white border rounded-xl p-5 mb-6">
        <h2 class="text-lg font-bold text-[#002147] mb-1">Semakan UPP</h2>
        <p class="text-sm text-slate-600">Halaman ini untuk pemantauan sahaja. Perubahan skim penilaian, pengaktifan dan pengarkiban hanya boleh dilakukan oleh Penyelaras Subjek yang ditugaskan kepada subjek ini.</p>
    </section>
</div>

</body></html>
