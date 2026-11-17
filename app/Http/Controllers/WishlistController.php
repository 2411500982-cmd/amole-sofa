<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    // MENAMPILKAN WISHLIST PENGGUNA
    public function index(Request $request): View
    {
        $wishlists = $request->user()
            ->wishlists()
            ->with(['product.category'])
            ->whereHas('product', function ($query) {
                $query->where('status', 'public');
            })
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    // MENAMBAHKAN ATAU MENGHAPUS WISHLIST
    public function toggle(
        Request $request,
        Product $product
    ): RedirectResponse {

        // PRODUK HARUS BERSTATUS PUBLIC
        if ($product->status !== 'public') {
            abort(404);
        }

        // AMBIL WISHLIST MILIK PENGGUNA LOGIN
        $wishlist = $request->user()
            ->wishlists()
            ->where('product_id', $product->id)
            ->first();

        // JIKA SUDAH ADA, HAPUS WISHLIST
        if ($wishlist) {
            $wishlist->delete();

            return back()->with(
                'success',
                'Produk berhasil dihapus dari Wishlist.'
            );
        }

        // JIKA BELUM ADA, TAMBAHKAN WISHLIST
        $request->user()->wishlists()->create([
            'product_id' => $product->id,
        ]);

        return back()->with(
            'success',
            'Produk berhasil ditambahkan ke Wishlist.'
        );
    }
}
