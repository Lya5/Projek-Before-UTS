<?php

require_once __DIR__ . '/respon.php';

class PemilikModel extends BaseModel {

    public function __construct(DBconnection $db) {
        parent::__construct($db);
        $this->tabel = 'pemilik';
        $this->primary_key = 'idpemilik';
    }

    public function insert(array $data): Respon {
        return $this->db->send_query(
            'INSERT INTO pemilik (nama, no_hp, alamat) VALUES ($1, $2, $3) RETURNING idpemilik',
            [$data['nama'], $data['no_hp'], $data['alamat']]
        );
    }

    public function update(int $id, array $data): Respon {
        return $this->db->send_query(
            'UPDATE pemilik SET nama = $1, no_hp = $2, alamat = $3 WHERE idpemilik = $4',
            [$data['nama'], $data['no_hp'], $data['alamat'], $id]
        );
    }

    public function delete(int $id): Respon {
        return $this->db->send_query(
            'DELETE FROM pemilik WHERE idpemilik = $1',
            [$id]
        );
    }
}