<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\QuestionnaireAttempt;
use App\Models\User;
use App\Models\VideoProgress;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $verifiedUsers = User::where('role', 'user')->where('status', 'verified')->count();
        $pendingUsers = User::where('role', 'user')->where('status', 'pending')->count();
        $totalCourses = Course::count();
        $totalVideosWatched = VideoProgress::where('is_completed', true)->count();
        $totalQuestionnairesPassed = QuestionnaireAttempt::where('is_passed', true)->count();

        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(10)
            ->with('profile')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'verifiedUsers',
            'pendingUsers',
            'totalCourses',
            'totalVideosWatched',
            'totalQuestionnairesPassed',
            'recentUsers'
        ));
    }
}
