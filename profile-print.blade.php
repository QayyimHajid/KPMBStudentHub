<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butiran Pelajar - {{ $student->student_name ?? 'Pelajar' }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 32px; color: #111827; font-family: Arial, sans-serif; background: #f3f4f6; }
        .sheet { max-width: 850px; margin: 0 auto; padding: 42px 48px; background: #fff; border: 1px solid #d1d5db; }
        .document-header { text-align: center; border-bottom: 2px solid #111827; padding-bottom: 18px; margin-bottom: 24px; }
        .document-header h1 { font-size: 21px; margin: 0 0 6px; text-transform: uppercase; }
        .document-header p { font-size: 12px; margin: 4px 0; }
        h2 { font-size: 15px; margin: 24px 0 10px; padding-bottom: 7px; border-bottom: 1px solid #d1d5db; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        td { padding: 9px 8px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        td:first-child { width: 34%; color: #374151; font-weight: bold; }
        .note { margin-top: 24px; font-size: 11px; color: #4b5563; }
        .actions { max-width: 850px; margin: 0 auto 16px; display: flex; gap: 8px; justify-content: flex-end; }
        .actions button, .actions a { padding: 10px 14px; border: 0; border-radius: 6px; background: #000a1e; color: white; text-decoration: none; font-size: 12px; cursor: pointer; }
        .actions a { background: #e5e7eb; color: #111827; }
        @media print {
            body { padding: 0; background: white; }
            .sheet { max-width: none; border: 0; padding: 0; }
            .actions { display: none; }
            @page { size: A4; margin: 18mm; }
        }
    </style>
</head>
<body>
    <div class="actions">
        <a href="{{ route('student.profile') }}">Kembali ke Profil</a>
        <button type="button" onclick="window.print()">Cetak / Simpan sebagai PDF</button>
    </div>

    <main class="sheet">
        <header class="document-header">
            <h1>Kolej Profesional MARA Beranang</h1>
            <p>STUDENT HUB</p>
            <p><strong>BUTIRAN PELAJAR</strong></p>
        </header>

        <h2>Maklumat Peribadi</h2>
        <table>
            <tr><td>Nama penuh</td><td>{{ $student->student_name ?? Auth::user()->name ?? 'Belum tersedia' }}</td></tr>
            <tr><td>No. matrik</td><td>{{ $student->student_id ?? 'Belum tersedia' }}</td></tr>
            <tr><td>Program pengajian</td><td>{{ $student->programme ?? 'Belum tersedia' }}</td></tr>
            <tr><td>Semester</td><td>{{ $student->semester ?? 'Belum tersedia' }}</td></tr>
            <tr><td>E-mel</td><td>{{ $student->email ?? Auth::user()->email ?? 'Belum tersedia' }}</td></tr>
            <tr><td>Nombor telefon</td><td>{{ $student->phone_number ?: 'Belum tersedia' }}</td></tr>
            <tr><td>Alamat kediaman</td><td>{{ $student->home_address ?: 'Belum tersedia' }}</td></tr>
        </table>

        <h2>Maklumat Waris &amp; Kecemasan</h2>
        <table>
            <tr><td>Nama waris / penjaga</td><td>{{ $student->guardian_name ?: 'Belum tersedia' }}</td></tr>
            <tr><td>Hubungan</td><td>{{ $student->guardian_relationship ?: 'Belum tersedia' }}</td></tr>
            <tr><td>Nombor telefon waris</td><td>{{ $student->guardian_phone ?: 'Belum tersedia' }}</td></tr>
            <tr><td>Pekerjaan waris</td><td>{{ $student->guardian_occupation ?: 'Belum tersedia' }}</td></tr>
            <tr><td>Majikan waris</td><td>{{ $student->guardian_employer ?: 'Belum tersedia' }}</td></tr>
        </table>

        <p class="note">Dokumen ini dijana daripada maklumat yang tersedia dalam KPMB Student Hub. Dokumen ini bukan surat pengesahan rasmi kolej dan tidak menunjukkan bahawa maklumat telah disahkan oleh pihak kolej.</p>
    </main>
</body>
</html>
