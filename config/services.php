<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'sipintu' => [
        'base_url' => env('SIPINTU_BASE_URL', 'http://localhost:8000'),
        'client_id' => env('SIPINTU_CLIENT_ID'),
        'client_secret' => env('SIPINTU_CLIENT_SECRET'),
        'default_graduation_year' => env('SIPINTU_DEFAULT_GRADUATION_YEAR', date('Y')),
        'redirect_uri' => env('SIPINTU_REDIRECT_URI', env('APP_URL', 'http://localhost').'/oauth/callback'),
        'authorize_path' => env('SIPINTU_AUTHORIZE_PATH', '/oauth/authorize'),
        'token_path' => env('SIPINTU_TOKEN_PATH', '/oauth/token'),
        'user_path' => env('SIPINTU_USER_PATH', '/api/v1/user'),
        'students_path' => env('SIPINTU_STUDENTS_PATH', '/api/v1/sijuna/students'),
        'teachers_path' => env('SIPINTU_TEACHERS_PATH', '/api/v1/sijuna/teachers'),
    ],

];
