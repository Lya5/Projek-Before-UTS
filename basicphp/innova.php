<?php
/**
 * Contoh Penerapan Konsep Class dan Object dalam PHP
 * Studi Kasus: Spesifikasi dan Instansiasi Kendaraan (Toyota Innova)
 */

// ============================================================================
// 1. DEFINISI CLASS (Cetak Biru / Blueprint / Rancangan Spesifikasi)
// ============================================================================
class MobilInnova 
{
    // Atribut / Property (Mendefinisikan variabel spesifikasi)
    public string $jenisBbm;
    public int $jumlahSeat;
    public int $kapasitasCc;
    public string $nomorPlat;

    /**
     * Constructor: Dipanggil otomatis saat pembentukan Object baru (Instansiasi)
     */
    public function __construct(string $jenisBbm, int $jumlahSeat, int $kapasitasCc, string $nomorPlat) 
    {
        $this->jenisBbm   = $jenisBbm;
        $this->jumlahSeat = $jumlahSeat;
        $this->kapasitasCc = $kapasitasCc;
        $this->nomorPlat  = $nomorPlat;
    }

    /**
     * Method / Perilaku: Fungsi yang menggambarkan aktivitas dari Object
     */
    public function tampilkanSpesifikasi(): string 
    {
        return "Mobil Innova [Plat: {$this->nomorPlat}] | BBM: {$this->jenisBbm} | Seat: {$this->jumlahSeat} | Mesin: {$this->kapasitasCc} cc\n";
    }

    public function kendarai(): string 
    {
        return "Mobil Innova dengan nomor plat {$this->nomorPlat} sedang dikendarai di jalan raya...\n";
    }
}

// ============================================================================
// 2. REALIASI OBJECT (Instansiasi dari 1 Class menjadi Banyak Objek Nyata)
// ============================================================================

// Menggunakan 1 Class (MobilInnova) untuk membuat Object Nyata ke-1
$innovaBudi = new MobilInnova("Diesel", 7, 2400, "L 1234 AB");

// Menggunakan Class yang sama untuk membuat Object Nyata ke-2
$innovaSiti = new MobilInnova("Bensin", 7, 2000, "B 5678 CD");

// Menggunakan Class yang sama untuk membuat Object Nyata ke-3
$innovaKantor = new MobilInnova("Diesel", 7, 2400, "N 9999 XX");


// ============================================================================
// 3. EKSEKUSI / EKSPRESI KODE
// ============================================================================

echo "=== DAPATKAN SPESIFIKASI DAN SIMULASI PENGGUNAAN OBJEK ===\n\n";

// Mengakses Method dari Object 1
echo $innovaBudi->tampilkanSpesifikasi();
echo $innovaBudi->kendarai();

echo "\n";

// Mengakses Method dari Object 2
echo $innovaSiti->tampilkanSpesifikasi();
echo $innovaSiti->kendarai();

echo "\n";

// Mengakses Method dari Object 3
echo $innovaKantor->tampilkanSpesifikasi();