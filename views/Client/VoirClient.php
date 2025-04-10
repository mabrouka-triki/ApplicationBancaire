<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2 class="mb-4">👤 Détail du client</h2>

<div class="card p-4 shadow-sm">
    <p><strong>Nom : </strong> <?= htmlspecialchars($client->getNom()) ?></p>
    <p><strong>Prénom : </strong> <?= htmlspecialchars($client->getPrenom()) ?></p>
    <p><strong>Email : </strong> <?= htmlspecialchars($client->getEmail()) ?></p>
    <p><strong>Téléphone : </strong> <?= htmlspecialchars($client->getTelephone()) ?></p>
    <p><strong>Adresse : </strong> <?= $client->getAdresse() ? htmlspecialchars($client->getAdresse()) : "<em>Aucune adresse fournie</em>" ?></p>
</div>

<div class="mt-4">
    <a href="?action=editClients&id=<?= $client->getId() ?>" class="btn btn-warning">Modifier le client</a>
    <a href="?action=clients" class="btn btn-secondary">Retour à la liste</a>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
