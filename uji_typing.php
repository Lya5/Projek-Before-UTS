<?php
declare(strict_type=1);

function total_percobaan(int $sukses, int $gagal): int {
    return $sukses + $gagal;
}

echo total_percobaan(5.3, 10);   // ouput: 15
?>


