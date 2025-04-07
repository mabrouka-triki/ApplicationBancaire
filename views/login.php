<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php
// Affichage d'un message d'erreur en cas de problème de connexion
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Supprimer le message après l'avoir affiché
}
?>

<form action="login_action.php" method="POST">
    <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input class="form-control" type="text" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input class="form-control" type="password" name="password" required>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
