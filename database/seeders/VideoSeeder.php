<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $courseBHD = Course::where('title', 'Bantuan Hidup Dasar (BHD)')->first();
        if ($courseBHD) {
            Video::create([
                'course_id' => $courseBHD->id,
                'title' => 'Pengenalan dan Algoritma BHD Terkini',
                'video_url' => 'https://www.youtube.com/embed/e211yvS7g40',
                'duration_seconds' => 300,
                'order_number' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'course_id' => $courseBHD->id,
                'title' => 'Teknik Kompresi Dada dan Ventilasi Praktis',
                'video_url' => 'https://www.youtube.com/embed/duy6S4W50p4',
                'duration_seconds' => 450,
                'order_number' => 2,
                'is_active' => true,
            ]);
        }

        $courseInfus = Course::where('title', 'Pemasangan Infus (Intravenous Cannulation)')->first();
        if ($courseInfus) {
            Video::create([
                'course_id' => $courseInfus->id,
                'title' => 'Persiapan Alat dan Prosedur Penusukan Vena',
                'video_url' => 'https://www.youtube.com/embed/duy6S4W50p4', // Using a placeholder since we don't have a real link
                'duration_seconds' => 600,
                'order_number' => 1,
                'is_active' => true,
            ]);
        }
    }
}
