<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/client/dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone me-2" viewBox="0 0 16 16">
                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            </svg>
            Mobile Money
        </a>
        <div class="navbar-nav">
            <a class="nav-link" href="/client/dashboard">Solde</a>
            <a class="nav-link" href="/client/depot">Dépôt</a>
            <a class="nav-link" href="/client/retrait">Retrait</a>
            <a class="nav-link" href="/client/transfert">Transfert</a>
            <a class="nav-link active" href="/client/historique">Historique</a>
            <a class="nav-link" href="/client/logout">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
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
                            <td class="fw-bold text-success"><?= number_format($transaction['balance_after']) ?></td>
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
