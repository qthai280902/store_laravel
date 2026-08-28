<?php
$categories = [
    'Rau củ hữu cơ' => 'rau-cu-huu-co',
    'Trái cây nhập khẩu' => 'trai-cay-nhap-khau',
    'Thực phẩm tươi sống' => 'thuc-pham-tuoi-song',
    'Thực phẩm khô' => 'thuc-pham-kho',
    'Đồ uống' => 'do-uong',
];

$products = [
    // Rau củ hữu cơ (10)
    ['Cải bó xôi Đà Lạt', 35000, 'Rau củ hữu cơ'],
    ['Cà rốt baby hữu cơ', 45000, 'Rau củ hữu cơ'],
    ['Bông cải xanh hữu cơ', 30000, 'Rau củ hữu cơ'],
    ['Cà chua cherry Đà Lạt', 50000, 'Rau củ hữu cơ'],
    ['Khoai tây Đà Lạt', 25000, 'Rau củ hữu cơ'],
    ['Bắp cải trái tim', 28000, 'Rau củ hữu cơ'],
    ['Hành tây Đà Lạt', 18000, 'Rau củ hữu cơ'],
    ['Rau muống thủy canh', 22000, 'Rau củ hữu cơ'],
    ['Nấm đùi gà', 42000, 'Rau củ hữu cơ'],
    ['Ớt chuông Đà Lạt', 55000, 'Rau củ hữu cơ'],
    // Trái cây nhập khẩu (10)
    ['Nho mẫu đơn Hàn Quốc', 850000, 'Trái cây nhập khẩu'],
    ['Táo Fuji Nhật Bản', 120000, 'Trái cây nhập khẩu'],
    ['Cam vàng Navel Úc', 90000, 'Trái cây nhập khẩu'],
    ['Cherry đỏ Mỹ', 350000, 'Trái cây nhập khẩu'],
    ['Kiwi vàng New Zealand', 180000, 'Trái cây nhập khẩu'],
    ['Dâu tây Hàn Quốc', 250000, 'Trái cây nhập khẩu'],
    ['Lựu đỏ Peru', 150000, 'Trái cây nhập khẩu'],
    ['Việt quất New Zealand', 220000, 'Trái cây nhập khẩu'],
    ['Lê Hàn Quốc', 140000, 'Trái cây nhập khẩu'],
    ['Dưa lưới Đài Loan', 190000, 'Trái cây nhập khẩu'],
    // Thực phẩm tươi sống (10)
    ['Cá hồi Na Uy phi lê', 550000, 'Thực phẩm tươi sống'],
    ['Thịt bò Wagyu A5 Nhật', 1200000, 'Thực phẩm tươi sống'],
    ['Tôm sú sinh thái', 280000, 'Thực phẩm tươi sống'],
    ['Mực lá tươi câu', 320000, 'Thực phẩm tươi sống'],
    ['Thịt heo Iberico Tây Ban Nha', 450000, 'Thực phẩm tươi sống'],
    ['Thăn bò Úc', 380000, 'Thực phẩm tươi sống'],
    ['Gà ta thả vườn', 160000, 'Thực phẩm tươi sống'],
    ['Sườn non heo CP', 190000, 'Thực phẩm tươi sống'],
    ['Bạch tuộc sữa', 210000, 'Thực phẩm tươi sống'],
    ['Cá bớp cắt lát', 260000, 'Thực phẩm tươi sống'],
    // Thực phẩm khô (10)
    ['Gạo ST25 Ông Cua 5kg', 180000, 'Thực phẩm khô'],
    ['Hạt điều rang muối Bình Phước', 150000, 'Thực phẩm khô'],
    ['Nấm hương rừng sấy khô', 120000, 'Thực phẩm khô'],
    ['Mật ong hoa rừng nguyên chất', 250000, 'Thực phẩm khô'],
    ['Mì cay kimchi Hàn Quốc', 150000, 'Thực phẩm khô', true],
    ['Hạt macca Úc', 280000, 'Thực phẩm khô'],
    ['Khô bò xé sợi', 220000, 'Thực phẩm khô'],
    ['Đậu phộng tỏi ớt', 45000, 'Thực phẩm khô'],
    ['Rong biển cháy tỏi', 60000, 'Thực phẩm khô'],
    ['Trái cây sấy dẻo thập cẩm', 110000, 'Thực phẩm khô'],
    // Đồ uống (10)
    ['Nước ép táo lên men', 45000, 'Đồ uống'],
    ['Sữa tươi nguyên kem Úc', 55000, 'Đồ uống'],
    ['Nước khoáng có ga', 25000, 'Đồ uống'],
    ['Cà phê rang xay Robusta', 120000, 'Đồ uống'],
    ['Trà Ô Long thượng hạng', 180000, 'Đồ uống'],
    ['Nước ép cam tươi', 35000, 'Đồ uống'],
    ['Trà xanh Nhật Bản Matcha', 320000, 'Đồ uống'],
    ['Nước dừa tươi', 20000, 'Đồ uống'],
    ['Bia thủ công IPA', 65000, 'Đồ uống'],
    ['Rượu vang Chile', 450000, 'Đồ uống'],
];

$output = "<?php\n\nnamespace Database\Seeders;\n\nuse App\Models\Category;\nuse App\Models\Product;\nuse App\Models\ProductVariant;\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Str;\n\nclass ProductSeeder extends Seeder\n{\n    public function run(): void\n    {\n        \$categories = [\n";
foreach($categories as $name => $slug) {
    $output .= "            '$name' => Category::firstOrCreate(['slug' => '$slug'], ['name' => '$name', 'description' => '$name']),\n";
}
$output .= "        ];\n\n        \$products = [\n";

foreach($products as $p) {
    $name = $p[0];
    $price = $p[1];
    $cat = $p[2];
    $isSpicy = isset($p[3]) && $p[3] ? "'is_spicy' => true" : "";
    $desc = "Sản phẩm $name chất lượng cao, tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.";
    $img = "https://picsum.photos/seed/" . md5($name) . "/600/400";
    
    $output .= "            ['name' => '$name', 'price' => $price, 'cat' => '$cat', 'desc' => '$desc', 'img' => '$img'";
    if ($isSpicy) $output .= ", $isSpicy";
    $output .= "],\n";
}

$output .= "        ];\n\n        foreach (\$products as \$item) {\n            \$cat = \$categories[\$item['cat']];\n            \$product = Product::create([\n                'name' => \$item['name'],\n                'slug' => Str::slug(\$item['name']) . '-' . rand(100, 999),\n                'description' => \$item['desc'],\n                'image_url' => \$item['img'],\n                'base_price' => \$item['price'],\n                'category_id' => \$cat->id,\n            ]);\n\n            if (isset(\$item['is_spicy'])) {\n                ProductVariant::create(['product_id' => \$product->id, 'name' => 'Cấp độ 1', 'price_adjustment' => 0]);\n                ProductVariant::create(['product_id' => \$product->id, 'name' => 'Cấp độ 3', 'price_adjustment' => 10000]);\n                ProductVariant::create(['product_id' => \$product->id, 'name' => 'Cấp độ 7', 'price_adjustment' => 25000]);\n            } else {\n                ProductVariant::create(['product_id' => \$product->id, 'name' => 'Mặc định', 'price_adjustment' => 0]);\n            }\n        }\n    }\n}\n";

file_put_contents('C:\Users\thaib\du_an_code\store_laravel\database\seeders\ProductSeeder.php', $output);
echo "ProductSeeder updated.\n";
