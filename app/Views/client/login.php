<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - MobiCash</title>
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
        <li><a href="/client/dashboard">Solde</a></li>
        <li><a href="/client/depot">Dépôt</a></li>
        <li><a href="/client/retrait">Retrait</a></li>
        <li><a href="/client/transfert">Transfert</a></li>
        <li><a href="/client/historique">Historique</a></li>
        <li><a href="/client/logout">Déconnexion</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-phone" style="color: var(--primary);" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        </svg>
                        <h2 class="fw-bold">Connexion</h2>
                        <p class="text-muted">Entrez votre numéro de téléphone</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="/client/login" method="post">
                        <div class="mb-3">
                            <label class="form-label">Numéro de téléphone</label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Ex: 0331234567" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>

                    <p class="text-center mt-3 text-muted small">Connexion automatique avec votre numéro.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
