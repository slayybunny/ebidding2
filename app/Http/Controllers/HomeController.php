<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $member = auth()->user(); // Ambil data user yang sedang login
        return view('home', compact('member')); // Hantar ke view
    }

    
}
