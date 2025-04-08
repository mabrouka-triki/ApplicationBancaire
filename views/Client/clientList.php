<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<div class="container mt-5">
    <h2>Liste des clients</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro client</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= $client->getId() ?></td>
                    <td><?= $client->getNom() ?></td>
                    <td><?= $client->getPrenom() ?></td>
                    <td><?= $client->getEmail() ?></td>
                    <td><?= $client->getTelephone() ?></td>
                    <td>
                        <a href="?action=editClients&id=<?= $client->getId() ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?action=deleteClients&id=<?= $client->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                        <a href="?action=voirDossier&id=<?= $client->getId() ?>" class="btn btn-info btn-sm">Voir dossier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
