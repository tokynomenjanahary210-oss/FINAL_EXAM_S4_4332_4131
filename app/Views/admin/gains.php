<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gains via les frais - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
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
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains" class="active">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission">Commission</a></li>
        <li><a href="/admin/amounts_to_send">Montants à reverser</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission">Commission</a></li>
        <li><a href="/admin/amounts_to_send" class="active">Montants à reverser</a></li>
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

    <h1 class="fw-bold mb-4">Situation des gains via les frais</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white shadow border-0" style="background: var(--dark);">
                <div class="card-body">
                    <h5 class="card-title">Frais transferts internes</h5>
                    <p class="card-text display-6 fw-bold"><?= number_format($internal_fees) ?></p>
                    <p class="card-text text-white-50">Ar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white shadow border-0" style="background: var(--primary);">
                <div class="card-body">
                    <h5 class="card-title">Frais transferts externes</h5>
                    <p class="card-text display-6 fw-bold"><?= number_format($external_fees) ?></p>
                    <p class="card-text text-white-50">Ar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white shadow border-0" style="background: #0d6efd;">
                <div class="card-body">
                    <h5 class="card-title">Total des frais</h5>
                    <p class="card-text display-6 fw-bold"><?= number_format($total_gains) ?></p>
                    <p class="card-text text-white-50">Ar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white shadow border-0" style="background: #dc3545;">
                <div class="card-body">
                    <h5 class="card-title">Commissions à reverser</h5>
                    <p class="card-text display-6 fw-bold"><?= number_format($total_commissions) ?></p>
                    <p class="card-text text-white-50">Ar</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-white fw-bold">Détail par type d'opération</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Type d'opération</th>
                            <th>Total des frais (Ar)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($gains)): ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">Aucun gain.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($gains as $gain): ?>
                        <tr>
                            <td><?= $gain['name'] ?></td>
                            <td class="fw-bold" style="color: var(--primary);"><?= number_format($gain['total']) ?> Ar</td>
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
