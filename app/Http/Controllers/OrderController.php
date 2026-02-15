<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire de la commande
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $order->load('items.product', 'user');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire de la commande
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        // Vérifier que la commande peut être supprimée (Processing ou Pending)
        if (!in_array($order->status, ['processing', 'pending'])) {
            return back()->with('error', 'Cette commande ne peut pas être supprimée car elle est déjà ' . $order->statusLabel);
        }

        $order->delete();

        return back()->with('success', 'Commande supprimée avec succès.');
    }
}
