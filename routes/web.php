<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckAdminRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Payment Webhook
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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::view('/gioi-thieu', 'about')->name('about');
Route::view('/he-thong-cua-hang', 'stores')->name('stores');

// Policy & Support Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/chinh-sach-doi-tra', 'returnPolicy')->name('pages.return-policy');
    Route::get('/chinh-sach-giao-hang', 'shippingPolicy')->name('pages.shipping-policy');
    Route::get('/chinh-sach-bao-mat', 'privacyPolicy')->name('pages.privacy-policy');
    Route::get('/dieu-khoan-su-dung', 'terms')->name('pages.terms');
    Route::get('/cau-hoi-thuong-gap', 'faq')->name('pages.faq');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

    Route::middleware(['auth', CheckAdminRole::class])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    });
});
