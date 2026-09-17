<?php

require_once __DIR__ . '/respon.php';

class RoleModel extends BaseModel {

    public function __construct(DBconnection $db) {
        parent::__construct($db);
        $this->tabel = 'role';
        $this->primary_key = 'idrole';
    }

    public function insert(array $data): Respon {
        return $this->db->send_query(
            'INSERT INTO role (nama_role, status) VALUES ($1, $2) RETURNING idrole',
            [$data['nama_role'], $data['status']]
        );
    }

    public function update(int $id, array $data): Respon {
        return $this->db->send_query(
            'UPDATE role SET nama_role = $1, status = $2 WHERE idrole = $3',
            [$data['nama_role'], $data['status'], $id]
        );
    }

    public function delete(int $id): Respon {
        return $this->db->send_query(
            'DELETE FROM role WHERE idrole = $1',
            [$id]
        );
    }
}