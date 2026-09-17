<?php
include_once("dbconnection.php");
include_once("classes.php");

class UserDAO {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Insert User Baru + Auto Role ke user_role
    public function insert(User $user, $password) {
        $queryUser = 'INSERT INTO "user" (nama, email, password) VALUES ($1, $2, $3) RETURNING iduser';
        $result = pg_query_params($this->db, $queryUser, array($user->getNama(), $user->getEmail(), $password));

        if ($result && $row = pg_fetch_assoc($result)) {
            $newIdUser = $row['iduser'];
            $idroleDefault = 4; // Role default 'User'

            $queryRole = 'INSERT INTO user_role (iduser, idrole, status) VALUES ($1, $2, TRUE)';
            $resRole = pg_query_params($this->db, $queryRole, array($newIdUser, $idroleDefault));

            return $resRole ? true : false;
        }

        return false;
    }

    // Cari User Berdasarkan Email
    public function find_by_email(string $email) {
        $query = 'SELECT * FROM "user" WHERE email = $1';
        $result = pg_query_params($this->db, $query, array($email));

        if ($result && $row = pg_fetch_assoc($result)) {
            $user = new User($row['iduser'], $row['nama'], $row['email']);
            return array('user' => $user, 'password' => $row['password']);
        }
        return null;
    }

    // Update Data User
    public function update(User $user) {
        $query = 'UPDATE "user" SET nama = $1, email = $2 WHERE iduser = $3';
        $result = pg_query_params($this->db, $query, array($user->getNama(), $user->getEmail(), $user->getIduser()));
        return $result ? true : false;
    }

    // Delete User Berdasarkan ID
    public function delete(int $iduser) {
        $query = 'DELETE FROM "user" WHERE iduser = $1';
        $result = pg_query_params($this->db, $query, array($iduser));
        return $result ? true : false;
    }
}
?>