

#  Fruitables - E-commerce de Produits Bio

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Fruitables est une plateforme e-commerce moderne et complète dédiée à la vente de produits biologiques (fruits, légumes, produits laitiers, viandes, etc.). Développée avec Laravel 12, elle offre une expérience utilisateur fluide et un dashboard administrateur complet.

## ✨ Fonctionnalités Principales

### 👤 Côté Client
- ✅ Authentification sécurisée (inscription, connexion, mot de passe oublié)
- ✅ Navigation par catégories de produits
- ✅ Système de recherche avancée
- ✅ Panier d'achat dynamique avec gestion des quantités
- ✅ Processus de checkout simplifié
- ✅ Paiement à la livraison
- ✅ Suivi des commandes en temps réel
- ✅ Gestion du profil utilisateur
- ✅ Système de commentaires sur les produits
- ✅ Interface responsive (mobile, tablette, desktop)
- ✅ Design moderne avec animations

### 🔧 Côté Administrateur
- ✅ Dashboard avec statistiques en temps réel
- ✅ Gestion complète des produits (CRUD)
- ✅ Gestion des catégories
- ✅ Gestion des commandes avec mise à jour de statut
- ✅ Gestion des statuts de paiement
- ✅ Gestion des clients
- ✅ Système de messagerie avec notifications
- ✅ Notifications intelligentes (nouvelles commandes, stock faible, nouveaux clients)
- ✅ Génération de factures détaillées
- ✅ Filtrage par période (aujourd'hui, semaine, mois, année)
- ✅ Interface admin sécurisée et intuitive

## 🎨 Fonctionnalités Avancées

- 🔔 **Notifications en temps réel** : Badge de notifications pour nouvelles commandes, stock faible, nouveaux clients
- 📄 **Système de factures** : Génération automatique de factures professionnelles
- 🏷️ **Gestion intelligente des catégories** : Les produits d'une catégorie inactive disparaissent automatiquement
- 📊 **Dashboard analytics** : Statistiques détaillées avec filtres temporels
- 🎯 **Produits similaires** : Suggestions basées sur la catégorie
- 💬 **Système de commentaires** : Les clients peuvent laisser des avis
- 📧 **Formulaire de contact** : Communication directe avec l'administration

## 🛠️ Technologies Utilisées

### Backend
- **Framework:** Laravel 11
- **Base de données:** MySQL
- **Authentification:** Laravel Breeze


### Frontend
- **Framework CSS:** Bootstrap 5
- **Icons:** Font Awesome 6
- **JavaScript:** Vanilla JS
- **Design:** Responsive & Mobile-First

### Outils & Libraries
- **Pagination personnalisée**
- **Gestion d'images:** Laravel Storage
- **Validation de formulaires**
- **Session Management**

## 📦 Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL >= 8.0


### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/TON_USERNAME/fruitables.git
cd fruitables
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
```

4. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
Éditer `.env` avec vos informations:
```env
DB_DATABASE=fruitables
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

6. **Migrer la base de données**
```bash
php artisan migrate --seed
```

7. **Créer le lien symbolique pour le storage**
```bash
php artisan storage:link
```

8. **Compiler les assets**
```bash
npm run dev
```

9. **Lancer le serveur**
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 👥 Comptes de Test

Après le seeding, vous pouvez utiliser:

**Admin:**
- Email: `admin@fruitables.com`
- Mot de passe: `password`

**Client:**
- Email: `user@fruitables.com`
- Mot de passe: `password`

## 📁 Structure du Projet
```
fruitables/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controllers admin
│   │   ├── Auth/           # Authentification
│   │   └── ...
│   └── Models/             # Modèles Eloquent
├── database/
│   ├── migrations/         # Migrations DB
│   └── seeders/            # Seeders
├── public/
│   ├── assets/            # CSS, JS, Images
│   └── storage/           # Fichiers uploadés
├── resources/
│   └── views/
│       ├── admin/         # Vues admin
│       ├── auth/          # Vues authentification
│       ├── components/    # Composants réutilisables
│       └── ...
└── routes/
    └── web.php            # Routes de l'application
```

## 🎯 Roadmap

- [ ] Intégration paiement en ligne (Stripe/PayPal)
- [ ] Système de wishlist
- [ ] Export PDF des factures
- [ ] Notifications par email
- [ ] Système de points de fidélité
- [ ] Chat en temps réel

## 📸 Captures d'écran

[<img width="1366" height="3061" alt="image" src="https://github.com/user-attachments/assets/f1b67696-e3ba-4608-860b-7f031f65b386" />
<img width="1366" height="794" alt="image" src="https://github.com/user-attachments/assets/73ac4d06-6a47-4bb9-b174-90bf9669fa00" />
<img width="1366" height="617" alt="image" src="https://github.com/user-attachments/assets/4664c353-15d0-4e10-9398-b4b3ba9a8b36" />


]

## 🤝 Contribution

Les contributions sont les bienvenues! N'hésitez pas à:
1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request



## 👤 Auteur

**Hamza Boufous**
- Linkedin: [@hamzaboufous](https://www.linkedin.com/in/hamza-boufous-758416391/)
- Email: hamzaboufous731@gmail.com

## 🙏 Remerciements

- Laravel Team pour cet excellent framework
- Bootstrap pour le framework CSS
- Font Awesome pour les icônes



⭐ Si ce projet vous a aidé, n'hésitez pas à lui donner une étoile!

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

are licensed under the [MIT license](https://opensource.org/licenses/MIT).
(Initial commit - Fruitables Laravel project)
