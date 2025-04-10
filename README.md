

# 💼 Application de Gestion Bancaire

Une application web sécurisée permettant à un administrateur de gérer les **clients**, **comptes bancaires**, et **contrats** d'une institution financière via une interface ergonomique et responsive construite avec **Bootstrap 5**.

---

## 🎯 Objectifs

Moderniser la gestion interne d'une banque grâce à :
- 🔐 Une **authentification sécurisée** de l’administrateur
- 👤 Une **gestion complète des clients**
- 🏦 Une **gestion intuitive des comptes bancaires**
- 📑 Un **suivi détaillé des contrats** (assurances, crédits, épargne logement)

---

## ⚙️ Fonctionnalités Principales

### 🔐 Authentification
- Connexion par **email + mot de passe**
- Sécurisation via **bcrypt** et **sessions**
- Redirection automatique vers le **tableau de bord**
- Déconnexion sécurisée

### 📊 Tableau de Bord
- Vue globale avec :
  - Nombre total de clients
  - Nombre total de comptes
  - Nombre total de contrats
- Cartes Bootstrap claires pour **navigation rapide**

### 👥 Gestion des Clients
- Création de client avec validation (nom, email, téléphone)
- Modification des données (hors identifiant client)
- Suppression (uniquement si aucun compte/contrat lié)
- Liste interactive avec **actions rapides**

### 💳 Gestion des Comptes
- Création d’un compte avec :
  - Type (courant, épargne)
  - RIB auto-généré
  - Solde initial ≥ 0 €
  - Client associé
- Modification type/solde
- Suppression avec confirmation

### 📄 Gestion des Contrats
- Types disponibles :
  - Assurance Vie
  - Crédit Immobilier / Consommation
  - Compte Épargne Logement (CEL)
- Montant, durée, client associé
- Modification / suppression avec validation

---

## 🛠️ Stack Technique

| Composant       | Technologie                    |
|-----------------|---------------------------------|
| **Back-end**     | PHP 8 (Architecture MVC)       |
| **Base de Données** | MySQL avec PDO & DAO      |
| **Front-end**    | HTML5, JavaScript, Bootstrap 5 |
| **Sécurité**     | bcrypt, sessions sécurisées, PDO |

---

## 🗂️ Architecture MVC

```
APPLICATION_BANCAIRE/

│
├── controllers/               → Contrôleurs métier
│   ├── AuthController.php
│   ├── ClientController.php
│   ├── CompteController.php
│   └── ContratController.php
│
├── models/                    → Représentation des entités
│   ├── Admin.php
│   ├── Client.php
│   ├── Compte.php
│   ├── Contrat.php
│   └── repositories/          → DAO (accès BDD via PDO)
│       ├── AdminRepository.php
│       ├── ClientRepository.php
│       ├── CompteRepository.php
│       └── ContratRepository.php
│
├── views/                     → Interfaces utilisateur
│   ├── Client/                → Pages clients
│   ├── Compte/                → Pages comptes
│   ├── Contrat/               → Pages contrats
│   ├── templates/             → Templates partagés
│   │   ├── header_main.php
│   │   └── footer.php
│   ├── home.php               → Tableau de bord
│   ├── login.php              → Connexion
│   └── 404.php                → Page d'erreur personnalisée
│
├── DataBase.sql               → Script SQL de création de la BDD
├── index.php                  → Point d’entrée de l’application
├── README.md                  → Documentation (ce fichier)
```

---

## 🖥️ Interface Utilisateur

- **Responsive** avec Bootstrap 5
- **Tableau de bord synthétique**
- **Navigation fluide** via un menu latéral
- **UI claire** : actions visibles, feedback utilisateur, icônes illustratives

---

## 🔐 Sécurité

- ✅ Mots de passe **hachés avec `bcrypt`**
- ✅ Sessions PHP **sécurisées** (via `$_SESSION`)
- ✅ Requêtes SQL **préparées avec PDO** pour éviter les injections
- ✅ Validation côté serveur des formulaires

---

## 🚀 Lancer le Projet (en local)

1. **Importer la base de données** via `DataBase.sql`
2. **Configurer l'accès BDD** dans le fichier `lib/Database.php` 
3. Lancer un serveur local PHP :

```bash
php -S localhost:8000
```

4. Naviguer vers : `http://localhost:8000`

---
