<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'order_number',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function videos()
    {
        return $this->hasMany(Video::class)->orderBy('order_number');
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function getVideoCountAttribute(): int
    {
        return $this->videos()->count();
    }

    public function getUserProgressPercentage($userId): float
    {
        $totalVideos = $this->videos()->count();
        if ($totalVideos === 0) return 0;

        $completedVideos = VideoProgress::where('user_id', $userId)
            ->whereIn('video_id', $this->videos()->pluck('id'))
            ->where('is_completed', true)
            ->count();

        return round(($completedVideos / $totalVideos) * 100, 1);
    }

    public function allVideosCompleted($userId): bool
    {
        $totalVideos = $this->videos()->where('is_active', true)->count();
        if ($totalVideos === 0) return false;

        $completedVideos = VideoProgress::where('user_id', $userId)
            ->whereIn('video_id', $this->videos()->where('is_active', true)->pluck('id'))
            ->where('is_completed', true)
            ->count();

        return $completedVideos >= $totalVideos;
    }
}
