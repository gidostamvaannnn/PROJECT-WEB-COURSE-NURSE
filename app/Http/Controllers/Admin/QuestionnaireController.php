<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function index(Course $course)
    {
        $questionnaires = $course->questionnaires()->withCount('questions')->get();
        return view('admin.questionnaires.index', compact('course', 'questionnaires'));
    }

    public function create(Course $course)
    {
        return view('admin.questionnaires.form', ['course' => $course, 'questionnaire' => new Questionnaire()]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'nullable|integer|min:0|max:100',
        ]);

        $data = $request->only(['title', 'description', 'passing_score']);
        $data['course_id'] = $course->id;
        $data['is_active'] = $request->boolean('is_active', true);

        $questionnaire = Questionnaire::create($data);

        return redirect()->route('admin.questionnaires.questions.index', $questionnaire)
            ->with('success', 'Kuisioner berhasil dibuat. Sekarang tambahkan soal.');
    }

    public function edit(Course $course, Questionnaire $questionnaire)
    {
        return view('admin.questionnaires.form', compact('course', 'questionnaire'));
    }

    public function update(Request $request, Course $course, Questionnaire $questionnaire)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'nullable|integer|min:0|max:100',
        ]);

        $data = $request->only(['title', 'description', 'passing_score']);
        $data['is_active'] = $request->boolean('is_active', true);

        $questionnaire->update($data);

        return redirect()->route('admin.courses.questionnaires.index', $course)
            ->with('success', 'Kuisioner berhasil diperbarui.');
    }

    public function destroy(Course $course, Questionnaire $questionnaire)
    {
        $questionnaire->delete();
        return redirect()->route('admin.courses.questionnaires.index', $course)
            ->with('success', 'Kuisioner berhasil dihapus.');
    }
}
