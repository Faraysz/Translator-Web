# Translator-Web

Translator-Web adalah aplikasi web sederhana untuk menerjemahkan teks antara Bahasa Indonesia dan Bahasa Inggris, dibangun menggunakan Laravel (backend) dan Vite + TailwindCSS (frontend). Proyek ini memanfaatkan API eksternal (MyMemory) untuk proses penerjemahan.

## Fitur

- Form penerjemahan teks dua arah (Indonesia <-> Inggris)
- Penyimpanan riwayat terjemahan ke database
- Antarmuka sederhana dan responsif
- AJAX untuk pengalaman pengguna yang lebih baik

## Instalasi

1. **Clone repository**
	```bash
	git clone <repo-url>
	cd translator-web
	```
2. **Install dependency backend (Laravel)**
	```bash
	composer install
	cp .env.example .env
	php artisan key:generate
	# Konfigurasi database di file .env
	php artisan migrate
	```
3. **Install dependency frontend**
	```bash
	npm install
	npm run dev
	```
4. **Jalankan server**
	```bash
	php artisan serve
	```

## Penggunaan

1. Buka browser dan akses `http://localhost:8000`
2. Masukkan teks, pilih bahasa sumber dan target, lalu klik Translate
3. Hasil terjemahan akan muncul di bawah form

## Struktur Proyek

- `app/Http/Controllers/TranslateController.php` — Logika utama penerjemahan
- `app/Models/Translation.php` — Model Eloquent untuk riwayat terjemahan
- `resources/views/translate.blade.php` — Tampilan utama form translate
- `routes/web.php` — Routing aplikasi
- `database/migrations/2026_01_23_154456_create_translations_table.php` — Struktur tabel database

## Pengujian

Jalankan test dengan:
```bash
php artisan test
```

## Lisensi

MIT

