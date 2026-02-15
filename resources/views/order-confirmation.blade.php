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
    max-width: 900px;
    margin: 40px auto;
    padding: 40px;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.invoice-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid #81c408;
}

.logo {
    font-size: 2.5rem;
    font-weight: bold;
    color: #81c408;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.logo i {
    font-size: 2rem;
}

.invoice-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin: 20px 0 10px 0;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.invoice-subtitle {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 0;
}

.invoice-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    gap: 30px;
}

.info-block {
    flex: 1;
}

.info-block h6 {
    color: #81c408;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

.info-block p {
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.info-block strong {
    color: #333;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    margin: 30px 0;
}

.product-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e9ecef;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-table td {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
}

.product-table tr:last-child td {
    border-bottom: none;
}

.product-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 15px;
}

.product-info {
    display: flex;
    align-items: center;
}

.quantity-badge {
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 15px;
    font-weight: 500;
    font-size: 0.9rem;
}

.price {
    font-weight: 600;
    color: #333;
}

.total-section {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #81c408;
}

.total-row {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 10px;
    font-size: 1rem;
}

.total-row.final {
    font-size: 1.3rem;
    font-weight: bold;
    color: #81c408;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #e9ecef;
}

.total-label {
    min-width: 200px;
    text-align: right;
    padding-right: 20px;
}

.total-value {
    min-width: 100px;
    text-align: right;
    font-weight: 600;
}

.status-section {
    text-align: center;
    margin: 40px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #81c408;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 500;
    margin-bottom: 10px;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #e9ecef;
}

.action-btn {
    padding: 12px 25px;
    border-radius: 25px;
    border: none;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.95rem;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-primary {
    background: #81c408;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-outline {
    background: white;
    color: #81c408;
    border: 2px solid #81c408;
}

.footer-note {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
    color: #666;
    font-size: 0.9rem;
}

/* Print Styles */
@media print {
    body {
        background: white;
    }

    .invoice-container {
        margin: 0;
        padding: 20px;
        border: none;
        box-shadow: none;
        max-width: 100%;
    }

    .action-buttons {
        display: none;
    }

    .back-btn {
        display: none;
    }

    .invoice-header {
        margin-bottom: 20px;
    }

    .logo {
        font-size: 2rem;
    }

    .invoice-title {
        font-size: 1.5rem;
    }

    .product-table th,
    .product-table td {
        padding: 10px;
        font-size: 0.9rem;
    }

    .footer-note {
        margin-top: 20px;
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
        gap: 20px;
    }

    .product-info {
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
        max-width: 300px;
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
            <p class="invoice-subtitle">Date: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Informations client et commande -->
        <div class="invoice-info">
            <div class="info-block">
                <h6>Informations de livraison</h6>
                <p><strong>{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</strong></p>
                <p>{{ $order->shipping_address['address'] }}</p>
                <p>{{ $order->shipping_address['postal_code'] }} {{ $order->shipping_address['city'] }}</p>
                <p>{{ $order->shipping_address['country'] }}</p>
                <p><strong>Téléphone:</strong> {{ $order->shipping_address['phone'] }}</p>
                <p><strong>Email:</strong> {{ $order->shipping_address['email'] }}</p>
            </div>
            
            <div class="info-block">
                <h6>Informations de commande</h6>
                <p><strong>Numéro:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <p><strong>Méthode de paiement:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Statut paiement:</strong> <span class="badge bg-success">Payé</span></p>
                @if($order->notes)
                <p><strong>Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>

        <!-- Tableau des produits -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th style="text-align: center;">Quantité</th>
                    <th style="text-align: right;">Prix unitaire</th>
                    <th style="text-align: right;">Total</th>
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
                                @if($item->product_sku)
                                <br><small class="text-muted">SKU: {{ $item->product_sku }}</small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span class="quantity-badge">{{ $item->quantity }}</span>
                    </td>
                    <td style="text-align: right;" class="price">€{{ number_format($item->price, 2) }}</td>
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
                    {{ $order->shipping_amount > 0 ? 'Frais de livraison:' : 'Livraison:' }}
                </div>
                <div class="total-value">
                    {{ $order->shipping_amount > 0 ? '€' . number_format($order->shipping_amount, 2) : 'Gratuite' }}
                </div>
            </div>
            <div class="total-row final">
                <div class="total-label">Total payé:</div>
                <div class="total-value">€{{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>

        <!-- Section statut -->
        <div class="status-section">
            <div class="status-badge">
                <i class="fas fa-clock"></i>
                En cours de traitement
            </div>
            <p class="mb-0">
                <i class="fas fa-truck me-2"></i>
                Votre commande sera livrée dans 24-48h
            </p>
        </div>

        <!-- Boutons d'action -->
        <div class="action-buttons">
            <button onclick="printInvoice()" class="action-btn btn-primary">
                <i class="fas fa-print"></i>
                Imprimer la facture
            </button>
            <a href="{{ route('home') }}" class="action-btn btn-outline">
                <i class="fas fa-home"></i>
                Retour à la boutique
            </a>
        </div>

        <!-- Footer -->
        <div class="footer-note">
            <p class="mb-2">
                <strong>Merci de faire confiance à Fruitables !</strong>
            </p>
            <p class="mb-0">
                Un email de confirmation a été envoyé à votre adresse email.<br>
                Pour toute question, contactez notre service client au +33 1 23 45 67 89
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Function pour imprimer
function printInvoice() {
    window.print();
}

// Function pour télécharger (placeholder)

</script>
@endpush
