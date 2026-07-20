<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types d'opérations - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/admin" class="sidebar-brand">
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/admin">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types" class="active">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
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
        <h1>Types d'opérations</h1>
        <p class="text-muted">Gérer les types d'opérations disponibles</p>
    </div>

    <div class="glass-card mb-4">
        <div class="card-body p-5">
            <form action="/admin/operation_types" method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="input-custom form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" class="input-custom form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="input-custom form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">Liste des types d'opérations</div>
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($operation_types)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Aucun type d'opération.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($operation_types as $type): ?>
                        <tr>
                            <td class="fw-bold">#<?= $type['id'] ?></td>
                            <td><span class="badge-custom"><?= $type['code'] ?></span></td>
                            <td><?= $type['name'] ?></td>
                            <td class="text-muted"><?= $type['description'] ?: '-' ?></td>
                            <td>
                                <a href="/admin/operation_types/delete/<?= $type['id'] ?>" class="btn btn-outline-custom btn-sm" style="border-color: var(--danger); color: var(--danger);" onclick="return confirm('Supprimer ce type d\'opération ?')">
                                     Supprimer
                                </a>
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
