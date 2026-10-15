<?php

namespace App\Http\Controllers;

use App\Models\DailyProgress;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $startDate = $user->created_at->copy()->startOfDay();
        $endDate = $startDate->copy()->addDays(89);
        $today = Carbon::today();

        // Get all daily progress records
        $dailyProgressRecords = DailyProgress::where('user_id', $user->id)
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->get()
            ->keyBy(fn($d) => Carbon::parse($d->activity_date)->format('Y-m-d'));

        // Build calendar data
        $calendarData = [];
        $activeDays = 0;
        $missedDays = 0;

        for ($day = 0; $day < 90; $day++) {
            $date = $startDate->copy()->addDays($day);
            $dateKey = $date->format('Y-m-d');
            $hasProgress = isset($dailyProgressRecords[$dateKey]);

            $status = 'upcoming'; // default
            if ($date->lt($today)) {
                $status = $hasProgress ? 'active' : 'missed';
                if ($hasProgress) $activeDays++;
                else $missedDays++;
            } elseif ($date->eq($today)) {
                $status = $hasProgress ? 'active' : 'today';
                if ($hasProgress) $activeDays++;
            }

            $calendarData[] = [
                'date' => $date,
                'dateKey' => $dateKey,
                'day' => $day + 1,
                'status' => $status,
                'progress' => $dailyProgressRecords[$dateKey] ?? null,
            ];
        }

        // Calculate streaks
        $currentStreak = 0;
        $longestStreak = 0;
        $tempStreak = 0;

        foreach ($calendarData as $dayData) {
            if ($dayData['status'] === 'active') {
                $tempStreak++;
                $longestStreak = max($longestStreak, $tempStreak);
            } elseif ($dayData['status'] === 'missed') {
                $tempStreak = 0;
            }
        }

        // Current streak from today backwards
        $currentStreak = 0;
        $checkDate = $today->copy();
        while ($checkDate->gte($startDate)) {
            $dateKey = $checkDate->format('Y-m-d');
            if (isset($dailyProgressRecords[$dateKey])) {
                $currentStreak++;
                $checkDate->subDay();
            } else {
                break;
            }
        }

        $daysPassed = min(90, $startDate->diffInDays($today) + 1);
        $daysRemaining = max(0, 90 - $daysPassed);

        return view('schedule.index', compact(
            'calendarData',
            'activeDays',
            'missedDays',
            'currentStreak',
            'longestStreak',
            'daysPassed',
            'daysRemaining',
            'startDate',
            'endDate'
        ));
    }
}
