<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container">
            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fa-solid fa-table me-2"></i>Data Guru
                </h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-success btn-sm" onclick="openTambah()">
                        <i class="fa fa-plus me-1"></i>Tambah
                    </button>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="card-custom">
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $index => $g)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $g->nama_guru }}</td>
                                    <td>{{ $g->nip }}</td>
                                    <td>{{ $g->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $g->no_hp }}</td>
                                    <td>{{ $g->email }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $g->role)) }}</td>
                                    <td>
                                        {{-- Edit --}}
                                        <button class="btn btn-primary btn-sm" onclick="openEdit({{ json_encode($g) }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        {{-- Hapus --}}
                                        <form action="{{ route('guru.destroy', $g->id_guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Slide Tambah Guru --}}
            <div id="formTambah" class="custom-slide-overlay">
                <form action="{{ route('guru.store') }}" method="POST" class="custom-slide-form">
                    @csrf
                    <h5>Tambah Guru</h5>

                    <div class="mb-3">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="wali_kelas">Wali Kelas</option>
                            <option value="kepala_sekolah">Kepala Sekolah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeTambah()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Slide Edit Guru --}}
    <div id="formEdit" class="custom-slide-overlay">
        <form id="editGuruForm" method="POST" class="custom-slide-form">
            @csrf
            @method('PUT')
            <h5>Edit Guru</h5>

            <input type="hidden" name="id_guru" id="edit_id_guru">

            <div class="mb-3">
                <label>Nama Guru</label>
                <input type="text" name="nama_guru" id="edit_nama_guru" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>NIP</label>
                <input type="text" name="nip" id="edit_nip" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" id="edit_no_hp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" id="edit_username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="edit_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" id="edit_role" class="form-control" required>
                    <option value="wali_kelas">Wali Kelas</option>
                    <option value="kepala_sekolah">Kepala Sekolah</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="closeEdit()">Batal</button>
            </div>
        </form>
    </div>

    {{-- Script --}}
    <script>
        function openTambah() {
            document.getElementById('formTambah').classList.add('active');
        }

        function closeTambah() {
            document.getElementById('formTambah').classList.remove('active');
        }

        function openEdit(data) {
            const form = document.getElementById('editGuruForm');
            form.action = `/guru/${data.id_guru}`;

            document.getElementById('edit_id_guru').value = data.id_guru;
            document.getElementById('edit_nama_guru').value = data.nama_guru;
            document.getElementById('edit_nip').value = data.nip;
            document.getElementById('edit_jenis_kelamin').value = data.jenis_kelamin;
            document.getElementById('edit_no_hp').value = data.no_hp ?? '';
            document.getElementById('edit_username').value = data.username;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_role').value = data.role;

            document.getElementById('formEdit').classList.add('active');
        }

        function closeEdit() {
            document.getElementById('formEdit').classList.remove('active');
        }
    </script>

    @endsection
</x-main>
