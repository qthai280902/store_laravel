<x-layouts.app title="Sản phẩm - MiniMart">
    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">
        <div class="pt-8 pb-12 w-full flex justify-center">
            <div class="bg-white/30 backdrop-blur-md border border-white/60 shadow-sm ring-1 ring-white/50 rounded-full px-12 py-4 fade-item opacity-0 translate-y-10 transition-all duration-1000 ease-out inline-block">
                <h1 class="text-3xl md:text-4xl font-extrabold text-green-900 text-center">Sản phẩm</h1>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-6">

        <!-- Left Sidebar Filters (Thin Glass) -->
        <aside class="col-span-1">
            <div class="bg-white/30 backdrop-blur-md border border-white/40 shadow-sm rounded-[2.5rem] p-6 sticky top-24 h-max">
                <h3 class="font-label-md text-label-md text-primary uppercase tracking-wider mb-4">Bộ lọc</h3>
                <!-- Category Filter -->
                <div class="mb-6">
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Danh mục</h4>
                    <ul class="space-y-2 font-body-lg text-body-lg text-on-surface-variant">
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input {{ !request('category') ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index') }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                                <span class="group-hover:text-primary transition-colors {{ !request('category') ? 'text-primary' : '' }}">Tất cả sản phẩm</span>
                            </label>
                        </li>
                        @foreach(\App\Models\Category::all() as $cat)
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index', ['category' => $cat->slug]) }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                                <span class="group-hover:text-primary transition-colors {{ request('category') == $cat->slug ? 'text-primary' : '' }}">{{ $cat->name }}</span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Price Filter -->
                <div class="mb-6">
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Khoảng giá</h4>
                    <div class="flex gap-2 items-center">
                        <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Từ" type="number"/>
                        <span class="text-on-surface-variant">-</span>
                        <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Đến" type="number"/>
                    </div>
                </div>
                <!-- Type Filter -->
                <div>
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Loại</h4>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-1.5 bg-primary-container text-on-primary-container font-label-md text-label-md rounded-full shadow-sm transition-transform active:scale-95">Hữu cơ</button>
                        <button class="px-4 py-1.5 glass-tier-2 text-on-surface font-label-md text-label-md rounded-full hover:bg-white/40 transition-all active:scale-95">Thông thường</button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Product Grid (9 columns) -->
        <div class="col-span-1 md:col-span-3 bg-transparent rounded-[2.5rem] p-4 sm:p-8">
            <div class="flex justify-end mb-6">
                <div class="relative" x-data="{ sortOpen: false }">
                    <button @click="sortOpen = !sortOpen" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-4 py-2 flex items-center gap-2 cursor-pointer">
                        <span class="font-label-md text-label-md text-on-surface">Sắp xếp</span>
                        <span class="material-symbols-outlined text-on-surface">expand_more</span>
                </button>
                <div x-show="sortOpen" @click.away="sortOpen = false" x-transition class="absolute right-0 bg-white shadow-xl rounded-xl mt-2 w-48 overflow-hidden border border-gray-100 z-50" style="display: none;">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Mới nhất</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Giá: Thấp đến Cao</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Giá: Cao đến Thấp</a>
                </div>
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div data-aos="fade-up">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-span-full glass-tier-2 rounded-3xl p-12 text-center">
                    <h3 class="text-2xl font-bold text-primary mb-2">Không tìm thấy sản phẩm</h3>
                    <p class="text-on-surface-variant">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @endforelse
        </div>
        
        @if($products->nextPageUrl())
        <div id="loadMoreBtn" data-next-page="{{ $products->nextPageUrl() }}" x-data x-intersect="$dispatch('trigger-load-more')" class="mt-12 mx-auto w-full flex items-center justify-center h-16">
            <span class="material-symbols-outlined animate-spin text-green-600 text-3xl" id="loadMoreSpinner" style="display: none;">autorenew</span>
        </div>
        @endif
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const productGrid = document.getElementById('product-grid');
            const loadMoreSpinner = document.getElementById('loadMoreSpinner');
            
            let isLoading = false;

            if (loadMoreBtn && productGrid) {
                window.addEventListener('trigger-load-more', function() {
                    if (isLoading) return;
                    const nextPageUrl = loadMoreBtn.getAttribute('data-next-page');
                    if (!nextPageUrl) return;

                    isLoading = true;
                    if(loadMoreSpinner) loadMoreSpinner.style.display = 'block';

                    fetch(nextPageUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const newGrid = doc.getElementById('product-grid');
                        if (newGrid) {
                            Array.from(newGrid.children).forEach(child => {
                                productGrid.appendChild(child.cloneNode(true));
                            });
                        }

                        const newLoadMoreBtn = doc.getElementById('loadMoreBtn');
                        if (newLoadMoreBtn) {
                            loadMoreBtn.setAttribute('data-next-page', newLoadMoreBtn.getAttribute('data-next-page'));
                            isLoading = false;
                            if(loadMoreSpinner) loadMoreSpinner.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'none';
                            loadMoreBtn.removeAttribute('data-next-page');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more products:', error);
<x-layouts.app title="Sản phẩm - MiniMart">
    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">
        <div class="pt-8 pb-12 w-full flex justify-center">
            <div class="bg-white/30 backdrop-blur-md border border-white/60 shadow-sm ring-1 ring-white/50 rounded-full px-12 py-4 fade-item opacity-0 translate-y-10 transition-all duration-1000 ease-out inline-block">
                <h1 class="text-3xl md:text-4xl font-extrabold text-green-900 text-center">Sản phẩm</h1>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-6">

        <!-- Left Sidebar Filters (Thin Glass) -->
        <aside class="col-span-1">
            <div class="bg-white/30 backdrop-blur-md border border-white/40 shadow-sm rounded-[2.5rem] p-6 sticky top-24 h-max">
                <h3 class="font-label-md text-label-md text-primary uppercase tracking-wider mb-4">Bộ lọc</h3>
                <!-- Category Filter -->
                <div class="mb-6">
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Danh mục</h4>
                    <ul class="space-y-2 font-body-lg text-body-lg text-on-surface-variant">
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input {{ !request('category') ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index') }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                                <span class="group-hover:text-primary transition-colors {{ !request('category') ? 'text-primary' : '' }}">Tất cả sản phẩm</span>
                            </label>
                        </li>
                        @foreach(\App\Models\Category::all() as $cat)
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index', ['category' => $cat->slug]) }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                                <span class="group-hover:text-primary transition-colors {{ request('category') == $cat->slug ? 'text-primary' : '' }}">{{ $cat->name }}</span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Price Filter -->
                <div class="mb-6">
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Khoảng giá</h4>
                    <div class="flex gap-2 items-center">
                        <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Từ" type="number"/>
                        <span class="text-on-surface-variant">-</span>
                        <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Đến" type="number"/>
                    </div>
                </div>
                <!-- Type Filter -->
                <div>
                    <h4 class="font-label-md text-label-md text-on-surface mb-3">Loại</h4>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-1.5 bg-primary-container text-on-primary-container font-label-md text-label-md rounded-full shadow-sm transition-transform active:scale-95">Hữu cơ</button>
                        <button class="px-4 py-1.5 glass-tier-2 text-on-surface font-label-md text-label-md rounded-full hover:bg-white/40 transition-all active:scale-95">Thông thường</button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Product Grid (9 columns) -->
        <div class="col-span-1 md:col-span-3 bg-transparent rounded-[2.5rem] p-4 sm:p-8">
            <div class="flex justify-end mb-6">
                <div class="relative" x-data="{ sortOpen: false }">
                    <button @click="sortOpen = !sortOpen" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-4 py-2 flex items-center gap-2 cursor-pointer">
                        <span class="font-label-md text-label-md text-on-surface">Sắp xếp</span>
                        <span class="material-symbols-outlined text-on-surface">expand_more</span>
                </button>
                <div x-show="sortOpen" @click.away="sortOpen = false" x-transition class="absolute right-0 bg-white shadow-xl rounded-xl mt-2 w-48 overflow-hidden border border-gray-100 z-50" style="display: none;">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Mới nhất</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Giá: Thấp đến Cao</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Giá: Cao đến Thấp</a>
                </div>
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div data-aos="fade-up">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-span-full glass-tier-2 rounded-3xl p-12 text-center">
                    <h3 class="text-2xl font-bold text-primary mb-2">Không tìm thấy sản phẩm</h3>
                    <p class="text-on-surface-variant">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @endforelse
        </div>
        
        @if($products->nextPageUrl())
        <div id="loadMoreBtn" data-next-page="{{ $products->nextPageUrl() }}" x-data x-intersect="$dispatch('trigger-load-more')" class="mt-12 mx-auto w-full flex items-center justify-center h-16">
            <span class="material-symbols-outlined animate-spin text-green-600 text-3xl" id="loadMoreSpinner" style="display: none;">autorenew</span>
        </div>
        @endif
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const productGrid = document.getElementById('product-grid');
            const loadMoreSpinner = document.getElementById('loadMoreSpinner');
            
            let isLoading = false;

            if (loadMoreBtn && productGrid) {
                window.addEventListener('trigger-load-more', function() {
                    if (isLoading) return;
                    const nextPageUrl = loadMoreBtn.getAttribute('data-next-page');
                    if (!nextPageUrl) return;

                    isLoading = true;
                    if(loadMoreSpinner) loadMoreSpinner.style.display = 'block';

                    fetch(nextPageUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const newGrid = doc.getElementById('product-grid');
                        if (newGrid) {
                            Array.from(newGrid.children).forEach(child => {
                                productGrid.appendChild(child.cloneNode(true));
                            });
                        }

                        const newLoadMoreBtn = doc.getElementById('loadMoreBtn');
                        if (newLoadMoreBtn) {
                            loadMoreBtn.setAttribute('data-next-page', newLoadMoreBtn.getAttribute('data-next-page'));
                            isLoading = false;
                            if(loadMoreSpinner) loadMoreSpinner.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'none';
                            loadMoreBtn.removeAttribute('data-next-page');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more products:', error);
                        isLoading = false;
                        if(loadMoreSpinner) loadMoreSpinner.style.display = 'none';
                    });
                });
            }
        });
    </script>
    </div>
</x-layouts.app>
