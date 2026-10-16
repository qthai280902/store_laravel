@props(['product'])

@php
    $storage = $product->storage_specs;
    $usage = $product->usage_guide;
    $isRtc = ($product->category?->slug === 'mon-so-che-san-ready-to-cook' || str_starts_with($product->sku ?? '', 'MM-RTC-'));
@endphp

<div class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-6 md:p-8 relative overflow-hidden">
    
    <!-- Vệt sáng phản quang Liquid Glass mép trên -->
    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-6 mb-8 border-b border-gray-200/60">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-green-700 text-2xl">
                    {{ $isRtc ? 'skillet' : 'restaurant_menu' }}
                </span>
                <h3 class="text-xl font-extrabold text-green-950 tracking-tight">
                    {{ $isRtc ? 'Hướng Dẫn Nấu Nhanh (Ready-to-Cook)' : 'Chế Biến & Bảo Quản Chuẩn Nông Sản' }}
                </h3>
            </div>
            <p class="text-xs text-gray-600">
                {{ $isRtc ? 'Nguyên liệu đã được sơ chế sạch sẽ, chỉ cần 3 bước đơn giản là có ngay món ngon nóng hổi' : 'Bí quyết giữ trọn hương vị tươi ngon và hàm lượng vi chất tự nhiên' }}
            </p>
        </div>

        @if($isRtc)
            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1.5 rounded-full bg-amber-100/90 border border-amber-300 text-amber-900 text-xs font-bold flex items-center gap-1 shadow-xs">
                    <span class="material-symbols-outlined text-[16px]">timer</span>
                    {{ $usage['prep_time'] }}
                </span>
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/90 border border-emerald-300 text-emerald-900 text-xs font-bold flex items-center gap-1 shadow-xs">
                    <span class="material-symbols-outlined text-[16px]">group</span>
                    {{ $usage['serving'] }}
                </span>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- 3 Bước Chế Biến / Thưởng Thức (Chiếm 2 cột) -->
        <div class="lg:col-span-2 space-y-4">
            <h4 class="text-sm font-extrabold text-gray-800 uppercase tracking-wider flex items-center gap-2 mb-4">
                <span class="w-2 h-2 rounded-full bg-green-700"></span>
                Quy Trình 3 Bước Chuẩn Vị
            </h4>

            <div class="grid grid-cols-1 gap-4">
                @foreach($usage['steps'] as $idx => $step)
                    <div class="p-5 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-green-800 to-emerald-950 text-white font-extrabold flex items-center justify-center shrink-0 shadow-sm text-sm group-hover:scale-110 transition-transform">
                            0{{ $idx + 1 }}
                        </div>
                        <div class="flex-1">
                            <h5 class="text-sm font-bold text-gray-900 mb-1">{{ $step['title'] }}</h5>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Khối Bảo Quản Chuyên Sâu (Chiếm 1 cột) -->
        <div class="space-y-4">
            <h4 class="text-sm font-extrabold text-gray-800 uppercase tracking-wider flex items-center gap-2 mb-4">
                <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                Thông Số Bảo Quản
            </h4>

            <div class="p-6 rounded-2xl bg-gradient-to-br from-white/90 to-emerald-50/60 backdrop-blur-md border border-emerald-100/80 shadow-sm space-y-4">
                <div class="flex items-center gap-3 pb-3 border-b border-gray-200/50">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">ac_unit</span>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Nhiệt Độ Tối Ưu</span>
                        <span class="text-sm font-extrabold text-gray-900">{{ $storage['temp'] }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 pb-3 border-b border-gray-200/50">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Hạn Sử Dụng Khuyên Dùng</span>
                        <span class="text-sm font-extrabold text-gray-900">{{ $storage['shelf_life'] }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Hướng Dẫn Cất Trữ</span>
                    <p class="text-xs text-gray-700 leading-relaxed">{{ $storage['instructions'] }}</p>
                </div>

                <div class="p-3 rounded-xl bg-amber-50/80 border border-amber-200/70 text-amber-900 text-[11px] leading-relaxed flex items-start gap-2">
                    <span class="material-symbols-outlined text-[16px] text-amber-700 shrink-0 mt-0.5">info</span>
                    <span><strong>Lưu ý:</strong> {{ $storage['warning'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
