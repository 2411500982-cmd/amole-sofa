<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Pengguna memiliki satu keranjang belanja
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    // Pengguna dapat memiliki banyak pesanan
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Pengguna dapat memiliki banyak wishlist
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
}
