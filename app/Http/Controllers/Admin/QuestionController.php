<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Questionnaire $questionnaire)
    {
        $questions = $questionnaire->questions()->orderBy('order_number')->get();
        return view('admin.questions.index', compact('questionnaire', 'questions'));
    }

    public function create(Questionnaire $questionnaire)
    {
        return view('admin.questions.form', ['questionnaire' => $questionnaire, 'question' => new Question()]);
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,essay',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string',
            'correct_answer' => 'nullable|string',
            'points' => 'nullable|integer|min:1',
            'order_number' => 'nullable|integer',
        ]);

        $data = $request->only(['question_text', 'type', 'correct_answer', 'points', 'order_number']);
        $data['questionnaire_id'] = $questionnaire->id;

        if ($request->type === 'multiple_choice' && $request->has('options')) {
            $data['options'] = array_filter($request->options);
        }

        Question::create($data);

        return redirect()->route('admin.questionnaires.questions.index', $questionnaire)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Questionnaire $questionnaire, Question $question)
    {
        return view('admin.questions.form', compact('questionnaire', 'question'));
    }

    public function update(Request $request, Questionnaire $questionnaire, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,essay',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string',
            'correct_answer' => 'nullable|string',
            'points' => 'nullable|integer|min:1',
            'order_number' => 'nullable|integer',
        ]);

        $data = $request->only(['question_text', 'type', 'correct_answer', 'points', 'order_number']);

        if ($request->type === 'multiple_choice' && $request->has('options')) {
            $data['options'] = array_filter($request->options);
        } else {
            $data['options'] = null;
        }

        $question->update($data);

        return redirect()->route('admin.questionnaires.questions.index', $questionnaire)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questionnaires.questions.index', $questionnaire)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
