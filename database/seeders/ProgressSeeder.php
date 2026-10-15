<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgressSeeder extends Seeder
{
    public function run(): void
    {
        $nurse = User::where('email', 'perawat@nurselms.com')->first();
        
        if (!$nurse) return;

        // 1. Seed Video Progress
        $videos = Video::all();
        foreach ($videos as $video) {
            // Mark the first video as completed, second as halfway
            if ($video->order_number == 1) {
                DB::table('video_progress')->insert([
                    'user_id' => $nurse->id,
                    'video_id' => $video->id,
                    'watched_seconds' => $video->duration_seconds,
                    'total_seconds' => $video->duration_seconds,
                    'percentage' => 100,
                    'is_completed' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif ($video->order_number == 2 && $video->course_id == 1) {
                DB::table('video_progress')->insert([
                    'user_id' => $nurse->id,
                    'video_id' => $video->id,
                    'watched_seconds' => $video->duration_seconds / 2,
                    'total_seconds' => $video->duration_seconds,
                    'percentage' => 50,
                    'is_completed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Seed Questionnaire Attempts
        $quizBHD = Questionnaire::where('title', 'Evaluasi Kompetensi Bantuan Hidup Dasar (BHD)')->first();
        if ($quizBHD) {
            DB::table('questionnaire_attempts')->insert([
                'user_id' => $nurse->id,
                'questionnaire_id' => $quizBHD->id,
                'answers' => json_encode(['q_1' => 'B', 'q_2' => 'A', 'q_3' => 'Pasang AED dan ikuti instruksi suara.']),
                'score' => 85,
                'is_passed' => true,
                'submitted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Seed Daily Progress (Streak) - Last 5 days
        for ($i = 4; $i >= 0; $i--) {
            DB::table('daily_progress')->insert([
                'user_id' => $nurse->id,
                'activity_date' => Carbon::today()->subDays($i)->format('Y-m-d'),
                'videos_watched' => 1,
                'questionnaires_completed' => $i == 0 ? 1 : 0, // Completed a quiz today
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. We won't seed a certificate by default so the user can see the progress bar.
        // But if we wanted to:
        // DB::table('certificates')->insert([...])
    }
}
