<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'title' => 'Bantuan Hidup Dasar (BHD)',
            'description' => 'Mempelajari tindakan pertolongan medis darurat untuk memulihkan fungsi pernapasan dan sirkulasi darah pada korban henti jantung.',
            'order_number' => 1,
            'is_active' => true,
        ]);

        Course::create([
            'title' => 'Pemasangan Infus (Intravenous Cannulation)',
            'description' => 'Materi standar mengenai teknik aseptik, pemilihan vena, dan penusukan jarum abocath infus yang aman.',
            'order_number' => 2,
            'is_active' => true,
        ]);
        
        Course::create([
            'title' => 'Pemberian Obat Melalui Injeksi',
            'description' => 'Panduan dan prosedur keselamatan dalam memberikan obat melalui injeksi intravena (IV), intramuskular (IM), dan subkutan (SC).',
            'order_number' => 3,
            'is_active' => true,
        ]);
        
        Course::create([
            'title' => 'Perawatan Luka Dasar',
            'description' => 'Teknik pembersihan luka, pemilihan balutan yang tepat, dan pencegahan infeksi pada luka akut maupun kronis.',
            'order_number' => 4,
            'is_active' => true,
        ]);
    }
}
