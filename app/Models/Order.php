<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'recipient_name',
        'phone',
        'shipping_address',
        'notes',
    ];

    // Pesanan dimiliki oleh satu pelanggan
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Pesanan memiliki banyak rincian produk
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
