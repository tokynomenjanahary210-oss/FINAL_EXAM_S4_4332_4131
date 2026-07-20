<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon solde</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/client/dashboard">Mobile Money</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/client/dashboard">Solde</a>
            <a class="nav-link" href="/client/depot">Dépôt</a>
            <a class="nav-link" href="/client/retrait">Retrait</a>
            <a class="nav-link" href="/client/transfert">Transfert</a>
            <a class="nav-link" href="/client/historique">Historique</a>
            <a class="nav-link" href="/client/logout">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <h1>Mon solde</h1>

    <div class="card mt-4" style="max-width: 400px;">
        <div class="card-body text-center">
            <h5 class="card-title">Solde disponible</h5>
            <p class="card-text display-4 text-success"><?= number_format($client['balance']) ?> Ar</p>
            <p class="text-muted"><?= $client['phone_number'] ?></p>
        </div>
    </div>
</div>
</body>
</html>
