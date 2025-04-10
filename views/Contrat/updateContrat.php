<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2>Modifier un Contrat</h2>

<form action="?action=updateContrat" method="POST">
    <input type="hidden" name="id_contrat" value="<?= $contrat->getId(); ?>">

  <div class="mb-3">
 <input type="text" name="id_contrat" value="<?= $contrat->getNom(); ?>">
</div>

    <div class="mb-3">
        <label for="montant_contrat" class="form-label">Montant souscrit (€)</label>
        <input type="number" class="form-control" id="montant_contrat" name="montant_contrat" min="0" step="0.01" value="<?= $contrat->getMontant(); ?>" required>
    </div>

    <div class="mb-3">
        <label for="duree_contrat" class="form-label">Durée (en mois)</label>
        <input type="number" class="form-control" id="duree_contrat" name="duree_contrat" min="1" value="<?= $contrat->getDuree(); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
