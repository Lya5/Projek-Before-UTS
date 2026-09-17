<?php include_once("fungsi_lib.php"); ?>
<!DOCTYPE html>
<html lang="id">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
    <h1>Dasar PHP, Array, Function, dan Pengantar OOP</h1>

    <table>
        <tr><th>Kegiatan</th><th>Pokok bahasan</th><th>File</th></tr>
        <tr><td>1</td><td>Syntax dasar, tipe data, operasi string</td>
            <td><a href="index_1.php">index_1.php</a>, <a href="normalisasi.php">normalisasi.php</a></td></tr>
        <tr><td>2</td><td>Array dan iterasi data pengguna</td>
            <td><a href="array_user.php">array_user.php</a>, <a href="daftar_user.php">daftar_user.php</a></td></tr>
        <tr><td>3</td><td>Function, file library, type declaration</td>
            <td><code>fungsi_lib.php</code>, <a href="uji_typing.php">uji_typing.php</a></td></tr>
        <tr><td>4</td><td>HTML form: method GET dan POST</td>
            <td><a href="login.html">login.html</a> &rarr; <code>login_get.php</code></td></tr>
        <tr><td>5</td><td>Koneksi ke PostgreSQL</td>
            <td><a href="ujikoneksi.php">ujikoneksi.php</a></td></tr>
        <tr><td>6</td><td>Registrasi, flash message, password hashing</td>
            <td><a href="registrasi.php">registrasi.php</a></td></tr>
        <tr><td>7</td><td>Autentikasi dan dashboard</td>
            <td><a href="login.php">login.php</a> &rarr; <code>dashboard.php</code></td></tr>
        <tr><td>8</td><td>Array multidimensional dan parsing log</td>
            <td><a href="rekap_login.php">rekap_login.php</a></td></tr>
        <tr><td>9</td><td>Pemodelan entitas menjadi class</td>
            <td><a href="test_oop.php">test_oop.php</a></td></tr>
    </table>

</body>
</html>
