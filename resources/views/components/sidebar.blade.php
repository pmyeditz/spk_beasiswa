<div class="sidebar" id="sidebar">
    <div class="logo mb-4">SPK BEASISWA</div>

    <!-- Dashboard -->
    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-gauge-high me-2"></i>
        <span>Dashboard</span>
    </a>

    <!-- Dropdown: Data Siswa -->
    <div class="dropdown">
        <a href="#" class="dropdown-toggle d-flex align-items-center {{ request()->is('siswa*') || request()->is('kelas*') ? 'active' : '' }}"
           role="button" id="dropdownSiswa" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-users-line me-2"></i>
            <span>Data Siswa</span>
        </a>
        <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownSiswa">
            <li>
                <a href="/siswa" class="dropdown-item text-white {{ request()->is('siswa*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate me-2"></i> Siswa
                </a>
            </li>
            <li>
                <a href="/kelas" class="dropdown-item text-white {{ request()->is('kelas*') ? 'active' : '' }}">
                    <i class="fa-solid fa-school me-2"></i> Kelas
                </a>
            </li>
        </ul>
    </div>

    <!-- Menu Lain -->
    {{-- <a href="/pendaftar" class="{{ request()->is('pendaftar*') ? 'active' : '' }}">
        <i class="fa-solid fa-user-pen me-2"></i>
        <span>Data Pendaftar</span>
    </a> --}}

    <a href="/kriteria" class="{{ request()->is('kriteria*') ? 'active' : '' }}">
        <i class="fa-solid fa-layer-group me-2"></i>
        <span>Data Kriteria</span>
    </a>

    <a href="/penilaian" class="{{ request()->is('penilaian*') ? 'active' : '' }}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        <span>Penilaian</span>
    </a>

    {{-- <a href="/perhitungan" class="{{ request()->is('perhitungan*') ? 'active' : '' }}">
        <i class="fa-solid fa-scale-balanced me-2"></i>
        <span>Perhitungan SAW</span>
    </a> --}}

    <a href="/keputusan" class="{{ request()->is('keputusan*') ? 'active' : '' }}">
        <i class="fa-solid fa-square-poll-vertical me-2"></i>
        <span>Hasil Keputusan</span>
    </a>

    <a href="/laporan" class="{{ request()->is('laporan*') ? 'active' : '' }}">
        <i class="fa-solid fa-print me-2"></i>
        <span>Cetak Laporan</span>
    </a>

    <a href="/pengaturan" class="{{ request()->is('pengaturan*') ? 'active' : '' }}">
        <i class="fa-solid fa-gear me-2"></i>
        <span>Pengaturan Akun</span>
    </a>

    <hr class="text-white mt-4">

    <!-- Profil Admin -->
    <a href="{{ route('admin.profile') }}"
       class="d-flex align-items-center gap-2 text-white fw-bold mb-3 text-decoration-none {{ request()->is('profile') ? 'active' : '' }}">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->nama_admin) }}&background=00ffaa&color=000"
             alt="Avatar Admin" class="rounded-circle" width="40" height="40">
        <span>{{ $admin->nama_admin }}</span>
    </a>

    <!-- Logout -->
    <form action="/logout" method="POST" class="text-center">
        @csrf
        <button type="submit" class="btn btn-outline-light btn-sm">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
        </button>
    </form>
</div>

<!-- Navbar -->
<div class="navbar d-flex align-items-center justify-content-between px-3">
    <button class="btn btn-success" id="menuBtn">
        <i class="fa-solid fa-bars"></i>
    </button>
    <h5 class="m-0 text-white">Dashboard Overview</h5>
</div>
