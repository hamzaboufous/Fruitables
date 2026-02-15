<?php

namespace App\Exports;

use App\Models\Order;

class OrdersExport
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getArrayData()
    {
        $query = Order::with('user');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        $orders = $query->get([
            'order_number',
            'user_id',
            'total_amount',
            'status',
            'payment_status',
            'payment_method',
            'created_at'
        ]);

        $data = [];
        $data[] = [
            'Numéro Commande',
            'Client',
            'Total (€)',
            'Statut',
            'Statut Paiement',
            'Méthode Paiement',
            'Date'
        ];

        foreach ($orders as $order) {
            $data[] = [
                $order->order_number,
                $order->user ? $order->user->full_name : 'N/A',
                number_format($order->total_amount, 2, ',', ' '),
                $order->status_label,
                $order->payment_status_label,
                $order->payment_method,
                $order->created_at->format('d/m/Y H:i')
            ];
        }

        return $data;
    }
}
