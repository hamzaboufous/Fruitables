@extends('layouts.app')

@push('styles')
<style>
.product-detail-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 40px 0;
}

.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    background: white;
    padding: 20px;
}

.product-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.product-info {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: 100%;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    line-height: 1.2;
}

.category-badge {
    display: inline-block;
    padding: 8px 16px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 25px;
}

.product-price {
    font-size: 2.2rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 30px;
}

.product-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #6c757d;
    margin-bottom: 30px;
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.quantity-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 2px solid #28a745;
    background: white;
    color: #28a745;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn:hover {
    background: #28a745;
    color: white;
    transform: translateY(-2px);
}

.quantity-input {
    width: 80px;
    height: 45px;
    text-align: center;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: 600;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 20px;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
}

.rating {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
}

.stars {
    color: #ffc107;
    font-size: 1.2rem;
}

.stock-info {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
    padding: 15px;
    background: #f8fff9;
    border-radius: 10px;
    border-left: 4px solid #28a745;
}

.features-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.feature-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.related-products {
    margin-top: 60px;
}

.related-product-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.related-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.related-product-img {
    height: 200px;
    object-fit: cover;
}

.related-product-body {
    padding: 20px;
}

.back-to-shop {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #6c757d;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
    margin-bottom: 30px;
}

.back-to-shop:hover {
    color: #28a745;
}
</style>
@endpush

@section('content')
<div class="product-detail-container">
    <div class="container">
        <!-- Lien retour -->
        <a href="{{ route('shop') }}" class="back-to-shop">
            <i class="fas fa-arrow-left"></i>
            Retour à la boutique
        </a>

        <div class="row g-4">
            <!-- Colonne gauche : Image -->
            <div class="col-lg-6">
                <div class="product-image-container">
                    <img src="{{ $product->image ? \Illuminate\Support\Facades\Storage::url($product->image) : asset('assets/img/fruite-item-1.jpg') }}" 
                         class="product-image" 
                         alt="{{ $product->name }}">
                </div>
            </div>

            <!-- Colonne droite : Informations -->
            <div class="col-lg-6">
                <div class="product-info">
                    <!-- Catégorie -->
                    <div class="category-badge">
                        <i class="fas fa-leaf me-2"></i>{{ $product->category->name }}
                    </div>

                    <!-- Titre -->
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <!-- Notation -->
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-muted">(4.5/5 - 127 avis)</span>
                    </div>

                    <!-- Prix -->
                    <div class="product-price">
                        {{ $product->formatted_price }}
                    </div>

                    <!-- Description -->
                    <div class="product-description">
                        {{ $product->description }}
                    </div>

                    <!-- Stock -->
                    <div class="stock-info">
                        <i class="fas fa-{{ $product->quantity > 0 ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                        <span class="fw-semibold">{{ $product->stock_status }}</span>
                        @if($product->track_quantity && $product->quantity > 0)
                            <small class="text-muted">(Quantité maximale: {{ $product->quantity }})</small>
                        @endif
                    </div>

                    <!-- Sélecteur de quantité -->
                    <div class="quantity-selector">
                        <label class="fw-semibold me-3">Quantité :</label>
                        <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="quantity-input" id="quantity" value="1" min="1" max="{{ $product->track_quantity ? $product->quantity : 999 }}" readonly>
                        <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <!-- Formulaire d'ajout au panier -->
                    @if($product->isInStock())
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="cart_quantity" value="1">
                        <button type="submit" class="add-to-cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Ajouter au panier
                        </button>
                    </form>
                    @else
                    <button type="button" class="add-to-cart-btn" disabled style="background: #6c757d; cursor: not-allowed;">
                        <i class="fas fa-times-circle me-2"></i>
                        Rupture de stock
                    </button>
                    @endif

                    <!-- Avantages -->
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Livraison Rapide</h6>
                                <small class="text-muted">20-30min</small>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">100% Bio</h6>
                                <small class="text-muted">Certifié</small>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Garantie Qualité</h6>
                                <small class="text-muted">Satisfait ou remboursé</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Commentaires -->
@include('components.product-comments', ['product' => $product])

<!-- Produits similaires -->
<div class="container related-products">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Produits Similaires</h2>
        <p class="text-muted">Découvrez d'autres produits que vous pourriez aimer</p>
    </div>

    <div class="row g-4">
        @forelse($relatedProducts ?? [] as $relatedProduct)
            <div class="col-md-6 col-lg-3">
                <div class="card related-product-card">
                    @if($relatedProduct->image)
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top related-product-img" alt="{{ $relatedProduct->name }}">
                    @else
                        <img src="{{ asset('assets/img/default-product.jpg') }}" class="card-img-top related-product-img" alt="{{ $relatedProduct->name }}">
                    @endif
                    <div class="related-product-body">
                        <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                        <p class="text-primary fw-bold fs-5">€{{ number_format($relatedProduct->price, 2) }} / kg</p>
                        <a href="{{ route('product.show', $relatedProduct->slug) }}" class="btn btn-outline-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>
        @empty
            <!-- Fallback avec produits statiques si aucun produit similaire -->
            <div class="col-md-6 col-lg-3">
                <div class="card related-product-card">
                    <img src="{{ asset('assets/img/fruite-item-2.jpg') }}" class="card-img-top related-product-img" alt="Produit similaire">
                    <div class="related-product-body">
                        <h5 class="card-title">Tomates Bio</h5>
                        <p class="text-primary fw-bold fs-5">€4.99 / kg</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card related-product-card">
                    <img src="{{ asset('assets/img/fruite-item-3.jpg') }}" class="card-img-top related-product-img" alt="Produit similaire">
                    <div class="related-product-body">
                        <h5 class="card-title">Salades Fraîches</h5>
                        <p class="text-primary fw-bold fs-5">€3.49 / kg</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card related-product-card">
                    <img src="{{ asset('assets/img/vegetable-item-1.jpg') }}" class="card-img-top related-product-img" alt="Produit similaire">
                    <div class="related-product-body">
                        <h5 class="card-title">Carottes Bio</h5>
                        <p class="text-primary fw-bold fs-5">€2.99 / kg</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card related-product-card">
                    <img src="{{ asset('assets/img/vegetable-item-2.jpg') }}" class="card-img-top related-product-img" alt="Produit similaire">
                    <div class="related-product-body">
                        <h5 class="card-title">Poivrons Frais</h5>
                        <p class="text-primary fw-bold fs-5">€5.99 / kg</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
function increaseQuantity() {
    const input = document.getElementById('quantity');
    const cartInput = document.getElementById('cart_quantity');
    const currentValue = parseInt(input.value);
    const maxValue = parseInt(input.getAttribute('max'));
    
    if (currentValue < maxValue) {
        input.value = currentValue + 1;
        cartInput.value = input.value;
    }
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const cartInput = document.getElementById('cart_quantity');
    const currentValue = parseInt(input.value);
    
    if (currentValue > 1) {
        input.value = currentValue - 1;
        cartInput.value = input.value;
    }
}

// Animation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition progressive
    const elements = document.querySelectorAll('.product-image-container, .product-info');
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100);
        }, index * 200);
    });
});
</script>
@endpush
