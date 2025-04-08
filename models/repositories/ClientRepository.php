<?php
require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

class ClientRepository
{
    private TaskRepository $taskRepository;
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
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM Client WHERE id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $client = new Client();
        $client->setId($result['id_client']);
        $client->setNom($result['nom']);
        $client->setPrenom($result['prenom']);
        $client->setEmail($result['email']);
        $client->setTelephone($result['telephone']);

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
            $clients[] = $client;
        }
    
        return $clients;
    }
    // ajouter un client 
    public function create(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO Client (nom_client, prenom_client, email_client, telephone_client) 
                       VALUES (:nom_client, :prenom_client, :email_client, :telephone_client)');
    
        return $statement->execute([
            'nom_client' => $client->getNom(),
            'prenom_client' => $client->getPrenom(),
            'email_client' => $client->getEmail(),
            'telephone_client' => $client->getTelephone()
        ]);
    }
    

}
