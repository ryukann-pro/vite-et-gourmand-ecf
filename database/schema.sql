SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
-- Je vais créer les tables sans les contraintes de clés étrangères pour éviter les problèmes d'ordre de création, 
-- Mais je les ajouterai ensuite pour assurer l'intégrité référentielle.


-- Création de la table role

CREATE TABLE role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);


-- Création de la table utilisateur
-- Email limité à 191 caractères pour compatibilité avec utf8mb4 et index UNIQUE (limite de taille des index MySQL)
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    adresse VARCHAR(255),
    mot_de_passe_hash VARCHAR(255) NOT NULL,
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actif TINYINT(1) NOT NULL DEFAULT 1,
    role_id INT NOT NULL
);

-- Création de la table reinitialisation_mot_de_passe

CREATE TABLE reinitialisation_mot_de_passe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL UNIQUE,
    token_hash CHAR(64) NOT NULL UNIQUE,
    date_expiration DATETIME NOT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table restaurant

CREATE TABLE restaurant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    adresse VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(191) NOT NULL UNIQUE
);

-- Création de la table horaire
CREATE TABLE horaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jour_semaine ENUM('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche') NOT NULL,
    heure_ouverture TIME NOT NULL,
    heure_fermeture TIME NOT NULL,
    restaurant_id INT NOT NULL
);


-- Création de la table message_contact

CREATE TABLE message_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(191) NOT NULL,
    telephone VARCHAR(20),
    titre VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    restaurant_id INT NOT NULL
);

-- Création de la table allergene
CREATE TABLE allergene (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

-- Création de la table plat
CREATE TABLE plat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    type_plat ENUM('Entrée', 'Plat principal', 'Dessert') NOT NULL,
    description TEXT
);

-- Création de la table plat_allergene pour la relation many-to-many entre plat et allergene
CREATE TABLE plat_allergene (
    plat_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (plat_id, allergene_id)
);

-- Création de la table theme
CREATE TABLE theme (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Création de la table regime
CREATE TABLE regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Création de la table menu
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description_courte TEXT,
    description_longue TEXT,
    nb_personnes_min INT NOT NULL,
    prix_par_personne DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    conditions TEXT,
    theme_id INT NOT NULL,
    regime_id INT NOT NULL,
    restaurant_id INT NOT NULL
);
-- Création de la table menu_plat pour la relation many-to-many entre menu et plat
CREATE TABLE menu_plat (
    menu_id INT NOT NULL,
    plat_id INT NOT NULL,
    PRIMARY KEY (menu_id, plat_id)
);

-- Création de la table image

CREATE TABLE image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    texte_alternatif VARCHAR(255),
    ordre_affichage INT NOT NULL,
    menu_id INT NOT NULL
);

-- Création de la table ville_commande
CREATE TABLE ville_commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    distance_km INT NOT NULL
);

-- Création de la table statut_commande
CREATE TABLE statut_commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Création de la table commande
CREATE TABLE commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_client VARCHAR(100) NOT NULL,
    prenom_client VARCHAR(100) NOT NULL,
    telephone_client VARCHAR(20),
    email_client VARCHAR(191) NOT NULL,
    nb_personnes INT NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    adresse_livraison VARCHAR(255) NOT NULL,
    date_livraison DATE NOT NULL,
    heure_livraison TIME NOT NULL,
    frais_livraison DECIMAL(10, 2) NOT NULL,
    reduction DECIMAL(10, 2) DEFAULT 0,
    prix_total DECIMAL(10, 2) NOT NULL,
    pret_materiel BOOLEAN NOT NULL DEFAULT FALSE,
    date_retour_materiel DATE,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    utilisateur_id INT NOT NULL,
    menu_id INT NOT NULL,
    ville_id INT NOT NULL,
    statut_id INT NOT NULL
);



-- Création table suivi_commande
CREATE TABLE suivi_commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_changement DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    commande_id INT NOT NULL,
    statut_id INT NOT NULL,
    utilisateur_id INT NULL
);

-- Création de la table avis
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note INT NOT NULL CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    est_valide BOOLEAN NOT NULL DEFAULT FALSE,
    commande_id INT NOT NULL,
    utilisateur_id INT NOT NULL
);


-- Passage des tables en INNODB pour supporter les clés étrangères
ALTER TABLE role ENGINE = InnoDB;
ALTER TABLE utilisateur ENGINE = InnoDB;
ALTER TABLE reinitialisation_mot_de_passe ENGINE = InnoDB;
ALTER TABLE restaurant ENGINE = InnoDB;
ALTER TABLE horaire ENGINE = InnoDB;
ALTER TABLE message_contact ENGINE = InnoDB;
ALTER TABLE allergene ENGINE = InnoDB;
ALTER TABLE plat ENGINE = InnoDB;
ALTER TABLE plat_allergene ENGINE = InnoDB;
ALTER TABLE theme ENGINE = InnoDB;
ALTER TABLE regime ENGINE = InnoDB;
ALTER TABLE menu ENGINE = InnoDB;
ALTER TABLE menu_plat ENGINE = InnoDB;
ALTER TABLE image ENGINE = InnoDB;
ALTER TABLE ville_commande ENGINE = InnoDB;
ALTER TABLE statut_commande ENGINE = InnoDB;
ALTER TABLE commande ENGINE = InnoDB;
ALTER TABLE suivi_commande ENGINE = InnoDB;
ALTER TABLE avis ENGINE = InnoDB;



-- Ajout des contraintes de clés étrangères après la création de toutes les tables pour éviter les problèmes d'ordre de création


-- Clés étrangères pour la table utilisateur
ALTER TABLE utilisateur
ADD CONSTRAINT fk_utilisateur_role
FOREIGN KEY (role_id) REFERENCES role(id);

-- Clé étrangère pour la table reinitialisation_mot_de_passe

ALTER TABLE reinitialisation_mot_de_passe
ADD CONSTRAINT fk_reinitialisation_mot_de_passe_utilisateur
FOREIGN KEY (utilisateur_id)
REFERENCES utilisateur(id)
ON DELETE CASCADE;

-- Clés étrangères pour la table horaire
ALTER TABLE horaire
ADD CONSTRAINT fk_horaire_restaurant
FOREIGN KEY (restaurant_id) REFERENCES restaurant(id);


-- Clés étrangères pour la table message_contact
ALTER TABLE message_contact
ADD CONSTRAINT fk_message_contact_restaurant
FOREIGN KEY (restaurant_id) REFERENCES restaurant(id);

-- Clés étrangères pour la table menu
ALTER TABLE menu
ADD CONSTRAINT fk_menu_theme
FOREIGN KEY (theme_id) REFERENCES theme(id);

ALTER TABLE menu
ADD CONSTRAINT fk_menu_regime
FOREIGN KEY (regime_id) REFERENCES regime(id);

ALTER TABLE menu
ADD CONSTRAINT fk_menu_restaurant
FOREIGN KEY (restaurant_id) REFERENCES restaurant(id);

-- Clés étrangères pour la table plat_allergene

ALTER TABLE plat_allergene
ADD CONSTRAINT fk_plat_allergene_plat
FOREIGN KEY (plat_id) REFERENCES plat(id);

ALTER TABLE plat_allergene
ADD CONSTRAINT fk_plat_allergene_allergene
FOREIGN KEY (allergene_id) REFERENCES allergene(id);


-- Clés étrangères pour la table menu_plat

ALTER TABLE menu_plat
ADD CONSTRAINT fk_menu_plat_menu
FOREIGN KEY (menu_id) REFERENCES menu(id);

ALTER TABLE menu_plat
ADD CONSTRAINT fk_menu_plat_plat
FOREIGN KEY (plat_id) REFERENCES plat(id);

-- Clés étrangères pour la table image

ALTER TABLE image
ADD CONSTRAINT fk_image_menu
FOREIGN KEY (menu_id) REFERENCES menu(id);

-- Clés étrangères pour la table commande

ALTER TABLE commande
ADD CONSTRAINT fk_commande_utilisateur
FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id);

ALTER TABLE commande
ADD CONSTRAINT fk_commande_menu
FOREIGN KEY (menu_id) REFERENCES menu(id);

ALTER TABLE commande
ADD CONSTRAINT fk_commande_ville
FOREIGN KEY (ville_id) REFERENCES ville_commande(id);

ALTER TABLE commande
ADD CONSTRAINT fk_commande_statut
FOREIGN KEY (statut_id) REFERENCES statut_commande(id);

-- Clés étrangères pour la table suivi_commande

ALTER TABLE suivi_commande
ADD CONSTRAINT fk_suivi_commande_commande
FOREIGN KEY (commande_id) REFERENCES commande(id);

ALTER TABLE suivi_commande
ADD CONSTRAINT fk_suivi_commande_statut
FOREIGN KEY (statut_id) REFERENCES statut_commande(id);

ALTER TABLE suivi_commande
ADD CONSTRAINT fk_suivi_commande_utilisateur
FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id);


-- Clés étrangères pour la table avis

ALTER TABLE avis
ADD CONSTRAINT fk_avis_commande
FOREIGN KEY (commande_id) REFERENCES commande(id);

ALTER TABLE avis
ADD CONSTRAINT fk_avis_utilisateur
FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id);