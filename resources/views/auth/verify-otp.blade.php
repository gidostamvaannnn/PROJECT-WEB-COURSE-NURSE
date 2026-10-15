@extends('layouts.auth')

@section('title', 'Verifikasi OTP')

@section('content')
<div>
    <h2 class="text-xl font-headline-md font-bold text-on-surface text-center mb-1">Verifikasi Email</h2>
    <p class="text-sm font-body-md text-on-surface-variant text-center mb-6">Kami telah mengirimkan 6 digit kode OTP ke email <strong class="text-primary">{{ $email }}</strong>.</p>

    <form action="{{ route('verify-otp.submit') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface text-center mb-2" for="otp">Masukkan Kode OTP</label>
            <input type="text" id="otp" name="otp" class="block w-full py-3 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-center font-bold text-2xl tracking-[8px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('otp') border-error focus:ring-error focus:border-error @enderror" placeholder="123456" maxlength="6" required autofocus autocomplete="off">
            @error('otp')
                <p class="mt-1 text-xs text-error font-body-md text-center">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
            <span>Verifikasi Kode OTP</span>
            <span class="material-symbols-outlined text-[18px]">verified_user</span>
        </button>
    </form>

    <div class="mt-4 text-center">
        <form action="{{ route('resend-otp') }}" method="POST" class="inline">
            @csrf
            <span class="text-xs text-on-surface-variant">Tidak menerima kode? </span>
            <button type="submit" class="text-xs font-bold text-primary hover:underline">
                Kirim Ulang OTP
            </button>
        </form>
    </div>

    <div class="mt-6 text-center text-xs font-body-md text-on-surface-variant pt-4 border-t border-outline-variant/30">
        <a href="{{ route('register') }}" class="inline-flex items-center gap-1 text-on-surface-variant hover:text-primary">
            <span class="material-symbols-outlined text-[14px]">arrow_back</span>
            <span>Ganti Email Pendaftaran</span>
        </a>
    </div>
</div>
@endsection
