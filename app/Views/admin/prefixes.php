<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration des préfixes</title>
    <link href="https://cdn.jsdelivr.org/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone me-2" viewBox="0 0 16 16">
                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            </svg>
            Opérateur Mobile Money
        </a>
        <div class="navbar-nav">
            <a class="nav-link" href="/admin">Tableau de bord</a>
            <a class="nav-link active" href="/admin/prefixes">Préfixes</a>
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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-white fw-bold">Configuration des préfixes</div>
                <div class="card-body">
                    <form action="/admin/prefixes" method="post">
                        <div class="mb-3">
                            <label class="form-label">Préfixes valides (séparés par des virgules)</label>
                            <input type="text" name="prefixes" class="form-control" value="<?= $operator['prefixes'] ?>" required>
                            <div class="form-text text-muted">Exemple : 033,037</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
