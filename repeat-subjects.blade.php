<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            primary: '#000a1e', secondary: '#735c00', surface: '#fcf9f8',
            'surface-container-low': '#f6f3f2', 'on-surface-variant': '#44474e',
            'outline-variant': '#c4c6cf'
        }, fontFamily: { headline: ['Hanken Grotesk'], body: ['Work Sans'] } } } };
    </script>
    <title>Repeat Subject</title>
</head>
<body class="bg-surface text-[#1c1b1b] font-body antialiased">
@include('student.partials.sidebar')
<div class="ml-0 md:ml-72 min-h-screen flex flex-col">
    @include('student.partials.topbar')
    <main class="p-5 lg:p-10 flex-1">
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-widest text-secondary font-bold">Academic Services</p>
                    <h1 class="text-3xl font-extrabold text-primary mt-1">Repeat Subject Application</h1>
                    <p class="text-sm text-on-surface-variant mt-2">Semak subjek yang layak diulang berdasarkan rekod akademik dan programme structure anda.</p>
                </div>
                <a href="{{ route('student.dashboard') }}" class="text-sm font-bold text-primary border border-outline-variant rounded px-4 py-2 hover:bg-surface-container-low">Dashboard</a>
            </div>

            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @if($pageMessage)
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">{{ $pageMessage }}</div>
            @else
                <div class="rounded-xl border border-outline-variant bg-white p-5">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <div class="text-sm text-on-surface-variant">
                            <p class="font-bold text-primary">Syarat kelayakan</p>
                            <p class="mt-1">Semester 1–4: gred F atau PB kurang daripada 45%. Semester 5: mengikut konfigurasi programme structure. Semester 6: gred F sahaja.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($candidates as $candidate)
                        <article class="rounded-xl border border-outline-variant bg-white p-5 shadow-sm">
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                <div class="space-y-2">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-xs font-bold rounded bg-primary text-white px-3 py-1">Semester {{ $candidate->mapping->semester }}</span>
                                        <span class="text-xs font-semibold text-secondary">{{ $candidate->decision['basis'] === 'grade_f' ? 'Gred F' : 'PB bawah 45%' }}</span>
                                    </div>
                                    <h2 class="text-lg font-extrabold text-primary">{{ $candidate->subject->subject_code }} — {{ $candidate->subject->subject_name }}</h2>
                                    <p class="text-sm text-on-surface-variant">
                                        Gred rekod: <strong>{{ $candidate->decision['grade'] }}</strong>
                                        @if($candidate->decision['pb_percentage'] !== null)
                                            · Markah PB: <strong>{{ number_format($candidate->decision['pb_percentage'], 2) }}%</strong>
                                        @endif
                                        · Semester semasa: {{ $student->semester }}
                                    </p>
                                </div>
                                @if($candidate->existing_application)
                                    <span class="inline-flex rounded-full bg-amber-100 text-amber-800 px-3 py-1.5 text-xs font-bold">
                                        Permohonan {{ ucfirst($candidate->existing_application->application_status) }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-5 border-t border-outline-variant pt-4">
                                <h3 class="text-sm font-bold text-primary mb-3">Repeat Class Available</h3>
                                @if($candidate->existing_application)
                                    <p class="text-sm text-on-surface-variant">Anda sudah mempunyai permohonan aktif untuk subjek ini.</p>
                                @elseif($candidate->classes->isEmpty())
                                    <p class="text-sm text-on-surface-variant">Belum ada repeat class disediakan oleh UPP untuk subjek ini.</p>
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($candidate->classes as $class)
                                            <div class="rounded-lg border border-outline-variant bg-surface-container-low p-4 flex flex-col gap-3">
                                                <div>
                                                    <p class="font-bold text-primary">{{ $class->class_name }}</p>
                                                    <p class="text-xs text-on-surface-variant mt-1">Sesi {{ $class->academic_session }}</p>
                                                    <p class="text-xs text-on-surface-variant">Pensyarah: {{ $class->lecturerDirectory?->lecturer_name ?? 'Belum ditetapkan' }}</p>
                                                </div>
                                                <form method="POST" action="{{ route('student.repeat-subjects.store') }}" onsubmit="return confirm('Hantar permohonan untuk {{ addslashes($candidate->subject->subject_code) }}?')">
                                                    @csrf
                                                    <input type="hidden" name="class_id" value="{{ $class->class_id }}">
                                                    <button type="submit" class="w-full rounded bg-primary text-white px-4 py-2.5 text-sm font-bold hover:bg-[#002147]">Apply for Repeat Class</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="rounded-xl border border-outline-variant bg-white p-10 text-center">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant">task_alt</span>
                            <h2 class="mt-3 text-lg font-bold text-primary">Tiada subjek repeat yang layak</h2>
                            <p class="mt-1 text-sm text-on-surface-variant">Buat masa ini tiada rekod kegagalan yang memenuhi syarat repeat berdasarkan programme structure anda.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </main>
</div>
</body>
</html>
