<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Expense;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. Create Users (UPDATED TO MATCH YOUR FIX)
        // ==========================================

        // 1A. Admin Boss (From your screenshot)
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@bwp.com', // Changed to match your image
            'password' => bcrypt('password123'),
            'is_admin' => true, // <--- THE FIX
        ]);

        // 1B. Bakery Admin (The account you wanted to fix)
        User::create([
            'name' => 'Bakery Admin',
            'email' => 'bakery@bwp.com',
            'password' => bcrypt('password123'),
            'is_admin' => true, // <--- THE FIX
        ]);

        // 1C. Customer (Needed for transactions below)
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password123'),
            'is_admin' => false // <--- Not an admin
        ]);

        // ==========================================
        // 2. Create Category
        // ==========================================
        $cat = Category::create([
            'name' => 'All Products',
            'description' => 'Fresh Bakery Items'
        ]);

        // ==========================================
        // 3. Create Products
        // ==========================================
        $products = [
            [
                'name' => 'Sourdough Loaf',
                'price' => 35000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Sourdough_bread_cropped.jpg/640px-Sourdough_bread_cropped.jpg'
            ],
            [
                'name' => 'Garlic Baguette',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Chocolate Muffin',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1607958996333-41aef7caefaa?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Strawberry Cheesecake',
                'price' => 125000,
                'image' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Cinnamon Roll',
                'price' => 18000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Cinnamon_roll_2.jpg/640px-Cinnamon_roll_2.jpg'
            ],
            [
                'name' => 'Whole Wheat Toast',
                'price' => 22000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Whole_wheat_bread.jpg/640px-Whole_wheat_bread.jpg'
            ],
            [
                'name' => 'Almond Croissant',
                'price' => 28000,
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Red Velvet Cake',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1616541823729-00fe0aacd32c?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Matcha Cookie',
                'price' => 12000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Matcha_Cookies.jpg/640px-Matcha_Cookies.jpg'
            ],
            [
                'name' => 'Sausage Roll',
                'price' => 32000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Sausage_Rolls.jpg/640px-Sausage_Rolls.jpg'
            ],
            [
                'name' => 'Blueberry Danish',
                'price' => 26000,
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'name' => 'Rainbow Bagel',
                'price' => 20000,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Bagel-Plain-Alt.jpg/640px-Bagel-Plain-Alt.jpg'
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'price' => $p['price'],
                'image' => $p['image'],
                'category_id' => $cat->id
            ]);
        }

        // ==========================================
        // 4. Generate Fake Transactions
        // ==========================================
        for ($i = 0; $i < 15; $i++) {
            $date = Carbon::now()->subDays(rand(1, 30));

            $transaction = Transaction::create([
                'user_id' => $customer->id,
                'transaction_date' => $date,
                'total_price' => 0,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $total = 0;
            $randomProducts = Product::inRandomOrder()->take(rand(1, 3))->get();

            foreach ($randomProducts as $prod) {
                $qty = rand(1, 2);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $prod->id,
                    'quantity' => $qty,
                    'price' => $prod->price,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $total += ($prod->price * $qty);
            }
            $transaction->update(['total_price' => $total]);
        }

        // ==========================================
        // 5. Generate Expenses
        // ==========================================
        Expense::create(['description' => 'Electricity Bill', 'amount' => 500000, 'date' => Carbon::now()->subDays(25)]);
        Expense::create(['description' => 'Flour Sack (25kg)', 'amount' => 250000, 'date' => Carbon::now()->subDays(10)]);
        Expense::create(['description' => 'Butter Restock', 'amount' => 150000, 'date' => Carbon::now()->subDays(5)]);
    }
}
