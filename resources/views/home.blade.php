<x-layouts.app title="MiniMart - Siêu thị Nông sản Sạch">
    <!-- Hero Section (Slider + Banners) -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-12">
        <!-- Main Slider -->
        <div class="lg:col-span-2 relative w-full h-[400px] lg:h-[500px] rounded-3xl overflow-hidden shadow-xl group" x-data="{ slide: 1, max: 3 }" x-init="setInterval(() => { slide = slide < max ? slide + 1 : 1 }, 5000)">
            <!-- Slide 1 -->
            <div class="absolute inset-0 transition-opacity duration-1000" x-show="slide === 1" style="background-image: url('https://picsum.photos/seed/slide1/900/500'); background-size: cover;">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-10">
                    <span class="text-tertiary font-label-md bg-white/20 inline-block w-max px-3 py-1 rounded-full mb-3 backdrop-blur-md">Tuần lễ trái cây</span>
                    <h2 class="font-display-lg text-4xl text-white mb-4 drop-shadow-md max-w-md">Lễ hội trái cây nhập khẩu giảm đến 30%</h2>
                    <a href="{{ route('products.index', ['category' => 'trai-cay-nhap-khau']) }}" class="inline-block bg-primary text-on-primary font-label-md py-3 px-8 rounded-full shadow-lg w-max hover:bg-primary-container transition-colors">Mua ngay</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="absolute inset-0 transition-opacity duration-1000" x-show="slide === 2" style="background-image: url('https://picsum.photos/seed/slide2/900/500'); background-size: cover;">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-10">
                    <span class="text-tertiary font-label-md bg-white/20 inline-block w-max px-3 py-1 rounded-full mb-3 backdrop-blur-md">Rau củ hữu cơ</span>
                    <h2 class="font-display-lg text-4xl text-white mb-4 drop-shadow-md max-w-md">100% Nông sản VietGAP trực tiếp từ nông trại</h2>
                    <a href="{{ route('products.index', ['category' => 'rau-cu-huu-co']) }}" class="inline-block bg-primary text-on-primary font-label-md py-3 px-8 rounded-full shadow-lg w-max hover:bg-primary-container transition-colors">Khám phá</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="absolute inset-0 transition-opacity duration-1000" x-show="slide === 3" style="background-image: url('https://picsum.photos/seed/slide3/900/500'); background-size: cover;">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-10">
                    <span class="text-tertiary font-label-md bg-white/20 inline-block w-max px-3 py-1 rounded-full mb-3 backdrop-blur-md">Thịt cá tươi sống</span>
                    <h2 class="font-display-lg text-4xl text-white mb-4 drop-shadow-md max-w-md">Hải sản đánh bắt trong ngày, giao sống tận nhà</h2>
                    <a href="{{ route('products.index', ['category' => 'thuc-pham-tuoi-song']) }}" class="inline-block bg-primary text-on-primary font-label-md py-3 px-8 rounded-full shadow-lg w-max hover:bg-primary-container transition-colors">Xem hải sản</a>
                </div>
            </div>

            <!-- Slider Controls -->
            <button @click="slide = slide > 1 ? slide - 1 : max" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/30 text-white flex items-center justify-center backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity hover:bg-white/50">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button @click="slide = slide < max ? slide + 1 : 1" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/30 text-white flex items-center justify-center backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity hover:bg-white/50">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
            <div class="absolute bottom-4 left-1/2 -translate-y-1/2 flex gap-2">
                <template x-for="i in max">
                    <button @click="slide = i" class="w-2.5 h-2.5 rounded-full transition-colors" :class="slide === i ? 'bg-white' : 'bg-white/50'"></button>
                </template>
            </div>
        </div>

        <!-- Sub Banners -->
        <div class="hidden lg:flex flex-col gap-4 h-[500px]">
            <a href="{{ route('products.index', ['category' => 'thuc-pham-kho']) }}" class="relative w-full flex-1 rounded-3xl overflow-hidden shadow-md group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('https://picsum.photos/seed/subbanner1/500/250')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-white font-headline-lg text-xl mb-1">Gạo ST25 Ông Cua</h3>
                    <p class="text-white/80 font-body-lg text-sm">Gạo ngon nhất thế giới</p>
                </div>
            </a>
            <a href="{{ route('products.index') }}" class="relative w-full flex-1 rounded-3xl overflow-hidden shadow-md group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('https://picsum.photos/seed/subbanner2/500/250')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-white font-headline-lg text-xl mb-1">Combo Lẩu Nướng</h3>
                    <p class="text-white/80 font-body-lg text-sm">Tiết kiệm đến 15%</p>
                </div>
            </a>
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

    <!-- Sản phẩm mới -->
    <section class="mb-24 relative">
        <!-- Layer 0: Khung Banner nền xanh -->
        <div class="w-full bg-green-800 rounded-3xl h-72 pt-8 px-4 sm:px-8 relative z-0">
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-white">Sản phẩm mới</h2>
                <a href="{{ route('products.index') }}" class="text-green-100 hover:text-white font-semibold">Xem tất cả</a>
            </div>
        </div>

        <!-- Layer 1: Khung Sản phẩm Glassmorphism đè lên Banner -->
        <div class="relative z-10 -mt-40 px-2 sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-2xl p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($newProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section class="mb-24 relative">
        <!-- Layer 0: Khung Banner nền xanh -->
        <div class="w-full bg-green-800 rounded-3xl h-72 pt-8 px-4 sm:px-8 relative z-0">
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-white">Sản phẩm nổi bật</h2>
                <a href="{{ route('products.index') }}" class="text-green-100 hover:text-white font-semibold">Xem tất cả</a>
            </div>
        </div>

        <!-- Layer 1: Khung Sản phẩm Glassmorphism đè lên Banner -->
        <div class="relative z-10 -mt-40 px-2 sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-2xl p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Sales -->
    <section class="mb-24 relative">
        <!-- Layer 0: Khung Banner nền xanh -->
        <div class="w-full bg-green-800 rounded-3xl h-72 pt-8 px-4 sm:px-8 relative z-0">
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-error flex items-center gap-2">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">bolt</span> Flash Sales
                </h2>
                <a href="{{ route('products.index') }}" class="text-green-100 hover:text-white font-semibold">Xem tất cả</a>
            </div>
        </div>

        <!-- Layer 1: Khung Sản phẩm Glassmorphism đè lên Banner -->
        <div class="relative z-10 -mt-40 px-2 sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-2xl p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($flashSales as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Tại sao chọn MiniMart? -->
    <section class="mb-12 mt-12">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-8 text-center">Tại sao chọn MiniMart?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-green-700">local_shipping</span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-bold text-lg">Giao hàng siêu tốc</h3>
                <p class="font-body-lg text-sm text-on-surface-variant">Đặt hàng trước 14h, nhận hàng trong ngày. Miễn phí giao hàng cho đơn từ 300.000đ.</p>
            </div>
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-green-700">eco</span>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface font-bold text-lg">100% Hữu cơ</h3>
                <p class="font-body-lg text-sm text-on-surface-variant">Nông sản được chứng nhận VietGAP/GlobalGAP. Nguồn gốc rõ ràng, an toàn tuyệt đối.</p>
            </div>
            <div class="glass-tier-2 rounded-[20px] p-8 text-center flex flex-col items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl text-green-700">sync</span>
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
