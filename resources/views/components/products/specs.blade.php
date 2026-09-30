@props(['product'])

<div class="w-full bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2.5rem] p-6 sm:p-8 md:p-10 relative overflow-hidden">
    <!-- Vệt sáng viền trên Liquid Glass -->
    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

    <!-- Header Thông tin sản phẩm -->
    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-6 border-b border-gray-200/60">
        <div class="flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-2xl bg-green-900/10 text-green-900 flex items-center justify-center border border-white/80 shadow-xs">
                <span class="material-symbols-outlined text-[26px]">info</span>
            </div>
            <div>
                <h3 class="font-headline-lg text-2xl font-extrabold text-green-950 tracking-tight">Thông tin sản phẩm</h3>
                <p class="text-xs sm:text-sm text-gray-500 font-medium">Quy chuẩn chất lượng, nguồn gốc và xuất xứ kiểm nghiệm</p>
            </div>
        </div>

        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-800 bg-green-100/80 border border-green-200 px-4 py-1.5 rounded-full shadow-xs">
            <span class="material-symbols-outlined text-[16px] text-green-700">verified</span>
            Kiểm nghiệm đạt chuẩn VietGAP
        </span>
    </div>

    <!-- Bảng thông số kỹ thuật dạng hàng ngang tối giản chuẩn Liquid Glass -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 rounded-3xl bg-white/40 border border-white/80 p-4 sm:p-6 shadow-inner">
        
        <!-- Thương hiệu -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">verified_user</span>
                Thương hiệu
            </span>
            <span class="text-sm font-extrabold text-gray-900">{{ $product->brand ?? 'MiniMart' }}</span>
        </div>

        <!-- Xuất xứ -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">public</span>
                Xuất xứ
            </span>
            <span class="text-sm font-extrabold text-gray-900">{{ $product->origin ?? 'Việt Nam' }}</span>
        </div>

        <!-- Đơn vị tính -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">category</span>
                Đơn vị tính
            </span>
            <span class="text-sm font-extrabold text-gray-900">{{ $product->unit ?? 'Sản phẩm' }}</span>
        </div>

        <!-- Quy cách / Khối lượng -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">scale</span>
                Quy cách / Khối lượng
            </span>
            <span class="text-sm font-extrabold text-gray-900">{{ $product->weight ?? ($product->unit ?? 'Đóng gói chuẩn') }}</span>
        </div>

        <!-- Mã sản phẩm (SKU) -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">qr_code</span>
                Mã sản phẩm (SKU)
            </span>
            <span class="text-sm font-mono font-bold text-green-950 bg-green-100/70 px-2.5 py-1 rounded-lg border border-green-200">
                {{ $product->sku ?? ('MM-' . $product->id) }}
            </span>
        </div>

        <!-- Tình trạng kho -->
        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/60 hover:bg-white/90 border border-white/80 transition-colors">
            <span class="text-sm font-semibold text-gray-500 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-gray-400">inventory</span>
                Tình trạng kho
            </span>
            @if($product->stock > 0)
                <span class="text-sm font-bold text-emerald-800 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Còn {{ $product->stock }} {{ $product->unit ?? 'sản phẩm' }}
                </span>
            @else
                <span class="text-sm font-bold text-red-600 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                    Tạm hết hàng
                </span>
            @endif
        </div>
    </div>

    <!-- Nút điều hướng dạng viên thuốc kính lỏng -->
    <div class="flex flex-wrap items-center justify-between gap-4 mt-8 pt-6 border-t border-gray-200/60">
        @if($product->brand)
            <a href="{{ route('products.search', ['search' => $product->brand]) }}" 
               class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-green-950 bg-white/80 hover:bg-white backdrop-blur-md border border-white/90 shadow-sm rounded-full px-5 py-2.5 transition-all hover:scale-102">
                <span>Xem thêm sản phẩm từ <strong>{{ $product->brand }}</strong></span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        @endif

        <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-gray-600 hover:text-green-900 bg-white/40 hover:bg-white/70 border border-white/70 rounded-full px-5 py-2.5 transition-all ml-auto">
            <span>Xem tất cả {{ $product->category->name ?? 'sản phẩm' }}</span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        </a>
    </div>
</div>
