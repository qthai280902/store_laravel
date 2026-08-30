@props(['product'])

<div class="product-card bg-white/50 backdrop-blur-3xl border border-white/80 shadow-[0_8px_30px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-4 flex flex-col relative overflow-hidden group h-full {{ $product->stock == 0 ? 'opacity-50' : '' }}">
    <!-- Sale Tag & Category -->
    <div class="absolute top-3 left-3 flex flex-col gap-1 z-10">
        @if($product->category)
            <div class="bg-tertiary text-on-tertiary font-label-md text-[9px] px-2 py-0.5 rounded-full shadow-sm">{{ $product->category->name }}</div>
        @endif
        @if(rand(0,1) && $product->stock > 0)
            <div class="bg-error text-onError font-label-md text-[9px] px-2 py-0.5 rounded-full shadow-sm">-20%</div>
        @endif
    </div>
    
    <div class="mb-3 relative rounded-[1.5rem] overflow-hidden">
        <a href="{{ route('products.show', $product->slug) }}" class="block w-full">
            <div class="aspect-[16/9] w-full overflow-hidden bg-surface-variant">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image_url ?? 'https://placehold.co/600x400/F5F5F5/00490e?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" loading="lazy"/>
            </div>
        </a>
    </div>
    
    <div class="flex-grow flex flex-col bg-transparent mt-2">
        <!-- Brand & Stock -->
        <div class="flex justify-between items-center mb-1">
            <span class="text-gray-500 text-xs font-medium">{{ $product->brand ?? 'No Brand' }}</span>
            @if($product->stock == 0)
                <span class="bg-red-100 text-red-600 px-2 py-1 text-[10px] font-bold rounded-full">Hết hàng</span>
            @else
                <span class="bg-green-100 text-green-800 px-2 py-1 text-[10px] font-bold rounded-full">Còn hàng</span>
            @endif
        </div>

        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-label-md text-sm text-gray-900 mb-1 line-clamp-2 font-semibold" title="{{ $product->name }}">{{ $product->name }}</h3>
        </a>
        <p class="font-body-lg text-gray-600 text-[11px] line-clamp-1 mb-2">{{ $product->description ?? 'Mô tả sản phẩm' }}</p>
    </div>
    
    <div class="mt-auto flex justify-between items-end pt-2 border-t border-outline-variant/30">
        <div class="flex flex-col">
            @if($product->original_price)
                <del class="text-gray-400 text-[10px] font-medium">{{ number_format($product->original_price) }}đ</del>
            @endif
            <div class="text-primary font-bold text-sm">
                {{ number_format($product->price ?? $product->base_price) }}đ <span class="text-gray-500 text-xs font-normal">/ {{ $product->unit ?? 'kg' }}</span>
            </div>
        </div>
        @if($product->stock == 0)
            <button 
                type="button" 
                class="w-8 h-8 flex-none flex items-center justify-center rounded-full bg-gray-300 text-gray-500 shadow-sm cursor-not-allowed" 
                title="Hết hàng"
                @click.prevent="alert('Sản phẩm hết hàng, vui lòng quay lại sau')">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
            </button>
        @else
            <button 
                type="button" 
                class="w-8 h-8 flex-none flex items-center justify-center rounded-full bg-green-600 text-white hover:bg-green-500 shadow-sm transition-colors cursor-pointer" 
                title="Thêm vào giỏ"
                @click.prevent="
                    fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ variant_id: '{{ $product->variants->first()->id ?? '' }}' })
                    }).then(response => {
                        if (response.ok) {
                            $dispatch('cart-added', { 
                                name: '{{ addslashes($product->name) }}', 
                                price: '{{ number_format($product->price ?? $product->base_price) }}', 
                                image: '{{ $product->image_url ?? 'https://placehold.co/600x400/F5F5F5/00490e?text=' . urlencode($product->name) }}' 
                            });
                        }
                    });
                ">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
            </button>
        @endif
    </div>
</div>
