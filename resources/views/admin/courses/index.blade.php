@extends('layouts.admin')

@section('title', 'Manajemen Course')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-2">Daftar Modul Pembelajaran</h1>
        <p class="text-on-surface-variant font-body-md text-base">Tambah, edit, atau nonaktifkan course pelatihan keperawatan.</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm w-fit">
        <span class="material-symbols-outlined text-[20px]">add</span>
        Tambah Course Baru
    </a>
</div>

<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-sm font-label-md uppercase tracking-wider">
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Thumbnail</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Judul Modul Course</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Urutan</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Status</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Sub-Konten</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($courses as $course)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="px-6 py-4">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumb" class="w-16 h-10 object-cover rounded-lg border border-outline-variant/30">
                            @else
                                <div class="w-16 h-10 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[20px]">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $course->title }}</td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm">{{ $course->order_number }}</td>
                        <td class="px-6 py-4">
                            @if($course->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.courses.videos.index', $course) }}" class="inline-flex items-center gap-1.5 bg-surface-container text-on-surface px-3 py-1.5 rounded-lg text-xs font-label-md hover:bg-surface-container-high transition-colors border border-outline-variant/20">
                                    <span class="material-symbols-outlined text-[16px]">videocam</span> Video ({{ $course->videos_count }})
                                </a>
                                <a href="{{ route('admin.courses.questionnaires.index', $course) }}" class="inline-flex items-center gap-1.5 bg-surface-container text-on-surface px-3 py-1.5 rounded-lg text-xs font-label-md hover:bg-surface-container-high transition-colors border border-outline-variant/20">
                                    <span class="material-symbols-outlined text-[16px]">quiz</span> Kuisioner ({{ $course->questionnaires()->count() }})
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.courses.edit', $course) }}" class="inline-flex items-center justify-center p-2 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus course ini? Seluruh video, kuisioner, dan progress user di dalamnya juga akan terhapus secara permanen.')">
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
                                <span class="material-symbols-outlined text-[48px] text-outline">library_books</span>
                                <p class="font-body-md text-sm">Belum ada data course modul. Silakan buat yang pertama!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
