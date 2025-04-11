

<?php
// echo password_hash('Mabrouka', PASSWORD_DEFAULT);

session_start();
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ClientController.php';
require_once __DIR__ . '/controllers/CompteController.php';
require_once __DIR__ . '/controllers/ContratController.php';

$authController = new AuthController();
$clientController = new ClientController();
$compteController = new CompteController();
$contratController = new ContratController();


$action = $_GET['action'] ?? 'login'; // Action par défaut : 'login'

switch ($action) {
    // Authentification
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

    // Gestion des clients

    case 'clients':
        $clientController->show();
        break;
    case 'create':
        $clientController->create();
        break;
        case 'detailClient':
            if (isset($_GET['id'])) {
                $clientController->showClient((int)$_GET['id']);
            }
            break;
        
    case 'store':
        $clientController->store();
        break;
    case 'editClients':
        if (isset($_GET['id'])) {
            $clientController->edit((int)$_GET['id']);
        }
        break;
    case 'update':
        $clientController->update();
        break;
    case 'deleteClients':
        if (isset($_GET['id'])) {
            $clientController->delete($_GET['id']);
        }
        break;


    // Gestion des comptes
    case 'comptes':
        $compteController->show();
        break;
           
    case 'addCompte':
        $compteController->addCompte();  // Afficher le formulaire pour ajouter un compte
        break;

        case 'detailCompte':
            if (isset($_GET['id'])) {
                $compteController->showCompte((int)$_GET['id']);
            }

            break;
    case 'storeCompte':
        $compteController->storeCompte();  // Enregistrer le compte après soumission du formulaire
        break;
    case 'deleteCompte':
        $compteController->deleteCompte();  // Supprimer un compte
        break;
    case 'editCompte':
        if (isset($_GET['id'])) {
            $compteController->editCompte((int)$_GET['id']);  // Afficher le formulaire pour modifier un compte
        }
        break;
    case 'updateCompte':
        $compteController->updateCompte();  
        break;

      // Gestion des contrat

      case 'contrat':
        $contratController->show();
        break;


        case 'editContrat':
            if (isset($_GET['id'])) {
                $contratController->editContrat((int)$_GET['id']);  // Afficher le formulaire pour modifier un contrat
            
            }
            break;
        
            case 'updateContrat':
                $id = $_GET['id'] ?? null;  // Récupérer l'ID passé en paramètre
                if ($id) {
                    $contratController->editContrat($id);  //
                } else {
                    echo "ID du contrat manquant.";
                }
                break;

    default:
        echo "Action inconnue";
        break;
}
