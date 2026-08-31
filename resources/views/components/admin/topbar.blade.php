<style>
    .topbar-shell { 
        @apply fixed top-0 right-0 md:left-[260px] left-0 h-16 border-b border-white/90 bg-white/35 backdrop-blur-[40px] shadow-sm z-30 flex justify-between items-center px-4 md:px-8 transition-all duration-300; 
    }
</style>

<header class="topbar-shell">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-full hover:bg-white/50 text-gray-700 transition-colors">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <!-- Search (Admin) -->
        <div class="hidden lg:flex items-center bg-white/60 backdrop-blur-md rounded-xl border border-gray-200 px-4 py-2 w-72 shadow-sm transition-all focus-within:ring-2 focus-within:ring-green-500 focus-within:bg-white">
            <span class="material-symbols-outlined text-gray-400 mr-2 text-[20px]">search</span>
            <input type="text" placeholder="Tìm kiếm trong Admin..." class="bg-transparent border-none outline-none text-gray-800 w-full text-sm placeholder-gray-400 focus:ring-0 p-0 h-5" />
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-4 text-green-900">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 hover:bg-white/50 px-3 py-1.5 rounded-full transition-colors text-sm font-semibold">
            <span class="material-symbols-outlined text-[20px]">storefront</span>
            <span class="hidden sm:inline">Xem Cửa Hàng</span>
        </a>
        
        <div class="h-6 w-[1px] bg-gray-300 mx-2"></div>
        
        <button class="relative p-2 rounded-full hover:bg-white/50 transition-colors">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
        </button>
        
        <div class="flex items-center gap-3 ml-2 pl-2 border-l border-white/50 cursor-pointer hover:bg-white/40 p-1.5 pr-4 rounded-full transition-colors">
            <div class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center text-green-800 font-bold border border-white/80 shadow-sm">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-bold leading-tight">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-500">Quản trị viên</p>
            </div>
            <span class="material-symbols-outlined text-gray-400 text-[20px]">expand_more</span>
        </div>
    </div>
</header>
