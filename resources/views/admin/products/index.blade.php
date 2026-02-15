@extends('admin.layouts.app')

@section('title', 'Gestion des Produits')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Produits</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un produit
            
        </a>
       
    </div>
</div>

<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Liste des produits</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="{{ $product->name }}" width="50" height="50" class="rounded">
                            @else
                                <img src="https://via.placeholder.com/50" alt="No image" width="50" height="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $product->stock_badge_color }}">
                                {{ $product->stock_status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Bouton View -->
                                <a href="{{ route('admin.products.show', $product->id) }}" 
                                   class="btn btn-sm btn-success text-white"
                                   style="padding: 4px 10px; font-size: 13px; border-radius: 4px;"
                                   title="Voir">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                
                                <!-- Bouton Edit -->
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="btn btn-sm btn-primary text-white"
                                   style="padding: 4px 12px; font-size: 13px; border-radius: 4px;"
                                   title="Modifier">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                
                                <!-- Bouton Delete -->
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger text-white" 
                                            style="padding: 4px 8px; font-size: 13px; border-radius: 4px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                            title="Supprimer">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucun produit trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.bootstrap-5-clean') }}
        </div>
    </div>
</div>
@endsection