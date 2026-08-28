<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Rau củ hữu cơ',
            'Trái cây nhập khẩu',
            'Thực phẩm tươi sống',
            'Thực phẩm khô & Đóng gói',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => "Danh mục $category tươi ngon, chất lượng cao.",
            ]);
        }
    }
}
