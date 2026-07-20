# SQLite3 - CheatSheet (Projet CodeIgniter 4)

> Référence développeur — utilisation exclusive de `sqlite3` en ligne de commande.
> Aucun outil graphique (pas de DB Browser). Base de référence : `database.db`, table `etudiant` (id, nom, age, email).

## Table des matières

1. [Notre méthode](#notre-méthode)
2. [Installation](#installation)
3. [Créer une base](#créer-une-base)
4. [Ouvrir une base](#ouvrir-une-base)
5. [Commandes SQLite](#commandes-sqlite)
6. [Création des tables](#création-des-tables)
7. [Insertion](#insertion)
8. [Lecture](#lecture)
9. [Modification](#modification)
10. [Suppression](#suppression)
11. [Modifier la structure](#modifier-la-structure)
12. [Import SQL](#import-sql)
13. [Export](#export)
14. [Sauvegarde](#sauvegarde)
15. [Relations](#relations)
16. [Utilisation avec CodeIgniter 4](#utilisation-avec-codeigniter-4)
17. [Workflow utilisé dans notre projet](#workflow-utilisé-dans-notre-projet)
18. [Debug SQLite](#debug-sqlite)
19. [Erreurs fréquentes](#erreurs-fréquentes)
20. [Bonnes pratiques](#bonnes-pratiques)
21. [Raccourcis utiles](#raccourcis-utiles)

---

## Notre méthode

Le projet utilise SQLite3 avec CodeIgniter 4. `database.db` est placée à la racine du projet.

```
projet/
 app/
 public/
 database.db
 spark
```

---

## Installation

```bash
sqlite3 --version
```

```bash
sudo apt install sqlite3
```

---

## Créer une base

Toujours par ligne de commande, jamais par outil graphique.

```bash
touch database.db
sqlite3 database.db
```

---

## Ouvrir une base

```bash
sqlite3 database.db
```

Prompt affiché :

```
sqlite>
```

Quitter :

```
.quit
.exit
```

---

## Commandes SQLite

| Commande | Rôle |
|---|---|
| `.tables` | Liste les tables de la base |
| `.database` | Affiche la base actuellement ouverte |
| `.schema` | Affiche la structure SQL des tables |
| `.headers on` | Affiche les noms de colonnes dans les résultats |
| `.mode column` | Affiche les résultats en colonnes alignées |
| `.help` | Liste toutes les commandes disponibles |
| `.read` | Exécute un fichier `.sql` |
| `.dump` | Exporte la base en SQL |
| `.output` | Redirige la sortie vers un fichier |
| `.import` | Importe des données depuis un fichier |

```bash
sqlite> .headers on
sqlite> .mode column
sqlite> .tables
```

---

## Création des tables

```sql
CREATE TABLE etudiant (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    age INTEGER NOT NULL,
    email TEXT NOT NULL UNIQUE
);
```

Éléments utilisés :

```
PRIMARY KEY
AUTOINCREMENT
INTEGER
TEXT
NOT NULL
UNIQUE
```

---

## Insertion

```sql
INSERT INTO etudiant (nom, age, email) VALUES ('Toky', 21, 'toky@gmail.com');
INSERT INTO etudiant (nom, age, email) VALUES ('Rado', 22, 'rado@gmail.com');
```

---

## Lecture

```sql
SELECT * FROM etudiant;

SELECT nom, email FROM etudiant;

SELECT * FROM etudiant WHERE age > 20;

SELECT * FROM etudiant WHERE nom LIKE 'To%';

SELECT * FROM etudiant ORDER BY nom ASC;

SELECT * FROM etudiant LIMIT 5;

SELECT COUNT(*) FROM etudiant;
```

---

## Modification

```sql
UPDATE etudiant SET age = 23 WHERE nom = 'Toky';

UPDATE etudiant SET email = 'toky.new@gmail.com' WHERE id = 1;
```

---

## Suppression

```sql
DELETE FROM etudiant WHERE id = 2;

DROP TABLE etudiant;
```

---

## Modifier la structure

```sql
ALTER TABLE etudiant ADD COLUMN telephone TEXT;

ALTER TABLE etudiant RENAME TO etudiants_v2;

DROP TABLE etudiant;
```

---

## Import SQL

Méthode unique utilisée dans ce projet.

```bash
# 1. Créer le fichier creation.sql avec les instructions CREATE TABLE / INSERT

# 2. Ouvrir la base
sqlite3 database.db
```

```sql
-- 3. Dans le prompt sqlite>
.read creation.sql
```

---

## Export

```bash
sqlite3 database.db
```

```sql
.output backup.sql
.dump
```

---

## Sauvegarde

```bash
# Créer un backup
sqlite3 database.db ".dump" > backup.sql

# Restaurer un backup
sqlite3 database_restauree.db < backup.sql
```

---

## Relations

```sql
CREATE TABLE classe (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL
);

CREATE TABLE etudiant (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    age INTEGER NOT NULL,
    email TEXT NOT NULL UNIQUE,
    classe_id INTEGER,
    FOREIGN KEY (classe_id) REFERENCES classe(id)
);
```

Relation **One To Many** : une `classe` a plusieurs `etudiant`.

---

## Utilisation avec CodeIgniter 4

```php
// app/Config/Database.php

public array $default = [
    'database' => 'database.db',
    'DBDriver' => 'SQLite3',
];
```

MySQL n'est pas utilisé dans ce projet.

---

## Workflow utilisé dans notre projet

```
Créer database.db
     ↓
sqlite3 database.db
     ↓
Créer creation.sql
     ↓
.read creation.sql
     ↓
.tables
     ↓
SELECT * FROM etudiant;
     ↓
Configurer Database.php
     ↓
Créer Model
     ↓
Créer Controller
     ↓
Créer View
     ↓
Afficher les données avec findAll()
```

---

## Debug SQLite

Vérifier la base ouverte :

```sql
.database
```

Voir les tables :

```sql
.tables
```

Voir la structure :

```sql
.schema etudiant
```

Voir les données :

```sql
SELECT * FROM etudiant;
```

Afficher les colonnes :

```sql
PRAGMA table_info(etudiant);
```

---

## Erreurs fréquentes

| Erreur | Cause | Solution |
|---|---|---|
| `no such table` | La table n'a pas été créée dans la base ouverte | Rejouer `.read creation.sql` puis vérifier avec `.tables` |
| `database is locked` | Une autre connexion utilise déjà la base | Fermer les autres connexions/process ouverts sur `database.db` |
| `syntax error` | Erreur dans une requête SQL | Relire la requête, vérifier virgules et points-virgules |
| `unable to open database` | Fichier introuvable ou droits insuffisants | Vérifier le chemin et les permissions du fichier `database.db` |
| fichier `database.db` introuvable | Commande lancée depuis le mauvais dossier | Se placer à la racine du projet avant `sqlite3 database.db` |
| `.read` ne fonctionne pas | Nom de fichier incorrect ou mauvais dossier courant | Vérifier le nom exact de `creation.sql` et le dossier courant |
| CodeIgniter ne trouve pas la table | Table créée dans une autre base ou mauvais chemin dans `Database.php` | Vérifier que `database` pointe vers le bon fichier `database.db` |

---

## Bonnes pratiques

- Toujours créer les tables avec un fichier SQL (`creation.sql`).
- Toujours sauvegarder les scripts SQL.
- Ne jamais modifier directement une base importante sans backup.
- Toujours tester avec `SELECT *`.
- Toujours vérifier `.tables`.
- Toujours vérifier `.database`.

---

## Raccourcis utiles

| Action | Commande |
|---|---|
| Créer une base | `touch database.db` |
| Ouvrir | `sqlite3 database.db` |
| Importer | `.read creation.sql` |
| Afficher tables | `.tables` |
| Afficher données | `SELECT * FROM etudiant;` |
| Quitter | `.quit` |
