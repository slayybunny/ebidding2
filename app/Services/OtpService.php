<?php

namespace App\Services;

use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class OtpService
{
    public function generateOtp($identifier, $type)
    {
        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['identifier' => $identifier, 'type' => $type],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        if ($type === 'email') {
            Mail::raw("Your OTP code is: $otp", function ($message) use ($identifier) {
                $message->to($identifier)->subject("Your OTP Code");
            });
        } elseif ($type === 'sms') {
            $this->sendSms($identifier, "Your OTP code is: $otp");
        }
    }

    public function verifyOtp($identifier, $otp, $type)
    {
        $otpRecord = Otp::where('identifier', $identifier)
                        ->where('otp', $otp)
                        ->where('type', $type)
                        ->where('expires_at', '>=', now())
                        ->first();

        if ($otpRecord) {
            $otpRecord->delete(); // optional
            return true;
        }

        return false;
    }

    private function sendSms($to, $message)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $twilio->messages->create($to, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => $message,
        ]);
    }
}
