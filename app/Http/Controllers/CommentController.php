<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

#[Middleware('auth')]
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Vérifier si l'utilisateur a déjà commenté ce produit
        $existingComment = Comment::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingComment) {
            return redirect()->back()
                ->with('error', 'Vous avez déjà laissé un avis pour ce produit.');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()
            ->with('success', 'Votre avis a été ajouté avec succès !')
            ->with('new_comment', true);
    }

    public function index()
    {
        $recentComments = Comment::with(['user', 'product'])
            ->latest()
            ->take(6)
            ->get();

        return response()->json($recentComments);
    }
}
