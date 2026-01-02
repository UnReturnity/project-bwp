<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $breadId = DB::table('categories')->insertGetId([
            'name' => 'Artisan Breads',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cakeId = DB::table('categories')->insertGetId([
            'name' => 'Sweet Cakes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Create Products
        DB::table('products')->insert([
            [
                'category_id' => $breadId,
                'name' => 'Sourdough Loaf',
                'description' => 'Classic fermented sourdough with a crispy crust.',
                'stock' => 20,
                'price' => 35000.00,
                'image' => 'https://placehold.co/400x300?text=Sourdough', // Fake Image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $breadId,
                'name' => 'Garlic Baguette',
                'description' => 'French baguette topped with garlic butter and herbs.',
                'stock' => 50,
                'price' => 15000.00,
                'image' => 'https://placehold.co/400x300?text=Baguette',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $cakeId,
                'name' => 'Strawberry Cheesecake',
                'description' => 'Creamy cheesecake topped with fresh strawberries.',
                'stock' => 10,
                'price' => 125000.00,
                'image' => 'https://placehold.co/400x300?text=Cheesecake',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
