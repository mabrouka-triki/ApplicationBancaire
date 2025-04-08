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
}
