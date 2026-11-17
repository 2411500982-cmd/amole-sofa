<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteImageController extends Controller
{
    public function index()
    {
        $images = [
            [
                'key' => 'service_reparasi',
                'label' => 'Service dan Reparasi Sofa',
                'default' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=700',
            ],
            [
                'key' => 'service_kain',
                'label' => 'Ganti Kain Sofa',
                'default' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=700',
            ],
            [
                'key' => 'service_busa',
                'label' => 'Ganti Busa Sofa',
                'default' => 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=700',
            ],
            [
                'key' => 'service_custom',
                'label' => 'Pembuatan Sofa Custom',
                'default' => 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=700',
            ],
        ];

        foreach ($images as $item) {
            WebsiteImage::firstOrCreate(
                ['image_key' => $item['key']],
                [
                    'image' => $item['default'],
                    'description' => $item['label'],
                ]
            );
        }

        $websiteImages = WebsiteImage::whereIn(
            'image_key',
            collect($images)->pluck('key')
        )->get()->keyBy('image_key');

        return view('admin.website-images.index', compact('images', 'websiteImages'));
    }

    public function update(Request $request, $key)
    {
        $allowedKeys = [
            'service_reparasi',
            'service_kain',
            'service_busa',
            'service_custom',
        ];

        abort_unless(in_array($key, $allowedKeys), 404);

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'image.required' => 'Silakan pilih foto terlebih dahulu.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        $websiteImage = WebsiteImage::where('image_key', $key)->firstOrFail();

        $oldImage = $websiteImage->image;

        $newImage = $request->file('image')->store(
            'website-images',
            'public'
        );

        if (!$newImage) {
            return back()->with('error', 'Foto gagal diunggah.');
        }

        $websiteImage->update([
            'image' => $newImage,
        ]);

        if (
            $oldImage &&
            !str_starts_with($oldImage, 'http') &&
            Storage::disk('public')->exists($oldImage)
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.website-images.index')
            ->with('success', 'Foto layanan berhasil diperbarui.');
    }
}
