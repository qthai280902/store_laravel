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
            'Rau củ hữu cơ' => Category::firstOrCreate(
                ['slug' => 'rau-cu-huu-co'],
                ['name' => 'Rau củ hữu cơ', 'description' => 'Rau củ trồng tự nhiên, không hóa chất']
            ),
            'Trái cây nhập khẩu' => Category::firstOrCreate(
                ['slug' => 'trai-cay-nhap-khau'],
                ['name' => 'Trái cây nhập khẩu', 'description' => 'Trái cây tươi ngon từ khắp thế giới']
            ),
            'Thực phẩm tươi sống' => Category::firstOrCreate(
                ['slug' => 'thuc-pham-tuoi-song'],
                ['name' => 'Thực phẩm tươi sống', 'description' => 'Thịt cá tươi sống mỗi ngày']
            ),
            'Thực phẩm khô' => Category::firstOrCreate(
                ['slug' => 'thuc-pham-kho'],
                ['name' => 'Thực phẩm khô', 'description' => 'Đồ khô & Đóng gói tiện lợi']
            ),
        ];

        $products = [
            // === Rau củ hữu cơ (5 sản phẩm) ===
            ['name' => 'Cải bó xôi Đà Lạt', 'price' => 35000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Cải bó xôi tươi xanh giàu sắt và vitamin K, thu hoạch mỗi sáng tại vùng Đà Lạt.', 'img' => 'https://picsum.photos/seed/spinach/600/400'],
            ['name' => 'Cà rốt baby hữu cơ', 'price' => 45000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Cà rốt baby ngọt tự nhiên, giòn rụm, không thuốc trừ sâu.', 'img' => 'https://picsum.photos/seed/carrot/600/400'],
            ['name' => 'Bông cải xanh hữu cơ', 'price' => 30000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Bông cải xanh to, chắc, nhiều dinh dưỡng và chất xơ.', 'img' => 'https://picsum.photos/seed/broccoli/600/400'],
            ['name' => 'Cà chua cherry Đà Lạt', 'price' => 50000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Cà chua bi giòn ngọt tự nhiên, thích hợp làm salad và ăn trực tiếp.', 'img' => 'https://picsum.photos/seed/cherry-tomato/600/400'],
            ['name' => 'Khoai tây Đà Lạt', 'price' => 25000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Khoai tây ruột vàng, bở, ngọt, thích hợp nấu canh hoặc chiên giòn.', 'img' => 'https://picsum.photos/seed/potato/600/400'],

            // === Trái cây nhập khẩu (5 sản phẩm) ===
            ['name' => 'Nho mẫu đơn Hàn Quốc', 'price' => 850000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Nho Shine Muscat ngọt lịm, giòn, không hạt, hương thơm sữa đặc trưng.', 'img' => 'https://picsum.photos/seed/muscat-grape/600/400'],
            ['name' => 'Táo Fuji Nhật Bản', 'price' => 120000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Táo Fuji to, mọng nước, giòn ngọt thanh mát.', 'img' => 'https://picsum.photos/seed/fuji-apple/600/400'],
            ['name' => 'Cam vàng Navel Úc', 'price' => 90000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Cam vàng ngọt thanh, nhiều nước, không hạt, giàu vitamin C.', 'img' => 'https://picsum.photos/seed/navel-orange/600/400'],
            ['name' => 'Cherry đỏ Mỹ', 'price' => 350000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Cherry cuống xanh, trái to căng mọng, vị ngọt đậm đà.', 'img' => 'https://picsum.photos/seed/red-cherry/600/400'],
            ['name' => 'Kiwi vàng New Zealand', 'price' => 180000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Kiwi vàng ngọt mềm, giàu vitamin C gấp đôi cam.', 'img' => 'https://picsum.photos/seed/golden-kiwi/600/400'],

            // === Thực phẩm tươi sống (5 sản phẩm) ===
            ['name' => 'Cá hồi Na Uy phi lê', 'price' => 550000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Cá hồi tươi nhập khẩu đường hàng không, thích hợp ăn sashimi.', 'img' => 'https://picsum.photos/seed/salmon-fillet/600/400'],
            ['name' => 'Thịt bò Wagyu A5 Nhật', 'price' => 1200000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Thịt bò Wagyu cao cấp vân mỡ cẩm thạch, mềm tan trong miệng.', 'img' => 'https://picsum.photos/seed/wagyu-beef/600/400'],
            ['name' => 'Tôm sú sinh thái', 'price' => 280000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Tôm sú to chắc thịt, nuôi sinh thái tự nhiên tại Cà Mau.', 'img' => 'https://picsum.photos/seed/tiger-shrimp/600/400'],
            ['name' => 'Mực lá tươi câu', 'price' => 320000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Mực lá dày mình giòn sần sật, đánh bắt tự nhiên.', 'img' => 'https://picsum.photos/seed/fresh-squid/600/400'],
            ['name' => 'Thịt heo Iberico Tây Ban Nha', 'price' => 450000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Thịt heo đen Iberico thơm ngon đặc biệt, vân mỡ đẹp.', 'img' => 'https://picsum.photos/seed/iberico-pork/600/400'],

            // === Thực phẩm khô & Đóng gói (5 sản phẩm) ===
            ['name' => 'Gạo ST25 Ông Cua 5kg', 'price' => 180000, 'cat' => 'Thực phẩm khô', 'desc' => 'Gạo ngon nhất thế giới, hạt dài dẻo thơm mùi lá dứa.', 'img' => 'https://picsum.photos/seed/st25-rice/600/400'],
            ['name' => 'Hạt điều rang muối Bình Phước', 'price' => 150000, 'cat' => 'Thực phẩm khô', 'desc' => 'Hạt điều to béo, rang muối giòn rụm, đóng hộp 500g.', 'img' => 'https://picsum.photos/seed/cashew-nut/600/400'],
            ['name' => 'Nấm hương rừng sấy khô', 'price' => 120000, 'cat' => 'Thực phẩm khô', 'desc' => 'Nấm hương sấy khô tự nhiên, mùi thơm nồng nàn.', 'img' => 'https://picsum.photos/seed/dried-mushroom/600/400'],
            ['name' => 'Mật ong hoa rừng nguyên chất', 'price' => 250000, 'cat' => 'Thực phẩm khô', 'desc' => 'Mật ong thiên nhiên 100% không pha đường, chai 500ml.', 'img' => 'https://picsum.photos/seed/raw-honey/600/400'],
            ['name' => 'Mì cay kimchi Hàn Quốc', 'price' => 150000, 'cat' => 'Thực phẩm khô', 'desc' => 'Mì cay đặc sản Hàn Quốc với các cấp độ thử thách khẩu vị, hộp 5 gói.', 'img' => 'https://picsum.photos/seed/spicy-noodle/600/400', 'is_spicy' => true],
        ];

        foreach ($products as $item) {
            $cat = $categories[$item['cat']];

            $product = Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']) . '-' . rand(100, 999),
                'description' => $item['desc'],
                'image_url' => $item['img'],
                'base_price' => $item['price'],
                'category_id' => $cat->id,
            ]);

            if (isset($item['is_spicy'])) {
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 1 - Hơi cay', 'price_adjustment' => 0]);
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 3 - Cay vừa', 'price_adjustment' => 10000]);
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Cấp độ 7 - Siêu cay', 'price_adjustment' => 25000]);
            } else {
                ProductVariant::create(['product_id' => $product->id, 'name' => 'Mặc định', 'price_adjustment' => 0]);
            }
        }
    }
}
