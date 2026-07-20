<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/client/home" class="sidebar-brand">
        Mobi<span>Cash</span>
    </a>
    <div class="sidebar-phone"><?= session()->get('client_phone') ?></div>
    <ul class="sidebar-nav">
        <li><a href="/client/home" class="active">Accueil</a></li>
        <li><a href="/client/dashboard">Solde</a></li>
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
        <h1>Bienvenue</h1>
        <p class="text-muted">Que souhaitez-vous faire aujourd'hui ?</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <a href="/client/depot" class="text-decoration-none">
                <div class="stat-card primary h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-black-50 mb-1 small text-uppercase fw-bold">Dépôt</p>
                            <h3 class="fw-black mb-0">Ajouter de l'argent</h3>
                        </div>
                        <div class="rounded-circle bg-black bg-opacity-10 p-2">
                            <span style="font-size: 1.5rem;">↓</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/client/retrait" class="text-decoration-none">
                <div class="stat-card warning h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-black-50 mb-1 small text-uppercase fw-bold">Retrait</p>
                            <h3 class="fw-black mb-0">Retirer de l'argent</h3>
                        </div>
                        <div class="rounded-circle bg-white bg-opacity-20 p-2">
                            <span style="font-size: 1.5rem;">↑</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/client/transfert" class="text-decoration-none">
                <div class="stat-card danger h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-white-50 mb-1 small text-uppercase fw-bold">Transfert</p>
                            <h3 class="fw-black mb-0">Envoyer de l'argent</h3>
                        </div>
                        <div class="rounded-circle bg-white bg-opacity-20 p-2">
                            <span style="font-size: 1.5rem;">⇄</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="/client/dashboard" class="text-decoration-none">
                <div class="card-custom h-100">
                    <div class="card-body-custom">
                        <h5 class="fw-bold mb-1">Mon solde</h5>
                        <p class="text-muted mb-0">Consulter mon solde disponible</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="/client/historique" class="text-decoration-none">
                <div class="card-custom h-100">
                    <div class="card-body-custom">
                        <h5 class="fw-bold mb-1">Historique</h5>
                        <p class="text-muted mb-0">Voir mes dernières transactions</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
