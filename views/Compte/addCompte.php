<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2>Créer un Compte Bancaire</h2>

<form action="?action=storeCompte" method="POST">
    <div class="mb-3">
        <label for="RIB" class="form-label">RIB :</label>
        <input type="text" class="form-control" id="RIB" name="RIB" required>
    </div>

    <div class="mb-3">
        <label for="type_compte" class="form-label">Type de compte :</label>
        <select class="form-select" id="type_compte" name="type_compte" required>
            <option value="compte courant">Compte courant</option>
            <option value="compte epargne">Compte épargne</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="solde_intial" class="form-label">Solde initial (€) :</label>
        <input type="number" class="form-control" id="solde_intial" name="solde_intial" required min="0" step="0.01">
    </div>

    <div class="mb-3">
        <label for="id_client" class="form-label">Client associé :</label>
        <select class="form-select" id="id_client" name="id_client" required>
            <?php foreach ($clients as $client): ?>
                <option value="<?= $client->getId(); ?>">
                    <?= htmlspecialchars($client->getNom()) . ' ' . htmlspecialchars($client->getPrenom()); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter le compte</button>

</form>
