<?php require_once __DIR__ . '/templates/header_main.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Bienvenue dans le tableau de bord !</h2>
    <p class="text-center">Bienvenue, <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?></p>
  
    <div class="row">

    <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title mb-4">📋 Nombre total de clients</h5>
                    <p class="display-4 text-primary"><strong><?= $totalClients ?></strong></p>
                    <a href="?action=clients" class="btn btn-primary w-100">Voir les clients</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-success">
                <div class="card-body text-center">
                    <h5 class="card-title mb-4">📊 Nombre total de comptes ouverts</h5>
                    <p class="display-4 text-success"><strong><?= $totalComptes ?></strong></p>
                    <a href="?action=comptes" class="btn btn-success w-100">Voir les comptes</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-warning">
                <div class="card-body text-center">
                    <h5 class="card-title mb-4">🔗 Nombre total de contrats souscrits</h5>
                    <p class="display-4 text-warning"><strong><?= $totalContrats ?></strong></p>
                    <a href="?action=contrat" class="btn btn-warning w-100">Voir les contrats</a>
                </div>
            </div>
        </div>
    </div>
</div>
