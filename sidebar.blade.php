@php
    $sidebarUser = auth()->user();
    $sidebarLecturer = $sidebarUser?->lecturer;
    $isCoordinator = $sidebarLecturer && $sidebarLecturer->coordinatorSubjects()->exists();
@endphp
<aside class="lecturer-sidebar-shell fixed left-0 top-0 h-full w-72 bg-white z-50 flex flex-col justify-between py-6 border-r border-surface-container-highest/60 shadow-[0_2px_12px_rgba(0,33,71,0.03)]">
    <div class="flex flex-col gap-6 px-5">
        <a href="{{ route('lecturer.dashboard') }}" class="flex items-center gap-3 px-2 py-1">
            <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-secondary-fixed shadow-sm"><span class="material-symbols-outlined text-[24px]">school</span></div>
            <div class="flex flex-col"><span class="font-headline font-extrabold text-lg text-primary tracking-tight leading-tight">KPMB Student Hub</span><span class="font-label text-[10px] font-bold text-secondary uppercase tracking-widest">Portal Pensyarah</span></div>
        </a>
        <div class="flex flex-col gap-6">
            <div class="flex flex-col gap-1.5">
                <div class="px-3 font-label text-[11px] font-bold uppercase tracking-wider text-outline">Academic Management</div>
                <nav class="flex flex-col gap-1">
                    <a href="{{ route('lecturer.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.dashboard') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.dashboard') ? 'text-secondary-fixed' : 'text-outline' }}">space_dashboard</span><span class="font-label text-sm tracking-tight">Dashboard</span></a>
                    <a href="{{ route('lecturer.record-marks.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.record-marks.*') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.record-marks.*') ? 'text-secondary-fixed' : 'text-outline' }}">edit_document</span><span class="font-label text-sm">Record Student Marks</span></a>
                    <a href="{{ route('lecturer.subject-registrations.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.subject-registrations.*') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.subject-registrations.*') ? 'text-secondary-fixed' : 'text-outline' }}">how_to_reg</span><span class="font-label text-sm">Subject Registrations / Mentee</span></a>
                    <a href="{{ route('lecturer.student-records.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.student-records.*') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.student-records.*') ? 'text-secondary-fixed' : 'text-outline' }}">school</span><span class="font-label text-sm">View Student Record</span></a>
                    <a href="{{ route('lecturer.performance-report.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.performance-report.*') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.performance-report.*') ? 'text-secondary-fixed' : 'text-outline' }}">query_stats</span><span class="font-label text-sm">Class Performance Report</span></a>
                    @if($isCoordinator)
                    <a href="{{ route('lecturer.assessment-schemes.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg {{ request()->routeIs('lecturer.assessment-schemes.*') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary font-medium' }} transition-all"><span class="flex items-center gap-3"><span class="material-symbols-outlined text-[20px] {{ request()->routeIs('lecturer.assessment-schemes.*') ? 'text-secondary-fixed' : 'text-outline' }}">assignment</span><span class="font-label text-sm">Assessment Schemes</span></span><span class="inline-flex items-center px-1.5 py-0.5 rounded bg-surface-container-highest text-primary font-label text-[9px] font-bold uppercase tracking-tight">Coordinator</span></a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
    <div class="px-5 pt-4 border-t border-surface-container-high/60">
        <div class="p-3 bg-surface-container-low rounded-xl border border-surface-container-high/70 flex items-center gap-2.5 mb-3"><span class="material-symbols-outlined text-primary text-xl">verified_user</span><div><span class="block text-xs font-bold text-primary">Lecturer Access</span><span class="block text-[11px] text-on-surface-variant">KPMB Academic Records</span></div></div>
        <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-red-700 hover:bg-red-50 text-sm font-semibold"><span class="material-symbols-outlined text-xl">logout</span>Log Keluar</button></form>
        <div class="flex justify-between px-2 pt-3 mt-2 border-t border-surface-container-high/40 text-xs text-outline"><span>KPMB Student Hub</span><span>Lecturer</span></div>
    </div>
</aside>

<style>
.lecturer-sidebar-shell{font-family:"Hanken Grotesk",sans-serif!important;background:#fff!important;border-color:#e5e7eb!important;color:#002147}
.lecturer-sidebar-shell .text-primary{color:#002147!important}
.lecturer-sidebar-shell .bg-primary{background:#002147!important}
.lecturer-sidebar-shell .text-secondary-fixed{color:#fed65b!important}
</style>
