<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

// Créer quelques commentaires de test
$users = User::take(3)->get();
$products = Product::take(5)->get();

$testComments = [
    [
        'comment' => 'Produits exceptionnels ! Fraîcheur garantie et livraison rapide. Je recommande vivement.',
        'rating' => 5,
    ],
    [
        'comment' => 'Très satisfaite de la qualité des fruits bio. Le goût est incomparable avec ce qu\'on trouve en supermarché.',
        'rating' => 5,
    ],
    [
        'comment' => 'Bons produits mais un peu cher. La qualité est là au moins.',
        'rating' => 4,
    ],
    [
        'comment' => 'Service client excellent et produits toujours frais. Continuez comme ça !',
        'rating' => 5,
    ],
    [
        'comment' => 'Les légumes sont super frais et bien emballés. Je suis cliente depuis 6 mois.',
        'rating' => 4,
    ],
    [
        'comment' => 'Expérience parfaite du début à la fin. Site facile à utiliser et produits de qualité.',
        'rating' => 5,
    ],
];

foreach ($testComments as $index => $commentData) {
    $user = $users[$index % $users->count()];
    $product = $products[$index % $products->count()];
    
    // Vérifier si le commentaire existe déjà
    $existing = Comment::where('user_id', $user->id)
        ->where('product_id', $product->id)
        ->first();
    
    if (!$existing) {
        Comment::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $commentData['rating'],
            'comment' => $commentData['comment'],
        ]);
        
        echo "Commentaire créé : {$user->full_name} - {$product->name} ({$commentData['rating']} étoiles)\n";
    } else {
        echo "Commentaire existe déjà : {$user->full_name} - {$product->name}\n";
    }
}

echo "\nCommentaires de test créés avec succès !\n";
