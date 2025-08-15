<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginLog;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
    'category' => 'required|in:WARGANEGARA MALAYSIA,BUKAN WARGANEGARA',
    'mykad' => 'required_without:passport|nullable|digits:12|regex:/^[0-9]+$/',
    'passport' => 'required_without:mykad|nullable|max:9|regex:/^[a-zA-Z0-9]+$/',
    'phone' => [
        'nullable',
        'regex:/^[0-9]+$/',
        function ($attribute, $value, $fail) use ($request) {
            if ($value) {
                if ($request->category === 'BUKAN WARGANEGARA' && strlen($value) > 13) {
                    $fail('For non-citizens, the phone number must not be more than 13 digits.');
                }
                if ($request->category === 'WARGANEGARA MALAYSIA' && (strlen($value) < 10 || strlen($value) > 11)) {
                    $fail('For Malaysian citizens, the phone number must be 10 or 11 digits.');
                }
            }
        }
    ],
    'password' => 'required',
]);


        $loginField = $request->category === 'WARGANEGARA MALAYSIA' ? 'mykad' : 'passport';

        if (Auth::guard('web')->attempt([$loginField => $request->$loginField, 'password' => $request->password])) {
            $request->session()->regenerate();

            $agent = new Agent();
            LoginLog::create([
                'ip_address' => $request->ip(),
                'device' => $agent->platform() . ' - ' . $agent->browser(),
                'login_time' => now(),
                'admin_id' => null,
                'user_id' => Auth::guard('web')->id(),
            ]);

            return redirect()->route('home')->with('success', 'Login successful. Welcome!');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials. Please check your details and try again.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
