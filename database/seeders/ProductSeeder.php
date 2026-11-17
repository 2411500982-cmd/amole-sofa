<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $sofa = Category::where('slug', 'sofa')->first();
        $kursi = Category::where('slug', 'kursi')->first();
        $bangku = Category::where('slug', 'bangku')->first();

        $products = [
            [
                'category_id' => $sofa->id,
                'name' => 'Sofa Minimalis 2 Seater',
                'slug' => 'sofa-minimalis-2-seater',
                'description' => 'Sofa minimalis dengan desain modern dan nyaman.',
                'image' => null,
                'price' => 3500000,
                'discount_price' => 3200000,
                'stock' => 10,
                'is_featured' => true,
            ],
            [
                'category_id' => $sofa->id,
                'name' => 'Sofa L-Shape Premium',
                'slug' => 'sofa-l-shape-premium',
                'description' => 'Sofa L-Shape untuk ruang keluarga.',
                'image' => null,
                'price' => 6500000,
                'discount_price' => null,
                'stock' => 5,
                'is_featured' => true,
            ],
            [
                'category_id' => $kursi->id,
                'name' => 'Kursi Minimalis',
                'slug' => 'kursi-minimalis',
                'description' => 'Kursi minimalis untuk interior rumah.',
                'image' => null,
                'price' => 850000,
                'discount_price' => null,
                'stock' => 15,
                'is_featured' => false,
            ],
            [
                'category_id' => $bangku->id,
                'name' => 'Bangku Kayu',
                'slug' => 'bangku-kayu',
                'description' => 'Bangku kayu dengan tampilan elegan.',
                'image' => null,
                'price' => 1200000,
                'discount_price' => null,
                'stock' => 8,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
