<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt</title>
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

    <h1>Dépôt</h1>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="/client/depot" method="post">
                        <div class="mb-3">
                            <label class="form-label">Montant (Ar)</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Effectuer le dépôt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
