<?php

// Membuat variabel $email dan memberikan nilai berupa string
// yang memiliki spasi di awal dan akhir serta menggunakan huruf kapital.
$email = "  John@Mail.Com  ";

// Menghapus spasi (whitespace) di awal dan akhir string.
// Hasil: "John@Mail.Com"
$email = trim($email);

// Mengubah seluruh karakter string menjadi huruf kecil.
// Hasil: "john@mail.com"
$email = strtolower($email);

// Menampilkan isi variabel $email ke halaman web.
// <br> digunakan untuk membuat baris baru di HTML.
echo $email . "<br>";

// Menghitung jumlah karakter yang terdapat dalam string $email.
// Hasil: 13 karena "john@mail.com" terdiri dari 13 karakter.
echo strlen($email) . "<br>";

// Memecah string $email berdasarkan karakter "@".
// Hasilnya menjadi array:
// [0] => "john"
// [1] => "mail.com"
$bagian = explode("@", $email);

// Menampilkan isi array $bagian.
// print_r() cocok digunakan untuk melihat struktur array
// secara sederhana saat proses debugging.
print_r($bagian);

// Memeriksa apakah elemen array $bagian[1] kosong.
// empty() menghasilkan:
// true  -> jika kosong
// false -> jika memiliki nilai
// Karena $bagian[1] berisi "mail.com", hasilnya adalah false.
var_dump(empty($bagian[1]));

?>