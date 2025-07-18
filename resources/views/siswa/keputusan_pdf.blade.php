<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan SAW & Surat Penerimaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
            position: relative;
        }

        .kop img {
            position: absolute;
            width: 55px;
            height: auto;
            margin: -10px 0 0 30px;
        }

        .kop h3, .kop h4, .kop p {
            margin: 0;
        }

        .kop h3 { font-size: 16px; }
        .kop h4 { font-size: 14px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
        }

        .page-break {
            page-break-after: always;
        }

        .ttd {
            margin-top: 60px;
            width: 100%;
            text-align: center;
        }

        .ttd td {
            vertical-align: top;
            text-align: center;
            padding: 10px;
        }

        .ttd p {
            margin: 3px 0;
        }

        /* Table tanpa border untuk surat */
        .table-noborder {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .ttdno {
            border :none;
        }

        .table-noborder td {
            border: none !important;
            text-align: left;
            padding: 4px 0;
        }
    </style>
</head>
<body>

    {{-- LEMBAR 1: DETAIL PERHITUNGAN SAW --}}
    <div class="kop">
        <img src="{{ public_path('assets/logo/logo.jpg') }}" alt="Logo">
        <h3>SEKOLAH MENENGAH ATAS NEGERI 17</h3>
        <h4>KABUPATEN BUNGO, PROVINSI JAMBI</h4>
        <p>Renah Sungai Ipuh, Kec. Limbur Lubuk Mengkuang, Kabupaten Bungo, Jambi 37211</p>
    </div>

    <h3 align="center">Laporan Detail SAW Beasiswa</h3>

    <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
    <p><strong>Nama:</strong> {{ $siswa->nama_lengkap }}</p>

    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Nilai</th>
                <th>Bobot</th>
                <th>Sifat</th>
                <th>Normalisasi</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d['kriteria'] }}</td>
                    <td>{{ $d['nilai'] }}</td>
                    <td>{{ $d['bobot'] }}</td>
                    <td>{{ $d['sifat'] }}</td>
                    <td>{{ $d['normalisasi'] }}</td>
                    <td>{{ $d['hasil'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Nilai Akhir:</strong> {{ $total }}</p>
        <p><i>Rumus: Normalisasi = nilai ÷ max (benefit) atau min ÷ nilai (cost), Hasil = normalisasi × bobot</i></p>
    </div>

    {{-- PAGE BREAK --}}
    <div class="page-break"></div>

    {{-- LEMBAR 2: SURAT PENERIMAAN / PENOLAKAN --}}
    <div class="kop">
        <img src="{{ public_path('assets/logo/logo.jpg') }}" alt="Logo">
        <h3>SEKOLAH MENENGAH ATAS NEGERI 17</h3>
        <h4>KABUPATEN BUNGO, PROVINSI JAMBI</h4>
        <p>Renah Sungai Ipuh, Kec. Limbur Lubuk Mengkuang, Kabupaten Bungo, Jambi 37211</p>
    </div>

    @if($siswa->keputusan && $siswa->keputusan->status === 'diterima')
        <h3 style="text-align:center;">SURAT KETERANGAN PENERIMA BEASISWA</h3>

        <p>Yang bertanda tangan di bawah ini:</p>
        <table class="table-noborder" style="margin-bottom: 15px;">
            <tr><td>Nama</td><td>: {{ $kepalaSekolah->nama_guru ?? '-' }}</td></tr>
            <tr><td>NIP</td><td>: {{ $kepalaSekolah->nip ?? '-' }}</td></tr>
            <tr><td>Jabatan</td><td>: Kepala Sekolah</td></tr>
        </table>

        <p>Menyatakan bahwa:</p>
        <table class="table-noborder" style="margin-bottom: 15px;">
            <tr><td>Nama</td><td>: {{ $siswa->nama_lengkap }}</td></tr>
            <tr><td>NIS</td><td>: {{ $siswa->nis }}</td></tr>
            <tr><td>Kelas</td><td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td></tr>
        </table>

        <p>Telah memenuhi syarat sebagai <strong>penerima beasiswa</strong> berdasarkan hasil seleksi dengan metode SAW.</p>
        <p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

        <table class="ttd">
            <tr>
                <td class="ttdno">
                    Mengetahui,............<br>
                    Wali Kelas<br><br><br><br>
                    <strong><u>{{ $waliKelas->nama_guru ?? '-' }}</u></strong><br>
                    NIP. {{ $waliKelas->nip ?? '-' }}
                </td>
                <td class="ttdno">
                    Mengetahui,............<br>
                    Kepala Sekolah<br><br><br><br>
                    <strong><u>{{ $kepalaSekolah->nama_guru ?? '-' }}</u></strong><br>
                    NIP. {{ $kepalaSekolah->nip ?? '-' }}
                </td>
            </tr>
        </table>
    @else
        <h3 style="text-align:center;">SURAT KETERANGAN TIDAK MENERIMA BEASISWA</h3>
        <p>Dengan ini kami menyatakan bahwa:</p>
        <table class="table-noborder" style="margin-bottom: 15px;">
            <tr><td>Nama</td><td>: {{ $siswa->nama_lengkap }}</td></tr>
            <tr><td>NIS</td><td>: {{ $siswa->nis }}</td></tr>
            <tr><td>Kelas</td><td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td></tr>
        </table>

        <p>Tidak termasuk dalam penerima beasiswa karena belum memenuhi kriteria yang ditentukan berdasarkan metode SAW.</p>
        <p>Demikian surat ini dibuat untuk menjadi perhatian.</p>

        <div class="ttd ttdno">
            <p>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p><strong>Mengetahui,</strong></p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p><strong><u>{{ $kepalaSekolah->nama_guru ?? '-' }}</u></strong><br>
            NIP. {{ $kepalaSekolah->nip ?? '-' }}</p>
        </div>
    @endif

</body>
</html>
