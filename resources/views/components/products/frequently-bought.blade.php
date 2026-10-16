@props(['product'])

@php
    $comboItems = $product->frequently_bought_products;
    $currentVariant = $product->variants->first();
@endphp

@if($comboItems->isNotEmpty() && $currentVariant)
    @php
        $allBundleProducts = collect([$product])->merge($comboItems);
        $totalOriginalPrice = $allBundleProducts->sum(fn($p) => (float)($p->base_price ?: 0));
        $comboDiscount = 0.05; // Giảm thêm 5% khi mua trọn bộ combo
        $bundlePrice = round($totalOriginalPrice * (1 - $comboDiscount));
    @endphp

    <div class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-6 md:p-8 relative overflow-hidden"
         x-data="{
             selectedItems: [{{ $currentVariant->id }}, {{ $comboItems->map(fn($p) => $p->variants->first()?->id)->filter()->implode(', ') }}]
         }">
        
        <!-- Vệt sáng phản quang Liquid Glass mép trên -->
        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-6 mb-8 border-b border-gray-200/60">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-green-700 text-2xl">local_mall</span>
                    <h3 class="text-xl font-extrabold text-green-950 tracking-tight">Thường Mua Cùng (Combo Tiết Kiệm)</h3>
                </div>
                <p class="text-xs text-gray-600">Gợi ý mâm cơm tròn vị - Kết hợp nguyên liệu nấu trọn gói chuẩn siêu thị nông sản sạch</p>
            </div>

            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/90 border border-emerald-300 text-emerald-950 text-xs font-bold shadow-xs">
                Tiết kiệm 5% khi mua cả bộ
            </span>
        </div>

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Danh sách sản phẩm trong combo dạng mâm cơm nối tiếp -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 flex-1">
                    <!-- Sản phẩm hiện tại -->
                    <div class="flex flex-col items-center text-center w-36 sm:w-40 p-3 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm relative">
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 mb-2 border border-white shadow-xs">
                            <img src="{{ asset($product->image_url ?? $product->images[0] ?? 'images/placeholder.jpg') }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <span class="text-xs font-bold text-gray-900 line-clamp-1 mb-1">{{ $product->name }}</span>
                        <span class="text-xs font-extrabold text-emerald-800">{{ number_format($product->base_price) }}đ</span>
                        <input type="hidden" name="items[0][variant_id]" value="{{ $currentVariant->id }}">
                        <input type="hidden" name="items[0][quantity]" value="1">
                        <span class="mt-2 text-[10px] text-gray-400 font-semibold uppercase">Đang xem</span>
                    </div>

                    @foreach($comboItems as $idx => $combo)
                        @php
                            $comboVar = $combo->variants->first();
                        @endphp
                        @if($comboVar)
                            <!-- Dấu cộng liên kết -->
                            <div class="w-8 h-8 rounded-full bg-white/80 border border-gray-200 shadow-xs flex items-center justify-center text-gray-500 font-black text-sm shrink-0">
                                +
                            </div>

                            <!-- Sản phẩm đi kèm -->
                            <div class="flex flex-col items-center text-center w-36 sm:w-40 p-3 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm relative group">
                                <a href="{{ route('products.show', $combo->slug) }}" class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 mb-2 border border-white shadow-xs block">
                                    <img src="{{ asset($combo->image_url ?? $combo->images[0] ?? 'images/placeholder.jpg') }}" 
                                         alt="{{ $combo->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </a>
                                <a href="{{ route('products.show', $combo->slug) }}" class="text-xs font-bold text-gray-900 line-clamp-1 mb-1 hover:text-green-700 transition-colors">
                                    {{ $combo->name }}
                                </a>
                                <span class="text-xs font-extrabold text-emerald-800">{{ number_format($combo->base_price) }}đ</span>
                                
                                <input type="hidden" name="items[{{ $idx + 1 }}][variant_id]" value="{{ $comboVar->id }}">
                                <input type="hidden" name="items[{{ $idx + 1 }}][quantity]" value="1">
                                
                                <span class="mt-2 text-[10px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">
                                    Khuyên dùng
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Khối tổng kết giá combo & Nút Thêm vào giỏ -->
                <div class="w-full lg:w-72 p-5 rounded-2xl bg-gradient-to-br from-emerald-900 to-green-950 text-white shadow-xl flex flex-col justify-between shrink-0">
                    <div>
                        <span class="text-xs text-emerald-300 font-semibold block mb-1">Tổng cộng cả combo:</span>
                        <div class="flex items-baseline gap-2 mb-2">
                            <span class="text-2xl font-black text-emerald-200">{{ number_format($bundlePrice) }}đ</span>
                            <span class="text-xs text-emerald-400 line-through">{{ number_format($totalOriginalPrice) }}đ</span>
                        </div>
                        <p class="text-[11px] text-emerald-200/80 leading-relaxed mb-4">
                            Đã áp dụng chiết khấu combo mâm cơm dinh dưỡng tươi sống trong ngày.
                        </p>
                    </div>

                    <button type="submit" 
                            class="w-full py-3 px-4 rounded-full bg-emerald-400 hover:bg-emerald-300 text-green-950 font-black text-xs shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98">
                        <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        Thêm Cả Bộ Vào Giỏ Hàng
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
