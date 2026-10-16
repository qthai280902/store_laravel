<x-layouts.app title="Sản phẩm Nông sản & Thực phẩm sạch - MiniMart">
    <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <nav class="flex items-center gap-2 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            @if(request('category'))
                <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 font-medium hover:shadow-sm" href="{{ route('products.index') }}">
                    Sản phẩm
                </a>
                <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                    {{ \App\Models\Category::where('slug', request('category'))->value('name') ?? request('category') }}
                </span>
            @else
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                    Tất cả sản phẩm sạch
                </span>
            @endif
        </nav>
    </div>

    <!-- Tiêu đề trang Pill Header Liquid Glass -->
    <div class="pt-4 pb-8 w-full flex justify-center">
        <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-full px-12 py-4 fade-item opacity-0 translate-y-10 transition-all duration-1000 ease-out inline-block">
            <h1 class="text-3xl md:text-4xl font-extrabold text-green-900 text-center">Nông Sản & Thực Phẩm Sạch</h1>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mt-4">

    <!-- Left Sidebar Filters (Liquid Glass V4 Chuyên Biệt Nông Sản) -->
    <aside class="col-span-1">
        <div class="bg-white/40 backdrop-blur-2xl border border-white/70 shadow-[0_12px_40px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-3xl p-6 sticky top-[130px] h-max max-h-[calc(100vh-160px)] overflow-y-auto custom-scrollbar space-y-6">
            
            <div class="flex items-center justify-between pb-3 border-b border-gray-200/60">
                <h3 class="font-bold text-sm text-green-950 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px] text-green-700">tune</span>
                    Bộ Lọc Nông Sản
                </h3>
                @if(request()->hasAny(['category', 'standard', 'freshness_type', 'on_sale', 'in_stock', 'search', 'sort']))
                    <a href="{{ route('products.index') }}" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-900 transition-colors">
                        Xóa tất cả
                    </a>
                @endif
            </div>

            <!-- 1. Danh mục Ngành hàng Nông sản -->
            <div x-data="{ catOpen: true }">
                <button @click="catOpen = !catOpen" type="button" class="w-full flex justify-between items-center cursor-pointer mb-2.5 outline-none group">
                    <h4 class="text-xs font-extrabold text-gray-800 uppercase tracking-wider group-hover:text-emerald-800 transition-colors">Danh Mục</h4>
                    <span class="material-symbols-outlined text-gray-400 text-sm transition-transform duration-300" :class="{'rotate-180': catOpen}">expand_more</span>
                </button>
                <div x-show="catOpen" x-collapse>
                    <ul class="space-y-1.5 text-xs text-gray-700 pb-1">
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ !request('category') ? 'bg-emerald-600 text-white font-bold shadow-xs' : 'hover:bg-white/70' }}">
                                <span>Tất cả ngành hàng</span>
                            </a>
                        </li>
                        @foreach(\App\Models\Category::where('is_active', true)->get() as $cat)
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['category' => $cat->slug]) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ request('category') == $cat->slug ? 'bg-emerald-600 text-white font-bold shadow-xs' : 'hover:bg-white/70' }}">
                                <span class="truncate">{{ $cat->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- 2. Tiêu chuẩn chất lượng (Standard) -->
            <div x-data="{ stdOpen: true }">
                <button @click="stdOpen = !stdOpen" type="button" class="w-full flex justify-between items-center cursor-pointer mb-2.5 outline-none group">
                    <h4 class="text-xs font-extrabold text-gray-800 uppercase tracking-wider group-hover:text-emerald-800 transition-colors">Tiêu Chuẩn</h4>
                    <span class="material-symbols-outlined text-gray-400 text-sm transition-transform duration-300" :class="{'rotate-180': stdOpen}">expand_more</span>
                </button>
                <div x-show="stdOpen" x-collapse>
                    <div class="flex flex-wrap gap-1.5 pb-1">
                        @php
                            $standards = [
                                'all' => 'Tất cả',
                                'vietgap' => 'VietGAP / GlobalGAP',
                                'organic' => 'Hữu cơ (Organic)',
                                'ocop' => 'Đặc sản (OCOP)',
                                'imported' => 'Nhập khẩu cao cấp',
                            ];
                            $activeStd = request('standard', 'all');
                        @endphp
                        @foreach($standards as $stdKey => $stdLabel)
                            <a href="{{ request()->fullUrlWithQuery(['standard' => $stdKey === 'all' ? null : $stdKey]) }}"
                               class="px-3 py-1.5 rounded-full text-xs transition-all {{ ($activeStd === $stdKey || ($stdKey === 'all' && !request('standard'))) ? 'bg-emerald-600 text-white font-bold shadow-xs' : 'bg-white/60 text-gray-700 hover:bg-white border border-white/80' }}">
                                {{ $stdLabel }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 3. Đặc tính & Tiện lợi (Freshness Type) -->
            <div x-data="{ freshOpen: true }">
                <button @click="freshOpen = !freshOpen" type="button" class="w-full flex justify-between items-center cursor-pointer mb-2.5 outline-none group">
                    <h4 class="text-xs font-extrabold text-gray-800 uppercase tracking-wider group-hover:text-emerald-800 transition-colors">Đặc Tính Sản Phẩm</h4>
                    <span class="material-symbols-outlined text-gray-400 text-sm transition-transform duration-300" :class="{'rotate-180': freshOpen}">expand_more</span>
                </button>
                <div x-show="freshOpen" x-collapse>
                    <div class="flex flex-wrap gap-1.5 pb-1">
                        @php
                            $freshTypes = [
                                'all' => 'Tất cả',
                                'fresh' => 'Tươi trong ngày',
                                'rtc' => 'Sơ chế sẵn (Nấu ngay)',
                                'dry' => 'Lương thực & Gia vị khô',
                            ];
                            $activeFresh = request('freshness_type', 'all');
                        @endphp
                        @foreach($freshTypes as $fKey => $fLabel)
                            <a href="{{ request()->fullUrlWithQuery(['freshness_type' => $fKey === 'all' ? null : $fKey]) }}"
                               class="px-3 py-1.5 rounded-full text-xs transition-all {{ ($activeFresh === $fKey || ($fKey === 'all' && !request('freshness_type'))) ? 'bg-emerald-600 text-white font-bold shadow-xs' : 'bg-white/60 text-gray-700 hover:bg-white border border-white/80' }}">
                                {{ $fLabel }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 4. Tùy chọn nhanh (Quick Toggles: Giảm giá & Còn hàng) -->
            <div class="pt-3 border-t border-gray-200/60 space-y-2">
                <h4 class="text-xs font-extrabold text-gray-800 uppercase tracking-wider mb-2">Tùy Chọn Nhanh</h4>
                
                <a href="{{ request()->fullUrlWithQuery(['on_sale' => request('on_sale') ? null : 1]) }}"
                   class="flex items-center justify-between p-2.5 rounded-xl border transition-all {{ request('on_sale') ? 'bg-red-50/80 border-red-200 text-red-700 font-bold' : 'bg-white/50 border-white/80 text-gray-700 hover:bg-white' }}">
                    <span class="flex items-center gap-1.5 text-xs">
                        <span class="material-symbols-outlined text-[16px] text-red-600">local_fire_department</span>
                        Đang giảm giá
                    </span>
                    <span class="w-4 h-4 rounded-full border flex items-center justify-center {{ request('on_sale') ? 'bg-red-600 border-red-600 text-white' : 'border-gray-300' }}">
                        @if(request('on_sale'))
                            <span class="material-symbols-outlined text-[12px]">check</span>
                        @endif
                    </span>
                </a>

                <a href="{{ request()->fullUrlWithQuery(['in_stock' => request('in_stock') ? null : 1]) }}"
                   class="flex items-center justify-between p-2.5 rounded-xl border transition-all {{ request('in_stock') ? 'bg-emerald-50/80 border-emerald-200 text-emerald-800 font-bold' : 'bg-white/50 border-white/80 text-gray-700 hover:bg-white' }}">
                    <span class="flex items-center gap-1.5 text-xs">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600">inventory_2</span>
                        Còn hàng sẵn kho
                    </span>
                    <span class="w-4 h-4 rounded-full border flex items-center justify-center {{ request('in_stock') ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-gray-300' }}">
                        @if(request('in_stock'))
                            <span class="material-symbols-outlined text-[12px]">check</span>
                        @endif
                    </span>
                </a>
            </div>

        </div>
    </aside>

    <!-- Product Grid (Cột Phải) -->
    <div class="col-span-1 md:col-span-4 bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 sm:p-8">
        
        <!-- Bar Sắp Xếp & Số lượng kết quả -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-gray-200/50">
            <div class="text-xs text-gray-500 font-medium">
                Hiển thị <strong class="text-gray-900 font-bold">{{ $products->total() }}</strong> sản phẩm nông sản sạch chất lượng cao
            </div>

            <div class="relative" x-data="{ sortOpen: false }">
                <button @click="sortOpen = !sortOpen" class="bg-white/70 hover:bg-white/95 backdrop-blur-xl border border-white/80 shadow-xs text-emerald-950 rounded-full transition-all px-4 py-2 flex items-center gap-2 cursor-pointer">
                    <span class="text-xs font-bold text-gray-800">
                        @php
                            $sortLabels = [
                                'price_asc' => 'Giá: Thấp đến Cao',
                                'price_desc' => 'Giá: Cao đến Thấp',
                                'name_asc' => 'Tên: A - Z',
                                'default' => 'Mới nhất',
                            ];
                            $currentSort = request('sort', 'default');
                        @endphp
                        Sắp xếp: {{ $sortLabels[$currentSort] ?? 'Mới nhất' }}
                    </span>
                    <span class="material-symbols-outlined text-gray-500 text-[18px]">expand_more</span>
                </button>
                <div x-show="sortOpen" @click.away="sortOpen = false" x-transition class="absolute right-0 bg-white/90 backdrop-blur-2xl border border-white/80 shadow-[0_12px_40px_rgba(0,0,0,0.12)] ring-1 ring-white/50 rounded-2xl mt-2 w-52 overflow-hidden z-50 p-1.5" style="display: none;">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="block px-3.5 py-2 text-xs text-gray-700 hover:text-emerald-800 hover:bg-white rounded-xl transition-all font-medium {{ !request('sort') ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">Mới nhất</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" class="block px-3.5 py-2 text-xs text-gray-700 hover:text-emerald-800 hover:bg-white rounded-xl transition-all font-medium {{ request('sort') === 'price_asc' ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">Giá: Thấp đến Cao</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" class="block px-3.5 py-2 text-xs text-gray-700 hover:text-emerald-800 hover:bg-white rounded-xl transition-all font-medium {{ request('sort') === 'price_desc' ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">Giá: Cao đến Thấp</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" class="block px-3.5 py-2 text-xs text-gray-700 hover:text-emerald-800 hover:bg-white rounded-xl transition-all font-medium {{ request('sort') === 'name_asc' ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">Tên: A - Z</a>
                </div>
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div data-aos="fade-up">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-span-full rounded-3xl p-12 text-center bg-white/40 border border-white/60">
                    <span class="material-symbols-outlined text-5xl text-gray-400 mb-3">search_off</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Không tìm thấy sản phẩm phù hợp</h3>
                    <p class="text-xs text-gray-500 mb-4">Vui lòng thử điều chỉnh lại bộ lọc hoặc tìm kiếm với từ khóa khác.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full bg-emerald-600 text-white font-bold text-xs shadow-sm hover:bg-emerald-700 transition-all">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        Xóa tất cả bộ lọc
                    </a>
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
            const requestedPages = new Set();

            if (loadMoreBtn && productGrid) {
                window.addEventListener('trigger-load-more', function() {
                    if (isLoading) return;
                    const nextPageUrl = loadMoreBtn.getAttribute('data-next-page');
                    if (!nextPageUrl || requestedPages.has(nextPageUrl)) return;

                    isLoading = true;
                    requestedPages.add(nextPageUrl);
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
                            // Extract existing product links in grid to avoid any duplicate card
                            const existingCardLinks = new Set(
                                Array.from(productGrid.querySelectorAll('a[href*="/products/"]')).map(a => a.getAttribute('href'))
                            );

                            Array.from(newGrid.children).forEach(child => {
                                const cardLink = child.querySelector('a[href*="/products/"]')?.getAttribute('href');
                                if (!cardLink || !existingCardLinks.has(cardLink)) {
                                    productGrid.appendChild(child.cloneNode(true));
                                    if (cardLink) existingCardLinks.add(cardLink);
                                }
                            });
                        }

                        const newLoadMoreBtn = doc.getElementById('loadMoreBtn');
                        if (newLoadMoreBtn && newLoadMoreBtn.getAttribute('data-next-page')) {
                            const newNextUrl = newLoadMoreBtn.getAttribute('data-next-page');
                            if (newNextUrl !== nextPageUrl) {
                                loadMoreBtn.setAttribute('data-next-page', newNextUrl);
                            } else {
                                loadMoreBtn.style.display = 'none';
                                loadMoreBtn.removeAttribute('data-next-page');
                            }
                            isLoading = false;
                            if(loadMoreSpinner) loadMoreSpinner.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'none';
                            loadMoreBtn.removeAttribute('data-next-page');
                            isLoading = false;
                            if(loadMoreSpinner) loadMoreSpinner.style.display = 'none';
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
</x-layouts.app>
