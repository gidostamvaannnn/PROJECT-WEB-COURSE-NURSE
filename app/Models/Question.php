<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'questionnaire_id',
        'question_text',
        'type',
        'options',
        'correct_answer',
        'points',
        'order_number',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
