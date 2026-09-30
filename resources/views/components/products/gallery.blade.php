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
        activeLabel: '{{ $angleLabels[0] ?? 'Chính diện' }}'
     }" 
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
                 class="w-full h-full object-cover select-none transition-opacity duration-300">
        </div>
    </div>

    <!-- Thanh Thumbnail Slider Đa Góc Nhìn (Liquid Glass Strip) -->
    <div class="bg-white/40 backdrop-blur-xl border border-white/70 shadow-sm ring-1 ring-white/50 rounded-2xl p-2.5">
        <div class="flex items-center gap-3 overflow-x-auto custom-scrollbar pb-1">
            @foreach($gallery as $index => $img)
                @php
                    $label = $angleLabels[$index] ?? ('Ảnh ' . ($index + 1));
                @endphp
                <button type="button" 
                        @click="activeImage = '{{ $img }}'; activeLabel = '{{ $label }}'"
                        class="relative flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border transition-all duration-200 cursor-pointer"
                        :class="activeImage === '{{ $img }}' 
                            ? 'ring-2 ring-green-600 shadow-md border-transparent bg-white scale-102' 
                            : 'border-white/80 ring-1 ring-white/40 opacity-70 hover:opacity-100 bg-white/40'">
                    
                    <img src="{{ $img }}" alt="{{ $label }}" class="w-full h-full object-cover select-none">
                    
                    <!-- Nhãn góc nhìn khi hover -->
                    <div class="absolute inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity text-[10px] text-white font-bold text-center px-1">
                        {{ $label }}
                    </div>

                    <!-- Chỉ báo active -->
                    <div x-show="activeImage === '{{ $img }}'" 
                         class="absolute bottom-1 right-1 w-2.5 h-2.5 rounded-full bg-green-600 ring-2 ring-white"></div>
                </button>
            @endforeach
        </div>
    </div>
</div>
