<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fruits',
                'slug' => 'fruits',
                'description' => 'Fruits frais et bio de saison',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Légumes',
                'slug' => 'legumes',
                'description' => 'Légumes frais et bio de nos producteurs locaux',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Produits laitiers',
                'slug' => 'produits-laitiers',
                'description' => 'Fromages et produits laitiers artisanaux',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Pain et Boulangerie',
                'slug' => 'pain-boulangerie',
                'description' => 'Pains frais et produits de boulangerie artisanaux',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Viandes',
                'slug' => 'viandes',
                'description' => 'Viandes de qualité et bio',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
