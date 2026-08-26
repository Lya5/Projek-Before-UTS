<?php

echo "<h2>Contoh Array dalam PHP</h2>";

/*
|--------------------------------------------------------------------------
| 1. INDEXED ARRAY
|--------------------------------------------------------------------------
| Array dengan index berupa angka, dimulai dari 0.
*/

$buah = array(
    "Apel",       // index 0
    "Jeruk",      // index 1
    "Mangga",     // index 2
    "Pisang"      // index 3
);

echo "<h3>1. Indexed Array (Array 1 Dimensi)</h3>";

echo $buah[0] . "<br>"; // Apel
echo $buah[2] . "<br>"; // Mangga


/*
|--------------------------------------------------------------------------
| 2. ASSOCIATIVE ARRAY
|--------------------------------------------------------------------------
| Array dengan key berupa nama/string.
*/

$user = array(
    "iduser" => 1,
    "nama"   => "John Doe",
    "email"  => "john@mail.com",
    "role"   => "Admin"
);

echo "<h3>2. Associative Array (Array 1 Dimensi)</h3>";

echo "Nama  : " . $user["nama"] . "<br>";
echo "Email : " . $user["email"] . "<br>";
echo "Role  : " . $user["role"] . "<br>";


/*
|--------------------------------------------------------------------------
| 3. ARRAY 2 DIMENSI
|--------------------------------------------------------------------------
| Array yang berisi array lainnya.
| Contoh: daftar mahasiswa.
*/

$mahasiswa = array(

    array(
        "nim"   => "001",
        "nama"  => "John Doe",
        "prodi" => "Informatika"
    ),

    array(
        "nim"   => "002",
        "nama"  => "Siti Aminah",
        "prodi" => "Kedokteran"
    )
);

echo "<h3>3. Array 2 Dimensi</h3>";

echo "Mahasiswa 1 : " . $mahasiswa[0]["nama"] . "<br>";
echo "Mahasiswa 2 : " . $mahasiswa[1]["nama"] . "<br>";
echo "Prodi       : " . $mahasiswa[1]["prodi"] . "<br>";


/*
|--------------------------------------------------------------------------
| 4. ARRAY 3 DIMENSI
|--------------------------------------------------------------------------
| Array yang memiliki array di dalam array.
| Contoh: Fakultas → Prodi → Mahasiswa.
*/

$data = array(

    "Fakultas Vokasi" => array(

        "Informatika" => array(
            "001" => "John Doe",
            "002" => "Siti Aminah"
        ),

        "Manajemen Perkantoran" => array(
            "003" => "Budi Santoso",
            "004" => "Andi Wijaya"
        )
    ),

    "Fakultas Kedokteran" => array(

        "Kedokteran" => array(
            "005" => "Dewi Lestari",
            "006" => "Rina Putri"
        )
    )
);

echo "<h3>4. Array 3 Dimensi</h3>";

echo "Mahasiswa : "
    . $data["Fakultas Vokasi"]["Informatika"]["001"] . "<br>";

echo "Mahasiswa : "
    . $data["Fakultas Vokasi"]["Manajemen Perkantoran"]["003"] . "<br>";

echo "Mahasiswa : "
    . $data["Fakultas Kedokteran"]["Kedokteran"]["005"] . "<br>";


/*
Indexed Array       → $buah[0]
Associative Array   → $user["nama"]
Array 2 Dimensi     → $mahasiswa[0]["nama"]
Array 3 Dimensi     → $data["Fakultas Vokasi"]["Informatika"]["001"]
*/


?>