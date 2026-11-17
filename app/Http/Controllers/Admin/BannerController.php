<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            if (!$request->hasFile('image') ||
                !$request->file('image')->isValid()) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'image' => 'Gambar gagal diterima. Silakan pilih gambar lain.',
                    ]);
            }

            $imagePath = $request->file('image')->store('banners', 'public');

            if (!$imagePath) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'image' => 'Gambar gagal disimpan ke penyimpanan.',
                    ]);
            }

            Banner::create([
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'image' => $imagePath,
                'button_text' => $validated['button_text'] ?? null,
                'button_link' => $validated['button_link'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'is_active' => $request->boolean('is_active'),
            ]);

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Banner promo berhasil ditambahkan.');

        } catch (Throwable $e) {
            Log::error('Gagal menyimpan banner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'image' => 'Terjadi kesalahan saat menyimpan banner. Periksa file gambar dan folder penyimpanan.',
                ]);
        }
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                if (!$request->file('image')->isValid()) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'image' => 'Gambar pengganti gagal diterima.',
                        ]);
                }

                $newImagePath = $request->file('image')
                    ->store('banners', 'public');

                if (!$newImagePath) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'image' => 'Gambar pengganti gagal disimpan.',
                        ]);
                }

                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }

                $validated['image'] = $newImagePath;
            }

            $validated['sort_order'] = $validated['sort_order'] ?? 0;
            $validated['is_active'] = $request->boolean('is_active');

            $banner->update($validated);

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Banner promo berhasil diperbarui.');

        } catch (Throwable $e) {
            Log::error('Gagal memperbarui banner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'image' => 'Terjadi kesalahan saat memperbarui banner.',
                ]);
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Banner promo berhasil dihapus.');

        } catch (Throwable $e) {
            Log::error('Gagal menghapus banner: ' . $e->getMessage());

            return back()->with(
                'error',
                'Banner gagal dihapus. Silakan coba kembali.'
            );
        }
    }
}
