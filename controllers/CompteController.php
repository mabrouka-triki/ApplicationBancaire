

<?php

 //compteController.php
require_once __DIR__ . '/../models/Compte.php';
require_once __DIR__ . '/../lib/database.php';


class CompteController{

    private CompteRepository $compteRepository;
    public function __construct(){

        $this->compteRepository=new CompteRepository();
    }
    public function show()
    {
        $comptes = $this->compteRepository->getAllComptes();
        require_once __DIR__ . '/../views/Compte/compteList.php';

    }

 }

 ?>