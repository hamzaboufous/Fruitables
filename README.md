

# 🍎 Fruitables - E-commerce de Produits Bio

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Fruitables est une plateforme e-commerce moderne et complète dédiée à la vente de produits biologiques (fruits, légumes, produits laitiers, viandes, etc.). Développée avec Laravel 11, elle offre une expérience utilisateur fluide et un dashboard administrateur complet.

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
- **ORM:** Eloquent

### Frontend
- **Framework CSS:** Bootstrap 5
- **Icons:** Font Awesome 6
- **JavaScript:** Vanilla JS
- **Design:** Responsive & Mobile-First

### Outils & Libraries
- **Pagination personnalisée**
- **Gestion d'images:** Laravel Storage
- **Validation de formulaires**
- **CSRF Protection**
- **Session Management**

## 📦 Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM

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
- [ ] Codes promo et réductions
- [ ] Export PDF des factures
- [ ] API REST pour application mobile
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

## 📝 License

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👤 Auteur

**Hamza Boufous**
- GitHub: [@hamzaboufous](https://github.com/hamzaboufous)
- Email: hamzaboufous731@gmail.com

## 🙏 Remerciements

- Laravel Team pour cet excellent framework
- Bootstrap pour le framework CSS
- Font Awesome pour les icônes
- Tous les contributeurs open-source

---

⭐ Si ce projet vous a aidé, n'hésitez pas à lui donner une étoile!
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
(Initial commit - Fruitables Laravel project)
