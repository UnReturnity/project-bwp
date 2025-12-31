<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // OLD CODE (Delete this):
        // User::factory()->create(...)

        // NEW CODE (Add this):
        $this->call([
            RoleSeeder::class,
        ]);
    }
}
