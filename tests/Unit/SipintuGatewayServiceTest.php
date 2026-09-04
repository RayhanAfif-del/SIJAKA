<?php

namespace Tests\Unit;

use App\Services\SipintuGatewayService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SipintuGatewayServiceTest extends TestCase
{
    public function test_sijuna_requests_use_client_headers_and_filters(): void
    {
        config()->set([
            'services.sipintu.base_url' => 'http://sipintu.test',
            'services.sipintu.client_id' => 'app_test',
            'services.sipintu.client_secret' => 'secret_test',
        ]);

        Http::fake(['http://sipintu.test/*' => Http::response(['data' => []])]);

        app(SipintuGatewayService::class)->students(['nis' => '123', 'search' => 'Ani']);

        Http::assertSent(function ($request): bool {
            return $request->url() === 'http://sipintu.test/api/v1/sijuna/students?nis=123&search=Ani'
                && $request->header('X-Client-ID')[0] === 'app_test'
                && $request->header('X-Client-Secret')[0] === 'secret_test'
                && $request->header('Accept')[0] === 'application/json';
        });
    }

    public function test_oauth_code_is_exchanged_as_a_form_request(): void
    {
        config()->set([
            'services.sipintu.base_url' => 'http://sipintu.test',
            'services.sipintu.client_id' => 'app_test',
            'services.sipintu.client_secret' => 'secret_test',
            'services.sipintu.redirect_uri' => 'http://sijaka.test/oauth/callback',
        ]);

        Http::fake(['http://sipintu.test/*' => Http::response(['access_token' => 'token'])]);

        app(SipintuGatewayService::class)->exchangeCode('temporary-code');

        Http::assertSent(function ($request): bool {
            return $request->url() === 'http://sipintu.test/oauth/token'
                && $request->method() === 'POST'
                && $request->data()['grant_type'] === 'authorization_code'
                && $request->data()['client_secret'] === 'secret_test'
                && $request->data()['code'] === 'temporary-code';
        });
    }
}