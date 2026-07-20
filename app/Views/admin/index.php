<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/admin" class="sidebar-brand">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/admin" class="active">Tableau de bord</a></li>
        <li><a href="/admin/prefixes">Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
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
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="page-header">
        <h1>Tableau de bord</h1>
        <p class="text-muted">Vue d'ensemble de l'activité Airtel</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-white-50 mb-1 small text-uppercase fw-bold">Clients Airtel</p>
                        <h3 class="fw-black mb-0"><?= $clients_count ?></h3>
                    </div>
                    <div class="rounded-circle bg-white bg-opacity-20 p-2">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.98-1.07a3.5 3.5 0 1 1 2.96 0A7.5 7.5 0 0 1 8 2.5a7.5 7.5 0 0 1 .02 10.43zM11 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-black-50 mb-1 small text-uppercase fw-bold">Total Frais</p>
                        <h3 class="fw-black mb-0"><?= number_format($total_fees) ?></h3>
                        <p class="text-black-50 small mb-0">Ar</p>
                    </div>
                    <div class="rounded-circle bg-black bg-opacity-10 p-2">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.842-.53c.876-.472 1.476-1.258 1.476-2.109 0-.865-.612-1.52-1.473-1.691z"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card info">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-white-50 mb-1 small text-uppercase fw-bold">Dépôts</p>
                        <h3 class="fw-black mb-0"><?= $deposit_count ?></h3>
                    </div>
                    <div class="rounded-circle bg-white bg-opacity-20 p-2">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V5a.5.5 0 0 1 .5-.5z"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card warning">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-black-50 mb-1 small text-uppercase fw-bold">Retraits</p>
                        <h3 class="fw-black mb-0"><?= $withdrawal_count ?></h3>
                    </div>
                    <div class="rounded-circle bg-black bg-opacity-10 p-2">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 10.5a.5.5 0 0 1 .5-.5h5.793l-2.147-2.146a.5.5 0 0 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 11H5a.5.5 0 0 1-.5-.5z"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card danger">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-white-50 mb-1 small text-uppercase fw-bold">Transferts</p>
                        <h3 class="fw-black mb-0"><?= $transfer_count ?></h3>
                    </div>
                    <div class="rounded-circle bg-white bg-opacity-20 p-2">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 1 .5-.5h13.793l-4.147-4.146a.5.5 0 0 1 .708-.708l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L15.293 12H1.5a.5.5 0 0 1-.5-.5z"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <span>Situation des comptes clients Airtel</span>
            <span class="badge-custom"><?= $clients_count ?> clients</span>
        </div>
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Téléphone</th>
                            <th>Nom</th>
                            <th>Solde</th>
                            <th>Date création</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clients)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Aucun client Airtel enregistré.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($clients as $client): ?>
                        <tr>
                            <td class="fw-bold">#<?= $client['id'] ?></td>
                            <td>
                                <span class="badge bg-dark text-white"><?= $client['phone_number'] ?></span>
                            </td>
                            <td><?= $client['full_name'] ?: '-' ?></td>
                            <td class="fw-bold" style="color: var(--dark); font-size: 1.1rem;"><?= number_format($client['balance']) ?> Ar</td>
                            <td class="text-muted"><?= date('d/m/Y H:i', strtotime($client['created_at'])) ?></td>
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
