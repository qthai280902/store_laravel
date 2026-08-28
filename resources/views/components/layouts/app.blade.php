<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'MiniMart' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-on-surface font-body-lg text-body-lg">
    <!-- Ambient Background -->
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    
    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-4 sm:px-6 lg:px-8 h-20 bg-white/35 backdrop-blur-[40px] saturate-[180%] border-t-[1.5px] border-white/80 border-b-[1px] border-white/30 shadow-xl">
        <a href="{{ route('home') }}" class="font-display-lg text-display-lg font-extrabold text-primary dark:text-primary-fixed-dim">
            MiniMart
        </a>
        
        <!-- Search -->
        <div class="hidden md:flex flex-1 max-w-md mx-8 relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <form action="{{ route('products.search') }}" method="GET" class="w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..." class="w-full pl-10 pr-4 py-2 bg-white/50 backdrop-blur-md border border-outline-variant rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg text-sm transition-all">
            </form>
        </div>

        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="{{ route('products.index') }}">Danh mục</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="{{ route('products.index', ['category' => 'trai-cay-nhap-khau']) }}">Trái cây</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="{{ route('products.index', ['category' => 'rau-cu-huu-co']) }}">Rau củ</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="{{ route('posts.index') }}">Blog</a>
        </div>
        
        <div class="flex gap-4 items-center">
            <a href="{{ route('cart.index') }}" class="relative text-primary dark:text-primary-fixed-dim hover:text-primary transition-colors duration-200">
                <span class="material-symbols-outlined">shopping_cart</span>
                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-secondary-container rounded-full"></span>
                @endif
            </a>
            @auth
                <a href="{{ route('account.orders') }}" class="text-primary dark:text-primary-fixed-dim hover:text-primary transition-colors duration-200" title="Đơn hàng">
                    <span class="material-symbols-outlined">person</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-error hover:text-error-container transition-colors duration-200" title="Đăng xuất">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-primary dark:text-primary-fixed-dim hover:text-primary transition-colors duration-200">
                    <span class="material-symbols-outlined">login</span>
                </a>
            @endauth
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="pt-[120px] px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pb-12 w-full">
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
