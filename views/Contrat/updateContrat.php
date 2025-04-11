<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2>Modifier un Contrat</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error']); ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="?action=updateContrat" method="POST">
    <input type="hidden" name="id_contrat" value="<?= htmlspecialchars($contrat->getId()); ?>">

    <div class="mb-3">
        <p>Nom du client : <?= htmlspecialchars($contrat->getNom()); ?></p>  
    </div>

    <div class="mb-3">
        <p>Prénom du client : <?= htmlspecialchars($contrat->getPrenom()); ?></p> 
    </div>

    <div class="mb-3">
        <label for="montant_contrat" class="form-label">Montant souscrit (€)</label>
        <input type="number" class="form-control" name="montant_souscription_contrat" value="<?= htmlspecialchars($contrat->getMontant()); ?>" required>
    </div>

    <div class="mb-3">
        <label for="duree_contrat" class="form-label">Durée (en mois)</label>
        <input type="number" class="form-control" name="duree_contrat" value="<?= htmlspecialchars($contrat->getDuree()); ?>" required>
    </div>

    <div class="mb-3">
        <label for="type_contrat" class="form-label">Type de contrat</label>
        <input type="text" class="form-control" name="type_contrat" value="<?= htmlspecialchars($contrat->getType()); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
