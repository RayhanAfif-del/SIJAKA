<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\SipintuController;
use Illuminate\Http\Request;

class OAuthController extends SipintuWebhookController
{
    // Alias to SipintuWebhookController and SipintuController for compatibility with SiPintu webhook documentation
    public function callback(Request $request)
    {
        return app(SipintuController::class)->callback($request);
    }

    public function redirect(Request $request)
    {
        return app(SipintuController::class)->redirect($request);
    }
}
