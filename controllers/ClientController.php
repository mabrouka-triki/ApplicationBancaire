<?php

// ClientController.php

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../lib/database.php';

class ClientController
{
    private ClientRepository $clientRepository;

    // Constructeur de la classe
    public function __construct(){
        // Initialisation du repository pour interagir avec la base de données
        $this->clientRepository = new ClientRepository();
    }

    // Afficher la liste de tous les clients
    public function show()
    {
        // Récupère tous les clients
        $clients = $this->clientRepository->getAllClients();

        // Charge la vue pour afficher la liste des clients
        require_once __DIR__ . '/../views/Client/clientList.php';
    }

    // Afficher les détails d'un client spécifique
    public function showClient(int $id)
    {
        // Récupère les informations du client par son ID
        $client = $this->clientRepository->getClient($id);

        // Charge la vue pour afficher les détails du client
        require_once __DIR__ . '/../views/Client/VoirClient.php';
    }

    // Afficher le formulaire de création d'un nouveau client
    public function create()
    {  
        // Crée un objet client vide pour afficher le formulaire
        $client = new Client();

        // Charge la vue pour ajouter un nouveau client
        require_once __DIR__ . '/../views/Client/addClient.php';
    }

    // Sauvegarder un nouveau client dans la base de données
    public function store()
    {
        // Vérifie si tous les champs nécessaires sont présents dans la requête
        if (isset($_POST['nom_client'], $_POST['prenom_client'], $_POST['email_client'], $_POST['telephone_client'])) {

            // Validation de l'email
            $email = filter_input(INPUT_POST, 'email_client', FILTER_VALIDATE_EMAIL);
            if (!$email) {
                // Si l'email est invalide, redirige et affiche un message d'erreur
                $_SESSION['error'] = "L'email n'est pas valide.";
                header('Location: ?action=create');
                exit();
            }

            

            // Sécurisation des données reçues pour éviter les injections XSS
            $nom = htmlspecialchars($_POST['nom_client'], ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($_POST['prenom_client'], ENT_QUOTES, 'UTF-8');
            $telephone = htmlspecialchars($_POST['telephone_client'], ENT_QUOTES, 'UTF-8');
            $adresse = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse'], ENT_QUOTES, 'UTF-8') : '';

            // Création d'un objet Client avec les données soumises
            $client = new Client();
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setEmail($email);
            $client->setTelephone($telephone);
            $client->setAdresse($adresse);

            // Sauvegarde du client dans la base de données
            $this->clientRepository->create($client);

            // Message de succès et redirection vers la liste des clients
            $_SESSION['success'] = "Client ajouté avec succès.";
            header('Location: ?action=clients'); 
            exit();
        } else {
            // Si un champ est manquant, redirige et affiche un message d'erreur
            $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
            header('Location: ?action=create');
            exit();
        }
    }

    // Afficher le formulaire de modification d'un client
    public function edit(int $id)
    {
        // Récupère le client à modifier
        $client = $this->clientRepository->getClient($id);

        // Charge la vue pour mettre à jour les informations du client
        require_once __DIR__ . '/../views/Client/updateClient.php';
    }

    // Mettre à jour les informations d'un client
    public function update()
    {
        // Récupération des données envoyées par le formulaire
        $id = $_POST['id_client'] ?? null;
        $nom = $_POST['nom_client'] ?? '';
        $prenom = $_POST['prenom_client'] ?? '';
        $email = $_POST['email_client'] ?? '';
        $telephone = $_POST['telephone_client'] ?? '';
        $adresse = $_POST['adresse'] ?? '';

        // Vérification de la validité des informations
        if ($id && $nom && $prenom && $email && $telephone) {
            // Création d'un objet Client avec les nouvelles données
            $client = new Client();
            $client->setId($id);
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setEmail($email);
            $client->setTelephone($telephone);
            $client->setAdresse($adresse);

            // Mise à jour du client dans la base de données
            $this->clientRepository->update($client);
        }

        // Redirection vers la liste des clients après la mise à jour
        header('Location: ?action=clients');        
        exit;
    }

    // Supprimer un client de la base de données
    public function delete(int $id)
    {
        // Vérifie s'il y a des comptes ou contrats liés au client avant suppression
        $hasLinkedData = $this->clientRepository->hasAssociatedAccountsOrContracts($id);

        // Supprime le client et les données associées (comptes, contrats)
        if ($this->clientRepository->delete($id)) {
            $_SESSION['success'] = 'Client supprimé avec succès.';
            
            // Si des données associées ont été supprimées aussi, l'ajouter au message
            if ($hasLinkedData) {
                $_SESSION['success'] .= ' (Les comptes et contrats associés ont aussi été supprimés.)';
            }
        } else {
            // Si une erreur se produit lors de la suppression
            $_SESSION['error'] = 'Une erreur s\'est produite lors de la suppression du client.';
        }

        // Redirection vers la liste des clients après suppression
        header('Location: ?action=clients');
        exit;
    }
}
