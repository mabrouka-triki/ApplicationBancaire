
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


    public function countClients(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM Contrat");
        return (int) $stmt->fetchColumn();
    }
}


