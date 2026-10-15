<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Questionnaire;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    public function run(): void
    {
        $courseBHD = Course::where('title', 'Bantuan Hidup Dasar (BHD)')->first();
        if ($courseBHD) {
            $quiz1 = Questionnaire::create([
                'course_id' => $courseBHD->id,
                'title' => 'Evaluasi Kompetensi Bantuan Hidup Dasar (BHD)',
                'description' => 'Selesaikan pertanyaan pilihan ganda dan essay di bawah untuk menguji pemahaman BHD.',
                'passing_score' => 70,
                'is_active' => true,
            ]);

            Question::create([
                'questionnaire_id' => $quiz1->id,
                'question_text' => 'Berapa rasio kompresi dada dibanding bantuan napas (ventilasi) yang tepat pada resusitasi dewasa dengan satu atau dua penolong?',
                'type' => 'multiple_choice',
                'options' => [
                    'A' => '15 kompresi : 2 ventilasi',
                    'B' => '30 kompresi : 2 ventilasi',
                    'C' => '30 kompresi : 5 ventilasi',
                    'D' => '15 kompresi : 1 ventilasi'
                ],
                'correct_answer' => 'B',
                'points' => 10,
                'order_number' => 1,
            ]);

            Question::create([
                'questionnaire_id' => $quiz1->id,
                'question_text' => 'Di manakah letak posisi tangan yang benar saat melakukan tindakan kompresi dada pada pasien dewasa?',
                'type' => 'multiple_choice',
                'options' => [
                    'A' => 'Setengah bagian bawah tulang dada (sternum)',
                    'B' => 'Setengah bagian atas tulang dada (sternum)',
                    'C' => 'Bagian sebelah kiri dada',
                    'D' => 'Di atas ulu hati (prosesus xifoideus)'
                ],
                'correct_answer' => 'A',
                'points' => 10,
                'order_number' => 2,
            ]);

            Question::create([
                'questionnaire_id' => $quiz1->id,
                'question_text' => 'Jelaskan langkah-langkah penanganan henti jantung menggunakan AED (Automated External Defibrillator) secara ringkas!',
                'type' => 'essay',
                'points' => 10,
                'order_number' => 3,
            ]);
        }

        $courseInfus = Course::where('title', 'Pemasangan Infus (Intravenous Cannulation)')->first();
        if ($courseInfus) {
            $quiz2 = Questionnaire::create([
                'course_id' => $courseInfus->id,
                'title' => 'Evaluasi Keterampilan Pemasangan Infus',
                'description' => 'Kuisioner evaluasi teori seputar kanulasi intravena.',
                'passing_score' => 80,
                'is_active' => true,
            ]);

            Question::create([
                'questionnaire_id' => $quiz2->id,
                'question_text' => 'Ukuran jarum abocath berapakah yang disarankan dan paling umum digunakan untuk transfusi darah cepat pada pasien dewasa gawat darurat?',
                'type' => 'multiple_choice',
                'options' => [
                    'A' => 'Ukuran 24G',
                    'B' => 'Ukuran 22G',
                    'C' => 'Ukuran 18G',
                    'D' => 'Ukuran 26G'
                ],
                'correct_answer' => 'C',
                'points' => 10,
                'order_number' => 1,
            ]);

            Question::create([
                'questionnaire_id' => $quiz2->id,
                'question_text' => 'Mengapa desinfeksi area penusukan infus dengan alkohol swab harus ditunggu sampai kering sebelum ditusuk?',
                'type' => 'essay',
                'points' => 10,
                'order_number' => 2,
            ]);
        }
    }
}
