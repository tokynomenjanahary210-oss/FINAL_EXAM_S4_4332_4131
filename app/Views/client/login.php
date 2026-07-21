<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PayWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="glass-card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-black mb-2" style="color: var(--dark);">PayWave</h2>


                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="/client/login" method="post">
                        <div class="mb-4">
                            <label class="form-label">Numéro de téléphone</label>
                            <input type="text" name="phone_number" class="input-custom form-control" placeholder="0331234567" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Se connecter</button>
                    </form>

    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
