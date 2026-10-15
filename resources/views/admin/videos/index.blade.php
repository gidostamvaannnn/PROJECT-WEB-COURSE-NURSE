@extends('layouts.admin')

@section('title', 'Manajemen Video: ' . $course->title)

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Modul Course
        </a>
        <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">Daftar Video: {{ $course->title }}</h1>
        <p class="text-on-surface-variant font-body-md text-sm">Kelola video materi pembelajaran yang dikaitkan ke modul ini.</p>
    </div>
    <a href="{{ route('admin.courses.videos.create', $course) }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm w-fit">
        <span class="material-symbols-outlined text-[20px]">add</span>
        Tambah Video Baru
    </a>
</div>

<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-sm font-label-md uppercase tracking-wider">
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Urutan</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Judul Materi Video</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Sumber Media</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Durasi</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Status</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($videos as $video)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="px-6 py-4 text-on-surface-variant text-sm">{{ $video->order_number }}</td>
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $video->title }}</td>
                        <td class="px-6 py-4">
                            @if($video->video_path)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-primary-container text-on-primary-container">
                                    <span class="material-symbols-outlined text-[14px]">cloud_upload</span> Local Upload
                                </span>
                            @elseif($video->video_url)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[14px]">link</span> Embed URL
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">warning</span> Tidak Ada Media
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm">{{ $video->formatted_duration }} Menit</td>
                        <td class="px-6 py-4">
                            @if($video->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.courses.videos.edit', [$course, $video]) }}" class="inline-flex items-center justify-center p-2 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.courses.videos.destroy', [$course, $video]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg text-error hover:bg-error-container transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-[48px] text-outline">video_library</span>
                                <p class="font-body-md text-sm">Belum ada video materi pembelajaran untuk course ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
