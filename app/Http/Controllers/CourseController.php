<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\VideoProgress;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = Course::where('is_active', true)
            ->orderBy('order_number')
            ->with('videos')
            ->get();

        // Calculate progress for each course
        foreach ($courses as $course) {
            $course->progress = $course->getUserProgressPercentage($user->id);
            $course->all_completed = $course->allVideosCompleted($user->id);
        }

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $user = auth()->user();
        $videos = $course->videos()->where('is_active', true)->orderBy('order_number')->get();

        // Get progress for each video
        foreach ($videos as $video) {
            $progress = VideoProgress::where('user_id', $user->id)
                ->where('video_id', $video->id)
                ->first();
            $video->user_progress = $progress;
        }

        $courseProgress = $course->getUserProgressPercentage($user->id);
        $allVideosCompleted = $course->allVideosCompleted($user->id);
        $questionnaires = $course->questionnaires()->where('is_active', true)->get();

        // Check questionnaire attempts
        foreach ($questionnaires as $q) {
            $q->user_attempt = $q->userAttempt($user->id);
        }

        return view('courses.show', compact(
            'course',
            'videos',
            'courseProgress',
            'allVideosCompleted',
            'questionnaires'
        ));
    }
}
