<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container">
            <h2 class="mt-4 mb-4">Manajemen Kelas</h2>

            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form Tambah Kelas --}}
            <div class="card-custom mb-5">
                <h5 class="mb-3"><i class="fa-solid fa-plus me-2"></i>Tambah Kelas</h5>
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="wali_kelas" class="form-control" placeholder="Wali Kelas (opsional)">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Data --}}
            <div class="card-custom">
                <div class="table-responsive">
                    <table id="ztrixTable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row->nama_kelas }}</td>
                                <td>{{ $row->wali_kelas ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Aktif</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('kelas.destroy', $row->id_kelas) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE') {{-- Tambahkan baris ini --}}
                                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data kelas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @endsection
</x-main>
