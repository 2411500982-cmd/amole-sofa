<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\WebsiteImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


// ==========================================
// HALAMAN UTAMA
// ==========================================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// ==========================================
// DAFTAR LAYANAN AMOLE SOFA
// ==========================================

$layanan = [
    'reparasi-sofa' => [
        'nama' => 'Service dan Reparasi Sofa',
        'route' => 'layanan.reparasi',
    ],

    'ganti-kain-sofa' => [
        'nama' => 'Ganti Kain Sofa',
        'route' => 'layanan.kain',
    ],

    'ganti-busa-sofa' => [
        'nama' => 'Ganti Busa Sofa',
        'route' => 'layanan.busa',
    ],

    'sofa-custom' => [
        'nama' => 'Pembuatan Sofa Custom',
        'route' => 'layanan.custom',
    ],
];


// ==========================================
// HALAMAN FORM LAYANAN - WAJIB LOGIN
// ==========================================

foreach ($layanan as $slug => $data) {

    Route::get('/layanan/' . $slug, function () use ($data) {

        return view('layanan.form', [
            'namaLayanan' => $data['nama'],
        ]);

    })->middleware('auth')->name($data['route']);
}


// ==========================================
// PROSES KONSULTASI, DATABASE, DAN WHATSAPP
// ==========================================

Route::post('/layanan/konsultasi', function (Request $request) {

    // VALIDASI DATA KONSULTASI
    $validated = $request->validate([

        'nama' => [
            'required',
            'string',
            'max:100',
        ],

        'telepon' => [
            'required',
            'string',
            'max:20',
        ],

        'alamat' => [
            'required',
            'string',
            'max:255',
        ],

        'detail' => [
            'required',
            'string',
            'max:2000',
        ],

        'namaLayanan' => [
            'required',
            'string',
            'in:Service dan Reparasi Sofa,Ganti Kain Sofa,Ganti Busa Sofa,Pembuatan Sofa Custom',
        ],

        'gambar' => [
            'nullable',
            'array',
            'max:5',
        ],

        'gambar.*' => [
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:5120',
        ],

    ], [

        'namaLayanan.in' => 'Jenis layanan yang dipilih tidak tersedia.',
        'gambar.max' => 'Maksimal hanya boleh mengunggah 5 gambar.',
        'gambar.*.image' => 'File yang diunggah harus berupa gambar.',
        'gambar.*.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
        'gambar.*.max' => 'Ukuran setiap gambar maksimal 5 MB.',

    ]);


    // SIMPAN FOTO KONSULTASI
    $daftarGambar = [];

    if ($request->hasFile('gambar')) {

        foreach ($request->file('gambar') as $gambar) {

            $path = Storage::disk('public')->putFile(
                'konsultasi',
                $gambar
            );

            if ($path === false) {
                throw new \RuntimeException('Gagal menyimpan foto konsultasi.');
            }

            $daftarGambar[] = $path;
        }
    }


    // SIMPAN DATA KONSULTASI
    $serviceRequest = new ServiceRequest();

    $serviceRequest->nama = $validated['nama'];
    $serviceRequest->telepon = $validated['telepon'];
    $serviceRequest->alamat = $validated['alamat'];
    $serviceRequest->nama_layanan = $validated['namaLayanan'];
    $serviceRequest->detail = $validated['detail'];
    $serviceRequest->gambar = $daftarGambar;

    // USER ID DIAMBIL DARI PELANGGAN YANG LOGIN
    $serviceRequest->user()->associate(auth()->user());

    // STATUS DITENTUKAN OLEH SISTEM
    $serviceRequest->status = 'Menunggu';

    $serviceRequest->save();


    // ======================================
    // SUSUN PESAN WHATSAPP
    // ======================================

    $pesan = "HALO AMOLE SOFA, SAYA INGIN KONSULTASI.\n\n";

    $pesan .= "Layanan: " . $validated['namaLayanan'] . "\n";
    $pesan .= "Nama: " . $validated['nama'] . "\n";
    $pesan .= "No. WhatsApp: " . $validated['telepon'] . "\n";
    $pesan .= "Alamat: " . $validated['alamat'] . "\n";
    $pesan .= "Detail Konsultasi: " . $validated['detail'] . "\n";


    // TAMBAHKAN LINK FOTO JIKA ADA
    if (count($daftarGambar) > 0) {

        $pesan .= "\nFoto Referensi:\n";

        foreach ($daftarGambar as $index => $path) {

            $urlGambar = url(
                Storage::disk('public')->url($path)
            );

            $pesan .= ($index + 1) . ". " . $urlGambar . "\n";
        }

    } else {

        $pesan .= "\nFoto Referensi: Tidak ada.\n";
    }


    // NOMOR WHATSAPP ADMIN
    $nomorAdmin = '6281514744233';

    $urlWhatsApp = 'https://wa.me/' . $nomorAdmin . '?text=' . urlencode($pesan);

    return redirect()->away($urlWhatsApp);

})->middleware('auth')->name('layanan.konsultasi');


// ==========================================
// HALAMAN DETAIL PRODUK
// ==========================================

Route::get('/produk/{id}', function ($id) {

    $product = Product::with(['category', 'images'])
        ->where('status', 'public')
        ->findOrFail($id);

    $relatedProducts = Product::with('category')
        ->where('status', 'public')
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(4)
        ->get();

    return view('detail-produk', compact(
        'product',
        'relatedProducts'
    ));

})->name('produk.detail');


// ==========================================
// LOGIN DAN REGISTER
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

});


// ==========================================
// ROUTE PENGGUNA YANG SUDAH LOGIN
// ==========================================

Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // CHECKOUT
    Route::get('/checkout/{product}', [OrderController::class, 'direct'])
        ->name('checkout.direct');

    Route::post('/checkout/{product}', [OrderController::class, 'store'])
        ->name('checkout.store');


    // PESANAN SAYA
    Route::get('/pesanan-saya', [OrderController::class, 'myOrders'])
        ->name('orders.mine');


    // LAYANAN SAYA
    Route::get('/layanan-saya', function () {

        $serviceRequests = ServiceRequest::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view(
            'pelanggan.layanan.index',
            compact('serviceRequests')
        );

    })->name('layanan.mine');


    // WISHLIST
    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');


    // KERANJANG
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');

});


// ==========================================
// ROUTE KHUSUS ADMIN
// ==========================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // KELOLA PRODUK
        Route::resource('products', ProductController::class);


        // KELOLA GALERI PORTOFOLIO
        Route::resource('galleries', GalleryController::class)
            ->except(['show']);


        // KELOLA BANNER PROMO
        Route::resource('banners', BannerController::class)
            ->except(['show']);


        // KELOLA FOTO LAYANAN
        Route::get('/website-images', [WebsiteImageController::class, 'index'])
            ->name('website-images.index');

        Route::post('/website-images/{key}', [WebsiteImageController::class, 'update'])
            ->name('website-images.update');


        // KELOLA PESANAN
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');


        // KELOLA LAYANAN
        Route::get('/service-requests', [ServiceRequestController::class, 'index'])
            ->name('service-requests.index');

        Route::get('/service-requests/{id}', [ServiceRequestController::class, 'show'])
            ->name('service-requests.show');

        Route::patch('/service-requests/{id}/status', [ServiceRequestController::class, 'updateStatus'])
            ->name('service-requests.updateStatus');

        Route::delete('/service-requests/{id}', [ServiceRequestController::class, 'destroy'])
            ->name('service-requests.destroy');

    });
