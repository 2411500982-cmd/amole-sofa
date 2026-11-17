<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'is_featured',
        'is_new',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
    ];

    // Produk dimiliki oleh satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Produk dapat masuk ke banyak keranjang
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Produk dapat muncul di banyak rincian pesanan
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Produk dapat memiliki banyak foto
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order');
    }

    // Produk dapat dimiliki banyak wishlist pengguna
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
}
