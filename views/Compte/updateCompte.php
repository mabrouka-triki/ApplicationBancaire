<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2>Modifier un Compte</h2>

<form action="?action=updateCompte" method="POST">
    <input type="hidden" name="id_compte" value="<?= $compte->getId(); ?>">

    <div class="mb-3">
        <label for="type_compte" class="form-label">Type de compte</label>
        <select class="form-select" id="type_compte" name="type_compte" required>
            <option value="compte_courant" <?= $compte->getType() == 'compte_courant' ? 'selected' : ''; ?>>Compte courant</option>
            <option value="compte_epargne" <?= $compte->getType() == 'compte_epargne' ? 'selected' : ''; ?>>Compte épargne</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="solde_intial" class="form-label">Solde (€)</label>
        <input type="number" class="form-control" id="solde_intial" name="solde_intial" min="0" step="0.01" value="<?= $compte->getSolde(); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

