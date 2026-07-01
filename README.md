## Referensi Desain

1. CarServ - Free Bootstrap 5 Auto Repair Website Template  
   https://themewagon.com/themes/free-html5-bootstrap-5-business-website-template-carserv/  
   Digunakan sebagai referensi struktur company profile otomotif seperti navbar, hero, service section, booking form, dan contact section.

2. AutoWash - Free Car Wash Website Template  
   https://htmlcodex.com/car-wash-website-template/  
   Digunakan sebagai referensi layout pricing, service package, booking, dan tampilan layanan detailing.

3. Dribbble - Car Detailing Landing Page Inspiration  
   https://dribbble.com/search/car-detailing-landing-page  
   Digunakan sebagai referensi gaya visual modern, card layanan, CTA, dan tampilan landing page otomotif.

Desain akhir dimodifikasi pada bagian warna, konten, layout section, gambar, dan fitur interaktif agar sesuai dengan konsep Velora MotoCare sebagai layanan perawatan dan detailing motor harian.

## Hasil Screenshot Desktop FullPage

![](./assets/screenshotDesktop.png)

---

## Hasil Screenshot Mobile FullPage

![](./assets/screenshotMobile.jpg)

# Velora MotoCare — Website Company Profile

Velora MotoCare adalah situs landing/company profile untuk layanan perawatan dan detailing motor harian. Situs ini dibangun dengan teknologi web statis/templat yang diperkaya sedikit logika server-side untuk kebutuhan admin dan manajemen layanan.

**Teknologi utama**

- HTML5, CSS3
- Bootstrap 5 (layout & komponen)
- JavaScript + jQuery (interaksi & form)
- PHP (native) + PDO untuk koneksi database (admin area)
- MySQL (XAMPP lokal)

**Fitur utama**

- Halaman publik landing dengan hero, layanan, paket, estimator harga, checklist interaktif, galeri, dan testimonial.
- Form Booking pada halaman publik (saat ini berfungsi sebagai simulasi di sisi klien).
- Admin panel (native PHP) untuk mengelola layanan (`admin/services.php`) dan area dashboard dasar.
- Skrip SQL untuk membuat database dan tabel contoh: `sql/create_velora_db.sql`.

Catatan penting tentang alur booking

- Booking pada versi ini diset sebagai simulasi klien (ditampilkan hanya di halaman) — server endpoint `booking_submit.php` telah dihapus atas permintaan pengembang sehingga data booking tidak otomatis disimpan ke database.
- Jika Anda ingin menyimpan booking ke database lagi, saya dapat bantu mengembalikan/menambahkan endpoint yang aman dan menambahkan kembali tabel `bookings`.

Instalasi & menjalankan secara lokal

1. Pastikan XAMPP (Apache + MySQL) terinstal dan berjalan.
2. Salin folder proyek ke `C:\xampp\htdocs\UTSWeb_IF4A_0055` (atau sesuaikan DocumentRoot Anda).
3. Buat database dan tabel (opsional): jalankan `sql/create_velora_db.sql` melalui phpMyAdmin atau MySQL CLI.
4. Buka `http://localhost/UTSWeb_IF4A_0055/` di browser.

Admin (akses lokal)

- Halaman login: `login.php` (terhubung ke tabel `admins` pada `velora_db`).
- Jika Anda menggunakan skrip SQL bawaan, ada akun admin dummy untuk pengujian (lihat `sql/create_velora_db.sql`).

**Kredensial Admin (testing lokal)**

- Username: `admin`
- Password: `admin123` (hash disimpan di `sql/create_velora_db.sql` untuk pengujian lokal)

> Peringatan: kredensial ini hanya untuk pengujian di lingkungan lokal. Jangan gunakan akun ini pada server publik.

Lokasi penting dalam repo

- `index.php` — halaman publik utama (dynamic services rendering)
- `script.js` — skrip utama interaksi front-end
- `style.css`, `assets/css/*` — gaya dan animasi
- `config/database.php` — konfigurasi PDO/MySQL
- `admin/` — panel admin (services, dashboard, bookings view optional)
- `sql/` — skrip pembuatan database dan tabel

Kontribusi & catatan pengembang

- Proyek ini ditujukan sebagai proyek latihan/presentasi; beberapa fitur (seperti booking persistence dan reset password helper) dibuat untuk pengujian lokal dan perlu diamankan atau dihapus sebelum deployment ke publik.

Jika Anda ingin saya mengembalikan penyimpanan booking ke server atau menyimpan simulasi booking di `localStorage`, beri tahu — saya akan implementasikan sesuai preferensi Anda.
