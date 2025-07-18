<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru'     => 'required|max:30',
            'nip'           => 'required|max:20|unique:guru,nip',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'nullable|max:12',
            'username'      => 'required|max:20|unique:guru,username',
            'email'         => 'required|email|max:50|unique:guru,email',
            'role'          => 'required|in:wali_kelas,kepala_sekolah',
            'password'      => 'required|min:6',
        ], [
            'nama_guru.required'     => 'Nama guru wajib diisi.',
            'nama_guru.max'          => 'Nama guru maksimal 30 karakter.',
            'nip.required'           => 'NIP wajib diisi.',
            'nip.max'                => 'NIP maksimal 20 karakter.',
            'nip.unique'             => 'NIP sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin harus L atau P.',
            'no_hp.max'              => 'No HP maksimal 12 digit.',
            'username.required'      => 'Username wajib diisi.',
            'username.max'           => 'Username maksimal 20 karakter.',
            'username.unique'        => 'Username sudah terdaftar.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.max'              => 'Email maksimal 50 karakter.',
            'email.unique'           => 'Email sudah terdaftar.',
            'role.required'          => 'Role wajib dipilih.',
            'role.in'                => 'Role tidak valid.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 6 karakter.',
        ]);

        // Cek apakah role kepala sekolah sudah ada
        if ($request->role === 'kepala_sekolah') {
            $sudahAdaKepala = Guru::where('role', 'kepala_sekolah')->exists();
            if ($sudahAdaKepala) {
                return back()->withErrors(['role' => 'Sudah ada kepala sekolah yang terdaftar.'])->withInput();
            }
        }

        $guru = new Guru();
        $guru->nama_guru     = $request->nama_guru;
        $guru->nip           = $request->nip;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->no_hp         = $request->no_hp;
        $guru->username      = $request->username;
        $guru->email         = $request->email;
        $guru->role          = $request->role;
        $guru->password      = Hash::make($request->password);
        $guru->save();


        $plainPassword = $request->password;
        // Kirim email ke guru
        Mail::send('emails.akun_guru', [
            'nama'     => $guru->nama_guru,
            'username' => $guru->username,
            'password' => $plainPassword,
            'email'    => $guru->email,
            'role'     => $guru->role,
        ], function ($message) use ($guru) {
            $message->to($guru->email)
                ->subject('Akun Guru SPK Beasiswa');
        });

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan & email dikirim.');
    }

    public function show(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama_guru'     => 'required|max:30',
            'nip'           => 'required|max:20|unique:guru,nip,' . $id . ',id_guru',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'nullable|max:12',
            'username'      => 'required|max:20|unique:guru,username,' . $id . ',id_guru',
            'email'         => 'required|email|max:50|unique:guru,email,' . $id . ',id_guru',
            'role'          => 'required|in:wali_kelas,kepala_sekolah',
            'password'      => 'nullable|min:6',
        ], [
            'nama_guru.required'     => 'Nama guru wajib diisi.',
            'nama_guru.max'          => 'Nama guru maksimal 30 karakter.',
            'nip.required'           => 'NIP wajib diisi.',
            'nip.max'                => 'NIP maksimal 20 karakter.',
            'nip.unique'             => 'NIP sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin harus L atau P.',
            'no_hp.max'              => 'No HP maksimal 12 digit.',
            'username.required'      => 'Username wajib diisi.',
            'username.max'           => 'Username maksimal 20 karakter.',
            'username.unique'        => 'Username sudah terdaftar.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.max'              => 'Email maksimal 50 karakter.',
            'email.unique'           => 'Email sudah terdaftar.',
            'role.required'          => 'Role wajib dipilih.',
            'role.in'                => 'Role tidak valid.',
            'password.min'           => 'Password minimal 6 karakter.',
        ]);

        // Cek kepala sekolah unik
        if ($request->role === 'kepala_sekolah') {
            $sudahAdaKepala = Guru::where('role', 'kepala_sekolah')
                ->where('id_guru', '!=', $id)
                ->exists();

            if ($sudahAdaKepala) {
                return back()->withErrors(['role' => 'Sudah ada kepala sekolah yang terdaftar.'])->withInput();
            }
        }

        $guru->nama_guru     = $request->nama_guru;
        $guru->nip           = $request->nip;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->no_hp         = $request->no_hp;
        $guru->username      = $request->username;
        $guru->email         = $request->email;
        $guru->role          = $request->role;

        // Ambil password lama jika tidak diubah
        if ($request->filled('password')) {
            $plainPassword = $request->password;
            $guru->password = Hash::make($plainPassword);
            $guru->plain_password = $plainPassword;
        } else {
            $plainPassword = $guru->plain_password ?? '(tidak tersedia)';
        }


        $guru->save();

        // Kirim email ke guru
        Mail::send('emails.akun_guru', [
            'nama'     => $guru->nama_guru,
            'username' => $guru->username,
            'password' => $plainPassword,
            'email'    => $guru->email,
            'role'     => $guru->role,
        ], function ($message) use ($guru) {
            $message->to($guru->email)
                ->subject('Akun Guru SPK Beasiswa');
        });


        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
