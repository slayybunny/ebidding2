<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        $roles = ['user_admin', 'super_admin'];

        return view('admin.profile_edit', compact('admin', 'roles'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'username'        => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email'           => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'phone_number'    => 'nullable|string|max:20',
            'password'        => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Pastikan folder wujud di direktori public
        $folderPath = public_path('storage/avatars/admin');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
        }

        // Handle gambar
        if ($request->hasFile('profile_picture')) {
            // Padam gambar lama jika ada
            if ($admin->avatar && File::exists($folderPath . '/' . $admin->avatar)) {
                File::delete($folderPath . '/' . $admin->avatar);
            }

            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($folderPath, $filename);
            $admin->avatar = $filename; // Simpan nama file sahaja
        }

        // Update maklumat lain
        $admin->first_name = $validated['first_name'];
        $admin->last_name = $validated['last_name'];
        $admin->username = $validated['username'];
        $admin->email = $validated['email'];
        $admin->phone_number = $validated['phone_number'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
