<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container position-relative">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @php
                $kelasSiswa = $siswa->pluck('kelas.nama_kelas')->unique()->implode(', ');
            @endphp
            {{-- Header --}}
            <div class="d-flex justify-content-between mb-3">
                <h4><i class="fa-solid fa-clipboard-list me-2"></i>Data Penilaian Kelas <strong>{{ $kelasSiswa ?: '-' }}</strong></h4>
                <button class="btn btn-success btn-sm" onclick="openTambah()">+ Tambah</button>
            </div>

            {{-- Tabel --}}
            <div class="card-custom">
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaian as $item)
                            <tr>
                                <td>{{ $item->siswa->nama_lengkap }}</td>
                                <td>{{ $item->kriteria->nama_kriteria }}</td>
                                <td>
                                    @if($item->id_kriteria == 4)
                                        Rp {{ number_format($item->nilai, 0, ',', '.') }}
                                    @else
                                        {{ $item->nilai }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('penilaian.destroy', $item->id_penilaian) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <button class="btn btn-primary btn-sm"
                                        onclick="openEdit('{{ $item->id_penilaian }}', '{{ $item->nilai }}')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SLIDE-UP Tambah Penilaian --}}
            <div id="formTambah" class="custom-slide-overlay">
                <form action="{{ route('penilaian.store') }}" method="POST" class="custom-slide-form">
                    @csrf
                    <h5 class="mb-3">Tambah Penilaian</h5>

                    <select name="nis" class="form-control mb-2" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->nis }}">{{ $s->nama_lengkap }}</option>
                        @endforeach
                    </select>

                    <select name="id_kriteria" id="kriteriaSelect" class="form-control mb-2" required>
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach($kriteria as $k)
                            <option value="{{ $k->id_kriteria }}">{{ $k->nama_kriteria }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="nilai" id="nilaiInput" class="form-control mb-3" placeholder="Nilai" required>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeTambah()">Batal</button>
                    </div>
                </form>
            </div>

            {{-- SLIDE-UP Edit Penilaian --}}
            <div id="formEdit" class="custom-slide-overlay">
                <form id="editForm" method="POST" class="custom-slide-form">
                    @csrf
                    @method('PUT')
                    <h5 class="mb-3">Edit Nilai</h5>
                    <input type="number" name="nilai" id="nilaiEdit" step="0.01" class="form-control mb-3" required>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeEdit()">Batal</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
    function openTambah() {
        document.getElementById('formTambah').classList.add('active');
    }
    function closeTambah() {
        document.getElementById('formTambah').classList.remove('active');
    }

    function openEdit(id, nilai) {
        const form = document.getElementById('editForm');
        form.action = `/penilaian/${id}`;
        document.getElementById('nilaiEdit').value = nilai;
        document.getElementById('formEdit').classList.add('active');
    }
    function closeEdit() {
        document.getElementById('formEdit').classList.remove('active');
    }

    // Format angka ke Rupiah
    function formatRupiah(angka, prefix = 'Rp ') {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            rupiah += (sisa ? '.' : '') + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    document.getElementById('kriteriaSelect').addEventListener('change', function () {
        const selectedId = this.value;
        const nilaiInput = document.getElementById('nilaiInput');

        if (selectedId == 4) { // ID 4 = Penghasilan Ortu
            nilaiInput.placeholder = "Masukkan nominal dalam Rupiah";
            nilaiInput.value = "";
            nilaiInput.type = "text";

            nilaiInput.addEventListener('input', function formatInput(e) {
                this.value = formatRupiah(this.value, 'Rp ');
            });
        } else {
            nilaiInput.placeholder = "Nilai (0 - 100)";
            nilaiInput.type = "number";
            nilaiInput.value = "";
            // Menghapus event listener agar tidak bentrok
            nilaiInput.replaceWith(nilaiInput.cloneNode(true));
            document.getElementById('nilaiInput').setAttribute('name', 'nilai');
            document.getElementById('nilaiInput').setAttribute('id', 'nilaiInput');
            document.getElementById('nilaiInput').setAttribute('class', 'form-control mb-3');
        }
    });
    </script>

    @endsection
    </x-main>
