<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'otp_code',
        'otp_expires_at',
        'email_verified',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified' => 'boolean',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function videoProgress()
    {
        return $this->hasMany(VideoProgress::class);
    }

    public function questionnaireAttempts()
    {
        return $this->hasMany(QuestionnaireAttempt::class);
    }

    public function dailyProgress()
    {
        return $this->hasMany(DailyProgress::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isProfileComplete(): bool
    {
        return $this->profile && $this->profile->is_complete;
    }
}
