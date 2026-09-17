<?php
// koneksi konfigurasi database
require_once __DIR__ . '/Model/konfigurasi.php';

// koneksi ke DB
require_once __DIR__ . '/Model/dbconnection.php';
require_once __DIR__ . '/Model/crudable.php';
require_once __DIR__ . '/Model/autentikasi.php';
require_once __DIR__ . '/Model/basemodel.php';
require_once __DIR__ . '/Model/usermodel.php';
require_once __DIR__ . '/Model/pemilikmodel.php';
require_once __DIR__ . '/Model/doktermodel.php';
require_once __DIR__ . '/Model/rolemodel.php';

// koneksi ke class laporan
require_once __DIR__ . '/Model/laporan.php';
require_once __DIR__ . '/Model/laporanuser.php';
require_once __DIR__ . '/Model/laporanpemilik.php';