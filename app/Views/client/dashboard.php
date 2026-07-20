<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon solde</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/client/dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone me-2" viewBox="0 0 16 16">
                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            </svg>
            Mobile Money
        </a>
        <div class="navbar-nav">
            <a class="nav-link active" href="/client/dashboard">Solde</a>
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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h1 class="fw-bold mb-4">Mon solde</h1>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0 text-center">
                <div class="card-body p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-wallet2 text-success mb-3" viewBox="0 0 16 16">
                        <path d="M12.138.123A.5.5 0 0 0 11.928-.002L13.028 1.58a.5.5 0 0 0 .854-.353L13.766.454a.5.5 0 0 0-.394-.786H13.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.338a.5.5 0 0 0 .354-.353l1.414-1.414a.5.5 0 0 0-.353-.854zM2.5 3A1.5 1.5 0 0 0 1 4.5v7A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 3h-11z"/>
                    </svg>
                    <h5 class="card-title text-muted">Solde disponible</h5>
                    <p class="card-text display-4 fw-bold text-success"><?= number_format($client['balance']) ?> Ar</p>
                    <p class="text-muted"><?= $client['phone_number'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
