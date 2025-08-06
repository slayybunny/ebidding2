<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register the routes for the application.
     */
    public function boot(): void
    {
        $this->routes(function () {

            // ✅ Default web user routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // ✅ API routes (jika digunakan)
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            // ✅ Admin routes - guna prefix /admin dan name prefix admin.
            Route::middleware('web') // gunakan middleware web
                ->prefix('admin')     // URL akan bermula dengan /admin
                ->name('admin.')     // Nama route akan bermula dengan admin.
                ->group(base_path('routes/admin.php')); // Fail route khusus admin
        });
    }
}
