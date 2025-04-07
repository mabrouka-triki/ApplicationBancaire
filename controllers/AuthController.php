<?php
// AuthController.php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../lib/database.php';

class AuthController
{
    public function login(string $email, string $password)
    {
        $db = getDbConnection();
        $stmt = $db->prepare("SELECT * FROM Admin WHERE email_admin = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['mdp_admin'])) {
            $_SESSION['role'] = 'admin';
            $_SESSION['user_id'] = $admin['id_admin'];
            $_SESSION['user_email'] = $admin['email_admin'];
            header("Location: home.php"); // Rediriger vers le tableau de bord
        } else {
            echo "Identifiants invalides!";
        }
    }
}

?>
