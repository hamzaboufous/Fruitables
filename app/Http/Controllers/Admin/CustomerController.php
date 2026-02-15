<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        // Marquer toutes les notifications de clients comme lues
        \App\Models\AdminNotification::where('type', 'new_customer')
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        $customers = User::where('is_admin', false)->withCount('orders')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        if ($customer->is_admin) {
            abort(404);
        }
        
        $customer->load('orders.orderItems.product');
        return view('admin.customers.show', compact('customer'));
    }
}
