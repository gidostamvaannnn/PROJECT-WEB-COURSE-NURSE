@extends('layouts.app')

@section('title', $course->title)

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.index') }}" class="text-primary hover:underline">Materi</a>
<span class="text-outline">/</span>
{{ Str::limit($course->title, 40) }}
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <div>
        <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 text-sm text-royal-purple hover:underline font-label-md mb-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Daftar Modul
        </a>
        <h1 class="text-3xl font-headline-md font-bold text-carbon-black mb-1">{{ $course->title }}</h1>
        <p class="text-on-surface-variant font-body-md text-base">{{ $course->description }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Videos List (2 cols) -->
    <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6">
        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-outline-variant">
            <span class="material-symbols-outlined text-primary text-[24px]">play_circle</span>
            <h2 class="font-headline-md text-headline-md text-on-surface">Daftar Video Pembelajaran</h2>
        </div>

        <div class="bg-surface-container-low text-on-surface-variant p-3.5 rounded-xl text-xs font-body-md mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[18px]">info</span>
            <span>Setiap video harus ditonton sampai selesai (mencapai 95% durasi) agar terhitung selesai.</span>
        </div>

        <div class="space-y-3">
            @forelse($videos as $index => $video)
                <div onclick="window.location='{{ route('videos.show', $video) }}'" class="p-4 rounded-xl border border-outline-variant/30 bg-surface-container-lowest hover:bg-surface-container-low/50 cursor-pointer transition-colors flex items-center justify-between gap-4 {{ $video->user_progress?->is_completed ? 'border-secondary-container bg-secondary-container/10' : '' }}">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full {{ $video->user_progress?->is_completed ? 'bg-secondary text-on-secondary' : 'bg-surface-container text-on-surface font-bold' }} flex items-center justify-center text-sm">
                            @if($video->user_progress?->is_completed)
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <div>
                            <h4 class="font-label-md font-bold text-on-surface text-sm">{{ $video->title }}</h4>
                            <span class="text-xs text-on-surface-variant flex items-center gap-1 mt-0.5">
                                <span class="material-symbols-outlined text-[14px]">schedule</span> {{ $video->formatted_duration }} Menit
                            </span>
                        </div>
                    </div>

                    <div>
                        @if($video->user_progress?->is_completed)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                Selesai
                            </span>
                        @elseif($video->user_progress)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-tertiary-container text-on-tertiary-container">
                                {{ round($video->user_progress->percentage) }}%
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-surface-container text-on-surface-variant">
                                Belum Ditonton
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-on-surface-variant space-y-2">
                    <span class="material-symbols-outlined text-[48px] text-outline">videocam_off</span>
                    <p class="font-body-md text-sm">Video pembelajaran untuk modul ini belum ditambahkan oleh administrator.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Questionnaires & Evaluations List (1 col) -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 flex flex-col h-fit">
        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-outline-variant">
            <span class="material-symbols-outlined text-primary text-[24px]">assignment</span>
            <h2 class="font-headline-md text-headline-md text-on-surface">Lembar Evaluasi</h2>
        </div>

        @if($allVideosCompleted)
            <div class="bg-secondary-container text-on-secondary-container p-3.5 rounded-xl text-xs font-body-md mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">lock_open</span>
                <span><strong>Kuisioner Terbuka!</strong> Anda telah menyelesaikan 100% video materi pada modul ini.</span>
            </div>
        @else
            <div class="bg-error-container text-on-error-container p-3.5 rounded-xl text-xs font-body-md mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">lock</span>
                <span><strong>Kuisioner Terkunci!</strong> Tonton seluruh video materi hingga 100% untuk membuka evaluasi.</span>
            </div>
        @endif

        <div class="space-y-4">
            @forelse($questionnaires as $questionnaire)
                <div class="p-4 rounded-xl border border-outline-variant/30 bg-surface-container-low/30">
                    <h4 class="font-label-md font-bold text-on-surface text-sm mb-1">{{ $questionnaire->title }}</h4>
                    <p class="text-xs text-on-surface-variant mb-3 font-body-md">{{ $questionnaire->description }}</p>
                    
                    <div class="flex justify-between items-center text-xs mb-3 font-caption">
                        <span class="text-on-surface-variant">Passing Score: <strong class="text-primary">{{ $questionnaire->passing_score }}%</strong></span>
                        @if($questionnaire->user_attempt)
                            @if($questionnaire->user_attempt->is_passed)
                                <span class="px-2.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-md font-medium">
                                    Lulus ({{ $questionnaire->user_attempt->score }}%)
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-md font-medium">
                                    Gagal ({{ $questionnaire->user_attempt->score }}%)
                                </span>
                            @endif
                        @else
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-md font-medium">
                                Belum Dikerjakan
                            </span>
                        @endif
                    </div>

                    @if($allVideosCompleted)
                        @if($questionnaire->user_attempt && $questionnaire->user_attempt->is_passed)
                            <a href="{{ route('questionnaires.result', $questionnaire->user_attempt) }}" class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-container text-on-surface py-2.5 rounded-lg text-xs font-label-md hover:bg-surface-container-high transition-colors">
                                <span>Lihat Hasil Jawaban</span>
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                            </a>
                        @else
                            <a href="{{ route('questionnaires.show', $questionnaire) }}" class="w-full inline-flex items-center justify-center gap-1.5 bg-primary text-on-primary py-2.5 rounded-lg text-xs font-label-md hover:bg-primary/90 transition-colors shadow-sm">
                                <span>{{ $questionnaire->user_attempt ? 'Ulangi Mengerjakan' : 'Mulai Isi Kuisioner' }}</span>
                                <span class="material-symbols-outlined text-[16px]">edit_note</span>
                            </a>
                        @endif
                    @else
                        <button class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-container text-on-surface-variant py-2.5 rounded-lg text-xs font-label-md opacity-60 cursor-not-allowed" disabled>
                            <span>Kuisioner Terkunci</span>
                            <span class="material-symbols-outlined text-[16px]">lock</span>
                        </button>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 text-on-surface-variant space-y-2">
                    <span class="material-symbols-outlined text-[40px] text-outline">quiz</span>
                    <p class="text-xs font-body-md">Kuisioner evaluasi belum ditambahkan untuk modul ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
</div>
@endsection
