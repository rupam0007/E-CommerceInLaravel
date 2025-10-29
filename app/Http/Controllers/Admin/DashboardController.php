<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('payment_status', 'completed')->sum('total_amount'),
            'total_products' => Product::count(),
            'total_customers' => User::count()
        ];

        $recent_orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $low_stock_products = Product::with('category')
            ->where('stock_quantity', '<=', 10)
            ->orderBy('stock_quantity', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_orders', 'low_stock_products'));
    }
}
