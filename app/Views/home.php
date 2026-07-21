<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - PayWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/" class="sidebar-brand">
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission">Commission</a></li>
        <li><a href="/admin/amounts_to_send">Montants à reverser</a></li>
        <li><a href="/client/login">Accès Client</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 text-center">
            <div class="glass-card p-5">
                <div class="mb-4">
                    <h1 class="fw-black mb-3" style="font-size: 3.5rem; color: var(--dark); letter-spacing: -0.03em;">Mobi<span style="color: var(--primary);">Cash</span></h1>
                    <p class="text-muted mb-4" style="font-size: 1.1rem;">Système de paiement mobile nouvelle génération</p>
                </div>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <a href="/admin" class="btn btn-primary-custom btn-lg px-5">Espace Opérateur</a>
                    <a href="/client/login" class="btn btn-outline-custom btn-lg px-5">Espace Client</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
