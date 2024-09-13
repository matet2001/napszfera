<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'napszfera@gmail.com',
            'phone' => 0000000,
            //TODO change this to secure
            'password' => Hash::make('CsanadMateGyuri2024'), // Change this to a secure password
            'is_admin' => true, // Set admin status
        ]);
    }
}

