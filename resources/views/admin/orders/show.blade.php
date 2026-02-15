@extends('admin.layouts.app')

@section('title', 'Détails de la Commande')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Commande #{{ $order->order_number }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Articles de la commande</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ number_format($item->price, 2, ',', ' ') }} €</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->total, 2, ',', ' ') }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th>{{ number_format($order->total_amount, 2, ',', ' ') }} €</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
            </div>
            <div class="card-body">
                <p><strong>Client:</strong> {{ $order->user->full_name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Téléphone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                
                <hr>
                
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" name="status">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Mettre à jour le statut</button>
                </form>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Adresse de livraison</h6>
            </div>
            <div class="card-body">
                <p>{{ $order->user->address }}</p>
                <p>{{ $order->user->postal_code }} {{ $order->user->city }}</p>
                <p>{{ $order->user->country }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
