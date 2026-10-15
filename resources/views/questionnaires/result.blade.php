@extends('layouts.app')

@section('title', 'Hasil Kuisioner')

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.index') }}" class="text-primary hover:underline">Materi</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.show', $questionnaire->course) }}" class="text-primary hover:underline">{{ Str::limit($questionnaire->course->title, 25) }}</a>
<span class="text-outline">/</span>
Hasil Kuisioner
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <!-- Result Banner Card -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-8 text-center">
        <div class="w-20 h-20 mx-auto rounded-full {{ $attempt->is_passed ? 'bg-secondary text-on-secondary shadow-sm' : 'bg-error-container text-on-error-container' }} flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-[48px]">{{ $attempt->is_passed ? 'check_circle' : 'cancel' }}</span>
        </div>
        
        <h1 class="text-3xl font-headline-lg font-bold text-on-surface mb-1">
            {{ $attempt->is_passed ? 'Selamat! Anda Lulus' : 'Maaf, Anda Belum Lulus' }}
        </h1>
        <p class="text-on-surface-variant font-body-md text-base mb-6">{{ $questionnaire->title }}</p>

        <div class="flex items-center justify-center gap-8 py-6 border-y border-outline-variant/30 my-6">
            <div>
                <div class="text-4xl font-headline-lg font-bold text-primary">{{ $attempt->score }}%</div>
                <div class="text-xs font-label-md text-on-surface-variant mt-1">Skor Anda</div>
            </div>
            <div class="h-12 w-px bg-outline-variant/40"></div>
            <div>
                <div class="text-4xl font-headline-lg font-bold text-on-surface-variant">{{ $questionnaire->passing_score }}%</div>
                <div class="text-xs font-label-md text-on-surface-variant mt-1">Batas Minimal Kelulusan</div>
            </div>
        </div>

        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('courses.show', $questionnaire->course) }}" class="inline-flex items-center gap-2 bg-surface-container text-on-surface px-6 py-2.5 rounded-lg font-label-md text-sm hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-[18px]">school</span>
                <span>Kembali ke Modul</span>
            </a>
            @if(!$attempt->is_passed)
                <a href="{{ route('questionnaires.show', $questionnaire) }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">replay</span>
                    <span>Coba Mengerjakan Lagi</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Review Section -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8">
        <div class="flex items-center gap-2 pb-4 mb-6 border-b border-outline-variant">
            <span class="material-symbols-outlined text-primary text-[24px]">fact_check</span>
            <h2 class="font-headline-md text-headline-md text-on-surface">Review Soal & Jawaban</h2>
        </div>

        <div class="space-y-6">
            @foreach($questions as $index => $question)
                @php
                    $userAnswerData = $attempt->answers[$question->id] ?? null;
                    $userAns = $userAnswerData['answer'] ?? '-';
                    $isCorrect = $userAnswerData['correct'] ?? false;
                @endphp
                <div class="p-5 rounded-xl border border-outline-variant/30 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="font-label-md font-bold text-sm text-on-surface">Pertanyaan #{{ $index + 1 }}</span>
                        @if($question->type == 'multiple_choice')
                            @if($isCorrect)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-bold bg-secondary text-on-secondary shadow-xs">
                                    <span class="material-symbols-outlined text-[14px]">check</span> Benar (+{{ $question->points }} Poin)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">close</span> Salah
                                </span>
                            @endif
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-primary-container text-on-primary-container">
                                Essay (Telah Disubmit)
                            </span>
                        @endif
                    </div>
                    
                    <p class="font-body-md font-semibold text-on-surface text-base">{{ $question->question_text }}</p>
                    
                    <div class="p-4 rounded-lg bg-surface-container-low/50 text-sm font-body-md space-y-1">
                        <div>Jawaban Anda: <strong class="text-on-surface">{{ $userAns }}</strong></div>
                        @if($question->type == 'multiple_choice' && !$isCorrect)
                            <div class="text-primary font-semibold">Kunci Jawaban yang Benar: {{ $question->correct_answer }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
