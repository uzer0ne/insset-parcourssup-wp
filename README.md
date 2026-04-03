# 🎓 Application ParcoursSup - Plugin WordPress (Projet INSSET)

Ce projet est une extension WordPress développée dans le cadre de la Licence Pro 2025-2026. 
Il simule le fonctionnement de la plateforme ParcoursSup, permettant aux étudiants de formuler des vœux de formation lors de campagnes spécifiques.

## 🚀 Fonctionnalités principales

### 👨‍🎓 Front-Office (Côté Étudiant)
- **Authentification et Inscription :** Système de compte étudiant avec mot de passe sécurisé (hash Bcrypt) et gestion des sessions PHP.
- **Sélection des choix :** Interface permettant de sélectionner exactement 3 vœux dans un ordre strict.
- **Logique métier stricte :** - Empêche la sélection de doublons (géré en temps réel via jQuery et vérifié côté serveur).
  - Ordre de sélection obligatoire (choix n+1 grisé tant que le choix n n'est pas fait).
  - Blocage du double vote (un étudiant ne peut participer qu'une seule fois par campagne).
- **Confirmation :** Page récapitulative des vœux enregistrés.

### ⚙️ Back-Office (Côté Administrateur)
- **Gestion des campagnes :** Ajout, modification, et suppression de campagnes.
- **Règles de suppression :** Impossible de supprimer une campagne si des étudiants y ont déjà participé.
- **Résultats :** Visualisation des vœux des étudiants par campagne sous forme de tableau.
- **Export CSV :** Génération côté serveur d'un fichier `.csv` récapitulatif pour téléchargement.

## 🛠️ Stack Technique et Architecture
- **Architecture MVC & POO :** Code structuré en Modèles (CRUD), Vues (HTML/PHP), et Contrôleurs.
- **Base de données :** - Création automatique des tables à l'activation (`dbDelta`).
  - Utilisation du modèle **Entité/Valeur (EAV)** pour garantir une extensibilité maximale des choix.
- **Sécurité :** Requêtes préparées contre les injections SQL, utilisation des **Nonces WordPress** contre les failles CSRF.
- **Front-end :** Intégration de **jQuery** (manipulation du DOM) et de **LESS** (Nesting, Mixins, Variables) compilé en CSS.

## 📥 Guide d'installation pour l'évaluation

1. Cloner ou placer ce dépôt dans le dossier `wp-content/plugins/` de votre installation WordPress locale.
2. Dans le Back-Office de WordPress, allez dans **Extensions** et activez **Projet INSSET - ParcoursSup**. *(Les 6 tables personnalisées seront créées automatiquement).*
3. Créez 4 pages dans WordPress et insérez-y les shortcodes suivants :
   - Page Connexion (slug: `connexion`) : `[insset_login]`
   - Page Inscription (slug: `inscription`) : `[insset_register]`
   - Page des Choix (slug: `choix`) : `[insset_choices]`
   - Page Confirmation (slug: `confirmation`) : `[insset_confirmation]`
4. Allez dans le menu **ParcoursSup** du Back-Office pour créer votre première campagne !
