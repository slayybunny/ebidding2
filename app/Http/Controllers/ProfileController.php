<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Member;
use Carbon\Carbon;
use Twilio\Rest\Client;

class ProfileController extends Controller
{
    public function show()
    {
        $member = Member::find(Auth::id());

        if (!$member) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('profile', compact('member'));
    }

    public function update(Request $request)
    {
        $member = Member::find(Auth::id());

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'digits_between:10,14'],
            'email' => ['required', 'email'],
            'address' => ['nullable', 'string'],
        ]);

        if ($member->category === 'WARGANEGARA MALAYSIA') {
            $validated['mykad'] = $request->validate(['mykad' => ['required', 'digits:12']])['mykad'];
        } else {
            $validated['passport'] = $request->validate(['passport' => ['required', 'max:9']])['passport'];
        }

        if ($validated['phone'] !== $member->phone) {
            $otp = rand(100000, 999999);
            $member->otp = $otp;
            $member->otp_expires_at = Carbon::now()->addMinutes(5);
            $member->new_phone = $validated['phone'];
            $member->name = $validated['name'];
            $member->email = $validated['email'];
            $member->address = $validated['address'];
            if ($member->category === 'WARGANEGARA MALAYSIA') {
                $member->mykad = $validated['mykad'];
            } else {
                $member->passport = $validated['passport'];
            }
            $member->save();

            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $twilio->messages->create($member->phone, [
                'from' => env('TWILIO_FROM'),
                'body' => "Your verification code is: $otp"
            ]);

            return redirect()->route('profile.otp')->with('info', 'A verification code has been sent to your phone.');
        }

        $member->name = $validated['name'];
        $member->email = $validated['email'];
        $member->address = $validated['address'];
        if ($member->category === 'WARGANEGARA MALAYSIA') {
            $member->mykad = $validated['mykad'];
        } else {
            $member->passport = $validated['passport'];
        }
        $member->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function showOtpForm()
    {
        return view('verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $member = Member::find(Auth::id());

        if (
            !$member ||
            !$member->otp ||
            $member->otp !== $request->otp ||
            Carbon::now()->gt($member->otp_expires_at)
        ) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        $member->phone = $member->new_phone;
        $member->new_phone = null;
        $member->otp = null;
        $member->otp_expires_at = null;
        $member->save();

        return redirect()->route('profile')->with('success', 'Phone number verified and updated.');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);

        $member = Member::find(Auth::id());
        if (!$member) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');
        $member->photo = $path;
        $member->save();

        return redirect()->route('profile')->with('success', 'Profile photo uploaded.');
    }

    public function deletePhoto()
    {
        $member = Member::find(Auth::id());

        if (!$member) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
            $member->photo = null;
            $member->save();
        }

        return redirect()->route('profile')->with('success', 'Profile photo deleted.');
    }
}
