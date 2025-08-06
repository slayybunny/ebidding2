<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\RegisterController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ManageUsersController;
use App\Http\Controllers\admin\BiddingPlatformController;
use App\Http\Controllers\admin\BiddingHistoryController;
use App\Http\Controllers\admin\BiddingStatusController;
use App\Http\Controllers\admin\PaymentRecordController;
use App\Http\Controllers\admin\ProfitReportController;
use App\Http\Controllers\admin\RulesManualController;


// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('dashboard');

// PROFILE
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// MANAGE USERS
Route::get('/manage-users', [ManageUsersController::class, 'index'])->name('manage_users');

// BIDDING PLATFORM
Route::get('/bidding', [BiddingPlatformController::class, 'index'])->name('bidding.index');
Route::get('/bidding/create', [BiddingPlatformController::class, 'create'])->name('bidding.create');
Route::post('/bidding', [BiddingPlatformController::class, 'store'])->name('bidding.store');
Route::get('/bidding/{id}', [BiddingPlatformController::class, 'show'])->name('bidding.show');
Route::get('/bidding/{id}/edit', [BiddingPlatformController::class, 'edit'])->name('bidding.edit');
Route::put('/bidding/{id}', [BiddingPlatformController::class, 'update'])->name('bidding.update');

// BIDDING HISTORY
Route::get('/bidding-history', [BiddingHistoryController::class, 'index'])->name('bidding-history.index');

// BIDDING STATUS

    Route::get('/bidding-status', [BiddingStatusController::class, 'index'])->name('bidding-status.index');
    Route::get('/bidding-status/{id}', [BiddingStatusController::class, 'show'])->name('admin.bidding-status.show');
    Route::post('/bidding-status/{id}/update', [BiddingStatusController::class, 'update'])->name('admin.bidding-status.update');

//USER MANUAL
Route::get('/rules-manual', [RulesManualController::class, 'index'])->name('admin.rules.manual');

//PAYMENT RECORDS
Route::get('/payments/records', [PaymentRecordController::class, 'index'])->name('payments.index');
Route::get('/payments/records/{id}/receipt', [PaymentRecordController::class, 'showReceipt'])->name('payments.receipt');

//PROFIT REPORTS
Route::get('/profit-report', [ProfitReportController::class, 'index'])->name('profit.report');