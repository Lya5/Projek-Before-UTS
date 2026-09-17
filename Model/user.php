<?php 

class User { 
    private int    $iduser; 
    private string $nama; 
    private string $email; 
    private array  $roles = []; 

    public function __construct(int $iduser, string $nama, string $email) { 
        $this->iduser = $iduser; 
        $this->nama   = $nama; 
        $this->email  = strtolower(trim($email)); 
    } 

    public function set_role(Role $role): void { 
        $this->roles[] = $role; 
    } 

    public function get_role_aktif(): ?Role { 
        foreach ($this->roles as $r) { 
            if ($r->get_status() === true) { 
                return $r; 
            } 
        } 
        return null; 
    } 

    public function get_user(): array { 
        $daftar_role = []; 
        foreach ($this->roles as $r) { 
            $daftar_role[] = $r->get_data(); 
        } 

        return [ 
            'iduser' => $this->iduser, 
            'nama'   => $this->nama, 
            'email'  => $this->email, 
            'roles'  => $daftar_role
        ]; 
    } 

    // Magic method: dieksekusi ketika object diperlakukan sebagai string 
    public function __toString(): string { 
        return $this->nama . " <" . $this->email . ">"; 
    } 
    public function hapus_role(int $idrole): void {
        foreach ($this->roles as $key => $r) {
            $roleData = $r->get_data();
            if (isset($roleData['idrole']) && $roleData['idrole'] === $idrole) {
                unset($this->roles[$key]);
            }
        }
        $this->roles = array_values($this->roles);
    }
    public function set_role_aktif(int $idrole): void {
        foreach ($this->roles as $r) {
            $roleData = $r->get_data();
            if (isset($roleData['idrole']) && $roleData['idrole'] === $idrole) {
                $r->set_status(true);
            } else {
                $r->set_status(false);
            }
        }
    }
}