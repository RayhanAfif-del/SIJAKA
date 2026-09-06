<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sipintu:check', function (\App\Services\SipintuGatewayService $gateway) {
    $this->info('Memeriksa koneksi SiPintu Gateway...');
    $this->line('Client ID: ' . config('services.sipintu.client_id'));
    $this->line('Base URL : ' . config('services.sipintu.base_url'));
    
    try {
        $response = $gateway->validateClient();
        if ($response->successful()) {
            $this->info('Validasi Kredensial Berhasil!');
            $this->line($response->body());
        } else {
            $this->error('Validasi Kredensial Gagal (HTTP ' . $response->status() . ')');
            $this->line($response->body());
        }
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        $this->warn('Tidak dapat terhubung ke server SiPintu Gateway di ' . config('services.sipintu.base_url'));
        $this->error('Detail Error: ' . $e->getMessage());
    }
})->purpose('Validasi kredensial dan koneksi aplikasi ke SiPintu API Gateway');

\Illuminate\Support\Facades\Schedule::command('sipintu:sync-alumni')->hourly();

