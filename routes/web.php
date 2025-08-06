<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Listing;
use App\Http\Controllers\{
    HomeController, LoginController, RegisterController,
    ProfileController, OtpController, ForgotPasswordController,
    ChangePasswordController, BiddingController,
    TenderController, RoleSwitchController, ListingController
};

// LANDING PAGE
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : view('main');
})->name('landing');

// GUEST ONLY
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot.form');
    Route::post('/forgot-password/send', [ForgotPasswordController::class, 'sendOtp'])->name('forgot.send');
    Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('forgot.verify.form');
    Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot.verify');
});

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// PUBLIC PAGES
Route::view('/about', 'about')->name('about');
Route::view('/rules', 'rules')->name('rules');

// HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');

// AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {
    // PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload.photo');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete.photo');

    // PASSWORD
    Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('change-password.edit');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

    // TENDERS & BIDDING
    Route::prefix('tender')->group(function () {
        // CRUD for listings
        Route::get('/create-listing', [ListingController::class, 'create'])->name('create-listing');
        Route::post('/store', [ListingController::class, 'store'])->name('store-listing');
        Route::get('/my-gold-items', [ListingController::class, 'myGoldItems'])->name('my-gold-items');
        Route::get('/edit-listing/{slug}', [ListingController::class, 'edit'])->name('edit-listing');
        Route::put('/update-listing/{slug}', [ListingController::class, 'update'])->name('update-listing');
        Route::delete('/delete-listing/{slug}', [ListingController::class, 'destroy'])->name('delete-listing');

        // BIDDING PAGES
        Route::get('/bidding/{slug}', [BiddingController::class, 'showBySlug'])->name('bidding.detail');  // for individual bidding detail
        Route::post('/bidding/place/{slug}', [BiddingController::class, 'placeBid'])->name('bidding.place');

       // routes/web.php
       Route::get('/listing/{slug}/overview', [ListingController::class, 'overview'])->name('listing-overview');


    });

    // LIVE BIDDING
    Route::get('/live-bidding', [BiddingController::class, 'index'])->name('bidding.live');

    // BIDDING HISTORY
    Route::get('/history', [BiddingController::class, 'history'])->name('bidding.history');
    Route::get('/status', [BiddingController::class, 'showBiddingStatus'])->name('bidding.status');
});

Route::delete('/bids/{bidId}/cancel', [BiddingController::class, 'cancel'])->name('bid.cancel');

Route::post('/switch-role', [RoleSwitchController::class, 'switchRole'])->name('switch.role');


// Generate slug for listings without one
Route::get('/generate-slug', function () {
    $listings = Listing::whereNull('slug')->get();

    foreach ($listings as $listing) {
        $listing->slug = Str::slug($listing->item . '-' . uniqid());
        $listing->save();
    }

    return 'All slugs have been generated!';
});
