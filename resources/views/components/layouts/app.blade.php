<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'MiniMart' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-surface text-on-surface font-body-lg min-h-screen flex flex-col relative" x-data="{ mobileMenuOpen: false, megaMenuOpen: false }">
    <!-- Ambient Background -->
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    
    <!-- Header (2 Rows) -->
    <header class="fixed top-0 w-full z-50 bg-white/35 backdrop-blur-[40px] saturate-[180%] border-t-[1.5px] border-white/80 border-b-[1px] border-white/30 shadow-xl transition-all">
        <!-- Row 1: Top Bar -->
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 py-2 border-b border-outline-variant/30">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="font-display-lg text-display-lg font-extrabold text-primary dark:text-primary-fixed-dim">
                MiniMart
            </a>
            
            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-xl mx-8 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <form action="{{ route('products.search') }}" method="GET" class="w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm, danh mục..." class="w-full pl-10 pr-4 py-2 bg-white/60 backdrop-blur-md border border-outline-variant rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg text-sm transition-all shadow-sm">
                </form>
            </div>

            <!-- Icons -->
            <div class="flex gap-4 items-center">
                @auth
                    <a href="{{ route('account.orders') }}" class="text-sm font-semibold text-primary hover:text-secondary transition-colors" title="Đơn hàng">Tài khoản</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-green-900 hover:text-green-700">Đăng nhập / Đăng ký</a>
                @endauth
                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-primary hover:text-secondary transition-colors cursor-pointer lg:hidden">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="hidden lg:block text-primary hover:text-secondary transition-colors cursor-pointer" title="Danh mục">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>

        <!-- Row 2: Sub Nav (Mega Menu) -->
        <div class="hidden lg:flex items-center justify-center px-4 sm:px-6 lg:px-8 h-12 gap-8 relative">
            <div @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false" class="h-full flex items-center">
                <a href="{{ route('products.index') }}" class="font-label-md text-primary font-bold flex items-center gap-1 hover:text-secondary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">grid_view</span> Danh mục sản phẩm
                </a>
                <!-- Mega Menu Dropdown -->
                <div x-show="megaMenuOpen" x-transition.opacity class="absolute top-full left-0 w-full bg-white/95 backdrop-blur-xl shadow-2xl border-t border-outline-variant/30 p-8 grid grid-cols-4 gap-8">
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
            
            <a class="font-label-md text-on-surface hover:text-primary transition-colors" href="{{ route('posts.index') }}">Blog</a>
            <a class="font-label-md text-on-surface hover:text-primary transition-colors" href="#">Giới thiệu</a>
            <a class="font-label-md text-on-surface hover:text-primary transition-colors" href="#">Hệ thống cửa hàng</a>
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
                <a href="#" class="p-3 rounded-xl hover:bg-surface-variant text-on-surface transition-colors font-label-md">Giới thiệu</a>
                <a href="#" class="p-3 rounded-xl hover:bg-surface-variant text-on-surface transition-colors font-label-md">Hệ thống cửa hàng</a>
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
         class="fixed top-24 right-4 z-[100] bg-white border border-outline-variant shadow-2xl rounded-2xl p-4 w-80"
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
    <footer class="w-full bg-surface-container dark:bg-surface-container-highest border-t border-outline-variant mt-12 py-12">
        <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Cột 1: Liên hệ -->
            <div class="flex flex-col gap-4">
                <div class="font-display-lg text-primary text-2xl font-extrabold mb-2">MiniMart</div>
                <p class="text-on-surface-variant font-body-lg text-sm flex items-start gap-2">
                    <span class="material-symbols-outlined text-[18px] text-primary mt-0.5">location_on</span>
                    123 Nguyễn Huệ, Quận 1, TP.HCM
                </p>
                <p class="text-on-surface-variant font-body-lg text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-primary">call</span>
                    Hotline: 1900 1234
                </p>
                <p class="text-on-surface-variant font-body-lg text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-primary">mail</span>
                    support@minimart.vn
                </p>
            </div>

            <!-- Cột 2: Về MiniMart -->
            <div class="flex flex-col gap-4">
                <h3 class="font-label-md text-label-md text-on-surface font-bold mb-2">Về MiniMart</h3>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Giới thiệu</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Nguồn gốc nông sản</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Chứng nhận VietGAP/GlobalGAP</a>
            </div>

            <!-- Cột 3: Hỗ trợ khách hàng -->
            <div class="flex flex-col gap-4">
                <h3 class="font-label-md text-label-md text-on-surface font-bold mb-2">Hỗ trợ khách hàng</h3>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Chính sách đổi trả</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Chính sách giao hàng</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors font-body-lg text-sm">Câu hỏi thường gặp</a>
            </div>

            <!-- Cột 4: Mạng xã hội & Thanh toán -->
            <div class="flex flex-col gap-4">
                <h3 class="font-label-md text-label-md text-on-surface font-bold mb-2">Kết nối & Thanh toán</h3>
                <div class="flex items-center gap-4 mb-2">
                    <a href="#" class="w-10 h-10 rounded-full glass-tier-2 flex items-center justify-center hover:bg-primary/20 text-primary transition-colors">
                        <span class="font-bold">fb</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full glass-tier-2 flex items-center justify-center hover:bg-primary/20 text-primary transition-colors">
                        <span class="font-bold">tt</span>
                    </a>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <div class="px-3 py-1 glass-tier-1 rounded text-xs font-bold text-primary border border-primary/20">MoMo</div>
                    <div class="px-3 py-1 glass-tier-1 rounded text-xs font-bold text-primary border border-primary/20">VISA</div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-6 border-t border-outline-variant/30 text-center">
            <p class="text-on-surface-variant font-label-md text-xs opacity-80">© {{ date('Y') }} MiniMart Fresh. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
