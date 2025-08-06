<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Papar borang login admin
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',        // huruf kecil
                'regex:/[A-Z]/',        // huruf besar
                'regex:/[0-9]/',        // nombor
                'regex:/[@$!%*#?&]/',   // simbol khas
            ],
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Incorrect email or password.');
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
