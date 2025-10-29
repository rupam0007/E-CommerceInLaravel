<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount(['orders', 'cart']);

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by registration date
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        $customer->load(['orders.orderItems.product']);
        
        $stats = [
            'total_orders' => $customer->orders->count(),
            'total_spent' => $customer->orders->where('payment_status', 'completed')->sum('total_amount'),
            'avg_order_value' => $customer->orders->where('payment_status', 'completed')->avg('total_amount') ?? 0,
            'last_order' => $customer->orders->sortByDesc('created_at')->first()
        ];

        return view('admin.customers.show', compact('customer', 'stats'));
    }
}
