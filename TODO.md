# TODO - Status Alumni "Melanjutkan Studi"

## Database
- [x] Migration: tambah nilai enum `Melanjutkan Studi` pada kolom `status` tabel `alumni`
- [x] Seeder/Factory: tambah status `Melanjutkan Studi`

## Model
- [x] Tambah scope `melanjutkanStudi()` di `Alumni.php`

## Controller
- [x] `StatistikController`: tambah data `melanjutkanStudi`
- [x] `BerandaController`: tambah data `alumniMelanjutkanStudi`
- [x] `DashboardController`: tambah data `alumniMelanjutkanStudi`

## Validation
- [x] `AlumniRequest`: izinkan nilai `Melanjutkan Studi`

## View Publik (website)
- [x] `beranda/index.blade.php`: ganti kartu "Belum Bekerja" → "Melanjutkan Studi"
- [x] `statistik/index.blade.php`: ganti "Belum Bekerja" → "Melanjutkan Studi"

## View Dashboard (tetap tampil "Belum Bekerja")
- [x] `dashboard/index.blade.php`: tambahkan "Melanjutkan Studi" pada statistik

## Admin Alumni
- [x] `_form.blade.php`: tambah opsi "Melanjutkan Studi"
- [x] `index.blade.php`: perbarui warna badge status baru

## Verifikasi
- [x] Migration dijalankan
- [x] Blade templates terkompilasi
- [x] Data test dibuat (1456 Bekerja, 200 Melanjutkan Studi, 344 Belum Bekerja)
