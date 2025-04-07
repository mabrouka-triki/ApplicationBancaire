
<?php
require_once __DIR__ . '/../Compte.php';
require_once __DIR__ . '/../../lib/database.php';

class CompteRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function countClients(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM Compte");
        return (int) $stmt->fetchColumn();
    }
}


