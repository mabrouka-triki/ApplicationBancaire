<?php
require_once __DIR__ . '/../models/repositories/AdminRepository.php';  
require_once __DIR__ . '/../models/repositories/ClientRepository.php';  
require_once __DIR__ . '/../models/repositories/CompteRepository.php';  
require_once __DIR__ . '/../models/repositories/ContratRepository.php';  
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
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (!$email || !$password) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header('Location: ?action=login');
            exit;
        }

        $admin = $this->adminRepository->getAdminByEmail($email);

        if ($admin && password_verify($password, $admin->getMdpAdmin())) {
            $_SESSION['user_id'] = $admin->getIdAdmin();
            $_SESSION['user_name'] = $admin->getNomAdmin();
            header('Location: ?action=home');
            exit;
        } else {
            $_SESSION['error'] = 'Email ou mot de passe incorrect';
            header('Location: ?action=login');
            exit;
        }
    }

    // Tableau de bord
    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit;
        }

        $clientRepo = new ClientRepository();
        $compteRepo = new CompteRepository();
        $contratRepo = new ContratRepository();

        $totalClients = $clientRepo->countClients();
        $totalComptes = $compteRepo->countComptes();
        $totalContrats = $contratRepo->countContrats();

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
