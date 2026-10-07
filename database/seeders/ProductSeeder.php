<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create 10 categories via firstOrCreate
        $categoryNames = [
            'Rau củ',
            'Trái cây',
            'Thịt cá',
            'Hải sản',
            'Đồ uống',
            'Sữa',
            'Gia vị',
            'Đồ ăn vặt',
            'Đồ gia dụng',
            'Chăm sóc cá nhân',
        ];

        $categories = [];
        foreach ($categoryNames as $catName) {
            $categories[$catName] = Category::firstOrCreate(
                ['slug' => Str::slug($catName)],
                [
                    'name' => $catName,
                    'description' => 'Danh mục các sản phẩm '.$catName.' chất lượng cao, an toàn và tươi ngon.',
                    'is_active' => true,
                ]
            );
        }

        // Brands & Units lists
        $brands = [
            'VietGAP', 'DaLat GAP', 'CP Fresh Mart', 'Vinamilk', 'TH True Milk',
            'Masan Consumer', 'Knorr', 'Chinsu', 'Ajinomoto', 'Nam Ngư',
            'Orion', 'Oishi', 'Kinh Đô', 'Lay\'s', 'Lavie',
            'Trung Nguyên', 'Unilever', 'P&G', 'Sunlight', 'Comfort',
            'Lifebuoy', 'Clear', 'Colgate', 'Sensodyne', 'Vissan',
            'Hạ Long Canfoco', 'Nestlé', 'Acecook', 'Simply', 'Anchor',
        ];

        $units = [
            'kg', 'túi 500g', 'hộp', 'chai', 'lon', 'gói', 'bó',
            'khay 300g', 'khay 500g', 'lốc 4 hộp', 'lốc 6 lon', 'thùng', 'bình', 'tuýp', 'cuộn',
        ];

        $origins = [
            'Đà Lạt, Lâm Đồng', 'Bến Tre, Việt Nam', 'Tiền Giang, Việt Nam',
            'Mộc Châu, Sơn La', 'Nha Trang, Khánh Hòa', 'New Zealand',
            'Nhật Bản', 'Hàn Quốc', 'Mỹ', 'Úc', 'Pháp', 'Thái Lan',
        ];

        $weights = [
            '250g', '300g', '400g', '500g', '800g', '1kg', '1.2kg', '1.5kg', '2kg', '4 x 180ml', '6 x 330ml', '1 lít',
        ];

        $catCodes = [
            'Rau củ' => 'VEG',
            'Trái cây' => 'FRU',
            'Thịt cá' => 'MEA',
            'Hải sản' => 'SEA',
            'Đồ uống' => 'DRK',
            'Sữa' => 'MIL',
            'Gia vị' => 'SPC',
            'Đồ ăn vặt' => 'SNK',
            'Đồ gia dụng' => 'HSE',
            'Chăm sóc cá nhân' => 'PER',
        ];

        // 2. Curated ~27 authentic flagship products across all 10 categories
        $catalog = [
            'Rau củ' => [
                ['sku' => 'MM-VEG-0001', 'name' => 'Cải bó xôi Đà Lạt hữu cơ', 'brand' => 'VietGAP', 'unit' => 'túi 500g', 'weight' => '500g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 35000, 'is_featured' => true],
                ['sku' => 'MM-VEG-0005', 'name' => 'Cà chua bi cherry ngọt', 'brand' => 'DaLat GAP', 'unit' => 'khay 300g', 'weight' => '300g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 42000, 'is_featured' => true],
                ['sku' => 'MM-VEG-0006', 'name' => 'Xà lách Lolo xanh thủy canh', 'brand' => 'VietGAP', 'unit' => 'túi 500g', 'weight' => '500g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 28000, 'is_featured' => false],
                ['sku' => 'MM-VEG-0010', 'name' => 'Nấm đùi gà tươi loại 1', 'brand' => 'VietGAP', 'unit' => 'gói', 'weight' => '250g', 'origin' => 'Lâm Đồng, Việt Nam', 'base_price' => 38000, 'is_featured' => false],
            ],
            'Trái cây' => [
                ['sku' => 'MM-FRU-0021', 'name' => 'Táo Envy New Zealand size lớn', 'brand' => 'Envy', 'unit' => 'kg', 'weight' => '1kg', 'origin' => 'New Zealand', 'base_price' => 185000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0023', 'name' => 'Nho mẫu đơn Shine Muscat Hàn Quốc', 'brand' => 'Shine Muscat', 'unit' => 'hộp', 'weight' => '500g', 'origin' => 'Hàn Quốc', 'base_price' => 450000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0027', 'name' => 'Dâu tây giống Nhật Bản Đà Lạt', 'brand' => 'DaLat GAP', 'unit' => 'hộp', 'weight' => '300g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 125000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0029', 'name' => 'Bưởi da xanh Bến Tre ruột hồng', 'brand' => 'VietGAP', 'unit' => 'trái', 'weight' => '1.5kg', 'origin' => 'Bến Tre, Việt Nam', 'base_price' => 95000, 'is_featured' => false],
            ],
            'Thịt cá' => [
                ['sku' => 'MM-MEA-0041', 'name' => 'Thịt bò Úc cao cấp', 'brand' => 'Midfield Meat', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Úc', 'base_price' => 280000, 'is_featured' => true],
                ['sku' => 'MM-MEA-0045', 'name' => 'Ba chỉ bò Mỹ cắt lát cuộn nướng', 'brand' => 'Excel', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Mỹ', 'base_price' => 195000, 'is_featured' => false],
                ['sku' => 'MM-MEA-0049', 'name' => 'Đùi gà góc tư tươi CP', 'brand' => 'CP Fresh Mart', 'unit' => 'kg', 'weight' => '1kg', 'origin' => 'Đồng Nai, Việt Nam', 'base_price' => 75000, 'is_featured' => false],
                ['sku' => 'MM-MEA-0053', 'name' => 'Cá hồi Na Uy phi lê tươi nhập khẩu', 'brand' => 'Lerøy', 'unit' => 'khay 300g', 'weight' => '300g', 'origin' => 'Na Uy', 'base_price' => 265000, 'is_featured' => true],
                ['sku' => 'MM-MEA-0057', 'name' => 'Cá điêu hồng phi lê tươi', 'brand' => 'Vissan', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Tiền Giang, Việt Nam', 'base_price' => 88000, 'is_featured' => false],
            ],
            'Hải sản' => [
                ['sku' => 'MM-SEA-0061', 'name' => 'Tôm sú tươi sinh thái Cà Mau', 'brand' => 'Cà Mau Eco', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Cà Mau, Việt Nam', 'base_price' => 245000, 'is_featured' => true],
            ],
            'Đồ uống' => [
                ['sku' => 'MM-DRK-0081', 'name' => 'Nước ép cam tươi nguyên chất Teppy', 'brand' => 'Teppy', 'unit' => 'chai', 'weight' => '1 lít', 'origin' => 'Việt Nam', 'base_price' => 32000, 'is_featured' => false],
                ['sku' => 'MM-DRK-0084', 'name' => 'Cà phê rang xay nguyên chất Trung Nguyên', 'brand' => 'Trung Nguyên', 'unit' => 'gói', 'weight' => '500g', 'origin' => 'Đắk Lắk, Việt Nam', 'base_price' => 115000, 'is_featured' => true],
            ],
            'Sữa' => [
                ['sku' => 'MM-MIL-0101', 'name' => 'Sữa tươi tiệt trùng TH True Milk ít đường', 'brand' => 'TH True Milk', 'unit' => 'lốc 4 hộp', 'weight' => '4 x 180ml', 'origin' => 'Nghệ An, Việt Nam', 'base_price' => 38000, 'is_featured' => true],
                ['sku' => 'MM-MIL-0107', 'name' => 'Sữa chua Hy Lạp lên men tự nhiên Farmers Union', 'brand' => 'Farmers Union', 'unit' => 'hũ', 'weight' => '500g', 'origin' => 'Úc', 'base_price' => 145000, 'is_featured' => false],
                ['sku' => 'MM-MIL-0114', 'name' => 'Phô mai Mozzarella sợi bào nướng bánh pizza', 'brand' => 'Anchor', 'unit' => 'gói', 'weight' => '200g', 'origin' => 'New Zealand', 'base_price' => 89000, 'is_featured' => false],
            ],
            'Gia vị' => [
                ['sku' => 'MM-SPC-0121', 'name' => 'Nước mắm truyền thống Khải Hoàn 40 độ đạm', 'brand' => 'Khải Hoàn', 'unit' => 'chai', 'weight' => '520ml', 'origin' => 'Phú Quốc, Kiên Giang', 'base_price' => 165000, 'is_featured' => true],
                ['sku' => 'MM-SPC-0122', 'name' => 'Hạt nêm thịt thăn xương ống Knorr gói 900g', 'brand' => 'Knorr', 'unit' => 'gói', 'weight' => '900g', 'origin' => 'Việt Nam', 'base_price' => 82000, 'is_featured' => false],
                ['sku' => 'MM-SPC-0123', 'name' => 'Dầu thực vật tinh luyện Simply đậu nành can 2L', 'brand' => 'Simply', 'unit' => 'can', 'weight' => '2 lít', 'origin' => 'Việt Nam', 'base_price' => 135000, 'is_featured' => false],
            ],
            'Đồ ăn vặt' => [
                ['sku' => 'MM-SNK-0143', 'name' => 'Bánh ChocoPie tình bạn hộp 12 cái Orion', 'brand' => 'Orion', 'unit' => 'hộp', 'weight' => '396g', 'origin' => 'Hàn Quốc / Việt Nam', 'base_price' => 58000, 'is_featured' => true],
                ['sku' => 'MM-SNK-0152', 'name' => 'Hạt điều rang muối vỏ lụa Bình Phước', 'brand' => 'Bình Phước Farm', 'unit' => 'hũ', 'weight' => '500g', 'origin' => 'Bình Phước, Việt Nam', 'base_price' => 175000, 'is_featured' => false],
            ],
            'Đồ gia dụng' => [
                ['sku' => 'MM-HSE-0161', 'name' => 'Nước rửa chén Sunlight tinh dầu bưởi tây', 'brand' => 'Sunlight', 'unit' => 'chai', 'weight' => '750g', 'origin' => 'Việt Nam', 'base_price' => 36000, 'is_featured' => false],
                ['sku' => 'MM-HSE-0177', 'name' => 'Nước xịt lau kính sạch bóng diệt khuẩn Gift', 'brand' => 'Gift', 'unit' => 'chai', 'weight' => '580ml', 'origin' => 'Việt Nam', 'base_price' => 29000, 'is_featured' => true],
            ],
            'Chăm sóc cá nhân' => [
                ['sku' => 'MM-PER-0184', 'name' => 'Sữa tắm bảo vệ kháng khuẩn Lifebuoy chăm sóc da', 'brand' => 'Lifebuoy', 'unit' => 'chai', 'weight' => '850g', 'origin' => 'Việt Nam', 'base_price' => 179000, 'is_featured' => true],
            ],
        ];

        // 3. Loop and insert the curated products
        foreach ($catalog as $catName => $productsList) {
            $cat = $categories[$catName];

            foreach ($productsList as $item) {
                $basePrice = $item['base_price'];

                // 65% chance of higher original price
                $hasDiscount = rand(1, 100) <= 65;
                $originalPrice = $hasDiscount
                    ? round($basePrice * (1 + (rand(12, 35) / 100)) / 1000) * 1000
                    : null;

                $stock = rand(15, 85);
                $sku = $item['sku'];
                $slug = Str::slug($item['name']).'-'.rand(1000, 9999);

                // Local storage paths for 5 authentic angles
                $localImages = [
                    "storage/products/{$sku}/1.jpg",
                    "storage/products/{$sku}/2.jpg",
                    "storage/products/{$sku}/3.jpg",
                    "storage/products/{$sku}/4.jpg",
                    "storage/products/{$sku}/5.jpg",
                ];

                // Create Product
                $product = Product::create([
                    'category_id' => $cat->id,
                    'name' => $item['name'],
                    'slug' => $slug,
                    'sku' => $sku,
                    'description' => 'Sản phẩm '.$item['name'].' chính hãng, nguồn gốc rõ ràng và an toàn cho người tiêu dùng. Đạt tiêu chuẩn kiểm nghiệm nghiêm ngặt về chất lượng và hạn sử dụng tươi mới.',
                    'image_url' => $localImages[0],
                    'images' => $localImages,
                    'brand' => $item['brand'],
                    'origin' => $item['origin'],
                    'unit' => $item['unit'],
                    'weight' => $item['weight'],
                    'original_price' => $originalPrice,
                    'base_price' => $basePrice,
                    'stock' => $stock,
                    'is_active' => true,
                    'is_featured' => $item['is_featured'],
                ]);

                // Create default ProductVariant
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $sku.'-VAR',
                    'name' => 'Mặc định',
                    'price' => $basePrice,
                    'stock_quantity' => $stock,
                    'is_active' => true,
                ]);
            }
        }

        // Tự động kiểm tra và đồng bộ hóa thư viện file ảnh vào storage cục bộ
        Artisan::call('products:generate-images');
    }

    /**
     * Resolve exactly 5 realistic photo angles corresponding directly to the product name & category.
     * Order of 5 photos:
     * 0: Front Packaging / Whole
     * 1: Nutrition / Back Label / Package Spec
     * 2: 45 Degree Angle View
     * 3: Macro Texture / Fresh Detail
     * 4: Lifestyle / In-use / Serving
     */
    public static function resolveImagesForProduct(string $name, string $catName): array
    {
        $lower = mb_strtolower($name, 'UTF-8');

        // 1. Thủy hải sản: Cá các loại
        if (str_contains($lower, 'cá ') || str_contains($lower, 'hồi') || str_contains($lower, 'basa') || str_contains($lower, 'điêu hồng') || str_contains($lower, 'thu') || str_contains($lower, 'bớp') || str_contains($lower, 'trắm') || str_contains($lower, 'chép')) {
            return [
                'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&h=800&fit=crop', // Cá tươi nguyên con trên khay đá
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop', // Nhãn tem kiểm định khay cá
                'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=800&fit=crop', // Góc nghiêng phi lê cá 45°
                'https://images.unsplash.com/photo-1535400255456-984241443b29?w=800&h=800&fit=crop', // Cận cảnh thớ thịt cá tươi hồng
                'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800&h=800&fit=crop', // Món cá áp chảo / hấp ngon lành
            ];
        }

        // 2. Tôm các loại
        if (str_contains($lower, 'tôm')) {
            return [
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Tôm tươi sống chính diện
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop', // Nhãn hộp tôm xuất khẩu
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop', // Góc nghiêng đĩa tôm tươi 45°
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop', // Cận cảnh vỏ tôm bóng bẩy
                'https://images.unsplash.com/photo-1551248429-40975aa4de74?w=800&h=800&fit=crop', // Tôm hấp sả ớt / nướng bàn ăn
            ];
        }

        // 3. Cua, ghẹ
        if (str_contains($lower, 'cua') || str_contains($lower, 'càng cua')) {
            return [
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop', // Cua biển chính diện
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop', // Bao bì đóng gói dây buộc
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Góc nghiêng càng cua 45°
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop', // Cận cảnh mai cua và gạch
                'https://images.unsplash.com/photo-1551248429-40975aa4de74?w=800&h=800&fit=crop', // Cua hấp bia / rang me
            ];
        }

        // 4. Mực, bạch tuộc
        if (str_contains($lower, 'mực') || str_contains($lower, 'bạch tuộc')) {
            return [
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Mực ống tươi chính diện
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop', // Khay đông lạnh nhãn tem
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Góc nghiêng mực 45°
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Cận cảnh da mực mi nơ óng ánh
                'https://images.unsplash.com/photo-1551248429-40975aa4de74?w=800&h=800&fit=crop', // Mực xào cần tỏi / nướng sa tế
            ];
        }

        // 5. Hàu, sò, ốc, nghêu, bào ngư
        if (str_contains($lower, 'hàu') || str_contains($lower, 'sò') || str_contains($lower, 'ốc') || str_contains($lower, 'ngao') || str_contains($lower, 'bào ngư')) {
            return [
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop', // Hàu sữa nửa mảnh chính diện
                'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&h=800&fit=crop', // Nhãn kiểm dịch hải sản tươi
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop', // Góc nghiêng 45° trên đĩa đá
                'https://images.unsplash.com/photo-1535400255456-984241443b29?w=800&h=800&fit=crop', // Cận cảnh thịt hàu béo ngậy
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop', // Hàu nướng mỡ hành phô mai
            ];
        }

        // 6. Thịt bò
        if (str_contains($lower, 'bò') || str_contains($lower, 'wagyu')) {
            return [
                'https://images.unsplash.com/photo-1603048588665-791ca8aea617?w=800&h=800&fit=crop', // Khay thịt bò tươi mát chính diện
                'https://images.unsplash.com/photo-1588347818036-558601350947?w=800&h=800&fit=crop', // Mặt sau nhãn nguồn gốc xuất xứ
                'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&h=800&fit=crop', // Ba chỉ bò cuộn góc 45°
                'https://images.unsplash.com/photo-1558030006-450675393462?w=800&h=800&fit=crop', // Cận cảnh vân mỡ cẩm thạch bò
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&h=800&fit=crop', // Bít tết nướng thơm lừng bàn ăn
            ];
        }

        // 7. Thịt heo
        if (str_contains($lower, 'heo') || str_contains($lower, 'sườn') || str_contains($lower, 'ba rọi')) {
            return [
                'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=800&h=800&fit=crop', // Thịt ba rọi heo chính diện
                'https://images.unsplash.com/photo-1602498456745-e9503b30470b?w=800&h=800&fit=crop', // Khay tem nhãn an toàn VietGAP
                'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&h=800&fit=crop', // Sườn non cắt miếng góc 45°
                'https://images.unsplash.com/photo-1558030006-450675393462?w=800&h=800&fit=crop', // Cận cảnh thớ thịt heo tươi hồng
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop', // Món thịt kho tàu / nướng mật ong
            ];
        }

        // 8. Thịt gia cầm: Gà, vịt, cút, ngỗng
        if (str_contains($lower, 'gà') || str_contains($lower, 'vịt') || str_contains($lower, 'cút') || str_contains($lower, 'ngỗng')) {
            return [
                'https://images.unsplash.com/photo-1587593810167-a84920ea0781?w=800&h=800&fit=crop', // Gà ta thả vườn nguyên con
                'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=800&h=800&fit=crop', // Khay đùi gà hút chân không
                'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=800&h=800&fit=crop', // Cánh gà tươi góc 45°
                'https://images.unsplash.com/photo-1567620832903-9fc6debc209f?w=800&h=800&fit=crop', // Cận cảnh da gà vàng óng
                'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=800&h=800&fit=crop', // Gà nướng lu thơm ngon
            ];
        }

        // 9. Nước lau kính (Glass Cleaner - TUYỆT ĐỐI KHÔNG GĂNG TAY)
        if (str_contains($lower, 'lau kính') || str_contains($lower, 'xịt kính')) {
            return [
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Chai xịt lau kính chính diện
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&h=800&fit=crop', // Mặt sau hướng dẫn sử dụng
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Góc nghiêng chai xịt 45°
                'https://images.unsplash.com/photo-1585670149967-b4f4da88cc9f?w=800&h=800&fit=crop', // Vòi phun tia sương cận cảnh
                'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=800&fit=crop', // Lau cửa sổ kính sáng bóng
            ];
        }

        // 10. Nước rửa chén
        if (str_contains($lower, 'rửa chén')) {
            return [
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Chai nước rửa chén chính diện
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&h=800&fit=crop', // Tem nhãn phụ & thành phần
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Góc nghiêng chai 45°
                'https://images.unsplash.com/photo-1585670149967-b4f4da88cc9f?w=800&h=800&fit=crop', // Bọt xà phòng đậm đặc
                'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=800&fit=crop', // Bát đĩa sáng bóng sạch dầu mỡ
            ];
        }

        // 11. Nước lau sàn, tẩy rửa, tẩy bồn cầu
        if (str_contains($lower, 'lau sàn') || str_contains($lower, 'tẩy bồn cầu') || str_contains($lower, 'bột tẩy')) {
            return [
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Bình nước lau sàn đậm đặc
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&h=800&fit=crop', // Nhãn cảnh báo an toàn & công dụng
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Góc nghiêng bình tẩy 45°
                'https://images.unsplash.com/photo-1585670149967-b4f4da88cc9f?w=800&h=800&fit=crop', // Nắp đo dung tích tinh chất
                'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=800&fit=crop', // Sàn nhà sạch bóng ngát hương hoa
            ];
        }

        // 12. Nước giặt, nước xả vải
        if (str_contains($lower, 'nước giặt') || str_contains($lower, 'xả vải')) {
            return [
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Can nước giặt chuyên dụng
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&h=800&fit=crop', // Hướng dẫn giặt máy & giặt tay
                'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=800&h=800&fit=crop', // Góc nghiêng nắp đong 45°
                'https://images.unsplash.com/photo-1585670149967-b4f4da88cc9f?w=800&h=800&fit=crop', // Kết cấu dung dịch sánh mịn
                'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=800&h=800&fit=crop', // Quần áo gấp phẳng thơm ngát
            ];
        }

        // 13. Khăn giấy, giấy vệ sinh, màng bọc thực phẩm
        if (str_contains($lower, 'khăn giấy') || str_contains($lower, 'giấy vệ sinh') || str_contains($lower, 'màng bọc') || str_contains($lower, 'giấy bạc') || str_contains($lower, 'túi rác')) {
            return [
                'https://images.unsplash.com/photo-1584556812952-905ffd0c611a?w=800&h=800&fit=crop', // Bao bì lốc giấy cuộn
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&h=800&fit=crop', // Thông số định lượng & số lớp
                'https://images.unsplash.com/photo-1584556812952-905ffd0c611a?w=800&h=800&fit=crop', // Góc nghiêng hộp rút giấy 45°
                'https://images.unsplash.com/photo-1584556812952-905ffd0c611a?w=800&h=800&fit=crop', // Bề mặt giấy dập nổi mềm mịn
                'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=800&fit=crop', // Bàn bếp sạch sẽ ngăn nắp
            ];
        }

        // 14. Dầu gội, dầu xả
        if (str_contains($lower, 'dầu gội') || str_contains($lower, 'dầu xả')) {
            return [
                'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=800&h=800&fit=crop', // Chai dầu gội chính diện
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Mặt sau nhãn kiểm nghiệm da liễu
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Góc nghiêng chai vòi pump 45°
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=800&fit=crop', // Bọt dầu gội sánh mịn dịu nhẹ
                'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800&h=800&fit=crop', // Mái tóc óng ả khỏe mạnh
            ];
        }

        // 15. Sữa tắm, xà bông
        if (str_contains($lower, 'sữa tắm') || str_contains($lower, 'xà bông')) {
            return [
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Chai sữa tắm dưỡng ẩm chính diện
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Mặt sau nhãn thành phần thiên nhiên
                'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=800&h=800&fit=crop', // Góc nghiêng bánh xà phòng 45°
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=800&fit=crop', // Cận cảnh bọt sữa tắm thơm ngát
                'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800&h=800&fit=crop', // Làn da mềm mại mịn màng
            ];
        }

        // 16. Chăm sóc răng miệng
        if (str_contains($lower, 'kem đánh răng') || str_contains($lower, 'bàn chải') || str_contains($lower, 'súc miệng')) {
            return [
                'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=800&fit=crop', // Tuýp kem đánh răng chính diện
                'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=800&fit=crop', // Mặt sau nhãn chứng nhận nha khoa
                'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=800&h=800&fit=crop', // Góc nghiêng bàn chải & kem 45°
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Cận cảnh lông tơ siêu mềm
                'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&h=800&fit=crop', // Nụ cười trắng sáng rạng rỡ
            ];
        }

        // 17. Sữa các loại
        if ($catName === 'Sữa' || str_contains($lower, 'sữa ')) {
            return [
                'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=800&h=800&fit=crop', // Hộp sữa tươi chính diện
                'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=800&h=800&fit=crop', // Bảng giá trị dinh dưỡng đạm & canxi
                'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=800&h=800&fit=crop', // Lốc sữa góc nghiêng 45°
                'https://images.unsplash.com/photo-1628088062854-d1870b4553da?w=800&h=800&fit=crop', // Dòng sữa tươi sánh mịn rót ly
                'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=800&h=800&fit=crop', // Ly sữa bữa sáng lành mạnh
            ];
        }

        // 18. Đồ uống: Cà phê, trà, nước ép, bia
        if ($catName === 'Đồ uống') {
            return [
                'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=800&fit=crop', // Chai / lon đồ uống chính diện
                'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800&h=800&fit=crop', // Bảng dinh dưỡng & dung tích
                'https://images.unsplash.com/photo-1527661591475-527312dd65f5?w=800&h=800&fit=crop', // Góc nghiêng đồ uống 45°
                'https://images.unsplash.com/photo-1556881286-fc6915169721?w=800&h=800&fit=crop', // Giọt nước ngưng tụ mát lạnh
                'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&h=800&fit=crop', // Bàn tiệc đồ uống giải khát
            ];
        }

        // 19. Gia vị thực phẩm
        if ($catName === 'Gia vị') {
            return [
                'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&h=800&fit=crop', // Chai / hũ gia vị chính diện
                'https://images.unsplash.com/photo-1509358271058-acd22cc93898?w=800&h=800&fit=crop', // Thành phần & độ đạm nhãn sau
                'https://images.unsplash.com/photo-1532336414038-cf19250c5757?w=800&h=800&fit=crop', // Chai gia vị đặt nghiêng 45°
                'https://images.unsplash.com/photo-1599940824399-b87987ceb72a?w=800&h=800&fit=crop', // Cận cảnh hạt tiêu / muối tinh khiết
                'https://images.unsplash.com/photo-1514733670139-4d87a1941d55?w=800&h=800&fit=crop', // Đầu bếp nêm nếm món ăn
            ];
        }

        // 20. Đồ ăn vặt, bánh kẹo
        if ($catName === 'Đồ ăn vặt') {
            return [
                'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=800&h=800&fit=crop', // Gói snack / hộp bánh chính diện
                'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=800&h=800&fit=crop', // Bảng calorie & hạn sử dụng
                'https://images.unsplash.com/photo-1582293041079-7814c2f12063?w=800&h=800&fit=crop', // Góc nghiêng đĩa bánh giòn 45°
                'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=800&h=800&fit=crop', // Cận cảnh vụn bánh giòn rụm
                'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=800&h=800&fit=crop', // Bữa tiệc trà chiều thư giãn
            ];
        }

        // 21. Trái cây tươi
        if ($catName === 'Trái cây') {
            return [
                'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=800&h=800&fit=crop', // Trái cây mọng nước chính diện
                'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=800&h=800&fit=crop', // Hộp đóng gói tem xuất xứ
                'https://images.unsplash.com/photo-1553279768-865429fa0078?w=800&h=800&fit=crop', // Trái cây cắt lát góc 45°
                'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=800&fit=crop', // Cận cảnh tép quả căng mọng
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop', // Đĩa trái cây tráng miệng gia đình
            ];
        }

        // 22. Mặc định: Rau củ quả sạch
        return [
            'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&h=800&fit=crop', // Bó rau xanh tươi chính diện
            'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=800&h=800&fit=crop', // Tem kiểm nghiệm an toàn thực phẩm
            'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=800&h=800&fit=crop', // Góc nghiêng rổ rau củ 45°
            'https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=800&h=800&fit=crop', // Cận cảnh giọt sương trên lá non
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=800&fit=crop', // Món salad thanh mát đầy đủ chất
        ];
    }
}
