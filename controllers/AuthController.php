<?php
require_once __DIR__ . '/../models/repositories/AdminRepository.php';  
require_once __DIR__ . '/../models/Admin.php'; 


class AuthController
{
    private AdminRepository $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    // Affichage du formulaire de connexion
    public function login()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    // Traitement de la connexion
    public function doLogin()
{
    // Vérification de la présence de données avant de les utiliser
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);  // Validation de l'email
    $password = filter_input(INPUT_POST, 'password');

    // Vérification si les variables ne sont pas nulles et que l'email est valide
    if (!$email || !$password) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs.';
        header('Location: ?action=login');
        exit;
    }

    // Recherche de l'admin dans la base de données par email
    $admin = $this->adminRepository->getAdminByEmail($email);

    // Vérification du mot de passe
    if ($admin && password_verify($password, $admin->getMdpAdmin())) {
        // Authentification réussie, stocker les infos dans la session
        $_SESSION['role'] = 'admin'; // Rôle admin
        $_SESSION['user_id'] = $admin->getIdAdmin(); // ID de l'admin
        $_SESSION['user_name'] = $admin->getNomAdmin(); // nom de l'admin
        
        // Redirection vers la page d'accueil 
        header('Location: ?action=home');
        exit;
    } else {
        // Si l'authentification échoue, redirigez vers la page de connexion avec un message d'erreur
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        header('Location: ?action=login');
        exit;
    }
}


    // Page d'accueil (tableau de bord)
    public function dashboard()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ?action=login');
            exit;
        }

        require_once __DIR__ . '/../views/home.php';
    }

    // Déconnexion
    public function logout()
    {
        session_destroy();
        header('Location: ?');
        exit;
    }
}
