<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Product;

$products = Product::where('is_active', 1)->get(['id', 'name', 'price', 'image', 'category_id']);

echo "Active products:\n";
foreach($products as $product) {
    echo "ID: {$product->id}, Name: {$product->name}, Price: {$product->price}, Image: {$product->image}, Category: {$product->category_id}\n";
}

echo "\nTotal active products: " . $products->count() . "\n";
