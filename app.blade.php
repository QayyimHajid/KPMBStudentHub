<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KPMB Student Hub')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@100..900&family=Source+Serif+4:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: { extend: {
                colors: {
                    primary:"#002147","primary-dark":"#001633","primary-light":"#0a356c",
                    secondary:"#f59e0b","secondary-dark":"#b45309","secondary-light":"#fef3c7",
                    "mara-red":"#dc2626","mara-red-light":"#fee2e2","tvet-cyan":"#0284c7",
                    "tvet-emerald":"#059669",surface:"#f8fafc","surface-card":"#ffffff",
                    "surface-muted":"#f1f5f9","border-subtle":"#e2e8f0","text-main":"#0f172a",
                    "text-muted":"#64748b","surface-container-lowest":"#ffffff",
                    "surface-container-low":"#f6f3f2","surface-container":"#f0eded",
                    "surface-container-high":"#eae7e7","surface-container-highest":"#e5e2e1",
                    "on-surface":"#1c1b1b","on-surface-variant":"#44474e",
                    "outline":"#74777f","outline-variant":"#c4c6cf","secondary-fixed":"#ffe088",
                    "primary-container":"#001633"
                },
                fontFamily:{sans:["Hanken Grotesk","sans-serif"],serif:["Source Serif 4","serif"],headline:["Hanken Grotesk","sans-serif"],label:["Hanken Grotesk","sans-serif"]}
            }}
        };
    </script>
    <style>
        *,*::before,*::after{box-sizing:border-box}
        html,body{margin:0;padding:0}
        body{min-width:320px;background:#f8fafc;color:#0f172a;font-family:'Hanken Grotesk',sans-serif;overflow-x:hidden}
        .material-symbols-outlined{
            font-family:'Material Symbols Outlined' !important;
            font-weight:normal;font-style:normal;font-size:24px;line-height:1;
            letter-spacing:normal;text-transform:none;display:inline-block;
            white-space:nowrap;word-wrap:normal;direction:ltr;
            -webkit-font-feature-settings:'liga';-webkit-font-smoothing:antialiased;
            font-feature-settings:'liga';font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
            vertical-align:middle;
        }
        img,svg{max-width:100%}
        .lecturer-main-shell{margin-left:18rem!important;padding-top:6.5rem!important;min-height:100vh;width:auto}
        @media(max-width:767px){
            .lecturer-sidebar-shell{display:none}
            .lecturer-topbar-shell{left:0!important;padding-left:1rem!important;padding-right:1rem!important}
            .lecturer-main-shell{margin-left:0!important;padding-top:6.5rem!important}
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface font-sans text-text-main antialiased">
    @if(auth()->check() && auth()->user()->role === 'lecturer')
        @include('lecturer.partials.sidebar')
        @include('lecturer.partials.topbar')
        <main class="lecturer-main-shell p-5 md:p-8">
            @yield('content')
        </main>
    @else
        @include('layouts.partials.topbar')
        <main class="w-full min-h-screen p-5 md:p-8">
            @yield('content')
        </main>
    @endif
    @stack('scripts')
</body>
</html>
