<x-layouts.app title="{{ $product->name }} - MiniMart">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter mt-6">
    <!-- Left Column: Gallery & Info (8 cols) -->
    <div class="md:col-span-8 flex flex-col gap-[32px]">
        <!-- Breadcrumbs -->
        <div class="flex items-center gap-[8px] font-label-md text-label-md text-on-surface-variant">
            <a class="hover:text-primary" href="{{ route('home') }}">Home</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="hover:text-primary" href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}">{{ $product->category->name ?? 'Products' }}</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-on-surface">{{ $product->name }}</span>
        </div>
        
        <!-- Main Gallery -->
        <div class="bg-surface-container-lowest rounded-[20px] overflow-hidden flex flex-col items-center justify-center p-[24px] shadow-sm relative">
            <div class="absolute top-[24px] left-[24px] bg-primary-fixed text-on-primary-fixed px-[12px] py-[4px] rounded-full font-label-md text-label-md z-10 shadow-sm flex items-center gap-[4px]">
                <span class="material-symbols-outlined text-[16px]">eco</span>
                {{ $product->category->name ?? 'Category' }}
            </div>
            <img class="w-full h-auto max-h-[500px] object-contain rounded-lg" src="https://placehold.co/600x400/F5F5F5/00490e?text={{ urlencode($product->name) }}" alt="{{ $product->name }}"/>
            
            <!-- Thumbnails -->
            <div class="flex gap-[16px] mt-[24px]">
                <button class="w-[80px] h-[80px] rounded-lg border-2 border-primary overflow-hidden">
                    <img class="w-full h-full object-cover" src="https://placehold.co/80x80/F5F5F5/00490e?text=1" alt="Thumbnail 1"/>
                </button>
                <button class="w-[80px] h-[80px] rounded-lg border-2 border-transparent hover:border-outline-variant overflow-hidden opacity-70 hover:opacity-100 transition-all">
                    <img class="w-full h-full object-cover" src="https://placehold.co/80x80/F5F5F5/00490e?text=2" alt="Thumbnail 2"/>
                </button>
                <button class="w-[80px] h-[80px] rounded-lg border-2 border-transparent hover:border-outline-variant overflow-hidden opacity-70 hover:opacity-100 transition-all">
                    <img class="w-full h-full object-cover" src="https://placehold.co/80x80/F5F5F5/00490e?text=3" alt="Thumbnail 3"/>
                </button>
            </div>
        </div>
        
        <!-- Tabs Section -->
        <div class="glass-tier-2 rounded-[20px] p-[32px] mt-[16px]">
            <div class="flex gap-[32px] border-b border-outline-variant/30 mb-[24px]">
                <button class="font-label-md text-label-md text-primary border-b-2 border-primary pb-[16px] font-bold">Description</button>
                <button class="font-label-md text-label-md text-on-surface-variant pb-[16px] hover:text-primary transition-colors">Nutrition Facts</button>
                <button class="font-label-md text-label-md text-on-surface-variant pb-[16px] hover:text-primary transition-colors">Reviews (0)</button>
            </div>
            <div class="font-body-lg text-body-lg text-on-surface-variant">
                <p class="mb-[16px]">{{ $product->description }}</p>
            </div>
        </div>
        
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <!-- Related Products -->
        <div class="mt-[32px]">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-[24px]">Related Products</h2>
            <div class="flex gap-[24px] overflow-x-auto hide-scrollbar pb-[24px]">
                @foreach($relatedProducts as $related)
                    <div class="min-w-[280px]">
                        <x-product-card :product="$related" />
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    
    <!-- Right Column: Sticky Buy Box (4 cols) -->
    <div class="md:col-span-4 relative">
        <div class="sticky top-[104px] glass-tier-4 rounded-[24px] p-[32px] shadow-2xl flex flex-col gap-[24px]">
            <div>
                <h1 class="font-headline-lg text-headline-lg text-on-surface mb-[8px]">{{ $product->name }}</h1>
                <div class="flex items-center gap-[8px] text-on-surface-variant">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-secondary">star_half</span>
                    <span class="font-label-md text-label-md ml-[4px]">(0 reviews)</span>
                </div>
            </div>
            
            <div class="flex items-end gap-[12px]">
                <div class="bg-secondary text-on-secondary px-[16px] py-[8px] rounded-lg font-headline-lg text-headline-lg shadow-md inline-block">
                    {{ number_format($product->price ?? $product->base_price) }}đ
                </div>
            </div>
            
            <hr class="border-outline-variant/30"/>
            
            <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-[24px]">
                @csrf
                
                @if($product->variants->count() > 1)
                    <div class="flex flex-col gap-[16px]">
                        <label class="font-label-md text-label-md text-on-surface">Variants</label>
                        <div class="flex flex-wrap gap-[8px]">
                            @foreach($product->variants as $index => $variant)
                                <label class="cursor-pointer relative">
                                    <input class="peer sr-only" name="variant_id" type="radio" value="{{ $variant->id }}" {{ $index === 0 ? 'checked' : '' }} />
                                    <div class="px-[16px] py-[8px] rounded-full border border-outline-variant text-on-surface-variant font-label-md text-label-md peer-checked:bg-primary peer-checked:text-on-primary peer-checked:border-primary transition-colors">
                                        {{ $variant->name }} @if($variant->price_adjustment > 0) (+{{ number_format($variant->price_adjustment) }}đ) @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @else
                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id ?? '' }}">
                @endif
                
                <div class="flex flex-col gap-[16px]">
                    <label class="font-label-md text-label-md text-on-surface">Quantity</label>
                    <div class="flex items-center gap-[16px]">
                        <button type="button" class="w-[48px] h-[48px] rounded-full glass-tier-2 flex items-center justify-center hover:bg-white/40 transition-colors text-on-surface" onclick="document.getElementById('qty').stepDown()">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <input id="qty" class="w-[80px] h-[48px] bg-surface-container-lowest border border-outline-variant rounded-[12px] text-center font-body-lg text-body-lg text-on-surface focus:ring-primary focus:border-primary" name="quantity" type="number" min="1" value="1"/>
                        <button type="button" class="w-[48px] h-[48px] rounded-full glass-tier-2 flex items-center justify-center hover:bg-white/40 transition-colors text-on-surface" onclick="document.getElementById('qty').stepUp()">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-primary text-on-primary font-label-md text-label-md py-[16px] rounded-full shadow-lg hover:bg-primary/90 transition-all flex items-center justify-center gap-[8px] mt-[16px] cursor-pointer">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Add to Cart
                </button>
                
                @if(session('success'))
                    <div class="p-4 bg-primary-container text-on-primary-container rounded-[12px] font-label-md text-label-md mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
            
            <div class="glass-tier-1 rounded-[12px] p-[16px] flex flex-col gap-[12px] mt-[8px]">
                <div class="flex items-center gap-[12px] text-on-surface-variant font-label-md text-label-md">
                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                    Next day delivery
                </div>
                <div class="flex items-center gap-[12px] text-on-surface-variant font-label-md text-label-md">
                    <span class="material-symbols-outlined text-primary">storefront</span>
                    Available in store
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layouts.app>
