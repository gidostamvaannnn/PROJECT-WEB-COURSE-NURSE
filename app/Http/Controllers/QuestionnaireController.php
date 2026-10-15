<?php

namespace App\Http\Controllers;

use App\Models\DailyProgress;
use App\Models\Questionnaire;
use App\Models\QuestionnaireAttempt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function show(Questionnaire $questionnaire)
    {
        $user = auth()->user();
        $course = $questionnaire->course;

        // Check if all videos are completed
        if (!$course->allVideosCompleted($user->id)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Anda harus menyelesaikan semua video terlebih dahulu sebelum mengisi kuisioner.');
        }

        // Check if already attempted
        $existingAttempt = $questionnaire->userAttempt($user->id);

        $questions = $questionnaire->questions()->orderBy('order_number')->get();

        return view('questionnaires.show', compact('questionnaire', 'course', 'questions', 'existingAttempt'));
    }

    public function submit(Request $request, Questionnaire $questionnaire)
    {
        $user = auth()->user();
        $course = $questionnaire->course;

        // Verify all videos completed
        if (!$course->allVideosCompleted($user->id)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Anda harus menyelesaikan semua video terlebih dahulu.');
        }

        $questions = $questionnaire->questions;
        $answers = [];
        $score = 0;
        $totalPoints = $questionnaire->total_points;

        foreach ($questions as $question) {
            $answerKey = 'answer_' . $question->id;
            $userAnswer = $request->input($answerKey, '');

            $answers[$question->id] = [
                'answer' => $userAnswer,
                'correct' => false,
                'points_earned' => 0,
            ];

            if ($question->type === 'multiple_choice') {
                if ($userAnswer === $question->correct_answer) {
                    $score += $question->points;
                    $answers[$question->id]['correct'] = true;
                    $answers[$question->id]['points_earned'] = $question->points;
                }
            } else {
                // Essay: give full points (admin can review later)
                $score += $question->points;
                $answers[$question->id]['points_earned'] = $question->points;
            }
        }

        $scorePercentage = $totalPoints > 0 ? round(($score / $totalPoints) * 100) : 0;
        $isPassed = $scorePercentage >= $questionnaire->passing_score;

        $attempt = QuestionnaireAttempt::create([
            'user_id' => $user->id,
            'questionnaire_id' => $questionnaire->id,
            'answers' => $answers,
            'score' => $scorePercentage,
            'is_passed' => $isPassed,
            'submitted_at' => now(),
        ]);

        // Record daily progress for streak
        DailyProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'activity_date' => Carbon::today()->toDateString(),
            ],
            [
                'questionnaires_completed' => \DB::raw('questionnaires_completed + 1'),
                'is_active' => true,
            ]
        );

        return redirect()->route('questionnaires.result', $attempt)
            ->with('success', 'Kuisioner berhasil dikirim!');
    }

    public function result(QuestionnaireAttempt $attempt)
    {
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        $questionnaire = $attempt->questionnaire;
        $questions = $questionnaire->questions()->orderBy('order_number')->get();

        return view('questionnaires.result', compact('attempt', 'questionnaire', 'questions'));
    }
}
