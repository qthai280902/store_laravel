@props(['product'])

@php
    $gallery = $product->gallery_images;
    $angleLabels = [
        0 => 'Chính diện',
        1 => 'Nhãn phụ & Dinh dưỡng',
        2 => 'Góc nghiêng 45°',
        3 => 'Cận cảnh kết cấu',
        4 => 'Thực tế / Chế biến',
    ];
@endphp

<div x-data="{ 
        activeImage: '{{ $gallery[0] ?? $product->image_url }}',
        activeLabel: '{{ $angleLabels[0] ?? 'Chính diện' }}',
        canScrollLeft: false,
        canScrollRight: false,
        checkScroll() {
            if (this.$refs.thumbnailTrack) {
                const el = this.$refs.thumbnailTrack;
                this.canScrollLeft = el.scrollLeft > 5;
                this.canScrollRight = el.scrollLeft + el.clientWidth < el.scrollWidth - 5;
            }
        },
        scrollPrev() {
            if (this.$refs.thumbnailTrack) {
                this.$refs.thumbnailTrack.scrollBy({ left: -100, behavior: 'smooth' });
            }
        },
        scrollNext() {
            if (this.$refs.thumbnailTrack) {
                this.$refs.thumbnailTrack.scrollBy({ left: 100, behavior: 'smooth' });
            }
        }
     }" 
     x-init="setTimeout(() => checkScroll(), 120)"
     @resize.window.passive="checkScroll()"
     class="flex flex-col gap-4">
    
    <!-- Khung Ảnh Chính (Liquid Glass Frame - Cố định & Sắc nét, không rung lắc) -->
    <div class="relative bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_12px_40px_rgba(0,0,0,0.08)] ring-1 ring-white/60 rounded-[2.5rem] p-3 overflow-hidden transition-all">
        <!-- Vệt sáng phản quang Liquid Glass mép trên -->
        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none z-20"></div>

        <!-- Tag góc nhìn hiện tại -->
        <div class="absolute top-6 left-6 z-20 pointer-events-none">
            <span class="inline-flex items-center gap-1.5 bg-white/80 backdrop-blur-md border border-white/80 shadow-xs text-green-950 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wide">
                <span class="w-2 h-2 rounded-full bg-green-600"></span>
                <span x-text="activeLabel"></span>
            </span>
        </div>

        <!-- Khung chứa ảnh tĩnh, không zoom hay tính toán tọa độ chuột -->
        <div class="relative w-full aspect-square rounded-[2rem] overflow-hidden bg-gray-50 flex items-center justify-center">
            <img :src="activeImage" 
                 alt="{{ $product->name }}" 
                 onerror="this.src='https://placehold.co/800x800/f0fdf4/166534?text=MiniMart+Studio'"
                 class="w-full h-full object-cover select-none transition-opacity duration-300">
        </div>
    </div>

    <!-- Thanh Thumbnail Slider Đa Góc Nhìn (Liquid Glass Strip với Navigation Buttons) -->
    <div class="relative bg-white/40 backdrop-blur-xl border border-white/70 shadow-sm ring-1 ring-white/50 rounded-2xl md:rounded-3xl p-2 md:p-2.5 flex items-center">
        <!-- Nút Trượt Trái (Previous Button) -->
        <button type="button" 
                x-show="canScrollLeft"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 -translate-x-2"
                @click="scrollPrev()"
                aria-label="Xem ảnh trước"
                class="absolute left-2 top-1/2 -translate-y-1/2 z-30 w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/90 hover:bg-white backdrop-blur-md border border-white/90 shadow-[0_4px_14px_rgba(0,0,0,0.12)] text-gray-700 hover:text-emerald-700 flex items-center justify-center cursor-pointer transition-all">
            <span class="material-symbols-outlined text-lg leading-none">chevron_left</span>
        </button>

        <!-- Dải Thumbnail Thu Nhỏ & Nới Rộng Khung Chứa, Tránh Che Khuất Viền Phản Quang -->
        <div x-ref="thumbnailTrack"
             @scroll.passive="checkScroll()"
             class="flex items-center gap-3 overflow-x-auto scroll-smooth no-scrollbar [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] w-full px-2.5 py-3 md:py-3.5">
            @foreach($gallery as $index => $img)
                @php
                    $label = $angleLabels[$index] ?? ('Ảnh ' . ($index + 1));
                @endphp
                <button type="button" 
                        @click="activeImage = '{{ $img }}'; activeLabel = '{{ $label }}'"
                        class="relative flex-shrink-0 w-16 h-16 md:w-[4.25rem] md:h-[4.25rem] rounded-xl overflow-hidden border transition-all duration-200 cursor-pointer"
                        :class="activeImage === '{{ $img }}' 
                            ? 'ring-2 ring-emerald-600/90 shadow-[0_4px_14px_rgba(16,185,129,0.3)] scale-105 border-transparent bg-white' 
                            : 'border-white/80 ring-1 ring-white/50 opacity-75 hover:opacity-100 hover:scale-[1.02] bg-white/40'">
                    
                    <img src="{{ $img }}" 
                         alt="{{ $label }}" 
                         onerror="this.src='https://placehold.co/800x800/f0fdf4/166534?text=MiniMart'"
                         class="w-full h-full object-cover select-none">
                    
                    <!-- Nhãn góc nhìn khi hover -->
                    <div class="absolute inset-0 bg-black/45 backdrop-blur-xs flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity rounded-xl px-1.5 py-1 text-[10px] font-medium leading-tight text-white text-center">
                        {{ $label }}
                    </div>

                    <!-- Chỉ báo active -->
                    <div x-show="activeImage === '{{ $img }}'" 
                         class="absolute bottom-1.5 right-1.5 w-2 h-2 rounded-full bg-emerald-600 ring-2 ring-white"></div>
                </button>
            @endforeach
        </div>

        <!-- Nút Trượt Phải (Next Button) -->
        <button type="button" 
                x-show="canScrollRight"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-2"
                @click="scrollNext()"
                aria-label="Xem ảnh kế tiếp"
                class="absolute right-2 top-1/2 -translate-y-1/2 z-30 w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/90 hover:bg-white backdrop-blur-md border border-white/90 shadow-[0_4px_14px_rgba(0,0,0,0.12)] text-gray-700 hover:text-emerald-700 flex items-center justify-center cursor-pointer transition-all">
            <span class="material-symbols-outlined text-lg leading-none">chevron_right</span>
        </button>
    </div>
</div>
