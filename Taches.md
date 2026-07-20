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
- Modèle OtherOperatorModel pour la gestion des opérateurs externes (Orange, Yas)
- AdminController : CRUD autres opérateurs (ajout, modification, suppression)
- AdminController : configuration commission globale pour transferts vers Orange/Yas
- AdminController : dashboard Airtel uniquement (total frais, nombre dépôts, retraits, transferts)
- AdminController : gains simplifiés Airtel (total frais + commissions à reverser)
- AdminController : page montants à reverser par opérateur externe (Orange, Yas)
- Views admin : other_operators.php, edit_other_operator.php, commission.php, amounts_to_send.php
- Mise à jour admin/index.php pour statistiques Airtel
- Mise à jour admin/gains.php pour affichage simplifié
- Mise à jour Routes.php avec nouvelles routes Version 2
- Mise à jour base.sql : Airtel comme opérateur principal, Orange/Yas comme externes

### Toky
- Mise à jour ClientController : login uniquement pour clients Airtel (033, 035)
- Mise à jour ClientController : rejet des transferts vers Orange/Yas en mode multi-envoi
- Mise à jour ClientController : commission calculée sur le montant (pas sur les frais) pour transferts externes
- Mise à jour ClientController : option "inclure frais de retrait" uniquement pour transferts Airtel→Airtel
- Mise à jour ClientController : envoi multiple uniquement entre clients Airtel
- Mise à jour View client/transfert.php : validation JavaScript préfixes Airtel, bouton + pour ajout dynamique
- Mise à jour TransactionModel : ajout colonnes is_external, external_operator_id, commission_amount
- Tests des fonctionnalités Version 2 (transferts Airtel uniquement, commissions, multi-envoi Airtel)
