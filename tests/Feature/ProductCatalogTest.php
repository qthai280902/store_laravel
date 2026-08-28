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
