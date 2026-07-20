- [Toky_4332]
- [Hasina_4131]

https://forms.gle/nCv6xJYHVvVJj2FKA

## Version 1 - Livraison v1

### Hasina
- Configuration de l'environnement CodeIgniter 4
- Configuration SQLite (Database.php)
- Création du fichier base.sql (tables, vues, données)
- Création des Models (OperatorModel, OperationTypeModel, FeeBracketModel, ClientModel, TransactionModel)
- Création du AdminController (tableau de bord, préfixes, types d'opérations, barèmes de frais, gains, clients)
- Création des Views admin (index, prefixes, operation_types, fee_brackets, gains, clients)

### Toky
- Création du ClientController (login automatique, solde, dépôt, retrait, transfert, historique, déconnexion)
- Création des Views client (login, dashboard, depot, retrait, transfert, historique)
- Configuration des Routes.php (routes manuelles)
- Création de la page d'accueil (home.php)
- Tests et vérification des fonctionnalités
- Initialisation Git et création du tag v1

## Version 2 - Livraison v2

### Hasina
- Modèle OtherOperatorModel pour la gestion des autres opérateurs
- AdminController : CRUD autres opérateurs (ajout, modification, suppression)
- AdminController : configuration commission globale
- AdminController : page gains séparés (frais internes, frais externes, commissions à reverser)
- AdminController : page montants à reverser par opérateur
- Views admin : other_operators.php, edit_other_operator.php, commission.php, amounts_to_send.php
- Mise à jour gains.php pour affichage séparé
- Mise à jour Routes.php avec nouvelles routes Version 2
- Mise à jour base.sql avec table other_operators et colonnes Version 2

### Toky
- Mise à jour ClientController : détection automatique opérateur externe
- Mise à jour ClientController : calcul commission sur transferts externes
- Mise à jour ClientController : option "inclure frais de retrait"
- Mise à jour ClientController : envoi multiple vers plusieurs numéros
- Mise à jour View client/transfert.php (case à cocher, support multi-destinataires)
- Tests des fonctionnalités Version 2 (transferts internes/externes, commissions, multi-envoi)
