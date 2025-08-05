<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $member = Member::where('email', $request->email)->first();
        if (!$member) {
            return back()->with('error', 'Email not found.');
        }

        $otp = rand(100000, 999999);
        $member->otp = $otp;
        $member->otp_expires_at = Carbon::now()->addMinutes(5);
        $member->save();

        Mail::raw("Your OTP code to reset password is: $otp", function ($msg) use ($member) {
            $msg->to($member->email)->subject('Reset Password OTP');
        });

        return redirect()->route('forgot.verify.form')->with('info', 'OTP sent to email.');
    }

    public function showVerifyForm()
    {
        return view('auth.verify-reset-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:8|confirmed',
        ]);

        $member = Member::where('email', $request->email)->first();

        if (!$member || $member->otp !== $request->otp || Carbon::now()->gt($member->otp_expires_at)) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        $member->password = Hash::make($request->password);
        $member->otp = null;
        $member->otp_expires_at = null;
        $member->save();

        return redirect('/login')->with('success', 'Password updated. Please login.');
    }
}
