<style>
    .sidebar-shell { 
        @apply fixed left-0 top-0 h-screen w-[260px] border-r border-white/70 bg-white/35 backdrop-blur-[40px] shadow-md z-50 flex flex-col py-8 px-4 transition-transform duration-300; 
    }
    @media (max-width: 767px) {
        .sidebar-shell { transform: translateX(-100%); }
        .sidebar-shell.is-open { transform: translateX(0); }
    }
</style>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" 
     x-transition.opacity 
     class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>

<nav class="sidebar-shell" :class="{'is-open': sidebarOpen}">
    <div class="mb-10 px-4 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-extrabold text-green-900 tracking-tight">MiniMart</h1>
            <p class="text-sm font-semibold text-gray-500 mt-1">Admin Panel</p>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden p-2 rounded-full hover:bg-white/50 text-gray-600">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <ul class="flex-1 space-y-2 overflow-y-auto pr-2 custom-scrollbar">
        @php
            $navItems = [
                ['name' => 'Tổng quan', 'icon' => 'dashboard', 'route' => 'admin.dashboard'],
                ['name' => 'Sản phẩm', 'icon' => 'inventory_2', 'route' => '#'],
                ['name' => 'Đơn hàng', 'icon' => 'receipt_long', 'route' => '#'],
                ['name' => 'Khách hàng', 'icon' => 'group', 'route' => '#'],
                ['name' => 'Khuyến mãi', 'icon' => 'local_offer', 'route' => '#'],
                ['name' => 'Đánh giá', 'icon' => 'star_rate', 'route' => '#'],
            ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isActive = request()->routeIs($item['route']);
            @endphp
            <li>
                <a href="{{ $item['route'] !== '#' ? route($item['route']) : '#' }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-r-full font-bold transition-all duration-200 {{ $isActive ? 'text-green-900 border-r-4 border-green-700 bg-white/40 shadow-sm' : 'text-gray-600 opacity-80 hover:bg-white/30 hover:text-green-800' }}">
                    <span class="material-symbols-outlined" style="{{ $isActive ? 'font-variation-settings: \'FILL\' 1;' : '' }}">{{ $item['icon'] }}</span>
                    <span class="text-sm">{{ $item['name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="mt-8 pt-4 border-t border-white/50 px-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full rounded-full text-red-600 font-bold opacity-80 hover:bg-red-50 hover:opacity-100 transition-all duration-200 text-left">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm">Đăng xuất</span>
            </button>
        </form>
    </div>
</nav>
