
<?php require_once __DIR__ . '/templates/header_main.php'; ?>

<div class="container mt-5">
    <h2>Bienvenue dans le tableau de bord !</h2>
    <p>Bonjour, <?= $_SESSION['user_name'] ?> </p>
  
    <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>📋 Description</th>
            <th>📊 Total</th>
            <th>🔗 Accès rapide</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nombre total de clients enregistrés</td>
            <td><strong><?= $totalClients ?></strong></td>
            <td><a href="?action=clients&id? $client->getId()?> "class= "btn btn-primary btn-sm">Voir les clients</a></td>
            </tr>          
        <tr>
            <td>Nombre total de comptes ouverts</td>
            <td><strong><?= $totalComptes ?></strong></td>
            <td><a href="?action=comptes" class="btn btn-success btn-sm">Voir les comptes</a></td>
        </tr>
        <tr>
            <td>Nombre total de contrats souscrits</td>
            <td><strong><?= $totalContrats ?></strong></td>
            <td><a href="?action=contrats" class="btn btn-warning btn-sm">Voir les contrats</a></td>
        </tr>
    </tbody>
</table>





</div>


