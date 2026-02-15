@extends('layouts.app')

@push('styles')
<style>
.modern-filters {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.modern-filters .nav-link {
    padding: 12px 24px;
    border-radius: 25px;
    background: white;
    color: #6c757d;
    border: 2px solid #e9ecef;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modern-filters .nav-link:hover {
    background: #f8fff9;
    border-color: #28a745;
    color: #28a745;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
}

.modern-filters .nav-link.active {
    background: linear-gradient(135deg, #28a745, #20c997);
    border-color: #28a745;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
}

.modern-filters .nav-link i {
    font-size: 0.9rem;
}

/* Responsive pour les filtres */
@media (max-width: 768px) {
    .modern-filters {
        gap: 10px;
        padding: 15px;
    }
    
    .modern-filters .nav-link {
        padding: 10px 18px;
        font-size: 0.9rem;
    }
}

/* Styles pour la section Pourquoi nous choisir */
.why-choose-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.why-choose-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-color: #28a745;
}

.why-choose-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.why-choose-card:hover .why-choose-icon {
    transform: scale(1.1);
}

/* Styles pour la bannière promotion */
.banner-promotion {
    transition: all 0.3s ease;
}

.banner-promotion:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(40, 167, 69, 0.2);
}

.banner-content h2 {
    animation: fadeInUp 0.8s ease;
}

.banner-content p {
    animation: fadeInUp 0.8s ease 0.2s both;
}

.banner-content .btn {
    animation: fadeInUp 0.8s ease 0.4s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive pour la bannière */
@media (max-width: 768px) {
    .banner-content {
        text-align: center !important;
        padding: 3rem 2rem !important;
    }
    
    .banner-content h2 {
        font-size: 2rem;
    }
    
    .banner-content .btn {
        padding: 12px 30px;
        font-size: 1rem;
    }
    
    .banner-image img {
        max-height: 250px !important;
        margin-top: 2rem;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Produits Bio</h4>
                <h1 class="mb-5 display-3 text-primary">Fruits et Légumes Bio Frais</h1>
                <div class="position-relative mx-auto">
                    <form action="{{ route('search') }}" method="GET" class="d-flex">
                        <input name="q" class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="search" placeholder="Rechercher des produits...">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Rechercher</button>
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="{{ asset('assets/img/hero-img-1.png') }}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="Fruits frais">
                            <a href="{{ route('shop', ['category' => 'fruits']) }}" class="btn px-4 py-2 text-white rounded">Fruits</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="{{ asset('assets/img/hero-img-2.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="Légumes frais">
                            <a href="{{ route('shop', ['category' => 'vegetables']) }}" class="btn px-4 py-2 text-white rounded">Légumes</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-3">Nos Produits Bio</h1>
            <p class="text-muted mb-4">Découvrez notre sélection de produits frais et naturels</p>
        </div>

        <!-- Filtres Modernes -->
        <div class="d-flex justify-content-center mb-5">
            <ul class="nav nav-pills modern-filters">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fas fa-th me-2"></i>Tous
                    </a>
                </li>
                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#tab-{{ $category->id }}">
                            <i class="fas fa-leaf me-2"></i>{{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
        
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        @include('components.product-card', ['product' => $product])
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun produit disponible</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories as $category)
                <div id="tab-{{ $category->id }}" class="tab-pane fade p-0">
                    <div class="row g-4">
                        @php
                            $categoryProducts = $category->products()
                                ->where('is_active', true)
                                ->take(8)
                                ->get();
                        @endphp
                        
                        @forelse($categoryProducts as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('components.product-card', ['product' => $product])
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun produit dans cette catégorie</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Fruits Shop End -->

<!-- Pourquoi nous choisir Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-3">Pourquoi Nous Choisir</h1>
            <p class="text-muted mb-4">Découvrez nos avantages et notre engagement qualité</p>
        </div>
        
        <div class="row g-4">
            <!-- Livraison Rapide -->
            <div class="col-md-6 col-lg-3">
                <div class="why-choose-card text-center rounded bg-light p-4 h-100">
                    <div class="why-choose-icon btn-square rounded-circle bg-primary mb-4 mx-auto">
                        <i class="fas fa-truck fa-2x text-white"></i>
                    </div>
                    <div class="why-choose-content">
                        <h5 class="mb-3">Livraison Rapide</h5>
                        <p class="text-muted mb-0">Livraison express 24-48h partout en France</p>
                    </div>
                </div>
            </div>
            
            <!-- Produits Bio -->
            <div class="col-md-6 col-lg-3">
                <div class="why-choose-card text-center rounded bg-light p-4 h-100">
                    <div class="why-choose-icon btn-square rounded-circle bg-success mb-4 mx-auto">
                        <i class="fas fa-leaf fa-2x text-white"></i>
                    </div>
                    <div class="why-choose-content">
                        <h5 class="mb-3">Produits Bio</h5>
                        <p class="text-muted mb-0">100% produits certifiés agriculture biologique</p>
                    </div>
                </div>
            </div>
            
            <!-- Paiement Sécurisé -->
            <div class="col-md-6 col-lg-3">
                <div class="why-choose-card text-center rounded bg-light p-4 h-100">
                    <div class="why-choose-icon btn-square rounded-circle bg-info mb-4 mx-auto">
                        <i class="fas fa-shield-alt fa-2x text-white"></i>
                    </div>
                    <div class="why-choose-content">
                        <h5 class="mb-3">Paiement Sécurisé</h5>
                        <p class="text-muted mb-0">Transactions sécurisées avec SSL</p>
                    </div>
                </div>
            </div>
            
            <!-- Support Client -->
            <div class="col-md-6 col-lg-3">
                <div class="why-choose-card text-center rounded bg-light p-4 h-100">
                    <div class="why-choose-icon btn-square rounded-circle bg-warning mb-4 mx-auto">
                        <i class="fas fa-headset fa-2x text-white"></i>
                    </div>
                    <div class="why-choose-content">
                        <h5 class="mb-3">Support Client</h5>
                        <p class="text-muted mb-0">Service client disponible 7j/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pourquoi nous choisir End -->

<!-- Bannière Promotion Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="banner-promotion rounded overflow-hidden" style="background: linear-gradient(135deg, rgba(40, 167, 69, 0.9), rgba(32, 201, 151, 0.9));">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content text-white p-5">
                        <h2 class="display-4 fw-bold mb-4">Offre Spéciale !</h2>
                        <p class="fs-5 mb-4">Profitez de -20% sur votre première commande avec le code BIENVENUE</p>
                        <div class="d-flex align-items-center mb-4">
                            <span class="fs-1 fw-bold me-3">-20%</span>
                            <div>
                                <h5 class="mb-1">Réduction Immédiate</h5>
                                <p class="mb-0">Valable sur tous les produits bio</p>
                            </div>
                        </div>
                        <a href="{{ route('shop') }}" class="btn btn-light btn-lg rounded-pill px-5 py-3">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Boutique maintenant
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-image text-center">
                        <img src="{{ asset('assets/img/fruite-item-1.jpg') }}" class="img-fluid rounded" alt="Promotion" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bannière Promotion End -->

@endsection