-- Rôles
INSERT INTO role (nom) VALUES
('Client'),
('Employé'),
('Admin');

-- Restaurant
INSERT INTO restaurant (nom, description, adresse, telephone, email) VALUES
(
    'Vite et Gourmand',
    'Traiteur proposant des menus pour événements.',
    '12 Rue Sainte-Catherine',
    '0556000000',
    'contact@viteetgourmand.fr'
);

-- Utilisateur administrateur José
INSERT INTO utilisateur (
    nom, prenom, email, telephone, adresse, mot_de_passe_hash, role_id
) VALUES (
    'Jose',
    'Admin',
    'admin@vitegourmand.fr',
    '0601020304',
    '12 Rue Sainte-Catherine, Bordeaux',
    '$2y$10$fctip2dguIDQqep/YbqJoOr8Ivj.kD/QR1GJoPbkZr0byM6H1lezm',
    3
);

-- Horaires
INSERT INTO horaire (jour_semaine, heure_ouverture, heure_fermeture, restaurant_id) VALUES
('Lundi', '07:30:00', '19:00:00', 1),
('Mardi', '07:30:00', '19:00:00', 1),
('Mercredi', '07:30:00', '19:00:00', 1),
('Jeudi', '07:30:00', '19:00:00', 1),
('Vendredi', '07:30:00', '19:00:00', 1),
('Samedi', '07:30:00', '19:00:00', 1),
('Dimanche', '07:30:00', '13:00:00', 1);

-- Thèmes
INSERT INTO theme (nom) VALUES
('Classique'),
('Événement'),
('Noël'),
('Pâques');

-- Régimes
INSERT INTO regime (nom) VALUES
('Standard'),
('Vegan'),
('Végétarien');

-- Allergènes
INSERT INTO allergene (nom) VALUES
('Gluten'),
('Lait'),
('Oeuf'),
('Fruits à coque'),
('Céleri'),
('Soja'),
('Moutarde'),
('Sulfites');

-- Plats
INSERT INTO plat (nom, type_plat, description) VALUES
('Mini verrines de saumon fumé', 'Entrée', 'Verrines fraîches au saumon fumé, fromage frais et herbes.'),
('Suprême de volaille sauce champignons', 'Plat principal', 'Volaille tendre accompagnée de légumes de saison.'),
('Tartelette chocolat noisette', 'Dessert', 'Tartelette gourmande au chocolat et éclats de noisette.'),

('Velouté de potimarron aux épices', 'Entrée', 'Velouté doux et réconfortant aux notes de Noël.'),
('Gratin de légumes d’hiver', 'Plat principal', 'Légumes de saison gratinés avec une sauce crémeuse.'),
('Bûche poire chocolat', 'Dessert', 'Bûche végétarienne à la poire et au chocolat.'),

('Houmous de pois chiches et crudités', 'Entrée', 'Entrée vegan fraîche à base de pois chiches et légumes croquants.'),
('Curry de légumes au lait de coco', 'Plat principal', 'Curry vegan parfumé accompagné de riz.'),
('Moelleux vegan au chocolat', 'Dessert', 'Dessert vegan fondant au chocolat noir.'),

('Terrine de légumes printaniers', 'Entrée', 'Terrine fraîche aux légumes de saison.'),
('Gigot d’agneau aux herbes', 'Plat principal', 'Agneau rôti accompagné de pommes de terre fondantes.'),
('Nid de Pâques chocolat praliné', 'Dessert', 'Dessert chocolaté inspiré des traditions de Pâques.'),

('Mini brochettes de légumes grillés', 'Entrée', 'Brochettes vegan colorées et savoureuses.'),
('Bouchées falafel et sauce tahini', 'Plat principal', 'Bouchées vegan aux pois chiches avec sauce tahini.'),
('Verrine mangue coco', 'Dessert', 'Dessert frais à la mangue et crème coco.'),

('Foie gras de canard et chutney', 'Entrée', 'Foie gras accompagné d’un chutney de saison.'),
('Dinde rôtie aux herbes de Noël', 'Plat principal', 'Dinde rôtie avec accompagnement de légumes de saison.'),
('Bûche chocolat praliné', 'Dessert', 'Bûche traditionnelle au chocolat et praliné.');

-- Liens plats / allergènes
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES
(1, 2), (1, 8),
(2, 2), (2, 5),
(3, 1), (3, 2), (3, 3), (3, 4),

(4, 2),
(5, 2),
(6, 1), (6, 2), (6, 3),

(7, 6),
(8, 5),
(9, 6),

(10, 3),
(11, 7),
(12, 1), (12, 2), (12, 3), (12, 4),

(13, 6),
(14, 6),
(15, 4),

(16, 1), (16, 8),
(17, 5),
(18, 1), (18, 2), (18, 3), (18, 4);

-- Menus
INSERT INTO menu (
    titre, description_courte, description_longue,
    nb_personnes_min, prix_par_personne, stock, conditions,
    theme_id, regime_id, restaurant_id
) VALUES
('Buffet Signature Réception',
'Buffet traiteur complet pour réceptions professionnelles ou privées, équilibré et gourmand.',
'Un buffet complet pensé pour les réceptions professionnelles ou privées, avec une entrée fraîche, un plat généreux et un dessert gourmand.',
10, 18.00, 10, 'Commande au moins 3 jours avant la prestation.', 2, 1, 1),

('Festin Végétarien de Noël',
'Menu festif végétarien de Noël avec plats chauds et accompagnements de saison.',
'Un menu végétarien chaleureux et festif, idéal pour célébrer Noël avec des produits de saison.',
8, 22.00, 8, 'Commande au moins 5 jours avant la prestation.', 3, 3, 1),

('Menu Vegan Équilibré',
'Menu vegan complet et équilibré pour repas du quotidien.',
'Un menu vegan complet, équilibré et savoureux, pensé pour allier gourmandise et légèreté.',
6, 20.00, 12, 'Commande au moins 3 jours avant la prestation.', 1, 2, 1),

('Tradition Gourmande de Pâques',
'Menu traditionnel de Pâques avec plats rôtis et garnitures printanières.',
'Un menu de Pâques généreux et traditionnel, composé de recettes gourmandes et printanières.',
8, 24.00, 8, 'Commande au moins 5 jours avant la prestation.', 4, 1, 1),

('Cocktail Vegan Événementiel',
'Buffet vegan moderne avec finger food pour événements.',
'Un cocktail vegan moderne, pratique et convivial, idéal pour les événements professionnels ou privés.',
15, 21.00, 10, 'Commande au moins 4 jours avant la prestation.', 2, 2, 1),

('Menu Festif Traditionnel',
'Menu festif traditionnel avec entrée, plat et dessert de saison.',
'Un menu festif classique et généreux, parfait pour les repas de fête et les grandes occasions.',
5, 32.00, 6, 'Commande au moins 1 semaine avant la prestation.', 3, 1, 1);

-- Liens menus / plats
INSERT INTO menu_plat (menu_id, plat_id) VALUES
(1, 1), (1, 2), (1, 3),
(2, 4), (2, 5), (2, 6),
(3, 7), (3, 8), (3, 9),
(4, 10), (4, 11), (4, 12),
(5, 13), (5, 14), (5, 15),
(6, 16), (6, 17), (6, 18);

-- Images
INSERT INTO image (url, texte_alternatif, ordre_affichage, menu_id) VALUES
('assets/images/menus/evenement/buffet-signature-reception/standard-1.jpg', 'Buffet Signature Réception', 1, 1),
('assets/images/menus/evenement/buffet-signature-reception/standard-2.jpg', 'Buffet Signature Réception', 2, 1),
('assets/images/menus/evenement/buffet-signature-reception/standard-3.jpg', 'Buffet Signature Réception', 3, 1),

('assets/images/menus/noel/festin-vegetarien-noel/vegetarien-1.jpg', 'Festin Végétarien de Noël', 1, 2),
('assets/images/menus/noel/festin-vegetarien-noel/vegetarien-2.jpg', 'Festin Végétarien de Noël', 2, 2),
('assets/images/menus/noel/festin-vegetarien-noel/vegetarien-3.jpg', 'Festin Végétarien de Noël', 3, 2),

('assets/images/menus/classique/menu-vegan-equilibre/vegan-1.jpg', 'Menu Vegan Équilibré', 1, 3),
('assets/images/menus/classique/menu-vegan-equilibre/vegan-2.jpg', 'Menu Vegan Équilibré', 2, 3),
('assets/images/menus/classique/menu-vegan-equilibre/vegan-3.jpg', 'Menu Vegan Équilibré', 3, 3),

('assets/images/menus/paques/tradition-gourmande-paques/standard-1.jpg', 'Tradition Gourmande de Pâques', 1, 4),
('assets/images/menus/paques/tradition-gourmande-paques/standard-2.jpg', 'Tradition Gourmande de Pâques', 2, 4),
('assets/images/menus/paques/tradition-gourmande-paques/standard-3.jpg', 'Tradition Gourmande de Pâques', 3, 4),

('assets/images/menus/evenement/cocktail-vegan-evenementiel/vegan-1.jpg', 'Cocktail Vegan Événementiel', 1, 5),
('assets/images/menus/evenement/cocktail-vegan-evenementiel/vegan-2.jpg', 'Cocktail Vegan Événementiel', 2, 5),
('assets/images/menus/evenement/cocktail-vegan-evenementiel/vegan-3.jpg', 'Cocktail Vegan Événementiel', 3, 5),

('assets/images/menus/noel/menu-festif-traditionnel/standard-1.jpg', 'Menu Festif Traditionnel', 1, 6),
('assets/images/menus/noel/menu-festif-traditionnel/standard-2.jpg', 'Menu Festif Traditionnel', 2, 6),
('assets/images/menus/noel/menu-festif-traditionnel/standard-3.jpg', 'Menu Festif Traditionnel', 3, 6);

-- Statut_commande
INSERT INTO statut_commande (nom) VALUES
('en_attente'),
('acceptee'),
('en_preparation'),
('en_cours_de_livraison'),
('livree'),
('en_attente_retour_materiel'),
('terminee'),
('annulee');

-- Villes
INSERT INTO ville_commande (nom, distance_km) VALUES
('Bordeaux', 0),
('Mérignac', 8),
('Pessac', 7),
('Talence', 7),
('Bègles', 5),
('Cenon', 9),
('Lormont', 10),
('Le Bouscat', 3);