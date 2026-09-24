<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Alumni;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SipintuIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        config([
            'services.sipintu.base_url' => 'http://localhost:8000',
            'services.sipintu.client_id' => 'app_test_client',
            'services.sipintu.client_secret' => 'sec_test_secret_key',
            'services.sipintu.redirect_uri' => 'http://localhost:8001/oauth/callback',
        ]);
    }

    public function test_health_check_endpoints_return_healthy(): void
    {
        $response = $this->getJson('/health');
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'ok',
                'healthy' => true,
                'success' => true,
            ]);

        $apiResponse = $this->getJson('/api/health');
        $apiResponse->assertStatus(200)
            ->assertJson([
                'status' => 'ok',
                'healthy' => true,
                'success' => true,
            ]);
    }

    public function test_oauth_callback_probe_without_code_returns_200_without_redirect_loop(): void
    {
        // JSON probe
        $jsonProbe = $this->getJson('/oauth/callback');
        $jsonProbe->assertStatus(200)
            ->assertJson([
                'status' => 'ok',
                'healthy' => true,
            ]);

        // Browser probe (HTTP 200 HTML with client-side redirect)
        $htmlProbe = $this->get('/oauth/callback');
        $htmlProbe->assertStatus(200)
            ->assertSee('Endpoint Callback SSO Aktif');
    }

    public function test_oauth_callback_auto_provisions_new_alumni_and_syncs_password(): void
    {
        $testNis = 'TEST_NIS_' . rand(10000, 99999);
        $testEmail = "student_{$testNis}@sijuna.sch.id";
        $passwordHash = Hash::make('password_dari_sipintu');

        Http::fake([
            'http://localhost:8000/oauth/token' => Http::response([
                'access_token' => 'mock_access_token_123',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200),
            'http://localhost:8000/api/v1/user' => Http::response([
                'status' => 'success',
                'data' => [
                    'id' => 999,
                    'external_id' => $testNis,
                    'name' => 'Budi Santoso',
                    'email' => $testEmail,
                    'role' => 'alumni',
                    'classroom' => 'XII PPLG 1',
                    'kode_jurusan' => 'PPLG',
                    'nama_jurusan' => 'Pengembangan Perangkat Lunak dan Gim',
                    'phone' => '081234567890',
                    'password' => $passwordHash,
                    'password_hash' => $passwordHash,
                ],
            ], 200),
        ]);

        $response = $this->get("/oauth/callback?code=mock_valid_auth_code");

        $response->assertRedirect('/dashboard');

        $alumni = Alumni::where('nis', $testNis)->first();
        $this->assertNotNull($alumni);
        $this->assertEquals('Budi Santoso', $alumni->nama);
        $this->assertEquals($testEmail, $alumni->email);
        $this->assertEquals('081234567890', $alumni->phone);
        $this->assertEquals('XII PPLG 1', $alumni->classroom);
        $this->assertEquals('Pengembangan Perangkat Lunak dan Gim', $alumni->jurusan);
        $this->assertEquals($passwordHash, $alumni->password);
        $this->assertNotNull($alumni->sipintu_last_synced_at);

        $this->assertAuthenticatedAs($alumni, 'alumni');
    }

    public function test_oauth_callback_redirects_non_graduated_student_to_public_home(): void
    {
        $testNis = 'NON_GRAD_' . rand(10000, 99999);
        $testEmail = "student_{$testNis}@sijuna.sch.id";

        Http::fake([
            'http://localhost:8000/oauth/token' => Http::response([
                'access_token' => 'mock_access_token_non_grad',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200),
            'http://localhost:8000/api/v1/user' => Http::response([
                'status' => 'success',
                'data' => [
                    'id' => 888,
                    'external_id' => $testNis,
                    'name' => 'Siswa Belum Lulus',
                    'email' => $testEmail,
                    'role' => 'student',
                    'graduated' => false,
                    'classroom' => 'XI PPLG 2',
                    'kode_jurusan' => 'PPLG',
                    'nama_jurusan' => 'Pengembangan Perangkat Lunak dan Gim',
                ],
            ], 200),
        ]);

        $response = $this->get("/oauth/callback?code=mock_non_grad_code");

        $response->assertRedirect('/');
        $response->assertSessionHas('info');

        $this->assertNull(Alumni::where('nis', $testNis)->first());
        $this->assertGuest('alumni');
    }

    public function test_oauth_callback_syncs_password_for_existing_alumni(): void
    {
        $testNis = 'EXISTING_NIS_' . rand(10000, 99999);
        $testEmail = "existing_{$testNis}@sijuna.sch.id";
        $oldPasswordHash = Hash::make('old_password');
        $newPasswordHash = Hash::make('new_sipintu_password');

        $alumni = Alumni::create([
            'nama' => 'Nama Lama Alumni',
            'nis' => $testNis,
            'email' => $testEmail,
            'password' => $oldPasswordHash,
            'jurusan' => 'Teknik Otomotif',
            'tahun_lulus' => '2025',
            'status' => 'Belum Bekerja',
        ]);

        Http::fake([
            'http://localhost:8000/oauth/token' => Http::response([
                'access_token' => 'mock_token',
            ], 200),
            'http://localhost:8000/api/v1/user' => Http::response([
                'data' => [
                    'external_id' => $testNis,
                    'name' => 'Nama Baru Dari SiPintu',
                    'email' => $testEmail,
                    'password' => $newPasswordHash,
                ],
            ], 200),
        ]);

        $response = $this->get('/oauth/callback?code=valid_code');
        $response->assertRedirect('/dashboard');

        $alumni->refresh();
        $this->assertEquals($newPasswordHash, $alumni->password);
        $this->assertEquals('Nama Baru Dari SiPintu', $alumni->nama);
        $this->assertNotNull($alumni->sipintu_last_synced_at);
        $this->assertAuthenticatedAs($alumni, 'alumni');
    }

    public function test_webhook_sync_user_creates_alumni(): void
    {
        $nis = 'WEBHOOK_NEW_' . rand(10000, 99999);
        $email = "webhook_{$nis}@example.com";
        $passwordHash = Hash::make('secret_webhook_pass');

        $payload = [
            'external_id' => $nis,
            'name' => 'Siswa Baru Webhook',
            'email' => $email,
            'password' => $passwordHash,
            'phone' => '0899999999',
            'classroom' => 'XII AKL 2',
            'jurusan' => 'Akuntansi dan Keuangan Lembaga',
        ];

        $response = $this->postJson('/api/sipintu/sync-user', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'action' => 'created',
                'nis' => $nis,
            ]);

        $alumni = Alumni::where('nis', $nis)->first();
        $this->assertNotNull($alumni);
        $this->assertEquals('Siswa Baru Webhook', $alumni->nama);
        $this->assertEquals($email, $alumni->email);
        $this->assertNotNull($alumni->sipintu_last_synced_at);
    }

    public function test_webhook_sync_user_smart_conflict_resolution_preserves_local_edits(): void
    {
        $nis = 'CONFLICT_' . rand(10000, 99999);
        $email = "conflict_{$nis}@example.com";
        $syncTime = now()->subMinutes(30);

        // Buat alumni dengan timestamp sync 30 menit lalu
        $alumni = Alumni::create([
            'nama' => 'Nama Asli SiPintu',
            'nis' => $nis,
            'email' => $email,
            'phone' => '0811111111',
            'classroom' => 'XII PPLG 1',
            'jurusan' => 'Pengembangan Perangkat Lunak dan Gim',
            'tahun_lulus' => '2026',
            'status' => 'Belum Bekerja',
            'password' => Hash::make('pass_lama'),
            'sipintu_last_synced_at' => $syncTime,
        ]);

        // Simulasikan pengguna mengubah nama dan no hp secara lokal di SIJAKA
        $alumni->nama = 'Nama Panggilan Lokal Keren';
        $alumni->phone = '0822222222';
        $alumni->updated_at = now()->subMinutes(5); // updated_at lebih baru dari sipintu_last_synced_at
        $alumni->save();

        $newPasswordHash = Hash::make('new_sipintu_pwd');

        $payload = [
            'external_id' => $nis,
            'name' => 'Nama Yang Mau Menimpa Dari SiPintu',
            'email' => "updated_{$nis}@example.com",
            'phone' => '0833333333',
            'status' => 'Bekerja',
            'password' => $newPasswordHash,
        ];

        $response = $this->postJson('/api/sipintu/sync-user', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'action' => 'updated',
                'conflict' => 'preserved_local_changes',
            ]);

        $alumni->refresh();

        // 1. Data editan lokal (nama & phone) WAJIB TETAP TERJAGA (tidak ditimpa SiPintu)
        $this->assertEquals('Nama Panggilan Lokal Keren', $alumni->nama);
        $this->assertEquals('0822222222', $alumni->phone);

        // 2. Data source of truth (email, status, password) WAJIB MENGIKUTI SiPintu
        $this->assertEquals("updated_{$nis}@example.com", $alumni->email);
        $this->assertEquals('Bekerja', $alumni->status);
        $this->assertEquals($newPasswordHash, $alumni->password);
    }

    public function test_webhook_sync_user_verifies_hmac_signature_when_provided(): void
    {
        $secret = 'sec_test_secret_key';
        $payload = json_encode([
            'email' => 'test_hmac@example.com',
            'name' => 'HMAC Test User',
            'password' => 'some_pass',
        ]);

        // 1. Signature salah -> 401
        $invalidResponse = $this->call(
            'POST',
            '/api/sipintu/sync-user',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X_SIPINTU_SIGNATURE' => 'invalid_signature_hash',
            ],
            $payload
        );
        $invalidResponse->assertStatus(401)
            ->assertJson(['status' => 'error', 'message' => 'Invalid signature.']);

        // 2. Signature valid -> 200
        $validSignature = hash_hmac('sha256', $payload, $secret);
        $validResponse = $this->call(
            'POST',
            '/api/sipintu/sync-user',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X_SIPINTU_SIGNATURE' => $validSignature,
            ],
            $payload
        );
        $validResponse->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    public function test_webhook_sync_password(): void
    {
        $nis = 'PW_' . rand(10000, 99999);
        $newPassword = Hash::make('password_baru_banget');

        $alumni = Alumni::create([
            'nama' => 'Test User Sync Password',
            'nis' => $nis,
            'email' => "user_{$nis}@example.com",
            'password' => Hash::make('password_lama'),
            'jurusan' => 'PPLG',
            'tahun_lulus' => '2026',
            'status' => 'Belum Bekerja',
        ]);

        $response = $this->postJson('/api/sipintu/sync-password', [
            'external_id' => $nis,
            'password' => $newPassword,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'updated' => true,
            ]);

        $alumni->refresh();
        $this->assertEquals($newPassword, $alumni->password);
    }

    public function test_jalur_2_manual_login_works_with_nis_and_synced_password(): void
    {
        $nis = 'MANUAL_' . rand(10000, 99999);
        $plainPassword = 'KatasandiRahasia123!';

        $alumni = Alumni::create([
            'nama' => 'Siswa Jalur Manual',
            'nis' => $nis,
            'email' => "manual_{$nis}@example.com",
            'password' => Hash::make($plainPassword),
            'jurusan' => 'PPLG',
            'tahun_lulus' => '2026',
            'status' => 'Belum Bekerja',
        ]);

        // Login mandiri via form login downstream (/login) menggunakan NIS dan password
        $response = $this->post('/login', [
            'role' => 'alumni',
            'email' => $nis,
            'password' => $plainPassword,
        ]);

        $response->assertRedirect(route('alumni.dashboard'));
        $this->assertAuthenticatedAs($alumni, 'alumni');
    }

    public function test_dashboard_route_redirects_alumni_to_alumni_dashboard(): void
    {
        $alumni = Alumni::create([
            'nama' => 'Dashboard Test',
            'nis' => 'DASH_' . rand(10000, 99999),
            'email' => 'dash@example.com',
            'password' => Hash::make('pwd'),
            'jurusan' => 'PPLG',
            'tahun_lulus' => '2026',
            'status' => 'Belum Bekerja',
        ]);

        $response = $this->actingAs($alumni, 'alumni')->get('/dashboard');
        $response->assertRedirect(route('alumni.dashboard'));
    }

    public function test_unauthenticated_user_accessing_alumni_dashboard_redirects_to_home_with_info(): void
    {
        $response = $this->get('/alumni/dashboard');
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('info');
    }

    public function test_admin_accessing_alumni_dashboard_redirects_to_admin_dashboard_without_loop(): void
    {
        $admin = Admin::first() ?? Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin_test@smkn1bangsri.sch.id',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($admin, 'admin')->get('/alumni/dashboard');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_accessing_panel_sijaka_redirects_to_admin_dashboard_without_loop(): void
    {
        $admin = Admin::first() ?? Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin_test2@smkn1bangsri.sch.id',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($admin, 'admin')->get('/panel-sijaka');
        $response->assertRedirect(route('admin.dashboard'));
    }
}
