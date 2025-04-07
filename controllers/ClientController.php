
<?php

// ClientController.php
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../lib/database.php';

class ClientController
{
    public function getAllClients()
    {
        $db = getDbConnection();
        $stmt = $db->prepare("SELECT * FROM Client");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createClient(Client $client)
    {
        $db = getDbConnection();
        $stmt = $db->prepare("INSERT INTO Client (nom_client, prenom_client, email_client, mdp_client, telephone_client) 
                              VALUES (:nom, :prenom, :email, :mdp, :telephone)");

        $stmt->bindParam(':nom', $client->getNom());
        $stmt->bindParam(':prenom', $client->getPrenom());
        $stmt->bindParam(':email', $client->getEmail());
        $stmt->bindParam(':mdp', $client->getMdp());
        $stmt->bindParam(':telephone', $client->getTelephone());

        $stmt->execute();
    }

    // Plus de méthodes pour modifier, supprimer les clients
}
