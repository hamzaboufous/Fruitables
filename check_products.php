<?php

use App\Models\Product;
use App\Models\Category;

$products = Product::count();
$active = Product::where('is_active', 1)->count();
$categories = Category::count();

echo "Total products: $products\n";
echo "Active products: $active\n";
echo "Total categories: $categories\n";

// Afficher quelques produits
$sampleProducts = Product::take(3)->get(['id', 'name', 'price', 'image', 'is_active', 'category_id']);
echo "\nSample products:\n";
foreach ($sampleProducts as $product) {
    echo "ID: {$product->id}, Name: {$product->name}, Price: {$product->price}, Image: {$product->image}, Active: {$product->is_active}, Category: {$product->category_id}\n";
}
