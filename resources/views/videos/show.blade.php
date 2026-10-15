@extends('layouts.app')

@section('title', $video->title)

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.index') }}" class="text-primary hover:underline">Materi</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.show', $course) }}" class="text-primary hover:underline">{{ Str::limit($course->title, 25) }}</a>
<span class="text-outline">/</span>
{{ Str::limit($video->title, 30) }}
@endsection

@section('styles')
<!-- Plyr Player CSS -->
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<style>
    .plyr {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0px 8px 24px rgba(24, 16, 43, 0.12);
        --plyr-color-main: #6045F4;
        --plyr-video-control-color: #ffffff;
        --plyr-video-control-color-hover: #53E6D4;
    }
</style>
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <div>
        <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center gap-2 text-sm text-royal-purple hover:underline font-label-md mb-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Modul Course
        </a>
        <h1 class="text-3xl font-headline-md font-bold text-carbon-black mb-1">{{ $video->title }}</h1>
        <p class="text-on-surface-variant font-body-md text-base">Modul: {{ $course->title }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Video Player Area (2 cols) -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface-container-lowest rounded-2xl p-2 clinical-shadow border border-outline-variant/20 overflow-hidden">
            @if($video->video_path)
                <video id="player" playsinline controls data-poster="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('cover course/cover.jpg') }}">
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4" />
                </video>
            @elseif($video->video_url)
                <div class="plyr__video-embed" id="player">
                    <iframe
                        src="{{ $video->video_url }}?origin={{ urlencode(request()->getSchemeAndHttpHost()) }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                        allowfullscreen
                        allowtransparency
                        allow="autoplay"
                    ></iframe>
                </div>
            @else
                <div class="py-24 text-center bg-inverse-surface text-inverse-on-surface rounded-xl">
                    <span class="material-symbols-outlined text-[56px] text-outline mb-2">videocam_off</span>
                    <p class="font-body-md text-sm">File video tidak tersedia.</p>
                </div>
            @endif
        </div>

        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6">
            <h3 class="font-headline-md font-bold text-on-surface text-lg mb-2">Informasi Progress Nonton</h3>
            <p class="text-sm text-on-surface-variant font-body-md">Guna menjamin pemahaman perawat terhadap materi keperawatan ini secara komprehensif, tombol evaluasi kuisioner akan terbuka jika Anda telah menonton seluruh video pada course ini hingga selesai (minimal 95% durasi video).</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-outline-variant/30 text-sm font-label-md">
                <span class="text-on-surface">Status Menonton Anda:</span>
                <span id="completionBadge">
                    @if($progress?->is_completed)
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-secondary-container text-on-secondary-container">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai (100%)
                        </span>
                    @elseif($progress)
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-tertiary-container text-on-tertiary-container">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> Baru Ditonton {{ round($progress->percentage) }}%
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-surface-container text-on-surface-variant">
                            Belum Ditonton
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Playlist Navigation (1 col) -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 flex flex-col h-fit">
        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-outline-variant">
            <span class="material-symbols-outlined text-primary text-[24px]">playlist_play</span>
            <h2 class="font-headline-md text-headline-md text-on-surface">Playlist Modul</h2>
        </div>

        <div class="space-y-3">
            @foreach($courseVideos as $index => $cVideo)
                @php
                    $cProgress = $cVideo->userProgress(auth()->id());
                    $isActive = $cVideo->id === $video->id;
                @endphp
                <a href="{{ route('videos.show', $cVideo) }}" class="p-3.5 rounded-xl border border-outline-variant/30 flex items-center justify-between gap-3 transition-colors {{ $isActive ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-lowest hover:bg-surface-container-low/50 text-on-surface' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ $isActive ? 'bg-on-primary text-primary' : ($cProgress?->is_completed ? 'bg-secondary text-on-secondary' : 'bg-surface-container text-on-surface') }}">
                            @if($cProgress?->is_completed)
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <div>
                            <div class="font-label-md text-sm font-semibold line-clamp-1 {{ $isActive ? 'text-on-primary' : 'text-on-surface' }}">{{ $cVideo->title }}</div>
                            <div class="text-xs font-caption {{ $isActive ? 'text-on-primary/80' : 'text-on-surface-variant' }}">{{ $cVideo->formatted_duration }} Menit</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Plyr Player Script -->
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const player = new Plyr('#player');
        
        let watchedSeconds = {{ $progress?->watched_seconds ?? 0 }};
        let isCompleted = {{ $progress?->is_completed ? 'true' : 'false' }};
        let lastReportedTime = 0;
        let totalDuration = 0;

        player.on('ready', () => {
            totalDuration = player.duration || {{ $video->duration_seconds ?? 0 }};
            if (watchedSeconds > 0 && watchedSeconds < totalDuration && !isCompleted) {
                player.currentTime = watchedSeconds;
            }
        });

        player.on('timeupdate', () => {
            const currentTime = Math.floor(player.currentTime);
            const duration = Math.floor(player.duration);

            if (currentTime > watchedSeconds) {
                watchedSeconds = currentTime;
            }

            if (watchedSeconds - lastReportedTime >= 5 || currentTime >= duration - 2) {
                lastReportedTime = watchedSeconds;
                sendProgress(watchedSeconds, duration);
            }
        });

        function sendProgress(watched, total) {
            if (total <= 0) return;
            
            fetch("{{ route('videos.progress', $video) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    watched_seconds: watched,
                    total_seconds: total
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.is_completed && !isCompleted) {
                        isCompleted = true;
                        document.getElementById('completionBadge').innerHTML = '<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-secondary-container text-on-secondary-container"><span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai (100%)</span>';
                    } else if (!isCompleted) {
                        document.getElementById('completionBadge').innerHTML = `<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-tertiary-container text-on-tertiary-container"><span class="material-symbols-outlined text-[14px]">schedule</span> Baru Ditonton ${Math.round(data.percentage)}%</span>`;
                    }
                }
            })
            .catch(err => console.error("Error updating progress:", err));
        }
    });
</script>
@endsection
