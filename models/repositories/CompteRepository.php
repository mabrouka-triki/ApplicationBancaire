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

    public function countComptes(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total FROM Compte");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total'];
    }
}
