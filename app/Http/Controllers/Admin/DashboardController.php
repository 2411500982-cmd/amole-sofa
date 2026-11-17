<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();

        $totalPesanan = Order::count();

        $totalPenjualan = Order::sum('total_amount');

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalPenjualan'
        ));
    }
}
