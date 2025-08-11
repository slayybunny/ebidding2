<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginLog; // Import model LoginLog
use Jenssegers\Agent\Agent; // Import library untuk kesan peranti

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'category' => 'required|in:WARGANEGARA MALAYSIA,BUKAN WARGANEGARA',
            'mykad' => 'required_without:passport|nullable|digits:12|regex:/^[0-9]+$/',
            'passport' => 'required_without:mykad|nullable|max:9|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required',
        ]);

        $loginField = $request->category === 'WARGANEGARA MALAYSIA' ? 'mykad' : 'passport';

        // ✅ Guna guard 'web' secara eksplisit
        if (Auth::guard('web')->attempt([$loginField => $request->$loginField, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            $agent = new Agent();

            // Tambah kod ini untuk mencatat log masuk pengguna biasa
            LoginLog::create([
                'ip_address' => $request->ip(),
                'device' => $agent->platform() . ' - ' . $agent->browser(),
                'login_time' => now(),
                'admin_id' => null, // Pastikan ID admin null
                'user_id' => Auth::guard('web')->id(), // Mencatat ID pengguna biasa
            ]);

            return redirect('/')->with('success', 'Login successful.');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // atau route lain ikut keperluan
    }
}
