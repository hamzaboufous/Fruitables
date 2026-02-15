<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Filtrer UNIQUEMENT les produits dont la catégorie est active
        $query = Product::where('is_active', true)
            ->whereHas('category', function($q) {
                $q->where('is_active', true);
            })
            ->with('category');

        // Filter by category if specified
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)
                ->where('is_active', true) // Vérifier que la catégorie est active
                ->first();
            
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('short_description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $products = $query->latest()->paginate(12); // 12 produits par page
        
        // Filtrer aussi les catégories dans le sidebar (uniquement actives)
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('shop', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('category', function($query) {
                $query->where('is_active', true);
            })
            ->firstOrFail();
        
        // Produits similaires (même logique)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->whereHas('category', function($query) {
                $query->where('is_active', true);
            })
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
