<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // Show the Dashboard (List of all products to edit)
    public function dashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    // 1. Show the form to create a new product
    public function create()
    {
        return view('admin.create');
    }

    // 2. Save the new product to the database
    public function store(Request $request)
    {
        // 1. Validate (Check if it's a real image file)
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // 2. Handle the File Upload
        if ($request->hasFile('image')) {
            // Create a unique name (e.g., 17098234_cake.jpg) so files don't overwrite each other
            $imageName = time() . '.' . $request->image->extension();

            // Move the file to the 'public/images' folder
            $request->image->move(public_path('images'), $imageName);

            // Save the path to the database
            $imagePath = 'images/' . $imageName;
        }

        // 3. Create the Product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath, // Save 'images/photo.jpg' instead of a long URL
            'category_id' => 1
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully!');
    }

    public function destroy($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // (Optional) Delete the image file from the folder to save space
        if (file_exists(public_path($product->image))) {
             unlink(public_path($product->image));
        }

        // Delete from Database
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // 5. Save the Changes
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validation (Image is nullable here because they might not want to change it)
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Name and Price
        $product->name = $request->name;
        $product->price = $request->price;

        // Check if there is a NEW image
        if ($request->hasFile('image')) {
            // 1. Delete the old image to save space
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // 2. Upload the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }
}
