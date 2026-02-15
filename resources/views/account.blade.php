@extends('layouts.app')

@push('styles')
<style>
.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
    z-index: 10;
}

.password-toggle:hover {
    color: #28a745;
}

.form-floating {
    position: relative;
}
</style>
@endpush

@section('content')
<!-- Account Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Mon Compte</h1>
            <p class="text-muted">Gérez vos informations personnelles et vos commandes</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="bg-light rounded p-4 mb-4">
                    <h4 class="mb-4">Informations Personnelles</h4>
                    <form action="{{ route('account.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                                    <label for="first_name">Prénom</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                    <label for="last_name">Nom</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                    <label for="phone">Téléphone</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                    <label for="address">Adresse</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                                    <label for="city">Ville</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $user->postal_code }}">
                                    <label for="postal_code">Code Postal</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                                    <label for="country">Pays</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-light rounded p-4">
                    <h4 class="mb-4">Changer le mot de passe</h4>
                    <form action="{{ route('account.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    <label for="current_password">Mot de passe actuel</label>
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('current_password', this)"></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="new_password" name="new_password" required minlength="8">
                                    <label for="new_password">Nouveau mot de passe</label>
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password', this)"></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                    <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password_confirmation', this)"></i>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-warning w-100 py-3" type="submit">Changer le mot de passe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4">Mes Commandes</h4>
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order->formattedTotal }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                                {{ $order->statusLabel }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Voir
                                            </a>
                                            <a href="{{ route('order.invoice', $order->id) }}" 
                                               class="btn btn-sm btn-success rounded-circle ms-2" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-placement="top" 
                                               title="Voir la facture">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                            @if(in_array($order->status, ['processing', 'pending']))
                                                <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline; margin-left:5px;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger rounded-circle" 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            title="Supprimer la commande">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr id="order-details-{{ $order->id }}" class="d-none">
                                        <td colspan="5">
                                            <div class="p-3 bg-white rounded">
                                                <h6>Articles de la commande</h6>
                                                @foreach($order->orderItems as $item)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                                                    <span>{{ $item->formattedTotal }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa fa-shopping-bag fa-4x text-muted mb-3"></i>
                            <h5>Vous n'avez pas encore de commandes</h5>
                            <p class="text-muted">Commencez vos achats pour voir vos commandes ici</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary">Commencer mes achats</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account End -->
@endsection

@push('scripts')
<script>
// Toggle password visibility
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Initialiser les tooltips Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

function toggleOrderDetails(orderId) {
    const detailsRow = document.getElementById('order-details-' + orderId);
    detailsRow.classList.toggle('d-none');
}
</script>
@endpush