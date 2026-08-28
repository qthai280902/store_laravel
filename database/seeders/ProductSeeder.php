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
            'Rau củ hữu cơ' => Category::firstOrCreate(['slug' => 'rau-cu-huu-co'], ['name' => 'Rau củ hữu cơ', 'description' => 'Rau củ hữu cơ']),
            'Trái cây nhập khẩu' => Category::firstOrCreate(['slug' => 'trai-cay-nhap-khau'], ['name' => 'Trái cây nhập khẩu', 'description' => 'Trái cây nhập khẩu']),
            'Thực phẩm tươi sống' => Category::firstOrCreate(['slug' => 'thuc-pham-tuoi-song'], ['name' => 'Thực phẩm tươi sống', 'description' => 'Thực phẩm tươi sống']),
            'Thực phẩm khô' => Category::firstOrCreate(['slug' => 'thuc-pham-kho'], ['name' => 'Thực phẩm khô', 'description' => 'Thực phẩm khô']),
            'Đồ uống' => Category::firstOrCreate(['slug' => 'do-uong'], ['name' => 'Đồ uống', 'description' => 'Đồ uống']),
        ];

        $products = [
            ['name' => 'Cải bó xôi Đà Lạt', 'price' => 35000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Cải bó xôi Đà Lạt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/8d0915462c2779e1714fb0f14aa6331a/600/400'],
            ['name' => 'Cà rốt baby hữu cơ', 'price' => 45000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Cà rốt baby hữu cơ chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/948904253e4b10ca05653046c890d1e0/600/400'],
            ['name' => 'Bông cải xanh hữu cơ', 'price' => 30000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Bông cải xanh hữu cơ chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/192c567f424664fa07cb9e27803302e9/600/400'],
            ['name' => 'Cà chua cherry Đà Lạt', 'price' => 50000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Cà chua cherry Đà Lạt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/149da003b3773dd06947b5942e06da1c/600/400'],
            ['name' => 'Khoai tây Đà Lạt', 'price' => 25000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Khoai tây Đà Lạt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/f2e4f4c522fc98ef391ea85dc37027d6/600/400'],
            ['name' => 'Bắp cải trái tim', 'price' => 28000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Bắp cải trái tim chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/7c8e901ce945a912cc82973a9e3e15e6/600/400'],
            ['name' => 'Hành tây Đà Lạt', 'price' => 18000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Hành tây Đà Lạt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/68fbca964a7a5aa1ad5ce7cf0581459b/600/400'],
            ['name' => 'Rau muống thủy canh', 'price' => 22000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Rau muống thủy canh chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/4f1e6c4cc65febed4758ff4109f1ce20/600/400'],
            ['name' => 'Nấm đùi gà', 'price' => 42000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Nấm đùi gà chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/c8b7bb7247d09d3f943a33ad0229f4ed/600/400'],
            ['name' => 'Ớt chuông Đà Lạt', 'price' => 55000, 'cat' => 'Rau củ hữu cơ', 'desc' => 'Sản phẩm Ớt chuông Đà Lạt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/6d9d00150179acecb74371a16c08824f/600/400'],
            ['name' => 'Nho mẫu đơn Hàn Quốc', 'price' => 850000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Nho mẫu đơn Hàn Quốc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b0af52672a09281528d6e3c7d2a4265f/600/400'],
            ['name' => 'Táo Fuji Nhật Bản', 'price' => 120000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Táo Fuji Nhật Bản chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/5109ccdd4ad8518f0d8e20c19759cf0d/600/400'],
            ['name' => 'Cam vàng Navel Úc', 'price' => 90000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Cam vàng Navel Úc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/887862520359c04f811be7ed2bc88f03/600/400'],
            ['name' => 'Cherry đỏ Mỹ', 'price' => 350000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Cherry đỏ Mỹ chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/cfb7ec4748bbb9e157e3c89cdd20c7c4/600/400'],
            ['name' => 'Kiwi vàng New Zealand', 'price' => 180000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Kiwi vàng New Zealand chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b405087fda60ca1c16179ec12907ddeb/600/400'],
            ['name' => 'Dâu tây Hàn Quốc', 'price' => 250000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Dâu tây Hàn Quốc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b5a43fcb37a09ae7084e3f9957811532/600/400'],
            ['name' => 'Lựu đỏ Peru', 'price' => 150000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Lựu đỏ Peru chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/48ec3be2919418d69826da2147f78bcf/600/400'],
            ['name' => 'Việt quất New Zealand', 'price' => 220000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Việt quất New Zealand chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/9a5283026211fd02083312052548e241/600/400'],
            ['name' => 'Lê Hàn Quốc', 'price' => 140000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Lê Hàn Quốc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/6572445d88cc7982fc7379b47c7523f8/600/400'],
            ['name' => 'Dưa lưới Đài Loan', 'price' => 190000, 'cat' => 'Trái cây nhập khẩu', 'desc' => 'Sản phẩm Dưa lưới Đài Loan chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/34a490e04056bfe9e9923caa25c9064a/600/400'],
            ['name' => 'Cá hồi Na Uy phi lê', 'price' => 550000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Cá hồi Na Uy phi lê chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/479487859b496806a7fd0da8de45e7ff/600/400'],
            ['name' => 'Thịt bò Wagyu A5 Nhật', 'price' => 1200000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Thịt bò Wagyu A5 Nhật chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/e52f21a93db2313a5f6df66ed2941cdf/600/400'],
            ['name' => 'Tôm sú sinh thái', 'price' => 280000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Tôm sú sinh thái chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b9db2827d6fdad3984ea50e26111fc8e/600/400'],
            ['name' => 'Mực lá tươi câu', 'price' => 320000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Mực lá tươi câu chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/30fdd59201bb163aae90da36ced44605/600/400'],
            ['name' => 'Thịt heo Iberico Tây Ban Nha', 'price' => 450000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Thịt heo Iberico Tây Ban Nha chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/f53d010732906cf70d12a6a3a92ff96f/600/400'],
            ['name' => 'Thăn bò Úc', 'price' => 380000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Thăn bò Úc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/19e78cc1dc151e829f57f368e482c15d/600/400'],
            ['name' => 'Gà ta thả vườn', 'price' => 160000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Gà ta thả vườn chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/e3444d06e37e1edc76fa2b27445ad376/600/400'],
            ['name' => 'Sườn non heo CP', 'price' => 190000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Sườn non heo CP chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/241c3da7578f9ec0ad03ef8d810d54bb/600/400'],
            ['name' => 'Bạch tuộc sữa', 'price' => 210000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Bạch tuộc sữa chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/dcdeb1dc30961ba57481dc1d5824257c/600/400'],
            ['name' => 'Cá bớp cắt lát', 'price' => 260000, 'cat' => 'Thực phẩm tươi sống', 'desc' => 'Sản phẩm Cá bớp cắt lát chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/1231bb30b11eaee5458d736af6c24fe4/600/400'],
            ['name' => 'Gạo ST25 Ông Cua 5kg', 'price' => 180000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Gạo ST25 Ông Cua 5kg chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/20ae0292dd6b519482f21c8b31402bc1/600/400'],
            ['name' => 'Hạt điều rang muối Bình Phước', 'price' => 150000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Hạt điều rang muối Bình Phước chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/5a031aa7a46720451d0c5bb98ce55dcf/600/400'],
            ['name' => 'Nấm hương rừng sấy khô', 'price' => 120000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Nấm hương rừng sấy khô chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/4e4b0fd4c62349b75491c65e06358cfb/600/400'],
            ['name' => 'Mật ong hoa rừng nguyên chất', 'price' => 250000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Mật ong hoa rừng nguyên chất chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/4b6f1c0b3d9eaa6121ee8953fe9d5317/600/400'],
            ['name' => 'Mì cay kimchi Hàn Quốc', 'price' => 150000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Mì cay kimchi Hàn Quốc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/c4881c1c6608330f4b66dd0dc4ee7599/600/400', 'is_spicy' => true],
            ['name' => 'Hạt macca Úc', 'price' => 280000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Hạt macca Úc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/43bdc5e8c3f8db230a2a6696bc44a2ee/600/400'],
            ['name' => 'Khô bò xé sợi', 'price' => 220000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Khô bò xé sợi chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/c1cd10376cc22b41229feb915e6fe61d/600/400'],
            ['name' => 'Đậu phộng tỏi ớt', 'price' => 45000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Đậu phộng tỏi ớt chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/0f9b538aa3cd39f2f0505c3b11462633/600/400'],
            ['name' => 'Rong biển cháy tỏi', 'price' => 60000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Rong biển cháy tỏi chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b252b9a054245ae79a08476858ab86e9/600/400'],
            ['name' => 'Trái cây sấy dẻo thập cẩm', 'price' => 110000, 'cat' => 'Thực phẩm khô', 'desc' => 'Sản phẩm Trái cây sấy dẻo thập cẩm chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/17cd9a880cb2f6ebc9f9611706868cd4/600/400'],
            ['name' => 'Nước ép táo lên men', 'price' => 45000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Nước ép táo lên men chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/0127920283b5476833c1a0f02fd3bc28/600/400'],
            ['name' => 'Sữa tươi nguyên kem Úc', 'price' => 55000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Sữa tươi nguyên kem Úc chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/0fffda99c670efb983e51a636f20048d/600/400'],
            ['name' => 'Nước khoáng có ga', 'price' => 25000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Nước khoáng có ga chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/add4722afaa79eec2676ca8fec975f0a/600/400'],
            ['name' => 'Cà phê rang xay Robusta', 'price' => 120000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Cà phê rang xay Robusta chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/60009e038fdddda201d2615bfc3252bd/600/400'],
            ['name' => 'Trà Ô Long thượng hạng', 'price' => 180000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Trà Ô Long thượng hạng chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/08843ea6f3bd01027f2071629ded11f7/600/400'],
            ['name' => 'Nước ép cam tươi', 'price' => 35000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Nước ép cam tươi chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/11b4abe555d4c9083e3e9559d7d07b07/600/400'],
            ['name' => 'Trà xanh Nhật Bản Matcha', 'price' => 320000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Trà xanh Nhật Bản Matcha chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/17d9f43037dee871bb52490762f710c9/600/400'],
            ['name' => 'Nước dừa tươi', 'price' => 20000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Nước dừa tươi chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/d83547f7dd7ff09eb646475c93835db2/600/400'],
            ['name' => 'Bia thủ công IPA', 'price' => 65000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Bia thủ công IPA chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/d7d0c5d37004c675401c13f834ee9e61/600/400'],
            ['name' => 'Rượu vang Chile', 'price' => 450000, 'cat' => 'Đồ uống', 'desc' => 'Sản phẩm Rượu vang Chile chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.', 'img' => 'https://picsum.photos/seed/b0be6ad77b324122d9fc26876f4faee3/600/400'],
        ];

        foreach ($products as $item) {
            $cat = $categories[$item['cat']];
            $brands = ['VietGAP', 'Vissan', 'Organic DaLat', 'FreshFarm', 'Nhập khẩu'];
            $units = ['đ/kg', 'đ/túi 500g', 'đ/hộp', 'đ/túi 5kg', 'đ/lốc'];
            $price = $item['price'];
            $originalPrice = rand(0, 1) ? $price + ($price * rand(10, 30) / 100) : null;
            $isFeatured = rand(1, 100) <= 20; // 20% chance

            $product = Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']) . '-' . rand(100, 999),
                'description' => $item['desc'],
                'image_url' => $item['img'],
                'base_price' => $price,
                'category_id' => $cat->id,
                'brand' => $brands[array_rand($brands)],
                'unit' => $units[array_rand($units)],
                'original_price' => $originalPrice,
                'is_featured' => $isFeatured,
                'stock' => rand(0, 50),
            ]);

            if (isset($item['is_spicy'])) {
                ProductVariant::create(['product_id' => $product->id, 'sku' => Str::slug($item['name']).'-v1', 'name' => 'Cấp độ 1', 'price' => $item['price']]);
                ProductVariant::create(['product_id' => $product->id, 'sku' => Str::slug($item['name']).'-v2', 'name' => 'Cấp độ 3', 'price' => $item['price'] + 10000]);
                ProductVariant::create(['product_id' => $product->id, 'sku' => Str::slug($item['name']).'-v3', 'name' => 'Cấp độ 7', 'price' => $item['price'] + 25000]);
            } else {
                ProductVariant::create(['product_id' => $product->id, 'sku' => Str::slug($item['name']).'-def', 'name' => 'Mặc định', 'price' => $item['price']]);
            }
        }
    }
}
