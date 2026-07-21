<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montants à reverser - PayWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/admin" class="sidebar-brand">Pay<span>Wave</span></a>
    <ul class="sidebar-nav">
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
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
