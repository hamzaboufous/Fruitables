@extends('layouts.minimal')

@section('title', 'Détails de la Commande ' . $order->order_number)

@section('content')
<style>
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    margin-bottom: 20px;
    color: #6c757d;
    border: 2px solid #e9ecef;
    background: white;
}

.back-btn:hover {
    background: #f8f9fa;
    border-color: #81c408;
    color: #81c408;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(129, 196, 8, 0.2);
}

.order-header {
    background: linear-gradient(135deg, #81c408, #6fa506);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}

.order-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 40%;
    height: 200%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(45deg);
}

.order-header-content {
    position: relative;
    z-index: 1;
}

.order-number {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.order-total {
    font-size: 2rem;
    font-weight: bold;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 500;
    font-size: 0.9rem;
}

.status-badge.delivered {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.status-badge.paid {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.order-date {
    opacity: 0.9;
    font-size: 0.95rem;
}

.section-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
    margin-bottom: 25px;
}

.section-card:hover {
    transform: translateY(-2px);
}

.section-title {
    color: #81c408;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}

.product-item:last-child {
    border-bottom: none;
}

.product-img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
}

.product-info {
    flex: 1;
}

.product-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.product-sku {
    color: #6c757d;
    font-size: 0.85rem;
}

.quantity-badge {
    background: #ff6b35;
    color: white;
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.product-price {
    text-align: right;
    font-weight: 600;
    color: #333;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-row.total {
    font-size: 1.2rem;
    font-weight: bold;
    color: #81c408;
    padding-top: 15px;
    border-top: 2px solid #81c408;
}

.timeline {
    position: relative;
    padding-left: 40px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
    padding-left: 20px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-icon {
    position: absolute;
    left: -25px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-icon.pending {
    background: #ffc107;
    color: white;
}

.timeline-icon.confirmed {
    background: #007bff;
    color: white;
}

.timeline-icon.preparing {
    background: #81c408;
    color: white;
}

.timeline-icon.shipped {
    background: #fd7e14;
    color: white;
}

.timeline-icon.delivering {
    background: #007bff;
    color: white;
}

.timeline-icon.delivered {
    background: #28a745;
    color: white;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    border-left: 3px solid #81c408;
}

.timeline-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.timeline-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0;
}

.invoice-btn {
    background: #81c408;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.invoice-btn:hover {
    background: #6fa506;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(129, 196, 8, 0.3);
}

@media (max-width: 768px) {
    .order-header {
        padding: 20px;
    }
    
    .order-number {
        font-size: 1.4rem;
    }
    
    .order-total {
        font-size: 1.6rem;
    }
    
    .product-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .product-img {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .product-price {
        text-align: left;
        margin-top: 10px;
    }
    
    .timeline {
        padding-left: 30px;
    }
    
    .timeline::before {
        left: 10px;
    }
    
    .timeline-icon {
        left: -20px;
        width: 25px;
        height: 25px;
        font-size: 12px;
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

<div class="container py-5">
    <!-- Bouton Retour -->
    <a href="javascript:history.back()" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        Retour
    </a>

    <!-- Header Commande -->
    <div class="order-header">
        <div class="order-header-content">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="order-number">Commande #{{ $order->order_number }}</div>
                    <div class="order-date">
                        <i class="fas fa-calendar me-2"></i>
                        Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                    </div>
                    <div class="mt-3">
                        <span class="status-badge delivered">
                            <i class="fas fa-check-circle"></i>
                            {{ $order->statusLabel }}
                        </span>
                        <span class="status-badge paid ms-2">
                            <i class="fas fa-credit-card"></i>
                            Payé
                        </span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="order-total">€{{ number_format($order->total_amount, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Articles Commandés -->
        <div class="col-lg-7">
            <div class="card section-card">
                <div class="card-body p-4">
                    <h5 class="section-title">
                        <i class="fas fa-shopping-bag"></i>
                        Articles Commandés
                    </h5>
                    
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
                            @if($item->product_sku)
                            <div class="product-sku">SKU: {{ $item->product_sku }}</div>
                            @endif
                        </div>
                        
                        <div class="product-price">
                            <div class="quantity-badge">{{ $item->quantity }}x</div>
                            <div class="mt-2">€{{ number_format($item->price, 2) }}</div>
                            <div class="text-success fw-bold">€{{ number_format($item->total, 2) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Récapitulatif -->
            <div class="card section-card">
                <div class="card-body p-4">
                    <h5 class="section-title">
                        <i class="fas fa-receipt"></i>
                        Récapitulatif
                    </h5>
                    
                    <div class="summary-row">
                        <span>Sous-total</span>
                        <span>€{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Frais de livraison</span>
                        <span>{{ $order->shipping_amount > 0 ? '€' . number_format($order->shipping_amount, 2) : 'Gratuite' }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Taxes</span>
                        <span>€{{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>€{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Informations de paiement -->
            <div class="card section-card">
                <div class="card-body p-4">
                    <h5 class="section-title">
                        <i class="fas fa-credit-card"></i>
                        Informations de Paiement
                    </h5>
                    
                    <div class="summary-row">
                        <span>Méthode de paiement</span>
                        <span>{{ $order->payment_method_label }} </span>
                    </div>
                    <div class="summary-row">
                        <span>Statut du paiement</span>
                        <span>{!! $order->payment_status_badge !!}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suivi de Commande -->
        <div class="col-lg-5">
            <div class="card section-card">
                <div class="card-body p-4">
                    <h5 class="section-title">
                        <i class="fas fa-truck"></i>
                        Suivi de Commande
                    </h5>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">En attente</div>
                                <div class="timeline-description">Commande reçue</div>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon confirmed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Confirmée</div>
                                <div class="timeline-description">Commande validée</div>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon preparing">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">En préparation</div>
                                <div class="timeline-description">Commande en cours</div>
                            </div>
                        </div>

                        @if($order->status == 'shipped' || $order->status == 'delivering' || $order->status == 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-icon shipped">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Expédiée</div>
                                <div class="timeline-description">Commande envoyée</div>
                            </div>
                        </div>
                        @endif

                        @if($order->status == 'delivering' || $order->status == 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-icon delivering">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Chez le livreur</div>
                                <div class="timeline-description">En cours de livraison</div>
                            </div>
                        </div>
                        @endif

                        @if($order->status == 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-icon delivered">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Livrée</div>
                                <div class="timeline-description">Commande terminée</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

          
        </div>
    </div>
</div>
@endsection
