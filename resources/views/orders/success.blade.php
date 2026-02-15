@extends('layouts.app')

@section('title', 'Merci pour votre commande !')

@section('content')
<style>
.success-container {
    max-width: 600px;
    margin: 60px auto;
    text-align: center;
    padding: 40px;
}

.success-icon {
    font-size: 4rem;
    color: #81c408;
    margin-bottom: 20px;
    animation: checkmark 0.6s ease-in-out;
}

@keyframes checkmark {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

.success-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.order-number {
    font-size: 1.2rem;
    color: #81c408;
    font-weight: 600;
    margin-bottom: 30px;
}

.info-section {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    border-left: 4px solid #81c408;
}

.info-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 1rem;
    color: #555;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item i {
    font-size: 1.2rem;
    color: #81c408;
    width: 25px;
}

.products-summary {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.product-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.product-item:last-child {
    border-bottom: none;
}

.product-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
}

.product-info {
    flex: 1;
    text-align: left;
}

.product-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.product-quantity {
    color: #666;
    font-size: 0.9rem;
}

.product-price {
    font-weight: 600;
    color: #81c408;
    font-size: 1.1rem;
}

.total-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.total-amount {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.total-amount span {
    color: #81c408;
}

.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.action-btn {
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.btn-primary {
    background: #81c408;
    color: white;
}

.btn-primary:hover {
    background: #6fa506;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(129, 196, 8, 0.3);
}

.btn-outline {
    background: white;
    color: #81c408;
    border: 2px solid #81c408;
}

.btn-outline:hover {
    background: #81c408;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(129, 196, 8, 0.3);
}

@media (max-width: 768px) {
    .success-container {
        margin: 30px 20px;
        padding: 30px 20px;
    }
    
    .success-title {
        font-size: 1.6rem;
    }
    
    .product-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .product-img {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .action-btn {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
}

/* Badges de paiement */
.badge-payment-pending {
    background: #ffc107;
    color: #000;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.badge-payment-paid {
    background: #28a745;
    color: #fff;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
}
</style>

<div class="success-container">
    <!-- Icône de succès -->
    <div class="success-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    
    <!-- Titre et numéro de commande -->
    <h1 class="success-title">Merci pour votre commande !</h1>
    <div class="order-number">Commande #{{ $order->order_number }} confirmée</div>
    
    <!-- Informations rapides -->
    <div class="info-section">
        <div class="info-item">
            <i class="fas fa-envelope"></i>
            <span>Email de confirmation envoyé</span>
        </div>
        <div class="info-item">
            <i class="fas fa-truck"></i>
            <span>Livraison estimée: 20-30min</span>
        </div>
        <div class="info-item">
            <i class="fas fa-credit-card"></i>
            <span>Méthode de paiement: {{ $order->payment_method_label }} 💵</span>
        </div>
    </div>
    
    <!-- Résumé des produits -->
    <div class="products-summary">
        <h5 class="mb-4">Produits commandés</h5>
        @foreach($order->items as $item)
        <div class="product-item">
            @if($item->product && $item->product->image)
                <img src="{{ asset('storage/' . $item->product->image) }}" 
                     alt="{{ $item->product_name }}" 
                     class="product-img">
            @else
                <img src="{{ asset('assets/img/default-product.jpg') }}" 
                     alt="{{ $item->product_name }}" 
                     class="product-img">
            @endif
            
            <div class="product-info">
                <div class="product-name">{{ $item->product_name }}</div>
                <div class="product-quantity">Quantité: {{ $item->quantity }} × €{{ number_format($item->price, 2) }}</div>
            </div>
            
            <div class="product-price">
                €{{ number_format($item->total, 2) }}
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Total -->
    <div class="total-section">
        <div class="total-amount">
            Total: <span>€{{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>
    
    <!-- Boutons d'action -->
    <div class="action-buttons">
        <a href="{{ route('shop') }}" class="action-btn btn-primary">
            <i class="fas fa-shopping-cart"></i>
            Continuer mes achats
        </a>
        <a href="{{ route('account') }}" class="action-btn btn-outline">
            <i class="fas fa-list"></i>
            Voir mes commandes
        </a>
    </div>
</div>
@endsection
