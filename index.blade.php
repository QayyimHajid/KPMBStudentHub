<!DOCTYPE html>

<html lang="ms">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_standard" name="shell-type" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@600;700&amp;family=IBM+Plex+Sans:wght@500;600;700&amp;family=Work+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        @layer base {
            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main>:first-child {
                margin-top: 0 !important;
            }

            main>:last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "inverse-primary": "#aec7f6",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#ffb4aa",
                        "tertiary-container": "#c9a900",
                        "inverse-on-surface": "#f0f1f2",
                        "secondary-container": "#e80f16",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#aec7f6",
                        "on-secondary-fixed": "#410001",
                        "primary": "#000a1e",
                        "on-tertiary-fixed": "#221b00",
                        "surface-container": "#edeeef",
                        "on-background": "#191c1d",
                        "on-secondary-container": "#fffbff",
                        "tertiary-fixed-dim": "#e9c400",
                        "outline-variant": "#c4c6cf",
                        "on-primary-fixed": "#001b3d",
                        "surface-tint": "#465f88",
                        "on-tertiary-container": "#4c3f00",
                        "tertiary-fixed": "#ffe16d",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f8f9fa",
                        "surface": "#f8f9fa",
                        "outline": "#74777f",
                        "background": "#f8f9fa",
                        "on-tertiary-fixed-variant": "#544600",
                        "surface-container-low": "#f3f4f5",
                        "surface-dim": "#d9dadb",
                        "on-surface": "#191c1d",
                        "on-error": "#ffffff",
                        "secondary": "#bc000c",
                        "inverse-surface": "#2e3132",
                        "primary-fixed": "#d6e3ff",
                        "surface-container-highest": "#e1e3e4",
                        "on-surface-variant": "#44474e",
                        "on-secondary-fixed-variant": "#930007",
                        "on-primary": "#ffffff",
                        "surface-container-high": "#e7e8e9",
                        "error": "#ba1a1a",
                        "surface-variant": "#e1e3e4",
                        "primary-container": "#002147",
                        "tertiary": "#705d00",
                        "secondary-fixed": "#ffdad5",
                        "on-primary-container": "#708ab5",
                        "on-primary-fixed-variant": "#2d476f"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    spacing: {},
                    fontFamily: {
                        headline: ["IBM Plex Sans"],
                        display: ["IBM Plex Sans"],
                        body: ["Work Sans"],
                        label: ["Hanken Grotesk"]
                    },
                    fontSize: {}
                }
            }
        }
    </script>
</head>

<body class="bg-surface font-body text-on-surface min-h-screen flex flex-col">
    
    <div class="{{ auth()->check() && auth()->user()->role === 'student' ? 'ml-72 w-[calc(100%-18rem)]' : 'w-full' }}">
        @include('layouts.partials.visitor-topbar')
    </div>

    <div class="flex min-h-screen">
        @if(auth()->check() && auth()->user()->role === 'student')
            @include('student.partials.sidebar')
        @endif

        <main class="flex-1 min-w-0 bg-surface pt-20 {{ auth()->check() && auth()->user()->role === 'student' ? 'ml-72' : '' }}">
            <div class="flex flex-col w-full">

            {{-- Hero --}}
            <section class="w-full bg-gradient-to-b from-primary-container via-primary-container/95 to-primary text-on-primary relative overflow-hidden py-12 md:py-16">
                <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-surface-tint/10 blur-3xl pointer-events-none"></div>
                <div class="absolute left-1/3 -bottom-20 w-80 h-80 rounded-full bg-secondary/10 blur-2xl pointer-events-none"></div>

                <div class="w-full max-w-[1280px] mx-auto px-6 lg:px-10 relative z-10 flex flex-col gap-8">
                    <div class="flex flex-wrap items-center gap-2 text-xs font-label uppercase tracking-widest text-on-primary-container">
                        <a href="{{ auth()->check() ? (auth()->user()->role === 'student' ? route('student.dashboard') : (auth()->user()->role === 'lecturer' ? route('lecturer.dashboard') : (auth()->user()->role === 'upp' ? route('upp.dashboard') : url('/')))) : url('/') }}"
                           class="hover:text-on-primary">Laman Utama</a>
                        <span>/</span>
                        <span class="text-tertiary-fixed font-bold">Direktori Pensyarah</span>
                    </div>

                    <div class="max-w-3xl flex flex-col gap-3">
                        <h1 class="font-headline font-bold text-3xl sm:text-4xl md:text-5xl text-on-primary tracking-tight leading-tight">Direktori Pensyarah</h1>
                        <p class="font-body text-inverse-on-surface text-base md:text-lg leading-relaxed">Cari maklumat pensyarah mengikut nama atau jabatan dalam satu direktori.</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4">
                        <div class="bg-surface-container-lowest/10 backdrop-blur-md p-4 rounded-lg flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-tertiary-fixed">
                                <span class="material-symbols-outlined text-xl">groups</span>
                                <span class="font-label text-xs uppercase tracking-wider font-semibold">Jumlah Pensyarah</span>
                            </div>
                            <span class="font-headline font-bold text-2xl text-on-primary">86</span>
                            <span class="text-xs text-inverse-on-surface">Rekod dalam direktori</span>
                        </div>

                        <div class="bg-surface-container-lowest/10 backdrop-blur-md p-4 rounded-lg flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-inverse-primary">
                                <span class="material-symbols-outlined text-xl">domain</span>
                                <span class="font-label text-xs uppercase tracking-wider font-semibold">Jabatan</span>
                            </div>
                            <span class="font-headline font-bold text-2xl text-on-primary">5 Jabatan</span>
                            <span class="text-xs text-inverse-on-surface">Mengikut senarai KPMB</span>
                        </div>

                        <div class="bg-surface-container-lowest/10 backdrop-blur-md p-4 rounded-lg flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-secondary-fixed">
                                <span class="material-symbols-outlined text-xl">search</span>
                                <span class="font-label text-xs uppercase tracking-wider font-semibold">Carian</span>
                            </div>
                            <span class="font-headline font-bold text-2xl text-on-primary">Nama & Jabatan</span>
                            <span class="text-xs text-inverse-on-surface">Cari maklumat dengan mudah</span>
                        </div>

                        <div class="bg-surface-container-lowest/10 backdrop-blur-md p-4 rounded-lg flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-tertiary-fixed">
                                <span class="material-symbols-outlined text-xl">contact_mail</span>
                                <span class="font-label text-xs uppercase tracking-wider font-semibold">Maklumat Hubungan</span>
                            </div>
                            <span class="font-headline font-bold text-2xl text-on-primary">Emel</span>
                            <span class="text-xs text-inverse-on-surface">Hubungi melalui emel rasmi</span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Filters --}}
            <section class="w-full bg-surface-container-low py-6">
                <div class="w-full max-w-[1280px] mx-auto px-6 lg:px-10 flex flex-col gap-4">
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none" id="faculty-tabs">
                        @php
                            $departments = [
                                'DIA' => 'Jabatan Perakaunan (DIA)',
                                'DSC' => 'Jabatan Sains Kuantitatif (DSC)',
                                'DLH' => 'Jabatan Landskap dan Hortikultur (DLH)',
                                'DBS' => 'Jabatan Pengurusan Perniagaan (DBS)',
                                'GSD' => 'Jabatan Pengajian Am (GSD)',
                            ];
                        @endphp

                        <a href="{{ route('lecturers.index', array_filter(['search' => $search ?: null])) }}"
                           class="px-4 py-2.5 rounded-lg text-xs font-label uppercase font-bold tracking-wide whitespace-nowrap {{ empty($department) ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface' }}">Semua Jabatan</a>

                        @foreach($departments as $code => $label)
                            <a href="{{ route('lecturers.index', array_filter(['search' => $search ?: null, 'department' => $code])) }}"
                               class="px-4 py-2.5 rounded-lg text-xs font-label uppercase font-bold tracking-wide whitespace-nowrap {{ ($department ?? '') === $code ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface' }}">{{ $code }}</a>
                        @endforeach
                    </div>

                    <form method="GET" action="{{ route('lecturers.index') }}" class="flex flex-col sm:flex-row gap-3">
                        @if(!empty($department))
                            <input type="hidden" name="department" value="{{ $department }}">
                        @endif

                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-lg pointer-events-none">search</span>
                            <input class="w-full bg-surface-container-lowest text-on-surface text-sm rounded-lg pl-10 pr-4 py-3 placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary shadow-sm"
                                   name="search"
                                   value="{{ $search }}"
                                   placeholder="Cari nama pensyarah atau jabatan..."
                                   type="search">
                        </div>

                        <button class="px-5 py-3 rounded-lg bg-primary-container text-on-primary text-sm font-semibold shadow-sm hover:opacity-90" type="submit">Cari</button>

                        @if($search || !empty($department))
                            <a href="{{ route('lecturers.index') }}" class="px-5 py-3 rounded-lg bg-surface-container-lowest text-on-surface text-sm font-semibold text-center">Kosongkan</a>
                        @endif
                    </form>
                </div>
            </section>

            {{-- Lecturer list --}}
            <section class="w-full max-w-[1280px] mx-auto px-6 lg:px-10 py-10 md:py-12">
                <div class="flex items-end justify-between gap-4 mb-6">
                    <div>
                        <h2 class="font-headline font-bold text-xl md:text-2xl text-primary tracking-tight">Senarai Pensyarah</h2>
                        <p class="text-sm text-on-surface-variant mt-1">{{ $lecturers->count() }} rekod dijumpai</p>
                    </div>
                    <span class="text-xs font-label font-bold uppercase tracking-wider bg-surface-container px-3 py-2 rounded">{{ $lecturers->count() }} dipaparkan</span>
                </div>

                @if($lecturers->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($lecturers as $lecturer)
                            <article class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-200 flex flex-col border border-outline-variant/30">
                                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden">
                                    @if($lecturer->photo_path)
                                        <img
                                            src="{{ asset('storage/lecturers/' . $lecturer->photo_path) }}"
                                            alt="Gambar {{ $lecturer->lecturer_name }}"
                                            class="w-full h-full object-cover object-top"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="w-24 h-24 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-3xl font-bold">
                                                {{ mb_strtoupper(mb_substr($lecturer->lecturer_name, 0, 1)) }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="absolute top-3 left-3 bg-primary-container/90 px-2.5 py-1 rounded text-[11px] font-label font-bold text-on-primary tracking-wide uppercase">
                                        {{ $lecturer->position }}
                                    </div>
                                </div>

                                <div class="p-5 flex flex-col gap-3 flex-1">
                                    <div>
                                        <h3 class="font-headline font-bold text-lg text-primary leading-snug">{{ $lecturer->lecturer_name }}</h3>
                                        <p class="text-sm text-on-surface-variant mt-1">{{ $lecturer->department }}</p>
                                    </div>

                                    <div class="h-px bg-outline-variant/50"></div>

                                    <div class="flex items-start gap-3 text-sm">
                                        <span class="material-symbols-outlined text-outline text-lg">mail</span>
                                        <a class="text-on-surface-variant hover:text-primary break-all" href="mailto:{{ $lecturer->email }}">{{ $lecturer->email }}</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-xl bg-surface-container-lowest border border-outline-variant/40 p-10 text-center">
                        <span class="material-symbols-outlined text-4xl text-outline">person_search</span>
                        <h3 class="font-headline font-bold text-lg text-primary mt-3">Tiada pensyarah dijumpai</h3>
                        <p class="text-sm text-on-surface-variant mt-1">Cuba kata carian lain atau pilih semua jabatan.</p>
                        <a href="{{ route('lecturers.index') }}" class="inline-flex mt-5 px-4 py-2 rounded-lg bg-primary-container text-on-primary text-sm font-semibold">Lihat Semua Pensyarah</a>
                    </div>
                @endif
            </section>

        </div>
    </main>
    </div>

        @if (auth()->guest())
            @include('layouts.partials.visitor-footer')
        @else
        <footer class="w-full bg-surface-container-low text-on-surface mt-8 py-6 text-center text-sm">&copy; {{ date('Y') }} Kolej Profesional MARA Beranang</footer>
        @endif

    <script>
        // Search is submitted to Laravel so results and pagination stay consistent.
    </script>

    <script>
        (function () {
            // Keep the shared visitor header clock working on pages that include visitor-topbar.
            const days = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis'];

            function updateKpmbClock() {
                const time = document.getElementById('kpmb-live-time');
                const date = document.getElementById('kpmb-live-date');
                if (!time && !date) return;

                const now = new Date();
                const parts = new Intl.DateTimeFormat('en-GB', {
                    timeZone: 'Asia/Kuala_Lumpur',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hourCycle: 'h23',
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).formatToParts(now);
                const get = (type) => parts.find(part => part.type === type)?.value;
                const hours = Number(get('hour'));
                const minutes = Number(get('minute'));
                const seconds = Number(get('second'));
                const day = Number(get('day'));
                const month = Number(get('month')) - 1;
                const year = get('year');
                const weekday = new Intl.DateTimeFormat('en-US', {
                    timeZone: 'Asia/Kuala_Lumpur',
                    weekday: 'short'
                }).format(now);
                const weekdayIndex = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].indexOf(weekday);

                if (time) {
                    const hour12 = hours % 12 || 12;
                    time.textContent = String(hour12).padStart(2, '0') + ':' +
                        String(minutes).padStart(2, '0') + ':' +
                        String(seconds).padStart(2, '0') + ' ' +
                        (hours >= 12 ? 'PM' : 'AM');
                }
                if (date) {
                    date.textContent = days[weekdayIndex] + ', ' + day + ' ' + months[month] + ' ' + year;
                }

                const secondHand = document.getElementById('analog-sec-hand');
                const minuteHand = document.getElementById('analog-min-hand');
                const hourHand = document.getElementById('analog-hour-hand');
                if (secondHand) secondHand.setAttribute('transform', 'rotate(' + (seconds * 6) + ' 50 50)');
                if (minuteHand) minuteHand.setAttribute('transform', 'rotate(' + (minutes * 6 + seconds * 0.1) + ' 50 50)');
                if (hourHand) hourHand.setAttribute('transform', 'rotate(' + ((hours % 12) * 30 + minutes * 0.5) + ' 50 50)');
            }

            updateKpmbClock();
            window.setInterval(updateKpmbClock, 1000);
        })();
    </script>

</body>

</html>