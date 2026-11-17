<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sofa',
                'slug' => 'sofa',
                'description' => 'Berbagai pilihan sofa berkualitas.',
            ],
            [
                'name' => 'Kursi',
                'slug' => 'kursi',
                'description' => 'Koleksi kursi untuk kebutuhan rumah.',
            ],
            [
                'name' => 'Bangku',
                'slug' => 'bangku',
                'description' => 'Koleksi bangku dengan desain elegan.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
