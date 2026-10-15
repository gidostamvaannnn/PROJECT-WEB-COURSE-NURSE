@extends('layouts.app')

@section('title', 'Lengkapi Profil Saya')

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
Profil Saya
@endsection

@section('content')
<div class="max-w-2xl mx-auto mb-8">
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-2">Profil Saya</h1>
    <p class="text-on-surface-variant font-body-md text-base">Lengkapi data pribadi Anda agar dapat diverifikasi dan diberi akses ke sistem pembelajaran.</p>
</div>

<div class="max-w-3xl mx-auto bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/20 p-5 md:p-6">
    @if(!$profile->is_complete)
        <div class="bg-tertiary-container text-on-tertiary-container p-3.5 rounded-lg mb-5 flex items-center gap-3 border border-tertiary/20">
            <span class="material-symbols-outlined text-[20px]">warning</span>
            <span class="font-body-md text-sm">Untuk bergabung ke dalam sistem pembelajaran, silakan lengkapi data profil Anda.</span>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="full_name">Nama Lengkap (Sesuai Ijazah)</label>
                <input type="text" id="full_name" name="full_name" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('full_name') border-error focus:ring-error focus:border-error @enderror" value="{{ old('full_name', $profile->full_name) }}" required placeholder="Nama Lengkap">
                @error('full_name')
                    <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="date_of_birth">Tanggal Lahir</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('date_of_birth') border-error focus:ring-error focus:border-error @enderror" value="{{ old('date_of_birth', $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}" required>
                @error('date_of_birth')
                    <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="phone">Nomor Telepon (WhatsApp)</label>
                <input type="text" id="phone" name="phone" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('phone') border-error focus:ring-error focus:border-error @enderror" value="{{ old('phone', $profile->phone) }}" placeholder="08123456789">
                @error('phone')
                    <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-label-md text-sm font-medium text-on-surface mb-1">Jenis Kelamin</label>
                <div class="grid grid-cols-2 gap-3 mt-0.5">
                    <label class="flex items-center gap-2 p-2 rounded-lg border border-outline-variant/30 hover:border-primary/50 cursor-pointer transition-colors bg-surface-container-lowest">
                        <input type="radio" name="gender" value="male" {{ old('gender', $profile->gender) == 'male' ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-outline-variant" required>
                        <span class="font-body-md text-sm text-on-surface">Laki-laki</span>
                    </label>
                    <label class="flex items-center gap-2 p-2 rounded-lg border border-outline-variant/30 hover:border-primary/50 cursor-pointer transition-colors bg-surface-container-lowest">
                        <input type="radio" name="gender" value="female" {{ old('gender', $profile->gender) == 'female' ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-outline-variant" required>
                        <span class="font-body-md text-sm text-on-surface">Perempuan</span>
                    </label>
                </div>
                @error('gender')
                    <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="avatar">Foto Profil</label>
            <div class="flex items-start gap-4">
                @if($profile->avatar)
                    <div class="shrink-0">
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Foto Profil" class="w-16 h-16 object-cover rounded-lg border border-outline-variant/30">
                    </div>
                @endif
                <div class="flex-1">
                    <input type="file" id="avatar" name="avatar" class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-label-md file:bg-surface-container file:text-on-surface hover:file:bg-surface-container-high border border-outline-variant rounded-lg cursor-pointer bg-surface-container-lowest" accept="image/*">
                    <p class="mt-1 text-[11px] text-on-surface-variant">Format JPG/PNG. Maksimal 2MB.</p>
                </div>
            </div>
            @error('avatar')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-2.5 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Profil</span>
            </button>
        </div>
    </form>
</div>
@endsection
