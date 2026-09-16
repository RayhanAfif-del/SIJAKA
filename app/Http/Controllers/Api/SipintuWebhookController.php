<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Alumni;
use App\Models\Mitra;
use App\Services\SipintuAlumniSyncService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SipintuWebhookController extends Controller
{
    /**
     * Endpoint pemantauan health check downstream untuk SiPintu.
     */
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'healthy' => true,
            'success' => true,
            'app' => config('app.name', 'SIJAKA'),
            'service' => 'sijaka-downstream',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Webhook sinkronisasi profil user real-time dari SiPintu.
     */
    public function syncUser(Request $request, SipintuAlumniSyncService $syncService): JsonResponse
    {
        // Mendukung probe / ping uji diagnostik dari SiPintu
        if ($request->isMethod('get')
            || empty($request->all())
            || $request->boolean('test')
            || $request->input('action') === 'ping'
            || $request->input('event') === 'ping'
            || $request->input('type') === 'ping'
            || $request->input('action') === 'test') {
            return response()->json([
                'status' => 'ok',
                'success' => true,
                'message' => 'SiPintu sync-user webhook endpoint is active and ready.',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        try {
            $payload = $request->input('data') ?? $request->input('user') ?? $request->all();

            $nis = (string) (data_get($payload, 'nis')
                ?? (is_numeric(data_get($payload, 'name')) ? data_get($payload, 'name') : ''));
            $email = (string) (data_get($payload, 'email') ?? data_get($payload, 'user.email'));
            $nama = (string) (data_get($payload, 'nama') ?? data_get($payload, 'name') ?? data_get($payload, 'user.name'));
            $rawPassword = (string) (data_get($payload, 'password')
                ?? data_get($payload, 'password_hash')
                ?? data_get($payload, 'user.password'));

            $alumni = null;
            if ($nis !== '') {
                $alumni = Alumni::where('nis', $nis)->first();
            }
            if (! $alumni && $email !== '') {
                $alumni = Alumni::where('email', $email)->first();
            }

            if ($alumni) {
                $updates = [];

                if ($nama !== '' && ! is_numeric($nama)) {
                    $updates['nama'] = $nama;
                }

                if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $alumni->email !== $email) {
                    $updates['email'] = $email;
                }

                if ($rawPassword !== '') {
                    $updates['password'] = $rawPassword;
                }

                $jurusan = $syncService->determineJurusan($payload);
                if ($jurusan !== 'Belum ditentukan' && $alumni->jurusan === 'Belum ditentukan') {
                    $updates['jurusan'] = $jurusan;
                }

                if (! empty($updates)) {
                    $alumni->update($updates);
                }

                Log::info('SiPintu Webhook: Alumni profil diperbarui', [
                    'nis' => $alumni->nis,
                    'email' => $alumni->email,
                ]);

                return response()->json([
                    'status' => 'ok',
                    'action' => 'updated',
                    'message' => 'Alumni updated successfully.',
                    'nis' => $alumni->nis,
                ]);
            }

            // Jika user baru dan merupakan alumni (graduated = true atau role alumni)
            $graduated = data_get($payload, 'graduated', data_get($payload, 'user.graduated'));
            $isGrad = filter_var($graduated, FILTER_VALIDATE_BOOLEAN) === true
                || $graduated === 1
                || $graduated === '1'
                || $graduated === true
                || strtolower((string) data_get($payload, 'role')) === 'alumni';

            if ($isGrad && ($nis !== '' || $email !== '')) {
                $newAlumni = Alumni::create([
                    'nis' => $nis !== '' ? $nis : Str::before($email, '@'),
                    'nama' => $nama !== '' ? $nama : 'Alumni SiPintu',
                    'email' => $email !== '' ? $email : null,
                    'password' => $rawPassword !== '' ? $rawPassword : 'password',
                    'jurusan' => $syncService->determineJurusan($payload),
                    'tahun_lulus' => $syncService->determineTahunLulus($payload),
                    'status' => 'Belum Bekerja',
                ]);

                Log::info('SiPintu Webhook: Alumni baru dibuat dari webhook', [
                    'nis' => $newAlumni->nis,
                    'nama' => $newAlumni->nama,
                ]);

                return response()->json([
                    'status' => 'ok',
                    'action' => 'created',
                    'message' => 'New alumni registered from SiPintu webhook.',
                    'nis' => $newAlumni->nis,
                ]);
            }

            // Sinkronisasi jika akun terdaftar sebagai admin/mitra
            if ($email !== '') {
                if ($admin = Admin::where('email', $email)->first()) {
                    if ($nama !== '') $admin->nama = $nama;
                    if ($rawPassword !== '') $admin->password = $rawPassword;
                    $admin->save();

                    return response()->json(['status' => 'ok', 'action' => 'admin_updated']);
                }

                if ($mitra = Mitra::where('email', $email)->first()) {
                    if ($rawPassword !== '') $mitra->password = $rawPassword;
                    $mitra->save();

                    return response()->json(['status' => 'ok', 'action' => 'mitra_updated']);
                }
            }

            return response()->json([
                'status' => 'ok',
                'action' => 'ignored',
                'message' => 'Data diterima. Tidak ada perubahan entitas yang diperlukan.',
            ]);
        } catch (\Throwable $e) {
            Log::warning('SiPintu Webhook syncUser error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses sinkronisasi user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Webhook sinkronisasi password real-time dari SiPintu.
     */
    public function syncPassword(Request $request): JsonResponse
    {
        // Mendukung probe / ping uji diagnostik dari SiPintu
        if ($request->isMethod('get')
            || empty($request->all())
            || $request->boolean('test')
            || $request->input('action') === 'ping'
            || $request->input('event') === 'ping'
            || $request->input('type') === 'ping'
            || $request->input('action') === 'test') {
            return response()->json([
                'status' => 'ok',
                'success' => true,
                'message' => 'SiPintu sync-password webhook endpoint is active and ready.',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        try {
            $payload = $request->input('data') ?? $request->input('user') ?? $request->all();

            $nis = (string) (data_get($payload, 'nis')
                ?? (is_numeric(data_get($payload, 'name')) ? data_get($payload, 'name') : ''));
            $email = (string) (data_get($payload, 'email') ?? data_get($payload, 'user.email'));
            $rawPassword = (string) (data_get($payload, 'password')
                ?? data_get($payload, 'password_hash')
                ?? data_get($payload, 'user.password'));

            if ($rawPassword === '') {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Password tidak disediakan dalam payload.',
                ]);
            }

            $updated = false;

            if ($nis !== '') {
                if ($alumni = Alumni::where('nis', $nis)->first()) {
                    $alumni->update(['password' => $rawPassword]);
                    $updated = true;
                }
            }

            if (! $updated && $email !== '') {
                if ($alumni = Alumni::where('email', $email)->first()) {
                    $alumni->update(['password' => $rawPassword]);
                    $updated = true;
                } elseif ($admin = Admin::where('email', $email)->first()) {
                    $admin->update(['password' => $rawPassword]);
                    $updated = true;
                } elseif ($mitra = Mitra::where('email', $email)->first()) {
                    $mitra->update(['password' => $rawPassword]);
                    $updated = true;
                }
            }

            return response()->json([
                'status' => 'ok',
                'updated' => $updated,
                'message' => $updated ? 'Password berhasil diperbarui.' : 'User tidak ditemukan di downstream.',
            ]);
        } catch (\Throwable $e) {
            Log::warning('SiPintu Webhook syncPassword error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui password: ' . $e->getMessage(),
            ], 500);
        }
    }
}
