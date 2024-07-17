# README

## Projet : Bibliothèque Municipale de Port-Cartier

### Introduction

Ce projet vise à moderniser le site web de la bibliothèque municipale de Port-Cartier en développant une bibliothèque fictive. Cette application permettra aux employés de gérer les réservations et les dossiers clients grâce à une méthode de structure MVC, tout en utilisant des technologies modernes telles que HTML, CSS, JavaScript, PHP et MySQL.

### Objectifs

- Interpréter et analyser les spécifications.
- Concevoir une solution conforme aux demandes.
- Développer la logique d'une application web.
- Utiliser des langages et technologies web.
- Gérer les interactions avec une base de données.
- Appliquer des techniques de dépannage.
- Valider la solution par des tests.
- Intégrer les connaissances acquises en formation.
- Explorer de nouvelles technologies.
- Créer une application web tout en s'amusant.

### Technologies Utilisées

- **PHP** : Logique serveur.
- **MySQL** : Gestion des bases de données.
- **JavaScript** : Interactions dynamiques.
- **Bootstrap** : Design réactif et esthétique.
- **Responsive Design** : Expérience utilisateur sur tous les appareils.
- **Architecture MVC** : Structure claire et maintenable.

### Spécifications

Le système gère cinq types d'objets :

- **Membres**
- **Employés**
- **Documents** (livres, films, jeux, etc.)
- **Prêts**
- **Réservations**

#### Détails des Entités

1. **Membre** :
   - Code du membre (clé primaire)
   - Nom, prénom, adresse, téléphone, courriel, mot de passe

2. **Document** :
   - Code du document (clé primaire)
   - Titre, auteur, année de publication, catégorie, type, genre, description, ISBN (si applicable)

### Types d'Utilisateurs

- **Membres**
- **Employés**
- **Administrateurs**

### Fonctionnalités

- Formulaire de connexion.
- Recherche de documents et réservation.
- Gestion des prêts et retours par les employés.
- Création de membres et employés par les administrateurs.
- Enregistrement des transactions de prêts et réservations.

### Rapports Disponibles

Les employés peuvent consulter :

- Liste des membres
- Liste des retards
- Liste de tous les documents
- Liste des documents réservés
- Liste des documents prêtés

### Responsivité

Le site est conçu pour être réactif, garantissant une expérience utilisateur optimale sur tous les appareils grâce à Bootstrap.

### Étapes de Développement

1. **Planification du Modèle de Données** : Création de la base de données avec normalisation.
2. **Design des Interfaces** : Ébauches approuvées par l'instructeur.
3. **Développement** : Implémentation suivant l'architecture MVC.