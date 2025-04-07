<?php
session_start();
// echo password_hash('Mabrouka', PASSWORD_DEFAULT);

require_once __DIR__ . '/controllers/AuthController.php';

$authController = new AuthController();

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
}
