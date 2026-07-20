-- Base de données SQLite pour Mobile Money Operator - Version 2

-- Table des opérateurs
CREATE TABLE operators (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    prefixes TEXT NOT NULL,
    external_commission_percentage REAL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des types d'opérations
CREATE TABLE operation_types (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des barèmes de frais par tranche
CREATE TABLE fee_brackets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    operation_type_id INTEGER NOT NULL,
    min_amount INTEGER NOT NULL,
    max_amount INTEGER NOT NULL,
    fee INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (operation_type_id) REFERENCES operation_types(id)
);

-- Table des clients
CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    phone_number TEXT NOT NULL UNIQUE,
    balance INTEGER DEFAULT 0,
    full_name TEXT DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des transactions
CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER NOT NULL,
    operation_type_id INTEGER NOT NULL,
    amount INTEGER NOT NULL,
    fee INTEGER DEFAULT 0,
    balance_before INTEGER NOT NULL,
    balance_after INTEGER NOT NULL,
    description TEXT,
    related_client_id INTEGER,
    is_external INTEGER DEFAULT 0,
    external_operator_id INTEGER,
    commission_amount INTEGER DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (operation_type_id) REFERENCES operation_types(id),
    FOREIGN KEY (related_client_id) REFERENCES clients(id),
    FOREIGN KEY (external_operator_id) REFERENCES other_operators(id)
);

-- Table des autres opérateurs (Version 2)
CREATE TABLE other_operators (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    prefixes TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Données initiales pour l'opérateur
INSERT INTO operators (name, prefixes, external_commission_percentage) VALUES ('MobileMoney', '033,037', 10);

-- Données initiales pour les types d'opérations
INSERT INTO operation_types (code, name, description) VALUES ('depot', 'Dépôt', 'Dépôt d''argent sur le compte');
INSERT INTO operation_types (code, name, description) VALUES ('retrait', 'Retrait', 'Retrait d''argent du compte');
INSERT INTO operation_types (code, name, description) VALUES ('transfert', 'Transfert', 'Transfert d''argent vers un autre compte');

-- Données initiales pour les barèmes de frais
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 100, 1000, 50);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 1001, 5000, 50);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 5001, 10000, 100);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 10001, 25000, 200);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 25001, 50000, 400);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 50001, 100000, 800);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 100001, 250000, 1500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 250001, 500000, 1500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 500001, 1000000, 2500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (2, 1000001, 2000000, 3000);

INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 100, 1000, 50);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 1001, 5000, 50);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 5001, 10000, 100);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 10001, 25000, 200);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 25001, 50000, 400);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 50001, 100000, 800);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 100001, 250000, 1500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 250001, 500000, 1500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 500001, 1000000, 2500);
INSERT INTO fee_brackets (operation_type_id, min_amount, max_amount, fee) VALUES (3, 1000001, 2000000, 3000);

-- Clients de test
INSERT INTO clients (phone_number, balance, full_name) VALUES ('0331234567', 50000, 'Client Test');
INSERT INTO clients (phone_number, balance, full_name) VALUES ('0377654321', 20000, 'Client Destinataire');

-- Autres opérateurs (Version 2)
INSERT INTO other_operators (name, prefixes) VALUES ('Yas', '034,038');
INSERT INTO other_operators (name, prefixes) VALUES ('Orange', '032,037');
INSERT INTO other_operators (name, prefixes) VALUES ('Airtel', '033,035');
