<?php
require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

class ClientRepository
{
    private ClientRepository $clientRepository;
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function countClients(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total FROM Client");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total'];
    }
 

    // affichage de clients 
    public function getClient(int $id): ?Client
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM Client WHERE id_client=:id_client");
        $statement->execute(['id_client' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $client = new Client();
        $client->setId($result['id_client']);
        $client->setNom($result['nom_client']);
        $client->setPrenom($result['prenom_client']);
        $client->setEmail($result['email_client']);
        $client->setTelephone($result['telephone_client']);
        $client->setAdresse($result['adresse']);

  
        return $client;
    }

    public function getAllClients(): array
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM Client");
        $stmt->execute();
        $clients = [];
    
        while ($row = $stmt->fetch()) {
            $client = new Client();
            $client->setId($row['id_client']);
            $client->setNom($row['nom_client']);
            $client->setPrenom($row['prenom_client']);
            $client->setEmail($row['email_client']);
            $client->setTelephone($row['telephone_client']);
            $client->setAdresse($row['adresse']);
            $clients[] = $client;
        }
    
        return $clients;
    }
    // ajouter un client 
    public function create(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO Client (nom_client, prenom_client, email_client, telephone_client,adresse) 
                       VALUES (:nom_client, :prenom_client, :email_client, :telephone_client,:adresse);');
    
        return $statement->execute([
            'nom_client' => $client->getNom(),
            'prenom_client' => $client->getPrenom(),
            'email_client' => $client->getEmail(),
            'telephone_client' => $client->getTelephone(),
            'adresse' => $client->getAdresse()
            
        ]);
    }

   

    public function update(Client $client): bool
    {
        $statement = $this->connection
        ->getConnection()
        ->prepare('UPDATE Client 
                   SET nom_client = :nom_client, prenom_client = :prenom_client, email_client = :email_client, telephone_client = :telephone_client, adresse = :adresse
                   WHERE id_client = :id');
    
    
        return $statement->execute([
            'nom_client' => $client->getNom(),
            'prenom_client' => $client->getPrenom(),
            'email_client' => $client->getEmail(),
            'telephone_client' => $client->getTelephone(),
            'adresse' => $client->getAdresse(),

            'id' => $client->getId()
        ]);
    }
    
    // Méthode pour vérifier si un client a des comptes ou contrats associés
    public function hasAssociatedAccountsOrContracts(int $clientId): bool
    {
        // Vérifier s'il existe des comptes associés
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) FROM Compte WHERE id_client = :id_client");
        $stmt->execute(['id_client' => $clientId]);
        $accountCount = $stmt->fetchColumn();

        // Vérifier s'il existe des contrats associés
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) FROM Contrat WHERE id_client = :id_client");
        $stmt->execute(['id_client' => $clientId]);
        $contractCount = $stmt->fetchColumn();

        // Retourner true si des comptes ou contrats existent
        return $accountCount > 0 || $contractCount > 0;
    }

    // Méthode pour supprimer un client
    public function delete(int $clientId): bool
    {
        // Vérifier s'il a des comptes ou contrats associés
        if ($this->hasAssociatedAccountsOrContracts($clientId)) {
            return false; // Le client ne peut pas être supprimé
        }

        // Supprimer le client si aucun compte ou contrat associé
        $stmt = $this->connection->getConnection()->prepare("DELETE FROM Client WHERE id_client = :id_client");
        return $stmt->execute(['id_client' => $clientId]);
    }
    
    

}
