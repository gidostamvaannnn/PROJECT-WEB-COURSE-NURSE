<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::create([
            'email' => 'admin@nurselms.com',
            'password' => Hash::make('admin123'),
            'email_verified' => true,
            'role' => 'admin',
            'status' => 'verified',
        ]);
        
        Profile::create([
            'user_id' => $admin->id,
            'full_name' => 'Administrator NurseLMS',
            'phone' => '081234567890',
            'is_complete' => true,
        ]);

        // 2. Create Nurse
        $nurse = User::create([
            'email' => 'perawat@nurselms.com',
            'password' => Hash::make('perawat123'),
            'email_verified' => true,
            'role' => 'user',
            'status' => 'verified',
        ]);

        Profile::create([
            'user_id' => $nurse->id,
            'full_name' => 'Dimas Putra Perawat',
            'date_of_birth' => '1995-08-17',
            'gender' => 'male',
            'phone' => '089876543210',
            'is_complete' => true,
        ]);
    }
}
