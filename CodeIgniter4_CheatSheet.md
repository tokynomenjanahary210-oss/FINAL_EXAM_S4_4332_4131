# CodeIgniter 4 - CheatSheet (Projet Étudiant)

> Référence développeur — architecture MVC stricte, routes manuelles, Query Builder uniquement.
> Projet de référence : **Gestion des étudiants** (table `etudiant` : id, nom, age, email) — SQLite3.

## Table des matières

1. [Structure du projet](#structure-du-projet)
2. [Routes](#routes)
3. [Controllers](#controllers)
4. [Models](#models)
5. [Views](#views)
6. [Configuration SQLite](#configuration-sqlite)
7. [CRUD complet](#crud-complet)
8. [Formulaires HTML](#formulaires-html)
9. [Query Builder](#query-builder)
10. [Validation](#validation)
11. [Upload de fichiers](#upload-de-fichiers)
12. [Session](#session)
13. [Migrations](#migrations)
14. [Seeders](#seeders)
15. [Spark CLI](#spark-cli)
16. [Debug](#debug)
17. [Bonnes pratiques](#bonnes-pratiques)
18. [Autres méthodes (non utilisées par défaut)](#autres-méthodes-non-utilisées-par-défaut)

---

## Structure du projet

```
projet/
 app/
  Config/
   Routes.php
   Database.php
  Controllers/
   EtudiantController.php
  Models/
   EtudiantModel.php
  Views/
   etudiants/
    index.php
    create.php
    edit.php
 public/
  css/
   style.css
 writable/
  logs/
 database.db
 spark
```

---

## Routes

Toujours déclarées **manuellement** dans `app/Config/Routes.php`. Jamais d'Auto Routing, jamais de `ResourceController`, jamais de routes RESTful automatiques.

```php
// app/Config/Routes.php

$routes->get('/etudiants', 'EtudiantController::index');
$routes->get('/etudiants/create', 'EtudiantController::create');
$routes->post('/etudiants/store', 'EtudiantController::store');
$routes->get('/etudiants/edit/(:num)', 'EtudiantController::edit/$1');
$routes->post('/etudiants/update/(:num)', 'EtudiantController::update/$1');
$routes->get('/etudiants/delete/(:num)', 'EtudiantController::delete/$1');
```

Vérifier les routes déclarées :

```bash
php spark routes
```

---

## Controllers

Toujours étendre `BaseController`. Toujours les mêmes 6 méthodes.

```php
// app/Controllers/EtudiantController.php

<?php

namespace App\Controllers;

use App\Models\EtudiantModel;

class EtudiantController extends BaseController
{
    public function index()
    {
        $model = new EtudiantModel();
        $data['etudiants'] = $model->findAll();

        return view('etudiants/index', $data);
    }

    public function create()
    {
        return view('etudiants/create');
    }

    public function store()
    {
        $model = new EtudiantModel();

        $model->insert([
            'nom'   => $this->request->getPost('nom'),
            'age'   => $this->request->getPost('age'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/etudiants');
    }

    public function edit($id)
    {
        $model = new EtudiantModel();
        $data['etudiant'] = $model->find($id);

        return view('etudiants/edit', $data);
    }

    public function update($id)
    {
        $model = new EtudiantModel();

        $model->update($id, [
            'nom'   => $this->request->getPost('nom'),
            'age'   => $this->request->getPost('age'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/etudiants');
    }

    public function delete($id)
    {
        $model = new EtudiantModel();
        $model->delete($id);

        return redirect()->to('/etudiants');
    }
}
```

Règles fixes :
- Récupération des données : `$model = new EtudiantModel();`
- Envoi vers la View : `$data['etudiants'] = ...; return view('etudiants/index', $data);`
- POST : `$this->request->getPost('champ')`
- GET avec paramètre : `$id` reçu directement en argument de méthode
- Redirection : toujours `redirect()->to()`

---

## Models

Toujours étendre `Model`. Jamais d'Entity.

```php
// app/Models/EtudiantModel.php

<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table = 'etudiant';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'age', 'email'];
}
```

Méthodes autorisées uniquement :

```php
find($id)
findAll()
first()
insert($data)
update($id, $data)
delete($id)
where('colonne', $valeur)
like('colonne', $valeur)
orderBy('colonne', 'ASC')
join('table2', 'condition')
paginate($perPage)
```

---

## Views

Organisation obligatoire :

```
app/Views/etudiants/
 index.php
 create.php
 edit.php
```

Syntaxe imposée : `<?= ?>` pour l'affichage, `foreach ... endforeach`, `if ... endif`.

```php
<!-- app/Views/etudiants/index.php -->

<h1>Liste des étudiants</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['id'] ?></td>
            <td><?= $etudiant['nom'] ?></td>
            <td><?= $etudiant['age'] ?></td>
            <td><?= $etudiant['email'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

```php
<!-- app/Views/etudiants/edit.php -->

<?php if (isset($etudiant)): ?>
<form action="/etudiants/update/<?= $etudiant['id'] ?>" method="post">
    <input type="text" name="nom" value="<?= $etudiant['nom'] ?>">
    <input type="number" name="age" value="<?= $etudiant['age'] ?>">
    <input type="email" name="email" value="<?= $etudiant['email'] ?>">
    <button type="submit">Modifier</button>
</form>
<?php endif; ?>
```

---

## Configuration SQLite

```php
// app/Config/Database.php

public array $default = [
    'DSN'      => '',
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => 'database.db',
    'DBDriver' => 'SQLite3',
];
```

---

## CRUD complet

Chemin toujours identique : `Route → Controller → Model → SQLite → Controller → View`.

### INDEX

| Étape | Détail |
|---|---|
| Route | `$routes->get('/etudiants', 'EtudiantController::index');` |
| Controller | `EtudiantController::index()` |
| Model | `$model->findAll();` |
| View | `etudiants/index.php` |

### CREATE

| Étape | Détail |
|---|---|
| Route | `$routes->get('/etudiants/create', 'EtudiantController::create');` |
| Controller | `EtudiantController::create()` |
| View | `etudiants/create.php` |

### STORE (INSERT)

| Étape | Détail |
|---|---|
| Route | `$routes->post('/etudiants/store', 'EtudiantController::store');` |
| Controller | `EtudiantController::store()` |
| Model | `$model->insert($data);` |

### UPDATE

| Étape | Détail |
|---|---|
| Route (edit) | `$routes->get('/etudiants/edit/(:num)', 'EtudiantController::edit/$1');` |
| Route (update) | `$routes->post('/etudiants/update/(:num)', 'EtudiantController::update/$1');` |
| Controller | `edit($id)` puis `update($id)` |
| Model | `$model->find($id);` puis `$model->update($id, $data);` |
| View | `etudiants/edit.php` |

### DELETE

| Étape | Détail |
|---|---|
| Route | `$routes->get('/etudiants/delete/(:num)', 'EtudiantController::delete/$1');` |
| Controller | `EtudiantController::delete($id)` |
| Model | `$model->delete($id);` |

---

## Formulaires HTML

Toujours du HTML classique. Pas de `form_open()` / `form_close()` (voir section dédiée en fin de document).

```html
<!-- app/Views/etudiants/create.php -->

<form action="/etudiants/store" method="post">
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Age</label>
    <input type="number" name="age" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <button type="submit">Ajouter</button>
</form>
```

---

## Query Builder

```php
$model = new EtudiantModel();

// Trouver par ID
$model->find(1);

// Tout récupérer
$model->findAll();

// Premier résultat correspondant
$model->where('nom', 'Toky')->first();

// Recherche
$model->like('nom', 'To')->findAll();

// Jointure
$model->join('classe', 'classe.id = etudiant.classe_id')->findAll();

// Tri
$model->orderBy('nom', 'ASC')->findAll();

// Insertion
$model->insert(['nom' => 'Toky', 'age' => 21, 'email' => 'toky@gmail.com']);

// Mise à jour
$model->update(1, ['nom' => 'Toky Rakoto']);

// Suppression
$model->delete(1);

// Pagination
$model->paginate(10);
```

---

## Validation

```php
public function store()
{
    if (! $this->validate([
        'nom'   => 'required|min_length[2]|max_length[100]',
        'age'   => 'required|integer',
        'email' => 'required|valid_email',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $model = new EtudiantModel();
    $model->insert($this->request->getPost());

    return redirect()->to('/etudiants');
}
```

Règles principales :

```
required
valid_email
integer
numeric
min_length[n]
max_length[n]
```

---

## Upload de fichiers

```php
public function store()
{
    $file = $this->request->getFile('photo');

    if ($file->isValid() && ! $file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . '../public/uploads', $newName);
    }

    return redirect()->to('/etudiants');
}
```

---

## Session

```php
$session = session();

// Définir
$session->set('user_id', 1);

// Récupérer
$session->get('user_id');

// Supprimer une clé
$session->remove('user_id');

// Détruire toute la session
$session->destroy();
```

---

## Migrations

```bash
php spark make:migration CreateEtudiantTable
php spark migrate
php spark migrate:rollback
```

---

## Seeders

```bash
php spark make:seeder EtudiantSeeder
php spark db:seed EtudiantSeeder
```

---

## Spark CLI

```bash
php spark serve
php spark routes
php spark list
php spark help
php spark make:controller EtudiantController
php spark make:model EtudiantModel
php spark make:migration CreateEtudiantTable
php spark make:seeder EtudiantSeeder
```

---

## Debug

### Vérifier la syntaxe PHP

```bash
php -l app/Controllers/EtudiantController.php
```

### Vérifier les routes

```bash
php spark routes
```

### Consulter les logs

```bash
tail -50 writable/logs/log-$(date +%Y-%m-%d).log
```

### Inspecter la base SQLite

```bash
sqlite3 database.db
.tables
.schema etudiant
.database
```

```sql
SELECT * FROM etudiant;
```

### Erreurs fréquentes

| Erreur | Cause | Solution |
|---|---|---|
| `404 Page Not Found` | Route absente ou mal orthographiée | Vérifier `app/Config/Routes.php` et `php spark routes` |
| `Controller not found` | Mauvais namespace ou nom de fichier | Vérifier `namespace App\Controllers;` et le nom du fichier |
| `View not found` | Chemin de vue incorrect | Vérifier le chemin passé à `view()` dans `app/Views/` |
| `Undefined variable` | Variable non transmise depuis le Controller | Vérifier `$data['clé'] = ...` avant `view()` |
| `Database error` | Mauvaise configuration `Database.php` | Vérifier `DBDriver`, `database` |
| `no such table` | Table absente de `database.db` | Rejouer le script SQL avec `.read creation.sql` |
| `Unable to connect to the database` | Fichier `database.db` introuvable ou droits insuffisants | Vérifier le chemin et les permissions du fichier |
| `Unexpected token` | Erreur de syntaxe PHP dans une View | Vérifier les balises `<?php ?>` / `<?= ?>` |
| `Namespace incorrect` | Namespace ne correspond pas au dossier | Aligner `namespace` avec l'arborescence `app/` |
| Mauvais nom de dossier | Dossier de Views mal nommé | Respecter `app/Views/etudiants/` |
| Mauvais nom de View | Fichier `.php` mal nommé ou mal appelé | Vérifier l'orthographe exacte dans `view('etudiants/index')` |

---

## Bonnes pratiques

Chemin toujours respecté :

```
Route
  ↓
Controller
  ↓
Model
  ↓
Database
  ↓
Controller
  ↓
View
```

- Ne jamais accéder directement à la base depuis une View.
- Ne jamais écrire du SQL dans une View.
- Toute la logique métier reste dans le Controller ou le Model.

---

## Autres méthodes (non utilisées par défaut)

Ces helpers existent dans CodeIgniter 4 mais **ne sont pas utilisés** dans ce projet. Mentionnés uniquement à titre informatif.

```php
// Helper form (non utilisé dans ce projet)
echo form_open('etudiants/store');
echo form_close();
```
