<x-layouts.app title="MiniMart - Siêu thị Nông sản Sạch">
    <!-- Hero Section -->
    <section class="relative w-full h-[500px] rounded-3xl overflow-hidden mb-12 shadow-xl flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://picsum.photos/seed/minimart-hero/1400/500')"></div>
        <div class="absolute inset-0 bg-white/20 backdrop-blur-sm"></div>
        <div class="relative z-10 text-center px-4 max-w-3xl glass-tier-3 p-8 rounded-2xl">
            <h1 class="font-display-lg text-display-lg text-primary mb-4 drop-shadow-md">Tươi ngon mỗi ngày với trải nghiệm hoàn hảo</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-6">Nông sản sạch, nguồn gốc rõ ràng — giao tận cửa nhà bạn.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary font-label-md text-label-md py-3 px-8 rounded-full shadow-lg hover:bg-primary-container transition-colors">Mua sắm ngay</a>
        </div>
    </section>

    <!-- Khám phá Danh mục -->
    <section class="mb-12">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Khám phá Danh mục</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $icons = ['eco', 'nutrition', 'set_meal', 'inventory_2'];
            @endphp
            @foreach($categories as $idx => $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="glass-tier-2 rounded-xl p-4 flex flex-col items-center justify-center gap-2 hover:bg-white/40 transition-colors cursor-pointer group">
                    <span class="material-symbols-outlined text-4xl text-primary group-hover:scale-110 transition-transform">{{ $icons[$idx % count($icons)] }}</span>
                    <span class="font-label-md text-label-md text-on-surface">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Khuyến mãi Hot -->
    <section class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-lg text-headline-lg text-primary">Khuyến mãi Hot</h2>
            <a class="text-primary font-label-md text-label-md hover:underline" href="{{ route('products.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($latestProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <!-- Tại sao chọn MiniMart? -->
    <section class="mb-12">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-8 text-center">Tại sao chọn MiniMart?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-primary">local_shipping</span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-bold text-lg">Giao hàng siêu tốc</h3>
                <p class="font-body-lg text-sm text-on-surface-variant">Đặt hàng trước 14h, nhận hàng trong ngày. Miễn phí giao hàng cho đơn từ 300.000đ.</p>
            </div>
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-primary">eco</span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-bold text-lg">100% Hữu cơ</h3>
                <p class="font-body-lg text-sm text-on-surface-variant">Nông sản được chứng nhận VietGAP/GlobalGAP. Nguồn gốc rõ ràng, an toàn tuyệt đối.</p>
            </div>
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-primary">sync</span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-bold text-lg">Đổi trả trong 24h</h3>
                <p class="font-body-lg text-sm text-on-surface-variant">Không hài lòng? Đổi trả miễn phí trong vòng 24 giờ, không cần lý do.</p>
            </div>
        </div>
    </section>

    <!-- Bài viết & Mẹo vặt mới nhất -->
    @if(isset($latestPosts) && $latestPosts->count() > 0)
    <section class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-lg text-headline-lg text-primary">Bài viết & Mẹo vặt mới nhất</h2>
            <a class="text-primary font-label-md text-label-md hover:underline" href="{{ route('posts.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
                <article class="glass-tier-2 rounded-[20px] flex flex-col overflow-hidden group">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block w-full h-48 overflow-hidden relative">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        <div class="absolute top-3 left-3 bg-tertiary text-on-tertiary font-label-md text-[10px] px-2 py-1 rounded-full shadow-sm">{{ $post->category }}</div>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <p class="font-label-md text-[10px] text-on-surface-variant mb-2">{{ $post->created_at->format('d/m/Y') }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <h3 class="font-label-md text-base text-primary hover:text-secondary transition-colors mb-2 line-clamp-2">{{ $post->title }}</h3>
                        </a>
                        <p class="font-body-lg text-sm text-on-surface-variant line-clamp-2 flex-grow">{{ strip_tags($post->content) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1 mt-3 font-label-md text-sm text-primary hover:text-secondary transition-colors">
                            Đọc tiếp <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Đăng ký nhận tin -->
    <section class="glass-tier-3 rounded-[24px] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 mb-12">
        <div class="max-w-md">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Luôn cập nhật ưu đãi mới</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Đăng ký nhận bản tin để không bỏ lỡ khuyến mãi, công thức nấu ăn và nông sản theo mùa.</p>
        </div>
        <div class="w-full max-w-md flex gap-2">
            <input class="w-full bg-[#ffffff] border border-outline-variant rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg" placeholder="Nhập email của bạn" type="email"/>
            <button class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full shadow-md hover:bg-primary-container transition-colors whitespace-nowrap">Đăng ký</button>
        </div>
    </section>
</x-layouts.app>
