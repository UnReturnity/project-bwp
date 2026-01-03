<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout()
    {
        // 1. Get the user's cart
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Safety check: Is the cart empty?
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // 2. Create the Main Transaction (The Receipt Header)
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'transaction_date' => now(),
        ]);

        // 3. Move items from Cart to Transaction Details
        foreach ($cartItems as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        // 4. Empty the Cart
        Cart::where('user_id', Auth::id())->delete();

        // 5. Go to History Page (We will build this next)
        return redirect()->route('history.index')->with('success', 'Checkout successful!');
    }

    public function index()
    {
        // Get all past transactions for this user
        $transactions = Transaction::where('user_id', Auth::id())->with('details.product')->get();
        return view('history', compact('transactions'));
    }
}
