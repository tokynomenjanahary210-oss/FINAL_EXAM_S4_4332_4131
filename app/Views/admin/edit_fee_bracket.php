<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier barème - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
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
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets" class="active">Barèmes de frais</a></li>
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission">Commission</a></li>
        <li><a href="/admin/amounts_to_send">Montants à reverser</a></li>
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
        <h1>Modifier le barème de frais</h1>
        <p class="text-muted">Mettre à jour les paramètres du barème</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card">
                <div class="card-body p-5">
                    <form action="/admin/fee_brackets/update/<?= $bracket['id'] ?>" method="post">
                        <div class="mb-4">
                            <label class="form-label">Type d'opération</label>
                            <select name="operation_type_id" class="input-custom form-select" required>
                                <?php foreach ($operation_types as $type): ?>
                                <option value="<?= $type['id'] ?>" <?= $type['id'] == $bracket['operation_type_id'] ? 'selected' : '' ?>>
                                    <?= $type['name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Montant minimum (Ar)</label>
                            <input type="number" name="min_amount" class="input-custom form-control" value="<?= $bracket['min_amount'] ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Montant maximum (Ar)</label>
                            <input type="number" name="max_amount" class="input-custom form-control" value="<?= $bracket['max_amount'] ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Frais (Ar)</label>
                            <input type="number" name="fee" class="input-custom form-control" value="<?= $bracket['fee'] ?>" required>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom flex-fill">Enregistrer</button>
                            <a href="/admin/fee_brackets" class="btn btn-outline-custom flex-fill">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
