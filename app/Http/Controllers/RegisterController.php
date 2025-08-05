<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:WARGANEGARA MALAYSIA,BUKAN WARGANEGARA',
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'phone' => ['required', 'digits_between:1,14', 'regex:/^[0-9]+$/'],
            'mykad' => [
                'required_if:category,WARGANEGARA MALAYSIA',
                'nullable', 'digits:12', 'regex:/^[0-9]+$/', 'same:confirm_mykad'
            ],
            'confirm_mykad' => ['nullable', 'same:mykad'],
            'passport' => [
                'required_if:category,BUKAN WARGANEGARA',
                'nullable', 'max:9', 'regex:/^[a-zA-Z0-9]+$/', 'same:confirm_passport'
            ],
            'confirm_passport' => ['nullable', 'same:passport'],
            'email' => ['required', 'email', 'confirmed'],
            'email_confirmation' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        try {
            Member::create([
                'category' => $request->category,
                'name' => $request->name,
                'phone' => $request->phone,
                'mykad' => $request->mykad,
                'passport' => $request->passport,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $otp = rand(100000, 999999);
            $member = Member::where('email', $request->email)->first();
            $member->otp = $otp;
            $member->otp_expires_at = Carbon::now()->addMinutes(5);
            $member->save();

            Mail::raw("Your verification code is: $otp", function ($message) use ($member) {
                $message->to($member->email)->subject('Email Verification Code');
            });

            return redirect('/login')->with('success', 'Registration successful. OTP sent via email.');
        } catch (\Exception $e) {
            Log::error('Registration error', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to register: ' . $e->getMessage()]);
        }
    }
}
