<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: [
        __DIR__.'/../routes/web.php',
        __DIR__.'/../routes/admin.php', // ✅ Tambah admin route di sini
    ],
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
