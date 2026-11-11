<header class="fixed top-0 left-0 right-0 w-full z-[100] bg-[#fcf9f8] shadow-[0_1px_8px_rgba(0,10,30,0.08)]">
    <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-4 shrink-0" aria-label="Kolej Profesional MARA - Utama">
            <img alt="Logo MARA" class="h-8 w-auto object-contain" src="{{ asset('images/Majlis_Amanah_Rakyat_logo.png') }}"/>
            <img alt="Logo KPM" class="h-8 w-auto object-contain" src="{{ asset('images/LogoKPM-1.png') }}"/>
            <div class="flex flex-col"><span class="font-headline font-bold text-base tracking-tight text-primary leading-tight">Kolej Profesional MARA</span><span class="font-label text-xs font-semibold text-secondary tracking-wide uppercase leading-tight">Beranang, Selangor</span></div>
        </a>
        <nav class="hidden xl:flex items-center gap-6 font-label text-sm font-medium" aria-label="Navigasi utama">
            <a class="text-on-surface-variant hover:text-on-surface transition-colors py-1" href="{{ url('/') }}">Utama</a>
            <a class="text-on-surface-variant hover:text-on-surface transition-colors py-1" href="{{ route('facilities.index') }}">Kemudahan</a>
            <a class="text-on-surface-variant hover:text-on-surface transition-colors py-1" href="{{ url('/campus-map') }}">Peta Interaktif</a>
            <a class="text-on-surface-variant hover:text-on-surface transition-colors py-1" href="{{ route('lecturers.index') }}">Direktori Pensyarah</a>
        </nav>
        <div class="flex items-center gap-3 shrink-0">
            <div class="hidden lg:flex items-center gap-2.5 rounded-xl border border-outline-variant/60 bg-white/80 px-3 py-2 shadow-sm" aria-label="Waktu tempatan Malaysia">
                <div class="relative h-8 w-8 shrink-0 rounded-full border border-outline-variant bg-surface-container-lowest flex items-center justify-center">
                    <svg class="h-full w-full p-0.5" viewBox="0 0 100 100" aria-hidden="true"><circle cx="50" cy="50" r="48" fill="#fcf9f8" stroke="#dcd9d9" stroke-width="1.5"/><line stroke="#000a1e" stroke-linecap="round" stroke-width="3" x1="50" x2="50" y1="7" y2="15"/><line stroke="#000a1e" stroke-linecap="round" stroke-width="3" x1="93" x2="85" y1="50" y2="50"/><line stroke="#000a1e" stroke-linecap="round" stroke-width="3" x1="50" x2="50" y1="93" y2="85"/><line stroke="#000a1e" stroke-linecap="round" stroke-width="3" x1="7" x2="15" y1="50" y2="50"/><line stroke="#000a1e" stroke-linecap="round" stroke-width="3.2" x1="50" x2="50" y1="50" y2="27" id="analog-hour-hand"/><line stroke="#465f88" stroke-linecap="round" stroke-width="2.2" x1="50" x2="50" y1="50" y2="16" id="analog-min-hand"/><line stroke="#735c00" stroke-linecap="round" stroke-width="1.2" x1="50" x2="50" y1="58" y2="12" id="analog-sec-hand"/><circle cx="50" cy="50" r="3" fill="#fed65b" stroke="#735c00" stroke-width="1"/></svg>
                </div>
                <div class="flex min-w-0 flex-col leading-tight"><div class="flex items-center gap-1.5"><span id="kpmb-live-time" class="font-headline text-xs font-extrabold tabular-nums text-primary">--:--:-- --</span><span class="rounded bg-secondary-fixed/40 px-1.5 py-0.5 text-[9px] font-bold tracking-wider text-on-secondary-fixed">MYT</span></div><span id="kpmb-live-date" class="text-[10px] font-medium text-on-surface-variant">-- --- ----</span></div>
            </div>
            @if (auth()->check() && auth()->user()->role === 'student')
                <div class="relative">
                    <details class="group relative">
                        <summary class="list-none cursor-pointer w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-primary-container focus:outline-none focus:ring-2 focus:ring-secondary" aria-label="Menu pelajar" title="Menu pelajar"><span class="material-symbols-outlined text-[20px]">person</span></summary>
                        <div class="absolute right-0 mt-3 w-56 rounded-xl border border-outline-variant/60 bg-white py-2 shadow-xl z-[120]">
                            <div class="px-4 py-2 border-b border-slate-100"><p class="text-xs text-slate-500">Signed in as</p><p class="text-sm font-bold text-primary truncate">{{ auth()->user()->name }}</p></div>
                            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50"><span class="material-symbols-outlined text-lg">dashboard</span>Student Dashboard</a>
                            <a href="{{ route('student.profile') }}" class="flex items-center gap-2 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50"><span class="material-symbols-outlined text-lg">account_circle</span>My Profile</a>
                        </div>
                    </details>
                </div>
            @else
                <a class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-primary text-on-primary font-label text-sm font-semibold tracking-wide hover:bg-primary-container transition-colors shadow-sm" href="{{ route('login') }}">Log Masuk Portal</a>
            @endif
        </div>
    </div>
</header>
<script>
(function(){
 const days=['Ahad','Isnin','Selasa','Rabu','Khamis','Jumaat','Sabtu'];
 const months=['Jan','Feb','Mac','Apr','Mei','Jun','Jul','Ogo','Sep','Okt','Nov','Dis'];
 function updateKpmbClock(){
  const now=new Date();
  const parts=new Intl.DateTimeFormat('en-GB',{timeZone:'Asia/Kuala_Lumpur',hour:'2-digit',minute:'2-digit',second:'2-digit',hourCycle:'h23',day:'2-digit',month:'2-digit',year:'numeric'}).formatToParts(now);
  const get=(type)=>parts.find(p=>p.type===type)?.value;
  const hours=Number(get('hour')), minutes=Number(get('minute')), seconds=Number(get('second'));
  const day=Number(get('day')), month=Number(get('month'))-1, year=get('year');
  const weekday=new Intl.DateTimeFormat('en-US',{timeZone:'Asia/Kuala_Lumpur',weekday:'short'}).format(now);
  const weekdayIndex=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].indexOf(weekday);
  const time=document.getElementById('kpmb-live-time'), date=document.getElementById('kpmb-live-date');
  if(time){const h=hours%12||12;time.textContent=String(h).padStart(2,'0')+':'+String(minutes).padStart(2,'0')+':'+String(seconds).padStart(2,'0')+' '+(hours>=12?'PM':'AM');}
  if(date)date.textContent=days[weekdayIndex]+', '+day+' '+months[month]+' '+year;
  const sh=document.getElementById('analog-sec-hand'), mh=document.getElementById('analog-min-hand'), hh=document.getElementById('analog-hour-hand');
  if(sh)sh.setAttribute('transform','rotate('+(seconds*6)+' 50 50)');
  if(mh)mh.setAttribute('transform','rotate('+(minutes*6+seconds*0.1)+' 50 50)');
  if(hh)hh.setAttribute('transform','rotate('+((hours%12)*30+minutes*0.5)+' 50 50)');
 }
 updateKpmbClock();setInterval(updateKpmbClock,1000);
})();
</script>
