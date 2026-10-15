@extends('layouts.admin')

@section('title', $video->exists ? 'Edit Video' : 'Tambah Video')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.courses.videos.index', $course) }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Playlist
    </a>
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">{{ $video->exists ? 'Perbarui Data Video' : 'Tambah Video Materi Baru' }}</h1>
    <p class="text-on-surface-variant font-body-md text-sm">Modul Course: {{ $course->title }}</p>
</div>

<div class="max-w-2xl bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8">
    <form action="{{ $video->exists ? route('admin.courses.videos.update', [$course, $video]) : route('admin.courses.videos.store', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($video->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="title">Judul Materi Video</label>
            <input type="text" id="title" name="title" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-error focus:ring-error focus:border-error @enderror" value="{{ old('title', $video->title) }}" required placeholder="Contoh: Prosedur Resusitasi Jantung Paru (RJP)">
            @error('title')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="video_file">Upload File Video (Local)</label>
            <input type="file" id="video_file" name="video_file" class="block w-full text-sm text-on-surface-variant file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-label-md file:bg-surface-container file:text-on-surface hover:file:bg-surface-container-high border border-outline-variant rounded-lg cursor-pointer bg-surface-container-lowest" accept="video/mp4,video/webm,video/ogg">
            <p class="mt-1 text-xs text-on-surface-variant">Format MP4/WEBM. Maksimal 500MB. Gunakan local upload jika Anda ingin video tersimpan di server Anda.</p>
            @error('video_file')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror

            @if($video->video_path)
                <div class="mt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                        <span class="material-symbols-outlined text-[14px]">movie</span> File Local: {{ basename($video->video_path) }}
                    </span>
                </div>
            @endif
        </div>

        <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-outline-variant/30"></div>
            <span class="flex-shrink font-label-md text-xs uppercase tracking-wider text-on-surface-variant px-4">Atau Gunakan Embed Link</span>
            <div class="flex-grow border-t border-outline-variant/30"></div>
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="video_url">URL Embed Video (YouTube/Vimeo)</label>
            <input type="url" id="video_url" name="video_url" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('video_url') border-error focus:ring-error focus:border-error @enderror" value="{{ old('video_url', $video->video_url) }}" placeholder="Contoh: https://www.youtube.com/embed/dQw4w9WgXcQ">
            <p class="mt-1 text-xs text-on-surface-variant">Harus format Link Embed (bukan link tonton biasa). Contoh YouTube: https://www.youtube.com/embed/[ID_VIDEO]</p>
            @error('video_url')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="order_number">Urutan Pemutaran</label>
            <input type="number" id="order_number" name="order_number" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('order_number') border-error focus:ring-error focus:border-error @enderror" value="{{ old('order_number', $video->order_number ?? 0) }}" min="0">
            <p class="mt-1 text-xs text-on-surface-variant">Mengurutkan daftar putar video di halaman user (0, 1, 2, dst).</p>
            @error('order_number')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $video->exists ? $video->is_active : true) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-outline-variant rounded cursor-pointer">
            <label for="is_active" class="ml-2 block text-sm text-on-surface font-body-md cursor-pointer select-none">
                Aktifkan Video Materi Ini
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">save</span>
                <span>{{ $video->exists ? 'Simpan Perubahan' : 'Tambahkan Video' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection
