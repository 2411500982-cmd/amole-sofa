<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\WebsiteImage;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        // KATEGORI PRODUK
        $categories = Category::withCount([
            'products' => function ($query) {
                $query->where('status', 'public');
            },
        ])->get();

        // PRODUK
        $products = Product::with('category')
            ->where('status', 'public')
            ->latest()
            ->get();

        // BANNER PROMO AKTIF
        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        // FOTO LAYANAN
        $websiteImages = WebsiteImage::all()
            ->keyBy('image_key');

        // GALERI AKTIF
        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        return view('home', compact(
            'categories',
            'products',
            'banners',
            'websiteImages',
            'galleries'
        ));
    }
}
