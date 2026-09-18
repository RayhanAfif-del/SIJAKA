<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SipintuWebhookController;
use App\Http\Controllers\Auth\SipintuController;
use Illuminate\Http\Request;

class OAuthController extends SipintuWebhookController
{
    // Alias to SipintuWebhookController and SipintuController for compatibility with SiPintu documentation
    public function callback(Request $request)
    {
        return app(SipintuController::class)->callback($request);
    }

    public function redirect(Request $request)
    {
        return app(SipintuController::class)->redirect($request);
    }
}
