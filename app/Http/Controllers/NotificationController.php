<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Get latest products added since a given timestamp
     * Used for live notifications
     */
    public function getNewProducts(Request $request)
    {
        $since = $request->input('since');
        
        // If no timestamp provided, return latest product ID only
        if (!$since) {
            $latestProduct = Product::where('is_active', true)
                ->latest()
                ->first();
            
            return response()->json([
                'products' => [],
                'latest_check' => now()->toIso8601String(),
                'latest_id' => $latestProduct ? $latestProduct->id : null
            ]);
        }
        
        // Parse the timestamp
        try {
            $sinceTime = Carbon::parse($since);
        } catch (\Exception $e) {
            return response()->json([
                'products' => [],
                'latest_check' => now()->toIso8601String(),
                'error' => 'Invalid timestamp'
            ]);
        }
        
        // Get products created after the given timestamp
        $newProducts = Product::where('is_active', true)
            ->where('created_at', '>', $sinceTime)
            ->latest()
            ->take(5) // Limit to 5 newest products
            ->get(['id', 'name', 'price', 'image', 'created_at']);
        
        // Format products for notification
        $formattedProducts = $newProducts->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 2),
                'image' => $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png'),
                'url' => route('products.show', $product->id),
                'created_at' => $product->created_at->diffForHumans()
            ];
        });
        
        return response()->json([
            'products' => $formattedProducts,
            'latest_check' => now()->toIso8601String(),
            'count' => $newProducts->count()
        ]);
    }
}
