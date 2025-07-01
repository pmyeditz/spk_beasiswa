<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0"><i class="fa-solid fa-table me-2"></i>Data Siswa</h4>
                <button class="btn btn-success btn-sm" onclick="openTambah()">+ Tambah Siswa</button>
            </div>

            {{-- Tabel --}}
            <div class="card-custom">
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Nilai Rapor</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $row)
                            <tr>
                                <td>{{ $row->nis }}</td>
                                <td>{{ $row->nama_lengkap }}</td>
                                <td>{{ $row->jenis_kelamin }}</td>
                                <td>{{ $row->nilai_rapor }}</td>
                                <td>{{ $row->kelas->nama_kelas }}</td>
                                <td>
                                    <form action="{{ route('siswa.destroy', $row->nis) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-primary btn-sm" onclick="openEdit({{ json_encode($row) }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SLIDE Tambah Siswa --}}
            <div id="formTambah" class="custom-slide-overlay">
                <form action="{{ route('siswa.store') }}" method="POST" class="custom-slide-form">
                    @csrf
                    <h5>Tambah Siswa</h5>

                    <input type="text" name="nis" class="form-control mb-2" placeholder="NIS" required>
                    <input type="text" name="nama_lengkap" class="form-control mb-2" placeholder="Nama Lengkap" required>

                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="">-- Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <input type="number" step="0.01" name="nilai_rapor" class="form-control mb-2" placeholder="Nilai Rapor" required>

                    <select name="id_kelas" class="form-control mb-2" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeTambah()">Batal</button>
                    </div>
                </form>
            </div>

            {{-- SLIDE Edit Siswa --}}
            <div id="formEdit" class="custom-slide-overlay">
                <form id="editForm" method="POST" class="custom-slide-form">
                    @csrf
                    @method('PUT')
                    <h5>Edit Siswa</h5>

                    <input type="text" name="nama_lengkap" id="editNama" class="form-control mb-2" required>
                    <select name="jenis_kelamin" id="editGender" class="form-control mb-2" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <input type="number" step="0.01" name="nilai_rapor" id="editNilai" class="form-control mb-2" required>
                    <select name="id_kelas" id="editKelas" class="form-control mb-2" required>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>

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
        function openEdit(row) {
            const form = document.getElementById('editForm');
            form.action = `/siswa/${row.nis}`;
            document.getElementById('editNama').value = row.nama_lengkap;
            document.getElementById('editGender').value = row.jenis_kelamin;
            document.getElementById('editNilai').value = row.nilai_rapor;
            document.getElementById('editKelas').value = row.id_kelas;
            document.getElementById('formEdit').classList.add('active');
        }
        function openTambah() {
            document.getElementById('formTambah').classList.add('active');
        }

        function closeTambah() {
            document.getElementById('formTambah').classList.remove('active');
        }

        function closeEdit() {
            document.getElementById('formEdit').classList.remove('active');
        }
    </script>

    @endsection
</x-main>
