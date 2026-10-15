@extends('layouts.auth')

@section('title', 'Pendaftaran Perawat')

@section('content')
<div>
    <p class="text-sm font-body-md text-on-surface-variant text-center mb-6">Masukkan email aktif Anda untuk menerima 6 digit kode OTP.</p>

    <form action="{{ route('register.send-otp') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="email">Alamat Email</label>
            <input type="email" id="email" name="email" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('email') border-error focus:ring-error focus:border-error @enderror" value="{{ old('email') }}" placeholder="perawat@domain.com" required autofocus>
            @error('email')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
            <span>Kirim Kode OTP</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </button>
    </form>

    <div class="mt-6 text-center text-xs font-body-md text-on-surface-variant pt-4 border-t border-outline-variant/30">
        Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold text-primary hover:underline">Masuk di sini</a>
    </div>
</div>
@endsection
