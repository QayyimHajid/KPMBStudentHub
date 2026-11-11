<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk | KPMB Student Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #002147;
            --deep: #00132b;
            --red: #e60000;
            --gold: #fed65b;
            --warm: #fcfaf8;
            --border: #e7e2dc;
            --muted: #f4f0eb;
            --text: #242b35;
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: var(--warm);
            color: var(--text);
            font-family: "Hanken Grotesk", Arial, sans-serif;
        }

        button, input {
            font: inherit;
        }

        /* TOP BAR */

        .topbar {
            width: 100%;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--border);
        }

        .topbar-inner {
            width: min(100% - 64px, 1440px);
            min-height: 72px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .institution {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .institution-logo {
            display: block;
            width: 60px;
            height: 48px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .institution-name {
            color: var(--navy);
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .institution-caption {
            margin-top: 3px;
            color: #77716d;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        

        

        

        

        

        

        

        

        /* MAIN */

        main {
            flex: 1;
            width: 100%;
            padding: 38px 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .portal {
            width: 100%;
            max-width: 1300px;
            min-height: 660px;
            display: grid;
            grid-template-columns: 7fr 5fr;
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 22px 55px rgba(0, 19, 43, .12);
        }

        /* CAMPUS PANEL */

        .hero {
            position: relative;
            min-width: 0;
            padding: 42px 44px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            color: white;
            background: var(--deep);
        }

        .hero-background {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(
                    145deg,
                    rgba(0, 19, 43, .82),
                    rgba(0, 33, 71, .76) 52%,
                    rgba(0, 19, 43, .88)
                ),
                url("{{ asset('images/landing/KPMB.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        .hero-background::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            top: -130px;
            right: -100px;
            border-radius: 50%;
            background: rgba(230, 0, 0, .18);
            filter: blur(55px);
        }

        .hero-content,
        .hero-bottom {
            position: relative;
            z-index: 1;
        }

        .hero-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        .hero-logo-card {
            width: 100px;
            height: 84px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,.8);
            border-radius: 14px;
            background: white;
            box-shadow: 0 8px 24px rgba(0,0,0,.15);
        }

        .hero-logo-card img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .hero-institution {
            color: var(--gold);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .hero-brand-name {
            margin-top: 7px;
            font-size: 20px;
            font-weight: 700;
        }

        .hero-kicker {
            display: inline-block;
            margin-bottom: 18px;
            padding: 7px 11px;
            border: 1px solid rgba(254,214,91,.4);
            border-radius: 30px;
            background: rgba(254,214,91,.12);
            color: var(--gold);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 540px;
            margin: 0;
            font-size: clamp(34px, 3.1vw, 47px);
            font-weight: 800;
            line-height: 1.13;
            letter-spacing: -1.1px;
        }

        .hero h1 span {
            color: var(--gold);
        }

        .hero-description {
            max-width: 530px;
            margin: 17px 0 0;
            color: #e1e8f0;
            font-family: "Source Serif 4", Georgia, serif;
            font-size: 15px;
            line-height: 1.8;
        }

        .highlights {
            display: grid;
            gap: 11px;
            margin-top: 28px;
        }

        .highlight {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 12px;
            background: rgba(255,255,255,.09);
            backdrop-filter: blur(8px);
        }

        .highlight-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: rgba(254,214,91,.14);
            color: var(--gold);
            font-size: 20px;
        }

        .highlight strong {
            display: block;
            font-size: 13px;
        }

        .highlight p {
            margin: 3px 0 0;
            color: #e1e8f0;
            font-size: 12px;
            line-height: 1.5;
        }

        .hero-bottom {
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.2);
            color: #d0d9e5;
            font-size: 11px;
            line-height: 1.6;
        }

        /* LOGIN PANEL */

        .login-panel {
            min-width: 0;
            padding: 42px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .login-status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #14734b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #16a36a;
        }

        .version {
            color: #a29b96;
            font-size: 12px;
        }

        .login-panel h2 {
            margin: 20px 0 8px;
            color: var(--navy);
            font-size: clamp(25px, 2.3vw, 32px);
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .login-intro {
            margin: 0;
            color: #77716d;
            font-size: 13px;
            line-height: 1.7;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #38342f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .45px;
            text-transform: uppercase;
        }

        .role-section {
            margin: 25px 0 22px;
        }

        .roles {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 5px;
            margin-top: 9px;
            margin-bottom: 22px;
            padding: 5px;
            border: 1px solid #e7e2dc;
            border-radius: 12px;
            background: #f6f5f4;
        }

        .role-button {
            position: relative;
            min-width: 0;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 4px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #646a75;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .role-button svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .role-button.active {
            background: var(--navy);
            color: white;
            box-shadow: 0 3px 9px rgba(0,33,71,.17);
        }

        .role-button.active::after {
            content: "";
            position: absolute;
            right: 7px;
            bottom: 0;
            left: 7px;
            height: 3px;
            border-radius: 3px 3px 0 0;
            background: var(--red);
        }

        @media (max-width: 400px) {
            .role-button {
                flex-direction: column;
                gap: 4px;
                font-size: 10px;
            }
        }

        .field {
            margin-top: 0;
            margin-bottom: 19px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            min-height: 48px;
            padding: 12px 46px 12px 14px;
            border: 1px solid #d7dce4;
            border-radius: 10px;
            outline: none;
            background: #fbfcfd;
            color: #172033;
            font-size: 13px;
            transition: .2s ease;
        }

        .input-wrap input:focus {
            border-color: var(--navy);
            background: white;
            box-shadow: 0 0 0 3px rgba(0,33,71,.09);
        }

        .input-wrap input::placeholder {
            color: #a39c96;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            padding: 5px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: #667085;
            cursor: pointer;
        }

        .toggle-password:hover {
            background: #f0f2f5;
            color: var(--navy);
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.7;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .error-box {
            margin: 18px 0;
            padding: 12px 14px;
            border: 1px solid #fecaca;
            border-radius: 9px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
            line-height: 1.6;
        }

        .login-button {
            width: 100%;
            min-height: 49px;
            margin-top: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            border-radius: 10px;
            background: var(--navy);
            color: white;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,33,71,.12);
            transition: .2s ease;
        }

        .login-button:hover {
            background: #003467;
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(0,33,71,.18);
        }

        .login-note {
            margin-top: 23px;
            padding-top: 17px;
            border-top: 1px solid #edf0f3;
            color: #88838a;
            font-size: 11px;
            line-height: 1.8;
            text-align: center;
        }

        /* FOOTER */

        .site-footer {
            width: 100%;
            background: white;
            border-top: 1px solid var(--border);
        }

        .footer-inner {
            width: min(100% - 64px, 1440px);
            min-height: 70px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
        }

        .footer-copy {
            color: #77716d;
            font-size: 10px;
            line-height: 1.8;
        }

        .footer-copy strong {
            color: var(--navy);
        }

        

        

        

        

        /* RESPONSIVE */

        @media (max-width: 1000px) {
            main {
                padding: 26px 18px;
            }

            .portal {
                grid-template-columns: 1fr 1fr;
            }

            .hero {
                padding: 32px 28px 24px;
            }

            .login-panel {
                padding: 34px 28px;
            }

            .hero-logo-card {
                width: 82px;
                height: 72px;
            }

            .hero h1 {
                font-size: clamp(30px, 3.5vw, 39px);
            }
        }

        @media (max-width: 760px) {
            .topbar-inner {
                width: calc(100% - 32px);
                min-height: 66px;
                gap: 10px;
            }

            .institution {
                gap: 9px;
            }

            .institution-logo {
                width: 48px;
                height: 42px;
            }

            .institution-name {
                font-size: 13px;
            }

            .institution-caption,
            

            

            

            

            main {
                padding: 20px 14px;
            }

            .portal {
                max-width: 520px;
                grid-template-columns: 1fr;
            }

            .hero {
                min-height: auto;
                padding: 28px 25px 22px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-bottom {
                margin-top: 22px;
            }

            .login-panel {
                padding: 32px 25px;
            }

            .footer-inner {
                width: calc(100% - 32px);
                padding: 16px 0;
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            
        }

        @media (max-width: 400px) {
            .institution-name {
                font-size: 11px;
            }

            

            .hero-brand {
                gap: 11px;
            }

            .hero-logo-card {
                width: 70px;
                height: 64px;
            }

            .hero h1 {
                font-size: 31px;
            }

            .login-panel {
                padding: 27px 19px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="topbar-inner">
        <div class="institution">
            <img
                class="institution-logo"
                src="{{ asset('images/Majlis_Amanah_Rakyat_logo.png') }}"
                alt="Logo Kolej Profesional MARA Beranang"
            >
            <img
                class="institution-logo"
                src="{{ asset('images/LogoKPM-1.png') }}"
                alt="Logo Kolej Profesional MARA Beranang"
            >

            <div>
                <div class="institution-name">Kolej Profesional MARA Beranang, Selangor</div>
                <div class="institution-caption">
                    Portal Bersepadu Pelajar &amp; Staf
                    <span style="color:var(--red)"> • </span>
                    KPMB
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="portal">

        <section class="hero">
            <div class="hero-background"></div>

            <div class="hero-content">
                <div class="hero-brand">
                    <div class="hero-logo-card">
                        <img
                            src="{{ asset('images/kpmb-student-hub-icon.svg') }}"
                            alt="Logo rasmi KPMB Student Hub"
                        >
                    </div>

                    <div>
                        <div class="hero-institution">
                            Institusi Pendidikan MARA
                        </div>
                        <div class="hero-brand-name">
                            KPMB STUDENT HUB
                        </div>
                    </div>
                </div>

                <span class="hero-kicker">Profesional Berjiwa Keusahawanan</span>

                <h1>
                    Pintu Gerbang<br>
                    <span>Akademik &amp; Inovasi</span>
                </h1>

                <p class="hero-description">
                    Akses maklumat akademik dan maklumat kampus melalui
                    satu platform digital yang bersepadu, mudah dan tersusun.
                </p>

                <div class="highlights">
                    <div class="highlight">
                        <div class="highlight-icon" aria-hidden="true">⌂</div>
                        <div>
                            <strong>Maklumat Kampus</strong>
                            <p>Cari kemudahan dan lokasi dalam kampus.</p>
                        </div>
                    </div>

                    <div class="highlight">
                        <div class="highlight-icon" aria-hidden="true">▤</div>
                        <div>
                            <strong>Urusan Akademik</strong>
                            <p>Akses pendaftaran, jadual dan keputusan akademik.</p>
                        </div>
                    </div>

                    <div class="highlight">
                        <div class="highlight-icon" aria-hidden="true">◷</div>
                        <div>
                            <strong>Hebahan &amp; Acara</strong>
                            <p>Dapatkan maklumat pengumuman dan aktiviti kampus.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-bottom">
                KPMB Student Hub · Platform maklumat dan perkhidmatan kampus
            </div>
        </section>

        <section class="login-panel">
            <div class="login-status-row">
                <div class="status">
                    <span class="status-dot"></span>
                    Portal Log Masuk
                </div>
                <span class="version">KPMB Student Hub 1.0</span>
            </div>

            <h2>Log Masuk Pengguna</h2>

            <p class="login-intro">
                Sila pilih kategori pengguna dan masukkan username
                serta kata laluan untuk meneruskan.
            </p>

            @if ($errors->any())
                <div class="error-box" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            
            <div class="roles" role="group" aria-label="Kategori pengguna">
                <button class="role-button active"
                        type="button" data-role="student" aria-pressed="true">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 9l10-6 10 6-10 6L2 9z"/>
                        <path d="M6 12v5c4 3 8 3 12 0v-5M22 9v7"/>
                    </svg>
                    <span>Pelajar</span>
                </button>

                <button class="role-button"
                        type="button" data-role="lecturer" aria-pressed="false">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21v-2a8 8 0 0 1 16 0v2M9 8h6"/>
                    </svg>
                    <span>Pensyarah</span>
                </button>

                <button class="role-button"
                        type="button" data-role="upp" aria-pressed="false">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                    <span>UPP</span>
                </button>
            </div>


            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <input
                    type="hidden"
                    name="selected_role"
                    id="selected-role"
                    value="{{ old('selected_role', 'student') }}"
                >
                
                <div class="field">
                    <label class="field-label" for="username" id="identifier-label">
                        Nombor ID Pelajar
                    </label>

                    <div class="input-wrap">
                        <input
                            id="username"
                            type="text"
                            name="identifier"
                            value="{{ old('identifier', old('username')) }}"
                            placeholder="Masukkan nombor ID pelajar"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                </div>


                <div class="field">
                    <label class="field-label" for="password">Kata Laluan</label>
                    <div class="input-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan kata laluan"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            class="toggle-password"
                            type="button"
                            id="toggle-password"
                            aria-label="Papar kata laluan"
                            aria-pressed="false"
                        >
                            <svg id="eye-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button class="login-button" type="submit">
                    Log Masuk ke Portal <span aria-hidden="true">→</span>
                </button>
            </form>

            <div class="signup-prompt" style="margin-top:18px;text-align:center;color:#77716d;font-size:12px;line-height:1.7;">
                Belum mempunyai akaun pelajar?
                <a href="{{ url('/signup') }}" style="color:var(--navy);font-weight:800;text-decoration:none;">
                    Daftar di sini
                </a>
            </div>

            <div class="login-note">
                Akses sistem tertakluk kepada peranan dan status akaun.
                Jika menghadapi masalah, hubungi pihak pengurusan KPMB.
            </div>
        </section>

    </div>
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-copy">
            &copy; {{ date('Y') }}
            <strong>KPMB Student Hub</strong>. Hak cipta terpelihara.
            <br>
            Platform maklumat dan perkhidmatan kampus.
        </div>
    </div>
</footer>

<script>
    const roleButtons = document.querySelectorAll('.role-button');
    const selectedRole = document.getElementById('selected-role');
    const identifierLabel = document.getElementById('identifier-label');
    const identifierInput = document.getElementById('username');

    const roleConfig = {
        student: {
            label: 'Nombor ID Pelajar',
            placeholder: 'Contoh: KPM220456'
        },
        lecturer: {
            label: 'Nombor ID Pensyarah',
            placeholder: 'Masukkan ID pensyarah'
        },
        upp: {
            label: 'ID Staf / Username',
            placeholder: 'Masukkan ID staf atau username'
        }
    };

    function updateRole(role) {
        const config = roleConfig[role];

        if (!config) return;

        selectedRole.value = role;
        identifierLabel.textContent = config.label;
        identifierInput.placeholder = config.placeholder;

        roleButtons.forEach(button => {
            const active = button.dataset.role === role;

            button.classList.toggle('active', active);
            button.setAttribute('aria-pressed', String(active));
        });
    }

    roleButtons.forEach(button => {
        button.addEventListener('click', () => {
            updateRole(button.dataset.role);
        });
    });

    updateRole(selectedRole.value || 'student');

    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const eyeIcon = document.getElementById('eye-icon');

    togglePassword.addEventListener('click', () => {
        const showing = passwordInput.type === 'text';

        passwordInput.type = showing ? 'password' : 'text';
        togglePassword.setAttribute('aria-pressed', String(!showing));
        togglePassword.setAttribute(
            'aria-label',
            showing ? 'Papar kata laluan' : 'Sembunyikan kata laluan'
        );

        eyeIcon.innerHTML = showing
            ? '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M3 3l18 18"/><path d="M10.6 5.1A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a16 16 0 0 1-3.1 3.9"/><path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7a10 10 0 0 0 4-.8"/>';
    });
</script>

</body>
</html>