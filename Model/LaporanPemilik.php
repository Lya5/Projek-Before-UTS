<?php

class LaporanPemilik extends Laporan {

    public function isi(): void {
        $pemilikModel = new PemilikModel($this->db);
        $dataPemilik = $pemilikModel->find_all();

        $this->header("Data Pemilik");
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr bgcolor='#eeeeee'><th>ID Pemilik</th><th>Nama</th><th>No HP</th><th>Alamat</th></tr>";

        foreach ($dataPemilik as $p) {
            echo "<tr>";
            echo "<td>" . $p['idpemilik'] . "</td>";
            echo "<td>" . $p['nama'] . "</td>";
            echo "<td>" . ($p['no_wa'] ?? '-') . "</td>";
            echo "<td>" . ($p['alamat'] ?? '-') . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        $this->footer();
    }
}