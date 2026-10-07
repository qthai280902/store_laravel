<x-layouts.app title="Tin tức & Mẹo vặt - MiniMart Blog">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Top Breadcrumb Trail (Liquid Glass Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            @if(request('category'))
                <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 font-medium hover:shadow-sm" href="{{ route('posts.index') }}">
                    Góc ẩm thực &amp; Mẹo vặt
                </a>
                <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                    {{ request('category') }}
                </span>
            @elseif(request('search'))
                <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 font-medium hover:shadow-sm" href="{{ route('posts.index') }}">
                    Góc ẩm thực &amp; Mẹo vặt
                </a>
                <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                    Tìm kiếm: "{{ request('search') }}"
                </span>
            @else
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                    Góc ẩm thực &amp; Mẹo vặt
                </span>
            @endif
        </nav>

        <!-- Editorial Page Header Banner (Apple Liquid Glass) -->
        <section class="relative rounded-[28px] overflow-hidden bg-white/35 backdrop-blur-[40px] saturate-[180%] border border-white/70 p-8 md:p-12 shadow-xl mb-10">
            <div class="relative z-10 max-w-3xl flex flex-col gap-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 border border-emerald-200/60 text-emerald-900 w-fit text-xs font-bold shadow-xs">
                    <span class="material-symbols-outlined text-[16px] text-emerald-700">menu_book</span>
                    Chuyên mục Blog MiniMart
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-green-950 tracking-tight">
                    Tin tức &amp; Mẹo vặt
                </h1>
                <p class="text-gray-700 text-base md:text-lg leading-relaxed max-w-2xl font-normal">
                    Bí quyết nấu ăn ngon, cẩm nang dinh dưỡng cân bằng và mẹo bảo quản nông sản tươi mát suốt tuần được chia sẻ độc quyền từ đội ngũ nông trại MiniMart.
                </p>
            </div>
            <!-- Ambient Glass Accent Flares -->
            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute right-32 -top-12 w-48 h-48 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>
        </section>

        <!-- Featured Article (Hero Spotlight - Chỉ hiển thị trang 1, không có tìm kiếm hay lọc danh mục) -->
        @if($featuredPost)
            <article class="relative rounded-[28px] overflow-hidden bg-white/40 backdrop-blur-[40px] saturate-[180%] border border-white/80 shadow-[0_12px_40px_rgba(0,0,0,0.06)] ring-1 ring-white/50 mb-12 group transition-all duration-300">
                <!-- Hero Image Shell -->
                <div class="relative h-[320px] sm:h-[400px] md:h-[460px] w-full overflow-hidden bg-gray-100">
                    <img class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" 
                         src="{{ $featuredPost->image_url }}" 
                         alt="{{ $featuredPost->title }}"
                         onerror="this.src='https://placehold.co/1200x600/f0fdf4/166534?text=MiniMart+Blog'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
                    
                    <!-- Overlaid Floating Badges -->
                    <div class="absolute bottom-6 left-6 right-6 flex flex-wrap items-center justify-between gap-3 z-10">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3.5 py-1.5 rounded-full bg-white/80 backdrop-blur-md border border-white/80 text-emerald-950 font-bold text-xs shadow-sm">
                                {{ $featuredPost->category }}
                            </span>
                            <span class="px-3.5 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/80 text-gray-800 font-medium text-xs flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[15px]">schedule</span>
                                {{ $featuredPost->read_time ?? '5 phút đọc' }}
                            </span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-emerald-700/90 backdrop-blur-md text-white font-bold text-xs shadow-md border border-emerald-500/30">
                            Tiêu điểm tuần này
                        </span>
                    </div>
                </div>
                
                <!-- Solid High-Contrast Editorial Content Floor -->
                <div class="bg-white/80 backdrop-blur-2xl p-6 sm:p-8 md:p-10 flex flex-col gap-4 border-t border-white/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-800 font-bold text-sm shadow-xs">
                            {{ strtoupper(mb_substr($featuredPost->author_name ?? 'MM', 0, 2)) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-900">{{ $featuredPost->author_name ?? 'MiniMart Team' }}</span>
                            <span class="text-xs text-gray-500">{{ $featuredPost->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('posts.show', $featuredPost->slug) }}" class="group/title">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-green-950 tracking-tight group-hover/title:text-emerald-700 transition-colors leading-snug">
                            {{ $featuredPost->title }}
                        </h2>
                    </a>
                    
                    <p class="text-gray-600 text-base md:text-lg line-clamp-2 leading-relaxed">
                        {{ strip_tags($featuredPost->content) }}
                    </p>
                    
                    <div class="pt-3 flex flex-wrap items-center justify-between gap-4 border-t border-gray-100/80">
                        <a href="{{ route('posts.show', $featuredPost->slug) }}" 
                           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-md transition-all">
                            Đọc toàn bộ bài viết
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        
                        <div class="flex items-center gap-4 text-gray-500 text-sm">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px] text-emerald-600">visibility</span>
                                1.2k lượt xem
                            </span>
                        </div>
                    </div>
                </div>
            </article>
        @endif

        <!-- Filter Pills & Search Control Deck -->
        <section class="mb-10 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <!-- Category Filter Chips -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 no-scrollbar">
                <a href="{{ route('posts.index') }}" 
                   class="whitespace-nowrap px-5 py-2.5 rounded-full text-sm font-bold transition-all shadow-xs {{ empty($selectedCategory) ? 'bg-emerald-800 text-white shadow-md' : 'bg-white/50 backdrop-blur-md border border-white/70 text-gray-700 hover:bg-white/80' }}">
                    Tất cả bài viết
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('posts.index', ['category' => $cat]) }}" 
                       class="whitespace-nowrap px-5 py-2.5 rounded-full text-sm font-medium transition-all shadow-xs {{ $selectedCategory === $cat ? 'bg-emerald-800 text-white font-bold shadow-md' : 'bg-white/50 backdrop-blur-md border border-white/70 text-gray-700 hover:bg-white/80' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
            
            <!-- Blog Search Filter Input -->
            <form action="{{ route('posts.index') }}" method="GET" class="relative w-full lg:w-72 flex-shrink-0">
                @if($selectedCategory)
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <div class="flex items-center bg-white/70 backdrop-blur-md border border-white/80 rounded-full px-4 py-2 shadow-xs focus-within:ring-2 focus-within:ring-emerald-600 transition-all">
                    <span class="material-symbols-outlined text-gray-400 mr-2 text-[20px]">search</span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm bài viết, mẹo vặt..." class="bg-transparent border-none outline-none text-gray-800 text-sm w-full placeholder-gray-400 focus:ring-0 p-0 h-6">
                    @if($search)
                        <a href="{{ route('posts.index', $selectedCategory ? ['category' => $selectedCategory] : []) }}" class="text-gray-400 hover:text-gray-600">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <!-- Responsive Articles Grid (1 col mobile, 2 cols tablet, 3 cols desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse($posts as $post)
                <article class="flex flex-col rounded-[24px] overflow-hidden bg-white/40 backdrop-blur-2xl border border-white/60 shadow-[0_10px_30px_rgba(0,0,0,0.05)] ring-1 ring-white/50 hover:bg-white/60 hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1.5 transition-all duration-300 group">
                    <!-- Card Image Shell -->
                    <div class="relative h-52 w-full overflow-hidden bg-gray-100">
                        <img src="{{ $post->image_url }}" 
                             alt="{{ $post->title }}" 
                             onerror="this.src='https://placehold.co/800x600/f0fdf4/166534?text=MiniMart+Blog'"
                             class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                        
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-white/90 backdrop-blur-md border border-white/90 text-emerald-900 font-bold text-xs shadow-sm">
                            {{ $post->category }}
                        </span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-6 flex flex-col flex-1 justify-between gap-4 bg-white/70 backdrop-blur-md">
                        <div class="flex flex-col gap-2.5">
                            <div class="flex items-center gap-3 text-xs text-gray-500 font-medium">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                                    {{ $post->created_at->format('d/m/Y') }}
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px]">schedule</span>
                                    {{ $post->read_time ?? '4 phút đọc' }}
                                </span>
                            </div>
                            
                            <a href="{{ route('posts.show', $post->slug) }}" class="group-hover:text-emerald-700 transition-colors">
                                <h3 class="text-lg md:text-xl font-bold text-gray-900 line-clamp-2 leading-snug">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            
                            <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">
                                {{ strip_tags($post->content) }}
                            </p>
                        </div>
                        
                        <!-- Card Footer -->
                        <div class="pt-3 border-t border-gray-100/80 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-800 font-bold text-xs">
                                    {{ strtoupper(mb_substr($post->author_name ?? 'M', 0, 1)) }}
                                </div>
                                <span class="text-xs font-semibold text-gray-700 truncate max-w-[120px]">{{ $post->author_name ?? 'MiniMart' }}</span>
                            </div>
                            
                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:text-emerald-900 group-hover:translate-x-1 transition-all">
                                Đọc tiếp
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-16 text-center bg-white/40 backdrop-blur-2xl border border-white/60 rounded-3xl p-8 shadow-sm">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-3 block">menu_book</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Không tìm thấy bài viết phù hợp</h3>
                    <p class="text-gray-500 text-sm mb-6">Thử chọn danh mục khác hoặc quay lại danh sách tất cả bài viết.</p>
                    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-emerald-700 text-white font-bold text-sm shadow-md hover:bg-emerald-800 transition-colors">
                        Xem tất cả bài viết
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
</x-layouts.app>
