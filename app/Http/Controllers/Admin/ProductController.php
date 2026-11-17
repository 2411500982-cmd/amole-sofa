<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // Menampilkan formulir tambah produk
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'status' => ['required', 'in:public,draft'],
        ]);

        $product = new Product();

        $product->fill([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_new' => $request->boolean('is_new'),
        ]);

        $product->slug = Str::slug($validated['name'])
            . '-' . Str::random(5);

        $product->price = $validated['price'];
        $product->discount_price = $validated['discount_price'] ?? null;
        $product->stock = $validated['stock'];
        $product->status = $validated['status'];

        // Upload foto utama
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')
                ->store('products', 'public');
        }

        $product->save();

        // Upload foto galeri
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan formulir edit produk
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        $product->load('images');

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'status' => ['required', 'in:public,draft'],
        ]);

        $product->fill([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_new' => $request->boolean('is_new'),
        ]);

        // Memperbarui slug jika nama berubah
        if ($product->isDirty('name')) {
            $product->slug = Str::slug($validated['name'])
                . '-' . Str::random(5);
        }

        // Mengisi data penting secara eksplisit
        $product->price = $validated['price'];
        $product->discount_price = $validated['discount_price'] ?? null;
        $product->stock = $validated['stock'];
        $product->status = $validated['status'];

        // Mengganti foto utama
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('products', 'public');

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $newImage;
        }

        $product->save();

        // Menambahkan foto galeri
        if ($request->hasFile('images')) {
            $lastOrder = $product->images()->max('sort_order') ?? -1;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        // Periksa apakah produk sudah digunakan dalam pesanan
        $memilikiPesanan = DB::table('order_items')
            ->where('product_id', $product->id)
            ->exists();

        if ($memilikiPesanan) {
            return redirect()
                ->route('admin.products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah memiliki riwayat pesanan. Ubah status produk menjadi draft agar tidak tampil di katalog.'
                );
        }

        // Simpan lokasi foto sebelum data galeri dihapus
        $fotoUtama = $product->image;

        $fotoGaleri = $product->images()
            ->pluck('image_path')
            ->filter()
            ->all();

        // Hapus data galeri dan produk dalam transaksi database
        DB::transaction(function () use ($product) {
            $product->images()->delete();

            $product->delete();
        });

        // Hapus file foto setelah data berhasil dihapus
        if ($fotoUtama) {
            Storage::disk('public')->delete($fotoUtama);
        }

        foreach ($fotoGaleri as $path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
