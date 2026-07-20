<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barèmes de frais</title>
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

    <h1>Barèmes de frais</h1>

    <form action="/admin/fee_brackets" method="post" class="mt-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Type d'opération</label>
                <select name="operation_type_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($operation_types as $type): ?>
                    <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Min (Ar)</label>
                <input type="number" name="min_amount" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Max (Ar)</label>
                <input type="number" name="max_amount" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Frais (Ar)</label>
                <input type="number" name="fee" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary d-block w-100">Ajouter</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-bordered mt-3">
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
            <?php foreach ($fee_brackets as $bracket): ?>
            <tr>
                <td><?= $bracket['id'] ?></td>
                <td><?= $bracket['operation_name'] ?></td>
                <td><?= number_format($bracket['min_amount']) ?></td>
                <td><?= number_format($bracket['max_amount']) ?></td>
                <td><?= number_format($bracket['fee']) ?></td>
                <td>
                    <a href="/admin/fee_brackets/delete/<?= $bracket['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
