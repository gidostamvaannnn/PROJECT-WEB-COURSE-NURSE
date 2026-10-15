@extends('layouts.admin')

@section('title', $questionnaire->exists ? 'Edit Kuisioner' : 'Buat Kuisioner')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.courses.questionnaires.index', $course) }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Daftar Kuisioner
    </a>
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">{{ $questionnaire->exists ? 'Perbarui Data Kuisioner' : 'Buat Kuisioner Evaluasi Baru' }}</h1>
    <p class="text-on-surface-variant font-body-md text-sm">Modul Course: {{ $course->title }}</p>
</div>

<div class="max-w-2xl bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8">
    <form action="{{ $questionnaire->exists ? route('admin.courses.questionnaires.update', [$course, $questionnaire]) : route('admin.courses.questionnaires.store', $course) }}" method="POST" class="space-y-6">
        @csrf
        @if($questionnaire->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="title">Judul Kuisioner</label>
            <input type="text" id="title" name="title" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-error focus:ring-error focus:border-error @enderror" value="{{ old('title', $questionnaire->title) }}" required placeholder="Contoh: Ujian Kompetensi BHD">
            @error('title')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="description">Instruksi/Keterangan Ujian</label>
            <textarea id="description" name="description" rows="4" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('description') border-error focus:ring-error focus:border-error @enderror" placeholder="Tuliskan petunjuk pengerjaan kuisioner bagi perawat...">{{ old('description', $questionnaire->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="passing_score">Batas Minimal Kelulusan (%)</label>
            <input type="number" id="passing_score" name="passing_score" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('passing_score') border-error focus:ring-error focus:border-error @enderror" value="{{ old('passing_score', $questionnaire->passing_score ?? 70) }}" min="0" max="100" required>
            <p class="mt-1 text-xs text-on-surface-variant">Format persen (0-100). Contoh: 70 berarti perawat harus menjawab benar minimal 70% dari seluruh poin soal.</p>
            @error('passing_score')
                <p class="mt-1 text-xs text-error font-body-md">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $questionnaire->exists ? $questionnaire->is_active : true) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-outline-variant rounded cursor-pointer">
            <label for="is_active" class="ml-2 block text-sm text-on-surface font-body-md cursor-pointer select-none">
                Aktifkan Kuisioner Ini
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">save</span>
                <span>{{ $questionnaire->exists ? 'Simpan Perubahan' : 'Lanjut Tambah Soal' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection
