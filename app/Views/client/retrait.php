<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait - MobiCash</title>
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
        <li><a href="/client/home">Accueil</a></li>
        <li><a href="/client/dashboard">Solde</a></li>
        <li><a href="/client/depot">Dépôt</a></li>
        <li><a href="/client/retrait" class="active">Retrait</a></li>
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
        <h1>Effectuer un retrait</h1>
        <p class="text-muted">Retirer des fonds de votre compte</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="glass-card">
                <div class="card-body p-5">
                    <form action="/client/retrait" method="post">
                        <div class="mb-4">
                            <label class="form-label">Montant à retirer</label>
                            <div class="input-group">
                                <input type="number" name="amount" class="input-custom form-control" placeholder="0" required>
                                <span class="input-group-text" style="border-radius: 0 16px 16px 0; border: 2px solid var(--gray-200); border-left: none; background: var(--gray-50); font-weight: 600;">Ar</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Effectuer le retrait</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
