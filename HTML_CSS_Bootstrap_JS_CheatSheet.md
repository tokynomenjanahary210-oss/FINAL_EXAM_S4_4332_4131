# HTML / CSS / Bootstrap / JS - CheatSheet (Views CodeIgniter 4)

> Référence développeur pour réaliser les Views du projet **Gestion des étudiants**.
> Stack : CodeIgniter 4 + SQLite3 + Bootstrap 5 + HTML5 + CSS3 + JavaScript de base.
> Table `etudiant` (id, nom, age, email). Routes : `/etudiants`, `/etudiants/create`, `/etudiants/store`, `/etudiants/edit/(:num)`, `/etudiants/update/(:num)`, `/etudiants/delete/(:num)`.

## Table des matières

1. [Structure des Views](#1-structure-des-views)
2. [Structure HTML5](#2-structure-html5)
3. [Balises HTML essentielles](#3-balises-html-essentielles)
4. [Liens](#4-liens)
5. [Images](#5-images)
6. [Listes](#6-listes)
7. [Tableaux HTML](#7-tableaux-html)
8. [PHP dans les Views CI4](#8-php-dans-les-views-ci4)
9. [Formulaires HTML](#9-formulaires-html)
10. [Inputs](#10-inputs)
11. [CSS3](#11-css3)
12. [Syntaxe CSS](#12-syntaxe-css)
13. [Texte](#13-texte)
14. [Couleurs](#14-couleurs)
15. [Dimensions](#15-dimensions)
16. [Espacements](#16-espacements)
17. [Bordures](#17-bordures)
18. [Display](#18-display)
19. [Flexbox](#19-flexbox)
20. [Grid](#20-grid)
21. [Position](#21-position)
22. [Responsive](#22-responsive)
23. [Bootstrap 5](#23-bootstrap-5)
24. [Tableaux Bootstrap](#24-tableaux-bootstrap)
25. [Formulaires Bootstrap](#25-formulaires-bootstrap)
26. [Boutons Bootstrap](#26-boutons-bootstrap)
27. [Alertes Bootstrap](#27-alertes-bootstrap)
28. [Cards](#28-cards)
29. [Navbar](#29-navbar)
30. [Modal](#30-modal)
31. [JavaScript](#31-javascript)
32. [JavaScript pour un CRUD](#32-javascript-pour-un-crud)
33. [HTML + CI4 + Bootstrap](#33-html--ci4--bootstrap)
34. [Debug HTML / CSS / JS](#34-debug-html--css--js)
35. [Bonnes pratiques](#35-bonnes-pratiques)

---

## 1. Structure des Views

```
app/
 Views/
  etudiants/
   index.php    → liste des étudiants
   create.php   → formulaire d'ajout
   edit.php     → formulaire de modification
```

---

## 2. Structure HTML5

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <h1>Gestion des étudiants</h1>

    <script src="/js/script.js"></script>
</body>
</html>
```

---

## 3. Balises HTML essentielles

```html
<h1>Titre principal</h1>
<h2>Sous-titre</h2>
<p>Paragraphe de texte.</p>
<span>Texte en ligne</span>
<strong>Texte important</strong>
<em>Texte en italique</em>
<small>Texte petit</small>
<br>
<hr>

<div>Bloc générique</div>
<header>En-tête</header>
<nav>Navigation</nav>
<main>Contenu principal</main>
<section>Section de contenu</section>
<footer>Pied de page</footer>
```

---

## 4. Liens

```html
<a href="/etudiants">Liste des étudiants</a>
<a href="/etudiants/create">Ajouter un étudiant</a>
<a href="https://example.com" target="_blank">Lien externe</a>
```

---

## 5. Images

```html
<img src="/images/logo.png" alt="Logo" width="120" height="80">
```

---

## 6. Listes

```html
<ul>
    <li>Nom</li>
    <li>Age</li>
    <li>Email</li>
</ul>

<ol>
    <li>Étape 1</li>
    <li>Étape 2</li>
</ol>
```

---

## 7. Tableaux HTML

```html
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['id'] ?></td>
            <td><?= $etudiant['nom'] ?></td>
            <td><?= $etudiant['age'] ?></td>
            <td><?= $etudiant['email'] ?></td>
            <td>
                <a href="/etudiants/edit/<?= $etudiant['id'] ?>">Modifier</a>
                <a href="/etudiants/delete/<?= $etudiant['id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

---

## 8. PHP dans les Views CI4

Syntaxe imposée : `<?= ?>`, `foreach/endforeach`, `if/elseif/else/endif`.

```php
<?= $etudiant['nom'] ?>

<?php foreach ($etudiants as $etudiant): ?>
    <p><?= $etudiant['nom'] ?></p>
<?php endforeach; ?>

<?php if (empty($etudiants)): ?>
    <p>Aucun étudiant trouvé.</p>
<?php elseif (isset($etudiants)): ?>
    <p><?= count($etudiants) ?> étudiant(s).</p>
<?php else: ?>
    <p>Erreur.</p>
<?php endif; ?>
```

---

## 9. Formulaires HTML

Uniquement du HTML classique (pas de `form_open()`).

```html
<!-- Ajouter étudiant -->
<form action="/etudiants/store" method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="number" name="age" placeholder="Age" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Ajouter</button>
</form>
```

```html
<!-- Modifier étudiant -->
<form action="/etudiants/update/<?= $etudiant['id'] ?>" method="post">
    <input type="text" name="nom" value="<?= $etudiant['nom'] ?>" required>
    <input type="number" name="age" value="<?= $etudiant['age'] ?>" required>
    <input type="email" name="email" value="<?= $etudiant['email'] ?>" required>
    <button type="submit">Modifier</button>
</form>
```

```html
<!-- Recherche étudiant -->
<form action="/etudiants" method="get">
    <input type="text" name="q" placeholder="Rechercher un étudiant">
    <button type="submit">Rechercher</button>
</form>
```

```html
<!-- Connexion utilisateur -->
<form action="/login" method="post">
    <input type="text" name="username" placeholder="Utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
```

---

## 10. Inputs

```html
<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
<input type="number" name="age">
<input type="email" name="email">
<input type="password" name="password">
<input type="date" name="date_naissance">
<input type="file" name="photo">
<input type="hidden" name="id" value="1">
<input type="checkbox" name="actif" value="1">
<input type="radio" name="genre" value="M">
<input type="submit" value="Envoyer">
<input type="button" value="Annuler">
```

Attributs courants : `id`, `class`, `name`, `value`, `placeholder`, `required`, `readonly`, `disabled`.

---

## 11. CSS3

```
public/css/style.css
```

```html
<link rel="stylesheet" href="/css/style.css">
```

---

## 12. Syntaxe CSS

```css
* { box-sizing: border-box; }
body { margin: 0; }
table { width: 100%; }
tr { border-bottom: 1px solid #ddd; }
td, th { padding: 8px; }
button { cursor: pointer; }
input { border: 1px solid #ccc; }
.card { padding: 16px; }
#header { background: #f8f9fa; }
```

---

## 13. Texte

```css
p {
    font-family: Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    line-height: 1.5;
    text-decoration: underline;
}
```

---

## 14. Couleurs

```css
p {
    color: #333333;
    background-color: #f8f9fa;
    opacity: 0.9;
}
```

---

## 15. Dimensions

```css
.container {
    width: 100%;
    height: 400px;
    max-width: 960px;
    min-width: 320px;
}
```

---

## 16. Espacements

```css
.card {
    margin: 10px;
    padding: 20px;
}
```

---

## 17. Bordures

```css
.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
```

---

## 18. Display

```css
.block { display: block; }
.inline { display: inline; }
.inline-block { display: inline-block; }
.hidden { display: none; }
.flex { display: flex; }
.grid { display: grid; }
```

---

## 19. Flexbox

```css
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    flex-direction: row;
}
```

```css
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
```

---

## 20. Grid

```css
.grid-etudiants {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
```

---

## 21. Position

```css
.relative { position: relative; }
.absolute { position: absolute; top: 0; right: 0; }
.fixed { position: fixed; bottom: 0; width: 100%; }
.sticky { position: sticky; top: 0; }
```

---

## 22. Responsive

```css
.table-container {
    width: 100%;
}

@media (max-width: 768px) {
    table {
        font-size: 12px;
    }
    .toolbar {
        flex-direction: column;
    }
}
```

---

## 23. Bootstrap 5

Installation CDN :

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

```html
<div class="container">
    <div class="row">
        <div class="col-md-6">Colonne 1</div>
        <div class="col-md-6">Colonne 2</div>
    </div>
</div>

<div class="container-fluid">...</div>
```

Typographie, couleurs, espacements, display, flex (utilitaires) :

```html
<h1 class="fw-bold text-primary">Titre</h1>
<p class="text-muted mb-3">Texte</p>
<div class="d-flex justify-content-between p-3 bg-light">...</div>
```

---

## 24. Tableaux Bootstrap

```html
<table class="table table-striped table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['id'] ?></td>
            <td><?= $etudiant['nom'] ?></td>
            <td><?= $etudiant['age'] ?></td>
            <td><?= $etudiant['email'] ?></td>
            <td>
                <a href="/etudiants/edit/<?= $etudiant['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <a href="/etudiants/delete/<?= $etudiant['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

---

## 25. Formulaires Bootstrap

```html
<!-- Ajout étudiant -->
<form action="/etudiants/store" method="post">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
```

```html
<!-- Recherche étudiant -->
<form action="/etudiants" method="get" class="d-flex mb-3">
    <input type="text" name="q" class="form-control me-2" placeholder="Rechercher...">
    <select name="filtre" class="form-select me-2">
        <option value="nom">Nom</option>
        <option value="email">Email</option>
    </select>
    <button type="submit" class="btn btn-secondary">Rechercher</button>
</form>
```

```html
<!-- Connexion -->
<form action="/login" method="post">
    <div class="mb-3">
        <label class="form-label">Utilisateur</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
```

---

## 26. Boutons Bootstrap

```html
<a href="/etudiants/create" class="btn btn-primary">Ajouter</a>
<a href="/etudiants/edit/1" class="btn btn-warning">Modifier</a>
<a href="/etudiants/delete/1" class="btn btn-danger">Supprimer</a>
<a href="/etudiants" class="btn btn-secondary">Retour</a>
<button type="button" class="btn btn-secondary" onclick="history.back()">Annuler</button>
```

---

## 27. Alertes Bootstrap

```html
<div class="alert alert-success">Étudiant ajouté avec succès.</div>
<div class="alert alert-danger">Une erreur est survenue.</div>
<div class="alert alert-warning">Vérifiez les informations saisies.</div>
<div class="alert alert-info">Aucun étudiant trouvé.</div>
```

---

## 28. Cards

```html
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $etudiant['nom'] ?></h5>
        <p class="card-text">Age : <?= $etudiant['age'] ?></p>
        <p class="card-text">Email : <?= $etudiant['email'] ?></p>
        <a href="/etudiants/edit/<?= $etudiant['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
    </div>
</div>
```

---

## 29. Navbar

```html
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/etudiants">Gestion des étudiants</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/etudiants">Liste</a>
            <a class="nav-link" href="/etudiants/create">Ajouter</a>
        </div>
    </div>
</nav>
```

---

## 30. Modal

```html
<!-- Bouton déclencheur -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
    Supprimer
</button>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer cet étudiant ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="/etudiants/delete/<?= $etudiant['id'] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>
```

---

## 31. JavaScript

```javascript
let nom = "Toky";
const age = 21;

if (age > 18) {
    console.log("Majeur");
}

for (let i = 0; i < 5; i++) {
    console.log(i);
}

function saluer(nom) {
    return "Bonjour " + nom;
}

const input = document.querySelector('#nom');
const bouton = document.getElementById('btn-submit');

bouton.addEventListener('click', function () {
    alert(input.value);
});

document.getElementById('titre').innerHTML = "Nouveau titre";

confirm("Êtes-vous sûr ?");
prompt("Entrez votre nom");
window.location = "/etudiants";
```

---

## 32. JavaScript pour un CRUD

```javascript
// Confirmation avant suppression
document.querySelectorAll('.btn-delete').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        if (!confirm("Voulez-vous vraiment supprimer cet étudiant ?")) {
            e.preventDefault();
        }
    });
});
```

```javascript
// Validation simple formulaire
document.querySelector('form').addEventListener('submit', function (e) {
    const nom = document.querySelector('input[name="nom"]').value;
    if (nom.trim() === "") {
        e.preventDefault();
        alert("Le nom est obligatoire.");
    }
});
```

```javascript
// Afficher / Masquer mot de passe
document.getElementById('togglePassword').addEventListener('click', function () {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
});
```

```javascript
// Prévisualisation image
document.getElementById('photo').addEventListener('change', function (e) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(e.target.files[0]);
});
```

```javascript
// Réinitialiser formulaire
document.getElementById('btn-reset').addEventListener('click', function () {
    document.querySelector('form').reset();
});
```

---

## 33. HTML + CI4 + Bootstrap

```php
<!-- app/Views/etudiants/index.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Liste des étudiants</h1>
    <a href="/etudiants/create" class="btn btn-primary mb-3">Ajouter</a>

    <table class="table table-striped">
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Age</th><th>Email</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant['id'] ?></td>
                <td><?= $etudiant['nom'] ?></td>
                <td><?= $etudiant['age'] ?></td>
                <td><?= $etudiant['email'] ?></td>
                <td>
                    <a href="/etudiants/edit/<?= $etudiant['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="/etudiants/delete/<?= $etudiant['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
```

```php
<!-- app/Views/etudiants/create.php -->
<div class="container mt-4">
    <h1>Ajouter un étudiant</h1>
    <form action="/etudiants/store" method="post">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
```

```php
<!-- app/Views/etudiants/edit.php -->
<div class="container mt-4">
    <h1>Modifier un étudiant</h1>
    <?php if (isset($etudiant)): ?>
    <form action="/etudiants/update/<?= $etudiant['id'] ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" value="<?= $etudiant['nom'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" value="<?= $etudiant['age'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= $etudiant['email'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <?php endif; ?>
</div>
```

---

## 34. Debug HTML / CSS / JS

### HTML

| Erreur | Cause | Solution |
|---|---|---|
| Balise non fermée | Oubli de `</balise>` | Vérifier chaque balise ouvrante a sa fermeture |
| Balise mal imbriquée | Ordre d'ouverture/fermeture incorrect | Respecter l'imbrication (dernier ouvert = premier fermé) |
| Attribut oublié | Ex : `required`, `name` manquant | Comparer avec l'exemple de référence |

### CSS

| Erreur | Cause | Solution |
|---|---|---|
| Fichier CSS introuvable | Mauvais chemin dans `<link>` | Vérifier `/css/style.css` et le dossier `public/css/` |
| Classe inexistante | Classe non définie dans le CSS | Vérifier l'orthographe exacte de la classe |
| Bootstrap non chargé | CDN absent ou mal placé | Vérifier la balise `<link>` Bootstrap dans le `<head>` |

### JavaScript

| Erreur | Cause | Solution |
|---|---|---|
| Fonction introuvable | Script non chargé ou mal placé | Vérifier `<script src="...">` avant utilisation |
| `id` incorrect | `getElementById` ne correspond à aucun élément | Vérifier l'orthographe exacte de l'`id` en HTML |
| Erreur console | Erreur JS bloquante | Ouvrir la console navigateur (F12) et lire le message |

### CI4

| Erreur | Cause | Solution |
|---|---|---|
| Variable inexistante | Donnée non transmise par le Controller | Vérifier `$data['clé']` dans le Controller |
| `foreach` incorrect | Variable non itérable ou mal nommée | Vérifier que la variable est un tableau (`findAll()`) |
| View introuvable | Chemin `view()` incorrect | Vérifier `app/Views/etudiants/nom.php` |

---

## 35. Bonnes pratiques

- La View sert uniquement à afficher.
- Ne jamais écrire du SQL dans une View.
- Ne jamais écrire la logique métier dans une View.
- Toujours utiliser les données envoyées par le Controller (`$data`).
