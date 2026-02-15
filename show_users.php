<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

echo "=== UTILISATEURS FRUITABLES ===\n\n";

$users = User::all(['id', 'first_name', 'last_name', 'email']);

foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Nom complet: {$user->first_name} {$user->last_name}\n";
    echo "Email: {$user->email}\n";
    echo "Mot de passe: password\n";
    echo "----------------------------\n";
}

echo "\nTotal: " . $users->count() . " utilisateur(s)\n";
