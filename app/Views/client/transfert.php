<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert - PayWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="/client/dashboard" class="sidebar-brand">
        Mobi<span>Cash</span>
    </a>
    <div class="sidebar-phone"><?= session()->get('client_phone') ?></div>
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

    <div class="page-header">
        <h1>Effectuer un transfert</h1>
        <p class="text-muted">Envoyer de l'argent à vos proches</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card">
                <div class="card-body p-5">
                    <form action="/client/transfert" method="post" id="transferForm">
                        <div id="phoneNumbersContainer">
                            <div class="mb-3 phone-input-group">
                                <label class="form-label">Numéro du destinataire</label>
                                <div class="input-group">
                                    <input type="text" name="phone_numbers[]" class="input-custom form-control" placeholder="Ex: 0331234567" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-custom btn-sm mb-3" onclick="addPhoneField()">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            Ajouter un numéro
                        </button>
                        <div class="mb-4">
                            <label class="form-label">Montant total (Ar)</label>
                            <input type="number" name="amount" class="input-custom form-control" required>
                            <div class="form-text text-muted">Le montant sera divisé équitablement entre tous les destinataires.</div>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="include_retrait_fee" class="form-check-input" id="includeRetraitFee">
                            <label class="form-check-label" for="includeRetraitFee">Inclure les frais de retrait pour le destinataire</label>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Effectuer le transfert</button>
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

    const label = document.createElement('label');
    label.className = 'form-label';
    label.textContent = 'Numéro du destinataire';

    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';

    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'phone_numbers[]';
    input.className = 'input-custom form-control';
    input.placeholder = 'Ex: 0331234567';
    input.required = true;

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'btn btn-outline-custom';
    removeBtn.style.borderColor = 'var(--danger)';
    removeBtn.style.color = 'var(--danger)';
    removeBtn.onclick = function() {
        removePhoneField(this);
    };
    if (phoneCount <= 1) {
        removeBtn.disabled = true;
    }
    removeBtn.innerHTML = `
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
    `;

    inputGroup.appendChild(input);
    inputGroup.appendChild(removeBtn);

    div.appendChild(label);
    div.appendChild(inputGroup);

    container.appendChild(div);
    updateRemoveButtons();
}

function removePhoneField(button) {
    const group = button.closest('.phone-input-group');
    if (group) {
        group.remove();
        phoneCount--;
        updateRemoveButtons();
    }
}

function updateRemoveButtons() {
    const groups = document.querySelectorAll('.phone-input-group');
    const removeButtons = document.querySelectorAll('.phone-input-group button[onclick^="removePhoneField"]');
    removeButtons.forEach(btn => {
        btn.disabled = groups.length <= 1;
    });
}
</script>
