<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akaun | KPMB Student Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root{--navy:#002147;--deep:#00132b;--gold:#fed65b;--warm:#fcfaf8;--border:#e7e2dc;--muted:#f4f0eb;--text:#242b35;--red:#b42318}
        *{box-sizing:border-box}body{margin:0;min-height:100vh;background:var(--warm);color:var(--text);font-family:"Hanken Grotesk",Arial,sans-serif;display:flex;flex-direction:column}
        .topbar{background:#fff;border-bottom:1px solid var(--border)}.topbar-inner{width:min(100% - 48px,1380px);min-height:72px;margin:auto;display:flex;align-items:center;justify-content:space-between;gap:20px}
        .brand{display:flex;align-items:center;gap:13px;color:var(--navy);font-weight:800}.brand-mark{width:42px;height:42px;display:grid;place-items:center;border-radius:10px;background:var(--navy);color:var(--gold);font-weight:800;letter-spacing:-1px}.brand small{display:block;color:#77716d;font-size:10px;letter-spacing:.8px;text-transform:uppercase;margin-top:2px}.top-link{color:var(--navy);text-decoration:none;font-weight:700;font-size:14px}
        main{width:min(100% - 36px,1100px);margin:38px auto 44px;display:grid;grid-template-columns: .9fr 1.1fr;background:#fff;border:1px solid var(--border);border-radius:22px;overflow:hidden;box-shadow:0 18px 55px #00132b0d;min-height:620px}
        .intro{background:linear-gradient(145deg,var(--navy),var(--deep));color:white;padding:48px 42px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}.intro:after{content:"";position:absolute;width:280px;height:280px;border:1px solid #ffffff20;border-radius:50%;right:-120px;bottom:-100px;box-shadow:0 0 0 35px #ffffff08,0 0 0 70px #ffffff05}.eyebrow{font-size:11px;font-weight:800;letter-spacing:1.5px;color:var(--gold);text-transform:uppercase}.intro h1{font-family:"Source Serif 4",Georgia,serif;font-size:clamp(32px,3.3vw,46px);line-height:1.13;font-weight:600;margin:20px 0}.intro h1 span{color:var(--gold)}.intro p{line-height:1.75;color:#e2e9f1;font-size:14px;max-width:390px}.benefits{display:grid;gap:18px;margin-top:38px}.benefit{display:flex;gap:13px;align-items:flex-start}.benefit-icon{width:34px;height:34px;flex-shrink:0;border-radius:9px;background:#ffffff12;color:var(--gold);display:grid;place-items:center;font-size:17px}.benefit strong{display:block;font-size:14px}.benefit span{display:block;color:#cbd6e3;font-size:12px;line-height:1.55;margin-top:3px}.intro-foot{font-size:11px;color:#b9c7d8;margin-top:35px}
        .form-panel{padding:42px clamp(24px,4vw,54px)}.status{display:inline-flex;align-items:center;gap:8px;background:#f2f8f4;border:1px solid #dceee1;border-radius:999px;padding:7px 11px;color:#22643a;font-size:11px;font-weight:800}.dot{width:7px;height:7px;background:#279653;border-radius:50%}.form-panel h2{font-size:28px;color:var(--navy);margin:20px 0 7px;letter-spacing:-.6px}.sub{color:#77716d;font-size:13px;line-height:1.6;margin:0 0 23px}.alert{border-radius:10px;padding:12px 14px;margin:0 0 17px;font-size:13px;line-height:1.5}.alert-error{background:#fff3f1;border:1px solid #f4c7c1;color:#9b1c13}.field{margin-bottom:15px}.field label{display:block;font-size:12px;font-weight:800;color:#303946;margin-bottom:7px}.field input{width:100%;border:1px solid #d9d5d0;border-radius:10px;background:#fff;padding:12px 13px;font-size:14px;outline:none;transition:border .15s,box-shadow .15s}.field input:focus{border-color:var(--navy);box-shadow:0 0 0 3px #00214713}.field input::placeholder{color:#a09b96}.hint{font-size:11px;color:#77716d;margin-top:6px}.two-col{display:grid;grid-template-columns:1fr 1fr;gap:14px}.submit{width:100%;display:flex;align-items:center;justify-content:center;gap:10px;border:0;border-radius:10px;background:var(--navy);color:white;font-weight:800;padding:14px 18px;margin-top:6px;cursor:pointer;box-shadow:0 8px 18px #00214720}.submit:hover{background:#003264}.submit span{color:var(--gold);font-size:18px}.bottom-note{text-align:center;font-size:12px;color:#77716d;line-height:1.6;margin-top:20px}.bottom-note a{color:var(--navy);font-weight:800;text-decoration:none}.footer{text-align:center;padding:0 18px 24px;color:#8a8580;font-size:11px}
        @media(max-width:760px){main{grid-template-columns:1fr;margin:20px auto 30px}.intro{padding:30px 26px}.intro h1{font-size:34px}.benefits{grid-template-columns:1fr 1fr;gap:14px;margin-top:24px}.intro-foot{margin-top:24px}.form-panel{padding:30px 24px}.topbar-inner{width:calc(100% - 32px)}}@media(max-width:440px){.two-col{grid-template-columns:1fr;gap:0}.benefits{grid-template-columns:1fr}.brand{font-size:13px}.brand-mark{width:36px;height:36px}}
    </style>
</head>
<body>
<header class="topbar"><div class="topbar-inner">
    <div class="brand"><div class="brand-mark">KPMB</div><div>KPMB Student Hub<small>Institusi Pendidikan MARA</small></div></div>
    <a class="top-link" href="{{ route('login') }}">Sudah mempunyai akaun? Log Masuk →</a>
</div></header>
<main>
    <section class="intro">
        <div><div class="eyebrow">Profesional Berjiwa Keusahawanan</div><h1>Satu akaun untuk<br><span>perjalanan akademik</span></h1><p>Daftar akaun pelajar untuk mengakses maklumat akademik dan perkhidmatan kampus melalui KPMB Student Hub.</p>
            <div class="benefits">
                <div class="benefit"><div class="benefit-icon">✓</div><div><strong>Pengesahan ID</strong><span>ID pelajar mesti tersedia dalam roster KPMB yang didaftarkan oleh UPP.</span></div></div>
                <div class="benefit"><div class="benefit-icon">⌂</div><div><strong>Maklumat kampus</strong><span>Akses kemudahan dan maklumat pelajar di satu tempat.</span></div></div>
            </div>
        </div>
        <div class="intro-foot">KPMB Student Hub · FYP Prototype</div>
    </section>
    <section class="form-panel">
        <div class="status"><span class="dot"></span> Pendaftaran Pelajar</div>
        <h2>Cipta Akaun</h2>
        <p class="sub">Masukkan maklumat anda seperti yang terdapat dalam rekod pelajar ujian.</p>
        @if ($errors->any())
            <div class="alert alert-error" role="alert">@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('signup.store') }}">
            @csrf
            <div class="field"><label for="student_id">Nombor ID Pelajar</label><input id="student_id" name="student_id" value="{{ old('student_id') }}" maxlength="20" placeholder="Contoh: TESTSTU001" autocomplete="username" required><div class="hint">Untuk demo FYP, gunakan ID ujian yang disediakan dalam seeder.</div></div>
            <div class="field"><label for="name">Nama Penuh</label><input id="name" name="name" value="{{ old('name') }}" maxlength="100" placeholder="Masukkan nama seperti dalam rekod" autocomplete="name" required></div>
            <div class="field"><label for="email">Alamat Emel</label><input id="email" type="email" name="email" value="{{ old('email') }}" maxlength="100" placeholder="nama@contoh.com" autocomplete="email" required></div>
            <div class="two-col">
                <div class="field"><label for="password">Kata Laluan</label><input id="password" type="password" name="password" minlength="8" placeholder="Minimum 8 aksara" autocomplete="new-password" required></div>
                <div class="field"><label for="password_confirmation">Sahkan Kata Laluan</label><input id="password_confirmation" type="password" name="password_confirmation" minlength="8" placeholder="Ulang kata laluan" autocomplete="new-password" required></div>
            </div>
            <button class="submit" type="submit">Daftar Akaun <span aria-hidden="true">→</span></button>
        </form>
        <div class="bottom-note">Dengan mendaftar, role akaun akan ditetapkan sebagai pelajar secara automatik.<br>Sudah ada akaun? <a href="{{ route('login') }}">Log masuk di sini</a>.</div>
    </section>
</main>
<footer class="footer">© {{ date('Y') }} KPMB Student Hub. Prototaip untuk tujuan akademik.</footer>
</body>
</html>
