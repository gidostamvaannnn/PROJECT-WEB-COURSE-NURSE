<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\DailyProgress;
use App\Models\QuestionnaireAttempt;
use App\Models\VideoProgress;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function generate()
    {
        $user = auth()->user();

        // Check if already has certificate
        if ($user->certificates()->exists()) {
            $cert = $user->certificates()->first();
            return redirect()->route('certificate.show', $cert);
        }

        // Check eligibility (90 days of activity)
        $startDate = $user->created_at->copy()->startOfDay();
        $endDate = $startDate->copy()->addDays(89);

        $activeDays = DailyProgress::where('user_id', $user->id)
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->count();

        if ($activeDays < 90) {
            return back()->with('error', 'Anda belum memenuhi syarat sertifikat. Hari aktif: ' . $activeDays . '/90');
        }

        $totalCourses = VideoProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->distinct('video_id')
            ->count();

        $totalQuestionnaires = QuestionnaireAttempt::where('user_id', $user->id)
            ->where('is_passed', true)
            ->count();

        $certificate = Certificate::create([
            'user_id' => $user->id,
            'certificate_number' => 'NL-' . date('Y') . '-' . strtoupper(Str::random(8)),
            'issued_date' => Carbon::today(),
            'total_days_active' => $activeDays,
            'total_courses_completed' => $totalCourses,
            'total_questionnaires_passed' => $totalQuestionnaires,
        ]);

        return redirect()->route('certificate.show', $certificate)
            ->with('success', 'Selamat! Sertifikat Anda berhasil diterbitkan.');
    }

    public function show(Certificate $certificate)
    {
        if ($certificate->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $user = $certificate->user;
        $profile = $user->profile;

        return view('certificates.show', compact('certificate', 'user', 'profile'));
    }
}
