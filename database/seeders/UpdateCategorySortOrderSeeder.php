<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class UpdateCategorySortOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mettre à jour toutes les catégories existantes avec sort_order basé sur l'ID
        $categories = Category::all();
        
        foreach ($categories as $index => $category) {
            $category->sort_order = $index + 1;
            $category->save();
        }
        
        $this->command->info('Categories sort_order updated successfully!');
    }
}
