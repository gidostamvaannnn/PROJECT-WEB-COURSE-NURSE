@extends('layouts.app')

@section('title', $questionnaire->title)

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.index') }}" class="text-primary hover:underline">Materi</a>
<span class="text-outline">/</span>
<a href="{{ route('courses.show', $course) }}" class="text-primary hover:underline">{{ Str::limit($course->title, 25) }}</a>
<span class="text-outline">/</span>
{{ Str::limit($questionnaire->title, 30) }}
@endsection

@section('content')
<div class="max-w-3xl mx-auto mb-8">
    <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Course
    </a>
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">{{ $questionnaire->title }}</h1>
    <p class="text-on-surface-variant font-body-md text-base">Modul: {{ $course->title }} | Minimal Nilai Kelulusan: <strong class="text-primary">{{ $questionnaire->passing_score }}%</strong></p>
</div>

<div class="max-w-3xl mx-auto space-y-6">
    @if($existingAttempt)
        <div class="bg-surface-container-high text-on-surface p-4 rounded-xl flex items-center gap-3 border border-primary/20">
            <span class="material-symbols-outlined text-primary text-[24px]">history</span>
            <span class="font-body-md text-sm">Anda sebelumnya telah mencoba kuisioner ini dengan skor terakhir <strong>{{ $existingAttempt->score }}%</strong> ({{ $existingAttempt->is_passed ? 'Lulus' : 'Gagal' }}). Mengisi kembali akan mengganti data percobaan lama Anda.</span>
        </div>
    @endif

    <form action="{{ route('questionnaires.submit', $questionnaire) }}" method="POST" class="space-y-6">
        @csrf
        
        @foreach($questions as $index => $question)
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="font-headline-md font-bold text-primary text-sm bg-primary-container/30 px-3 py-1 rounded-lg">Soal #{{ $index + 1 }}</span>
                    <span class="px-3 py-1 rounded-full text-xs font-label-md font-medium {{ $question->type == 'multiple_choice' ? 'bg-primary-container text-on-primary-container' : 'bg-secondary-container text-on-secondary-container' }}">
                        {{ $question->type == 'multiple_choice' ? 'Pilihan Ganda' : 'Jawaban Essay/Uraian' }}
                    </span>
                </div>

                <div class="font-body-md text-on-surface font-semibold text-base leading-relaxed">{{ $question->question_text }}</div>

                @if($question->type === 'multiple_choice')
                    <div class="space-y-2.5 pt-2">
                        @if($question->options)
                            @foreach($question->options as $key => $option)
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-outline-variant/30 hover:border-primary/50 hover:bg-surface-container-low/50 cursor-pointer transition-colors">
                                    <input type="radio" name="answer_{{ $question->id }}" value="{{ $key }}" class="h-4 w-4 text-primary focus:ring-primary border-outline-variant" required>
                                    <span class="font-body-md text-sm text-on-surface"><strong class="text-primary mr-1">{{ $key }}.</strong> {{ $option }}</span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div class="pt-2">
                        <textarea name="answer_{{ $question->id }}" rows="4" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Tuliskan jawaban Anda secara lengkap di sini..." required></textarea>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3.5 px-6 rounded-xl font-label-md text-base hover:bg-primary/90 transition-colors shadow-sm" onclick="return confirm('Apakah Anda yakin ingin mengirim semua jawaban kuisioner Anda?')">
                <span>Kirim Lembar Jawaban</span>
                <span class="material-symbols-outlined text-[20px]">send</span>
            </button>
        </div>
    </form>
</div>
@endsection
