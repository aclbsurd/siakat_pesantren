<?php

return [

    'defaults' => [
        'guard' => 'web', // default tetap admin
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'santri' => [
            'driver' => 'session',
            'provider' => 'santris',
        ],
        'pengajar' => [
            'driver' => 'session',
            'provider' => 'pengajars',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'santris' => [
            'driver' => 'eloquent',
            'model' => App\Models\Santri::class,
        ],
        'pengajars' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pengajar::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords (optional, hanya user admin saja)
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
