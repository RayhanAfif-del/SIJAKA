<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SipintuGatewayService
{
    private function client(): PendingRequest
    {
        return Http::baseUrl(rtrim((string) config('services.sipintu.base_url'), '/'))
            ->acceptJson()
            ->connectTimeout(10)
            ->timeout(60)
            ->retry(2, 500);
    }

    public function students(array $filters = []): Response
    {
        return $this->gatewayClient()->timeout(180)->get(config('services.sipintu.students_path'), $filters);
    }

    public function teachers(array $filters = []): Response
    {
        return $this->gatewayClient()->timeout(180)->get(config('services.sipintu.teachers_path'), $filters);
    }

    public function authorizationUrl(string $state): string
    {
        return rtrim((string) config('services.sipintu.base_url'), '/')
            .config('services.sipintu.authorize_path').'?' . http_build_query([
                'client_id' => config('services.sipintu.client_id'),
                'redirect_uri' => config('services.sipintu.redirect_uri'),
                'response_type' => 'code',
                'state' => $state,
            ]);
    }

    public function exchangeCode(string $code): Response
    {
        return $this->client()->asForm()->post(config('services.sipintu.token_path'), [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.sipintu.client_id'),
            'client_secret' => config('services.sipintu.client_secret'),
            'code' => $code,
            'redirect_uri' => config('services.sipintu.redirect_uri'),
        ]);
    }

    public function user(string $accessToken): Response
    {
        return $this->client()->withToken($accessToken)
            ->get(config('services.sipintu.user_path'));
    }

    private function gatewayClient(): PendingRequest
    {
        return $this->client()->withHeaders([
            'X-Client-ID' => config('services.sipintu.client_id'),
            'X-Client-Secret' => config('services.sipintu.client_secret'),
        ]);
    }
}