<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminName = env('ADMIN_NAME', 'Admin');
        $adminEmail = env('ADMIN_EMAIL');
        $adminPhone = env('ADMIN_PHONE', 'N/A');
        $adminPassword = env('ADMIN_PASSWORD', 'defaultpassword');

        // Output for debugging
        echo "Creating admin user with email: $adminName\n $adminEmail\n $adminPhone\n $adminPassword\n";

        // Create the admin user
        User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'phone' => $adminPhone,
            'password' => Hash::make($adminPassword),
            'is_admin' => true,
        ]);
    }

}

