<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Marquer toutes les commandes non vues comme vues
        \App\Models\Order::whereNull('admin_viewed_at')->update(['admin_viewed_at' => now()]);
        
        // Marquer toutes les notifications de commandes comme lues
        \App\Models\AdminNotification::where('type', 'new_order')
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        $orders = Order::with('user', 'orderItems.product')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:delivered,processing,pending,cancelled,confirmed,shipped,expedited'
        ]);
        
        $order->update(['status' => $request->status]);
        
        // CORRECT - redirection classique
        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès !');
    }

    public function updatePayment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:paid,pending'
        ]);
        
        $order->update(['payment_status' => $request->payment_status]);
        
        // CORRECT - redirection classique
        return redirect()->back()->with('success', 'Statut de paiement mis à jour avec succès !');
    }
}
