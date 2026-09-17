<?php

require_once __DIR__ . '/respon.php';

class DokterModel extends BaseModel {

    public function __construct(DBconnection $db) {
        parent::__construct($db);
        $this->tabel = 'dokter';
        $this->primary_key = 'iddokter';
    }

    public function insert(array $data): Respon {
        return $this->db->send_query(
            'INSERT INTO dokter (nama, no_hp) VALUES ($1, $2) RETURNING iddokter',
            [$data['nama'], $data['no_hp']]
        );
    }

    public function update(int $id, array $data): Respon {
        return $this->db->send_query(
            'UPDATE dokter SET nama = $1, no_hp = $2 WHERE iddokter = $3',
            [$data['nama'], $data['no_hp'], $id]
        );
    }

    public function delete(int $id): Respon {
        return $this->db->send_query(
            'DELETE FROM dokter WHERE iddokter = $1',
            [$id]
        );
    }
}