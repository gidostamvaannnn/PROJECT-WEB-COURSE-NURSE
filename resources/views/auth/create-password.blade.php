@extends('layouts.auth')

@section('title', 'Buat Password')

@section('content')
<div>
    <h2 class="text-xl font-headline-md font-bold text-on-surface text-center mb-1">Buat Password Baru</h2>
    <p class="text-sm font-body-md text-on-surface-variant text-center mb-6">Silakan buat password baru untuk akun <strong class="text-primary">{{ $email }}</strong>.</p>

    <form action="{{ route('create-password.submit') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="password">Password Baru</label>
            <input type="password" id="password" name="password" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('password') border-error focus:ring-error focus:border-error @enderror" placeholder="Minimal 8 karakter" required autofocus>
            @error('password')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Ulangi password baru" required>
        </div>

        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
            <span>Selesaikan Pendaftaran</span>
            <span class="material-symbols-outlined text-[18px]">check_circle</span>
        </button>
    </form>
</div>
@endsection
