<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="sidebar">
    <a href="/" class="sidebar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        </svg>
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/client/login">Accès Client</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h1 class="card-title fw-bold mb-3" style="color: var(--primary);">MobiCash</h1>
                    <p class="card-text text-muted mb-4">Système de gestion mobile money</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="/admin" class="btn btn-dark btn-lg px-4">Espace Opérateur</a>
                        <a href="/client/login" class="btn btn-primary btn-lg px-4">Espace Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
