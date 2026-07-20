<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situation des comptes clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin">Opérateur Mobile Money</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/admin">Tableau de bord</a>
            <a class="nav-link" href="/admin/prefixes">Préfixes</a>
            <a class="nav-link" href="/admin/operation_types">Types d'opérations</a>
            <a class="nav-link" href="/admin/fee_brackets">Barèmes de frais</a>
            <a class="nav-link" href="/admin/gains">Gains</a>
            <a class="nav-link" href="/admin/clients">Clients</a>
            <a class="nav-link" href="/client/login">Accès Client</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <h1>Situation des comptes clients</h1>

    <table class="table table-striped table-bordered mt-4">
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
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= $client['id'] ?></td>
                <td><?= $client['phone_number'] ?></td>
                <td><?= $client['full_name'] ?></td>
                <td><?= number_format($client['balance']) ?></td>
                <td><?= $client['transactions_count'] ?></td>
                <td><?= $client['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
