<x-layouts.app title="Tìm kiếm: {{ request('search') }} - MiniMart">
    <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
    <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
        <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Trang chủ
        </a>
        <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
        <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 font-medium hover:shadow-sm" href="{{ route('products.index') }}">
            Sản phẩm
        </a>
        <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
        <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
            Tìm kiếm: "{{ request('search') }}"
        </span>
    </nav>

    <!-- Search Header -->
    <header class="mb-12 mt-2">
        <h1 class="font-headline-lg text-headline-lg md:font-display-lg md:text-display-lg text-primary mb-2 break-words">
            "{{ request('search') }}"
        </h1>
        <p class="font-label-md text-label-md text-on-surface-variant">
            Hiển thị {{ $products->total() }} kết quả
        </p>
        
        <form action="{{ route('products.search') }}" method="GET" class="mt-6 max-w-md">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input class="w-full solid-input text-on-surface py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" name="search" placeholder="Tìm kiếm sản phẩm..." type="text" value="{{ request('search') }}"/>
            </div>
        </form>
    </header>

    <!-- Filter Bar -->
    <div class="flex gap-4 mb-8 overflow-x-auto pb-4 hide-scrollbar">
        <button class="px-6 py-2 rounded-full bg-primary-container text-on-primary-container font-label-md text-label-md whitespace-nowrap">
            Tất cả kết quả
        </button>
        <button class="px-6 py-2 rounded-full glass-tier-2 text-on-surface hover:bg-white/40 transition-colors font-label-md text-label-md whitespace-nowrap">
            Sản phẩm tươi
        </button>
        <button class="px-6 py-2 rounded-full glass-tier-2 text-on-surface hover:bg-white/40 transition-colors font-label-md text-label-md whitespace-nowrap flex items-center gap-2">
            Giá <span class="material-symbols-outlined text-[18px]">keyboard_arrow_down</span>
        </button>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-full glass-tier-2 rounded-3xl p-12 text-center">
                <h3 class="text-2xl font-bold text-primary mb-2">Không tìm thấy sản phẩm</h3>
                <p class="text-on-surface-variant">Thử lại với từ khóa khác nhé.</p>
            </div>
        @endforelse

        <div class="col-span-full mt-8">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</x-layouts.app>
