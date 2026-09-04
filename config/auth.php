<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'admins',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'mitra' => [
            'driver' => 'session',
            'provider' => 'mitra',
        ],

        'alumni' => [
            'driver' => 'session',
            'provider' => 'alumni',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'mitra' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mitra::class,
        ],

        'alumni' => [
            'driver' => 'eloquent',
            'model' => App\Models\Alumni::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'mitra' => [
            'provider' => 'mitra',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

    'admin_login_path' => env('ADMIN_LOGIN_PATH', 'panel-sijaka'),

];
