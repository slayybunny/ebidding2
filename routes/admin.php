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
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ManageMembersController;
use App\Http\Controllers\admin\AdminController; // ✅ Tambah import AdminController
use App\Http\Controllers\admin\ReportingController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        // Halaman Login Admin
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

        // Halaman Register Admin
        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('bidding-status', [BiddingStatusController::class, 'index'])->name('bidding-status.index');
    // lain-lain route

        // Profile Admin
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // Manage Users (Users & Admins)
        Route::get('/manage-users', [ManageUsersController::class, 'index'])->name('manage_users');
        Route::get('/users/{user}', [ManageUsersController::class, 'showUser'])->name('users.show');
        Route::delete('/users/{user}', [ManageUsersController::class, 'destroyUser'])->name('users.delete');
        Route::get('/admins/{admin}', [ManageUsersController::class, 'showAdmin'])->name('admins.show');
        Route::delete('/admins/{admin}', [ManageUsersController::class, 'destroyAdmin'])->name('admins.delete');
        Route::get('/manage-members', [ManageMembersController::class, 'index'])->name('manage-members');

        // Bidding Platform
        Route::get('/bidding', [BiddingPlatformController::class, 'index'])->name('bidding.index');
        Route::get('/bidding/create', [BiddingPlatformController::class, 'create'])->name('bidding.create');
        Route::post('/bidding', [BiddingPlatformController::class, 'store'])->name('bidding.store');
        Route::get('/bidding/{id}', [BiddingPlatformController::class, 'show'])->name('bidding.show');
        Route::get('/bidding/{id}/edit', [BiddingPlatformController::class, 'edit'])->name('bidding.edit');
        Route::put('/bidding/{id}', [BiddingPlatformController::class, 'update'])->name('bidding.update');
        Route::delete('/bidding/{id}', [BiddingPlatformController::class, 'destroy'])->name('bidding.destroy');

        // Bidding History
        Route::get('/bidding-history', [BiddingHistoryController::class, 'index'])->name('bidding-history.index');
        Route::delete('login-log/{loginLog}', [BiddingHistoryController::class, 'destroy'])->name('login-log.destroy');

        // Bidding Status
        Route::get('/bidding-status', [BiddingStatusController::class, 'index'])->name('bidding-status.index');
        Route::get('/bidding-status/{id}', [BiddingStatusController::class, 'show'])->name('bidding-status.show');
        Route::post('/bidding-status/{id}/update', [BiddingStatusController::class, 'update'])->name('bidding-status.update');

        // Rules Manual
        Route::get('/rules_and_manual', [RulesManualController::class, 'index'])->name('rules_manual');

        // Payment Records
        Route::get('/payments/records', [PaymentRecordController::class, 'index'])->name('payments.index');
        Route::get('/payments/records/{id}/receipt', [PaymentRecordController::class, 'showReceipt'])->name('payments.receipt');

        // Profit Reports
        Route::get('/profit-report', [ProfitReportController::class, 'index'])->name('profit.report');

        Route::get('/reports/profit', [ReportingController::class, 'showProfitForm'])->name('reports.profit.form');
        Route::post('/reports/profit/calculate', [ReportingController::class, 'calculateProfit'])->name('reports.profit.calculate');
    });
});
