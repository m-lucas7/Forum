# Création d'un forum avec API Platform

Ce projet est réalisé dans le cadre du BTS SIO (Services Informatiques aux Organisations), spécialité Solutions d'Infrastructure, Systèmes et Réseaux. L'objectif est de créer un forum en utilisant API Platform.

### Table des matières

- [Installation du projet](#installation-du-projet)
- [Base de données](#base-de-données)
- [Construire un jeu d’essai](#construire-un-jeu-d’essai)
- [Installation et configuration d’API Platform](#installation-et-configuration-d’api-platform)
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

composer create-project symfony/skeleton forum 6.3.*
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
cp .env .env.local

## Base de données