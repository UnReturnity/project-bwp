<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <--- Make sure this line is here!

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Admin User (The Boss)
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@bwp.com',
            'password' => bcrypt('password123'),
            'is_admin' => true // This makes them an Admin
        ]);

        // 2. Create a Normal Customer
        User::create([
            'name' => 'Test Customer',
            'email' => 'user@bwp.com',
            'password' => bcrypt('password123'),
            'is_admin' => false // This is a normal user
        ]);

        // 3. Add the Fake Food (Don't forget this!)
        $this->call(ProductSeeder::class);
    }
}
