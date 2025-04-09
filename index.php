<?php
session_start();
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ClientController.php';
require_once __DIR__ . '/controllers/CompteController.php';

// echo password_hash('Mabrouka', PASSWORD_DEFAULT);

$authController = new AuthController();
$clientController = new clientController();
$compteController = new CompteController();

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
        
        case 'create':
        $clientController->create();
        break;
        case 'store':
        $clientController->store();
         break;

         case 'editClients':
            if (isset($_GET['id'])) {
                $clientController->edit((int) $_GET['id']);
            } 
            break;
        
        case 'update':
            $clientController->update();
            break;
            
            case 'deleteClients':
                // Vérifie que l'URL contient bien l'ID du client
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $clientController->delete($id);
                }
                break;

                case 'comptes':
                    $compteController->show();
                   break;

                   case 'addCompte':
                    $compteController->addCompte();  // Afficher le formulaire pour ajouter un compte
                    break;
                case 'storeCompte':
                    $compteController->storeCompte();  // Enregistrer le compte après soumission du formulaire
                    break;
                    
                    case 'deleteCompte':
                        $compteController->deleteCompte();
                        break;

              default:
                // Si l'action n'est pas reconnue, rediriger vers la page d'accueil ou une page d'erreur
                echo "Action inconnue";
                break;

}
