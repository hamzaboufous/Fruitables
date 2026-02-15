@extends('layouts.app')

@section('content')
<!-- Search Results Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Résultats de recherche</h1>
            <p class="text-muted">Recherche pour : "{{ $query }}"</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-12">
                @if($products->count() > 0)
                    <div class="row g-4">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/fruite-item-1.jpg') }}" class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $product->category->name }}</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h5>{{ $product->name }}</h5>
                                    <p>{{ Str::limit($product->short_description, 80) }}</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">{{ $product->formatted_price }} / kg</p>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Détails
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-search fa-4x text-muted mb-3"></i>
                        <h4>Aucun produit trouvé pour "{{ $query }}"</h4>
                        <p class="text-muted">Essayez d'autres termes de recherche ou parcourez notre boutique</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">Parcourir la boutique</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Search Results End -->
@endsection
