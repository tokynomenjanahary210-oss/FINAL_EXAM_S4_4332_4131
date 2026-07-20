<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opérateur Mobile Money</title>
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
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
