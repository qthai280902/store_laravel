<x-layouts.app title="MiniMart - Siêu thị Nông sản">
    <!-- Hero Section -->
    <section class="relative w-full h-[500px] rounded-3xl overflow-hidden mb-margin_desktop shadow-xl flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDxkbzAdcpoMPJAK0BPRwz4aXxAIFCrleW5XXSxJpmWp3pTmQwBUZcx686AcMHTLIaupnRxzhMLS95kprbF8dPWA5mBBAcmQXrc8jzos4VsmKdBvS77JjZBgORzvdZJrb2HJhXiwWOjd-cXuR7n28dY29xVdg1jc-p298f75OT3DYsTJGHQP0k0IJY-laH-QZas3A8hmoE821ESUjdzo4hGUohmmdqZTIx0ONHsE_SlOvszMJtICFE9')"></div>
        <div class="absolute inset-0 bg-white/20 backdrop-blur-sm"></div>
        <div class="relative z-10 text-center px-4 max-w-3xl glass-tier-3 p-8 rounded-2xl">
            <h1 class="font-display-lg text-display-lg text-primary mb-4 drop-shadow-md">Freshness delivered in Liquid Glass clarity</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-6">Experience the premium grocery shopping redefined.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary font-label-md text-label-md py-3 px-8 rounded-full shadow-lg hover:bg-primary-container transition-colors">Shop Now</a>
        </div>
    </section>

    <!-- Category Tiles -->
    <section class="mb-margin_desktop">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Explore Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @php
                $icons = ['eco', 'egg', 'kitchen', 'bakery_dining', 'local_drink'];
            @endphp
            @foreach($categories as $idx => $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="glass-tier-2 rounded-xl p-4 flex flex-col items-center justify-center gap-2 hover:bg-white/40 transition-colors cursor-pointer group">
                    <span class="material-symbols-outlined text-4xl text-primary group-hover:scale-110 transition-transform">{{ $icons[$idx % count($icons)] }}</span>
                    <span class="font-label-md text-label-md text-on-surface">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Top Deals Grid -->
    <section class="mb-margin_desktop">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Top Deals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <!-- Buy It Again Strip -->
    <section class="mb-margin_desktop">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-lg text-headline-lg text-primary">Mua lại nhanh</h2>
            <a class="text-primary font-label-md text-label-md hover:underline cursor-pointer" href="{{ route('products.index') }}">Xem tất cả</a>
        </div>
        <div class="flex overflow-x-auto gap-4 pb-4 snap-x hide-scrollbar">
            <!-- Example static items -->
            <div class="glass-tier-2 min-w-[180px] w-[180px] flex-shrink-0 rounded-[16px] p-3 flex flex-col snap-start group relative">
                <div class="w-full h-24 rounded-lg overflow-hidden mb-3 relative">
                    <img alt="Sữa tươi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4LZ2pThJe4NyeB6Zbgy0rwSPDZDt9k-Qr72LJ18HhzZkj3KEEXZ3ZknIW60USrmlRAWNf2PPHrJgl8XCR7zmnum4w8Tk2lsXYwPSIFWoiSBM7gJeMDslG-CMDchn-4c3mdrI-cZGXoBJJkTVwWIWzK_iQSmrAamxMIMBbioOSV0IOxiulGAE_-K2OkgcxfDjSpQeb5u33c8Znt0e7PX3FZUeWqPD5EzQ_EvhSalyFH0SYXmLX2KVp"/>
                </div>
                <h3 class="font-label-md text-label-md text-on-surface mb-1 truncate">Sữa tươi nguyên kem</h3>
                <p class="font-body-lg text-body-lg text-on-surface-variant text-xs mb-3">1 Lít</p>
                <div class="mt-auto flex justify-between items-center">
                    <div class="bg-white/50 text-on-surface font-label-md text-xs px-2 py-1 rounded-full shadow-sm">$2.50</div>
                    <button class="bg-primary text-on-primary text-xs font-label-md px-3 py-1.5 rounded-full hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm">Mua lại</button>
                </div>
            </div>
            <!-- Keep more from HTML here if desired, simplifying for length -->
        </div>
    </section>

    <!-- Recipe Teaser Section -->
    <section class="mb-margin_desktop">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-lg text-headline-lg text-primary">Khám phá công thức</h2>
            <a class="text-primary font-label-md text-label-md hover:underline cursor-pointer" href="#">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a class="glass-tier-2 rounded-[20px] p-4 flex flex-col group hover:bg-white/40 transition-colors block cursor-pointer" href="#">
                <div class="w-full h-48 rounded-xl overflow-hidden mb-4 relative">
                    <img alt="Bánh mì bơ tỏi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQAmAeE9t0vDpz98ECAmpQG0LhCaD7DTatL-pLFtgNY7AfFpv03fSGKG_1au7w2ygTI6zwzgLPOIwOwttf-2RERlRfq_NOkvdFhfXLCsa-0dCETgN9xBsrnkSeWS_yJ0cgq6jHeTQYY0w4iwKRJVCiTerzm6u9-nXAU_GUPEY7IhJEeFpNk2SIlP0xkh6Rgv-xnIIryRmJ__3tW3oR_IGOYl6oJGXhd2-VkggqbwJPpeBURIQNpL4x"/>
                    <div class="absolute top-3 left-3 bg-white/80 backdrop-blur-md text-primary font-label-md text-xs px-3 py-1.5 rounded-full flex items-center gap-1 shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">timer</span> 15p
                    </div>
                </div>
                <h3 class="font-headline-lg text-[20px] leading-tight text-on-surface mb-2 font-bold">Bánh mì bơ tươi nướng</h3>
                <p class="font-body-lg text-sm text-on-surface-variant line-clamp-2">Khởi đầu ngày mới với công thức bánh mì nướng bơ tươi giòn rụm, thơm ngon và đầy đủ dinh dưỡng.</p>
            </a>
            <!-- Keep more from HTML here if desired -->
        </div>
    </section>

    <!-- Newsletter Band -->
    <section class="glass-tier-3 rounded-[24px] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 mb-margin_desktop">
        <div class="max-w-md">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Stay Fresh, Stay Updated</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Subscribe to our newsletter for the latest deals, recipes, and seasonal produce updates directly to your inbox.</p>
        </div>
        <div class="w-full max-w-md flex gap-2">
            <input class="w-full bg-[#ffffff] border border-outline-variant rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-lg" placeholder="Enter your email address" type="email"/>
            <button class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full shadow-md hover:bg-primary-container transition-colors whitespace-nowrap">Subscribe</button>
        </div>
    </section>
</x-layouts.app>
