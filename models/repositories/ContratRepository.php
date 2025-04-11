<?php
require_once __DIR__ . '/../Contrat.php';
require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

class ContratRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function countContrats(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total FROM Contrat");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total'];
    }

    public function getAllContrats(): array
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM Contrat");
        $stmt->execute();

        $clientRepository = new ClientRepository();
        $contrats = [];

        while ($row = $stmt->fetch()) {
            $contrat = new Contrat();
            $contrat->setId($row['id_contrat']);
            $contrat->setType($row['type_contrat']);
            $contrat->setMontant($row['montant_souscription_contrat']);
            $contrat->setDuree((int)$row['duree_contrat']);
            $contrat->setIdClient($row['id_client']);

            // Récupération du client
            $client = $clientRepository->getClient($row['id_client']);
            if ($client) {
                $contrat->client = $client; // Attribut dynamique (comme pour compte)
            }

            $contrats[] = $contrat;
        }

        return $contrats;
    }

    public function saveContrat(Contrat $contrat): void
    {
        $stmt = $this->connection->getConnection()->prepare("
            INSERT INTO Contrat (type_contrat, montant_souscription_contrat, duree_contrat, id_client)
            VALUES (:type, :montant, :duree, :id_client)
        ");

        $stmt->execute([
            ':type' => $contrat->getType(),
            ':montant' => $contrat->getMontant(),
            ':duree' => $contrat->getDuree(),
            ':id_client' => $contrat->getIdClient()
        ]);
    }

    public function getContratById(int $id): ?Contrat
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM Contrat WHERE id_contrat = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();

        if ($row) {
            $contrat = new Contrat();
            $contrat->setId($row['id_contrat']);
            $contrat->setType($row['type_contrat']);
            $contrat->setMontant($row['montant_souscription_contrat']);
            $contrat->setDuree((int)$row['duree_contrat']);
            $contrat->setIdClient($row['id_client']);

            $client = $this->getClientById($row['id_client']);
            if ($client) {
                $contrat->setNom($client['nom_client']);
                $contrat->setPrenom($client['prenom_client']);
            }

            return $contrat;
        }

        return null;
    }

    public function getClientById(int $id): ?array
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT nom_client, prenom_client FROM Client WHERE id_client = :id");
        $stmt->execute([':id' => $id]);

        $client = $stmt->fetch();
        return $client ?: null;
    }

    public function update(Contrat $contrat): bool
    {
        $stmt = $this->connection->getConnection()->prepare("
            UPDATE Contrat 
            SET type_contrat = :type, montant_souscription_contrat = :montant, duree_contrat = :duree
            WHERE id_contrat = :id
        ");

        return $stmt->execute([
            ':type' => $contrat->getType(),
            ':montant' => $contrat->getMontant(),
            ':duree' => $contrat->getDuree(),
            ':id' => $contrat->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->connection->getConnection()->prepare("DELETE FROM Contrat WHERE id_contrat = :id");
        return $stmt->execute([':id' => $id]);
    }
}
