<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== TOUS LES UTILISATEURS FRUITABLES ===\n\n";

$users = User::with(['orders', 'cartItems'])->get();

foreach ($users as $user) {
    echo "=== UTILISATEUR {$user->id} ===\n";
    echo "Nom complet: {$user->first_name} {$user->last_name}\n";
    echo "Email: {$user->email}\n";
    echo "Admin: " . ($user->is_admin ? 'OUI' : 'NON') . "\n";
    echo "Actif: " . ($user->is_active ? 'OUI' : 'NON') . "\n";
    echo "Téléphone: " . ($user->phone ?? 'Non renseigné') . "\n";
    echo "Ville: " . ($user->city ?? 'Non renseignée') . "\n";
    echo "Pays: " . ($user->country ?? 'Non renseigné') . "\n";
    echo "Commandes: " . $user->orders->count() . "\n";
    echo "Articles dans panier: " . $user->cartItems->count() . "\n";
    echo "Mot de passe: password\n";
    echo "Créé le: " . $user->created_at->format('d/m/Y H:i') . "\n";
    echo "------------------------\n";
}

echo "\nTotal: " . $users->count() . " utilisateur(s)\n";

echo "\n=== RÉCAPITULATIF ===\n";
$admins = $users->where('is_admin', true);
$actifs = $users->where('is_active', true);

echo "Administrateurs: " . $admins->count() . "\n";
echo "Utilisateurs actifs: " . $actifs->count() . "\n";
echo "Utilisateurs inactifs: " . ($users->count() - $actifs->count()) . "\n";
