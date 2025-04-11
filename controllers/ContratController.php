<?php
require_once __DIR__ . '/../models/Contrat.php';
require_once __DIR__ . '/../lib/database.php';

class ContratController
{
    private ContratRepository $contratRepository;
    private ClientRepository $clientRepository;

    public function __construct()
    {
        $this->contratRepository = new ContratRepository();
        $this->clientRepository = new ClientRepository();
    }

    // Afficher la liste des contrats
    public function show()
    {
        $contrats = $this->contratRepository->getAllContrats();
        require_once __DIR__ . '/../views/Contrat/ContratList.php';
    }

    // Détails d'un contrat
    public function showContrat(int $id)
    {
        $contrat = $this->contratRepository->getContratById($id);
        if (!$contrat) {
            $_SESSION['error'] = "Contrat introuvable.";
            header('Location: ?action=contrats');
            exit;
        }
        require_once __DIR__ . '/../views/Contrat/voirContrat.php';
    }

    // Afficher le formulaire pour ajouter un contrat
    public function addContrat()
    {
        $clients = $this->clientRepository->getAllClients();
        require_once __DIR__ . '/../views/Contrat/addContrat.php';
    }

    // Enregistrer un nouveau contrat
    public function storeContrat()
    {
        if (!isset($_POST['type_contrat'], $_POST['montant_souscription_contrat'], $_POST['duree_contrat'], $_POST['id_client'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            header('Location: ?action=addContrat');
            exit;
        }

        $type = $_POST['type_contrat'];
        $montant = $_POST['montant_souscription_contrat'];
        $duree = $_POST['duree_contrat'];
        $idClient = $_POST['id_client'];

        if ($montant < 0 || !is_numeric($montant)) {
            $_SESSION['error'] = "Le montant ne peut pas être négatif ou invalide.";
            header('Location: ?action=addContrat');
            exit;
        }

        if (!is_numeric($duree) || $duree < 0) {
            $_SESSION['error'] = "La durée doit être un nombre valide.";
            header('Location: ?action=addContrat');
            exit;
        }

        $contrat = new Contrat();
        $contrat->setType($type);
        $contrat->setMontant($montant);
        $contrat->setDuree($duree);
        $contrat->setIdClient($idClient);

        $this->contratRepository->saveContrat($contrat);

        $_SESSION['success'] = "Contrat ajouté avec succès.";
        header('Location: ?action=contrats');
        exit;
    }

    // Afficher le formulaire pour modifier un contrat
    public function editContrat(int $id)
    {
        // Vérifier si le contrat existe
        $contrat = $this->contratRepository->getContratById($id);
        
        if (!$contrat) {
            $_SESSION['error'] = "Contrat introuvable.";
            header('Location: ?action=contrat');
            exit;
        }
    
        require_once __DIR__ . '/../views/Contrat/updateContrat.php';
    }
    

    // Mettre à jour un contrat
    public function updateContrat()
    {
        $id = $_POST['id_contrat'] ?? null;
        $type = $_POST['type_contrat'] ?? '';
        $montant = $_POST['montant_souscription_contrat'] ?? null;
        $duree = $_POST['duree_contrat'] ?? null;

        if ($id && $type !== '' && $montant !== null && $duree !== null) {
            $contrat = new Contrat();
            $contrat->setId($id);
            $contrat->setType($type);
            $contrat->setMontant($montant);
            $contrat->setDuree($duree);

            $this->contratRepository->update($contrat);

            $_SESSION['success'] = "Contrat modifié avec succès.";
        } else {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
        }

        header('Location: ?action=contrats');
        exit;
    }

    // Supprimer un contrat
    public function deleteContrat(int $id)
    {
        if ($this->contratRepository->delete($id)) {
            $_SESSION['success'] = "Contrat supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la suppression du contrat.";
        }

        header('Location: ?action=contrat');
        exit;
    }
}
