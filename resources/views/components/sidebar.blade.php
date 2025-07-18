@php
    $userName = session('user_name');
    $userRole = session('user_role');
    $avatarName = urlencode($userName);
@endphp

<div class="sidebar" id="sidebar">
    <div class="logo mb-4">SPK BEASISWA</div>

    <!-- Dashboard -->
    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-gauge-high me-2"></i>
        <span>Dashboard</span>
    </a>

    {{-- ✅ Kelola Data Siswa (admin & wali_kelas) --}}
    @if($userRole === 'admin' || $userRole === 'wali_kelas')
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

            {{-- ✅ Menu Kelas hanya untuk admin --}}
            @if($userRole === 'admin')
            <li>
                <a href="/kelas" class="dropdown-item text-white {{ request()->is('kelas*') ? 'active' : '' }}">
                    <i class="fa-solid fa-school me-2"></i> Kelas
                </a>
            </li>
            @endif
        </ul>
    </div>
    @endif

    {{-- ✅ Kriteria (admin) --}}
    @if($userRole === 'admin')
    <a href="/kriteria" class="{{ request()->is('kriteria*') ? 'active' : '' }}">
        <i class="fa-solid fa-layer-group me-2"></i>
        <span>Data Kriteria</span>
    </a>
    @endif

    {{-- ✅ Penilaian (admin & wali_kelas) --}}
    @if($userRole === 'admin' || $userRole === 'wali_kelas')
    <a href="/penilaian" class="{{ request()->is('penilaian*') ? 'active' : '' }}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        <span>Penilaian</span>
    </a>
    @endif

    {{-- ✅ Keputusan (semua role) --}}
    <a href="/keputusan" class="{{ request()->is('keputusan*') ? 'active' : '' }}">
        <i class="fa-solid fa-square-poll-vertical me-2"></i>
        <span>Hasil Keputusan</span>
    </a>

    {{-- ✅ Laporan (admin & kepala sekolah) --}}
    @if($userRole === 'admin' || $userRole === 'kepala_sekolah')
    <a href="/laporan" class="{{ request()->is('laporan*') ? 'active' : '' }}">
        <i class="fa-solid fa-print me-2"></i>
        <span>Cetak Laporan</span>
    </a>
    @endif

    {{-- ✅ Pengaturan akun (semua role) --}}
    <a href="/guru" class="{{ request()->is('pengaturan*') ? 'active' : '' }}">
        <i class="fa-solid fa-gear me-2"></i>
        <span>Pengaturan Akun</span>
    </a>

    <hr class="text-white mt-4">

    {{-- ✅ Profile Info --}}
    <a href="{{ route('admin.profile') }}"
       class="d-flex align-items-center gap-2 text-white fw-bold mb-3 text-decoration-none {{ request()->is('profile') ? 'active' : '' }}">
        <img src="https://ui-avatars.com/api/?name={{ $avatarName }}&background=00ffaa&color=000"
             alt="Avatar" class="rounded-circle" width="40" height="40">
        <span>{{ $userName }}</span>
    </a>

    {{-- ✅ Logout --}}
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
