<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:3|max:40',
            'email' => 'required|email|ends_with:@gmail.com',
            'password' => 'required|string|min:6|max:12',
            'nomor_handphone' => 'required|string|starts_with:08|min:10',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Create new user
        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nomor_handphone = $request->nomor_handphone;
        $user->save();

        // Automatically log in the user after registration
        Auth::guard('user')->login($user);

        // Redirect to the user's catalog page
        return redirect()->route('user.catalog')->with('success', 'Registration successful! You are now logged in.');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|in:user,admin',
        ]);

        // Check login for user
        if ($request->role === 'user') {
            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('user.catalog');
            }
        }

        // Check login for admin
        if ($request->role === 'admin') {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Email or password is incorrect.');
    }

    // Logout user/admin
    public function logout(Request $request)
    {
        // Check if user/admin is logged in
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('login');
    }
}
