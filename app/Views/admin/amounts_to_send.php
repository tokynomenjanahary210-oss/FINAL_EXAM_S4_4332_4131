<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montants à reverser - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/admin" class="sidebar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        </svg>
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/admin"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</a></li>
        <li><a href="/admin/prefixes"><i class="bi bi-telephone me-2"></i>Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains"><i class="bi bi-graph-up me-2"></i>Gains</a></li>
        <li><a href="/admin/clients"><i class="bi bi-people me-2"></i>Clients</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission"><i class="bi bi-percent me-2"></i>Commission</a></li>
        <li><a href="/admin/amounts_to_send" class="active">Montants à reverser</a></li>
        <li><a href="/client/login"><i class="bi bi-phone me-2"></i>Accès Client</a></li>
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
        <h1>Montants à reverser</h1>
        <p class="text-muted">Commissions à reverser aux opérateurs externes</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">Commissions par opérateur</div>
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Opérateur</th>
                            <th>Nombre de transferts</th>
                            <th>Total commissions (Ar)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($amounts)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">Aucun montant à reverser.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($amounts as $amount): ?>
                        <tr>
                            <td class="fw-bold"><?= $amount['name'] ?></td>
                            <td><?= $amount['transfer_count'] ?></td>
                            <td class="fw-bold" style="color: var(--dark);"><?= number_format($amount['total_commission']) ?> Ar</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
