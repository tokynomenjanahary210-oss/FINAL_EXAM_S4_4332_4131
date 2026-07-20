<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gains Airtel - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <li><a href="/admin"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</a></li>
        <li><a href="/admin/prefixes"><i class="bi bi-telephone me-2"></i>Préfixes</a></li>
        <li><a href="/admin/operation_types">Types d'opérations</a></li>
        <li><a href="/admin/fee_brackets">Barèmes de frais</a></li>
        <li><a href="/admin/gains" class="active">Gains</a></li>
        <li><a href="/admin/clients"><i class="bi bi-people me-2"></i>Clients</a></li>
        <li><a href="/admin/other_operators">Autres opérateurs</a></li>
        <li><a href="/admin/commission"><i class="bi bi-percent me-2"></i>Commission</a></li>
        <li><a href="/admin/amounts_to_send">Montants à reverser</a></li>
        <li><a href="/client/login"><i class="bi bi-phone me-2"></i>Accès Client</a></li>
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
        <h1>Gains Airtel</h1>
        <p class="text-muted">Récapitulatif des gains et commissions</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="stat-card primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-black-50 mb-1 small text-uppercase fw-bold">Total des frais gagnés</p>
                        <h3 class="fw-black mb-0"><?= number_format($total_fees) ?></h3>
                        <p class="text-black-50 small mb-0">Ar</p>
                    </div>
                    <div class="rounded-circle bg-black bg-opacity-10 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.842-.53c.876-.472 1.476-1.258 1.476-2.109 0-.865-.612-1.52-1.473-1.691z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card danger">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-white-50 mb-1 small text-uppercase fw-bold">Total commissions à reverser</p>
                        <h3 class="fw-black mb-0"><?= number_format($total_commissions) ?></h3>
                        <p class="text-white-50 small mb-0">Ar</p>
                    </div>
                    <div class="rounded-circle bg-white bg-opacity-20 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 1 .5-.5h13.793l-4.147-4.146a.5.5 0 0 1 .708-.708l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L15.293 12H1.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
