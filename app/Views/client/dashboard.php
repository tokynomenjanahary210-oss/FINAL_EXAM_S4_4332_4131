<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon solde - PayWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/client/dashboard" class="sidebar-brand">
        Mobi<span>Cash</span>
    </a>
    <div class="sidebar-phone"><?= session()->get('client_phone') ?></div>
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

    <div class="page-header">
        <h1>Mon solde</h1>
        <p class="text-muted">Solde disponible sur votre compte</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="glass-card text-center p-5">
                    <path d="M12.138.123A.5.5 0 0 0 11.928-.002L13.028 1.58a.5.5 0 0 0 .854-.353L13.766.454a.5.5 0 0 0-.394-.786H13.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.338a.5.5 0 0 0 .354-.353l1.414-1.414a.5.5 0 0 0-.353-.854zM2.5 3A1.5 1.5 0 0 0 1 4.5v7A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 3h-11z"/>
                <p class="text-muted mb-2">Solde disponible</p>
                <p class="fw-black mb-0" style="font-size: 3rem; color: var(--dark); letter-spacing: -0.02em;"><?= number_format($client['balance']) ?> <span style="color: var(--gray-400); font-size: 1.5rem;">Ar</span></p>
                <p class="text-muted mt-3"><?= $client['phone_number'] ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
