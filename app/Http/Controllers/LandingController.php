<?php

namespace App\Http\Controllers;

use App\Models\Course;

class LandingController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->with(['videos', 'questionnaires'])
            ->orderBy('order_number')
            ->get();
        $totalCourses = $courses->count();
        $totalVideos = \App\Models\Video::where('is_active', true)->count();
        $totalQuestionnaires = \App\Models\Questionnaire::where('is_active', true)->count();

        return view('landing', compact('courses', 'totalCourses', 'totalVideos', 'totalQuestionnaires'));
    }
}
