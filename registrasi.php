<?php
include_once("bootstrap.php");

$daftar_role = [];
try {
    if (class_exists('Role') && method_exists('Role', 'get_opsi_role')) {
        $daftar_role = Role::get_opsi_role();
    }
} catch (Exception $e) {
    $error_msg = "Gagal mengambil data role: " . $e->getMessage();
}
?>

<h2>Registrasi Pengguna</h2>

<?php 
if (isset($error_msg)) {
    echo "<p style='color: red;'>$error_msg</p>";
}

if (class_exists('Flash') && method_exists('Flash', 'get')) {
    $pesan = Flash::get();
    if ($pesan) {
        echo "<p style='color: red; font-weight: bold;'>$pesan</p>";
    }
} 
?>

<form action="proses_registrasi.php" method="POST" onsubmit="return verifikasiPassword()">
    <div>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required>
    </div>
    <br>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
    </div>
    <br>
    <div>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
    </div>
    <br>
    <div>
        <label for="repassword">Konfirmasi Password:</label><br>
        <input type="password" id="repassword" name="repassword" required>
    </div>
    <br>
    <div>
        <label for="idrole">Role:</label><br>
        <?php include_once("opsi_role.php"); ?>
    </div>
    <br>

    <!-- Opsi Pemilik -->
    <fieldset style="margin-bottom: 15px; padding: 10px;">
        <legend><b>Data Pemilik (Opsional)</b></legend>
        <div>
            <label for="no_wa">No. WhatsApp:</label><br>
            <input type="text" id="no_wa" name="no_wa">
        </div>
        <br>
        <div>
            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat">
        </div>
    </fieldset>

    <!-- Opsi Dokter -->
    <fieldset style="margin-bottom: 15px; padding: 10px;">
        <legend><b>Data Dokter (Opsional)</b></legend>
        <div>
            <label for="no_izin">No. Izin Praktik:</label><br>
            <input type="text" id="no_izin" name="no_izin">
        </div>
        <br>
        <div>
            <label for="spesialisasi">Spesialisasi:</label><br>
            <input type="text" id="spesialisasi" name="spesialisasi">
        </div>
    </fieldset>

    <button type="submit">Daftar</button>
</form>

<script>
function verifikasiPassword() {
    const pwd = document.getElementById('password').value;
    const repwd = document.getElementById('repassword').value;

    if (pwd !== repwd) {
        alert("Password dan Konfirmasi Password tidak cocok!");
        return false;
    }
    return true; 
}
</script>