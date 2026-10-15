<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyProgress extends Model
{
    protected $table = 'daily_progress';

    protected $fillable = [
        'user_id',
        'activity_date',
        'videos_watched',
        'questionnaires_completed',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
