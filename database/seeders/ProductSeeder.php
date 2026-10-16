<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo 7 Danh mục Nông sản Sạch & Thực phẩm Hữu cơ chuẩn MiniMart Fresh
        $categoryConfigs = [
            'Rau củ hữu cơ & Đà Lạt' => [
                'slug' => 'rau-cu-huu-co-da-lat',
                'description' => 'Rau củ hữu cơ tươi ngon trồng theo chuẩn VietGAP, GlobalGAP trực tiếp từ Đà Lạt.',
            ],
            'Trái cây đặc sản & Nhập khẩu' => [
                'slug' => 'trai-cay-dac-san-nhap-khau',
                'description' => 'Trái cây đặc sản 3 miền và trái cây nhập khẩu tươi mới, vị ngọt tự nhiên chuẩn mùa.',
            ],
            'Thịt sạch & Trứng tươi' => [
                'slug' => 'thit-sach-trung-tuoi',
                'description' => 'Thịt bò, thịt heo, thịt gà kiểm dịch nghiêm ngặt và trứng tươi an toàn sinh học.',
            ],
            'Thủy hải sản tươi sống & Đóng khay' => [
                'slug' => 'thuy-hai-san-tuoi-song',
                'description' => 'Tôm, cá, hải sản tươi sống đánh bắt trong ngày, bảo quản tiêu chuẩn cấp đông sâu.',
            ],
            'Gạo, Ngũ cốc & Lương thực sạch' => [
                'slug' => 'gao-ngu-coc-luong-thuc',
                'description' => 'Gạo đặc sản ST25, yến mạch nguyên cám, đậu hạt thuần chủng tốt cho sức khỏe.',
            ],
            'Gia vị truyền thống & Tự nhiên' => [
                'slug' => 'gia-vi-truyen-thong-tu-nhien',
                'description' => 'Nước mắm truyền thống Phú Quốc, tiêu chín, muối khoáng và mật ong rừng nguyên chất.',
            ],
            'Món sơ chế sẵn (Ready-to-cook)' => [
                'slug' => 'mon-so-che-san-ready-to-cook',
                'description' => 'Khay nguyên liệu sơ chế sạch, kèm gói gia vị hoàn chỉnh tiện lợi cho bữa cơm gia đình.',
            ],
        ];

        $categories = [];
        foreach ($categoryConfigs as $catName => $config) {
            $categories[$catName] = Category::updateOrCreate(
                ['slug' => $config['slug']],
                [
                    'name' => $catName,
                    'description' => $config['description'],
                    'is_active' => true,
                ]
            );
        }

        // Xóa các thư mục sản phẩm phi thực phẩm cũ trong storage nếu tồn tại
        $legacyNonFoodDirs = ['MM-HSE-0161', 'MM-HSE-0177', 'MM-PER-0184'];
        foreach ($legacyNonFoodDirs as $legacyDir) {
            $dirPath = storage_path('app/public/products/'.$legacyDir);
            if (File::isDirectory($dirPath)) {
                File::deleteDirectory($dirPath);
            }
        }

        // 2. Catalog 24 sản phẩm nông sản & thực phẩm sạch tinh hoa (~3-4 sản phẩm/danh mục)
        $catalog = [
            'Rau củ hữu cơ & Đà Lạt' => [
                ['sku' => 'MM-VEG-0001', 'name' => 'Cải bó xôi Đà Lạt hữu cơ', 'brand' => 'VietGAP', 'unit' => 'túi 500g', 'weight' => '500g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 35000, 'is_featured' => true],
                ['sku' => 'MM-VEG-0005', 'name' => 'Cà chua bi cherry ngọt', 'brand' => 'DaLat GAP', 'unit' => 'khay 300g', 'weight' => '300g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 42000, 'is_featured' => true],
                ['sku' => 'MM-VEG-0006', 'name' => 'Xà lách Lolo xanh thủy canh', 'brand' => 'VietGAP', 'unit' => 'túi 500g', 'weight' => '500g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 28000, 'is_featured' => false],
                ['sku' => 'MM-VEG-0010', 'name' => 'Nấm đùi gà tươi loại 1', 'brand' => 'VietGAP', 'unit' => 'gói', 'weight' => '250g', 'origin' => 'Lâm Đồng, Việt Nam', 'base_price' => 38000, 'is_featured' => false],
            ],
            'Trái cây đặc sản & Nhập khẩu' => [
                ['sku' => 'MM-FRU-0021', 'name' => 'Táo Envy New Zealand size lớn', 'brand' => 'Envy', 'unit' => 'kg', 'weight' => '1kg', 'origin' => 'New Zealand', 'base_price' => 185000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0023', 'name' => 'Nho mẫu đơn Shine Muscat Hàn Quốc', 'brand' => 'Shine Muscat', 'unit' => 'hộp', 'weight' => '500g', 'origin' => 'Hàn Quốc', 'base_price' => 450000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0027', 'name' => 'Dâu tây giống Nhật Bản Đà Lạt', 'brand' => 'DaLat GAP', 'unit' => 'hộp', 'weight' => '300g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 125000, 'is_featured' => true],
                ['sku' => 'MM-FRU-0029', 'name' => 'Bưởi da xanh Bến Tre ruột hồng', 'brand' => 'VietGAP', 'unit' => 'trái', 'weight' => '1.5kg', 'origin' => 'Bến Tre, Việt Nam', 'base_price' => 95000, 'is_featured' => false],
            ],
            'Thịt sạch & Trứng tươi' => [
                ['sku' => 'MM-MEA-0041', 'name' => 'Thịt bò Úc cao cấp', 'brand' => 'Midfield Meat', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Úc', 'base_price' => 280000, 'is_featured' => true],
                ['sku' => 'MM-MEA-0045', 'name' => 'Ba chỉ bò Mỹ cắt lát cuộn nướng', 'brand' => 'Excel', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Mỹ', 'base_price' => 195000, 'is_featured' => false],
                ['sku' => 'MM-MEA-0049', 'name' => 'Đùi gà góc tư tươi CP', 'brand' => 'CP Fresh Mart', 'unit' => 'kg', 'weight' => '1kg', 'origin' => 'Đồng Nai, Việt Nam', 'base_price' => 75000, 'is_featured' => false],
                ['sku' => 'MM-MEA-0051', 'name' => 'Trứng gà Organic DABACO vỏ nâu', 'brand' => 'DABACO', 'unit' => 'hộp 10 quả', 'weight' => '10 quả', 'origin' => 'Bắc Ninh, Việt Nam', 'base_price' => 45000, 'is_featured' => true],
            ],
            'Thủy hải sản tươi sống & Đóng khay' => [
                ['sku' => 'MM-SEA-0061', 'name' => 'Tôm sú tươi sinh thái Cà Mau', 'brand' => 'Cà Mau Eco', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Cà Mau, Việt Nam', 'base_price' => 245000, 'is_featured' => true],
                ['sku' => 'MM-SEA-0053', 'name' => 'Cá hồi Na Uy phi lê tươi nhập khẩu', 'brand' => 'Lerøy', 'unit' => 'khay 300g', 'weight' => '300g', 'origin' => 'Na Uy', 'base_price' => 265000, 'is_featured' => true],
                ['sku' => 'MM-SEA-0057', 'name' => 'Cá điêu hồng phi lê tươi', 'brand' => 'Vissan', 'unit' => 'khay 500g', 'weight' => '500g', 'origin' => 'Tiền Giang, Việt Nam', 'base_price' => 88000, 'is_featured' => false],
            ],
            'Gạo, Ngũ cốc & Lương thực sạch' => [
                ['sku' => 'MM-CER-0071', 'name' => 'Gạo ST25 Ông Cua lúa tôm chính hãng', 'brand' => 'DNTN Hồ Quang Trí', 'unit' => 'túi 5kg', 'weight' => '5kg', 'origin' => 'Sóc Trăng, Việt Nam', 'base_price' => 190000, 'is_featured' => true],
                ['sku' => 'MM-CER-0073', 'name' => 'Yến mạch Úc nguyên cám Organic', 'brand' => "Bob's Red Mill", 'unit' => 'gói 500g', 'weight' => '500g', 'origin' => 'Úc', 'base_price' => 85000, 'is_featured' => false],
                ['sku' => 'MM-CER-0075', 'name' => 'Đậu xanh bóc vỏ Đắk Lắk thuần chủng', 'brand' => 'VietGAP', 'unit' => 'túi 500g', 'weight' => '500g', 'origin' => 'Đắk Lắk, Việt Nam', 'base_price' => 42000, 'is_featured' => false],
            ],
            'Gia vị truyền thống & Tự nhiên' => [
                ['sku' => 'MM-SPC-0121', 'name' => 'Nước mắm truyền thống Khải Hoàn 40 độ đạm', 'brand' => 'Khải Hoàn', 'unit' => 'chai', 'weight' => '520ml', 'origin' => 'Phú Quốc, Kiên Giang', 'base_price' => 165000, 'is_featured' => true],
                ['sku' => 'MM-SPC-0124', 'name' => 'Tiêu đen chín Phú Quốc xay sọ nguyên chất', 'brand' => 'Dung Hà', 'unit' => 'hũ', 'weight' => '200g', 'origin' => 'Phú Quốc, Kiên Giang', 'base_price' => 75000, 'is_featured' => false],
                ['sku' => 'MM-SPC-0126', 'name' => 'Mật ong hoa nhãn Hưng Yên nguyên chất', 'brand' => 'Hưng Yên Honey', 'unit' => 'chai', 'weight' => '500ml', 'origin' => 'Hưng Yên, Việt Nam', 'base_price' => 145000, 'is_featured' => true],
            ],
            'Món sơ chế sẵn (Ready-to-cook)' => [
                ['sku' => 'MM-RTC-0141', 'name' => 'Khay lẩu gà lá é sơ chế sẵn chuẩn Đà Lạt', 'brand' => 'MiniMart Kitchen', 'unit' => 'khay 1.2kg', 'weight' => '1.2kg', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 189000, 'is_featured' => true],
                ['sku' => 'MM-RTC-0143', 'name' => 'Set canh chua cá điêu hồng rau muống bạc hà', 'brand' => 'MiniMart Kitchen', 'unit' => 'khay 800g', 'weight' => '800g', 'origin' => 'Tiền Giang, Việt Nam', 'base_price' => 95000, 'is_featured' => false],
                ['sku' => 'MM-RTC-0145', 'name' => 'Khay bò lúc lắc kèm ớt chuông Đà Lạt sơ chế', 'brand' => 'MiniMart Kitchen', 'unit' => 'khay 600g', 'weight' => '600g', 'origin' => 'Đà Lạt, Lâm Đồng', 'base_price' => 165000, 'is_featured' => true],
            ],
        ];

        // 3. Khởi tạo sản phẩm và biến thể
        foreach ($catalog as $catName => $productsList) {
            $cat = $categories[$catName];

            foreach ($productsList as $item) {
                $basePrice = $item['base_price'];

                // 65% xác suất có giá gốc khuyến mãi
                $hasDiscount = rand(1, 100) <= 65;
                $originalPrice = $hasDiscount
                    ? round($basePrice * (1 + (rand(12, 30) / 100)) / 1000) * 1000
                    : null;

                $stock = rand(20, 95);
                $sku = $item['sku'];
                $slug = Str::slug($item['name']).'-'.rand(1000, 9999);

                // Đường dẫn 5 góc ảnh cục bộ
                $localImages = [
                    "storage/products/{$sku}/1.jpg",
                    "storage/products/{$sku}/2.jpg",
                    "storage/products/{$sku}/3.jpg",
                    "storage/products/{$sku}/4.jpg",
                    "storage/products/{$sku}/5.jpg",
                ];

                $product = Product::create([
                    'category_id' => $cat->id,
                    'name' => $item['name'],
                    'slug' => $slug,
                    'sku' => $sku,
                    'description' => 'Sản phẩm '.$item['name'].' chọn lọc từ nguồn nông sản uy tín, tươi mới mỗi ngày. Đạt tiêu chuẩn kiểm nghiệm an toàn thực phẩm, giữ trọn hương vị tươi nguyên bản và giá trị dinh dưỡng.',
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

                // Biến thể mặc định
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

        // Xóa sạch cache ảnh cũ của nhóm RTC và CER để ghi đè ảnh ẩm thực thực tế mới
        $skusToRefresh = ['MM-RTC-0141', 'MM-RTC-0143', 'MM-RTC-0145', 'MM-CER-0071', 'MM-CER-0073', 'MM-CER-0075'];
        foreach ($skusToRefresh as $refreshSku) {
            $dir = storage_path('app/public/products/'.$refreshSku);
            if (File::exists($dir)) {
                File::deleteDirectory($dir);
            }
        }

        // Tự động kiểm tra và đảm bảo 100% file ảnh tồn tại trên đĩa storage cục bộ
        Artisan::call('products:generate-images');
    }

    /**
     * Cung cấp 5 ảnh Unsplash chuẩn nông sản & thực phẩm sạch theo ngữ cảnh sản phẩm.
     */
    public static function resolveImagesForProduct(string $name, string $catName): array
    {
        $lower = mb_strtolower($name, 'UTF-8');

        // 1. Tôm các loại
        if (str_contains($lower, 'tôm')) {
            return [
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1559742811-822873691df8?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1551248429-40975aa4de74?w=800&h=800&fit=crop',
            ];
        }

        // 2. Cá hồi, cá điêu hồng
        if (str_contains($lower, 'cá ') || str_contains($lower, 'hồi') || str_contains($lower, 'điêu hồng')) {
            return [
                'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1535400255456-984241443b29?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800&h=800&fit=crop',
            ];
        }

        // 3. Thịt bò
        if (str_contains($lower, 'bò') && ! str_contains($lower, 'lúc lắc')) {
            return [
                'https://images.unsplash.com/photo-1603048588665-791ca8aea617?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1588347818036-558601350947?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1558030006-450675393462?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&h=800&fit=crop',
            ];
        }

        // 4. Thịt gà
        if (str_contains($lower, 'gà') && ! str_contains($lower, 'lẩu')) {
            return [
                'https://images.unsplash.com/photo-1587593810167-a84920ea0781?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1567620832903-9fc6debc209f?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=800&h=800&fit=crop',
            ];
        }

        // 5. Trứng gà
        if (str_contains($lower, 'trứng')) {
            return [
                'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1506976785307-8732e854ad03?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1516467508483-a7212febe31a?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1498654896293-37aacf113fd9?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=800&h=800&fit=crop',
            ];
        }

        // 6. Gạo ST25, yến mạch, ngũ cốc, đậu xanh
        if (str_contains($lower, 'gạo') || str_contains($lower, 'yến mạch') || str_contains($lower, 'đậu')) {
            return [
                'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1509358271058-acd22cc93898?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1599940824399-b87987ceb72a?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=800&fit=crop',
            ];
        }

        // 7. Bò lúc lắc (Ready-to-cook)
        if (str_contains($lower, 'lúc lắc')) {
            return [
                'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1588347818036-558601350947?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1558030006-450675393462?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop',
            ];
        }

        // 8. Món sơ chế sẵn khác (Ready-to-cook: Lẩu gà lá é, Canh chua Nam Bộ)
        if (str_contains($lower, 'lẩu') || str_contains($lower, 'canh chua') || str_contains($lower, 'sơ chế') || str_contains($catName, 'sơ chế')) {
            return [
                'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop',
            ];
        }

        // 8. Gia vị tự nhiên: Nước mắm, tiêu, mật ong
        if (str_contains($lower, 'nước mắm') || str_contains($lower, 'tiêu') || str_contains($lower, 'mật ong') || str_contains($catName, 'Gia vị')) {
            return [
                'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1509358271058-acd22cc93898?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1532336414038-cf19250c5757?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1599940824399-b87987ceb72a?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1514733670139-4d87a1941d55?w=800&h=800&fit=crop',
            ];
        }

        // 9. Dâu tây
        if (str_contains($lower, 'dâu tây') || str_contains($lower, 'dâu')) {
            return [
                'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1553279768-865429fa0078?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop',
            ];
        }

        // 10. Nho mẫu đơn
        if (str_contains($lower, 'nho')) {
            return [
                'https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1553279768-865429fa0078?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop',
            ];
        }

        // 11. Táo, bưởi, trái cây khác
        if (str_contains($catName, 'Trái cây') || str_contains($lower, 'táo') || str_contains($lower, 'bưởi')) {
            return [
                'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1553279768-865429fa0078?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=800&fit=crop',
            ];
        }

        // 12. Mặc định: Rau củ quả sạch & Nấm
        return [
            'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=800&fit=crop',
        ];
    }
}
