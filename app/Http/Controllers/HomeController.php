<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        // Produits en vedette (uniquement de catégories actives)
        $products = Product::where('is_active', true)
            ->whereHas('category', function($q) {
                $q->where('is_active', true);
            })
            ->latest()
            ->take(8)
            ->get();
        
        // Catégories actives pour les filtres
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        
        return view('home', compact('products', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::where('is_active', true)
            ->whereHas('category', function($query) {
                $query->where('is_active', true);
            })
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('short_description', 'LIKE', "%{$query}%");
            })
            ->with('category')
            ->paginate(12);

        return view('search', compact('products', 'query'));
    }
}