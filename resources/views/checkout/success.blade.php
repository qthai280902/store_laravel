<x-layouts.app title="Đặt hàng thành công - MiniMart">
    <main class="flex-grow flex items-center justify-center p-gutter z-10 relative min-h-[70vh]">
        <!-- Ambient Orbs -->
        <div class="absolute top-[-20%] left-[-10%] w-[60vw] h-[60vw] rounded-full bg-primary-fixed opacity-30 mix-blend-multiply filter blur-[80px] z-0 animate-float"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-secondary-fixed opacity-30 mix-blend-multiply filter blur-[80px] z-0 animate-float"></div>

        <div class="max-w-2xl w-full text-center flex flex-col items-center animate-float relative z-10">
            <!-- Success Icon -->
            <div class="mb-8 relative">
                <div class="absolute inset-0 bg-primary-fixed blur-xl opacity-50 rounded-full"></div>
                <span class="material-symbols-outlined text-display-lg font-display-lg text-primary relative z-10" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1; font-size: 96px;">
                    check_circle
                </span>
            </div>
            
            <!-- Headline -->
            <h1 class="font-headline-lg text-headline-lg text-primary mb-2 hidden md:block">Đặt hàng thành công!</h1>
            <h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary mb-2 md:hidden">Đặt hàng thành công!</h1>
            <p class="text-on-surface-variant font-body-lg text-body-lg mb-8 max-w-md mx-auto">
                Cảm ơn bạn đã mua sắm tại MiniMart. Đơn hàng thực phẩm tươi sạch của bạn đang được chuẩn bị.
            </p>
            
            <!-- Order Summary Glass Card (Regular - Tier 3) -->
            <div class="glass-tier-3 rounded-[20px] p-6 mb-8 w-full shadow-lg text-left">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-white/40">
                    <div>
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Mã đơn hàng</p>
                        <p class="font-headline-lg text-[24px] text-on-surface mt-1">#{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Trạng thái</p>
                        <p class="font-body-lg text-body-lg font-bold text-on-surface mt-1">
                            @if($order->status === 'pending') Chờ xử lý
                            @elseif($order->status === 'processing') Đang chuẩn bị
                            @elseif($order->status === 'completed') Đã giao
                            @elseif($order->status === 'cancelled') Đã hủy
                            @endif
                        </p>
                    </div>
                </div>
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 hide-scrollbar">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0">
                                <img class="w-full h-full object-cover" src="{{ $item->productVariant->product->image_url }}" alt="{{ $item->productVariant->product->name }}"/>
                            </div>
                            <div class="flex-grow">
                                <p class="font-label-md text-label-md text-on-surface">{{ $item->productVariant->product->name }}</p>
                                <p class="font-body-lg text-body-lg text-on-surface-variant text-sm">SL: {{ $item->quantity }} @if($item->productVariant->name !== 'Default') - {{ $item->productVariant->name }} @endif</p>
                            </div>
                            <p class="font-label-md text-label-md text-on-surface">{{ number_format($item->price * $item->quantity) }}₫</p>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-white/40">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Tổng cộng</p>
                    <p class="font-headline-lg text-[24px] text-primary">{{ number_format($order->total_amount) }}₫</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto justify-center">
                <a href="{{ route('profile') }}" class="inline-block bg-primary text-on-primary text-center font-label-md text-label-md px-8 py-4 rounded-full shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 w-full sm:w-auto">
                    Theo dõi Đơn hàng
                </a>
                <a href="{{ route('products.index') }}" class="inline-block glass-tier-2 text-on-surface text-center font-label-md text-label-md px-8 py-4 rounded-full hover:bg-white/40 transition-all duration-300 w-full sm:w-auto">
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </main>
</x-layouts.app>
