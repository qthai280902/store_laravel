<!DOCTYPE html>
<html class="light" lang="en">
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
    <nav class="fixed top-0 left-0 w-full z-40 flex justify-between items-center px-gutter max-w-max_width mx-auto h-20 bg-white/35 backdrop-blur-[40px] saturate-[180%] border-t-[1.5px] border-white/80 border-x-[1px] border-b-[1px] border-white/30 shadow-xl docked full-width top-0">
        <a href="{{ route('home') }}" class="font-display-lg text-display-lg font-extrabold text-primary dark:text-primary-fixed-dim">
            MiniMart
        </a>
        
        <!-- Search -->
        <div class="hidden md:flex flex-1 max-w-md mx-8 relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <form action="{{ route('products.search') }}" method="GET" class="w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 bg-white/50 backdrop-blur-md border border-outline-variant rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg text-sm transition-all">
            </form>
        </div>

        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="{{ route('products.index') }}">Categories</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="#">Deals</a>
            <a class="text-primary border-b-2 border-primary pb-1 font-bold scale-95 transition-transform hover:text-primary transition-colors duration-200" href="#">Fresh</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="#">Organic</a>
        </div>
        
        <div class="flex gap-4 items-center">
            <a href="{{ route('cart.index') }}" class="relative text-primary dark:text-primary-fixed-dim hover:text-primary transition-colors duration-200">
                <span class="material-symbols-outlined">shopping_cart</span>
                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-secondary-container rounded-full"></span>
                @endif
            </a>
            @auth
                <a href="{{ route('account.orders') }}" class="text-primary dark:text-primary-fixed-dim hover:text-primary transition-colors duration-200" title="My Orders">
                    <span class="material-symbols-outlined">person</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-error hover:text-error-container transition-colors duration-200" title="Logout">
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
    <main class="pt-[120px] px-gutter max-w-max_width mx-auto pb-margin_desktop">
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <footer class="w-full py-margin_desktop px-gutter flex flex-col md:flex-row justify-between items-start max-w-max_width mx-auto bg-surface-container dark:bg-surface-container-highest border-t border-outline-variant full-width bottom-0">
        <div class="mb-6 md:mb-0">
            <div class="font-headline-lg text-primary mb-2 text-headline-lg">MiniMart</div>
            <p class="text-on-surface-variant font-label-md text-label-md opacity-80 hover:opacity-100">© {{ date('Y') }} MiniMart Fresh. All rights reserved.</p>
        </div>
        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
            <a class="text-on-surface-variant hover:text-secondary transition-colors font-label-md text-label-md opacity-80 hover:opacity-100" href="#">About Us</a>
            <a class="text-on-surface-variant hover:text-secondary transition-colors font-label-md text-label-md opacity-80 hover:opacity-100" href="#">Sustainability</a>
            <a class="text-on-surface-variant hover:text-secondary transition-colors font-label-md text-label-md opacity-80 hover:opacity-100" href="#">Store Locator</a>
            <a class="text-on-surface-variant hover:text-secondary transition-colors font-label-md text-label-md opacity-80 hover:opacity-100" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant hover:text-secondary transition-colors font-label-md text-label-md opacity-80 hover:opacity-100" href="#">Contact</a>
        </div>
    </footer>
</body>
</html>
