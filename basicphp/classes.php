<?php
class Role {
    private int    $idrole;
    private string $nama_role;
    private bool   $status;

    public function set_role(int $idrole, string $nama_role, bool $status): void {
        $this->idrole    = $idrole;
        $this->nama_role = $nama_role;
        $this->status    = $status;
    }

    public function get_data(): array {
        return ['idrole' => $this->idrole, 'nama_role' => $this->nama_role, 'status' => $this->status];
    }

    public function set_status(bool $newstatus): void { $this->status = $newstatus; }
    public function get_status(): bool { return $this->status; }
}
class User {
    private int    $iduser;
    private string $nama;
    private string $email;
    private string $password;
    private array  $role = [];

    public function set_user(int $iduser, string $nama, string $email, string $password): void {
        $this->iduser   = $iduser;
        $this->nama     = $nama;
        $this->email    = strtolower(trim($email));   
        $this->password = $password;
    }

    public function get_user(): array {
        return [
            'iduser' => $this->iduser,
            'nama'   => $this->nama,
            'email'  => $this->email,
            'role'   => $this->get_role_aktif()->get_data()['nama_role'],
        ];
    }

    public function set_role(Role $role): void {
        if ($role->get_data()['status'] == true) {
            foreach ($this->role as $r) {
                $r->set_status(false);
            }
        }
        $this->role[] = $role;
    }

    public function get_role_aktif(): Role {
        $role_aktif = new Role();
        $role_aktif->set_role(0, '-', false);
        foreach ($this->role as $r) {
            if ($r->get_status() == true) {
                $role_aktif = $r;
            }
        }
        return $role_aktif;
    }
}
?>
