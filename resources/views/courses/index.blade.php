@extends('layouts.app')

@section('title', 'Daftar Materi Keperawatan')

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
Materi & Course
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-carbon-black mb-2">Materi Pelatihan Keperawatan</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Akses modul pembelajaran mandiri di bawah ini untuk meningkatkan kompetensi klinis Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-surface-card-white rounded-xl shadow-sm hover:shadow-lg border border-soft-gray overflow-hidden flex flex-col justify-between transition-all duration-300">
                <div>
                    <div class="h-48 bg-surface-container flex items-center justify-center relative overflow-hidden">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('cover course/cover.jpg') }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-carbon-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-3 right-3 bg-carbon-black/80 backdrop-blur-md px-3 py-1 rounded-full text-xs font-label-caps text-surface-card-white flex items-center gap-1">
                            <span class="material-symbols-outlined text-neon-mint text-[14px]">subscriptions</span>
                            <span>{{ $course->video_count }} Video</span>
                        </div>
                        <div class="absolute bottom-3 left-3 text-surface-card-white font-label-caps text-xs font-bold">
                            <span class="bg-royal-purple px-2 py-0.5 rounded">+SKP PPNI Terakreditasi</span>
                        </div>
                    </div>

                    <div class="p-5 space-y-2">
                        <span class="font-label-caps text-[10px] text-royal-purple uppercase tracking-wider font-bold">MODUL AKREDITASI RESMI</span>
                        <h3 class="font-headline-sm text-headline-sm font-bold text-carbon-black line-clamp-2">{{ $course->title }}</h3>
                        <p class="font-body-sm text-sm text-on-surface-variant line-clamp-2">{{ $course->description }}</p>
                    </div>
                </div>

                <div class="p-5 pt-0 space-y-4">
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-label-caps">
                            <span class="text-on-surface-variant">Progress Modul</span>
                            <span class="text-carbon-black font-bold">{{ $course->progress }}%</span>
                        </div>
                        <div class="w-full bg-soft-gray rounded-full h-2 overflow-hidden">
                            <div class="bg-neon-mint h-2 rounded-full transition-all duration-500" style="width: {{ $course->progress }}%"></div>
                        </div>
                    </div>

                    <a href="{{ route('courses.show', $course) }}" class="w-full inline-flex items-center justify-center gap-2 bg-royal-purple hover:bg-primary text-surface-card-white py-2.5 rounded-lg font-label-md text-sm font-bold transition-colors shadow-sm">
                        @if($course->progress == 100)
                            <span>Review Ulang Materi</span>
                            <span class="material-symbols-outlined text-[18px]">replay</span>
                        @else
                            <span>Mulai Belajar</span>
                            <span class="material-symbols-outlined text-[18px]">play_arrow</span>
                        @endif
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface-card-white rounded-xl p-12 text-center text-on-surface-variant border border-soft-gray">
                <span class="material-symbols-outlined text-[56px] text-outline mb-2">folder_off</span>
                <h3 class="font-headline-md font-bold text-carbon-black text-lg mb-1">Belum Ada Modul Materi</h3>
                <p class="font-body-md text-sm">Admin belum mengaktifkan modul pembelajaran saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
