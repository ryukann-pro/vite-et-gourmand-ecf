# Installation du projet Vite et Gourmand avec WAMP (ou autre)

## Prérequis

Installer les outils suivants :

- WAMP ou équivalent
- Git
- Un navigateur web

---

# 1. Cloner le projet

Ouvrir un terminal dans le dossier `www` de WAMP :
puis taper la commande :
git clone https://github.com/ryukann-pro/vite-et-gourmand-ecf.git

# 2. Créer la base de données

Dans phpMyAdmin éxecuter les lignes SQL suivantes
CREATE DATABASE vite_et_gourmand
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

# 3. Importer les fichiers SQL

Importer les fichiers suivant dans l'ordre 
database/schema.sql
database/data.sql

# 4. Créer l’utilisateur MySQL

Taper ces requêtes SQL suivantes:
CREATE USER 'app_vite_gourmand'@'localhost'
IDENTIFIED BY 'mot_de_passe'; --en utilisant un mot de passe sécurisé

GRANT SELECT, INSERT, UPDATE, DELETE
ON vite_et_gourmand.*
TO 'app_vite_gourmand'@'localhost';

FLUSH PRIVILEGES;

# 5. Configurer le fichier .env

Créer un fichier .env à la racine avec dedans : 
DB_HOST=localhost
DB_NAME=vite_et_gourmand
DB_USER=app_vite_gourmand
DB_PASSWORD=mot_de_passe

# 6. Lancer le projet

Démarrez WAMP puis : 
option 1 - accéder à l'URL suivante : http://localhost/vite-et-gourmand-ecf/public/
option 2 - lancer localhost depuis l'interface de wamp, cliquez sur vite-et-gourmand-ecf et sur public



# Installation du projet Vite et Gourmand avec WAMP (ou autre)

## Prérequis

Installer les outils suivants :

- Docker Desktop
- Git
- Un navigateur web

# 1. Cloner le projet

Ouvrir un terminal dans le dossier de votre choix (ou le projet sera copié) de :
puis taper la commande :
git clone https://github.com/ryukann-pro/vite-et-gourmand-ecf.git



# Démarrer les conteneurs
docker compose up -d

# Arrêter les conteneurs
docker compose down

# Ouvrir MySQL
docker exec -it vite_et_gourmand_mysql sh -c 'mysql --default-character-set=utf8mb4 -u root -p"$MYSQL_ROOT_PASSWORD" vite_et_gourmand'

# Voir les conteneurs
docker ps