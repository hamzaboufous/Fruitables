@extends('layouts.minimal')

@section('title', 'Facture - Commande ' . $order->order_number)

@section('content')
<style>
:root {
    --primary-color: #81c408;
    --primary-dark: #6fa506;
    --text-dark: #333;
    --text-light: #666;
    --border-color: #e9ecef;
    --bg-light: #f8f9fa;
}

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

.invoice-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.invoice-header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #81c408;
}

.logo {
    font-size: 2rem;
    font-weight: bold;
    color: #81c408;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.logo i {
    font-size: 1.5rem;
}

.invoice-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin: 15px 0 5px 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.invoice-subtitle {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0;
}

.invoice-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
    gap: 30px;
}

.info-block {
    flex: 1;
}

.info-block h6 {
    color: #81c408;
    font-weight: 600;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
}

.info-block p {
    margin-bottom: 6px;
    font-size: 0.85rem;
    line-height: 1.3;
}

.info-block strong {
    color: #333;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.product-table th {
    background: #f8f9fa;
    padding: 10px 8px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e9ecef;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
    font-size: 0.85rem;
}

.product-table tr:last-child td {
    border-bottom: none;
}

.product-img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
}

.product-info {
    display: flex;
    align-items: center;
}

.quantity-badge {
    background: #f8f9fa;
    padding: 3px 8px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.8rem;
}

.price {
    font-weight: 600;
    color: #333;
}

.total-section {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #81c408;
}

.total-row {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.total-row.final {
    font-size: 1.1rem;
    font-weight: bold;
    color: #81c408;
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid #e9ecef;
}

.total-label {
    min-width: 150px;
    text-align: right;
    padding-right: 15px;
}

.total-value {
    min-width: 80px;
    text-align: right;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.action-btn {
    padding: 10px 20px;
    border-radius: 25px;
    border: none;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.9rem;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-primary {
    background: #81c408;
    color: white;
}

.btn-outline {
    background: white;
    color: #81c408;
    border: 2px solid #81c408;
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

/* Print Styles - Optimisé pour 1 page A4 */
@media print {
    body {
        background: white;
        font-size: 11pt;
        line-height: 1.3;
        margin: 0;
        padding: 0;
    }

    .invoice-container {
        margin: 0;
        padding: 10mm;
        border: none;
        box-shadow: none;
        max-width: 100%;
        box-sizing: border-box;
    }

    .back-btn {
        display: none;
    }

    .action-buttons {
        display: none;
    }

    .invoice-header {
        margin-bottom: 15px;
        padding-bottom: 10px;
    }

    .logo {
        font-size: 1.5rem;
    }

    .logo i {
        font-size: 1.2rem;
    }

    .invoice-title {
        font-size: 1.2rem;
        margin: 10px 0 3px 0;
    }

    .invoice-subtitle {
        font-size: 0.8rem;
    }

    .invoice-info {
        margin-bottom: 15px;
        gap: 20px;
    }

    .info-block h6 {
        font-size: 0.7rem;
        margin-bottom: 6px;
    }

    .info-block p {
        font-size: 0.75rem;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .product-table {
        margin: 15px 0;
    }

    .product-table th {
        padding: 6px 4px;
        font-size: 0.7rem;
    }

    .product-table td {
        padding: 6px 4px;
        font-size: 0.75rem;
    }

    .product-img {
        max-width: 35px;
        max-height: 35px;
        margin-right: 6px;
    }

    .quantity-badge {
        padding: 2px 6px;
        font-size: 0.7rem;
    }

    .total-section {
        margin-top: 15px;
        padding-top: 10px;
    }

    .total-row {
        font-size: 0.8rem;
        margin-bottom: 6px;
    }

    .total-row.final {
        font-size: 0.9rem;
        margin-top: 6px;
        padding-top: 6px;
    }

    .total-label {
        min-width: 120px;
        padding-right: 10px;
    }

    .total-value {
        min-width: 60px;
    }

    /* Forcer tout sur une seule page */
    @page {
        margin: 10mm;
        size: A4;
    }

    html, body {
        height: auto;
        overflow: visible;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .invoice-container {
        margin: 20px;
        padding: 20px;
    }

    .invoice-info {
        flex-direction: column;
        gap: 15px;
    }

    .product-info {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }

    .product-img {
        margin-right: 0;
        margin-bottom: 8px;
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
</style>

<div class="container py-5">
    <!-- Bouton Retour -->
    <a href="javascript:history.back()" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        Retour
    </a>

    <div class="invoice-container">
        <!-- Header de facture -->
        <div class="invoice-header">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                Fruitables
            </div>
            <h1 class="invoice-title">FACTURE</h1>
            <p class="invoice-subtitle">Bon de commande N°{{ $order->order_number }}</p>
            <p class="invoice-subtitle">Date: {{ $order->created_at->format('d/m/Y') }}</p>
        </div>

        <!-- Informations client et commande -->
        <div class="invoice-info">
            <div class="info-block">
                <h6>Client</h6>
                <p><strong>{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</strong></p>
                <p>{{ $order->shipping_address['address'] }}</p>
                <p>{{ $order->shipping_address['postal_code'] }} {{ $order->shipping_address['city'] }}</p>
                <p>{{ $order->shipping_address['phone'] }}</p>
                <p>{{ $order->shipping_address['email'] }}</p>
            </div>
            
            <div class="info-block">
                <h6>Commande</h6>
                <p><strong>N°:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <p><strong>Paiement:</strong> {{ $order->payment_method_label }}</p>
                <p><strong>Statut:</strong> {!! $order->payment_status_badge !!}</p>
            </div>
        </div>

        <!-- Tableau des produits -->
        <table class="product-table">
            <thead>
                <tr>
                    <th style="width: 60%;">Produit</th>
                    <th style="width: 15%; text-align: center;">Qté</th>
                    <th style="width: 25%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <div class="product-info">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="product-img">
                            @else
                                <img src="{{ asset('assets/img/default-product.jpg') }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="product-img">
                            @endif
                            <div>
                                <strong>{{ $item->product_name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span class="quantity-badge">{{ $item->quantity }}</span>
                    </td>
                    <td style="text-align: right;" class="price">€{{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Section totaux -->
        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Sous-total:</div>
                <div class="total-value">€{{ number_format($order->subtotal, 2) }}</div>
            </div>
            <div class="total-row">
                <div class="total-label">
                    {{ $order->shipping_amount > 0 ? 'Livraison:' : 'Livraison:' }}
                </div>
                <div class="total-value">
                    {{ $order->shipping_amount > 0 ? '€' . number_format($order->shipping_amount, 2) : 'Gratuite' }}
                </div>
            </div>
            <div class="total-row final">
                <div class="total-label">TOTAL:</div>
                <div class="total-value">€{{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button onclick="window.print()" class="action-btn btn-primary">
                <i class="fas fa-print"></i>
                Imprimer
            </button>
        </div>
    </div>
</div>
@endsection
