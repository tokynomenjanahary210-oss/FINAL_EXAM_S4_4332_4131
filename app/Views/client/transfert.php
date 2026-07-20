<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert - MobiCash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="sidebar">
    <a href="/client/dashboard" class="sidebar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        </svg>
        Mobi<span>Cash</span>
    </a>
    <ul class="sidebar-nav">
        <li><a href="/client/dashboard">Solde</a></li>
        <li><a href="/client/depot">Dépôt</a></li>
        <li><a href="/client/retrait">Retrait</a></li>
        <li><a href="/client/transfert" class="active">Transfert</a></li>
        <li><a href="/client/historique">Historique</a></li>
        <li><a href="/client/logout">Déconnexion</a></li>
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

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-white fw-bold">Effectuer un transfert</div>
                <div class="card-body">
                    <form action="/client/transfert" method="post" id="transferForm">
                        <div id="phoneNumbersContainer">
                            <div class="mb-3 phone-input-group">
                                <label class="form-label">Numéro du destinataire</label>
                                <div class="input-group">
                                    <input type="text" name="phone_numbers[]" class="form-control" placeholder="Ex: 0331234567" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="addPhoneField()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Ajouter un numéro
                        </button>
                        <div class="mb-3">
                            <label class="form-label">Montant total (Ar)</label>
                            <input type="number" name="amount" class="form-control" required>
                            <div class="form-text text-muted">Le montant sera divisé équitablement entre tous les destinataires.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="include_retrait_fee" class="form-check-input" id="includeRetraitFee">
                            <label class="form-check-label" for="includeRetraitFee">Inclure les frais de retrait pour le destinataire</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Effectuer le transfert</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let phoneCount = 1;

function addPhoneField() {
    phoneCount++;
    const container = document.getElementById('phoneNumbersContainer');
    const div = document.createElement('div');
    div.className = 'mb-3 phone-input-group';
    div.innerHTML = `
        <label class="form-label">Numéro du destinataire</label>
        <div class="input-group">
            <input type="text" name="phone_numbers[]" class="form-control" placeholder="Ex: 0331234567" required>
            <button type="button" class="btn btn-outline-danger" onclick="removePhoneField(this)" ${phoneCount <= 1 ? 'disabled' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button>
        </div>
    </div>
    container.appendChild(div);
    updateRemoveButtons();
}

function removePhoneField(button) {
    const group = button.closest('.phone-input-group');
    group.remove();
    phoneCount--;
    updateRemoveButtons();
}

function updateRemoveButtons() {
    const groups = document.querySelectorAll('.phone-input-group');
    const removeButtons = document.querySelectorAll('.phone-input-group button[onclick^="removePhoneField"]');
    removeButtons.forEach(btn => {
        btn.disabled = groups.length <= 1;
    });
}
</script>
