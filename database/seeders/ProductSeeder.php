<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
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
                    'description' => 'Danh mục các sản phẩm ' . $catName . ' chất lượng cao, an toàn và tươi ngon.',
                    'is_active' => true,
                ]
            );
        }

        // 2. Define an array of 20 Unsplash food/grocery image URLs
        $imageUrls = [
            'https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1608686207856-001b95cf60ca?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1543362906-acfc16c67564?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1553279768-865429fa0078?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1493770348161-369560ae357d?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600&h=400&fit=crop',
        ];

        // Brands & Units lists
        $brands = [
            'VietGAP', 'DaLat GAP', 'CP Fresh Mart', 'Vinamilk', 'TH True Milk',
            'Masan Consumer', 'Knorr', 'Chinsu', 'Ajinomoto', 'Nam Ngư',
            'Orion', 'Oishi', 'Kinh Đô', 'Lay\'s', 'Lavie',
            'Trung Nguyên', 'Unilever', 'P&G', 'Sunlight', 'Comfort',
            'Lifebuoy', 'Clear', 'Colgate', 'Sensodyne', 'Vissan',
            'Hạ Long Canfoco', 'Nestlé', 'Acecook', 'Simply', 'Anchor'
        ];

        $units = [
            'kg', 'túi 500g', 'hộp', 'chai', 'lon', 'gói', 'bó',
            'khay 300g', 'khay 500g', 'lốc 4 hộp', 'lốc 6 lon', 'thùng', 'bình', 'tuýp', 'cuộn'
        ];

        // 3. Exactly 200 products organized across 10 categories (20 products per category)
        $catalog = [
            'Rau củ' => [
                'Cải bó xôi Đà Lạt hữu cơ',
                'Cà rốt baby Đà Lạt',
                'Bông cải xanh organic',
                'Bắp cải trái tim tươi ngon',
                'Cà chua bi cherry ngọt',
                'Xà lách Lolo xanh thủy canh',
                'Bí đỏ hạt đậu giống Nhật',
                'Khoai tây vàng Đà Lạt',
                'Dưa leo baby giòn ngọt',
                'Nấm đùi gà tươi loại 1',
                'Nấm kim châm Hàn Quốc',
                'Ớt chuông đỏ Đà Lạt',
                'Củ dền đỏ hữu cơ',
                'Rau muống nước sạch VietGAP',
                'Măng tây xanh loại 1',
                'Bắp ngọt Mỹ tươi bẻ bắp',
                'Hành tây tím Đà Lạt',
                'Khổ qua rừng VietGAP',
                'Đậu cô ve xanh tươi',
                'Rau mồng tơi thủy canh',
            ],
            'Trái cây' => [
                'Táo Envy New Zealand size lớn',
                'Táo Fuji Nhật Bản giòn ngọt',
                'Nho mẫu đơn Shine Muscat Hàn Quốc',
                'Nho đen không hạt Mỹ',
                'Cherry đỏ Mỹ thượng hạng',
                'Kiwi vàng Zespri New Zealand',
                'Dâu tây giống Nhật Bản Đà Lạt',
                'Cam sành Tiền Giang mọng nước',
                'Bưởi da xanh Bến Tre ruột hồng',
                'Xoài cát Hòa Lộc loại 1',
                'Dưa lưới ruột cam Đài Loan',
                'Việt quất tươi nhập khẩu Peru',
                'Lê sữa Hàn Quốc ngọt thanh',
                'Măng cụt Cái Mơn Bến Tre',
                'Sầu riêng Ri6 cơm vàng hạt lép',
                'Thanh long ruột đỏ Bình Thuận',
                'Bơ sáp 034 Đắk Lắk dẻo béo',
                'Mận hậu Bắc Hà giòn rụm',
                'Dứa mật MD2 Tây Ninh thơm ngọt',
                'Chanh dây ngọt Colombia nhập khẩu',
            ],
            'Thịt cá' => [
                'Thịt ba rọi heo hữu cơ sạch',
                'Sườn non heo tươi CP',
                'Thịt nạc dăm heo chuẩn an toàn',
                'Thăn bò Úc mát thượng hạng',
                'Ba chỉ bò Mỹ cắt lát cuộn nướng',
                'Bắp bò hoa nhập khẩu mềm ngon',
                'Thịt bò Wagyu A5 Nhật Bản cao cấp',
                'Gà ta thả vườn nguyên con làm sạch',
                'Đùi gà góc tư tươi CP',
                'Cánh gà tươi chất lượng cao',
                'Chim cút làm sạch tươi ngon',
                'Thịt vịt xiêm thả đồng tươi',
                'Cá hồi Na Uy phi lê tươi nhập khẩu',
                'Cá thu cắt khúc tươi ngon',
                'Cá bớp biển cắt lát tươi sống',
                'Cá trắm đen sông Đà làm sạch',
                'Cá điêu hồng phi lê tươi',
                'Cá chép giòn làm sạch cắt khúc',
                'Cá basa phi lê xuất khẩu',
                'Lườn ngỗng xông khói Nga hảo hạng',
            ],
            'Hải sản' => [
                'Tôm sú tươi sinh thái Cà Mau',
                'Tôm thẻ chân trắng tươi sống',
                'Càng cua biển Cà Mau chắc thịt',
                'Cua huỳnh đế đảo Phú Quý',
                'Tôm hùm bông Nha Trang tươi sống',
                'Mực lá câu Cô Tô tươi rói',
                'Mực ống tươi nguyên con loại 1',
                'Bạch tuộc baby tươi ngon giòn rụm',
                'Sò điệp Nhật Bản nửa mảnh',
                'Hàu sữa Pháp tươi béo ngậy',
                'Ngao hai cồi Phan Thiết sống',
                'Ốc hương biển loại 1 cồi to',
                'Sò huyết Cà Mau cồi to béo',
                'Chả mực giã tay Hạ Long truyền thống',
                'Mực trứng tươi đông lạnh cao cấp',
                'Cá mú đỏ biển tươi sống',
                'Bào ngư sống Hàn Quốc cao cấp',
                'Cồi sò điệp trắng tươi mềm',
                'Cua gạch biển Cà Mau béo ngậy',
                'Cá trích ép trứng Nhật Bản cao cấp',
            ],
            'Đồ uống' => [
                'Nước ép cam tươi nguyên chất Teppy',
                'Trà sữa trân châu đóng chai thượng hạng',
                'Nước ép táo lên men Somersby',
                'Cà phê rang xay nguyên chất Trung Nguyên',
                'Cà phê đen hòa tan G7 đậm đà',
                'Trà Ô Long TEA+ Plus thanh mát',
                'Trà xanh Không Độ giải nhiệt',
                'Nước khoáng thiên nhiên có ga Perrier',
                'Nước khoáng thiên nhiên Lavie chai 500ml',
                'Nước tăng lực Red Bull Thái Lan',
                'Nước ép lựu nguyên chất Malee',
                'Trà Atiso túi lọc Ladophar Đà Lạt',
                'Nước dừa xiêm nguyên chất Cocoxim',
                'Bia thủ công Pasteur Street IPA hảo hạng',
                'Bia Heineken Sleek lon 330ml',
                'Bia Tiger bạc Crystal mát lạnh',
                'Nước ngọt Coca-Cola Zero không đường',
                'Nước ngọt có ga Pepsi lon mát lạnh',
                'Trà xanh Matcha nguyên chất Nhật Bản',
                'Nước yến sào thiên nhiên nha đam',
            ],
            'Sữa' => [
                'Sữa tươi tiệt trùng TH True Milk ít đường',
                'Sữa tươi thanh trùng Vinamilk 100% nguyên chất',
                'Sữa tươi hữu cơ Da Lat Milk Organic',
                'Sữa chua uống men sống Probi Vinamilk',
                'Sữa chua ăn có đường Vinamilk lốc 4 hộp',
                'Sữa hạt óc chó TH True Nut tự nhiên',
                'Sữa hạnh nhân nguyên chất 137 Degrees',
                'Sữa đậu nành Fami Canxi lốc 6 hộp',
                'Sữa hạt mắc ca hữu cơ tự nhiên',
                'Sữa chua Hy Lạp Greek Style Farmers Union',
                'Phô mai Con Bò Cười truyền thống hộp 8 miếng',
                'Phô mai Mozzarella khối Anchor New Zealand',
                'Bơ lạt tự nhiên Anchor New Zealand',
                'Váng sữa Monte hương vani thơm béo',
                'Sữa đặc có đường Ông Thọ nhãn đỏ',
                'Sữa bột Ensure Gold hương vani 850g',
                'Sữa chua nếp cẩm Ba Vì truyền thống',
                'Phô mai que tẩm bột chiên xù béo ngậy',
                'Sữa tiệt trùng Meadow Fresh nguyên kem',
                'Sữa lúa mạch pha sẵn Milo Nestlé lốc 4 hộp',
            ],
            'Gia vị' => [
                'Nước mắm cá cơm Nam Ngư Đệ Nhị',
                'Nước mắm truyền thống Khải Hoàn Phú Quốc',
                'Nước tương tỏi ớt Chinsu đậm vị',
                'Hạt nêm thịt thăn xương ống Knorr',
                'Dầu hoa cải tinh luyện Ajinomoto Nhật',
                'Dầu thực vật nguyên chất Simply',
                'Dầu ô liu nguyên chất Extra Virgin Borges',
                'Tiêu đen Phú Quốc xay thơm nồng',
                'Tiêu sọ trắng nguyên hạt Phú Quốc',
                'Muối hồng Himalaya hạt mịn tự nhiên',
                'Muối tôm Tây Ninh loại đặc biệt cay thơm',
                'Giấm gạo lên men tự nhiên Trung Thành',
                'Tương ớt Chinsu siêu cay chai 250g',
                'Tương cà chua nguyên chất Heinz',
                'Sốt Mayonnaise Ajinomoto vị chua dịu nhẹ',
                'Bột chiên giòn cao cấp Meizan',
                'Bột cà ri Việt Ấn thơm lừng',
                'Sa tế tôm cay nồng Cholimex hũ thủy tinh',
                'Đường tinh luyện cao cấp Biên Hòa Pure',
                'Sốt ướp thịt nướng BBQ Lee Kum Kee',
            ],
            'Đồ ăn vặt' => [
                'Snack khoai tây Lay\'s vị tự nhiên giòn rụm',
                'Bim bim khoai tây Pringles vị kem chua và hành',
                'Bánh quy bơ cao cấp Danisa hộp thiếc',
                'Bánh Chocopie Orion nhân kem dẻo truyền thống',
                'Kẹo dẻo gấu Haribo Goldbears nhập khẩu Đức',
                'Bánh que Pocky vị dâu tây thơm béo',
                'Bánh gạo Một Một vị bò nướng giòn xốp',
                'Bánh quế Oreo kẹp kem vani nguyên bản',
                'Rong biển sấy giòn vị mè Taokaenoi',
                'Khô bò xé sợi tẩm gia vị cay thơm hảo hạng',
                'Khô gà lá chanh loại cay thơm đậm đà',
                'Khô mực rim me chua cay Nha Trang',
                'Đậu phộng tỏi ớt giòn cay Tân Tân',
                'Hạt điều rang muối vỏ lụa Bình Phước',
                'Hạt dẻ cười Mỹ rang muối loại đặc biệt',
                'Hạt hạnh nhân sấy mộc nguyên vị tự nhiên',
                'Hạt macca nứt vỏ Tây Nguyên sấy giòn',
                'Trái cây sấy dẻo thập cẩm Vinamit',
                'Mít sấy giòn hữu cơ Vinamit tự nhiên',
                'Bánh bông lan nhân kem trứng Custas Orion',
            ],
            'Đồ gia dụng' => [
                'Nước rửa chén Sunlight tinh dầu bưởi tây',
                'Nước lau sàn Sunlight hương hoa hạ thơm mát',
                'Nước tẩy bồn cầu diệt khuẩn Vim sạch bóng',
                'Nước giặt OMO Matic hương hoa anh đào dịu nhẹ',
                'Nước xả vải Comfort đậm đặc hương ban mai',
                'Nước xả vải Downy hương nắng mai thơm lâu',
                'Nước giặt xả cho bé D-nee trắng Thái Lan',
                'Khăn giấy lau bếp đa năng đa lớp thấm hút',
                'Giấy vệ sinh lốc 10 cuộn cao cấp Pulppy',
                'Khăn giấy ướt không mùi dịu nhẹ cho bé Bobby',
                'Màng bọc thực phẩm PE có dao cắt thông minh',
                'Giấy bạc nướng thực phẩm cao cấp dày dặn',
                'Túi rác tự hủy sinh học thân thiện môi trường',
                'Găng tay cao su gia dụng chống trơn bền bỉ',
                'Miếng bọt biển rửa chén kháng khuẩn 3M Scotch-Brite',
                'Cây lau nhà tự vắt xoay 360 độ cao cấp',
                'Nước xịt lau kính sạch bóng diệt khuẩn Gift',
                'Bình xịt đuổi côn trùng phòng chống mối mọt',
                'Sáp thơm phòng cao cấp Glade hương oải hương',
                'Bột tẩy lồng máy giặt diệt khuẩn khử mùi hôi',
            ],
            'Chăm sóc cá nhân' => [
                'Dầu gội đầu thảo dược Clear sạch gàu mát lạnh',
                'Dầu gội bưởi Cocoon ngăn rụng tóc nuôi dưỡng tóc',
                'Dầu xả phục hồi tóc hư tổn Pantene 3 Minute',
                'Sữa tắm bảo vệ kháng khuẩn Lifebuoy chăm sóc da',
                'Sữa tắm dưỡng ẩm thơm lâu Enchanteur Charming',
                'Sữa tắm dưỡng thể mềm mịn Dove Deep Moisture',
                'Kem đánh răng Colgate than hoạt tính làm trắng',
                'Kem đánh răng Sensodyne phục hồi răng ê buốt',
                'Nước súc miệng kháng khuẩn Listerine Cool Mint',
                'Bàn chải đánh răng lông tơ siêu mềm Oral-B',
                'Sữa rửa mặt tạo bọt tràm trà Senka sạch sâu',
                'Sữa rửa mặt dịu nhẹ cho da nhạy cảm Cetaphil',
                'Nước tẩy trang mắt môi lành tính Bioderma Sensibio',
                'Bông tẩy trang 100% cotton tự nhiên mềm mại',
                'Lăn khử mùi khoáng đá Rexona khô thoáng suốt 48h',
                'Bọt cạo râu mịn màng hương chanh Gillette',
                'Xà bông cục kháng khuẩn Lifebuoy bảo vệ vượt trội',
                'Xịt khử mùi toàn thân nam tính quyến rũ Axe',
                'Dao cạo râu 3 lưỡi kép sắc bén Gillette Mach 3',
                'Gel dưỡng ẩm phục hồi làm dịu da lô hội tự nhiên',
            ],
        ];

        // 4 & 5. Loop and insert 200 products and variants
        foreach ($catalog as $catName => $productNames) {
            $cat = $categories[$catName];

            foreach ($productNames as $name) {
                // Generate base price in range 15,000 - 1,200,000 (rounded to nearest 1,000 VND)
                $basePrice = rand(15, 1200) * 1000;

                // 70% chance of higher original price (10% - 40% markup)
                $hasDiscount = rand(1, 100) <= 70;
                $originalPrice = $hasDiscount
                    ? round($basePrice * (1 + (rand(10, 40) / 100)) / 1000) * 1000
                    : null;

                // 15% chance of being featured
                $isFeatured = rand(1, 100) <= 15;

                // Stock between 0 and 100
                $stock = rand(0, 100);

                // Create Product
                $product = Product::create([
                    'category_id' => $cat->id,
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . rand(1000, 9999),
                    'description' => 'Sản phẩm ' . $name . ' chất lượng cao, nguồn gốc tự nhiên và an toàn cho người tiêu dùng. Đạt tiêu chuẩn kiểm nghiệm nghiêm ngặt về chất lượng và an toàn thực phẩm.',
                    'image_url' => $imageUrls[array_rand($imageUrls)],
                    'brand' => $brands[array_rand($brands)],
                    'unit' => $units[array_rand($units)],
                    'original_price' => $originalPrice,
                    'base_price' => $basePrice,
                    'stock' => $stock,
                    'is_active' => true,
                    'is_featured' => $isFeatured,
                ]);

                // Create default ProductVariant
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => Str::upper(Str::slug($name, '')) . '-' . rand(1000, 9999) . '-' . Str::upper(Str::random(3)),
                    'name' => 'Mặc định',
                    'price' => $basePrice,
                    'stock_quantity' => $stock,
                    'is_active' => true,
                ]);
            }
        }
    }
}
