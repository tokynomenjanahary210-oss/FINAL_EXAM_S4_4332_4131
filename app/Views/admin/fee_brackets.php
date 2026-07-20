<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barèmes de frais - MobiCash</title>
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

    <h1 class="fw-bold mb-4">Barèmes de frais</h1>

    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white fw-bold">Ajouter un barème de frais</div>
        <div class="card-body">
            <form action="/admin/fee_brackets" method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Type d'opération</label>
                        <select name="operation_type_id" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($operation_types as $type): ?>
                            <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Min (Ar)</label>
                        <input type="number" name="min_amount" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Max (Ar)</label>
                        <input type="number" name="max_amount" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Frais (Ar)</label>
                        <input type="number" name="fee" class="form-control" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-white fw-bold">Liste des barèmes</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Opération</th>
                            <th>Min (Ar)</th>
                            <th>Max (Ar)</th>
                            <th>Frais (Ar)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($fee_brackets)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Aucun barème.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($fee_brackets as $bracket): ?>
                        <tr>
                            <td><?= $bracket['id'] ?></td>
                            <td><?= $bracket['operation_name'] ?></td>
                            <td><?= number_format($bracket['min_amount']) ?></td>
                            <td><?= number_format($bracket['max_amount']) ?></td>
                            <td class="fw-bold" style="color: var(--primary);"><?= number_format($bracket['fee']) ?></td>
                            <td>
                                <a href="/admin/fee_brackets/edit/<?= $bracket['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="/admin/fee_brackets/delete/<?= $bracket['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce barème ?')">Supprimer</a>
                            </td>
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
