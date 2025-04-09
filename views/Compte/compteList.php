<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<!-- Message de succès -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<!-- Message d'erreur -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2>Liste des Comptes</h2>

 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>RIB</th>
                    <th>Type de compte</th>
                    <th>Solde (€)</th>
                    <th>Client associé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr>
                        <td><?= $compte->getId(); ?></td>
                        <td><?= htmlspecialchars($compte->getRIB()); ?></td>
                        <td><?= htmlspecialchars($compte->getType()); ?></td>
                        <td><?= number_format($compte->getSolde(), 2); ?> €</td>
                        <td>
                            <?= htmlspecialchars($compte->client->getNom()) . ' ' . htmlspecialchars($compte->client->getPrenom()); ?>
                        </td>
                        <td>
                            <a href="?action=editCompte&id=<?= $compte->getId(); ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="?action=deleteCompte&id=<?= $compte->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce compte ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


