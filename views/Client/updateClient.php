
<?php require_once __DIR__ . '/../templates/header_main.php'; ?>
<form action="?action=update" method="POST">
    <input type="hidden" name="id_client" value="<?= $client->getId() ?>">
    
    <div class="mb-3">
        <label for="nom_client" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom_client" name="nom_client" value="<?= $client->getNom() ?>" required>
    </div>

    <div class="mb-3">
        <label for="prenom_client" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="prenom_client" name="prenom_client" value="<?= $client->getPrenom() ?>" required>
    </div>

    <div class="mb-3">
        <label for="email_client" class="form-label">Email :</label>
        <input type="email" class="form-control" id="email_client" name="email_client" value="<?= $client->getEmail() ?>" required>
    </div>

    <div class="mb-3">
        <label for="telephone_client" class="form-label">Téléphone :</label>
        <input type="text" class="form-control" id="telephone_client" name="telephone_client" value="<?= $client->getTelephone() ?>" required>
    </div>

    <div class="mb-3">
    <label for="adresse" class="form-label">Adresse :</label>
    <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $client->getAdresse() ?>" required>
</div>


    <button type="submit" class="btn btn-primary">Modifier


</form>
