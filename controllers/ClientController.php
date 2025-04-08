
<?php

// ClientController.php
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../lib/database.php';

class ClientController
{
    private ClientRepository $clientRepository;
    public function __construct(){

        $this->clientRepository=new ClientRepository();
    }
    public function show()
    {
        $clients = $this->clientRepository->getAllClients();

        require_once __DIR__ . '/../views/Client/clientList.php';
    }
}

