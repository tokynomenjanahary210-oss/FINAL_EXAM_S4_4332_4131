<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission globale - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/admin" class="sidebar-brand">
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
        <li><a href="/admin/commission" class="active">Commission</a></li>
        <li><a href="/admin/amounts_to_send">Montants à reverser</a></li>
        <li><a href="/client/login">Accès Client</a></li>
    </ul>
</div>

<div class="main-content">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="page-header">
        <h1>Commission globale</h1>
        <p class="text-muted">Configurer la commission pour les transferts vers d'autres opérateurs</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="glass-card">
                <div class="card-body p-5">
                    <form action="/admin/commission" method="post">
                        <div class="mb-4">
                            <label class="form-label">Pourcentage de commission (%)</label>
                            <input type="number" step="0.1" name="external_commission_percentage" class="input-custom form-control" value="<?= $operator['external_commission_percentage'] ?>" required>
                            <div class="form-text text-muted">Cette commission est appliquée sur les frais de transfert vers les autres opérateurs.</div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
