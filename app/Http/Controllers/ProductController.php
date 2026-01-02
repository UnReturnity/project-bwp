<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products from the database
        $products = Product::all();

        // Send them to the 'products' view
        return view('products', compact('products'));
    }
}
