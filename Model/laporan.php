<?php

abstract class Laporan {
    protected DBconnection $db;

    public function __construct(DBconnection $db) {
        $this->db = $db;
    }

    public function header(string $judul): void {
        echo "========================================<br>";
        echo "<b>LAPORAN: " . strtoupper($judul) . "</b><br>";
        echo "========================================<br>";
    }

    public function footer(): void {
        echo "----------------------------------------<br>";
        echo "<i>Dicetak otomatis oleh Sistem</i><br><br>";
    }

    abstract public function isi(): void;
}