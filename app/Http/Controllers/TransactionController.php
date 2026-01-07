<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Get the user's cart
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        // 2. Calculate Total Price
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // 3. Create Transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'transaction_date' => now(),
            'total_price' => $total
        ]);

        // 4. Move items to Transaction Details
        foreach ($cartItems as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // 5. Clear Cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('history.index')->with('success', 'Checkout successful!');
    }

    // Show the Order History for the logged-in user
    public function index()
    {
        // Get all transactions for this user, ordered by newest first
        $transactions = Transaction::where('user_id', Auth::id())
                        ->with('details.product') // Load the bread details too
                        ->latest()
                        ->get();

        return view('history.index', compact('transactions'));
    }
}
