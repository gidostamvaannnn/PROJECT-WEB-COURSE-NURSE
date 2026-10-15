<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DailyProgress;
use App\Models\VideoProgress;
use App\Models\Questionnaire;
use App\Models\QuestionnaireAttempt;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Course progress
        $courses = Course::where('is_active', true)
            ->with(['videos', 'questionnaires'])
            ->orderBy('order_number')
            ->get();
        $totalCourses = $courses->count();
        $completedCourses = 0;

        foreach ($courses as $course) {
            $course->progress = $course->getUserProgressPercentage($user->id);
            $course->all_completed = $course->allVideosCompleted($user->id);
            if ($course->all_completed) {
                $completedCourses++;
            }
        }

        // Video stats
        $totalVideosCompleted = VideoProgress::where('user_id', $user->id)
            ->where('is_completed', true)->count();

        // Questionnaire stats
        $totalQuestionnairesCompleted = QuestionnaireAttempt::where('user_id', $user->id)
            ->where('is_passed', true)->count();

        // Streak data (90 days)
        $startDate = $user->created_at->copy()->startOfDay();
        $endDate = $startDate->copy()->addDays(89);
        $today = Carbon::today();

        $dailyProgressRecords = DailyProgress::where('user_id', $user->id)
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->pluck('activity_date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->toArray();

        $activeDays = count($dailyProgressRecords);
        $daysPassed = $startDate->diffInDays($today) + 1;
        $daysPassed = min($daysPassed, 90);
        $daysRemaining = max(0, 90 - $daysPassed);

        // Current streak
        $currentStreak = 0;
        $checkDate = $today->copy();
        while ($checkDate->gte($startDate)) {
            if (in_array($checkDate->format('Y-m-d'), $dailyProgressRecords)) {
                $currentStreak++;
                $checkDate->subDay();
            } else {
                break;
            }
        }

        $totalQuestionnaires = Questionnaire::where('is_active', true)->count();
        $isTodayActive = in_array($today->format('Y-m-d'), $dailyProgressRecords);

        // Check certificate eligibility
        $hasCertificate = $user->certificates()->exists();
        $canGetCertificate = $activeDays >= 90 && !$hasCertificate;

        return view('dashboard', compact(
            'courses',
            'totalCourses',
            'completedCourses',
            'totalVideosCompleted',
            'totalQuestionnairesCompleted',
            'totalQuestionnaires',
            'isTodayActive',
            'activeDays',
            'daysPassed',
            'daysRemaining',
            'currentStreak',
            'dailyProgressRecords',
            'startDate',
            'endDate',
            'hasCertificate',
            'canGetCertificate'
        ));
    }
}
