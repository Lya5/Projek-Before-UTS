<?php
class Flash {
    public static function set($pesan) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash_message'] = $pesan;
    }

    public static function get() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash_message'])) {
            $pesan = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            return $pesan;
        }
        return null;
    }

    public static function display() {
        $pesan = self::get();
        if ($pesan) {
            echo "<p style='color: red; font-weight: bold;'>$pesan</p>";
        }
    }
}