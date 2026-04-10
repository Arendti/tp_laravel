# Gestion de Projets et Tickets

## Description

Cette application web est une plateforme de gestion de projets et de tickets. Elle permet aux utilisateurs de créer, gérer et suivre des projets, des tickets associés, ainsi que des contrats. Les utilisateurs peuvent être assignés à des projets et des tickets, avec différents rôles.

## Fonctionnalités principales

- **Gestion des utilisateurs** : Création, authentification, rôles (admin, développeur, etc.), profils personnels. Un utilisateur peut être créé grâce à la page register.Les utilisateurs peuvent changer leur profil : nom, email, mot de passe.
- **Gestion des projets** : Création, modification et suppression de projets.
- **Gestion des tickets** : Création de tickets avec titre, description, type, statut, priorité. Assignation à des utilisateurs et projets.
- **Interface utilisateur** : Interface web utilisant CSS pour le style.
- **API** : une route API est utilisée pour l'ajout d'un ticket grâce à une modale. Une fois les données envoyées, il faut attendre que les entrées soient prises en compte puis recharger la page pour voir les modifications.
- **Gestion du temps** : Création d'entrées de temps (dans les détails du ticket). Pour chaque ticket, le développeur (et administrateur) peut créer des entrées de temps qui permetteront de calculer le temps passé sur un ticket et de changer le status du ticket en fonction de ces entrées.

### Rôles des utilisateurs

- **Administrateur** : possède tous les droits disponibles et peut voir tous les projets et tous les tickets. Il a également accès à la page de modification des rôles des utilisateurs.
- **Développeur** : ne peut voir que les projets et les tickets sur lesquels il travaille. Il peut créer, modifier et supprimer des tickets et des projets. Il peut créer des entrées de temps pour un ticket.
- **Client** : peut voir ses projets et les tickets liés à ce projet. Il ne peut ni créer ni modifier ni supprimer des projets. Il ne peut pas créer, modifier ou supprimer de tickets. Il ne peut pas créer d'entrées de temps, mais il peut valider ou refuser un ticket facturable lorsque le développeur l'a terminé.

### Connexion à un compte

Pour vous connecter à un compte déjà existant (ceux qui se trouvent dans le seeder) :
- **Email** : nom@example.com
- **Mot de passe** : nomPassword (sauf pour test@example.com, le mot de passe est juste password)

## Technologies utilisées

- **Backend** : Laravel (PHP Framework)
- **Frontend** : JavaScript, CSS

## Structure du projet

- `app/Models/` : Modèles Eloquent pour User, Ticket, Project, Contract
- `app/Http/Controllers/` : Contrôleurs pour gérer la logique métier
- `database/migrations/` : Migrations pour créer les tables de base de données
- `resources/views/` : Vues Blade pour l'interface utilisateur
- `routes/` : Définition des routes web et API
- `public/` : Assets statiques (CSS, JS, images)

## Modèles principaux

- **User** : Représente les utilisateurs avec nom, email, mot de passe et rôle.
- **Project** : Représente les projets avec titre, description et lien vers un contrat.
- **Ticket** : Représente les tickets avec titre, type, statut, priorité, description et temps réel.
- **Time_Entry** : Représente les entrées de temps avec date, durée et commentaire.