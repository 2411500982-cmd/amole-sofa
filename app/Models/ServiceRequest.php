<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'nama_layanan',
        'detail',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'gambar' => 'array',
        ];
    }

    // RELASI KE PELANGGAN
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
