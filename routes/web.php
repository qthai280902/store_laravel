<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Payment Webhook (should be excluded from CSRF if needed, we'll configure that in bootstrap)
Route::post('/payment/momo-webhook', [PaymentController::class, 'momoWebhook'])->name('payment.momo-webhook');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{variantId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{variantId}', [CartController::class, 'remove'])->name('cart.remove');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'place'])->name('checkout.place');
    Route::get('/checkout/success/{order}', [OrderController::class, 'success'])->name('checkout.success');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
});

use App\Http\Controllers\PostController;
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::view('/gioi-thieu', 'about')->name('about');
Route::view('/he-thong-cua-hang', 'stores')->name('stores');

