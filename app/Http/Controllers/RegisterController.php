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

            // Phone validation based on category
                'phone' => [
                    'required',
                    'regex:/^[0-9]+$/',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->category === 'BUKAN WARGANEGARA' && strlen($value) > 13) {
                            $fail('For non-citizens, the phone number must not be more than 13 digits.');
                        }
                        if ($request->category === 'WARGANEGARA MALAYSIA' && (strlen($value) < 10 || strlen($value) > 11)) {
                            $fail('For Malaysian citizens, the phone number must be 10 or 11 digits.');
                        }
                    }
                ],


            // Malaysian citizen
            'mykad' => [
                'required_if:category,WARGANEGARA MALAYSIA',
                'nullable',
                'digits:12',
                'regex:/^[0-9]+$/',
                'same:confirm_mykad'
            ],
            'confirm_mykad' => [
                'required_if:category,WARGANEGARA MALAYSIA',
                'nullable',
                'same:mykad'
            ],

            // Non-citizen
            'passport' => [
                'required_if:category,BUKAN WARGANEGARA',
                'nullable',
                'max:9',
                'regex:/^[a-zA-Z0-9]+$/',
                'same:confirm_passport'
            ],
            'confirm_passport' => [
                'required_if:category,BUKAN WARGANEGARA',
                'nullable',
                'same:passport'
            ],

            // Email & Password
            'email' => ['required', 'email', 'confirmed'],
            'email_confirmation' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        try {
            // Force null for unused field
            $mykad = $request->category === 'WARGANEGARA MALAYSIA' ? $request->mykad : null;
            $passport = $request->category === 'BUKAN WARGANEGARA' ? $request->passport : null;

            // Save member
            $member = Member::create([
                'category' => $request->category,
                'name' => $request->name,
                'phone' => $request->phone,
                'mykad' => $mykad,
                'passport' => $passport,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Generate OTP
            $otp = rand(100000, 999999);
            $member->otp = $otp;
            $member->otp_expires_at = Carbon::now()->addMinutes(5);
            $member->save();

            // Send OTP
            Mail::raw("Your verification code is: $otp", function ($message) use ($member) {
                $message->to($member->email)->subject('Email Verification Code');
            });

            return redirect('/login')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            Log::error('Registration error', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
