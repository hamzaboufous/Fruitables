@push('styles')
<style>
.product-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    background: white;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.product-card-img-container {
    position: relative;
    overflow: hidden;
    height: 220px;
    flex-shrink: 0;
}

.product-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-card-img {
    transform: scale(1.05);
}

.product-card-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.product-card-body {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.product-card-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    line-height: 1.3;
    min-height: 48px;
    display: flex;
    align-items: center;
}

.product-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-card-title a:hover {
    color: #28a745;
}

.product-card-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}

.product-card-stars {
    color: #ffc107;
    font-size: 0.9rem;
}

.product-card-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 15px;
}

.product-card-stock {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    padding: 10px;
    background: #f8fff9;
    border-radius: 8px;
    font-size: 0.9rem;
}

.product-card-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
    flex-shrink: 0;
}

.product-card-btn {
    flex: 1;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
}

.product-card-btn-primary {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.product-card-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
}

.product-card-btn-outline {
    background: white;
    color: #28a745;
    border: 2px solid #28a745;
}

.product-card-btn-outline:hover {
    background: #28a745;
    color: white;
    transform: translateY(-2px);
}
</style>
@endpush

<!-- Carte Produit -->
<div class="product-card">
    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
        <!-- Image -->
        <div class="product-card-img-container">
            <img src="{{ $product->image ? \Illuminate\Support\Facades\Storage::url($product->image) : asset('assets/img/fruite-item-1.jpg') }}" 
                 class="product-card-img" 
                 alt="{{ $product->name }}">
            
            <!-- Badge Catégorie -->
            <div class="product-card-badge">
                <i class="fas fa-leaf"></i>
                {{ $product->category->name }}
            </div>
        </div>
    </a>

    <!-- Corps de la carte -->
    <div class="product-card-body">
        <div class="product-card-content">
            <!-- Titre -->
            <h5 class="product-card-title">
                <a href="{{ route('product.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h5>

            <!-- Notation -->
            <div class="product-card-rating">
                <div class="product-card-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-muted small">(4.5)</span>
            </div>

            <!-- Prix -->
            <div class="product-card-price">
                {{ $product->formatted_price }}
            </div>

            <!-- Stock -->
            <div class="product-card-stock">
                <i class="fas fa-{{ $product->quantity > 0 ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                <span class="fw-semibold">{{ $product->stock_status }}</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="product-card-actions">
            <!-- Bouton Détails -->
            <a href="{{ route('product.show', $product->slug) }}" class="product-card-btn product-card-btn-outline">
                <i class="fas fa-eye me-1"></i>
                Détails
            </a>

            <!-- Bouton Ajouter au panier -->
            @if($product->isInStock())
            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="product-card-btn product-card-btn-primary">
                    <i class="fas fa-shopping-cart me-1"></i>
                    Ajouter
                </button>
            </form>
            @else
            <button type="button" class="product-card-btn product-card-btn-outline" disabled>
                <i class="fas fa-times-circle me-1"></i>
                Rupture
            </button>
            @endif
        </div>
    </div>
</div>
