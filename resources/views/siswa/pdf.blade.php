<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
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

        .kop h3 {
            font-size: 16px;
        }

        .kop h4 {
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        .table th {
            background-color: #eee;
        }

        .footer-ttd {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            position: relative;
        }

        .footer-ttd .tanggal {
            font-size: 12px;
            white-space: nowrap;
        }

        .footer-ttd .mengetahui {
            text-align: right;
            font-size: 12px;
        }

        .wali-kelas {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        <img src="{{ public_path('assets/logo/logo.jpg') }}" alt="Logo">
        <h3>SEKOLAH MENENGAH ATAS NEGERI 17</h3>
        <h4>KABUPATEN BUNGO, PROVINSI JAMBI</h4>
        <p>Renah Sungai Ipuh, Kec. Limbur Lubuk Mengkuang, Kabupaten Bungo, Jambi 37211</p>
    </div>


    @php
        $kelasSiswa = $siswa->pluck('kelas.nama_kelas')->unique()->implode(', ');
    @endphp

    {{-- JUDUL --}}
    <h4 style="text-align:center; margin-bottom: 10px;">DATA SISWA {{ $kelasSiswa ?: '-' }}</h4>

    {{-- TABEL DATA --}}
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Nilai Rapor</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{ $s->nilai_rapor }}</td>
                    <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- WALI KELAS --}}
    @if($waliKelas)
        <div class="wali-kelas">
            <p><strong>Wali Kelas:</strong> {{ $waliKelas->nama_guru }} (NIP. {{ $waliKelas->nip ?? '-' }})</p>
        </div>
    @endif

    {{-- TANGGAL & TTD --}}
    <div class="footer-ttd">
        <div class="mengetahui">
            <p><strong>Mengetahui,</strong>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            @if($kepalaSekolah)
                <p><strong><u>{{ $kepalaSekolah->nama_guru }}</u></strong><br>
                NIP. {{ $kepalaSekolah->nip ?? '-' }}</p>
            @else
                <p><strong><u>-</u></strong><br>
                NIP. -</p>
            @endif
        </div>
    </div>

</body>
</html>
