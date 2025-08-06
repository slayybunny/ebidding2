<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RulesManualController extends Controller
{
    /**
     * Display the Rules and User Manual page.
     */
    public function index()
    {
        return view('admin.rules_manual');
    }
}
