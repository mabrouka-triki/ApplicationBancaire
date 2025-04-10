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
        $contrat = $this->contratRepository->getContrat($id);
        require_once __DIR__ . '/../views/Contrat/voirContrat.php';
    }


      // Afficher le formulaire de modification d'un contrat
      public function editContrat(int $id)
      {
          // Récupérer le contrat existant
          $contrat = $this->contratRepository->getContrat($id);
          
          // Afficher le formulaire avec les données du contrat
          require_once __DIR__ . '/../views/Contrat/updateContrat.php'; 
      }

         // Mettre à jour les informations du contrat
    public function updateContrat()
    {
        if (isset($_POST['id_contrat'], $_POST['montant_contrat'], $_POST['duree_contrat'])) {
            $id = $_POST['id_contrat'];
            $montant = $_POST['montant_contrat'];
            $duree = $_POST['duree_contrat'];

            // Créer une instance du contrat et définir ses propriétés
            $contrat = new Contrat();
            $contrat->setId($id);
            $contrat->setMontant($montant);
            $contrat->setDuree($duree);

            // Sauvegarder les changements en base de données
            $this->contratRepository->update($contrat);

            $_SESSION['success'] = "Le contrat a été mis à jour avec succès.";
            header('Location: ?action=contrats'); // Redirection vers la liste des contrats
            exit();
        } else {
            $_SESSION['error'] = "Les informations sont invalides.";
            header('Location: ?action=editContrat&id=' . $_POST['id_contrat']);  
            exit();
        }
    }

}

    
