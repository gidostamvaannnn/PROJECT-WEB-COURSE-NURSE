<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'passing_score',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_number');
    }

    public function attempts()
    {
        return $this->hasMany(QuestionnaireAttempt::class);
    }

    public function userAttempt($userId)
    {
        return $this->attempts()->where('user_id', $userId)->latest()->first();
    }

    public function getTotalPointsAttribute(): int
    {
        return $this->questions()->sum('points');
    }
}
