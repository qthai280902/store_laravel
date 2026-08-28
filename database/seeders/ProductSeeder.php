<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return;
        }

        $productsData = [
            ['Rau củ hữu cơ', 'Cải bó xôi Đà Lạt', 25000],
            ['Rau củ hữu cơ', 'Cà chua Cherry', 45000],
            ['Trái cây nhập khẩu', 'Nho mẫu đơn', 450000],
            ['Thực phẩm tươi sống', 'Thịt bò Úc', 350000],
            ['Thực phẩm khô & Đóng gói', 'Mì cay kimchi Hàn Quốc', 35000],
        ];

        foreach ($productsData as $data) {
            $catName = $data[0];
            $name = $data[1];
            $price = $data[2];

            $cat = $categories->where('name', $catName)->first();

            if ($cat) {
                Product::create([
                    'category_id' => $cat->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'Thực phẩm chuẩn VietGAP/GlobalGAP: '.$name,
                    'base_price' => $price,
                    'image_url' => 'https://placehold.co/600x400/F5F5F5/00490e?text='.urlencode($name),
                ]);
            }
        }
    }
}
