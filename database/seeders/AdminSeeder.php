<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => env('ADMIN_NAME', 'Admin'), // Fallback to 'Admin' if not set
            'email' => env('ADMIN_EMAIL'),
            'phone' => env('ADMIN_PHONE'),
            'password' => Hash::make(env('ADMIN_PASSWORD')), // Hash the password from the env file
            'is_admin' => true, // Set admin status
        ]);
    }
}

