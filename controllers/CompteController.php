

<?php


require_once __DIR__ . '/../models/Compte.php';
require_once __DIR__ . '/../lib/database.php';


class CompteController {

    private CompteRepository $compteRepository;
    private ClientRepository $clientRepository;

    public function __construct() {
        $this->compteRepository = new CompteRepository();
        $this->clientRepository = new ClientRepository(); // Instancier le repository des clients
    }

    // Affichage des comptes existants
    public function show() {
        $comptes = $this->compteRepository->getAllComptes();
        require_once __DIR__ . '/../views/Compte/compteList.php';
    }
  // plus en details


  public function showCompte(int $id)
    {
    $compte = $this->compteRepository->getCompteById($id);
    require_once __DIR__ . '/../views/Compte/VoirCompte.php';
    }


    // Affichage du formulaire pour ajouter un compte
    public function addCompte() {
        // Récupérer tous les clients existants pour les afficher dans le formulaire
        $clients = $this->clientRepository->getAllClients();
        require_once __DIR__ . '/../views/Compte/addCompte.php';  // Charge la vue pour ajouter un compte
    }

    // Méthode pour enregistrer un compte
    public function storeCompte() {
        // Vérification de l'existence des données dans $_POST
        if (!isset($_POST['RIB'], $_POST['type_compte'], $_POST['solde_intial'], $_POST['id_client'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            header('Location: ?action=addCompte');
            exit;
        }

        // Récupération des données du formulaire
        $RIB = $_POST['RIB'];
        $type = $_POST['type_compte'];
        $solde = $_POST['solde_intial'];
        $idClient = $_POST['id_client'];

        // Vérification que le solde est un nombre valide et supérieur ou égal à 0
        if ($solde < 0) {
            $_SESSION['error'] = "Le solde initial ne peut pas être négatif.";
            header('Location: ?action=addCompte');
            exit;
        }

        // Création d'un nouvel objet Compte
        $compte = new Compte();
        
        // Vérification que les valeurs ne sont pas nulles
        if ($RIB === null || $type === null || $idClient === null) {
            $_SESSION['error'] = "Les valeurs RIB, Type de compte et Client associé sont obligatoires.";
            header('Location: ?action=addCompte');
            exit;// Vous devez mettre la condition sur id_compte et non id_client
        }

        // Envoi des données à l'objet Compte
        $compte->setRIB($RIB);
        $compte->setType($type);
        $compte->setSolde($solde);
        $compte->setIdClient($idClient);

        // Enregistrement du compte dans la base de données
        $this->compteRepository->saveCompte($compte);

        // Message de succès
        $_SESSION['success'] = "Compte bancaire ajouté avec succès.";
        header('Location: ?action=comptes');
        exit;
    }


  // Affiche le formulaire de modification du compte
public function editCompte(int $id)
{
    $compte = $this->compteRepository->getCompteById($id);
    require_once __DIR__ . '/../views/Compte/updateCompte.php';
}


// Traite la mise à jour du compte
public function updateCompte()
{
    $id = $_POST['id_compte'] ?? null;
    $type = $_POST['type_compte'] ?? '';
    $solde = $_POST['solde_intial'] ?? null;

    if ($id && $type !== '' && $solde !== null) {
        $compte = new Compte();
        $compte->setId($id);
        $compte->setType($type);
        $compte->setSolde($solde);

        $this->compteRepository->update($compte);

        $_SESSION['success'] = "Compte modifié avec succès.";
    } else {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
    }

    header('Location: ?action=comptes');
    exit;
}
  
    
   
public function delete(int $clientId)
{
    // Supprimer les comptes et contrats associés (si existants) avant de supprimer le client
    if ($this->hasAssociatedAccountsOrContracts($clientId)) {
        $this->deleteAssociatedData($clientId);
    }

    // Supprimer le client
    if ($this->clientRepository->delete($clientId)) {
        $_SESSION['success'] = 'Client et ses données associées supprimés avec succès.';
    } else {
        $_SESSION['error'] = 'Une erreur s\'est produite lors de la suppression du client.';
    }

    header('Location: ?action=clients');
    exit;
}


    

}

?>