
<?php require_once __DIR__ . '/templates/header_main.php'; ?>

<div class="container mt-5">
    <h2>Bienvenue dans le tableau de bord !</h2>
    <p>Bonjour, <?= $_SESSION['user_name'] ?> </p>

    <a href="?action=logout" class="btn btn-danger">Déconnexion</a>
</div>


