<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // Item dimiliki oleh satu keranjang
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // Item terhubung dengan satu produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
