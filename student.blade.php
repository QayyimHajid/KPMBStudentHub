<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KPMB Student Hub')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@100..900&family=Source+Serif+4:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#002147",
                        "primary-dark": "#001633",
                        "primary-light": "#0a356c",
                        secondary: "#f59e0b",
                        "secondary-dark": "#b45309",
                        "secondary-light": "#fef3c7",
                        "mara-red": "#dc2626",
                        "mara-red-light": "#fee2e2",
                        "tvet-cyan": "#0284c7",
                        "tvet-emerald": "#059669",
                        surface: "#f8fafc",
                        "surface-card": "#ffffff",
                        "surface-muted": "#f1f5f9",
                        "border-subtle": "#e2e8f0",
                        "text-main": "#0f172a",
                        "text-muted": "#64748b"
                    },
                    fontFamily: {
                        sans: ["'Hanken Grotesk'", "sans-serif"],
                        serif: ["'Source Serif 4'", "serif"]
                    }
                }
            }
        };
    </script>

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            min-width: 320px;
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Hanken Grotesk', sans-serif;
            overflow-x: hidden;
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        img, svg {
            max-width: 100%;
        }

        /*
         * Sidebar is fixed at 18rem on desktop.
         * The content wrapper must occupy the remaining width, not add
         * 18rem padding to an already 100%-wide element.
         */
        .student-main {
            margin-left: 18rem;
            padding-left: 0;
            width: calc(100% - 18rem);
            max-width: calc(100% - 18rem);
            min-width: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: clip;
        }

        .student-main > header,
        .student-main > main {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        .student-main > main {
            overflow-x: clip;
        }

        .student-main img,
        .student-main svg,
        .student-main video,
        .student-main iframe,
        .student-main canvas {
            max-width: 100%;
        }

        .student-main .grid,
        .student-main .grid > *,
        .student-main .flex > * {
            min-width: 0;
        }

        @media (max-width: 1023px) and (min-width: 768px) {
            aside.student-sidebar {
                width: 16rem;
            }

            .student-main {
                margin-left: 16rem;
                width: calc(100% - 16rem);
                max-width: calc(100% - 16rem);
                padding-left: 0;
            }
        }

        @media (max-width: 767px) {
            aside.student-sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
                max-height: none;
            }

            .student-main {
                margin-left: 0;
                width: 100%;
                max-width: 100%;
                padding-left: 0;
                min-height: auto;
            }

            .student-main > header {
                position: relative;
                flex-wrap: wrap;
                padding: 1rem;
            }

            .student-main > main {
                padding: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-surface font-sans text-text-main antialiased">
    @include('student.partials.sidebar')

    <div class="student-main">
        @include('student.partials.topbar')

        <main class="w-full flex-1 p-5 md:p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
