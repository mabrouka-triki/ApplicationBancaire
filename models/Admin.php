<?php

class Admin
{
    private $idAdmin;
    private $nomAdmin;
    private $emailAdmin;
    private $mdpAdmin;

    public function __construct($idAdmin, $nomAdmin, $emailAdmin, $mdpAdmin)
    {
        $this->idAdmin = $idAdmin;
        $this->nomAdmin = $nomAdmin;
        $this->emailAdmin = $emailAdmin;
        $this->mdpAdmin = $mdpAdmin;
    }

    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function getNomAdmin() {
        return $this->nomAdmin;
    }

    public function getEmailAdmin() {
        return $this->emailAdmin;
    }

    public function getMdpAdmin() {
        return $this->mdpAdmin;
    }
}
?>
