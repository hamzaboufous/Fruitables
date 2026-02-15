<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $fruitsCategory = Category::where('slug', 'fruits')->first();
        $vegetablesCategory = Category::where('slug', 'legumes')->first();

        $products = [
            [
                'name' => 'Pommes Golden',
                'slug' => 'pommes-golden',
                'description' => 'Pommes Golden croquantes et sucrées, idéales pour les desserts ou à croquer nature.',
                'short_description' => 'Pommes Golden bio et croquantes',
                'price' => 3.99,
                'sku' => 'POM-GOL-001',
                'quantity' => 100,
                'is_active' => true,
                'category_id' => $fruitsCategory->id,
                'image' => 'products/pommes-golden.jpg',
            ],
            [
                'name' => 'Bananes Bio',
                'slug' => 'bananes-bio',
                'description' => 'Bananes douces et riches en potassium, parfaites pour un en-cas énergétique.',
                'short_description' => 'Bananes bio et douces',
                'price' => 2.49,
                'sku' => 'BAN-BIO-002',
                'quantity' => 150,
                'is_active' => true,
                'category_id' => $fruitsCategory->id,
                'image' => 'products/bananes-bio.jpg',
            ],
            [
                'name' => 'Tomates Cerises',
                'slug' => 'tomates-cerises',
                'description' => 'Tomates cerises juteuses et sucrées, parfaites pour les salades et apéritifs.',
                'short_description' => 'Tomates cerises juteuses',
                'price' => 4.99,
                'sku' => 'TOM-CER-003',
                'quantity' => 80,
                'is_active' => true,
                'category_id' => $vegetablesCategory->id,
                'image' => 'products/tomates-cerises.jpg',
            ],
            [
                'name' => 'Carottes Bio',
                'slug' => 'carottes-bio',
                'description' => 'Carottes fraîches et croquantes, riches en vitamines et bêta-carotène.',
                'short_description' => 'Carottes bio et croquantes',
                'price' => 2.99,
                'sku' => 'CAR-BIO-004',
                'quantity' => 120,
                'is_active' => true,
                'category_id' => $vegetablesCategory->id,
                'image' => 'products/carottes-bio.jpg',
            ],
            [
                'name' => 'Raisins Noirs',
                'slug' => 'raisins-noirs',
                'description' => 'Raisins noirs juteux et sucrés, parfaits pour les desserts ou le snacking.',
                'short_description' => 'Raisins noirs juteux',
                'price' => 5.99,
                'sku' => 'RAI-NOI-005',
                'quantity' => 60,
                'is_active' => true,
                'category_id' => $fruitsCategory->id,
                'image' => 'products/raisins-noirs.jpg',
            ],
            [
                'name' => 'Framboises',
                'slug' => 'framboises',
                'description' => 'Framboises délicates et parfumées, riches en antioxydants.',
                'short_description' => 'Framboises délicates et parfumées',
                'price' => 8.99,
                'sku' => 'FRA-001',
                'quantity' => 40,
                'is_active' => true,
                'category_id' => $fruitsCategory->id,
                'image' => 'products/framboises.jpg',
            ],
            [
                'name' => 'Abricots',
                'slug' => 'abricots',
                'description' => 'Abricots juteux et sucrés, riches en vitamine A et fibres.',
                'short_description' => 'Abricots juteux et sucrés',
                'price' => 6.99,
                'sku' => 'ABR-002',
                'quantity' => 50,
                'is_active' => true,
                'category_id' => $fruitsCategory->id,
                'image' => 'products/abricots.jpg',
            ],
            [
                'name' => 'Salade Verte',
                'slug' => 'salade-verte',
                'description' => 'Salade verte croquante et fraîche, parfaite pour vos salades estivales.',
                'short_description' => 'Salade verte croquante',
                'price' => 1.99,
                'sku' => 'SAL-VER-006',
                'quantity' => 90,
                'is_active' => true,
                'category_id' => $vegetablesCategory->id,
                'image' => 'products/salade-verte.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
