@extends('admin.layouts.app')

@section('title', 'Détails du Client')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $customer->full_name }}</h1>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informations personnelles</h6>
            </div>
            <div class="card-body">
                <p><strong>Nom:</strong> {{ $customer->full_name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Téléphone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                <p><strong>Date d'inscription:</strong> {{ $customer->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Statut:</strong> 
                    <span class="badge bg-{{ $customer->is_active ? 'success' : 'danger' }}">
                        {{ $customer->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </p>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Adresse</h6>
            </div>
            <div class="card-body">
                @if($customer->address)
                    <p>{{ $customer->address }}</p>
                    <p>{{ $customer->postal_code }} {{ $customer->city }}</p>
                    <p>{{ $customer->country }}</p>
                @else
                    <p class="text-muted">Aucune adresse renseignée</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Historique des commandes</h6>
            </div>
            <div class="card-body">
                @if($customer->orders->count() > 0)
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
                                @foreach($customer->orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ number_format($order->total_amount, 2, ',', ' ') }} €</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5>{{ $customer->orders->count() }}</h5>
                                    <small class="text-muted">Commandes totales</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5>{{ number_format($customer->orders->sum('total_amount'), 2, ',', ' ') }} €</h5>
                                    <small class="text-muted">Total dépensé</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5>{{ number_format($customer->orders->avg('total_amount'), 2, ',', ' ') }} €</h5>
                                    <small class="text-muted">Panier moyen</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h5>Aucune commande</h5>
                        <p class="text-muted">Ce client n'a pas encore passé de commande</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
