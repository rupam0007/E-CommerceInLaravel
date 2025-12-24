<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_percentage',
        'discount_price',
        'has_discount',
        'stock_quantity',
        'category_id',
        'image',
        'is_active',
        'sku',
        'weight',
        'dimensions'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'has_discount' => 'boolean',
        'is_active' => 'boolean',
        'weight' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->has_discount && $this->discount_price) {
            return $this->discount_price;
        }
        return $this->price;
    }

    public function getDiscountAmountAttribute()
    {
        if ($this->has_discount && $this->discount_price) {
            return $this->price - $this->discount_price;
        }
        return 0;
    }

    public function getImageUrlAttribute(): string
    {
        $image = $this->image;

        if (!$image) {
            return 'https://via.placeholder.com/800x800.png?text=Product';
        }

        // If it's already a full URL
        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        // If it starts with storage/ (from public disk)
        if (Str::startsWith($image, 'storage/')) {
            return asset($image);
        }

        // If it's stored in public disk (e.g., products/xxx.jpg)
        if (Str::startsWith($image, 'products/')) {
            return asset('storage/' . $image);
        }

        // If it starts with uploads/
        if (Str::startsWith($image, 'uploads/')) {
            return asset($image);
        }

        // Default: assume it's in storage
        return asset('storage/' . ltrim($image, '/'));
    }
}