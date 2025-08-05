<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapAdminRoutes(); // Tambah ini
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/admin.php'));
    }
    public function boot(): void
{
    parent::boot();

    Route::middleware('web')
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
}

}
