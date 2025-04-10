<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2 class="mb-4">🏦 Détail du compte</h2>

<div class="card p-4 shadow-sm">
    <p><strong>Type de compte : </strong> <?= htmlspecialchars($compte->getType()) ?></p>
    <p><strong>Solde initial : </strong> <?= number_format($compte->getSolde(), 2, ',', ' ') ?> €</p>

    <?php if (isset($client) && $client !== null): ?>
        <hr>
        <p><strong>Nom du client : </strong> <?= htmlspecialchars($client->getNom()) ?> <?= htmlspecialchars($client->getPrenom()) ?></p>
        <p><strong>Email : </strong> <?= htmlspecialchars($client->getEmail()) ?></p>
        <p><strong>Téléphone : </strong> <?= htmlspecialchars($client->getTelephone()) ?></p>
    <?php endif; ?>
</div>

<div class="mt-4">
    <a href="?action=editCompte&id=<?= $compte->getId() ?>" class="btn btn-warning">Modifier le compte</a>
    <a href="?action=comptes" class="btn btn-secondary">Retour à la liste</a>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
