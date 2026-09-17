<?php
include_once("demo/bidang.php"); 
  
$bidang = [ 
    new PersegiPanjang("PersegiPanjang1", 5, 10), 
    new Lingkaran("Lingkaran1", 7), 
]; 
  
// satu perulangan untuk dua class yang berbeda 
foreach ($bidang as $b) { 
    if ($b instanceof Bidang) { 
        $b->luas(); 
        $b->keliling(); 
    } else { 
        echo "Object bukan instance dari class Bidang<br>"; 
    } 
} 
  
// $uji = new Bidang("Uji", 1, 1); 
//   -> Fatal error: Cannot instantiate abstract class Bidang