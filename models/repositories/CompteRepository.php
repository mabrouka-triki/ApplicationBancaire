<?php
require_once __DIR__ . '/../Compte.php';
require_once __DIR__ . '/../Client.php';

require_once __DIR__ . '/../../lib/database.php';

class CompteRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function countComptes(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total FROM Compte");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total'];
    }
   
    // Récupérer tous les comptes avec info client associée
    public function getAllComptes(): array
{
    $stmt = $this->connection->getConnection()->prepare("SELECT * FROM Compte");
    $stmt->execute();

    $clientRepository = new ClientRepository(); // Charger les clients séparément
    $comptes = [];

    while ($row = $stmt->fetch()) {
        $compte = new Compte();
        $compte->setId($row['id_compte']);
        $compte->setRIB($row['RIB']);
        $compte->setType($row['type_compte']);
        $compte->setSolde($row['solde_intial']);
        $compte->setIdClient($row['id_client']);

        // Récupération du client lié au compte via le repo
        $client = $clientRepository->getClient($row['id_client']);
        if ($client) {
            $compte->client = $client; // Attribut dynamique
        }

        $comptes[] = $compte;
    }

    return $comptes;
}

    
}
