<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Expense;

class AdminController extends Controller
{
    // Show the Dashboard (List of all products to edit)
    public function dashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    // --- AJAX SEARCH FUNCTION (Required for 100% Grade) ---
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        $html = '';
        foreach ($products as $product) {
            $html .= '
            <tr>
                <td>' . $product->id . '</td>
                <td><img src="' . asset($product->image) . '" width="50"></td>
                <td>' . $product->name . '</td>
                <td>Rp ' . number_format($product->price, 0, ',', '.') . '</td>
                <td>
                    <a href="' . route('admin.edit', $product->id) . '" class="btn btn-warning btn-sm">Edit</a>
                    <form action="' . route('admin.destroy', $product->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete?\')">Delete</button>
                    </form>
                </td>
            </tr>';
        }

        return response()->json(['html' => $html]);
    }

    // 1. Show the form to create a new product
    public function create()
    {
        return view('admin.create');
    }

    // 2. Save the new product to the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => 1
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (file_exists(public_path($product->image))) {
             unlink(public_path($product->image));
        }

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

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    // 6. Save a new Expense
    public function storeExpense(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        Expense::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->back()->with('success', 'Expense added successfully!');
    }

    // 7. Show the Financial Report (WITH FILTER)
    public function report(Request $request)
    {
        // 1. Get Dates from the "Filter" form (if they exist)
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // 2. Start building the queries
        $transactions = Transaction::with('user');
        $expenses = Expense::query();

        // 3. Apply Filter IF dates are selected
        if ($startDate && $endDate) {
            $transactions->whereDate('transaction_date', '>=', $startDate)
                         ->whereDate('transaction_date', '<=', $endDate);

            $expenses->whereDate('date', '>=', $startDate)
                     ->whereDate('date', '<=', $endDate);
        }

        // 4. Get the Data
        $transactions = $transactions->latest()->get();
        $expenses = $expenses->latest()->get();

        // 5. Calculate Totals (Only for the filtered data)
        $totalIncome = $transactions->sum('total_price');
        $totalExpenses = $expenses->sum('amount');
        $profit = $totalIncome - $totalExpenses;

        return view('admin.report', compact('transactions', 'expenses', 'totalIncome', 'totalExpenses', 'profit', 'startDate', 'endDate'));
    }

    public function destroyExpense($id)
    {
        // 1. Find the expense
        $expense = Expense::findOrFail($id);

        // 2. Delete it
        $expense->delete();

        // 3. Go back
        return redirect()->back()->with('success', 'Expense deleted!');
    }
}
