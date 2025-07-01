<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container position-relative">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Header --}}
            <div class="d-flex justify-content-between mb-3">
                <h4><i class="fa-solid fa-clipboard-list me-2"></i>Data Penilaian</h4>
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
                                <td>{{ $item->nilai }}</td>
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

                    <select name="id_kriteria" class="form-control mb-2" required>
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach($kriteria as $k)
                            <option value="{{ $k->id_kriteria }}">{{ $k->nama_kriteria }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="nilai" step="0.01" class="form-control mb-3" placeholder="Nilai" required>

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
    </script>

    @endsection
    </x-main>
