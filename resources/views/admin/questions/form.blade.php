@extends('layouts.admin')

@section('title', $question->exists ? 'Edit Soal' : 'Tambah Soal')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.questionnaires.questions.index', $questionnaire) }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Daftar Soal
    </a>
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">{{ $question->exists ? 'Perbarui Data Soal' : 'Tambahkan Soal Baru' }}</h1>
    <p class="text-on-surface-variant font-body-md text-sm">Kuisioner: {{ $questionnaire->title }}</p>
</div>

<div class="max-w-3xl bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 md:p-8">
    <form action="{{ $question->exists ? route('admin.questionnaires.questions.update', [$questionnaire, $question]) : route('admin.questionnaires.questions.store', $questionnaire) }}" method="POST" class="space-y-6">
        @csrf
        @if($question->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="type">Tipe Pertanyaan</label>
            <select id="type" name="type" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" onchange="toggleOptionGroup(this.value)" required>
                <option value="multiple_choice" {{ old('type', $question->type) == 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda (Multiple Choice)</option>
                <option value="essay" {{ old('type', $question->type) == 'essay' ? 'selected' : '' }}>Essay / Jawaban Deskriptif</option>
            </select>
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="question_text">Teks Pertanyaan Soal</label>
            <textarea id="question_text" name="question_text" rows="4" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" required placeholder="Tuliskan isi pertanyaan medis atau kuisioner di sini...">{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        <!-- Multiple Choice Options Wrapper -->
        <div id="options-wrapper" class="border border-outline-variant/30 rounded-xl p-5 bg-surface-container-low/50 space-y-4" style="display: {{ old('type', $question->type ?? 'multiple_choice') == 'multiple_choice' ? 'block' : 'none' }};">
            <h3 class="font-label-md text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Daftar Opsi Pilihan Jawaban</h3>
            
            <div>
                <label class="block font-label-md text-xs font-medium text-on-surface mb-1" for="option_a">Opsi A</label>
                <input type="text" id="option_a" name="options[A]" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('options.A', $question->options['A'] ?? '') }}" placeholder="Tulis jawaban opsi A">
            </div>
            
            <div>
                <label class="block font-label-md text-xs font-medium text-on-surface mb-1" for="option_b">Opsi B</label>
                <input type="text" id="option_b" name="options[B]" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('options.B', $question->options['B'] ?? '') }}" placeholder="Tulis jawaban opsi B">
            </div>
            
            <div>
                <label class="block font-label-md text-xs font-medium text-on-surface mb-1" for="option_c">Opsi C</label>
                <input type="text" id="option_c" name="options[C]" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('options.C', $question->options['C'] ?? '') }}" placeholder="Tulis jawaban opsi C">
            </div>
            
            <div>
                <label class="block font-label-md text-xs font-medium text-on-surface mb-1" for="option_d">Opsi D</label>
                <input type="text" id="option_d" name="options[D]" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('options.D', $question->options['D'] ?? '') }}" placeholder="Tulis jawaban opsi D">
            </div>

            <div>
                <label class="block font-label-md text-xs font-medium text-on-surface mb-1" for="correct_answer">Pilih Kunci Jawaban Yang Benar</label>
                <select id="correct_answer" name="correct_answer" class="block w-full py-2 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">-- Pilih Kunci Jawaban --</option>
                    <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>Opsi A</option>
                    <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>Opsi B</option>
                    <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>Opsi C</option>
                    <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>Opsi D</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="points">Bobot Nilai Poin Soal</label>
            <input type="number" id="points" name="points" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" value="{{ old('points', $question->points ?? 1) }}" min="1" required>
        </div>

        <div>
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="order_number">No. Urut Soal</label>
            <input type="number" id="order_number" name="order_number" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" value="{{ old('order_number', $question->order_number ?? 0) }}" min="0">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 px-6 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">save</span>
                <span>{{ $question->exists ? 'Simpan Perubahan' : 'Tambahkan Soal' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function toggleOptionGroup(val) {
        const wrapper = document.getElementById('options-wrapper');
        const correctInput = document.getElementById('correct_answer');
        
        if (val === 'multiple_choice') {
            wrapper.style.display = 'block';
            correctInput.setAttribute('required', 'required');
        } else {
            wrapper.style.display = 'none';
            correctInput.removeAttribute('required');
        }
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        toggleOptionGroup(document.getElementById('type').value);
    });
</script>
@endsection
