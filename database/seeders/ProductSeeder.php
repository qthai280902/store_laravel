<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Rau củ hữu cơ' => Category::firstOrCreate(['name' => 'Rau củ hữu cơ', 'slug' => 'rau-cu-huu-co', 'description' => 'Rau củ trồng tự nhiên']),
            'Trái cây nhập khẩu' => Category::firstOrCreate(['name' => 'Trái cây nhập khẩu', 'slug' => 'trai-cay-nhap-khau', 'description' => 'Trái cây tươi ngon']),
            'Thực phẩm tươi sống' => Category::firstOrCreate(['name' => 'Thực phẩm tươi sống', 'slug' => 'thuc-pham-tuoi-song', 'description' => 'Thịt cá tươi mỗi ngày']),
            'Thực phẩm khô' => Category::firstOrCreate(['name' => 'Thực phẩm khô', 'slug' => 'thuc-pham-kho', 'description' => 'Đồ khô & Đóng gói']),
        ];

        $products = [
            // Rau củ
            ['name' => 'Cải bó xôi Đà Lạt', 'price' => 35000, 'category' => 'Rau củ hữu cơ', 'desc' => 'Cải bó xôi tươi xanh, giàu sắt và vitamin, thu hoạch mỗi sáng tại Đà Lạt.', 'img' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=600'],
            ['name' => 'Cà rốt baby', 'price' => 45000, 'category' => 'Rau củ hữu cơ', 'desc' => 'Cà rốt hữu cơ ngọt tự nhiên, giòn rụm.', 'img' => 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=600'],
            ['name' => 'Bông cải xanh', 'price' => 30000, 'category' => 'Rau củ hữu cơ', 'desc' => 'Bông cải xanh to, chắc, nhiều dinh dưỡng.', 'img' => 'https://images.unsplash.com/photo-1459411621453-7b03977f4bfc?w=600'],
            ['name' => 'Cà chua cherry', 'price' => 50000, 'category' => 'Rau củ hữu cơ', 'desc' => 'Cà chua bi giòn ngọt, thích hợp làm salad.', 'img' => 'https://images.unsplash.com/photo-1561136594-7f68413baa99?w=600'],
            ['name' => 'Khoai tây Đà Lạt', 'price' => 25000, 'category' => 'Rau củ hữu cơ', 'desc' => 'Khoai tây ruột vàng, bở, ngọt.', 'img' => 'https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=600'],
            
            // Trái cây
            ['name' => 'Nho mẫu đơn Hàn Quốc', 'price' => 850000, 'category' => 'Trái cây nhập khẩu', 'desc' => 'Nho mẫu đơn (Shine Muscat) ngọt lịm, giòn, không hạt, thơm mùi sữa.', 'img' => 'https://images.unsplash.com/photo-1596363505729-f14d87ec0968?w=600'],
            ['name' => 'Táo Fuji Nhật', 'price' => 120000, 'category' => 'Trái cây nhập khẩu', 'desc' => 'Táo Fuji to, mọng nước, giòn ngọt.', 'img' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6faa6?w=600'],
            ['name' => 'Cam vàng Navel Úc', 'price' => 90000, 'category' => 'Trái cây nhập khẩu', 'desc' => 'Cam vàng ngọt, nhiều nước, không hạt.', 'img' => 'https://images.unsplash.com/photo-1582979512210-99b6a53385f9?w=600'],
            ['name' => 'Cherry đỏ Mỹ', 'price' => 350000, 'category' => 'Trái cây nhập khẩu', 'desc' => 'Cherry cuống xanh, trái to, ngọt lịm.', 'img' => 'https://images.unsplash.com/photo-1528821128474-27f963b062bf?w=600'],
            ['name' => 'Kiwi vàng New Zealand', 'price' => 180000, 'category' => 'Trái cây nhập khẩu', 'desc' => 'Kiwi vàng ngọt, giàu vitamin C.', 'img' => 'https://images.unsplash.com/photo-1585061956557-410a6234fcbc?w=600'],

            // Tươi sống
            ['name' => 'Cá hồi Na Uy phi lê', 'price' => 550000, 'category' => 'Thực phẩm tươi sống', 'desc' => 'Cá hồi tươi nhập khẩu bằng đường hàng không, dùng ăn sashimi rất tốt.', 'img' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600'],
            ['name' => 'Thịt bò Wagyu A5', 'price' => 1200000, 'category' => 'Thực phẩm tươi sống', 'desc' => 'Thịt bò Wagyu cao cấp mềm tan trong miệng.', 'img' => 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=600'],
            ['name' => 'Tôm sú sinh thái', 'price' => 280000, 'category' => 'Thực phẩm tươi sống', 'desc' => 'Tôm sú to, chắc thịt, sinh thái tự nhiên.', 'img' => 'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=600'],
            ['name' => 'Mực lá câu', 'price' => 320000, 'category' => 'Thực phẩm tươi sống', 'desc' => 'Mực lá dày mình, giòn sần sật.', 'img' => 'https://images.unsplash.com/photo-1615141982883-c7ad0e69fd62?w=600'],
            ['name' => 'Thịt heo Iberico', 'price' => 450000, 'category' => 'Thực phẩm tươi sống', 'desc' => 'Thịt heo đen Tây Ban Nha thơm ngon đặc biệt.', 'img' => 'https://images.unsplash.com/photo-1602491453631-e2a5ad90a131?w=600'],

            // Khô & đóng gói
            ['name' => 'Gạo ST25 Ông Cua', 'price' => 180000, 'category' => 'Thực phẩm khô', 'desc' => 'Gạo ngon nhất thế giới, hạt dài, dẻo thơm.', 'img' => 'https://images.unsplash.com/photo-1586201375761-83865001e8ac?w=600'],
            ['name' => 'Hạt điều rang muối Bình Phước', 'price' => 150000, 'category' => 'Thực phẩm khô', 'desc' => 'Hạt điều to, giòn rụm, béo ngậy.', 'img' => 'https://images.unsplash.com/photo-1536643666617-df5d2e0eb009?w=600'],
            ['name' => 'Nấm hương rừng', 'price' => 120000, 'category' => 'Thực phẩm khô', 'desc' => 'Nấm hương sấy khô tự nhiên, mùi thơm nồng.', 'img' => 'https://images.unsplash.com/photo-1506509709230-07eebc5d6c5c?w=600'],
            ['name' => 'Mật ong hoa rừng nguyên chất', 'price' => 250000, 'category' => 'Thực phẩm khô', 'desc' => 'Mật ong thiên nhiên không pha đường.', 'img' => 'https://images.unsplash.com/photo-1587049352847-4d4b126a3dcb?w=600'],
            ['name' => 'Mì cay kimchi Hàn Quốc', 'price' => 150000, 'category' => 'Thực phẩm khô', 'desc' => 'Mì cay đặc sản với các cấp độ thử thách khẩu vị.', 'img' => 'https://images.unsplash.com/photo-1612929633738-8fe01f728091?w=600', 'is_spicy' => true],
        ];

        foreach ($products as $item) {
            $cat = $categories[$item['category']];
            
            $product = Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']) . '-' . rand(100, 999),
                'description' => $item['desc'],
                'base_price' => $item['price'],
                'category_id' => $cat->id,
                'sku' => strtoupper(Str::random(8)),
            ]);

            if (isset($item['is_spicy'])) {
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 1', 'price_adjustment' => 0]);
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 3', 'price_adjustment' => 10000]);
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 7', 'price_adjustment' => 25000]);
            } else {
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Mặc định', 'price_adjustment' => 0]);
            }
        }
    }
}
