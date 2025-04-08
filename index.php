<?php
session_start();
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ClientController.php';

// echo password_hash('Mabrouka', PASSWORD_DEFAULT);

$authController = new AuthController();
$clientController = new clientController();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'doLogin':
        $authController->doLogin();
        break;
    case 'home':
        $authController->dashboard();
        break;
    case 'logout':
        $authController->logout();
        break;
        case 'logout':
            $authController->logout();
            break;

            case 'clients':
                $clientController->show();
                break;
            


}
