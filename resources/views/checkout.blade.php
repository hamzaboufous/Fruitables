@extends('layouts.app')

@section('content')
<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Finaliser la Commande</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Billing Information -->
                <div class="bg-light rounded p-4 mb-4">
                    <h5 class="mb-4">Informations de Livraison</h5>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name ?? old('first_name') }}" required>
                                @error('first_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name ?? old('last_name') }}" required>
                                @error('last_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address ?? old('address') }}" required>
                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ville</label>
                                <input type="text" class="form-control" name="city" value="{{ Auth::user()->city ?? old('city') }}" required>
                                @error('city')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Code Postal</label>
                                <input type="text" class="form-control" name="postal_code" value="{{ Auth::user()->postal_code ?? old('postal_code') }}" required>
                                @error('postal_code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pays</label>
                                <input type="text" class="form-control" name="country" value="{{ Auth::user()->country ?? old('country') ?? 'France' }}" required>
                                @error('country')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone ?? old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email ?? old('email') }}" required>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-light rounded p-4 mb-4">
                    <h5 class="mb-4">Méthode de Paiement</h5>
                    <div class="text-center py-3">
                        <div class="d-inline-flex align-items-center gap-3 p-3 bg-white rounded-3 border border-success">
                            <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                            <div class="text-start">
                                <h6 class="mb-1 text-success fw-bold">💵 Paiement à la livraison</h6>
                                <small class="text-muted">Vous payerez en espèces à la réception de votre commande</small>
                            </div>
                        </div>
                    </div>
                </div>

             
            </div>

            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="bg-light rounded p-4">
                    <h5 class="mb-4">Récapitulatif de la Commande</h5>
                    
                    @if($cartItems->count() > 0)
                        @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">Quantité: {{ $item->quantity }} x {{ $item->product->formatted_price }}</small>
                            </div>
                            <h6 class="mb-0">{{ $item->formattedSubtotal }}</h6>
                        </div>
                        @endforeach
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <p>Sous-total</p>
                            <p>€{{ number_format($subtotal, 2) }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <p>Livraison</p>
                            <p>Gratuite</p>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h6>Total</h6>
                            <h6>€{{ number_format($total, 2) }}</h6>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-lock me-2"></i>
                            Confirmer et Payer
                        </button>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h6>Votre panier est vide</h6>
                            <p class="text-muted">Ajoutez des produits pour continuer</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary">Voir la Boutique</a>
                        </div>
                    @endif
                </div>

                <!-- Security Info -->
                <div class="bg-light rounded p-4 mt-4">
                    <h6 class="mb-3"><i class="fa fa-shield-alt me-2"></i>Paiement Sécurisé</h6>
                    <p class="small text-muted mb-0">Vos informations de paiement sont cryptées et sécurisées. Nous n'utilisons que des méthodes de paiement reconnues et sécurisées.</p>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->
@endsection
