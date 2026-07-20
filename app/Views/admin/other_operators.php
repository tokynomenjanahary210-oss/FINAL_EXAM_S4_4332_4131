<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autres opérateurs - MobiCash</title>
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
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains">Gains</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/other_operators" class="active">Autres opérateurs</a></li>
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
        <h1>Autres opérateurs</h1>
        <p class="text-muted">Gérer les opérateurs externes (Orange, Yas)</p>
    </div>

    <div class="glass-card mb-4">
        <div class="card-body p-5">
            <form action="/admin/other_operators" method="post">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" class="input-custom form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Préfixes (séparés par des virgules)</label>
                        <input type="text" name="prefixes" class="input-custom form-control" placeholder="032,037" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">Liste des opérateurs externes</div>
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Préfixes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($other_operators)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Aucun opérateur.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($other_operators as $op): ?>
                        <tr>
                            <td class="fw-bold">#<?= $op['id'] ?></td>
                            <td><?= $op['name'] ?></td>
                            <td><span class="badge-custom"><?= $op['prefixes'] ?></span></td>
                            <td>
                                <a href="/admin/other_operators/edit/<?= $op['id'] ?>" class="btn btn-outline-custom btn-sm">Modifier</a>
                                <a href="/admin/other_operators/delete/<?= $op['id'] ?>" class="btn btn-outline-custom btn-sm" style="border-color: var(--danger); color: var(--danger);" onclick="return confirm('Supprimer ?')">Supprimer</a>
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
