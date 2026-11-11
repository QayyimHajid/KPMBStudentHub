<!DOCTYPE html>
<html class="light" lang="ms">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="web_dashboard" name="shell-type">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300..900;1,300..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {darkMode:'class',theme:{extend:{
            colors:{'surface-bright':'#fcf9f8','error':'#ba1a1a','on-background':'#1c1b1b','primary':'#000a1e','on-error-container':'#93000a','surface':'#fcf9f8','surface-container-high':'#eae7e7','secondary-fixed':'#ffe088','secondary-container':'#fed65b','secondary':'#735c00','on-secondary-container':'#745c00','surface-container-low':'#f6f3f2','primary-container':'#002147','surface-container-highest':'#e5e2e1','surface-container-lowest':'#ffffff','on-surface':'#1c1b1b','on-primary':'#ffffff','on-error':'#ffffff','error-container':'#ffdad6','on-surface-variant':'#44474e','outline':'#74777f','outline-variant':'#c4c6cf','background':'#fcf9f8'},
            borderRadius:{DEFAULT:'0.25rem',lg:'0.5rem',xl:'0.75rem',full:'9999px'},
            fontFamily:{headline:['Hanken Grotesk'],body:['Source Serif 4']}
        }}};
    </script>
</head>
<body class="bg-background font-body text-on-surface antialiased">
@php
    $userName = auth()->user()->name ?? 'Pegawai UPP';
    $displaySession = $academicSession ?? $currentAcademicSession ?? 'Sesi akademik belum ditetapkan';
@endphp
@include('upp.partials.sidebar')
<div class="pl-72">
    @include('upp.partials.topbar')
    <main class="relative min-h-screen bg-background pt-20">
        <div class="flex w-full flex-col space-y-6 px-8 py-8">
            <section class="relative overflow-hidden rounded-xl border border-surface-container-high/60 bg-surface-container-lowest p-6 shadow-[0_4px_20px_rgba(0,33,71,0.06)]">
                <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-gradient-to-br from-blue-100/60 via-amber-100/40 to-transparent blur-3xl"></div>
                <div class="relative z-10 flex flex-col justify-between gap-4 md:flex-row md:items-center">
                    <div class="space-y-2">
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-amber-300/40 bg-primary text-amber-200 shadow-sm"><span class="material-symbols-outlined text-2xl">fact_check</span></div>
                            <h1 class="font-headline text-3xl font-bold tracking-tight text-primary">Semakan Permohonan Repeat Subject</h1>
                        </div>
                        <p class="max-w-3xl text-base leading-relaxed text-on-surface-variant">Semak kelayakan, kelas pilihan dan rekod akademik sebelum meluluskan atau menolak permohonan pelajar.</p>
                        <a href="{{ route('upp.dashboard') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-amber-300/50 bg-amber-50/60 px-3 py-1.5 font-headline text-xs font-semibold text-amber-800 transition hover:bg-amber-100"><span class="material-symbols-outlined text-base">arrow_back</span>Kembali ke Dashboard UPP</a>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl border border-surface-container-high/60 bg-surface-container-low/80 p-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-container text-amber-200"><span class="material-symbols-outlined text-2xl">assignment_turned_in</span></div>
                        <div><div class="font-headline text-[11px] font-semibold uppercase tracking-wider text-on-surface-variant">UPP Review</div><div class="font-headline text-sm font-bold text-primary">Repeat Subject</div></div>
                    </div>
                </div>
            </section>

            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800"><span class="material-symbols-outlined">check_circle</span><span>{{ session('success') }}</span></div>
            @endif
            @if ($errors->has('application'))
                <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800"><span class="material-symbols-outlined">error</span><span>{{ $errors->first('application') }}</span></div>
            @endif

            <section class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                @foreach ([['key'=>'pending','label'=>'Menunggu Semakan','icon'=>'pending_actions','style'=>'amber'],['key'=>'approved','label'=>'Diluluskan','icon'=>'task_alt','style'=>'emerald'],['key'=>'rejected','label'=>'Ditolak','icon'=>'cancel','style'=>'red']] as $card)
                    <a href="{{ route('upp.repeat-subject-applications.index', ['status'=>$card['key'], 'search'=>$search]) }}" class="rounded-xl border p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md {{ $status === $card['key'] ? 'border-primary bg-surface-container-low' : 'border-surface-container-high/70 bg-white' }}">
                        <div class="flex items-center justify-between"><span class="font-headline text-xs font-semibold text-on-surface-variant">{{ $card['label'] }}</span><span class="material-symbols-outlined text-xl text-primary">{{ $card['icon'] }}</span></div>
                        <div class="mt-2 font-headline text-3xl font-bold text-primary">{{ $counts[$card['key']] ?? 0 }}</div>
                    </a>
                @endforeach
            </section>

            <section class="rounded-xl border border-surface-container-high/60 bg-white p-5 shadow-[0_2px_12px_rgba(0,33,71,0.04)]">
                <form method="GET" action="{{ route('upp.repeat-subject-applications.index') }}" class="grid grid-cols-1 items-end gap-4 md:grid-cols-[1fr_220px_auto]">
                    <div>
                        <label for="search" class="mb-1.5 block font-headline text-xs font-semibold text-on-surface-variant">Carian pelajar, subjek atau kelas</label>
                        <div class="relative"><span class="material-symbols-outlined absolute left-3 top-2.5 text-lg text-outline">search</span><input id="search" name="search" value="{{ $search }}" placeholder="ID / nama pelajar, kod subjek, kelas..." class="h-10 w-full rounded-lg border border-surface-container-high bg-surface-container-low pl-10 pr-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20"></div>
                    </div>
                    <div>
                        <label for="status" class="mb-1.5 block font-headline text-xs font-semibold text-on-surface-variant">Status permohonan</label>
                        <select id="status" name="status" class="h-10 w-full rounded-lg border border-surface-container-high bg-surface-container-low px-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="pending" @selected($status === 'pending')>Menunggu Semakan</option>
                            <option value="approved" @selected($status === 'approved')>Diluluskan</option>
                            <option value="rejected" @selected($status === 'rejected')>Ditolak</option>
                            <option value="" @selected($status === '')>Semua Status</option>
                        </select>
                    </div>
                    <div class="flex gap-2"><button class="inline-flex h-10 items-center gap-1.5 rounded-lg bg-primary px-4 font-headline text-xs font-semibold text-white transition hover:bg-primary-container"><span class="material-symbols-outlined text-base">filter_list</span>Tapis</button><a href="{{ route('upp.repeat-subject-applications.index') }}" class="inline-flex h-10 items-center rounded-lg border border-surface-container-high px-3 font-headline text-xs font-semibold text-on-surface-variant hover:bg-surface-container-low">Reset</a></div>
                </form>
            </section>

            <section class="overflow-hidden rounded-xl border border-surface-container-high/60 bg-white shadow-[0_2px_12px_rgba(0,33,71,0.04)]">
                <div class="flex flex-col justify-between gap-2 border-b border-surface-container-high bg-surface-container-low/60 px-5 py-4 sm:flex-row sm:items-center">
                    <div><h2 class="font-headline text-lg font-bold text-primary">Senarai Permohonan</h2><p class="text-xs text-on-surface-variant">{{ $applications->total() }} rekod ditemui</p></div>
                    <span class="rounded-full border border-surface-container-high bg-white px-3 py-1 font-headline text-xs font-semibold text-on-surface-variant">{{ $status === '' ? 'Semua status' : ucfirst($status) }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1100px] border-collapse text-left">
                        <thead><tr class="border-b border-surface-container-high bg-surface-container text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">
                            <th class="px-4 py-3">No.</th><th class="px-4 py-3">Pelajar</th><th class="px-4 py-3">Subjek</th><th class="px-4 py-3">Kelas Repeat</th><th class="px-4 py-3 text-center">Semester</th><th class="px-4 py-3">Bukti Kelayakan</th><th class="px-4 py-3">Tarikh Mohon</th><th class="px-4 py-3">Status / Tindakan</th>
                        </tr></thead>
                        <tbody class="divide-y divide-surface-container font-headline text-xs">
                        @forelse ($applications as $application)
                            @php
                                $isPending = $application->application_status === 'pending';
                                $statusText = ['pending'=>'Menunggu Semakan','approved'=>'Diluluskan','rejected'=>'Ditolak'][$application->application_status] ?? $application->application_status;
                                $statusStyle = ['pending'=>'border-amber-200 bg-amber-50 text-amber-800','approved'=>'border-emerald-200 bg-emerald-50 text-emerald-800','rejected'=>'border-red-200 bg-red-50 text-red-800'][$application->application_status] ?? 'border-slate-200 bg-slate-50 text-slate-700';
                            @endphp
                            <tr class="align-top transition hover:bg-surface-container-low/60">
                                <td class="px-4 py-4 font-semibold text-on-surface-variant">{{ $applications->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-4"><div class="font-bold text-primary">{{ $application->student->student_name ?? 'Nama tidak tersedia' }}</div><div class="mt-1 font-mono text-[11px] text-on-surface-variant">{{ $application->student_id }}</div><div class="mt-1 text-[11px] text-on-surface-variant">Semester semasa: {{ $application->student_current_semester }}</div></td>
                                <td class="px-4 py-4"><div class="font-bold text-primary">{{ $application->subject->subject_code ?? '-' }}</div><div class="mt-1 max-w-[190px] whitespace-normal text-on-surface-variant">{{ $application->subject->subject_name ?? 'Subjek tidak tersedia' }}</div><div class="mt-1 text-[11px] text-on-surface-variant">Semester asal: {{ $application->subject_semester }}</div></td>
                                <td class="px-4 py-4"><div class="font-semibold text-primary">{{ $application->classModel->class_name ?? 'Kelas tidak tersedia' }}</div><div class="mt-1 text-[11px] text-on-surface-variant">Sesi: {{ $application->academic_session }}</div></td>
                                <td class="px-4 py-4 text-center"><span class="inline-flex rounded-md bg-surface-container px-2.5 py-1 font-bold text-primary">{{ $application->student_current_semester }}</span></td>
                                <td class="px-4 py-4"><div class="font-semibold text-primary">{{ strtoupper(str_replace('_',' ', $application->eligibility_basis ?? '-')) }}</div><div class="mt-1 text-[11px] text-on-surface-variant">Gred: {{ $application->eligibility_grade ?? '-' }}</div><div class="text-[11px] text-on-surface-variant">PB: {{ $application->pb_percentage !== null ? number_format((float)$application->pb_percentage, 2).'%' : '—' }}</div></td>
                                <td class="px-4 py-4 whitespace-nowrap text-on-surface-variant">{{ $application->submitted_at?->format('d/m/Y H:i') ?? $application->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-md border px-2.5 py-1 text-[11px] font-bold {{ $statusStyle }}">{{ $statusText }}</span>
                                    @if ($isPending)
                                        <div class="mt-3 flex flex-col gap-2">
                                            <form method="POST" action="{{ route('upp.repeat-subject-applications.approve', $application->repeat_application_id) }}" onsubmit="return confirm('Anda pasti mahu meluluskan permohonan ini? Rekod pendaftaran repeat akan diwujudkan.');">
                                                @csrf
                                                <input type="hidden" name="remarks" value="Diluluskan oleh UPP.">
                                                <button type="submit" class="inline-flex w-full items-center justify-center gap-1 rounded-lg bg-emerald-700 px-3 py-2 font-headline text-[11px] font-bold text-white transition hover:bg-emerald-800"><span class="material-symbols-outlined text-sm">check</span>Approve</button>
                                            </form>
                                            <button type="button" onclick="openRejectModal({{ $application->repeat_application_id }}, @js($application->student->student_name ?? $application->student_id), @js($application->subject->subject_code ?? 'subjek'))" class="inline-flex w-full items-center justify-center gap-1 rounded-lg border border-red-200 bg-red-50 px-3 py-2 font-headline text-[11px] font-bold text-red-700 transition hover:bg-red-100"><span class="material-symbols-outlined text-sm">close</span>Reject</button>
                                        </div>
                                    @else
                                        <div class="mt-2 space-y-1 text-[11px] text-on-surface-variant"><div>Disemak: {{ $application->reviewed_at?->format('d/m/Y H:i') ?? '-' }}</div><div>Oleh: {{ $application->reviewer->name ?? '-' }}</div>@if($application->remarks)<div class="max-w-[180px] whitespace-normal rounded bg-surface-container-low p-2">{{ $application->remarks }}</div>@endif</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-6 py-14 text-center"><div class="flex flex-col items-center gap-2 text-on-surface-variant"><span class="material-symbols-outlined text-4xl">inbox</span><span class="font-headline text-sm font-bold text-primary">Tiada permohonan ditemui</span><span>Tiada rekod untuk status atau carian yang dipilih.</span></div></td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-center justify-between gap-3 border-t border-surface-container-high bg-surface-container-low/50 px-5 py-4 text-xs sm:flex-row"><span class="text-on-surface-variant">Memaparkan {{ $applications->firstItem() ?? 0 }}–{{ $applications->lastItem() ?? 0 }} daripada {{ $applications->total() }} rekod</span><div>{{ $applications->links() }}</div></div>
            </section>
        </div>
    </main>
    <footer class="w-full bg-surface-container-low py-8"><div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-8 text-center sm:flex-row sm:text-left"><div><div class="font-headline text-sm font-bold text-primary">KPMB Student Hub <span class="font-normal text-on-surface-variant">• Unit Peperiksaan dan Persijilan (UPP)</span></div><p class="mt-1 text-xs text-on-surface-variant">© 2026 Unit Peperiksaan &amp; Persijilan. Hak Cipta Terpelihara.</p></div><a href="{{ route('upp.dashboard') }}" class="text-xs font-semibold text-on-surface-variant hover:text-primary">Dashboard UPP</a></div></footer>
</div>

<div id="rejectModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/50 p-4">
    <div class="w-full max-w-lg rounded-2xl border border-surface-container-high bg-white p-6 shadow-2xl">
        <div class="flex items-start justify-between gap-4"><div><h2 class="font-headline text-xl font-bold text-primary">Tolak Permohonan Repeat</h2><p id="rejectApplicant" class="mt-1 text-xs text-on-surface-variant"></p></div><button type="button" onclick="closeRejectModal()" class="rounded-lg p-1 text-on-surface-variant hover:bg-surface-container"><span class="material-symbols-outlined">close</span></button></div>
        <form id="rejectForm" method="POST" class="mt-5 space-y-4">
            @csrf
            <div><label for="rejectRemarks" class="mb-1.5 block font-headline text-xs font-semibold text-on-surface-variant">Sebab penolakan <span class="text-red-600">*</span></label><textarea id="rejectRemarks" name="remarks" rows="4" required maxlength="1000" class="w-full rounded-lg border border-surface-container-high bg-surface-container-low p-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Nyatakan sebab permohonan ditolak..."></textarea><p class="mt-1 text-[11px] text-on-surface-variant">Maksimum 1,000 aksara.</p></div>
            <div class="flex justify-end gap-2"><button type="button" onclick="closeRejectModal()" class="rounded-lg border border-surface-container-high px-4 py-2 font-headline text-xs font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button><button type="submit" class="rounded-lg bg-red-700 px-4 py-2 font-headline text-xs font-bold text-white hover:bg-red-800">Sahkan Penolakan</button></div>
        </form>
    </div>
</div>
<script>
    function openRejectModal(id, student, subject) {
        const modal = document.getElementById('rejectModal');
        document.getElementById('rejectForm').action = @json(url('/upp/repeat-subject-applications')) + '/' + id + '/reject';
        document.getElementById('rejectApplicant').textContent = student + ' • ' + subject;
        document.getElementById('rejectRemarks').value = '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.getElementById('rejectRemarks').focus();
    }
    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.getElementById('rejectModal')?.addEventListener('click', function (event) {
        if (event.target === this) closeRejectModal();
    });
</script>
</body>
</html>
