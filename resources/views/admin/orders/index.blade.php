@extends('admin.layouts.app')

@section('title', 'Gestion des Commandes')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Commandes</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Mise à jour</th>
                        <th>Actions</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <!-- Numéro -->
                        <td>{{ $order->order_number }}</td>
                        
                        <!-- Client -->
                        <td>{{ $order->user->full_name }}</td>
                        
                        <!-- Date -->
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        
                        <!-- Total -->
                        <td>{{ number_format($order->total, 2, ',', ' ') }} €</td>
                        
                        <!-- Statut (badge) - CENTRÉ -->
                        <td class="text-center">
                            @php
                                $statusClasses = [
                                    'delivered' => 'bg-success',
                                    'processing' => 'bg-primary',
                                    'pending' => 'bg-warning',
                                    'cancelled' => 'bg-danger',
                                    'confirmed' => 'bg-info',
                                    'shipped' => 'bg-info',
                                    'expedited' => 'bg-secondary'
                                ];
                                $statusLabels = [
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'confirmed' => 'Confirmed',
                                    'shipped' => 'Shipped',
                                    'delivered' => 'Delivered',
                                    'cancelled' => 'Cancelled'
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        
                        <!-- Paiement (badge) - CENTRÉ -->
                        <td class="text-center">
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> Payé
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock"></i> En attente
                                </span>
                            @endif
                        </td>
                        
                        <!-- Mise à jour (dropdown statut commande) -->
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" class="form-select form-select-sm"
                                        style="width: 150px;"
                                        onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        
                        <!-- Actions (dropdown paiement) -->
                        <td>
                            <form action="{{ route('admin.orders.update-payment', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="payment_status" class="form-select form-select-sm" style="width: 100px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Payé</option>
                                </select>
                            </form>
                        </td>
                        
                        <!-- Détails (bouton Voir) -->
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Aucune commande trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links('vendor.pagination.bootstrap-5-clean') }}
        </div>
    </div>
</div>
@endsection