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

public function saveCompte(Compte $compte)
    {
        // Préparer la requête SQL pour insérer le compte
        $stmt = $this->connection->getConnection()->prepare("
            INSERT INTO Compte (RIB, type_compte, solde_intial, id_client)
            VALUES (:RIB, :type_compte, :solde_intial, :id_client)
        ");

        // Exécuter la requête avec les données du compte
        $stmt->execute([
            ':RIB' => $compte->getRIB(),
            ':type_compte' => $compte->getType(),
            ':solde_intial' => $compte->getSolde(),
            ':id_client' => $compte->getIdClient()
        ]);
    }
 
    public function getCompteById(int $id): ?Compte
{
    $stmt = $this->connection->getConnection()
        ->prepare("SELECT * FROM Compte WHERE id_compte = :id");
    $stmt->execute([':id' => $id]);

    $data = $stmt->fetch();
    if ($data) {
        $compte = new Compte();
        $compte->setId($data['id_compte']);
        $compte->setType($data['type_compte']);
        $compte->setSolde($data['solde_intial']);
        return $compte;
    }
    return null;
}


    public function update(Compte $compte): bool
{
    $stmt = $this->connection
        ->getConnection()
        ->prepare('UPDATE Compte 
                   SET type_compte = :type, solde_intial = :solde 
                   WHERE id_compte = :id');

    return $stmt->execute([
        ':type' => $compte->getType(),
        ':solde' => $compte->getSolde(),
        ':id' => $compte->getId()
    ]);
}

    public function delete(int $id): bool
{
    $stmt = $this->connection
        ->getConnection()
        ->prepare('DELETE FROM Compte WHERE id_compte = :id');

    return $stmt->execute([':id' => $id]);
}

}    