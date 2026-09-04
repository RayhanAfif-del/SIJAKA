<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SipintuGatewayService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SijunaController extends Controller
{
    public function __construct(private readonly SipintuGatewayService $gateway) {}

    public function students(Request $request): JsonResponse
    {
        return $this->forward($this->gateway->students($request->only(['nis', 'search'])));
    }

    public function teachers(Request $request): JsonResponse
    {
        return $this->forward($this->gateway->teachers($request->only(['nip', 'search'])));
    }

    private function forward(Response $response): JsonResponse
    {
        return response()->json($response->json(), $response->status());
    }
}