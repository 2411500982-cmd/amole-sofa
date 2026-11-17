<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    // MENAMPILKAN KERANJANG BELANJA
    public function index()
    {
        $cart = Auth::user()->cart()->firstOrCreate();

        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    // MENAMBAHKAN PRODUK KE KERANJANG
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['sometimes', 'required', 'integer', 'min:1'],
        ]);

        $quantity = (int) ($validated['quantity'] ?? 1);

        // PRODUK HARUS BERSTATUS PUBLIC
        if ($product->status !== 'public') {
            abort(404);
        }

        // PERIKSA STOK PRODUK
        if ($product->stock < 1) {
            return back()->with('error', 'Maaf, produk sedang habis.');
        }

        // AMBIL KERANJANG MILIK PENGGUNA LOGIN
        $cart = Auth::user()->cart()->firstOrCreate();

        try {
            DB::transaction(function () use ($cart, $product, $quantity) {

                // KUNCI DATA PRODUK UNTUK MEMERIKSA STOK TERBARU
                $lockedProduct = Product::where('id', $product->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // PASTIKAN PRODUK MASIH PUBLIC
                if ($lockedProduct->status !== 'public') {
                    abort(404);
                }

                // PASTIKAN STOK MASIH TERSEDIA
                if ($lockedProduct->stock < 1) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Maaf, produk sedang habis.',
                    ]);
                }

                // PERIKSA PRODUK YANG SUDAH ADA DI KERANJANG
                $cartItem = $cart->items()
                    ->where('product_id', $lockedProduct->id)
                    ->lockForUpdate()
                    ->first();

                $currentQuantity = $cartItem
                    ? (int) $cartItem->quantity
                    : 0;

                $newQuantity = $currentQuantity + $quantity;

                // PASTIKAN JUMLAH TIDAK MELEBIHI STOK
                if ($newQuantity > $lockedProduct->stock) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Jumlah produk melebihi stok yang tersedia.',
                    ]);
                }

                // SIMPAN PRODUK KE KERANJANG
                $cart->items()->updateOrCreate(
                    [
                        'product_id' => $lockedProduct->id,
                    ],
                    [
                        'quantity' => $newQuantity,
                    ]
                );
            }, 3);

        } catch (ValidationException $exception) {
            throw $exception;
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // MEMPERBARUI JUMLAH PRODUK DI KERANJANG
    public function update(Request $request, CartItem $cartItem)
    {
        // PASTIKAN ITEM KERANJANG MILIK PENGGUNA LOGIN
        abort_unless(
            $cartItem->cart &&
            (int) $cartItem->cart->user_id === (int) Auth::id(),
            404
        );

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ], [
            'quantity.min' => 'Jumlah produk minimal 1.',
            'quantity.required' => 'Jumlah produk wajib diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa angka.',
        ]);

        $quantity = (int) $validated['quantity'];

        DB::transaction(function () use ($cartItem, $quantity) {

            // AMBIL DAN KUNCI DATA PRODUK
            $product = Product::where(
                'id',
                $cartItem->product_id
            )->lockForUpdate()->firstOrFail();

            // PASTIKAN PRODUK MASIH PUBLIC
            if ($product->status !== 'public') {
                throw ValidationException::withMessages([
                    'quantity' => 'Produk sudah tidak tersedia.',
                ]);
            }

            // PERIKSA STOK TERBARU
            if ($quantity > $product->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Jumlah produk melebihi stok yang tersedia.',
                ]);
            }

            // PERBARUI JUMLAH PRODUK
            $cartItem->update([
                'quantity' => $quantity,
            ]);
        }, 3);

        return back()->with(
            'success',
            'Jumlah produk berhasil diperbarui.'
        );
    }
}
