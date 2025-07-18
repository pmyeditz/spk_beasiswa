<x-main>
    @section('main')
    <x-sidebar></x-sidebar>
    @php
    if (session('user_role') === 'guru') {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
@endphp

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
                    <div class="row g-3">

                        {{-- Nama Kelas --}}
                        <div class="col-md-4">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Contoh: X IPA 1" required>
                        </div>

                        {{-- Wali Kelas --}}
                        <div class="col-md-6">
                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                            <select name="wali_kelas" id="wali_kelas" class="form-select" required>
                                <option value="">-- Pilih Wali Kelas --</option>
                                @foreach($guru as $g)
                                    <option value="{{ $g->id_guru }}">{{ $g->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Tombol Simpan --}}
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa-solid fa-check me-1"></i> Simpan
                            </button>
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
                                    <td>{{ $row->wali->nama_guru ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('kelas.destroy', $row->id_kelas) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                            @csrf
                                            @method('DELETE')
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
