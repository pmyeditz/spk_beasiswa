<!DOCTYPE html>
<html>
<head>
    <title>Detail Perhitungan SAW</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #000; text-align: center; }
    </style>
</head>
<body>
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

    <p><strong>Nilai Akhir:</strong> {{ $total }}</p>
    <p><i>Rumus: Normalisasi = nilai/max (benefit) atau min/nilai (cost), Hasil = normalisasi × bobot</i></p>
</body>
</html>
