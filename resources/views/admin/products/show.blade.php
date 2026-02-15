@extends('admin.layouts.app')

@section('title', 'Détails du Produit')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails du Produit</h1>
</div>

<div class="row">
    <!-- Colonne gauche (40%) -->
    <div class="col-lg-5 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <!-- Image du produit -->
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded mb-3" 
                         style="max-width: 400px; max-height: 400px; object-fit: cover;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                         style="width: 400px; height: 400px; margin: 0 auto;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
                
                <!-- Nom du produit -->
                <h2 class="h3 mb-3">{{ $product->name }}</h2>
                
                <!-- Prix -->
                <div class="h4 text-success mb-3">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                </div>
                
                <!-- Badges -->
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <!-- Badge Stock -->
                    @if($product->quantity > 0)
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-check-circle"></i> 
                            En stock ({{ $product->quantity }})
                        </span>
                    @else
                        <span class="badge bg-danger fs-6">
                            <i class="fas fa-times-circle"></i> 
                            Rupture de stock
                        </span>
                    @endif
                    
                    <!-- Badge Statut -->
                    @if($product->is_active)
                        <span class="badge bg-primary fs-6">
                            <i class="fas fa-power-off"></i> 
                            Actif
                        </span>
                    @else
                        <span class="badge bg-secondary fs-6">
                            <i class="fas fa-ban"></i> 
                            Inactif
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Colonne droite (60%) -->
    <div class="col-lg-7 mb-4">
        <!-- Informations générales -->
        <div class="card shadow mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informations générales
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Catégorie:</label>
                        <div>{{ $product->category->name ?? 'Non définie' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">SKU:</label>
                        <div class="font-monospace">{{ $product->sku }}</div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Description complète:</label>
                    <div class="border rounded p-3 bg-light">
                        {!! $product->description !!}
                    </div>
                </div>
                
                @if($product->short_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Description courte:</label>
                    <div class="border rounded p-3 bg-light">
                        {{ $product->short_description }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Gestion du stock -->
        <div class="card shadow mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-boxes me-2"></i>Gestion du stock
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Quantité disponible:</label>
                        <div class="h5">
                            {{ $product->quantity }} 
                            <small class="text-muted">unités</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Suivi de stock:</label>
                        <div>
                            @if($product->track_quantity)
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> Activé
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-times"></i> Désactivé
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Statut du stock:</label>
                        <div>
                            @if($product->quantity > 0)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Disponible
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-exclamation-triangle"></i> Épuisé
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dates -->
        <div class="card shadow mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Dates
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Créé le:</label>
                        <div>
                            <i class="fas fa-plus-circle text-success me-1"></i>
                            {{ $product->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Modifié le:</label>
                        <div>
                            <i class="fas fa-edit text-primary me-1"></i>
                            {{ $product->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('admin.products.index') }}" 
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
