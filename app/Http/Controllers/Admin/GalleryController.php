<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // MENAMPILKAN DAFTAR GALERI
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.galleries.index', compact('galleries'));
    }

    // FORM TAMBAH GALERI
    public function create()
    {
        return view('admin.galleries.create');
    }

    // MENYIMPAN GALERI
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['image'] = $request->file('image')
            ->store('galleries', 'public');

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        Gallery::create($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    // FORM EDIT GALERI
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    // MEMPERBARUI GALERI
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $validated['image'] = $request->file('image')
                ->store('galleries', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $gallery->update($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    // MENGHAPUS GALERI
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
