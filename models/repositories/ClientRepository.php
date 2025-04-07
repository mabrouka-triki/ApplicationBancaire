
<?php
require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

class ClientRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }


    public function countClients(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM Client");
        return (int) $stmt->fetchColumn();
    }
}


