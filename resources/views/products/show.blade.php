<x-layouts.app :title="$product->name . ' - MiniMart'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
        
        <!-- Breadcrumb (Liquid Glass Capsule) -->
        <nav class="inline-flex items-center gap-2 bg-white/50 backdrop-blur-md border border-white/80 shadow-xs px-5 py-2 rounded-full text-xs font-semibold text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-green-800 transition-colors">Trang chủ</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-green-800 transition-colors">Sản phẩm</a>
            @if($product->category)
                <span class="text-gray-300">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-green-800 transition-colors">{{ $product->category->name }}</a>
            @endif
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold truncate max-w-xs">{{ $product->name }}</span>
        </nav>

        <!-- KHU VỰC TRÊN (TOP GRID): Cân đối 2 Cột Gallery & Thông Tin -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- Cột Trái: Gallery Ảnh Đa Góc Nhìn (~45%) -->
            <div class="lg:col-span-5">
                <x-products.gallery :product="$product" />
            </div>

            <!-- Cột Phải: Thông tin Mua Hàng & Giá Cả (~55%) -->
            <div class="lg:col-span-7 flex flex-col">
                
                <!-- Category & Brand Chips -->
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    @if($product->category)
                        <span class="text-xs font-bold text-green-900 bg-green-100/70 border border-green-200 px-3.5 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    @if($product->brand)
                        <span class="text-xs font-semibold text-gray-600 bg-white/60 border border-white/80 px-3.5 py-1 rounded-full">
                            Thương hiệu: <strong class="text-gray-900">{{ $product->brand }}</strong>
                        </span>
                    @endif
                    @if($product->origin)
                        <span class="text-xs font-medium text-gray-500 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                            {{ $product->origin }}
                        </span>
                    @endif
                </div>

                <!-- Tên sản phẩm -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 tracking-tight leading-tight mb-4">
                    {{ $product->name }}
                </h1>

                <!-- Đánh giá sao liên kết mục nhận xét -->
                <a href="#reviews-section" class="inline-flex items-center gap-2 mb-6 group cursor-pointer w-fit">
                    <div class="flex text-amber-400">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-[20px]" style="{{ $i <= round($product->average_rating) ? 'font-variation-settings: \'FILL\' 1;' : '' }}">star</span>
                        @endfor
                    </div>
                    <span class="text-sm font-bold text-gray-800 group-hover:text-green-800 transition-colors">
                        {{ $product->average_rating }}
                    </span>
                    <span class="text-xs text-gray-400 font-medium">
                        ({{ $product->reviews_count }} đánh giá thực tế)
                    </span>
                </a>

                <!-- Khối Giá Liquid Glass kèm Pill Giảm Giá -->
                <div class="bg-white/60 backdrop-blur-2xl border border-white/80 shadow-[0_8px_30px_rgba(0,0,0,0.04)] ring-1 ring-white/60 rounded-[2rem] p-6 mb-6 relative overflow-hidden">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <div class="flex items-baseline gap-3">
                                <span class="text-3xl sm:text-4xl font-black text-green-950 tracking-tight">
                                    {{ number_format($product->base_price) }}đ
                                </span>
                                @if($product->original_price && $product->original_price > $product->base_price)
                                    <del class="text-base font-semibold text-gray-400">
                                        {{ number_format($product->original_price) }}đ
                                    </del>
                                @endif
                                <span class="text-sm font-medium text-gray-500">/ {{ $product->unit ?? 'sản phẩm' }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Đã bao gồm thuế GTGT & cam kết hàng tươi mỗi ngày</p>
                        </div>

                        <!-- Pill Giảm Giá % -->
                        @if($product->discount_percent)
                            <div class="inline-flex items-center gap-1.5 bg-red-500/15 backdrop-blur-md border border-red-400/40 text-red-700 font-extrabold px-3.5 py-1.5 rounded-full text-xs shadow-xs">
                                <span class="material-symbols-outlined text-[16px] text-red-600">local_fire_department</span>
                                <span>Giảm {{ $product->discount_percent }}%</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tình trạng kho thời gian thực -->
                <div class="mb-6 flex flex-wrap items-center gap-3">
                    @if($product->stock > 10)
                        <span class="inline-flex items-center gap-2 bg-emerald-500/15 backdrop-blur-md border border-emerald-400/40 text-emerald-900 px-4 py-1.5 rounded-full text-xs font-bold shadow-xs">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                            Còn hàng ({{ $product->stock }} {{ $product->unit ?? 'sản phẩm' }})
                        </span>
                    @elseif($product->stock > 0)
                        <span class="inline-flex items-center gap-2 bg-amber-500/20 backdrop-blur-md border border-amber-400/50 text-amber-900 px-4 py-1.5 rounded-full text-xs font-bold shadow-xs">
                            <span class="material-symbols-outlined text-[16px] text-amber-600">alarm</span>
                            Chỉ còn {{ $product->stock }} sản phẩm
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 bg-red-500/15 backdrop-blur-md border border-red-400/30 text-red-700 px-4 py-1.5 rounded-full text-xs font-bold shadow-xs">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                            Tạm hết hàng
                        </span>
                    @endif

                    <span class="text-xs text-gray-400 font-medium">
                        Mã SP: <strong class="text-gray-700 font-mono">{{ $product->sku ?? ('MM-' . $product->id) }}</strong>
                    </span>
                </div>

                <!-- Tóm tắt sản phẩm -->
                <p class="text-gray-600 leading-relaxed mb-8 text-sm sm:text-base">
                    {{ $product->description }}
                </p>

                <!-- Khối Hành Động Mua Hàng (Apple Liquid Glass V4) -->
                <div class="mt-auto bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.05)] ring-1 ring-white/50 rounded-[2rem] p-6 relative overflow-hidden">
                    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

                    <div class="flex items-center gap-5 mb-5">
                        <label class="text-sm font-bold text-gray-700">Số lượng:</label>
                        <div class="flex items-center bg-white/50 backdrop-blur-xl border border-white/80 shadow-inner rounded-2xl overflow-hidden" x-data="{ qty: 1 }">
                            <button type="button" @click="qty = Math.max(1, qty - 1)" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-white/80 hover:text-green-800 active:scale-95 transition-all font-bold text-lg cursor-pointer">−</button>
                            <input type="number" x-model="qty" min="1" max="{{ $product->stock }}" class="w-14 text-center border-x border-gray-200/50 py-2 text-sm font-bold text-gray-900 focus:outline-none bg-transparent">
                            <button type="button" @click="qty = Math.min({{ $product->stock > 0 ? $product->stock : 1 }}, qty + 1)" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-white/80 hover:text-green-800 active:scale-95 transition-all font-bold text-lg cursor-pointer">+</button>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">Tối đa {{ $product->stock }}</span>
                    </div>

                    @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id ?? '' }}">
                            <button type="submit" 
                                    class="w-full py-4 bg-emerald-600/90 hover:bg-emerald-600 backdrop-blur-md shadow-[0_8px_25px_rgba(16,185,129,0.35)] border border-emerald-400/40 text-white font-semibold rounded-2xl text-base active:scale-98 transition-all cursor-pointer flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[22px]">add_shopping_cart</span>
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full py-4 bg-gray-200/80 backdrop-blur-md border border-gray-300/40 text-gray-400 font-bold rounded-2xl text-base cursor-not-allowed flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">block</span>
                            Sản phẩm tạm hết hàng
                        </button>
                    @endif

                    <!-- Khối Cam kết dịch vụ (3 thẻ kính lỏng) -->
                    <div class="grid grid-cols-3 gap-3 mt-5 pt-4 border-t border-gray-200/40 text-center">
                        <div class="bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_4px_16px_rgba(0,0,0,0.04)] rounded-2xl p-3 flex flex-col items-center gap-1.5 transition-transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-emerald-700 text-xl">local_shipping</span>
                            <span class="text-[11px] font-bold text-gray-700">Giao nhanh 1h</span>
                        </div>
                        <div class="bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_4px_16px_rgba(0,0,0,0.04)] rounded-2xl p-3 flex flex-col items-center gap-1.5 transition-transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-emerald-700 text-xl">verified</span>
                            <span class="text-[11px] font-bold text-gray-700">Cam kết chính hãng</span>
                        </div>
                        <div class="bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_4px_16px_rgba(0,0,0,0.04)] rounded-2xl p-3 flex flex-col items-center gap-1.5 transition-transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-emerald-700 text-xl">published_with_changes</span>
                            <span class="text-[11px] font-bold text-gray-700">Đổi trả 7 ngày</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- KHU VỰC GIỮA: Component Thông số kỹ thuật (Trải rộng toàn màn hình) -->
        <section class="w-full">
            <x-products.specs :product="$product" />
        </section>

        <!-- KHU VỰC MÔ TẢ CHI TIẾT (Phiến kính độc lập) -->
        <section class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2.5rem] p-6 sm:p-8 md:p-10 relative overflow-hidden">
            <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

            <div class="flex items-center gap-3.5 mb-6 pb-4 border-b border-gray-200/60">
                <div class="w-12 h-12 rounded-2xl bg-green-900/10 text-green-900 flex items-center justify-center border border-white/80 shadow-xs">
                    <span class="material-symbols-outlined text-[26px]">subject</span>
                </div>
                <div>
                    <h3 class="font-headline-lg text-2xl font-extrabold text-green-950 tracking-tight">Mô tả chi tiết sản phẩm</h3>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">Quy trình chọn lọc và hướng dẫn sử dụng, bảo quản tối ưu</p>
                </div>
            </div>

            <div class="prose max-w-none text-gray-700 leading-relaxed text-sm sm:text-base space-y-4">
                <p>{{ $product->description }}</p>
                <p>Tất cả sản phẩm tại MiniMart được bảo quản trong hệ thống kho lạnh tiêu chuẩn quốc tế và kiểm định nghiêm ngặt trước khi đóng gói. Chúng tôi đồng hành cùng các nông trại và nhà sản xuất uy tín nhằm mang lại trải nghiệm tươi ngon, trọn vị và an toàn nhất cho bữa ăn của gia đình bạn.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                    <div class="p-4 rounded-2xl bg-white/60 border border-white/80 flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-700 text-2xl">eco</span>
                        <div>
                            <h5 class="text-xs font-bold text-gray-900">An Toàn Tuyệt Đối</h5>
                            <p class="text-[11px] text-gray-500">Đạt chuẩn an toàn VSTP</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/60 border border-white/80 flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-700 text-2xl">thermostat</span>
                        <div>
                            <h5 class="text-xs font-bold text-gray-900">Nhiệt Độ Tối Ưu</h5>
                            <p class="text-[11px] text-gray-500">Bảo quản lạnh 4°C - 8°C</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/60 border border-white/80 flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-700 text-2xl">health_and_safety</span>
                        <div>
                            <h5 class="text-xs font-bold text-gray-900">Nguồn Gốc Rõ Ràng</h5>
                            <p class="text-[11px] text-gray-500">Mã QR truy xuất nguồn gốc</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KHU VỰC DƯỚI: Component Đánh Giá Khách Hàng (Tách biệt hoàn toàn) -->
        <section id="reviews-section" class="w-full">
            <x-products.reviews :product="$product" />
        </section>

    </div>
</x-layouts.app>
