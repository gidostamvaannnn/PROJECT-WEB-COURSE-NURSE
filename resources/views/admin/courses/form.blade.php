@extends('layouts.admin')

@section('title', $course->exists ? 'Edit Course' : 'Tambah Course')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Daftar Course
    </a>
    <h1 class="text-3xl font-headline-md font-bold text-on-surface">{{ $course->exists ? 'Perbarui Modul Course' : 'Buat Modul Course Baru' }}</h1>
</div>

<div class="max-w-2xl bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8">
    <form action="{{ $course->exists ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($course->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="title">Judul Modul Course</label>
            <input type="text" id="title" name="title" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-error focus:ring-error focus:border-error @enderror" value="{{ old('title', $course->title) }}" required placeholder="Contoh: Bantuan Hidup Dasar (BHD)">
            @error('title')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="description">Deskripsi Singkat Modul</label>
            <textarea id="description" name="description" rows="4" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('description') border-error focus:ring-error focus:border-error @enderror" placeholder="Jelaskan mengenai kompetensi materi modul pembelajaran ini...">{{ old('description', $course->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="thumbnail">Gambar Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-label-md file:bg-surface-container file:text-on-surface hover:file:bg-surface-container-high border border-outline-variant rounded-lg cursor-pointer bg-surface-container-lowest" accept="image/*">
            <p class="mt-1 text-xs text-on-surface-variant">Maksimal 2MB. Format PNG, JPG.</p>
            @error('thumbnail')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror

            @if($course->thumbnail)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current Thumbnail" class="w-32 h-20 object-cover rounded-lg border border-outline-variant/30">
                </div>
            @endif
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="order_number">No. Urutan Modul</label>
            <input type="number" id="order_number" name="order_number" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('order_number') border-error focus:ring-error focus:border-error @enderror" value="{{ old('order_number', $course->order_number ?? 0) }}" min="0">
            <p class="mt-1 text-xs text-on-surface-variant">Digunakan untuk menyusun urutan kemunculan materi pada user.</p>
            @error('order_number')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $course->exists ? $course->is_active : true) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-outline-variant rounded cursor-pointer">
            <label for="is_active" class="ml-2 block text-sm text-on-surface font-body-md cursor-pointer select-none">
                Aktifkan Modul Ini
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">save</span>
                <span>{{ $course->exists ? 'Simpan Perubahan' : 'Simpan Course Baru' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection
