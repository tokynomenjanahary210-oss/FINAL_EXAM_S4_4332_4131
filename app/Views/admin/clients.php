<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situation des comptes clients - MobiCash</title>
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
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients" class="active">Clients</a></li>
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

    <h1 class="fw-bold mb-4">Situation des comptes clients</h1>

    <div class="card shadow border-0">
        <div class="card-header bg-white fw-bold">Liste des clients</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Téléphone</th>
                            <th>Nom</th>
                            <th>Solde (Ar)</th>
                            <th>Nb transactions</th>
                            <th>Date création</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clients)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Aucun client.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= $client['id'] ?></td>
                            <td><?= $client['phone_number'] ?></td>
                            <td><?= $client['full_name'] ?></td>
                            <td class="fw-bold" style="color: var(--primary);"><?= number_format($client['balance']) ?></td>
                            <td><?= $client['transactions_count'] ?></td>
                            <td><?= $client['created_at'] ?></td>
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
