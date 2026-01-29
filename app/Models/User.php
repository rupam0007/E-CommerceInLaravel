<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'profile_video',
        'bio',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'date_of_birth',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function isInWishlist($productId)
    {
        return $this->wishlists()->where('product_id', $productId)->exists();
    }
    
    public function getProfileMediaAttribute()
    {
        if ($this->profile_video) {
            return ['type' => 'video', 'url' => asset($this->profile_video)];
        }
        if ($this->profile_image) {
            return ['type' => 'image', 'url' => asset($this->profile_image)];
        }
        return ['type' => 'text', 'url' => $this->name[0]];
    }
}