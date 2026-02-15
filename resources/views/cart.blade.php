@extends('layouts.app')

@push('styles')
<style>
.cart-empty-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cart-empty-content {
    text-align: center;
    padding: 60px 20px;
}

.cart-empty-icon {
    font-size: 120px;
    color: #6c757d;
    margin-bottom: 30px;
    opacity: 0.6;
}

.cart-empty-title {
    font-size: 2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.cart-empty-text {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 30px;
}

.btn-continue {
    background: #28a745;
    color: white;
    padding: 14px 40px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-continue:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    color: white;
}
</style>
@endpush

@section('content')
<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Votre Panier</h1>
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

        @if($cartItems->count() > 0)
        <div class="row g-5">
            <div class="col-lg-8">
                @foreach($cartItems as $item)
                <div class="border rounded mb-4 cart-item" data-id="{{ $item->id }}">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="d-flex">
                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/fruite-item-1.jpg') }}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $item->product->name }}">
                                <div class="ms-3">
                                    <h5>{{ $item->product->name }}</h5>
                                    <p class="text-muted mb-0">{{ $item->product->category->name }}</p>
                                    <p class="text-muted mb-0">SKU: {{ $item->product->sku }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="input-group quantity" style="width: 150px;">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="updateQuantity({{ $item->id }}, -1)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="number" class="form-control form-control-sm text-center border-0 quantity-input" value="{{ $item->quantity }}" min="1" readonly>
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="updateQuantity({{ $item->id }}, 1)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0">{{ $item->product->formatted_price }} / kg</p>
                                    <h6 class="mb-0 subtotal">{{ $item->formattedSubtotal }}</h6>
                                </div>
                                <button class="btn btn-sm btn-danger remove-item" onclick="removeItem({{ $item->id }})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-lg-4">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-4">Récapitulatif</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <p>Sous-total</p>
                        <p class="subtotal-total">€{{ number_format($total, 2) }}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <p>Livraison</p>
                        <p>Gratuite</p>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <h6>Total</h6>
                        <h6 class="total">€{{ number_format($total, 2) }}</h6>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100">Finaliser la commande</a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary w-100 mt-2">Continuer vos achats</a>
                </div>
            </div>
        </div>
        @else
        <!-- Panier vide centré -->
        <div class="cart-empty-container">
            <div class="cart-empty-content">
                <div class="cart-empty-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h2 class="cart-empty-title">Votre panier est vide</h2>
                <p class="cart-empty-text">Ajoutez des produits pour commencer vos achats</p>
                <a href="{{ route('shop') }}" class="btn-continue">
                    Continuer vos achats
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Cart Page End -->
@endsection

@push('scripts')
<script>
function updateQuantity(itemId, change) {
    const item = document.querySelector(`.cart-item[data-id="${itemId}"]`);
    const input = item.querySelector('.quantity-input');
    const currentQuantity = parseInt(input.value);
    const newQuantity = currentQuantity + change;
    
    if (newQuantity < 1) return;
    
    fetch('{{ route("cart.update") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            cart_item_id: itemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = newQuantity;
            item.querySelector('.subtotal').textContent = data.subtotal;
            document.querySelector('.subtotal-total').textContent = data.total;
            document.querySelector('.total').textContent = data.total;
        }
    });
}

function removeItem(itemId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) return;
    
    fetch('{{ route("cart.remove") }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            cart_item_id: itemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const item = document.querySelector(`.cart-item[data-id="${itemId}"]`);
            item.remove();
            document.querySelector('.subtotal-total').textContent = data.total;
            document.querySelector('.total').textContent = data.total;
            
            // Update cart count in navbar
            const cartCount = document.querySelector('.fa-shopping-bag + span');
            if (cartCount) {
                const currentCount = parseInt(cartCount.textContent);
                cartCount.textContent = Math.max(0, currentCount - 1);
            }
            
            // If cart is empty, reload page
            if (document.querySelectorAll('.cart-item').length === 0) {
                location.reload();
            }
        }
    });
}
</script>
@endpush