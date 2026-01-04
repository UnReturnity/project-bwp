<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Handle the Registration Logic
    public function registerUser(Request $request) {
        // 1. Validate the inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        // 2. Create the User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // FIX: We use 'is_admin' now, not 'role_id'
            'is_admin' => false
        ]);

        // 3. Redirect to Login with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please Login.');
    }

    // Handle the Login Logic
    public function loginUser(Request $request) {
        // 1. Validate inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Try to Login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // --- NEW REDIRECT LOGIC START ---
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            // --- NEW REDIRECT LOGIC END ---

            return redirect()->route('home'); // Normal users go Home
        }

        // 3. If failed, go back
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Handle Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
