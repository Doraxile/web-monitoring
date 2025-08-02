Web Monitoring Stok

Aplikasi web sederhana berbasis Laravel untuk memantau stok barang, termasuk fitur login, CRUD produk, riwayat perubahan stok, dan pencarian.

Fitur yang Tersedia
-  Autentikasi Login (menggunakan Laravel Breeze)
-  Dashboard daftar produk
-  Detail produk
-  Form tambah & kurang stok
-  Riwayat perubahan stok
-  Pencarian produk
-  Notifikasi (opsional, jika menggunakan SweetAlert/Toastr)

Cara Menjalankan Aplikasi
1. Clone Repository
```bash
git clone https://github.com/Doraxile/web-monitoring.git
cd web-monitoring
```
2. Install Dependency
```bash
composer install
npm install && npm run dev
```
3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```
4. Jalankan Migration
```bash
php artisan migrate
```
5. Jalankan Server
```bash
php artisan serve
```
6. Login
Jika sudah membuat seeder user, gunakan akun berikut:
```bash
email: admin@tikitoko.com
password: admin123
```

Tools & Stack
- Laravel 12
- Laravel Breeze
- MySQL / SQLite
- Tailwind CSS
- Vite
