<?php
declare(strict_types=1);   // hapus baris ini untuk mengamati perilaku weak typing

function total_percobaan(int $sukses, int $gagal): int {
    return $sukses + $gagal;
}

echo "Argumen int   : total_percobaan(5, 10)   = " . total_percobaan(5, 10) . "<br>";
echo "Argumen float : total_percobaan(5.0, 10) = ";

try {
    echo total_percobaan(5.0, 10);   // strict typing -> TypeError
} catch (TypeError $e) {
    echo "<span style='color:red;'>TypeError &mdash; " . $e->getMessage() . "</span>";
}
?>

<p>
    Tanpa blok <code>try … catch</code>, TypeError di atas menghentikan eksekusi program
    sebagai <em>Fatal error</em>. Hapus baris <code>declare(strict_types=1);</code>
    lalu muat ulang halaman: pada mode weak typing nilai 5.3 dikonversi menjadi 5
    sehingga hasilnya 15.
</p>
