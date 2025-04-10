
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
    // plus en detail 

    public function showClient(int $id)
    {
    $client = $this->clientRepository->getClient($id);
    require_once __DIR__ . '/../views/Client/VoirClient.php';
    }

    public function create()
    {  
            $client = new Client();
            require_once __DIR__ . '/../views/Client/addClient.php';
        
    }
    public function store()
    {
        if (isset($_POST['nom_client'], $_POST['prenom_client'], $_POST['email_client'], $_POST['telephone_client'])) {
            // Validation de l'email
            $email = filter_input(INPUT_POST, 'email_client', FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $_SESSION['error'] = "L'email n'est pas valide.";
                header('Location: ?action=create');
                exit();
            }
    
            // Assainir les données obligatoires
            $nom = htmlspecialchars($_POST['nom_client'], ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($_POST['prenom_client'], ENT_QUOTES, 'UTF-8');
            $telephone = htmlspecialchars($_POST['telephone_client'], ENT_QUOTES, 'UTF-8');
    
            // L'adresse peut être vide
            $adresse = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse'], ENT_QUOTES, 'UTF-8') : '';
    
            // Créer un client
            $client = new Client();
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setEmail($email);
            $client->setTelephone($telephone);
            $client->setAdresse($adresse); // même si vide, c’est ok
    
            // Sauvegarder le client
            $this->clientRepository->create($client);
    
            $_SESSION['success'] = "Client ajouté avec succès.";
            header('Location: ?action=clients'); // rediriger vers la liste ?
            exit();
        } else {
            $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
            header('Location: ?action=create');
            exit();
        }
    }
    

  public function edit(int $id)
{
    $client = $this->clientRepository->getClient($id);
    require_once __DIR__ . '/../views/Client/updateClient.php';
}


    public function update()
    {
        $id = $_POST['id_client'] ?? null;
        $nom = $_POST['nom_client'] ?? '';
        $prenom = $_POST['prenom_client'] ?? '';
        $email = $_POST['email_client'] ?? '';
        $telephone = $_POST['telephone_client'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        if ($id && $nom && $prenom && $email && $telephone) {
            $client = new Client();
            $client->setId($id);
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setEmail($email);
            $client->setTelephone($telephone);
            $client->setAdresse($adresse);

            $this->clientRepository->update($client);
        }
    
        header('Location: ?action=clients');        
        exit;
    }

 
    public function delete(int $id)
    {
        if ($this->clientRepository->hasAssociatedAccountsOrContracts($id)) {
            $_SESSION['error'] = 'Ce client ne peut pas être supprimé car il possède des comptes ou des contrats associés.';
        } else {
            if ($this->clientRepository->delete($id)) {
                $_SESSION['success'] = 'Client supprimé avec succès.';
            } else {
                $_SESSION['error'] = 'Une erreur s\'est produite lors de la suppression du client.';
            }
        }
    
        header('Location: ?action=clients');
        exit;
    }
    

      
    }


