<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            VideoSeeder::class,
            QuestionnaireSeeder::class,
            ProgressSeeder::class,
        ]);
    }
}
