<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Menampilkan form input email
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    // Mengirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Coba cari di Admin, jika tidak ada cari di Guru
        $user = Admin::where('email', $request->email)->first()
            ?? Guru::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar']);
        }

        $now = Carbon::now();
        $lastSentTime = Session::get('otp_sent_time');

        // Batas kirim ulang OTP: 5 menit (300 detik)
        if ($lastSentTime && $now->diffInSeconds(Carbon::parse($lastSentTime)) < 300) {
            $sisa = 300 - $now->diffInSeconds(Carbon::parse($lastSentTime));
            $menit = floor($sisa / 60);
            $detik = $sisa % 60;

            return back()
                ->withErrors(['email' => "OTP sudah dikirim. Silakan coba lagi dalam {$menit} menit {$detik} detik."])
                ->with('countdown', $sisa);
        }

        $otp = rand(100000, 999999);

        Session::put('otp', $otp);
        Session::put('email_reset', $request->email);
        Session::put('otp_sent_time', $now);
        Session::put('otp_used', false);

        Mail::send('emails.otp', [
            'otp' => $otp,
            'nama' => $user->nama_admin ?? $user->nama_guru,
            'email' => $user->email
        ], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Kode OTP Reset Password - SPK BEASISWA');
        });

        return redirect()->route('password.verify')->with('success', 'OTP telah dikirim ke email kamu.');
    }

    // Tampilkan form verifikasi OTP
    public function showVerifyForm()
    {
        return view('auth.verify'); // form input OTP
    }

    // Proses verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $otpSession = Session::get('otp');
        $otpUsed = Session::get('otp_used');

        if ($otpUsed) {
            return back()->withErrors(['otp' => 'Kode OTP sudah digunakan. Silahkan tunggu atau minta ulang.']);
        }

        if ($request->otp == $otpSession) {
            Session::put('otp_verified', true);
            Session::put('otp_used', true);
            return redirect()->route('password.reset.form');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah.']);
    }

    // Tampilkan form reset password
    public function showResetForm()
    {
        if (!Session::get('otp_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset'); // form input password baru
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        if (!Session::get('otp_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $email = Session::get('email_reset');
        $user = Admin::where('email', $email)->first()
            ?? Guru::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('password.reset.form')->withErrors([
                'password' => 'Password baru tidak boleh sama dengan password sebelumnya.'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Session::forget([
            'otp',
            'email_reset',
            'otp_verified',
            'otp_sent_time',
            'otp_used'
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil diubah.');
    }
}
