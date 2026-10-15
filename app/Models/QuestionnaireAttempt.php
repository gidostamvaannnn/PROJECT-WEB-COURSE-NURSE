<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'questionnaire_id',
        'answers',
        'score',
        'is_passed',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'is_passed' => 'boolean',
            'submitted_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
