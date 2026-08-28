<x-layouts.app title="Catalog - MiniMart">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter mt-6">
    <!-- Breadcrumbs & Header (Full Width) -->
    <div class="col-span-1 md:col-span-12 mb-4">
        <nav aria-label="Breadcrumb" class="flex text-on-surface-variant font-label-md text-label-md mb-2">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a class="inline-flex items-center hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="material-symbols-outlined text-sm mx-1">chevron_right</span>
                        <a class="hover:text-primary transition-colors" href="{{ route('products.index') }}">Categories</a>
                    </div>
                </li>
                @if(request('category'))
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="material-symbols-outlined text-sm mx-1">chevron_right</span>
                        <span class="text-primary font-bold">{{ request('category') }}</span>
                    </div>
                </li>
                @endif
            </ol>
        </nav>
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-1">Products</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Showing {{ $products->total() }} products</p>
            </div>
            <!-- Sorting Dropdown (Thin Glass) -->
            <div class="relative glass-tier-2 rounded-lg px-4 py-2 flex items-center gap-2 cursor-pointer hover:bg-white/40 transition-colors">
                <span class="font-label-md text-label-md text-on-surface">Sort by: Recommended</span>
                <span class="material-symbols-outlined text-on-surface">expand_more</span>
            </div>
        </div>
    </div>

    <!-- Left Sidebar Filters (Thin Glass) -->
    <aside class="col-span-1 md:col-span-3">
        <div class="glass-tier-2 rounded-[20px] p-6 sticky top-[104px]">
            <h3 class="font-label-md text-label-md text-primary uppercase tracking-wider mb-4">Filters</h3>
            <!-- Category Filter -->
            <div class="mb-6">
                <h4 class="font-label-md text-label-md text-on-surface mb-3">Category</h4>
                <ul class="space-y-2 font-body-lg text-body-lg text-on-surface-variant">
                    <li>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input {{ !request('category') ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index') }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                            <span class="group-hover:text-primary transition-colors {{ !request('category') ? 'text-primary' : '' }}">All Products</span>
                        </label>
                    </li>
                    @foreach(\App\Models\Category::all() as $cat)
                    <li>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="window.location.href='{{ route('products.index', ['category' => $cat->slug]) }}'" class="rounded border-outline-variant text-primary focus:ring-primary bg-white h-5 w-5 group-hover:border-primary transition-colors" type="radio" name="category_filter"/>
                            <span class="group-hover:text-primary transition-colors {{ request('category') == $cat->slug ? 'text-primary' : '' }}">{{ $cat->name }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- Price Filter -->
            <div class="mb-6">
                <h4 class="font-label-md text-label-md text-on-surface mb-3">Price Range</h4>
                <div class="flex gap-2 items-center">
                    <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Min" type="number"/>
                    <span class="text-on-surface-variant">-</span>
                    <input class="w-full bg-white border border-outline-variant rounded-xl px-3 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Max" type="number"/>
                </div>
            </div>
            <!-- Type Filter -->
            <div>
                <h4 class="font-label-md text-label-md text-on-surface mb-3">Type</h4>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-1.5 bg-primary-container text-on-primary-container font-label-md text-label-md rounded-full shadow-sm transition-transform active:scale-95">Organic</button>
                    <button class="px-4 py-1.5 glass-tier-2 text-on-surface font-label-md text-label-md rounded-full hover:bg-white/40 transition-all active:scale-95">Conventional</button>
                </div>
            </div>
        </div>
    </aside>

    <!-- Product Grid (9 columns) -->
    <div class="col-span-1 md:col-span-9">
        <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-6 gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full glass-tier-2 rounded-3xl p-12 text-center">
                    <h3 class="text-2xl font-bold text-primary mb-2">No products found</h3>
                    <p class="text-on-surface-variant">There are no products in this category.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
    </div>
</x-layouts.app>
