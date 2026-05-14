-- Je vais rentrer les données après la création des tables pour éviter les problèmes de contraintes de clés étrangères.

-- Certaines données seront des données de test pour vérifier le bon fonctionnement de l'application, 
-- tandis que d'autres seront des données réelles pour peupler la base de données.

-- Insertion des données dans la table role

INSERT INTO role (nom) VALUES
('Client'),
('Employé'),
('Admin');


-- Insertion des données dans la table statut_commande

INSERT INTO statut_commande (nom) VALUES
('en_attente'),
('acceptee'),
('en_preparation'),
('en_cours_de_livraison'),
('livree'),
('en_attente_retour_materiel'),
('terminee'),
('annulee');


-- Insertion des données dans la table ville_commande

INSERT INTO ville_commande (nom, distance_km) VALUES
('Bordeaux', 0),
('Mérignac', 8),
('Pessac', 7),
('Talence', 7),
('Bègles', 5),
('Cenon', 9),
('Lormont', 10),
('Le Bouscat', 3);


-- Insertion des données dans la table utilisateur

INSERT INTO utilisateur (
    nom, prenom, email, telephone, adresse, mot_de_passe_hash, role_id
) VALUES (
    'Dupont', 'Julie', 'julie.dupont@test.fr', '0600000000',
    '12 rue test', '$2y$10$5hEljTutQs6CFueBntcX9Oog/QG/c18PG63QDSjqPVcDfto4CTIL6', 1
);

-- Insertion des données dans la table restaurant

INSERT INTO restaurant (
    nom, description, adresse, telephone, email
) VALUES (
    'Vite et Gourmand',
    'Traiteur proposant des menus pour événements.',
    '12 Rue Sainte-Catherine',
    '0556000000',
    'contact@viteetgourmand.fr'
);


-- Insertion des données dans la table horaire

INSERT INTO horaire (jour_semaine, heure_ouverture, heure_fermeture, restaurant_id) VALUES
('Lundi', '07:30:00', '19:00:00', 1),
('Mardi', '07:30:00', '19:00:00', 1),
('Mercredi', '07:30:00', '19:00:00', 1),
('Jeudi', '07:30:00', '19:00:00', 1),
('Vendredi', '07:30:00', '19:00:00', 1),
('Samedi', '07:30:00', '19:00:00', 1),
('Dimanche', '07:30:00', '13:00:00', 1);


-- Insertion des données plat / allergenes

INSERT INTO allergene (nom) VALUES
('Gluten'),
('Lait'),
('Oeuf');

-- Insertion des données dans la table plat
INSERT INTO plat (nom, type_plat, description) VALUES
('Salade composée', 'Entrée', 'Entrée fraîche et légère.'),
('Poulet rôti', 'Plat principal', 'Plat principal accompagné de légumes.'),
('Tarte aux pommes', 'Dessert', 'Dessert fruité maison.');

-- Insertion des données dans la table plat_allergene
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES
(3, 1),
(3, 2);

--Inserttion des données dans la table theme
INSERT INTO theme (nom) VALUES
('Classique'),
('Événement'),
('Pâques'),
('Noël');

-- Insertion des données dans la table regime
INSERT INTO regime (nom) VALUES
('Standard'),
('Végétarien'),
('Vegan');

-- Insertion des données dans la table menu

INSERT INTO menu (
    titre,
    description_courte,
    description_longue,
    nb_personnes_min,
    prix_par_personne,
    stock,
    conditions,
    theme_id,
    regime_id,
    restaurant_id
) VALUES (
    'Menu Classique Test',
    'Un menu simple et gourmand.',
    'Menu complet composé d’une entrée, d’un plat et d’un dessert.',
    10,
    25.00,
    5,
    'Commande au moins 3 jours avant la prestation.',
    1,
    1,
    1
);


-- Insertion des données dans la table menu_plat

INSERT INTO menu_plat (menu_id, plat_id) VALUES
(1, 1),
(1, 2),
(1, 3);


-- Insertion des données dans la table image

INSERT INTO image (
    url,
    texte_alternatif,
    ordre_affichage,
    menu_id
) VALUES (
    'assets/images/menu-test.jpg',
    'Photo menu classique test',
    1,
    1
);


-- Insertion des données dans la table commande*

INSERT INTO commande (
    nom_client, prenom_client, telephone_client, email_client,
    nb_personnes, prix_unitaire, adresse_livraison,
    date_livraison, heure_livraison,
    frais_livraison, reduction, prix_total,
    pret_materiel, date_retour_materiel,
    utilisateur_id, menu_id, ville_id, statut_id
) VALUES (
    'Dupont', 'Julie', '0600000000', 'julie.dupont@test.fr',
    12, 25.00, '5 rue exemple',
    '2026-06-15', '12:30:00',
    7.95, 0.00, 307.95,
    TRUE, NULL,
    1, 1, 2, 1
);


-- Insertion des données dans la table suivi_commande

INSERT INTO suivi_commande (commande_id, statut_id) VALUES
(1, 1);


-- Insertion des données dans la table avis

INSERT INTO avis (
    note, commentaire, est_valide, commande_id, utilisateur_id
) VALUES (
    5, 'Très bonne prestation.', TRUE, 1, 1
);


/*
-- =========================
-- TESTS DES CLÉS ÉTRANGÈRES
-- Ces requêtes doivent échouer si les FK fonctionnent.
-- =========================

-- Test FK utilisateur -> role
INSERT INTO utilisateur (nom, prenom, email, mot_de_passe_hash, role_id)
VALUES ('Test', 'RoleInvalide', 'test_role@test.fr', 'hash_test', 999);

-- Test FK horaire -> restaurant
INSERT INTO horaire (jour_semaine, heure_ouverture, heure_fermeture, restaurant_id)
VALUES ('Lundi', '08:00:00', '18:00:00', 999);

-- Test FK message_contact -> restaurant
INSERT INTO message_contact (nom, prenom, email, titre, message, restaurant_id)
VALUES ('Test', 'Contact', 'contact@test.fr', 'Test FK', 'Message test', 999);

-- Test FK plat_allergene -> plat
INSERT INTO plat_allergene (plat_id, allergene_id)
VALUES (999, 1);

-- Test FK plat_allergene -> allergene
INSERT INTO plat_allergene (plat_id, allergene_id)
VALUES (1, 999);

-- Test FK menu_plat -> menu
INSERT INTO menu_plat (menu_id, plat_id)
VALUES (999, 1);

-- Test FK menu_plat -> plat
INSERT INTO menu_plat (menu_id, plat_id)
VALUES (1, 999);

-- Test FK image -> menu
INSERT INTO image (url, texte_alternatif, ordre_affichage, menu_id)
VALUES ('test.jpg', 'Image test', 1, 999);

-- Test FK commande -> utilisateur
INSERT INTO commande (
    nom_client, prenom_client, email_client, nb_personnes, prix_unitaire,
    adresse_livraison, date_livraison, heure_livraison,
    frais_livraison, reduction, prix_total,
    utilisateur_id, menu_id, ville_id, statut_id
)
VALUES (
    'Test', 'Commande', 'commande@test.fr', 10, 25.00,
    '1 rue test', '2026-06-15', '12:00:00',
    5.00, 0.00, 255.00,
    999, 1, 1, 1
);

-- Test FK commande -> menu
INSERT INTO commande (
    nom_client, prenom_client, email_client, nb_personnes, prix_unitaire,
    adresse_livraison, date_livraison, heure_livraison,
    frais_livraison, reduction, prix_total,
    utilisateur_id, menu_id, ville_id, statut_id
)
VALUES (
    'Test', 'Commande', 'commande_menu@test.fr', 10, 25.00,
    '1 rue test', '2026-06-15', '12:00:00',
    5.00, 0.00, 255.00,
    1, 999, 1, 1
);

-- Test FK commande -> ville_commande
INSERT INTO commande (
    nom_client, prenom_client, email_client, nb_personnes, prix_unitaire,
    adresse_livraison, date_livraison, heure_livraison,
    frais_livraison, reduction, prix_total,
    utilisateur_id, menu_id, ville_id, statut_id
)
VALUES (
    'Test', 'Commande', 'commande_ville@test.fr', 10, 25.00,
    '1 rue test', '2026-06-15', '12:00:00',
    5.00, 0.00, 255.00,
    1, 1, 999, 1
);

-- Test FK commande -> statut_commande
INSERT INTO commande (
    nom_client, prenom_client, email_client, nb_personnes, prix_unitaire,
    adresse_livraison, date_livraison, heure_livraison,
    frais_livraison, reduction, prix_total,
    utilisateur_id, menu_id, ville_id, statut_id
)
VALUES (
    'Test', 'Commande', 'commande_statut@test.fr', 10, 25.00,
    '1 rue test', '2026-06-15', '12:00:00',
    5.00, 0.00, 255.00,
    1, 1, 1, 999
);

-- Test FK suivi_commande -> commande
INSERT INTO suivi_commande (commande_id, statut_id)
VALUES (999, 1);

-- Test FK suivi_commande -> statut_commande
INSERT INTO suivi_commande (commande_id, statut_id)
VALUES (1, 999);

-- Test FK avis -> commande
INSERT INTO avis (note, commentaire, est_valide, commande_id, utilisateur_id)
VALUES (5, 'Test FK commande avis', TRUE, 999, 1);

-- Test FK avis -> utilisateur
INSERT INTO avis (note, commentaire, est_valide, commande_id, utilisateur_id)
VALUES (5, 'Test FK utilisateur avis', TRUE, 1, 999);

*/


-- Insertion du compte admin de josé

INSERT INTO utilisateur (
    nom, prenom, email, mot_de_passe_hash, role_id
) VALUES (
    'Jose', 'Admin', 'admin@vitegourmand.fr',
    '$2y$10$fctip2dguIDQqep/YbqJoOr8Ivj.kD/QR1GJoPbkZr0byM6H1lezm',
    3
);

-- Ajout telephone et adresse pour l'utilisateur admin
UPDATE utilisateur
SET 
    telephone = '0601020304',
    adresse = '12 Rue Sainte-Catherine, Bordeaux'
WHERE id = 3;