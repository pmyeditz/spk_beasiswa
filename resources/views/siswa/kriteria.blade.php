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
                <h4><i class="fa-solid fa-layer-group me-2"></i>Data Kriteria</h4>
                <button class="btn btn-success btn-sm" onclick="openTambahForm()">+ Tambah</button>
            </div>

            {{-- Tabel --}}
            <div class="card-custom">
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Sifat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriteria as $item)
                            <tr>
                                <td>{{ $item->nama_kriteria }}</td>
                                <td>{{ $item->bobot }}</td>
                                <td>{{ ucfirst($item->sifat) }}</td>
                                <td>
                                    <form action="{{ route('kriteria.destroy', $item->id_kriteria) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <button class="btn btn-primary btn-sm"
                                        onclick="openEditForm({{ $item->id_kriteria }}, '{{ $item->nama_kriteria }}', '{{ $item->bobot }}', '{{ $item->sifat }}')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Slide Form Edit --}}
            <div id="editForm" class="custom-slide-overlay">
                <form id="editFormReal" method="POST" class="custom-slide-form">
                    @csrf
                    @method('PUT')
                    <h5 class="mb-3">Edit Kriteria</h5>
                    <input type="text" id="edit_nama" name="nama_kriteria" class="form-control mb-2" required>
                    <input type="number" id="edit_bobot" name="bobot" step="0.01" max="1" class="form-control mb-2" required>
                    <select id="edit_sifat" name="sifat" class="form-control mb-3" required>
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-danger" onclick="closeEditForm()">Batal</button>
                    </div>
                </form>
            </div>

            {{-- Slide Form Tambah --}}
            <div id="tambahForm" class="custom-slide-overlay">
                <form action="{{ route('kriteria.store') }}" method="POST" class="custom-slide-form">
                    @csrf
                    <h5 class="mb-3">Tambah Kriteria</h5>
                    <input type="text" name="nama_kriteria" class="form-control mb-2" placeholder="Nama Kriteria" required>
                    <input type="number" name="bobot" step="0.01" max="1" class="form-control mb-2" placeholder="Bobot (misal: 0.4)" required>
                    <select name="sifat" class="form-control mb-3" required>
                        <option value="">-- Pilih Sifat --</option>
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeTambahForm()">Batal</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <script>
    function openEditForm(id, nama, bobot, sifat) {
        const form = document.getElementById('editForm');
        const route = "{{ url('kriteria') }}/" + id;
        document.getElementById('editFormReal').action = route;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_bobot').value = bobot;
        document.getElementById('edit_sifat').value = sifat;
        form.classList.add('active');
    }

    function closeEditForm() {
        document.getElementById('editForm').classList.remove('active');
    }

    function openTambahForm() {
        document.getElementById('tambahForm').classList.add('active');
    }

    function closeTambahForm() {
        document.getElementById('tambahForm').classList.remove('active');
    }
    </script>
    @endsection
    </x-main>
