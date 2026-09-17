<?php

require_once __DIR__ . '/respon.php';
require_once __DIR__ . '/autentikasi.php';

class UserModel extends BaseModel implements Autentikasi {

    public function __construct(DBconnection $db) {
        parent::__construct($db);
        $this->tabel = '"user"';
        $this->primary_key = 'iduser';
    }

    public function find_all(): array {
        $respon = $this->db->send_query('SELECT iduser, nama, email FROM "user" ORDER BY iduser');
        return $respon->data ?? [];
    }

    public function find_by_id(int $id): ?array {
        $respon = $this->db->send_query(
            'SELECT u.iduser, u.nama, u.email, r.idrole, r.nama_role, r.status ' .
            'FROM "user" u ' .
            'LEFT JOIN user_role ur ON u.iduser = ur.iduser ' .
            'LEFT JOIN role r ON ur.idrole = r.idrole ' .
            'WHERE u.iduser = $1',
            [$id]
        );
        return $respon->data[0] ?? null;
    }

    public function insert(array $data): Respon {
        return $this->db->send_query(
            'INSERT INTO "user" (nama, email, password) VALUES ($1, $2, $3) RETURNING iduser',
            [$data['nama'], $data['email'], $data['password']]
        );
    }

    public function update(int $id, array $data): Respon {
        return $this->db->send_query(
            'UPDATE "user" SET nama = $1, email = $2 WHERE iduser = $3',
            [$data['nama'], $data['email'], $id]
        );
    }

    public function delete(int $id): Respon {
        return $this->db->send_query(
            'DELETE FROM "user" WHERE iduser = $1',
            [$id]
        );
    }

    public function verifikasi(string $email, string $password): ?User {
        $respon = $this->db->send_query(
            'SELECT * FROM "user" WHERE email = $1 AND password = $2',
            [$email, $password]
        );

        if (!empty($respon->data)) {
            $u = $respon->data[0];
            return new User((int)$u['iduser'], $u['nama'], $u['email']);
        }
        return null;
    }
}