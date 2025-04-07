<?php

require_once __DIR__ . '/../Admin.php';
require_once __DIR__ . '/../../lib/database.php';

class AdminRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        // Vérification si l'email est valide
        if (empty($email)) {
            return null;
        }
    
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM Admin WHERE email_admin = :email');
        $statement->execute(['email' => $email]);
        $result = $statement->fetch();
    
        if (!$result) {
            return null;
        }
    
        $admin = new Admin($result['id_admin'], $result['nom_admin'], $result['email_admin'], $result['mdp_admin']);
    
        return $admin;
    }
    
}
?>

