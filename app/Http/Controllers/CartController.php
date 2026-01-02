<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        // 1. Force Login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to shop!');
        }

        // 2. Check if item already exists in YOUR cart
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $id)
                        ->first();

        if ($cartItem) {
            // If exists, just add +1 to quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If new, create a database row
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }



    // Show the Cart Page
    public function showCart()
    {
        // Get cart items for the current user, including the Product details
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Calculate Total Price
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }
}
