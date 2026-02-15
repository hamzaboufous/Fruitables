<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'subtotal',
        'tax_amount',
        'shipping_amount',
        'status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'billing_address',
        'notes',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute()
    {
        return '€' . number_format($this->total_amount, 2);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">En attente</span>',
            'confirmed' => '<span class="badge bg-info">Confirmée</span>',
            'processing' => '<span class="badge bg-primary">En préparation</span>',
            'shipped' => '<span class="badge bg-secondary">Expédiée</span>',
            'out_for_delivery' => '<span class="badge bg-info text-dark">Chez le livreur</span>',
            'delivered' => '<span class="badge bg-success">Livrée</span>',
            'cancelled' => '<span class="badge bg-danger">Annulée</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Inconnu</span>';
    }

    public function getPaymentStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->payment_status));
    }

    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'cash_on_delivery' => 'Paiement à la livraison',
            'card' => 'Carte de Crédit/Débit',
            'paypal' => 'PayPal',
        ];

        return $methods[$this->payment_method] ?? ucfirst(str_replace('_', ' ', $this->payment_method));
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge badge-payment-pending">🟡 En attente</span>',
            'paid' => '<span class="badge badge-payment-paid">🟢 Payé ✓</span>',
            'failed' => '<span class="badge bg-danger">Échoué</span>',
        ];

        return $badges[$this->payment_status] ?? '<span class="badge bg-secondary">Inconnu</span>';
    }
}
