

<?php
// home.php
require_once __DIR__ . '/lib/utils.php'; 

// Vérifier si l'utilisateur est connecté et a un rôle d'admin
isConnected();
isAdmin(); // Cette fonction va rediriger l'utilisateur si ce n'est pas un admin

// Code de ton tableau de bord
echo "Bienvenue sur votre tableau de bord d'administration!";
?>
