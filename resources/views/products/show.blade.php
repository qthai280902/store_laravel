<x-layouts.app :title="$product->name . ' - MiniMart'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-green-700">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-green-700">Sản phẩm</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <!-- 2-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Image -->
            <div class="bg-white/90 backdrop-blur-md rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                <img src="{{ $product->image_url ?? 'https://picsum.photos/seed/' . $product->slug . '/800/600' }}" alt="{{ $product->name }}" class="w-full h-full object-cover aspect-square">
            </div>

            <!-- Right: Info -->
            <div class="flex flex-col">
                <!-- Brand -->
                <span class="text-sm text-gray-500 font-medium mb-1">{{ $product->brand ?? 'MiniMart' }}</span>
                
                <!-- Title -->
                <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <!-- Static Rating -->
                <div class="flex items-center gap-2 mb-6">
                    <div class="flex text-yellow-400">
                        <!-- 5 star SVGs or material icons -->
                        @for($i = 0; $i < 5; $i++)
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500">(4.8 · 128 đánh giá)</span>
                </div>

                <!-- Price Block -->
                <div class="bg-green-50 rounded-2xl p-6 mb-6">
                    @if($product->original_price)
                        <del class="text-gray-400 text-lg">{{ number_format($product->original_price) }}đ</del>
                    @endif
                    <div class="text-4xl font-extrabold text-green-700">{{ number_format($product->price ?? $product->base_price) }}đ</div>
                    <span class="text-sm text-gray-500">/ {{ $product->unit ?? 'kg' }}</span>
                </div>

                <!-- Stock Badge -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Còn hàng ({{ $product->stock }})</span>
                    @else
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">Hết hàng</span>
                    @endif
                </div>

                <!-- Short Description -->
                <p class="text-gray-600 leading-relaxed mb-8">{{ $product->description }}</p>

                <!-- Action Block -->
                <div class="mt-auto bg-white/90 backdrop-blur-md rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <label class="text-sm font-semibold text-gray-700">Số lượng:</label>
                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden" x-data="{ qty: 1 }">
                            <button @click="qty = Math.max(1, qty - 1)" class="px-3 py-2 text-gray-600 hover:bg-gray-100">−</button>
                            <input type="number" x-model="qty" min="1" class="w-16 text-center border-x border-gray-300 py-2 text-sm focus:outline-none">
                            <button @click="qty++" class="px-3 py-2 text-gray-600 hover:bg-gray-100">+</button>
                        </div>
                    </div>
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id ?? '' }}">
                            <button type="submit" class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl text-lg hover:bg-green-700 transition-colors cursor-pointer shadow-lg">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full py-4 bg-gray-300 text-gray-500 font-bold rounded-2xl text-lg cursor-not-allowed">
                            Sản phẩm tạm hết hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description & Reviews Tabs -->
        <div class="mt-16" x-data="{ tab: 'description' }">
            <div class="flex border-b border-gray-200 mb-8">
                <button @click="tab = 'description'" class="px-6 py-3 text-sm font-semibold transition-colors" :class="tab === 'description' ? 'text-green-700 border-b-2 border-green-700' : 'text-gray-500 hover:text-gray-700'">Mô tả chi tiết</button>
                <button @click="tab = 'reviews'" class="px-6 py-3 text-sm font-semibold transition-colors" :class="tab === 'reviews' ? 'text-green-700 border-b-2 border-green-700' : 'text-gray-500 hover:text-gray-700'">Đánh giá (128)</button>
            </div>

            <div x-show="tab === 'description'" class="bg-white/90 backdrop-blur-md rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>{{ $product->description }}</p>
                    <h3 class="text-lg font-bold text-gray-900 mt-6 mb-3">Thông tin sản phẩm</h3>
                    <ul class="space-y-2">
                        <li><strong>Thương hiệu:</strong> {{ $product->brand ?? 'Đang cập nhật' }}</li>
                        <li><strong>Đơn vị:</strong> {{ $product->unit ?? 'kg' }}</li>
                        <li><strong>Danh mục:</strong> {{ $product->category->name ?? 'Chung' }}</li>
                        <li><strong>Tình trạng:</strong> {{ $product->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}</li>
                    </ul>
                </div>
            </div>

            <div x-show="tab === 'reviews'" class="bg-white/90 backdrop-blur-md rounded-2xl p-8 border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-center py-8">Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên!</p>
            </div>
        </div>
    </div>
</x-layouts.app>
