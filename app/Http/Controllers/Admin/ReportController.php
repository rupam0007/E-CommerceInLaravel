<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '30'); // Default to 30 days
        $startDate = Carbon::now()->subDays($period);

        // Sales Overview
        $salesData = [
            'total_revenue' => Order::where('payment_status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->sum('total_amount'),
            'total_orders' => Order::where('created_at', '>=', $startDate)->count(),
            'avg_order_value' => Order::where('payment_status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->avg('total_amount') ?? 0,
            'completed_orders' => Order::where('payment_status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->count()
        ];

        // Top Selling Products
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', function($query) use ($startDate) {
                $query->where('payment_status', 'completed')
                      ->where('created_at', '>=', $startDate);
            })
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->with('product.category')
            ->get();

        // Revenue by Day (for chart)
        $dailyRevenue = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->where('payment_status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Order Status Distribution
        $orderStatusData = Order::select('status', DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('status')
            ->get();

        // New Customers
        $newCustomers = User::where('created_at', '>=', $startDate)->count();

        return view('admin.reports.index', compact(
            'salesData', 
            'topProducts', 
            'dailyRevenue', 
            'orderStatusData', 
            'newCustomers',
            'period'
        ));
    }
}
