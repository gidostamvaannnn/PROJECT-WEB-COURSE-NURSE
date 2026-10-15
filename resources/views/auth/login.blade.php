@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div class="mt-8">

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="email">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-on-surface-variant text-[20px]">mail</span>
                    </div>
                    <input type="email" id="email" name="email" class="block w-full pl-10 pr-3 py-2 border border-outline-variant rounded-md leading-5 bg-surface-container-lowest text-on-surface placeholder-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out @error('email') border-error focus:ring-error focus:border-error @enderror" value="{{ old('email') }}" placeholder="perawat@domain.com" required autofocus>
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-error font-body-md">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block font-label-md text-sm font-medium text-on-surface" for="password">Password</label>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-on-surface-variant text-[20px]">lock</span>
                    </div>
                    <input type="password" id="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-outline-variant rounded-md leading-5 bg-surface-container-lowest text-on-surface placeholder-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out" placeholder="••••••••" required>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-primary focus:ring-primary border-outline-variant rounded cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm text-on-surface-variant font-body-md cursor-pointer select-none">
                        Ingat saya di perangkat ini
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-label-md font-medium text-on-primary bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                Masuk <span class="material-symbols-outlined text-[20px]">login</span>
            </button>
        </form>

        <div class="mt-6 text-center text-sm font-body-md text-on-surface-variant">
            Belum memiliki akun? <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary/80 transition-colors duration-200">Daftar sekarang</a>
        </div>
    </div>
@endsection
