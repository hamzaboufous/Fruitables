<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Product;

$products = [
    1 => 'products/pommes-golden.jpg',
    2 => 'products/bananes-bio.jpg',
    3 => 'products/tomates-cerises.jpg',
    4 => 'products/carottes-bio.jpg',
    5 => 'products/raisins-noirs.jpg',
    6 => 'products/framboises.jpg',
    7 => 'products/abricots.jpg',
    8 => 'products/salade-verte.jpg',
];

foreach ($products as $id => $image) {
    Product::where('id', $id)->update(['image' => $image]);
    echo "Updated product ID $id with image: $image\n";
}

echo "\nAll products updated!\n";
