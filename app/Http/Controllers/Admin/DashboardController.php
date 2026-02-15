<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use App\Exports\OrdersExport;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'week');
        
        // Définir les dates selon la période
        switch($period) {
            case 'today':
                $start = Carbon::today();
                $end = Carbon::today()->endOfDay();
                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            default:
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
        }

        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::whereBetween('created_at', [$start, $end])->count(),
            'total_customers' => User::where('is_admin', false)->whereBetween('created_at', [$start, $end])->count(),
            'total_sales' => Order::where('payment_status', 'paid')
                ->where('status', 'delivered')
                ->whereBetween('created_at', [$start, $end])
                ->sum('total_amount'),
        ];

        $recent_orders = Order::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->take(5)
            ->get();
            
        $top_products = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'top_products', 'period'));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'week');
        $format = $request->get('format', 'csv');
        
        // Définir les dates selon la période
        switch($period) {
            case 'today':
                $start = Carbon::today();
                $end = Carbon::today()->endOfDay();
                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            default:
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
        }

        $filename = 'commandes_' . $period . '_' . now()->format('Y-m-d_H-i-s');
        
        $export = new OrdersExport($start, $end);
        $data = $export->getArrayData();
        
        if ($format == 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '.csv"',
            ];
            
            $callback = function() use ($data) {
                $file = fopen('php://output', 'w');
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
        }
        
        // Pour l'instant, on retourne seulement le CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.csv"',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
