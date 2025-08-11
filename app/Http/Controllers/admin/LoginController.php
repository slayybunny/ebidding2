<?php  

namespace App\Http\Controllers\admin;  

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  
use App\Models\LoginLog; // Pastikan model ini diimport  
use Jenssegers\Agent\Agent;  

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
        $credentials = $request->only('email', 'password');  

        if (Auth::guard('admin')->attempt($credentials)) {  
            $agent = new Agent();  

            // Catat log masuk sebagai admin  
            LoginLog::create([  
                'ip_address' => $request->ip(),  
                'device' => $agent->platform() . ' - ' . $agent->browser(),  
                'login_time' => now(),  
                'admin_id' => Auth::guard('admin')->id(), // Mencatat ID admin  
                'user_id' => null, // Pastikan ID pengguna biasa null  
            ]);  

            return redirect()->route('admin.dashboard');  
        }  

        return back()->withErrors(['email' => 'Login failed']);  
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
