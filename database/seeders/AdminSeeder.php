<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminName = env('ADMIN_NAME', 'Admin');
        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');
        $adminPhone = env('ADMIN_PHONE', 'N/A');
        $adminPassword = env('ADMIN_PASSWORD', 'defaultpassword');

        // Output for debugging
//        echo "Creating admin user with email: $adminName\n $adminEmail\n $adminPhone\n $adminPassword\n";

        // Create the admin user
        $admin = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'phone' => $adminPhone,
            'password' => Hash::make($adminPassword),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Create an inventory for the admin
        $inventory = Inventory::create([
            'user_id' => $admin->id,
        ]);

        // Add products to admin's inventory
        $products = Product::all();
        foreach ($products as $product) {
            InventoryItem::create([
                'inventory_id' => $inventory->id,
                'product_id' => $product->id,
            ]);
        }

        User::create([
            'name' => 'Máté Pojbics',
            'email' => 'matet2001@gmail.com',
            'phone' => '0000000',
            'password' => Hash::make('matetmatet'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
    }


}

