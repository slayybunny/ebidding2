<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;

class LoginLogController extends Controller
{
    public function index()
    {
        // Ambil semua log masuk, siap dengan relasi admin & user (member)
        $loginLogs = LoginLog::with(['admin', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.login-logs.index', compact('loginLogs'));
    }
}
