<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'username'   => 'nullable|string|max:255',
            'email'      => 'required|email|unique:admins,email',
            'role'       => 'nullable|string|max:100',
            'password'   => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',       // huruf kecil
                'regex:/[A-Z]/',       // huruf besar
                'regex:/[0-9]/',       // nombor
                'regex:/[@$!%*#?&]/',  // simbol
                'confirmed'            // mesti sama dengan password_confirmation
            ],
        ]);

        // ✅ Simpan data admin
        $admin = Admin::create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'username'   => $request->input('username'),
            'email'      => $request->input('email'),
            'role'       => $request->input('role'),
            'password'   => Hash::make($request->input('password')),
        ]);

        // Jika nak auto-login selepas daftar, uncomment:
        // Auth::guard('admin')->login($admin);

        return redirect()->route('admin.login')->with('success', 'Account created successfully. Please login.');
    }
}
