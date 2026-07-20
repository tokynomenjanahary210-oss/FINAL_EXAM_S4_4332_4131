<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon solde - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="sidebar">
    <a href="/client/dashboard" class="sidebar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        </svg>
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/client/dashboard" class="active">Solde</a></li>
        <li><a href="/client/depot">Dépôt</a></li>
        <li><a href="/client/retrait">Retrait</a></li>
        <li><a href="/client/transfert">Transfert</a></li>
        <li><a href="/client/historique">Historique</a></li>
        <li><a href="/client/logout">Déconnexion</a></li>
    </ul>
</div>

<div class="main-content">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-wallet2 mb-3" style="color: var(--primary);" viewBox="0 0 16 16">
                        <path d="M12.138.123A.5.5 0 0 0 11.928-.002L13.028 1.58a.5.5 0 0 0 .854-.353L13.766.454a.5.5 0 0 0-.394-.786H13.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.338a.5.5 0 0 0 .354-.353l1.414-1.414a.5.5 0 0 0-.353-.854zM2.5 3A1.5 1.5 0 0 0 1 4.5v7A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 3h-11z"/>
                    </svg>
                    <h5 class="card-title text-muted">Solde disponible</h5>
                    <p class="card-text display-4 fw-bold" style="color: var(--primary);"><?= number_format($client['balance']) ?> Ar</p>
                    <p class="text-muted"><?= $client['phone_number'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
