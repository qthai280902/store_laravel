<x-layouts.app title="{{ $post->title }} - MiniMart Blog">
    <!-- Top Reading Progress Indicator (from Design Template) -->
    <div class="fixed top-0 left-0 w-full h-[3.5px] bg-transparent z-50 pointer-events-none">
        <div class="h-full bg-emerald-600 transition-[width] duration-150 ease-out" id="readingProgressBar" style="width: 0%;"></div>
    </div>

    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 font-medium hover:shadow-sm" href="{{ route('posts.index') }}">
                Góc ẩm thực &amp; Mẹo vặt
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate max-w-xs md:max-w-md shadow-xs">
                {{ $post->title }}
            </span>
        </nav>

        <!-- Central Liquid Glass Pane (Phiến kính trung tâm nguyên khối) -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 sm:p-10 md:p-12 space-y-10 relative overflow-hidden">
            
            <!-- Hero Image Banner -->
            <section class="relative w-full h-[320px] sm:h-[400px] md:h-[460px] rounded-[2rem] overflow-hidden shadow-xl bg-gray-100 group">
                <img class="w-full h-full object-cover select-none transition-transform duration-700 ease-out group-hover:scale-102" 
                     src="{{ $post->image_url }}" 
                     alt="{{ $post->title }}"
                     onerror="this.src='https://placehold.co/1200x600/f0fdf4/166534?text=MiniMart+Blog'">
                
                <!-- Dải sáng phản quang Liquid Glass mép trên -->
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none z-10"></div>
                
                <!-- Bottom Vignette / Glass Badges Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex items-end p-6 md:p-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-700 text-white font-bold text-xs shadow-md backdrop-blur-md border border-emerald-500/30">
                            <span class="material-symbols-outlined text-sm">eco</span>
                            {{ $post->category }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/85 text-gray-800 font-medium text-xs backdrop-blur-md shadow-xs border border-white/80">
                            <span class="material-symbols-outlined text-sm text-amber-600">schedule</span>
                            {{ $post->read_time ?? '5 phút đọc' }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/85 text-gray-800 font-medium text-xs backdrop-blur-md shadow-xs border border-white/80">
                            <span class="material-symbols-outlined text-sm text-gray-500">calendar_today</span>
                            {{ $post->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
            </section>

            <!-- Headline & Byline Header Block -->
            <header class="w-full max-w-3xl mx-auto pt-2 text-left">
                <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest mb-2">
                    {{ $post->category }}
                </p>
                
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-950 tracking-tight leading-tight">
                    {{ $post->title }}
                </h1>
                
                <!-- Byline Row -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200/70">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-emerald-100 ring-2 ring-white shadow-xs flex-shrink-0 flex items-center justify-center text-emerald-800 font-bold text-base">
                            {{ strtoupper(mb_substr($post->author_name ?? 'MM', 0, 2)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-gray-900">{{ $post->author_name ?? 'MiniMart Team' }}</span>
                                <span class="material-symbols-outlined text-emerald-600 text-base" title="Chuyên gia xác thực">verified</span>
                            </div>
                            <p class="text-xs text-gray-500">Chuyên gia Dinh dưỡng &amp; Ẩm thực MiniMart • 1.4k lượt xem</p>
                        </div>
                    </div>
                    
                    <!-- Fast Actions (Copy link & Share) -->
                    <div class="flex items-center gap-2">
                        <button type="button" 
                                onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết bài viết thành công!');"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white/70 hover:bg-white text-gray-700 text-xs font-bold border border-white/90 shadow-xs transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-base">link</span>
                            Sao chép link
                        </button>
                    </div>
                </div>
            </header>

            <!-- Article Content Body (Editorial Reading Stage + Floating Desktop Rail) -->
            <section class="relative w-full max-w-3xl mx-auto">
                <!-- Desktop Sticky Side Utility Rail (Floating Liquid Glass Pill) -->
                <aside class="hidden lg:flex flex-col gap-3.5 absolute -left-16 xl:-left-20 top-4 z-20 p-2 rounded-full bg-white/70 backdrop-blur-xl shadow-lg border border-white/80 items-center">
                    <button type="button" 
                            onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết bài viết!');" 
                            aria-label="Sao chép liên kết" 
                            class="w-10 h-10 rounded-full flex items-center justify-center text-gray-600 hover:text-white hover:bg-emerald-700 transition-all duration-200 transform hover:scale-105" 
                            title="Sao chép liên kết">
                        <span class="material-symbols-outlined text-lg">link</span>
                    </button>
                    <button type="button" 
                            onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank')" 
                            aria-label="Chia sẻ Facebook" 
                            class="w-10 h-10 rounded-full flex items-center justify-center text-gray-600 hover:text-white hover:bg-emerald-700 transition-all duration-200 transform hover:scale-105" 
                            title="Chia sẻ Facebook">
                        <span class="material-symbols-outlined text-lg">share</span>
                    </button>
                    <div class="w-5 h-[1px] bg-gray-200/80"></div>
                    <button type="button" 
                            aria-label="Lưu bài viết" 
                            class="flex flex-col items-center justify-center w-10 h-12 rounded-full text-gray-600 hover:text-emerald-700 transition-all group" 
                            id="bookmarkBtn">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">bookmark</span>
                        <span class="text-[11px] leading-tight font-bold">142</span>
                    </button>
                    <button type="button" 
                            aria-label="Yêu thích bài viết" 
                            class="flex flex-col items-center justify-center w-10 h-12 rounded-full text-gray-600 hover:text-rose-600 transition-all group" 
                            id="likeBtn">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform text-rose-500">favorite</span>
                        <span class="text-[11px] leading-tight font-bold text-gray-800">89</span>
                    </button>
                </aside>

                <article class="prose prose-lg prose-emerald max-w-none text-gray-700 leading-[1.8]
                                prose-headings:text-green-950 prose-headings:font-bold
                                prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                                prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3
                                prose-p:mb-5 prose-img:rounded-2xl prose-img:shadow-md prose-img:border prose-img:border-white/80
                                prose-table:w-full prose-table:border-collapse
                                prose-blockquote:border-l-4 prose-blockquote:border-emerald-600 prose-blockquote:bg-emerald-50/70 prose-blockquote:p-6 md:prose-blockquote:p-8 prose-blockquote:rounded-2xl prose-blockquote:italic prose-blockquote:my-8 prose-blockquote:text-emerald-950">
                    {!! $post->content !!}
                </article>
            </section>

            <!-- Author Bio Card (Liquid Glass Tier 2) -->
            <section class="w-full max-w-3xl mx-auto rounded-[24px] p-6 sm:p-8 bg-white/50 backdrop-blur-2xl border border-white/70 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-6 mt-12">
                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0 bg-emerald-100 border-2 border-white shadow-xs flex items-center justify-center text-emerald-800 font-bold text-xl">
                    {{ strtoupper(mb_substr($post->author_name ?? 'MM', 0, 2)) }}
                </div>
                <div class="flex flex-col text-center sm:text-left flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-baseline gap-2 mb-1">
                        <h3 class="text-lg font-bold text-gray-900">{{ $post->author_name ?? 'MiniMart Team' }}</h3>
                        <span class="text-xs font-semibold text-emerald-700">Cố vấn Ẩm thực & Dinh dưỡng tại MiniMart</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed mb-3">
                        Đam mê chia sẻ công thức nấu ăn lành mạnh và các giải pháp đi chợ thông minh, bền vững cho gia đình Việt. Luôn tin rằng một gian bếp tươi xanh là khởi nguồn của sức khỏe dài lâu.
                    </p>
                    <div>
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 hover:underline">
                            Xem tất cả bài viết từ MiniMart
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Related Articles Grid Section -->
            @if($relatedPosts && $relatedPosts->count() > 0)
                <section class="w-full pt-8 border-t border-gray-200/60">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block mb-1">Cẩm nang liên quan</span>
                            <h2 class="text-2xl font-bold text-green-950">Bài viết cùng chủ đề</h2>
                        </div>
                        <a href="{{ route('posts.index', ['category' => $post->category]) }}" class="inline-flex items-center gap-1 text-sm font-bold text-emerald-800 hover:underline">
                            Xem thêm bài viết
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $rel)
                            <article class="flex flex-col rounded-[20px] overflow-hidden bg-white/50 backdrop-blur-xl border border-white/70 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                <div class="relative h-44 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ $rel->image_url }}" 
                                         alt="{{ $rel->title }}" 
                                         onerror="this.src='https://placehold.co/800x600/f0fdf4/166534?text=MiniMart+Blog'"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-emerald-900 font-bold text-xs shadow-xs">
                                        {{ $rel->category }}
                                    </span>
                                </div>
                                <div class="p-5 flex flex-col flex-grow justify-between gap-3 bg-white/70">
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                                            <span>{{ $rel->created_at->format('d/m/Y') }}</span>
                                            <span>•</span>
                                            <span>{{ $rel->read_time ?? '4 phút đọc' }}</span>
                                        </div>
                                        <a href="{{ route('posts.show', $rel->slug) }}" class="group-hover:text-emerald-700 transition-colors">
                                            <h3 class="text-base font-bold text-gray-900 line-clamp-2 leading-snug">
                                                {{ $rel->title }}
                                            </h3>
                                        </a>
                                    </div>
                                    <div class="pt-2 border-t border-gray-100 flex items-center justify-between">
                                        <span class="text-xs text-gray-500 truncate max-w-[120px]">{{ $rel->author_name ?? 'MiniMart' }}</span>
                                        <a href="{{ route('posts.show', $rel->slug) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1 group-hover:translate-x-1 transition-all">
                                            Đọc tiếp <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Back to Blog Button -->
            <div class="text-center pt-4">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white/80 hover:bg-white text-emerald-900 font-bold rounded-full border border-white/90 shadow-md backdrop-blur-md transition-all hover:shadow-lg">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Quay lại Blog &amp; Tin tức
                </a>
            </div>

        </div>
    </div>

    <!-- Script: Reading Progress Bar & Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bar = document.getElementById('readingProgressBar');
            window.addEventListener('scroll', () => {
                const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                if (bar && height > 0) {
                    const scrolled = (winScroll / height) * 100;
                    bar.style.width = Math.min(100, Math.max(0, scrolled)) + '%';
                }
            }, { passive: true });

            const likeBtn = document.getElementById('likeBtn');
            if (likeBtn) {
                let liked = false;
                likeBtn.addEventListener('click', () => {
                    liked = !liked;
                    const countSpan = likeBtn.querySelector('span:last-child');
                    const icon = likeBtn.querySelector('.material-symbols-outlined');
                    if (countSpan) {
                        let count = parseInt(countSpan.textContent, 10) || 89;
                        countSpan.textContent = liked ? count + 1 : count - 1;
                    }
                    if (icon) {
                        icon.classList.toggle('scale-125');
                    }
                });
            }

            const bookmarkBtn = document.getElementById('bookmarkBtn');
            if (bookmarkBtn) {
                let bookmarked = false;
                bookmarkBtn.addEventListener('click', () => {
                    bookmarked = !bookmarked;
                    const countSpan = bookmarkBtn.querySelector('span:last-child');
                    if (countSpan) {
                        let count = parseInt(countSpan.textContent, 10) || 142;
                        countSpan.textContent = bookmarked ? count + 1 : count - 1;
                    }
                    alert(bookmarked ? 'Đã thêm bài viết vào mục Đã lưu!' : 'Đã bỏ lưu bài viết.');
                });
            }
        });
    </script>
</x-layouts.app>
