<?php
/**
 * Contoh Penerapan Access Modifiers (public, protected, private) dalam PHP
 */

// ==========================================
// 1. KELAS INDUK (Parent Class)
// ==========================================
class Mobil 
{
    // Property Public: Dapat diakses dari mana saja
    public string $merk;

    // Property Protected: Hanya bisa diakses kelas Mobil & turunannya
    protected string $nomorRangka;

    // Property Private: Hanya bisa diakses oleh kelas Mobil ini saja
    private string $pinKeamanan;

    public function __construct(string $merk, string $nomorRangka, string $pinKeamanan) 
    {
        $this->merk         = $merk;
        $this->nomorRangka  = $nomorRangka;
        $this->pinKeamanan  = $pinKeamanan;
    }

    // Public Method: Menyediakan akses aman untuk melihat PIN Private
    public function getPinKeamanan(): string 
    {
        return $this->pinKeamanan; // BISA: Private diakses di dalam kelas sendiri
    }
}

// ==========================================
// 2. KELAS TURUNAN (Child Class / Subclass)
// ==========================================
class MobilInnova extends Mobil 
{
    public function infoKendaraan(): void 
    {
        echo "Merk: " . $this->merk . "\n";                // BISA: Public diakses di class turunan
        echo "No Rangka: " . $this->nomorRangka . "\n";    // BISA: Protected diakses di class turunan
        
        // UNCOMMENT BARIS DI BAWAH AKAN MENYEBABKAN ERROR:
        // echo "PIN: " . $this->pinKeamanan . "\n";       // ERROR! Private TIDAK BISA diakses di class turunan
    }
}

// ==========================================
// 3. UJI COBA AKSES DARI LUAR KELAS (Public Scope)
// ==========================================

$innova = new MobilInnova("Toyota Innova", "NKR-123456", "9876");

echo "=== DEMO AKSES MODIFIER ===\n\n";

// A. Uji Coba Akses Property PUBLIC
echo "1. Akses Public : " . $innova->merk . "\n"; // SUCCESS (Output: Toyota Innova)

// B. Uji Coba Akses Property PROTECTED dari Luar
// echo $innova->nomorRangka; 
// Fatal Error: Cannot access protected property MobilInnova::$nomorRangka

// C. Uji Coba Akses Property PRIVATE dari Luar
// echo $innova->pinKeamanan; 
// Fatal Error: Cannot access private property MobilInnova::$pinKeamanan

// D. Membaca Data Protected lewat Method Kelas Turunan
echo "\n2. Menjalankan Method Kelas Turunan:\n";
$innova->infoKendaraan();

// E. Membaca Data Private lewat Public Getter (Cara yang Direkomendasikan)
echo "\n3. Akses Private lewat Public Getter Method:\n";
echo "PIN (akses via method): " . $innova->getPinKeamanan() . "\n";