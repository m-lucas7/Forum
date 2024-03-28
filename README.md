# Création d'un forum avec API Platform

Ce projet est réalisé dans le cadre du BTS SIO (Services Informatiques aux Organisations), spécialité Solutions d'Infrastructure, Systèmes et Réseaux. L'objectif est de créer un forum en utilisant API Platform.

### Table des matières

- [Installation du projet](#installation-du-projet)
- [Base de données](#base-de-données)
- [Mise en place de Faker](#mise-en-place-de-faker)
- [Installation et configuration d’API Platform](#installation-et-configuration-dapi-platform)
- [Pagination](#pagination)
- [Modifier la pagination pour l’ensemble des API](#modifier-la-pagination-pour-l’ensemble-des-api)
- [Pagination personnalisée sur chaque entité](#pagination-personnalisée-sur-chaque-entité)
- [Désactiver la pagination](#désactiver-la-pagination)
- [Les Groups](#les-groups)
- [Les filtres](#les-filtres)
- [Recherches](#recherches)
- [Tri](#tri)
- [Gestion des droits d’accès](#gestion-des-droits-d’accès)
- [Chiffre le mot de passe lors d’une inscription](#chiffre-le-mot-de-passe-lors-d’une-inscription)
- [Recevoir des données avec l’authentification](#recevoir-des-données-avec-l’authentification)

## Installation du projet

Version utilisée de PHP : 8.3

```
composer create-project symfony/skeleton forum 6.3.*
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
cp .env .env.local
```

## Base de données

```
DATABASE_URL="mysql://login????:XXXXXXXXXXXXXXX@127.0.0.1:3306/dbforum?serverVersion=10.3.39-MariaDB"
php bin/console doctrine:database:create
composer require symfony/security-bundle
php bin/console make:user
php bin/console make:entity User
```

Ajouter :

```
- nom : string de 30 caractères non nul
- prenom : string de 30 caractères non nul
- dateInscription : datetime non nul
```

- php bin/console make:entity Message

Ajouter :

```
- titre : string 50 caractères non nul
- datePoste : datetime non nul
- contenu : text non nul
- champ user relation ManyToOne vers User
- champ parent ManyToOne vers Message
```

- php bin/console make:migration
- php bin/console doctrine:migrations:migrate

## Mise en place de Faker

- composer require orm-fixtures --dev
- composer require fakerphp/faker
- php bin/console doctrine:fixtures:load

## Installation et configuration d’API Platform

- composer require api
- composer require symfony/apache-pack