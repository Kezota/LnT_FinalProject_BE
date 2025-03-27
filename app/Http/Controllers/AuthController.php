<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|in:user,admin',
        ]);

        // Cek login untuk user
        if ($request->role === 'user') {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('user.dashboard');
            }
        }

        // Cek login untuk admin
        if ($request->role === 'admin') {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::login($admin);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Logout user/admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
