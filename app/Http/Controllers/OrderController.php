<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    // MENAMPILKAN HALAMAN CHECKOUT
    public function direct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // PRODUK YANG TIDAK PUBLIC TIDAK BOLEH DI-CHECKOUT
        if ($product->status !== 'public') {
            abort(404);
        }

        $quantity = (int) $validated['quantity'];

        // PERIKSA STOK PRODUK
        if ($quantity > $product->stock) {
            return redirect()
                ->route('produk.detail', $product->id)
                ->with('error', 'Jumlah pesanan melebihi stok yang tersedia.');
        }

        // HITUNG HARGA SETELAH DISKON
        $finalPrice = $product->discount_price &&
            $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;

        return view('checkout.index', compact(
            'product',
            'quantity',
            'finalPrice'
        ));
    }

    // MENYIMPAN PESANAN DAN MENGARAHKAN KE WHATSAPP
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'shipping_address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $quantity = (int) $validated['quantity'];

        // SIMPAN PESANAN DALAM DATABASE TRANSACTION
        $order = DB::transaction(function () use (
            $validated,
            $product,
            $quantity
        ) {

            // KUNCI DATA PRODUK UNTUK MENCEGAH PEMESANAN STOK BERSAMAAN
            $lockedProduct = Product::where('id', $product->id)
                ->lockForUpdate()
                ->firstOrFail();

            // PASTIKAN PRODUK MASIH PUBLIC
            if ($lockedProduct->status !== 'public') {
                abort(404);
            }

            // PERIKSA STOK TERBARU
            if ($quantity > $lockedProduct->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Maaf, stok produk tidak mencukupi.',
                ]);
            }

            // HARGA DIAMBIL LANGSUNG DARI DATABASE
            $price = $lockedProduct->discount_price &&
                $lockedProduct->discount_price < $lockedProduct->price
                ? $lockedProduct->discount_price
                : $lockedProduct->price;

            // HITUNG TOTAL PESANAN
            $subtotal = $price * $quantity;

            // BUAT NOMOR PESANAN
            $orderNumber = 'AMOLE-' . now()->format('YmdHis')
                . random_int(100, 999);

            // BUAT DATA PESANAN
            $order = new Order();

            $order->recipient_name = $validated['recipient_name'];
            $order->phone = $validated['phone'];
            $order->shipping_address = $validated['shipping_address'];
            $order->notes = $validated['notes'] ?? null;

            // TENTUKAN PEMILIK PESANAN DARI AKUN LOGIN
            $order->user()->associate(auth()->user());

            // DATA PESANAN DIATUR OLEH SERVER
            $order->order_number = $orderNumber;
            $order->subtotal = $subtotal;
            $order->shipping_cost = 0;
            $order->total_amount = $subtotal;
            $order->payment_method = 'WhatsApp';
            $order->status = 'pending';

            $order->save();

            // SIMPAN DETAIL PRODUK PESANAN
            $orderItem = $order->items()->make();

            $orderItem->product_id = $lockedProduct->id;
            $orderItem->product_name = $lockedProduct->name;
            $orderItem->quantity = $quantity;
            $orderItem->price = $price;
            $orderItem->subtotal = $subtotal;

            $orderItem->save();

            // KURANGI STOK PRODUK
            $lockedProduct->decrement('stock', $quantity);

            return $order;
        }, 3);

        // AMBIL NAMA PRODUK DARI DETAIL PESANAN
        $productName = $order->items()->value('product_name');

        // SUSUN PESAN WHATSAPP
        $message = "Halo Admin AMOLE SOFA, saya ingin mengonfirmasi pesanan.\n\n"
            . "Nomor Pesanan: {$order->order_number}\n"
            . "Produk: {$productName}\n"
            . "Jumlah: {$quantity}\n"
            . 'Total Produk: Rp ' . number_format($order->total_amount, 0, ',', '.') . "\n\n"
            . "Nama Penerima: {$order->recipient_name}\n"
            . "Nomor WhatsApp: {$order->phone}\n"
            . "Alamat Pengiriman: {$order->shipping_address}\n"
            . 'Catatan: ' . ($order->notes ?: '-') . "\n\n"
            . "Estimasi Pre-Order: 2-3 minggu.\n"
            . 'Mohon informasi lebih lanjut mengenai ongkos kirim dan pembayaran. Terima kasih.';

        // NOMOR WHATSAPP ADMIN
        $whatsappUrl = 'https://wa.me/6281514744233?text='
            . urlencode($message);

        return redirect()->away($whatsappUrl);
    }

    // MENAMPILKAN PESANAN MILIK PELANGGAN LOGIN
    public function myOrders()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pelanggan.pesanan.index', compact('orders'));
    }
}
