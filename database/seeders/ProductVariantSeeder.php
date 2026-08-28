<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->name === 'Mì cay kimchi Hàn Quốc') {
                $levels = ['Cấp độ 3', 'Cấp độ 4', 'Cấp độ 5'];
                foreach ($levels as $level) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => strtoupper(uniqid('SKU-MICAY-')),
                        'name' => $level,
                        'price' => $product->base_price,
                        'stock_quantity' => 50,
                    ]);
                }
            } else {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => strtoupper(uniqid('SKU-')),
                    'name' => 'Mặc định',
                    'price' => $product->base_price,
                    'stock_quantity' => 100,
                ]);
            }
        }
    }
}
