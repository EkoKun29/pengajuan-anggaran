<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

   // Proses login
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'admin super':
                return redirect()->route('admin_super.dashboard');
            case 'direktur':
                return redirect()->route('direktur.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                Auth::logout();
                return back()->withErrors(['email' => 'Role tidak dikenali.']);
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
}
     // Proses logout
     public function logout(Request $request)
     {
         Auth::logout();
 
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect()->route('login.form');
     }
}