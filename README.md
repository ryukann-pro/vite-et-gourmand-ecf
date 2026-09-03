# Vite et Gourmand

Application web réalisée dans le cadre du titre professionnel
Développeur Web et Web Mobile.

Le projet utilise PHP, MySQL et MongoDB.

---

## Liens utiles

- Dépôt GitHub public :
  https://github.com/ryukann-pro/vite-et-gourmand-ecf.git

- Application déployée :
  https://vite-et-gourmand-yoann-c184a5dfcfe5.herokuapp.com/

- Gestion de projet :
  https://trello.com/invite/b/69e727ac5f9f4a65b7e4119e/ATTIae3b15d5734033c14b4f8a20eb4025cf4D2AFA4F/vite-et-gourmand-ecf-2026

# Installation avec Docker (recommandée)

## Prérequis

Installer :

- Docker Desktop
- Git
- Un navigateur web

## 1. Cloner le projet

Ouvrir un terminal dans le dossier de votre choix puis exécuter :

git clone https://github.com/ryukann-pro/vite-et-gourmand-ecf.git

Se placer dans le projet :

cd vite-et-gourmand-ecf

## 2. Configurer les variables d'environnement

Créer un fichier `.env` à la racine du projet.

Renseigner les variables nécessaires à l'application à partir du fichier
`.env.example`.

Le fichier `.env` contient notamment la configuration de MySQL,
MongoDB et des services d'envoi d'e-mails.

Le fichier `.env` ne doit pas être envoyé sur Git.

## 3. Démarrer l'application

Lancer :

docker compose up -d --build

Lors du premier démarrage, Docker :

- construit l'environnement PHP / Apache ;
- installe les dépendances Composer ;
- démarre MySQL ;
- crée automatiquement la base de données ;
- exécute `database/schema.sql` ;
- exécute `database/data.sql` ;
- démarre MongoDB.

Le premier démarrage peut prendre quelques instants.

## 4. Accéder à l'application

Ouvrir dans un navigateur :

http://localhost:8080/public

## Commandes Docker utiles

Voir les conteneurs :

docker compose ps

Afficher les logs :

docker compose logs

Ouvrir MySQL dans le terminal :

docker exec -it vite_et_gourmand_mysql sh -c 'mysql --default-character-set=utf8mb4 -u root -p"$MYSQL_ROOT_PASSWORD" vite_et_gourmand'

Arrêter les conteneurs :

docker compose down

Redémarrer les conteneurs :

docker compose up -d

Reconstruire les images après une modification du Dockerfile :

docker compose up -d --build

---

# Installation manuelle avec WAMP

Cette méthode permet d'exécuter le projet sans Docker.

## Prérequis

Installer :

- WAMP ou équivalent
- Git
- Composer
- MongoDB
- Un navigateur web

## 1. Cloner le projet

Dans le dossier `www` de WAMP :

git clone https://github.com/ryukann-pro/vite-et-gourmand-ecf.git

Puis :

cd vite-et-gourmand-ecf

## 2. Installer les dépendances PHP

composer install

## 3. Créer la base MySQL

Dans phpMyAdmin ou MySQL :

CREATE DATABASE vite_et_gourmand
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

## 4. Importer les données

Importer dans cet ordre :

1. `database/schema.sql`
2. `database/data.sql`

## 5. Créer l'utilisateur MySQL

CREATE USER 'app_vite_gourmand'@'localhost'
IDENTIFIED BY 'mot_de_passe';

GRANT SELECT, INSERT, UPDATE, DELETE
ON vite_et_gourmand.*
TO 'app_vite_gourmand'@'localhost';

FLUSH PRIVILEGES;

## 6. Configurer `.env`

Créer le fichier `.env` à la racine du projet à partir de `.env.example`
et renseigner les paramètres correspondant à votre environnement local.

Pour une installation avec WAMP, remplacer notamment :

DB_HOST=mysql
par :
DB_HOST=localhost

et :

MONGO_HOST=mongodb
par :
MONGO_HOST=localhost

## 7. Lancer l'application

Démarrer WAMP puis accéder à :

http://localhost/vite-et-gourmand-ecf/public/

