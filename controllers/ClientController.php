
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
    public function create()
    {  
            $client = new Client();
            require_once __DIR__ . '/../views/Client/addClient.php';
        
    }
    public function store()
    {
        if (isset($_POST['nom_client'], $_POST['prenom_client'], $_POST['email_client'], $_POST['telephone_client'])) {
            // Validation des données
            $email = filter_input(INPUT_POST, 'email_client', FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $_SESSION['error'] = "L'email n'est pas valide.";
                header('Location: ?action=create');
                exit();
            }
    
            // Assainir les données
            $nom = htmlspecialchars($_POST['nom_client'], ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($_POST['prenom_client'], ENT_QUOTES, 'UTF-8');
            $telephone = htmlspecialchars($_POST['telephone_client'], ENT_QUOTES, 'UTF-8');
    
            // Créer un client
            $client = new Client();
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setEmail($email);
            $client->setTelephone($telephone);
    
            // Sauvegarder le client
            $this->clientRepository->create($client);
    
            // Rediriger
            header('Location: ?action=create');
            exit();
        } else {
            $_SESSION['error'] = "Veuillez remplir tous les champs.";
            header('Location: ?action=create');
            exit();
        }
    }
      
    }


