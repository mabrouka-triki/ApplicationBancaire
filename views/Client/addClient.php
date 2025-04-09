<?php require_once __DIR__ . '/../templates/header_main.php'; ?>

<h2 class="mb-4">⊕ Ajouter un client</h2>

<form action="?action=store" method="POST">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom_client" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom_client" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" class="form-control" id="email" name="email_client" required>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label>
        <input type="text" class="form-control" id="telephone" name="telephone_client" required>
    </div>

    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse  :</label>
        <input type="text" class="form-control" id="adresse" name="adresse" required>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<a href="?action=clients" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
