<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="container">

            <div class="profile-card text-center">
                @php
                    $userName = session('user_name');
                    $userRole = session('user_role'); // 'admin', 'wali_kelas', 'kepala_sekolah'
                    $avatar = "https://ui-avatars.com/api/?name=" . urlencode($userName) . "&background=00ffaa&color=000";
                    $username = session('username');
                    $email = session('email');
                @endphp

                <h2 class="text-center mb-4">Profil {{ ucfirst(str_replace('_', ' ', $userRole)) }}</h2>

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                {{-- Error validasi --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Avatar --}}
                <img src="{{ $avatar }}" class="avatar mb-3" alt="Avatar">

                <form action="{{ route('admin.profile.update') }}" method="POST" id="profileForm">
                    @csrf

                    {{-- Username --}}
                    <p class="info"><strong>Username:</strong> {{ $username }}</p>

                    {{-- Nama --}}
                    <div class="mb-3 d-flex align-items-center justify-content-center gap-2">
                        <input type="text" name="nama" id="nama" class="form-control text-center"
                               value="{{ old('nama', $userName) }}" readonly style="max-width: 300px;">
                        <button type="button" class="btn btn-outline-light btn-sm"
                                onclick="enableField('nama')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 d-flex align-items-center justify-content-center gap-2">
                        <input type="email" name="email" id="email" class="form-control text-center"
                               value="{{ old('email', $email) }}" readonly style="max-width: 300px;">
                        <button type="button" class="btn btn-outline-light btn-sm"
                                onclick="enableField('email')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>

                    {{-- Ubah Password --}}
                    <div class="mb-3">
                        <button type="button" class="btn btn-edit" onclick="togglePasswordFields()">Ubah Password</button>
                    </div>

                    {{-- Password Fields --}}
                    <div id="passwordFields" style="display: none;">
                        <div class="mb-3 position-relative" style="max-width: 300px; margin: auto;">
                            <input type="password" name="password" id="password" class="form-control text-center" placeholder="Password Baru">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                  onclick="toggleVisibility('password')" style="cursor: pointer;">
                                <i class="fa-solid fa-eye" id="eye-password"></i>
                            </span>
                        </div>
                        <div class="mb-3 position-relative" style="max-width: 300px; margin: auto;">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control text-center" placeholder="Konfirmasi Password">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                  onclick="toggleVisibility('password_confirmation')" style="cursor: pointer;">
                                <i class="fa-solid fa-eye" id="eye-password_confirmation"></i>
                            </span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-edit">Simpan</button>
                        <button type="button" class="btn btn-danger" id="cancelBtn" onclick="cancelEdit()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
</x-main>
