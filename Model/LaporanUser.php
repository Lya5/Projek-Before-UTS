<?php

class LaporanUser extends Laporan {

    public function isi(): void {
        $userModel = new UserModel($this->db);
        $dataUser = $userModel->find_all();

        $this->header("Data User");
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr bgcolor='#eeeeee'><th>ID User</th><th>Nama</th><th>Email</th></tr>";

        foreach ($dataUser as $u) {
            echo "<tr>";
            echo "<td>" . $u['iduser'] . "</td>";
            echo "<td>" . $u['nama'] . "</td>";
            echo "<td>" . $u['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        $this->footer();
    }
}