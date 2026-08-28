<x-layouts.app title="Giỏ Hàng Của Bạn - MiniMart">
        <h1 class="font-headline-lg text-headline-lg md:font-headline-lg text-headline-lg mb-8 text-primary">Giỏ Hàng Của Bạn</h1>
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items List -->
            <div class="flex-grow space-y-4 w-full lg:w-2/3">
                @forelse($cart as $id => $item)
                    <div class="glass-tier-2 rounded-[20px] p-4 flex flex-col md:flex-row md:items-center gap-6 relative overflow-hidden group">
                        <div class="flex items-center gap-6 flex-grow">
                            <img class="w-24 h-24 object-cover rounded-xl shadow-sm" src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"/>
                            <div class="flex-grow">
                                <h3 class="font-label-md text-label-md text-on-surface text-lg">{{ $item['name'] }}</h3>
                                @if(isset($item['variant_name']))
                                    <p class="font-body-lg text-body-lg text-on-surface-variant text-sm mt-1">{{ $item['variant_name'] }}</p>
                                @endif
                                <div class="mt-2 font-label-md text-label-md text-primary text-xl">{{ number_format($item['price']) }}đ</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between md:justify-end gap-4 w-full md:w-auto mt-4 md:mt-0">
                            <div class="flex items-center gap-3 bg-white px-3 py-2 rounded-full border border-outline-variant shadow-sm">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline m-0">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button type="submit" class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                        <span class="material-symbols-outlined text-sm" data-icon="remove">remove</span>
                                    </button>
                                </form>
                                
                                <span class="font-label-md text-label-md w-6 text-center">{{ $item['quantity'] }}</span>
                                
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline m-0">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button type="submit" class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                                        <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="absolute top-4 right-4">
                            @csrf
                            <button type="submit" class="text-on-surface-variant hover:text-error transition-colors md:opacity-0 group-hover:opacity-100 cursor-pointer">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="glass-tier-2 rounded-[20px] p-12 text-center">
                        <h3 class="text-2xl font-bold text-primary mb-2">Giỏ hàng trống</h3>
                        <p class="text-on-surface-variant mb-6">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary py-3 px-8 rounded-full font-label-md text-label-md shadow-md hover:bg-primary/90 transition-colors">Tiếp tục mua sắm</a>
                    </div>
                @endforelse
            </div>
            
            <!-- Summary Column -->
            @if(count($cart) > 0)
                <div class="w-full lg:w-1/3">
                    <div class="glass-tier-4 rounded-[24px] p-8 sticky top-[120px] shadow-2xl">
                        <h2 class="font-headline-lg text-headline-lg md:font-headline-lg text-headline-lg mb-6 text-on-surface text-2xl">Tóm tắt đơn hàng</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between font-body-lg text-body-lg text-on-surface-variant">
                                <span>Tạm tính ({{ array_sum(array_column($cart, 'quantity')) }} món)</span>
                                <span class="font-label-md text-label-md text-on-surface">{{ number_format($total) }}đ</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-outline-variant pt-4 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="font-label-md text-label-md text-on-surface text-lg">Tổng cộng</span>
                                <span class="font-headline-lg text-headline-lg md:font-headline-lg text-headline-lg text-primary text-2xl">{{ number_format($total) }}đ</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="block w-full bg-primary-container text-on-primary text-center py-4 rounded-full font-label-md text-label-md text-lg shadow-lg hover:shadow-xl transition-shadow duration-300 hover:bg-primary">
                            Tiến hành thanh toán
                        </a>
                    </div>
                </div>
            @endif
        </div>
</x-layouts.app>
