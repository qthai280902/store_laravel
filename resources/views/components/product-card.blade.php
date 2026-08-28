@props(['product'])

<div class="glass-tier-3 rounded-[20px] p-4 flex flex-col relative overflow-hidden group h-full">
    @if($product->category)
        <div class="absolute top-4 left-4 bg-tertiary text-on-tertiary font-label-md truncate max-w-[90%] text-[10px] px-2 py-1 rounded-full z-10 shadow-sm" title="{{ $product->category->name }}">{{ $product->category->name }}</div>
    @endif
    
    <div class="mb-4 relative rounded-xl overflow-hidden">
        <a href="{{ route('products.show', $product->slug) }}" class="block w-full">
            <div class="aspect-[4/3] w-full overflow-hidden bg-surface-variant">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image_url ?? 'https://picsum.photos/seed/' . urlencode($product->slug) . '/600/400' }}" alt="{{ $product->name }}" loading="lazy"/>
            </div>
        </a>
    </div>
    
    <div class="flex-grow">
        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-label-md text-base text-on-surface mb-1 line-clamp-2" title="{{ $product->name }}">{{ $product->name }}</h3>
        </a>
        <p class="font-body-lg text-body-lg text-on-surface-variant text-sm line-clamp-1">{{ $product->description ?? 'Mô tả sản phẩm' }}</p>
    </div>
    
    <div class="mt-4 flex justify-between items-center">
        <div class="bg-white text-on-surface font-label-md text-label-md px-3 py-1 rounded-full shadow-sm">{{ number_format($product->price ?? $product->base_price) }}đ</div>
        <form action="{{ route('cart.add') }}" method="POST" class="inline m-0">
            @csrf
            <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id ?? '' }}">
            <button type="submit" class="bg-primary-container text-on-primary-container p-2 rounded-full hover:bg-primary hover:text-on-primary transition-colors cursor-pointer" title="Thêm vào giỏ">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
            </button>
        </form>
    </div>
</div>
