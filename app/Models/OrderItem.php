<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'price',
        'subtotal',
    ];

    // Rincian produk dimiliki oleh satu pesanan
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Rincian pesanan terhubung dengan satu produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
