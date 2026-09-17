<?php
include_once("bootstrap.php");

$daftar_user_obj = [];

try {
    $db = new DBconnection();
    $userModel = new UserModel($db);
    $pemilikModel = new PemilikModel($db);
    $dokterModel = new DokterModel($db);

    
    $users = $userModel->find_all();

    foreach ($users as $u) {
        $iduser = (int) $u['iduser'];
        $pemilik = $pemilikModel->find_by_iduser($iduser);
        $dokter  = $dokterModel->find_by_iduser($iduser);

        
        if ($pemilik !== null) {
            $obj = new Pemilik($iduser, $u['nama'], $u['email'], $pemilik['no_wa'], $pemilik['alamat']);
        } elseif ($dokter !== null) {
            $obj = new Dokter($iduser, $u['nama'], $u['email'], $dokter['no_izin'], $dokter['spesialisasi']);
        } else {
            $obj = new User($iduser, $u['nama'], $u['email']);
        }

        // Ambil Role Aktif dari tabel user_role
        $resRole = $db->send_query(
            'SELECT r.idrole, r.nama_role, ur.status 
             FROM user_role ur JOIN role r ON r.idrole = ur.idrole 
             WHERE ur.iduser = $1 AND ur.status = TRUE',
            [$iduser]
        );

        if (!empty($resRole->data)) {
            $r = $resRole->data[0];
            $obj->set_role(new Role((int)$r['idrole'], $r['nama_role'], true));
        }

        $daftar_user_obj[] = $obj;
    }

    $db->close_connection();
} catch (Exception $e) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Seluruh Pengguna</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <h2>Daftar Seluruh Pengguna (Total: <?= count($daftar_user_obj) ?>)</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Akun</th>
                <th>Role Aktif</th>
                <th>Status Pemilik?</th>
                <th>Detail Informasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftar_user_obj as $i => $p): ?>
                <?php 
                    $roleAktif  = $p->get_role_aktif();
                    $isPemilik  = ($p instanceof Pemilik) ? "Ya" : "Bukan";
                    $jenisClass = get_class($p);
                    $userData   = $p->get_user();

                    
                    $namaRole = '-';
                    if ($roleAktif !== null) {
                        if (method_exists($roleAktif, 'get_nama_role')) {
                            $namaRole = $roleAktif->get_nama_role();
                        } elseif (method_exists($roleAktif, 'get_data')) {
                            $dataRole = $roleAktif->get_data();
                            $namaRole = $dataRole['nama_role'] ?? '-';
                        }
                    }
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($userData['nama'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($userData['email'] ?? '-') ?></td>
                    <td><strong><?= $jenisClass ?></strong></td>
                    <td><?= htmlspecialchars($namaRole) ?></td>
                    <td><?= $isPemilik ?></td>
                    <td>
                        <?php if ($p instanceof Pemilik): ?>
                            WA: <?= htmlspecialchars($p->get_no_wa()) ?>, Alamat: <?= htmlspecialchars($p->get_alamat()) ?>
                        <?php elseif ($p instanceof Dokter): ?>
                            No. Izin: <?= htmlspecialchars($p->get_no_izin()) ?>, Spesialisasi: <?= htmlspecialchars($p->get_spesialisasi()) ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>

</body>
</html>