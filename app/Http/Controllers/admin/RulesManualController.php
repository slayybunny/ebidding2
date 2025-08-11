<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RulesManualController extends Controller
{
    public function index()
    {
        return view('admin.pages.rules_and_manual');
    }
}
