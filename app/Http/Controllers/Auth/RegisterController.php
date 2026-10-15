<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.register');
    }

    public function sendOtp(Request $request)
    {
        if (auth()->check()) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $request->validate([
            'email' => 'required|email|unique:users,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        session([
            'registration_email' => $request->email,
            'registration_otp' => $otpCode,
            'registration_otp_expires' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($request->email)->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            // In development, log the OTP for testing
            \Log::info("OTP for {$request->email}: {$otpCode}");
        }

        return redirect()->route('verify-otp')
            ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function showOtpForm()
    {
        if (!session('registration_email')) {
            return redirect()->route('register');
        }

        return view('auth.verify-otp', [
            'email' => session('registration_email'),
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $sessionOtp = session('registration_otp');
        $expiresAt = session('registration_otp_expires');

        if (!$sessionOtp || now()->isAfter($expiresAt)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa. Silakan daftar ulang.']);
        }

        if ($request->otp !== $sessionOtp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        session(['otp_verified' => true]);

        return redirect()->route('create-password');
    }

    public function resendOtp()
    {
        $email = session('registration_email');
        if (!$email) {
            return redirect()->route('register');
        }

        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        session([
            'registration_otp' => $otpCode,
            'registration_otp_expires' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($email)->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            \Log::info("OTP resend for {$email}: {$otpCode}");
        }

        return back()->with('success', 'Kode OTP baru telah dikirim.');
    }

    public function showPasswordForm()
    {
        if (!session('otp_verified')) {
            return redirect()->route('register');
        }

        return view('auth.create-password', [
            'email' => session('registration_email'),
        ]);
    }

    public function createPassword(Request $request)
    {
        if (!session('otp_verified')) {
            return redirect()->route('register');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'email' => session('registration_email'),
            'password' => $request->password,
            'email_verified' => true,
            'status' => 'pending',
        ]);

        Profile::create([
            'user_id' => $user->id,
        ]);

        // Clear registration session
        session()->forget([
            'registration_email',
            'registration_otp',
            'registration_otp_expires',
            'otp_verified',
        ]);

        auth()->login($user);

        return redirect()->route('profile.edit')
            ->with('success', 'Akun berhasil dibuat! Silakan lengkapi profil Anda.');
    }
}
