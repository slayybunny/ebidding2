<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Settings
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // Default guard is 'web' (members)
        'passwords' => env('AUTH_PASSWORD_BROKER', 'members'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    | You may define multiple guards (web, admin, etc).
    */
    'guards' => [
        // Guard untuk members (default)
        'web' => [
            'driver' => 'session',
            'provider' => 'members',
        ],

        // Guard untuk admin login
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    | Providers menentukan dari mana data user diambil (model & table).
    */
    'providers' => [
        // Provider untuk ahli biasa
        'members' => [
            'driver' => 'eloquent',
            'model' => App\Models\Member::class,
        ],

        // Provider untuk admin
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'members' => [
            'provider' => 'members',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    | Masa sebelum perlu sahkan password semula (dalam saat)
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
