<?php

namespace App\Http\Controllers;

use App\Models\DailyProgress;
use App\Models\Video;
use App\Models\VideoProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        $user = auth()->user();
        $course = $video->course;
        $progress = VideoProgress::where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->first();

        // Get all videos in the course for navigation
        $courseVideos = $course->videos()->where('is_active', true)->orderBy('order_number')->get();
        $currentIndex = $courseVideos->search(fn($v) => $v->id === $video->id);
        $prevVideo = $currentIndex > 0 ? $courseVideos[$currentIndex - 1] : null;
        $nextVideo = $currentIndex < $courseVideos->count() - 1 ? $courseVideos[$currentIndex + 1] : null;

        return view('videos.show', compact('video', 'course', 'progress', 'courseVideos', 'prevVideo', 'nextVideo'));
    }

    public function updateProgress(Request $request, Video $video)
    {
        $request->validate([
            'watched_seconds' => 'required|numeric|min:0',
            'total_seconds' => 'required|numeric|min:1',
        ]);

        $user = auth()->user();
        $watchedSeconds = (int) $request->watched_seconds;
        $totalSeconds = (int) $request->total_seconds;
        $percentage = min(100, round(($watchedSeconds / $totalSeconds) * 100, 2));
        $isCompleted = $percentage >= 95;

        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'video_id' => $video->id,
            ],
            [
                'watched_seconds' => $watchedSeconds,
                'total_seconds' => $totalSeconds,
                'percentage' => $percentage,
                'is_completed' => $isCompleted,
            ]
        );

        // Update video duration if not set
        if ($video->duration_seconds === 0) {
            $video->update(['duration_seconds' => $totalSeconds]);
        }

        // Record daily progress for streak
        if ($isCompleted) {
            DailyProgress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'activity_date' => Carbon::today()->toDateString(),
                ],
                [
                    'videos_watched' => \DB::raw('videos_watched + 1'),
                    'is_active' => true,
                ]
            );
        }

        return response()->json([
            'success' => true,
            'percentage' => $percentage,
            'is_completed' => $isCompleted,
        ]);
    }
}
