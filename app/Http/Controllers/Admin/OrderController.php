<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    // Menampilkan semua pesanan pelanggan
    public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(10);

        $totalPending = Order::where('status', 'pending')->count();

        return view('admin.orders.index', compact(
            'orders',
            'totalPending'
        ));
    }

    // Memperbarui status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'processing',
                    'shipped',
                    'completed',
                    'cancelled',
                ]),
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
