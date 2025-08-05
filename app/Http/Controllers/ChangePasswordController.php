<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $member = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $member->password)) {
            return back()->withErrors(['current_password' => 'Kata laluan sekarang tidak sah.']);
        }

        $member->password = Hash::make($request->new_password);
        $member->save();

        return back()->with('success', 'Kata laluan berjaya dikemaskini.');
    }
}
