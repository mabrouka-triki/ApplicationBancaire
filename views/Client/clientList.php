<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<!-- Affichage du message de succès si défini -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<!-- Affichage du message d'erreur si défini -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

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
                <th>Adresse</th>
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
                    <td><?= $client->getAdresse() ?></td>
                    <td>
                        <a href="?action=editClients&id=<?= $client->getId() ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?action=deleteClients&id=<?= $client->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                        <a href="?action=detailClient&id=<?= $client->getId(); ?>" class="btn btn-info btn-sm">Voir</a>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
