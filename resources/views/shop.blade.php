@extends('layouts.app')

@section('content')
<!-- Shop Start -->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Notre Boutique</h1>
            <p class="text-muted">Découvrez nos produits frais et bio</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3">Filtrer par catégorie</h5>
                    <div class="list-group">
                        <a href="{{ route('shop') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                            Tous les produits
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category->slug]) }}" class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-4">
                    @if(isset($products) && $products->count() > 0)
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('components.product-card', ['product' => $product])
                        </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fa fa-box-open fa-4x text-muted mb-3"></i>
                                <h4>Aucun produit trouvé</h4>
                                <p class="text-muted">Essayez de modifier vos filtres ou revenez plus tard</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if(isset($products) && $products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('vendor.pagination.bootstrap-5-clean') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Shop End -->
@endsection
