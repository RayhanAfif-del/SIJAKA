<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KategoriGaleriTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'name' => 'Admin Tester',
            'email' => 'admin_tester@smkn1bangsri.sch.id',
            'password' => Hash::make('password'),
        ]);
    }

    public function test_admin_can_view_kategori_galeri_index(): void
    {
        KategoriGaleri::create(['nama' => 'Dies Natalis', 'deskripsi' => 'Dokumentasi ulang tahun sekolah']);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.kategori-galeri.index'));

        $response->assertStatus(200);
        $response->assertSee('Dies Natalis');
        $response->assertSee('Kategori Galeri');
    }

    public function test_admin_can_create_new_kategori(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.kategori-galeri.store'), [
            'nama' => 'LKS SMK',
            'deskripsi' => 'Lomba Kompetensi Siswa',
        ]);

        $response->assertRedirect(route('admin.kategori-galeri.index'));
        $this->assertDatabaseHas('kategori_galeri', [
            'nama' => 'LKS SMK',
            'slug' => 'lks-smk',
            'deskripsi' => 'Lomba Kompetensi Siswa',
        ]);
    }

    public function test_admin_can_create_kategori_via_ajax(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->postJson(route('admin.kategori-galeri.store'), [
            'nama' => 'Pentas Seni',
            'deskripsi' => 'Pensi tahunan',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'data' => [
                'nama' => 'Pentas Seni',
            ],
        ]);
        $this->assertDatabaseHas('kategori_galeri', [
            'nama' => 'Pentas Seni',
        ]);
    }

    public function test_kategori_nama_must_be_unique(): void
    {
        // 'Workshop' sudah ada dari default seeder migrasi, coba buat lagi
        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.kategori-galeri.store'), [
            'nama' => 'Workshop',
        ]);

        $response->assertSessionHasErrors('nama');
    }

    public function test_created_kategori_appears_in_galeri_create_page(): void
    {
        KategoriGaleri::create(['nama' => 'Wisuda Angkatan 2026']);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.galeri.create'));

        $response->assertStatus(200);
        $response->assertSee('Wisuda Angkatan 2026');
        $response->assertSee('Tambah Kategori Baru');
    }

    public function test_admin_can_update_kategori_and_syncs_galeri_photos(): void
    {
        $kategori = KategoriGaleri::create(['nama' => 'Seminar Karir']);

        Galeri::create([
            'judul' => 'Seminar Karir Bersama Industri',
            'kategori' => 'Seminar Karir',
            'tanggal' => now(),
            'foto' => 'galeri/test.jpg',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.kategori-galeri.update', $kategori), [
            'nama' => 'Seminar Karier & Industri',
            'deskripsi' => 'Nama baru',
        ]);

        $response->assertRedirect(route('admin.kategori-galeri.index'));
        $this->assertDatabaseHas('kategori_galeri', [
            'id' => $kategori->id,
            'nama' => 'Seminar Karier & Industri',
        ]);
        $this->assertDatabaseHas('galeri', [
            'judul' => 'Seminar Karir Bersama Industri',
            'kategori' => 'Seminar Karier & Industri',
        ]);
    }

    public function test_cannot_delete_kategori_if_used_by_galeri(): void
    {
        $kategori = KategoriGaleri::create(['nama' => 'Job Fair 2026']);

        Galeri::create([
            'judul' => 'Pembukaan Job Fair',
            'kategori' => 'Job Fair 2026',
            'tanggal' => now(),
            'foto' => 'galeri/jobfair.jpg',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.kategori-galeri.destroy', $kategori));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('kategori_galeri', [
            'id' => $kategori->id,
            'nama' => 'Job Fair 2026',
        ]);
    }

    public function test_can_delete_unused_kategori(): void
    {
        $kategori = KategoriGaleri::create(['nama' => 'Kategori Sementara']);

        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.kategori-galeri.destroy', $kategori));

        $response->assertSessionHas('status');
        $this->assertDatabaseMissing('kategori_galeri', [
            'id' => $kategori->id,
        ]);
    }
}
