<?php
require_once __DIR__ . '/../Contrat.php';
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

    //Récupérer tous les contrats
    public function getAllContrats()
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM Contrat");
        $stmt->execute();
    
        $contratepository = new ContratRepository(); 
        $contrats = [];
        while ($row = $stmt->fetch()) {
            $contrat = new Contrat();
            $contrat->setId($row['id_contrat']);
            $contrat->setType($row['type_contrat']);
            $contrat->setMontant($row['montant_souscription_contrat']);
            $contrat->setDuree($row['duree_contrat']);
            $contrat->setIdClient($row['id_client']);
            $contrats[] = $contrat;
        }

        return $contrats;
    }

    public function getContrat($id)
    {
        $sql = "SELECT * FROM Contrat WHERE id = ?";
        $stmt = Database::prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $contrat = null;

        if ($row = $result->fetch_assoc()) {
            $contrat = new Contrat();
            $contrat->setId($row['id_contrat']);
            $contrat->setType($row['type_contrat']);
            $contrat->setMontant($row[' montant_souscription_contrat']);
            $contrat->setDuree($row['duree_contrat']);
            $contrat->setIdClient($row['id_client']);
        }   	 	
 	
        return $contrat;
    }


}
