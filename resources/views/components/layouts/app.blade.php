<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="color-scheme: light;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="only light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ $title ?? 'MiniMart - Thực phẩm sạch cho gia đình' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-green-50/50 via-white to-orange-50/30 text-gray-800 antialiased font-sans min-h-screen flex flex-col relative overflow-x-hidden" x-data="{ mobileMenuOpen: false, megaMenuOpen: false }">
    
    <!-- Header (2 Rows) -->
    <header class="fixed top-0 w-full z-50 bg-white/35 backdrop-blur-[40px] saturate-[180%] border-t-[1.5px] border-white/80 border-b-[1px] border-white/30 shadow-xl transition-all">
        <!-- Row 1: Top Bar -->
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 py-2 border-b border-outline-variant/30">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="font-display-lg text-display-lg font-extrabold text-primary dark:text-primary-fixed-dim">
                MiniMart
            </a>
            
            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-3xl mx-8 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px] z-10 pointer-events-none">search</span>
                <form action="{{ route('products.search') }}" method="GET" class="w-full relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm, danh mục..." class="w-full pl-10 pr-20 py-2.5 bg-white/60 backdrop-blur-md border border-outline-variant rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg text-sm transition-all shadow-sm">
                    <button type="submit" class="absolute right-1 top-1 bottom-1 bg-primary text-white px-4 rounded-full hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm font-bold text-sm flex items-center justify-center">Tìm</button>
                </form>
            </div>

            <!-- Auth & Menu -->
            <div class="flex items-center">
                @auth
                    <a href="{{ route('profile') }}" class="flex items-center text-sm font-semibold text-primary hover:text-secondary transition-colors" title="Đơn hàng">Tài khoản</a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-green-900 text-sm hover:text-green-700 transition-colors">Đăng nhập / Đăng ký</a>
                @endauth
                
                <div class="h-5 w-px bg-gray-300 mx-4"></div>
                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="font-bold text-green-900 text-sm tracking-wider hover:text-green-700 transition-colors">MENU</button>
            </div>
        </div>

        <!-- Row 2: Sub Nav (Mega Menu) -->
        <div class="hidden lg:flex items-center justify-center px-4 sm:px-6 lg:px-8 h-12 gap-8 relative">
            <a class="font-label-md transition-colors {{ request()->routeIs('home') ? 'text-green-700 font-bold' : 'text-gray-600 hover:text-green-700' }}" href="{{ route('home') }}">Trang chủ</a>
            <div @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false" class="h-full flex items-center">
                <a href="{{ route('products.index') }}" class="font-label-md flex items-center gap-1 transition-colors {{ request()->routeIs('products.*') ? 'text-green-700 font-bold' : 'text-gray-600 hover:text-green-700' }}">
                    <span class="material-symbols-outlined text-[18px]">grid_view</span> Danh mục sản phẩm
                </a>
                <!-- Mega Menu Dropdown -->
                <div x-show="megaMenuOpen" x-transition.opacity class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-[800px] bg-white/90 backdrop-blur-3xl shadow-2xl rounded-3xl p-8 z-50 grid grid-cols-4 gap-8">
                    @foreach(\App\Models\Category::take(4)->get() as $cat)
                        <div>
                            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="font-label-md font-bold text-primary mb-3 block hover:underline">{{ $cat->name }}</a>
                            <ul class="flex flex-col gap-2 font-body-lg text-sm text-on-surface-variant">
                                <li><a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="hover:text-primary transition-colors">Sản phẩm nổi bật</a></li>
                                <li><a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="hover:text-primary transition-colors">Hàng mới về</a></li>
                                <li><a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="hover:text-primary transition-colors">Khuyến mãi</a></li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <a class="font-label-md transition-colors {{ request()->routeIs('posts.*') ? 'text-green-700 font-bold' : 'text-gray-600 hover:text-green-700' }}" href="{{ route('posts.index') }}">Blog</a>
            <a class="font-label-md transition-colors {{ request()->routeIs('about') ? 'text-green-700 font-bold' : 'text-gray-600 hover:text-green-700' }}" href="{{ route('about') }}">Giới thiệu</a>
            <a class="font-label-md transition-colors {{ request()->routeIs('stores') ? 'text-green-700 font-bold' : 'text-gray-600 hover:text-green-700' }}" href="{{ route('stores') }}">Hệ thống cửa hàng</a>
        </div>
    </header>

    <!-- Off-canvas Sidebar -->
    <div x-show="mobileMenuOpen" class="fixed inset-0 z-[60] flex justify-end" style="display: none;">
        <div x-show="mobileMenuOpen" x-transition.opacity @click="mobileMenuOpen = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="relative w-80 max-w-full bg-surface h-full shadow-2xl flex flex-col p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-display-lg text-primary text-xl font-bold">Danh mục</h2>
                <button @click="mobileMenuOpen = false" class="text-on-surface-variant hover:text-error transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="flex-grow overflow-y-auto flex flex-col gap-2">
                @foreach(\App\Models\Category::all() as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="p-3 rounded-xl hover:bg-primary-container text-on-surface hover:text-on-primary-container transition-colors flex items-center justify-between">
                        <span class="font-label-md">{{ $cat->name }}</span>
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </a>
                @endforeach
                <hr class="my-4 border-outline-variant">
                <a href="{{ route('posts.index') }}" class="p-3 rounded-xl hover:bg-surface-variant text-on-surface transition-colors font-label-md">Blog & Tin tức</a>
                <a href="{{ route('about') }}" class="p-3 rounded-xl hover:bg-surface-variant text-on-surface transition-colors font-label-md">Giới thiệu</a>
                <a href="{{ route('stores') }}" class="p-3 rounded-xl hover:bg-surface-variant text-on-surface transition-colors font-label-md">Hệ thống cửa hàng</a>
            </div>
        </div>
    </div>
    
    <!-- Mini-Cart Toast -->
    <div x-data="{ showToast: false, toastData: {}, timeout: null }" 
         @cart-added.window="
            toastData = $event.detail;
            showToast = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => { showToast = false }, 4000);
         "
         x-show="showToast" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-10"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-10"
         class="fixed top-24 right-4 z-[100] bg-white/70 backdrop-blur-3xl border border-white/80 shadow-2xl ring-1 ring-white/50 rounded-3xl p-6 w-80"
         style="display: none;">
        
        <div class="flex items-start gap-4">
            <img :src="toastData.image" alt="" class="w-16 h-16 object-cover rounded-xl border border-outline-variant/30">
            <div class="flex-1">
                <div class="flex items-center gap-2 text-green-600 mb-1">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    <span class="font-label-md text-xs font-bold">Thêm thành công!</span>
                </div>
                <h4 class="font-label-md text-sm text-on-surface line-clamp-2" x-text="toastData.name"></h4>
                <div class="font-label-md text-primary mt-1 font-bold" x-text="toastData.price + 'đ'"></div>
            </div>
        </div>
        
        <div class="flex gap-2 mt-4 pt-3 border-t border-outline-variant/30">
            <a href="{{ route('cart.index') }}" class="flex-1 flex items-center justify-center gap-1 py-2 px-3 rounded-lg border border-primary text-primary hover:bg-primary-container transition-colors text-xs font-bold">
                <span class="material-symbols-outlined text-[16px]">visibility</span> Xem giỏ
            </a>
            <a href="{{ route('checkout.index') }}" class="flex-1 flex items-center justify-center gap-1 py-2 px-3 rounded-lg bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container transition-colors text-xs font-bold shadow-md">
                <span class="material-symbols-outlined text-[16px]">shopping_bag</span> Thanh toán
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <main class="pt-[140px] px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pb-12 w-full flex-grow">
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <footer class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 mt-20"> 
        <div class="bg-white/40 backdrop-blur-3xl border border-white/60 shadow-[0_-8px_40px_rgba(0,0,0,0.04)] rounded-[3rem] p-10 md:p-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Cột 1: Logo & Thông tin -->
                <div class="flex flex-col gap-3">
                    <div class="text-2xl font-extrabold text-green-800 mb-2">MiniMart</div>
                    <p class="text-gray-600 text-sm leading-relaxed">Hệ thống siêu thị mini cung cấp nông sản sạch, thực phẩm hữu cơ chất lượng cao cho gia đình Việt.</p>
                    <div class="mt-3 space-y-2">
                        <p class="text-gray-600 text-sm flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-green-600 mt-0.5 shrink-0">location_on</span>
                            123 Nguyễn Huệ, Quận 1, TP.HCM
                        </p>
                        <p class="text-gray-600 text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-green-600 shrink-0">call</span>
                            Hotline: 1900 1234
                        </p>
                        <p class="text-gray-600 text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-green-600 shrink-0">mail</span>
                            support@minimart.vn
                        </p>
                    </div>
                </div>

                <!-- Cột 2: Liên kết nhanh -->
                <div class="flex flex-col gap-3">
                    <h3 class="font-bold text-gray-900 mb-2">Liên kết nhanh</h3>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Trang chủ</a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Sản phẩm</a>
                    <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Blog & Tin tức</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Giới thiệu</a>
                    <a href="{{ route('stores') }}" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Hệ thống cửa hàng</a>
                </div>

                <!-- Cột 3: Chính sách & Hỗ trợ -->
                <div class="flex flex-col gap-3">
                    <h3 class="font-bold text-gray-900 mb-2">Chính sách & Hỗ trợ</h3>
                    <a href="#" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Chính sách đổi trả 24h</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Chính sách giao hàng</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Chính sách bảo mật</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Điều khoản sử dụng</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 transition-colors text-sm">Câu hỏi thường gặp</a>
                </div>

                <!-- Cột 4: Đăng ký nhận tin & MXH -->
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold text-gray-900 mb-2">Đăng ký nhận tin</h3>
                    <p class="text-gray-600 text-sm">Nhận thông tin khuyến mãi và sản phẩm mới nhất từ MiniMart.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Email của bạn" class="flex-1 px-4 py-2.5 rounded-full border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white">
                        <button class="px-4 py-2.5 bg-green-600 text-white rounded-full text-sm font-bold hover:bg-green-700 transition-colors shrink-0">Gửi</button>
                    </div>
                    <div class="mt-2">
                        <p class="text-gray-500 text-xs font-semibold mb-2">Theo dõi chúng tôi</p>
                        <div class="flex items-center gap-3">
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:text-green-700 hover:border-green-300 transition-colors text-xs font-bold">fb</a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:text-green-700 hover:border-green-300 transition-colors text-xs font-bold">tt</a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:text-green-700 hover:border-green-300 transition-colors text-xs font-bold">ig</a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:text-green-700 hover:border-green-300 transition-colors text-xs font-bold">yt</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="px-3 py-1 bg-white rounded border border-gray-200 text-xs font-bold text-gray-700">MoMo</div>
                        <div class="px-3 py-1 bg-white rounded border border-gray-200 text-xs font-bold text-gray-700">VISA</div>
                        <div class="px-3 py-1 bg-white rounded border border-gray-200 text-xs font-bold text-gray-700">COD</div>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-6 border-t border-gray-300/50 text-center">
                <p class="text-gray-500 text-xs">© {{ date('Y') }} MiniMart Fresh. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- IntersectionObserver: Fade-in scroll effect -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.product-card, .fade-item');
            elements.forEach(function(el) {
                el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-1000', 'ease-out');
            });
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            elements.forEach(function(el) { observer.observe(el); });
        });
    </script>
    
    <!-- Floating Cart Widget -->
    <div x-data="{ cartCount: 0 }" class="fixed bottom-8 right-8 z-50">
        <a href="{{ route('cart.index') }}" class="relative flex items-center justify-center w-16 h-16 bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.15)] ring-1 ring-white/50 rounded-[1.5rem] hover:scale-105 transition-transform">
            <span class="material-symbols-outlined text-[28px] text-green-900">shopping_cart</span>
            <span x-show="cartCount > 0" class="absolute -bottom-2 -right-2 bg-green-600 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full shadow-md border-2 border-white" x-text="cartCount"></span>
        </a>
    </div>

    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 600,
            easing: 'ease-out-cubic',
        });
    </script>
</body>
</html>
