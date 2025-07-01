<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container">
            <h4 class="mb-3"><i class="fa-solid fa-square-poll-vertical me-2"></i>Hasil Keputusan Beasiswa</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif



            <div class="card-custom">
                <a href="{{ route('keputusan.hitung') }}" class="btn btn-outline-primary mb-3">
                    <i class="fa-solid fa-calculator"></i> Hitung SAW Otomatis
                </a>
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Nilai Akhir</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keputusan->sortByDesc('nilai_akhir')->values() as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->siswa->nama_lengkap ?? '-' }}</td>
                                <td>{{ number_format($item->nilai_akhir, 4) }}</td>
                                <td>
                                    @if($item->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Diproses</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-detail"
                                            data-nis="{{ $item->nis }}"
                                            data-nama="{{ $item->siswa->nama_lengkap ?? '-' }}"
                                            data-nilai="{{ $item->nilai_akhir }}"
                                            data-status="{{ $item->status }}"
                                            data-penilaian='@json($item->siswa->penilaian->load("kriteria"))'>
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <a href="{{ route('keputusan.export', $item->nis) }}" class="btn btn-sm btn-secondary" target="_blank">
                                        <i class="fa fa-file-pdf"></i> PDF
                                    </a>

                                    <button class="btn btn-sm btn-primary btn-edit-status"
                                            data-id="{{ $item->id }}"
                                            data-status="{{ $item->status }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <form action="{{ route('keputusan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Slide-up Edit Form -->
            <div id="slideForm" class="custom-slide-overlay">
                <form method="POST" id="editForm" class="custom-slide-form">
                    @csrf
                    @method('PUT')
                    <h5 class="text-center mb-3">Ubah Status Keputusan</h5>
                    <input type="hidden" name="id" id="formId">
                    <select name="status" id="formStatus" class="form-control mb-3">
                        <option value="diproses">Diproses</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" id="closeSlide">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Slide-up Detail Modal -->
            <div class="custom-slide-overlay" id="detailModal">
                <div class="custom-slide-form">
                    <h5 class="text-center mb-3">Detail Perhitungan SAW</h5>
                    <p><strong>NIS:</strong> <span id="modalNIS"></span></p>
                    <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                    <p><strong>Nilai Akhir:</strong> <span id="modalNilaiAkhir"></span></p>
                    <div id="detailPerhitungan"></div>
                    <a id="pdfDownloadBtn" href="#" target="_blank" class="btn btn-danger w-100 mt-3">
                        <i class="fa fa-file-pdf"></i> Unduh PDF
                    </a>
                    <button class="btn btn-secondary w-100 mt-2" onclick="document.getElementById('detailModal').classList.remove('active')">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-edit-status').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const status = btn.dataset.status;
                document.getElementById('formId').value = id;
                document.getElementById('formStatus').value = status;
                document.getElementById('editForm').setAttribute('action', `/keputusan/${id}`);
                document.getElementById('slideForm').classList.add('active');
            });
        });

        document.getElementById('closeSlide').addEventListener('click', () => {
            document.getElementById('slideForm').classList.remove('active');
        });

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const nis = btn.dataset.nis;
                const nama = btn.dataset.nama;
                const status = btn.dataset.status;
                const nilai = btn.dataset.nilai;
                const penilaian = JSON.parse(btn.dataset.penilaian);

                document.getElementById('modalNIS').textContent = nis;
                document.getElementById('modalNama').textContent = nama;
                document.getElementById('modalStatus').textContent = status;
                document.getElementById('modalNilaiAkhir').textContent = parseFloat(nilai).toFixed(4);
                document.getElementById('pdfDownloadBtn').href = `/keputusan/${nis}/export`;

                let html = `<table class="table table-bordered">
                    <thead><tr>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                        <th>Bobot</th>
                        <th>Sifat</th>
                        <th>Normalisasi</th>
                        <th>Hasil</th>
                    </tr></thead><tbody>`;

                penilaian.forEach(p => {
                    const nilai = parseFloat(p.nilai);
                    const bobot = parseFloat(p.kriteria.bobot);
                    const sifat = p.kriteria.sifat;
                    const max = p.kriteria.nilai_maks ?? 1;
                    const min = p.kriteria.nilai_min ?? 1;
                    let normalisasi = sifat === 'benefit' ? (nilai / max) : (min / nilai);
                    const hasil = normalisasi * bobot;

                    html += `<tr>
                        <td>${p.kriteria.nama_kriteria}</td>
                        <td>${nilai}</td>
                        <td>${bobot}</td>
                        <td>${sifat}</td>
                        <td>${normalisasi.toFixed(4)}</td>
                        <td>${hasil.toFixed(4)}</td>
                    </tr>`;
                });

                html += '</tbody></table>';
                html += '<p class="mt-2">Rumus: <code>Normalisasi = nilai / max (benefit) atau min / nilai (cost)</code><br>Hasil akhir = ∑(normalisasi × bobot)</p>';

                document.getElementById('detailPerhitungan').innerHTML = html;
                document.getElementById('detailModal').classList.add('active');
            });
        });
    </script>
    @endsection
</x-main>
