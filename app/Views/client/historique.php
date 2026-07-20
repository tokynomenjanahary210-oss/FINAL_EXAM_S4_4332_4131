<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/client/dashboard">Mobile Money</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/client/dashboard">Solde</a>
            <a class="nav-link" href="/client/depot">Dépôt</a>
            <a class="nav-link" href="/client/retrait">Retrait</a>
            <a class="nav-link" href="/client/transfert">Transfert</a>
            <a class="nav-link" href="/client/historique">Historique</a>
            <a class="nav-link" href="/client/logout">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <h1>Historique des transactions</h1>

    <table class="table table-striped table-bordered mt-4">
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
                    <td colspan="8" class="text-center">Aucune transaction.</td>
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
                <td><?= number_format($transaction['balance_after']) ?></td>
                <td><?= $transaction['description'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
