<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth',
        'gender',
        'phone',
        'avatar',
        'is_complete',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'is_complete' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
