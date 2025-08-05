<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OtpService;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    // Hantar OTP ke email
    public function sendEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $this->otpService->generateOtp($request->email, 'email');

        return back()->with('success', 'OTP telah dihantar ke emel.');
    }

    // Sahkan OTP email
    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $valid = $this->otpService->verifyOtp($request->email, $request->otp, 'email');

        if ($valid) {
            return back()->with('success', 'OTP emel berjaya disahkan!');
        }

        return back()->withErrors(['otp' => 'OTP tidak sah atau telah tamat tempoh.']);
    }

    // Hantar OTP ke telefon (SMS)
    public function sendPhoneOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:10',
        ]);

        $this->otpService->generateOtp($request->phone, 'sms');

        return back()->with('success', 'OTP telah dihantar melalui SMS.');
    }

    // Sahkan OTP telefon
    public function verifyPhoneOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:10',
            'otp' => 'required|string|size:6',
        ]);

        $valid = $this->otpService->verifyOtp($request->phone, $request->otp, 'sms');

        if ($valid) {
            return back()->with('success', 'OTP telefon berjaya disahkan!');
        }

        return back()->withErrors(['otp' => 'OTP tidak sah atau telah tamat tempoh.']);
    }
}
