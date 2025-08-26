<?php

return [
    'url' => env('TOYYIBPAY_URL'),
    'key' => env('TOYYIBPAY_KEY'),             // Secret key untuk semua payment
    'category' => env('TOYYIBPAY_CATEGORY'),   // Untuk bid biasa
    'fixed_category' => env('TOYYIBPAY_FIXED_CATEGORY'), // Untuk RM10 fixed
];
