<x-layouts.app title="MiniMart - Siêu thị Nông sản Sạch">
    <!-- Hero Section (Slider + Banners) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4 mb-12">
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
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 fade-item" x-data="{ showAll: false }">
        <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold flex items-center gap-2 cursor-pointer" @click="showAll = !showAll">Khám phá Danh mục </h2>
                @if(count($categories) > 4)
                    <button @click="showAll = !showAll" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-6 py-2 font-bold flex items-center gap-1">
                        <span x-text="showAll ? 'Thu gọn' : 'Xem tất cả'"></span>
                        <span class="material-symbols-outlined text-sm" x-text="showAll ? 'expand_less' : 'expand_more'"></span>
                    </button>
                @endif
                <!-- <span class="material-symbols-outlined">expand_more</span> -->
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $icons = ['eco', 'nutrition', 'set_meal', 'inventory_2'];
                @endphp
                @foreach($categories as $idx => $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                       x-show="showAll || {{ $idx }} < 4"
                       x-transition
                       class="bg-white/50 backdrop-blur-xl border border-white/80 shadow-sm rounded-2xl p-6 flex flex-col items-center justify-center hover:bg-white/80 transition-all cursor-pointer group">
                        <span class="material-symbols-outlined text-4xl text-primary group-hover:scale-110 transition-transform">{{ $icons[$idx % count($icons)] }}</span>
                        <span class="font-label-md text-label-md text-on-surface">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sản phẩm mới -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 fade-item">
        
        <!-- ========================================== -->
        <!-- LAYER 2: HÌNH ẢNH BANNER PHÍA SAU          -->
        <!-- Chiều cao cố định 350px                    -->
        <!-- ========================================== -->
        <div class="w-full h-[350px] rounded-[2.5rem] overflow-hidden relative z-0">
            <!-- Ảnh Unsplash (Mỗi section 1 ảnh khác nhau) -->
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&q=80" alt="Sản phẩm mới" class="w-full h-full object-cover rounded-[2.5rem]">
            <div class="absolute inset-0 bg-black/10"></div> <!-- Lớp phủ tối nhẹ để làm nổi khối kính -->
        </div>
        
        <!-- ========================================== -->
        <!-- LAYER 1: KHUNG SẢN PHẨM ĐÈ LÊN LAYER 2     -->
        <!-- Dùng margin âm 250px để che khuất 70% ảnh  -->
        <!-- ========================================== -->
        <div class="relative z-10 -mt-[250px] px-2 md:px-6">
            <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-10">
                
                <!-- Tiêu đề nằm trong Layer 1 -->
                <div class="flex flex-wrap justify-between items-center mb-8 gap-4 border-b border-gray-100 pb-4">
                    <h2 class="text-3xl font-extrabold text-green-900">Sản phẩm mới</h2>
                    <a href="{{ route('products.index') }}" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-6 py-2 font-bold flex items-center gap-1">
                        Xem tất cả <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <!-- Grid Sản phẩm -->
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($newProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <!-- Banner Khuyến mãi 1 -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 fade-item">
        <div class="relative h-64 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&h=400&fit=crop" alt="Banner" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-transparent flex items-center">
                <div class="p-8 sm:p-12">
                    <p class="text-green-200 font-semibold text-sm uppercase tracking-widest mb-2">Ưu đãi đặc biệt</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">Giảm đến 50% Rau củ hữu cơ</h2>
                    <p class="text-green-100 mb-6 max-w-md">Chương trình áp dụng cho tất cả sản phẩm rau củ có chứng nhận VietGAP</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-green-800 font-bold px-6 py-3 rounded-xl hover:bg-green-50 transition-colors">Mua ngay →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 fade-item">
        
        <!-- ========================================== -->
        <!-- LAYER 2: HÌNH ẢNH BANNER PHÍA SAU          -->
        <!-- Chiều cao cố định 350px                    -->
        <!-- ========================================== -->
        <div class="w-full h-[350px] rounded-[2.5rem] overflow-hidden relative z-0">
            <!-- Ảnh Unsplash (Mỗi section 1 ảnh khác nhau) -->
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80" alt="Sản phẩm nổi bật" class="w-full h-full object-cover rounded-[2.5rem]">
            <div class="absolute inset-0 bg-black/10"></div> <!-- Lớp phủ tối nhẹ để làm nổi khối kính -->
        </div>
        
        <!-- ========================================== -->
        <!-- LAYER 1: KHUNG SẢN PHẨM ĐÈ LÊN LAYER 2     -->
        <!-- Dùng margin âm 250px để che khuất 70% ảnh  -->
        <!-- ========================================== -->
        <div class="relative z-10 -mt-[250px] px-2 md:px-6">
            <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-10">
                
                <!-- Tiêu đề nằm trong Layer 1 -->
                <div class="flex flex-wrap justify-between items-center mb-8 gap-4 border-b border-gray-100 pb-4">
                    <h2 class="text-3xl font-extrabold text-green-900">Sản phẩm nổi bật</h2>
                    <a href="{{ route('products.index') }}" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-6 py-2 font-bold flex items-center gap-1">
                        Xem tất cả <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <!-- Grid Sản phẩm -->
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <!-- Banner Khuyến mãi 2 -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 fade-item">
        <div class="relative h-64 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&h=400&fit=crop" alt="Banner" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-red-900/80 to-transparent flex items-center">
                <div class="p-8 sm:p-12">
                    <p class="text-red-200 font-semibold text-sm uppercase tracking-widest mb-2">Flash Deal hôm nay</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">Trái cây nhập khẩu - Mua 2 tặng 1</h2>
                    <p class="text-red-100 mb-6 max-w-md">Chỉ áp dụng trong ngày hôm nay. Số lượng có hạn!</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-red-800 font-bold px-6 py-3 rounded-xl hover:bg-red-50 transition-colors">Xem ngay →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Sales -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 fade-item">
        
        <!-- ========================================== -->
        <!-- LAYER 2: HÌNH ẢNH BANNER PHÍA SAU          -->
        <!-- Chiều cao cố định 350px                    -->
        <!-- ========================================== -->
        <div class="w-full h-[350px] rounded-[2.5rem] overflow-hidden relative z-0">
            <!-- Ảnh Unsplash (Mỗi section 1 ảnh khác nhau) -->
            <img src="https://images.unsplash.com/photo-1608686207856-001b95cf60ca?w=1200&q=80" alt="Flash Sales" class="w-full h-full object-cover rounded-[2.5rem]">
            <div class="absolute inset-0 bg-black/10"></div> <!-- Lớp phủ tối nhẹ để làm nổi khối kính -->
        </div>
        
        <!-- ========================================== -->
        <!-- LAYER 1: KHUNG SẢN PHẨM ĐÈ LÊN LAYER 2     -->
        <!-- Dùng margin âm 250px để che khuất 70% ảnh  -->
        <!-- ========================================== -->
        <div class="relative z-10 -mt-[250px] px-2 md:px-6">
            <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-10">
                
                <!-- Tiêu đề nằm trong Layer 1 -->
                <div class="flex flex-wrap justify-between items-center mb-8 gap-4 border-b border-gray-100 pb-4">
                    <h2 class="text-3xl font-extrabold text-red-600 flex items-center gap-2">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">bolt</span> Flash Sales
                    </h2>
                    <a href="{{ route('products.index') }}" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 rounded-full transition-all px-6 py-2 font-bold flex items-center gap-1">
                        Xem tất cả <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <!-- Grid Sản phẩm -->
                <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($flashSales as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <!-- Tại sao chọn MiniMart? -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 mt-12 fade-item">
        <div class="bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-8">
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
        </div>
    </section>

    <!-- Bài viết & Mẹo vặt mới nhất -->
    @if(isset($latestPosts) && $latestPosts->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 fade-item">
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
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 mb-12 fade-item">
        <div class="glass-tier-3 rounded-[24px] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-md">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Luôn cập nhật ưu đãi mới</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Đăng ký nhận bản tin để không bỏ lỡ khuyến mãi, công thức nấu ăn và nông sản theo mùa.</p>
        </div>
        <div class="w-full max-w-md flex gap-2">
            <input class="w-full bg-[#ffffff] border border-outline-variant rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg" placeholder="Nhập email của bạn" type="email"/>
            <button class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full shadow-md hover:bg-primary-container transition-colors whitespace-nowrap">Đăng ký</button>
        </div>
        </div>
    </section>
</x-layouts.app>
