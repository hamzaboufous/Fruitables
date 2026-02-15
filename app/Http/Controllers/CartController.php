<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Veuillez vous connecter pour voir votre panier.');
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Veuillez vous connecter pour ajouter des produits au panier.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Vérifier si le produit est en stock
        if (!$product->isInStock()) {
            return back()->with('error', 'Ce produit n\'est pas en stock.');
        }

        // Vérifier si la quantité demandée est disponible
        if (!$product->hasEnoughStock($request->quantity)) {
            $availableStock = $product->track_quantity ? $product->quantity : 'illimité';
            return back()->with('error', 'Quantité demandée non disponible. Stock disponible: ' . $availableStock);
        }

        // Vérifier si l'utilisateur a déjà ce produit dans le panier
        $existingCartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            
            // Vérifier si la nouvelle quantité totale est disponible
            if (!$product->hasEnoughStock($newQuantity)) {
                $availableStock = $product->track_quantity ? $product->quantity : 'illimité';
                return back()->with('error', 'Impossible d\'ajouter cette quantité. Stock disponible: ' . $availableStock . ' (déjà ' . $existingCartItem->quantity . ' dans votre panier)');
            }
            
            $existingCartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Produit ajouté au panier avec succès !');
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->findOrFail($request->cart_item_id);

        // Vérifier si la nouvelle quantité est disponible
        if (!$cartItem->product->hasEnoughStock($request->quantity)) {
            $availableStock = $cartItem->product->track_quantity ? $cartItem->product->quantity : 'illimité';
            return response()->json([
                'error' => 'Quantité non disponible. Stock disponible: ' . $availableStock
            ], 422);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'subtotal' => $cartItem->formattedSubtotal,
            'total' => '€' . number_format(Auth::user()->cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            }), 2)
        ]);
    }

    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->findOrFail($request->cart_item_id);

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'total' => '€' . number_format(Auth::user()->cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            }), 2)
        ]);
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Veuillez vous connecter pour finaliser votre commande.');
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        $total = $subtotal; // Pour l'instant, pas de frais de livraison

        return view('checkout', compact('cartItems', 'subtotal', 'total'));
    }

    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Veuillez vous connecter pour finaliser votre commande.');
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        // Prepare shipping address
        $shippingAddress = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ];

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $subtotal,
            'subtotal' => $subtotal,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'status' => 'processing',
            'payment_status' => 'pending',
            'payment_method' => 'cash_on_delivery',
            'shipping_address' => $shippingAddress,
            'billing_address' => $shippingAddress,
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            
            // Vérification finale du stock avant de traiter la commande
            if (!$product->hasEnoughStock($cartItem->quantity)) {
                // Annuler la commande si le stock est insuffisant
                $order->delete();
                return redirect()->route('cart')->with('error', 'Le produit "' . $product->name . '" n\'a plus suffisamment de stock pour votre commande. Veuillez ajuster votre panier.');
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'product_sku' => $cartItem->product->sku,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'total' => $cartItem->quantity * $cartItem->product->price,
            ]);

            // Mettre à jour le stock du produit
            $product->decreaseStock($cartItem->quantity);
        }

        // Clear cart
        Auth::user()->cartItems()->delete();

        // Créer une notification admin pour la nouvelle commande
        \App\Models\AdminNotification::create([
            'type' => 'new_order',
            'related_id' => $order->id,
            'is_read' => false
        ]);

        return redirect()->route('order.success', $order->id);
    }

    public function orderConfirmation(Order $order)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire de la commande
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        // Charger les détails de la commande
        $order->load('items.product', 'user');

        return view('order-confirmation', compact('order'));
    }

    public function orderSuccess(Order $order)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire de la commande
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('orders.success', compact('order'));
    }

    public function orderInvoice(Order $order)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire de la commande
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        // Charger les détails de la commande
        $order->load('items.product', 'user');

        return view('orders.invoice', compact('order'));
    }
}
