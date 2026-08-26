# Praktikum Pemrograman Web — Modul 2
### Dasar PHP, Array, Function, dan Pengantar OOP

Source code lengkap studi kasus **aplikasi registrasi dan autentikasi pengguna**
(PHP 8 + PostgreSQL) sesuai modul praktikum.

---

## 1. Persiapan

1. **Salin folder ini** ke root directory web server:
   - Windows (XAMPP): `C:\xampp\htdocs\halamanlogin`
   - Linux (XAMPP): `/opt/lampp/htdocs/halamanlogin`

2. **Aktifkan extension PostgreSQL pada PHP.**
   Buka `php.ini`, hapus tanda titik koma pada baris berikut, lalu restart Apache:
   ```
   extension=pgsql
   ```
   Verifikasi melalui `phpinfo()` — bagian `pgsql` harus muncul.

3. **Buat database.** Dua script dijalankan berurutan, karena `CREATE DATABASE`
   tidak dapat dieksekusi bersamaan dengan statement lain:
   ```
   psql -U postgres -f database_1_create.sql
   psql -U postgres -d kuliah_wf_2025 -f database_2_schema.sql
   ```
   Pada pgAdmin 4: jalankan `database_1_create.sql` pada Query Tool database
   `postgres`, kemudian jalankan `database_2_schema.sql` pada Query Tool
   database `kuliah_wf_2025`.

4. **Sesuaikan koneksi.** Buka `dbconnection.php`, ubah `$user` dan `$password`
   sesuai konfigurasi PostgreSQL Anda (baku: user `postgres`, port `5432`).

5. Buka `http://localhost/halamanlogin/` — halaman indeks memuat tautan ke
   seluruh kegiatan.

---

## 2. Daftar File

| Kegiatan | File | Keterangan |
|---|---|---|
| 1 | `index_1.php` | `var_dump()` dan pembuktian loosely typed |
| 1 | `normalisasi.php` | `trim()`, `strtolower()`, `strlen()`, `explode()`, `empty()` |
| 2 | `array_user.php` | Associative array dan multidimensional array data pengguna |
| 2 | `daftar_user.php` | Iterasi array menjadi table HTML dengan `foreach` |
| 3 | `fungsi_lib.php` | Library function: session, flash message, log, pencarian user |
| 3 | `uji_typing.php` | `declare(strict_types=1)` dan `TypeError` |
| 4 | `login.html`, `login_get.php` | Perbandingan method GET dan POST |
| 5 | `dbconnection.php`, `ujikoneksi.php` | Koneksi `pg_connect()` ke PostgreSQL |
| 6 | `registrasi.php`, `proses_registrasi.php` | Registrasi + `password_hash()` + flash message |
| 7 | `login.php`, `login_post.php`, `dashboard.php`, `logout.php` | Autentikasi, session login, proteksi halaman |
| 8 | `rekap_login.php`, `log_aktivitas.txt` | Parsing log menjadi array multidimensional |
| 9 | `classes.php`, `test_oop.php` | Class `User` dan `Role`, encapsulation, role aktif |
| — | `database_1_create.sql`, `database_2_schema.sql` | Script pembentukan database dan table |

---

## 3. Alur Pengujian

1. Buka `registrasi.php`, daftarkan pengguna baru.
   Uji pula dengan password dan retype password yang berbeda — pesan error harus
   tampil kembali di halaman registrasi (flash message).
2. Buka `login.php`, uji tiga skenario: email tidak terdaftar, password salah,
   dan login berhasil.
3. Setelah login berhasil, `dashboard.php` menampilkan data pengguna. Buka
   `dashboard.php` tanpa login untuk menguji proteksi halaman.
4. Klik **Logout**, kemudian buka `rekap_login.php` untuk melihat rekapitulasi
   aktivitas dari `log_aktivitas.txt`.

File `log_aktivitas.txt` bertambah otomatis setiap kali terjadi login, akses
dashboard, atau logout. File contoh sudah disertakan agar `rekap_login.php`
dapat langsung diuji.

---

## 4. Catatan Teknis

- Nama table `user` merupakan **reserved word** pada PostgreSQL, sehingga pada
  setiap query ditulis `"user"` (tanda kutip ganda) dan string query PHP
  menggunakan tanda kutip tunggal.
- Seluruh query menggunakan `pg_query_params()` dengan placeholder `$1`, `$2`, …
  sehingga terhindar dari SQL injection.
- Password disimpan sebagai hash bcrypt melalui `password_hash($password,
  PASSWORD_DEFAULT)` dan diverifikasi dengan `password_verify()`.
- Direktori project harus dapat ditulis oleh web server agar `log_aktivitas.txt`
  dapat diperbarui.

---

## 5. Perbedaan Kecil dengan Listing pada Modul

Dua penyesuaian dilakukan agar project langsung dapat dijalankan:

1. `rekap_login.php` menggunakan `elseif ($kolom[2] == "AKSES")` — bukan `else` —
   serta menyertakan pengaman untuk baris `AKSES` yang emailnya belum pernah muncul
   pada baris `LOGIN`. Penyesuaian ini diperlukan karena `logout.php` menuliskan
   baris berjenis `LOGOUT` pada file log. Hal ini merupakan jawaban atas pertanyaan
   analisis nomor 3 pada Kegiatan 8.
2. `uji_typing.php` membungkus pemanggilan yang salah tipe dengan `try … catch`
   agar pesan `TypeError` tetap tampil pada halaman. Tanpa blok tersebut, program
   berhenti sebagai *Fatal error* sebagaimana dijelaskan pada modul.

Selain itu ditambahkan `index.php` (halaman indeks tautan), `ujikoneksi.php`, dan
`logout.php` yang pada modul merupakan Tugas 1.

---

## 6. Yang Sengaja Belum Disediakan

Bagian berikut merupakan **tugas modul** dan tidak disertakan pada source code ini:

1. Validasi registrasi pada sisi server (`empty()`, `FILTER_VALIDATE_EMAIL`,
   panjang password, pemeriksaan email ganda).
2. `daftar_user.php` versi dinamis yang membaca data dari database dengan
   `pg_fetch_all()`.
3. Rekapitulasi log dalam bentuk table HTML.
4. Method `hapus_role()` dan `set_role_aktif()` pada class `User`.
5. Class `UserDAO` (CRUD berbasis class) dan integrasinya ke proses registrasi
   dan login.
