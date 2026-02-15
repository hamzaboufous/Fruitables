@extends('layouts.app')

@section('title', 'Commande Confirmée')

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5 text-center">
                        <!-- Success Icon -->
                        <div class="mb-4">
                            <div class="success-icon">
                                <i class="fas fa-check-circle fa-5x text-success"></i>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <h2 class="mb-3 text-success">Commande Confirmée !</h2>
                        <p class="lead mb-4">Votre commande a été confirmée avec succès.</p>

                        <!-- Order Details -->
                        <div class="order-details bg-light rounded p-4 mb-4">
                            <h5 class="mb-3">Détails de la commande</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Numéro de commande:</strong> #{{ $order->order_number }}</p>
                                    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Statut:</strong> 
                                        <span class="badge bg-warning text-dark">{{ $order->status_label }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Montant total:</strong> <span class="text-success fw-bold">{{ $order->formatted_total }}</span></p>
                                    <p><strong>Méthode de paiement:</strong> {{ ucfirst($order->payment_method) }}</p>
                                    <p><strong>Statut paiement:</strong> 
                                        <span class="badge bg-info">{{ $order->payment_status_label }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        @if($order->shipping_address)
                        <div class="shipping-address bg-light rounded p-4 mb-4">
                            <h5 class="mb-3">Adresse de livraison</h5>
                            <p class="mb-1"><strong>Adresse:</strong> {{ $order->shipping_address['address'] ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Ville:</strong> {{ $order->shipping_address['city'] ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Code postal:</strong> {{ $order->shipping_address['postal_code'] ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Pays:</strong> {{ $order->shipping_address['country'] ?? 'N/A' }}</p>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('account') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-user me-2"></i>Mon Compte
                            </a>
                            <a href="{{ route('shop') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Continuer mes achats
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.success-icon {
    animation: scaleIn 0.5s ease-in-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.order-details,
.shipping-address {
    border-left: 4px solid #28a745;
}

.action-buttons {
    margin-top: 2rem;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.lead {
    color: #6c757d;
}
</style>
@endsection
