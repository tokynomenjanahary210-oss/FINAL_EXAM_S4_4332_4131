<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions - MobiCash</title>
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
        <li><a href="/client/historique" class="active">Historique</a></li>
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

    <h1 class="fw-bold mb-4">Historique des transactions</h1>

    <div class="card shadow border-0">
        <div class="card-header bg-white fw-bold">Mes transactions</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Opération</th>
                            <th>Montant (Ar)</th>
                            <th>Frais (Ar)</th>
                            <th>Solde avant (Ar)</th>
                            <th>Solde après (Ar)</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Aucune transaction.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= $transaction['id'] ?></td>
                            <td><?= $transaction['created_at'] ?></td>
                            <td><?= $transaction['operation_name'] ?></td>
                            <td><?= number_format($transaction['amount']) ?></td>
                            <td><?= number_format($transaction['fee']) ?></td>
                            <td><?= number_format($transaction['balance_before']) ?></td>
                            <td class="fw-bold" style="color: var(--primary);"><?= number_format($transaction['balance_after']) ?></td>
                            <td><?= $transaction['description'] ?></td>
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
