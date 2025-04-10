<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2 class="mb-4">📋 Liste des contrats</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Type de contrat</th>
                <th>Montant</th>
                <th>Durée</th>
                <th>Nom du client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contrats as $contrat): 
                // Récupérer le client associé au contrat
                $client = $this->clientRepository->getClient($contrat->getIdClient()); 
            ?>
                <tr>
                    <td><?= htmlspecialchars($contrat->getId()); ?></td>
                    <td><?= htmlspecialchars($contrat->getType()); ?></td>
                    <td><?= number_format($contrat->getMontant(), 2, ',', ' '); ?> €</td>
                    <td><?= htmlspecialchars($contrat->getDuree()); ?></td>
                    <td><?= htmlspecialchars($client->getNom()) . ' ' . htmlspecialchars($client->getPrenom()); ?></td> 
                    <td>
                        <a href="?action=updateContrat&id=<?= $contrat->getId(); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?action=deleteContrat&id=<?= $contrat->getId(); ?>" class="btn btn-danger btn-sm">Supprimer</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
