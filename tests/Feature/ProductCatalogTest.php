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
