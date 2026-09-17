<?php
class User {
    private $iduser;
    private $nama;
    private $email;
    private $isLoggedIn = false;

    public function __construct($iduser, $nama, $email) {
        $this->iduser = $iduser;
        $this->nama   = $nama;
        $this->email  = $email;
    }

    public function setLoggedIn($status) {
        $this->isLoggedIn = $status;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function getIduser() { return $this->iduser; }
    public function getNama() { return $this->nama; }
    public function getEmail() { return $this->email; }
}
?>