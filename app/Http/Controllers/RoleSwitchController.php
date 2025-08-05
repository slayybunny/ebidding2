<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleSwitchController extends Controller
{
    public function switchRole(Request $request)
    {
        $role = $request->input('role');
        Session::put('active_role', $role);  // Store the selected role in session

        // Redirect to the appropriate page based on role
        if ($role === 'user') {
            return redirect()->route('home');  // Redirect to user home page
        } elseif ($role === 'tender') {
            return redirect()->route('create-listing');  // Redirect to create listing page
        }

        return redirect()->route('home');  // Default to home if role is invalid
    }
}
