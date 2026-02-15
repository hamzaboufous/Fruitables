@extends('admin.layouts.app')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Catégories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une catégorie
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Produits</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Bouton Edit -->
                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                   class="btn btn-sm btn-primary text-white"
                                   style="padding: 4px 12px; font-size: 13px; border-radius: 4px;"
                                   title="Modifier">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                
                                <!-- Bouton Delete -->
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger text-white" 
                                            style="padding: 4px 8px; font-size: 13px; border-radius: 4px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                            title="Supprimer">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune catégorie trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links('vendor.pagination.bootstrap-5-clean') }}
        </div>
    </div>
</div>
@endsection