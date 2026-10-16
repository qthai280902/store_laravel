<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can fetch products via ProductService', function () {
    $category = Category::create([
        'name' => 'Electronics',
        'slug' => 'electronics',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Smartphone',
        'slug' => 'smartphone',
        'base_price' => 999.99,
        'is_active' => true,
    ]);

    ProductVariant::create([
        'product_id' => $product->id,
        'sku' => 'PHONE-BLK',
        'name' => 'Black',
        'price' => 999.99,
        'stock_quantity' => 10,
    ]);

    $service = app(ProductService::class);
    $products = $service->getProducts();

    expect($products->count())->toBe(1);
    expect($products->first()->name)->toBe('Smartphone');
});

it('can fetch a product details by slug', function () {
    $category = Category::create([
        'name' => 'Books',
        'slug' => 'books',
    ]);

    Product::create([
        'category_id' => $category->id,
        'name' => 'Laravel Book',
        'slug' => 'laravel-book',
        'base_price' => 29.99,
        'is_active' => true,
    ]);

    $service = app(ProductService::class);
    $product = $service->getProductDetails('laravel-book');

    expect($product->name)->toBe('Laravel Book');
    expect($product->category->name)->toBe('Books');
});

it('fails to fetch inactive product', function () {
    $category = Category::create([
        'name' => 'Books',
        'slug' => 'books',
    ]);

    Product::create([
        'category_id' => $category->id,
        'name' => 'Laravel Book',
        'slug' => 'laravel-book',
        'base_price' => 29.99,
        'is_active' => false,
    ]);

    $service = app(ProductService::class);

    expect(fn () => $service->getProductDetails('laravel-book'))
        ->toThrow(ModelNotFoundException::class);
});

it('can render product details page with gallery, specs, and reviews', function () {
    $category = Category::create([
        'name' => 'Trái cây',
        'slug' => 'trai-cay',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Táo Envy',
        'slug' => 'tao-envy',
        'sku' => 'MM-FRU-0001',
        'brand' => 'Envy',
        'origin' => 'New Zealand',
        'weight' => '1kg',
        'unit' => 'hộp',
        'base_price' => 150000,
        'original_price' => 180000,
        'stock' => 25,
        'images' => [
            'https://images.unsplash.com/photo-1?w=800',
            'https://images.unsplash.com/photo-2?w=800',
            'https://images.unsplash.com/photo-3?w=800',
            'https://images.unsplash.com/photo-4?w=800',
            'https://images.unsplash.com/photo-5?w=800',
        ],
        'is_active' => true,
    ]);

    $response = $this->get(route('products.show', $product->slug));
    $response->assertStatus(200);
    $response->assertSee('Táo Envy');
    $response->assertSee('MM-FRU-0001');
    $response->assertSee('New Zealand');
    $response->assertSee('Thông số kỹ thuật');
});

it('resolves local storage image paths with asset helper', function () {
    $category = Category::create([
        'name' => 'Thủy hải sản',
        'slug' => 'thuy-hai-san',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Tôm sú tươi sinh thái Cà Mau',
        'slug' => 'tom-su-tuoi-sinh-thai-ca-mau',
        'sku' => 'MM-SEA-0061',
        'image_url' => 'storage/products/MM-SEA-0061/1.jpg',
        'images' => [
            'storage/products/MM-SEA-0061/1.jpg',
            'storage/products/MM-SEA-0061/2.jpg',
            'storage/products/MM-SEA-0061/3.jpg',
            'storage/products/MM-SEA-0061/4.jpg',
            'storage/products/MM-SEA-0061/5.jpg',
        ],
        'base_price' => 280000,
        'is_active' => true,
    ]);

    expect($product->image_url)->toContain('storage/products/MM-SEA-0061/1.jpg');
    expect($product->gallery_images)->toHaveCount(5);
    expect($product->gallery_images[0])->toContain('storage/products/MM-SEA-0061/1.jpg');

    $response = $this->get(route('products.show', $product->slug));
    $response->assertStatus(200);
    $response->assertSee('storage/products/MM-SEA-0061/1.jpg');
});

it('correctly classifies products into clean-food tiers and dynamic angle labels', function () {
    $vegCat = Category::create([
        'name' => 'Rau củ hữu cơ & Đà Lạt',
        'slug' => 'rau-cu-huu-co-da-lat',
    ]);

    $meatCat = Category::create([
        'name' => 'Thịt sạch & Trứng tươi',
        'slug' => 'thit-sach-trung-tuoi',
    ]);

    $cerealCat = Category::create([
        'name' => 'Gạo, Ngũ cốc & Lương thực sạch',
        'slug' => 'gao-ngu-coc-luong-thuc',
    ]);

    $vegProduct = Product::create([
        'category_id' => $vegCat->id,
        'name' => 'Cải bó xôi Đà Lạt hữu cơ',
        'slug' => 'cai-bo-xoi-da-lat-huu-co',
        'sku' => 'MM-VEG-0001',
        'base_price' => 35000,
        'is_active' => true,
    ]);

    $meatProduct = Product::create([
        'category_id' => $meatCat->id,
        'name' => 'Thịt bò Úc cao cấp',
        'slug' => 'thit-bo-uc-cao-cap',
        'sku' => 'MM-MEA-0041',
        'base_price' => 280000,
        'is_active' => true,
    ]);

    $cerealProduct = Product::create([
        'category_id' => $cerealCat->id,
        'name' => 'Gạo ST25 Ông Cua',
        'slug' => 'gao-st25-ong-cua',
        'sku' => 'MM-CER-0071',
        'base_price' => 190000,
        'is_active' => true,
    ]);

    // Check tiers
    expect($vegProduct->product_tier)->toBe(Product::TIER_FRESH_PRODUCE);
    expect($meatProduct->product_tier)->toBe(Product::TIER_MEAT_SEAFOOD);
    expect($cerealProduct->product_tier)->toBe(Product::TIER_PACKAGED_GOODS);

    // Check angle labels
    expect($vegProduct->angle_labels[0])->toBe('Chính diện');
    expect($vegProduct->angle_labels[4])->toBe('Thưởng thức');

    expect($meatProduct->angle_labels[0])->toBe('Đóng khay');
    expect($meatProduct->angle_labels[3])->toBe('Thớ thịt tươi');

    expect($cerealProduct->angle_labels[0])->toBe('Bao bì');
    expect($cerealProduct->angle_labels[1])->toBe('Dinh dưỡng');

    // Check Admin helper
    $adminLabels = Product::getAngleLabelsForCategory($meatCat);
    expect($adminLabels[0])->toBe('Đóng khay');
    expect($adminLabels[1])->toBe('Kiểm dịch');

    // Render product show page and assert tier labels
    $response = $this->get(route('products.show', $meatProduct->slug));
    $response->assertStatus(200);
    $response->assertSee('Đóng khay');
    $response->assertSee('Kiểm dịch Thú y & Cấp đông sâu');
});

it('can filter products by agricultural standards and freshness types', function () {
    $cat = Category::create([
        'name' => 'Rau củ hữu cơ & Đà Lạt',
        'slug' => 'rau-cu-huu-co-da-lat',
    ]);

    $rtcCat = Category::create([
        'name' => 'Món sơ chế sẵn (Ready-to-cook)',
        'slug' => 'mon-so-che-san-ready-to-cook',
    ]);

    $pOrganic = Product::create([
        'category_id' => $cat->id,
        'name' => 'Cà chua Cherry Organic',
        'slug' => 'ca-chua-cherry-organic',
        'sku' => 'MM-VEG-0005',
        'base_price' => 45000,
        'origin' => 'Đà Lạt - Chuẩn Organic',
        'is_active' => true,
    ]);

    $pRtc = Product::create([
        'category_id' => $rtcCat->id,
        'name' => 'Set Bò Lúc Lắc Sơ Chế',
        'slug' => 'set-bo-luc-lac-so-che',
        'sku' => 'MM-RTC-0145',
        'base_price' => 125000,
        'origin' => 'Bếp Trung Tâm MiniMart',
        'is_active' => true,
    ]);

    // Filter standard=organic
    $resOrganic = $this->get(route('products.index', ['standard' => 'organic']));
    $resOrganic->assertStatus(200);
    $resOrganic->assertSee('Cà chua Cherry Organic');
    $resOrganic->assertDontSee('Set Bò Lúc Lắc Sơ Chế');

    // Filter freshness_type=rtc
    $resRtc = $this->get(route('products.index', ['freshness_type' => 'rtc']));
    $resRtc->assertStatus(200);
    $resRtc->assertSee('Set Bò Lúc Lắc Sơ Chế');
    $resRtc->assertDontSee('Cà chua Cherry Organic');

    // Filter on_sale=1
    $pSale = Product::create([
        'category_id' => $cat->id,
        'name' => 'Dưa leo Sale',
        'slug' => 'dua-leo-sale',
        'sku' => 'MM-VEG-0099',
        'original_price' => 50000,
        'base_price' => 35000,
        'stock' => 10,
        'is_active' => true,
    ]);
    $resSale = $this->get(route('products.index', ['on_sale' => 1]));
    $resSale->assertStatus(200);
    $resSale->assertSee('Dưa leo Sale');
    $resSale->assertDontSee('Cà chua Cherry Organic');

    // Filter in_stock=1
    $resStock = $this->get(route('products.index', ['in_stock' => 1]));
    $resStock->assertStatus(200);
});

it('renders product detail page with all agricultural components without duplicate description', function () {
    $cat = Category::create([
        'name' => 'Món sơ chế sẵn (Ready-to-cook)',
        'slug' => 'mon-so-che-san-ready-to-cook',
    ]);

    $product = Product::create([
        'category_id' => $cat->id,
        'name' => 'Khay Canh Chua Cá Hồi Sơ Chế',
        'slug' => 'khay-canh-chua-ca-hoi-so-che',
        'sku' => 'MM-RTC-0141',
        'base_price' => 95000,
        'origin' => 'Bếp Trung Tâm MiniMart',
        'stock' => 15,
        'is_active' => true,
        'description' => 'Khay nguyên liệu canh chua cá hồi phi lê tươi ngon, tặng kèm gói nước cốt me.',
    ]);

    ProductVariant::create([
        'product_id' => $product->id,
        'sku' => 'MM-RTC-0141-VAR',
        'name' => 'Khay 500g',
        'price' => 95000,
        'stock_quantity' => 15,
        'is_active' => true,
    ]);

    $response = $this->get(route('products.show', $product->slug));
    $response->assertStatus(200);
    $response->assertSee('Minh Bạch Nguồn Gốc');
    $response->assertSee('Hướng Dẫn Nấu Nhanh (Ready-to-Cook)');
    $response->assertSee('Giá Trị Dinh Dưỡng Ước Tính');
    $response->assertSee('Cam Kết Chuẩn Sạch');
    $response->assertSee('Thêm vào giỏ');
});

it('supports batch combo cart addition and backward compatible single item addition', function () {
    $cat = Category::create([
        'name' => 'Rau củ hữu cơ',
        'slug' => 'rau-cu-huu-co',
    ]);

    $p1 = Product::create([
        'category_id' => $cat->id,
        'name' => 'Sản phẩm 1',
        'slug' => 'san-pham-1',
        'base_price' => 50000,
        'is_active' => true,
    ]);
    $v1 = ProductVariant::create([
        'product_id' => $p1->id,
        'sku' => 'VAR-1',
        'name' => 'Gói 1',
        'price' => 50000,
        'stock_quantity' => 10,
        'is_active' => true,
    ]);

    $p2 = Product::create([
        'category_id' => $cat->id,
        'name' => 'Sản phẩm 2',
        'slug' => 'san-pham-2',
        'base_price' => 60000,
        'is_active' => true,
    ]);
    $v2 = ProductVariant::create([
        'product_id' => $p2->id,
        'sku' => 'VAR-2',
        'name' => 'Gói 2',
        'price' => 60000,
        'stock_quantity' => 10,
        'is_active' => true,
    ]);

    // 1. Combo batch add
    $resBatch = $this->post(route('cart.add'), [
        'items' => [
            ['variant_id' => $v1->id, 'quantity' => 1],
            ['variant_id' => $v2->id, 'quantity' => 2],
        ],
    ]);
    $resBatch->assertSessionHas('success');

    // 2. Single item add (backward compatible)
    $resSingle = $this->post(route('cart.add'), [
        'variant_id' => $v1->id,
        'quantity' => 1,
    ]);
    $resSingle->assertSessionHas('success');
});
