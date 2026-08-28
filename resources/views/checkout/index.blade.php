<x-layouts.app title="Thanh Toán - MiniMart">
    <div class="max-w-max_width mx-auto px-gutter md:px-margin_desktop pb-20 pt-8 mt-[80px]">
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary md:hidden">Thanh toán</h2>
            <h2 class="font-headline-lg text-headline-lg text-primary hidden md:block">Thanh toán</h2>
        </div>

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Left Column: Form Sections -->
                <div class="md:col-span-7 lg:col-span-8 flex flex-col gap-6">
                    <!-- Delivery Address -->
                    <section class="glass-tier-3 p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-primary" data-icon="location_on" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            <h3 class="font-headline-lg text-headline-lg text-primary text-[24px]">Địa chỉ giao hàng</h3>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-2" for="address">Địa chỉ cụ thể</label>
                                <input class="solid-input w-full px-4 py-3 font-body-lg text-body-lg @error('address') border-error @enderror" id="address" name="address" placeholder="Số 123 Đường Xuân Thủy, Phường Dịch Vọng Hậu" type="text" value="{{ old('address') }}"/>
                                @error('address')
                                    <p class="text-error mt-1 font-label-md text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Payment Method -->
                    <section class="glass-tier-3 p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-primary" data-icon="payments" style="font-variation-settings: 'FILL' 1;">payments</span>
                            <h3 class="font-headline-lg text-headline-lg text-primary text-[24px]">Phương thức thanh toán</h3>
                        </div>
                        <div class="flex flex-col gap-4">
                            <label class="flex items-center p-4 border border-outline-variant rounded-[16px] cursor-pointer hover:bg-white/40 transition-colors glass-tier-2 group">
                                <input class="w-5 h-5 text-primary border-outline-variant focus:ring-primary focus:ring-2" name="payment_method" type="radio" value="cod" checked/>
                                <span class="ml-4 flex-grow">
                                    <span class="block font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">Thanh toán khi nhận hàng (COD)</span>
                                    <span class="block font-body-lg text-sm text-on-surface-variant mt-1">Thanh toán bằng tiền mặt khi giao hàng</span>
                                </span>
                            </label>

                            <label class="flex items-center p-4 border border-outline-variant rounded-[16px] cursor-pointer hover:bg-white/40 transition-colors glass-tier-2 group">
                                <input class="w-5 h-5 text-primary border-outline-variant focus:ring-primary focus:ring-2" name="payment_method" type="radio" value="bank_transfer"/>
                                <span class="ml-4 flex-grow">
                                    <span class="block font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">Chuyển khoản ngân hàng</span>
                                    <span class="block font-body-lg text-sm text-on-surface-variant mt-1">Chuyển khoản qua quét mã QR</span>
                                </span>
                            </label>
                        </div>
                    </section>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="md:col-span-5 lg:col-span-4">
                    <section class="glass-tier-4 p-6 md:p-8 sticky top-[104px]">
                        <h3 class="font-headline-lg text-headline-lg text-on-surface text-[24px] mb-6 border-b border-outline-variant/30 pb-4">Đơn hàng của bạn</h3>
                        
                        <!-- Items -->
                        <div class="space-y-4 mb-6 max-h-[300px] overflow-y-auto pr-2 hide-scrollbar">
                            @foreach($cart as $id => $item)
                                <div class="flex gap-4 items-start">
                                    <div class="w-16 h-16 rounded-[12px] overflow-hidden flex-shrink-0 bg-surface">
                                        <img class="w-full h-full object-cover" src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"/>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-label-md text-label-md text-on-surface line-clamp-1">{{ $item['name'] }}</h4>
                                        <p class="font-body-lg text-sm text-on-surface-variant mt-1">SL: {{ $item['quantity'] }} @if(isset($item['variant_name'])) - {{ $item['variant_name'] }} @endif</p>
                                    </div>
                                    <div class="font-label-md text-label-md text-on-surface whitespace-nowrap">
                                        {{ number_format($item['price'] * $item['quantity']) }}đ
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Totals -->
                        <div class="border-t border-outline-variant/30 pt-4 space-y-3 mb-6">
                            <div class="flex justify-between items-center text-on-surface-variant font-body-lg text-body-lg">
                                <span>Tạm tính</span>
                                <span>{{ number_format($total) }}đ</span>
                            </div>
                            <div class="flex justify-between items-center text-on-surface-variant font-body-lg text-body-lg">
                                <span>Phí giao hàng</span>
                                <span>Miễn phí</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-outline-variant/30">
                                <span class="font-label-md text-label-md text-on-surface text-lg">Tổng cộng</span>
                                <span class="font-headline-lg text-headline-lg text-primary text-[24px]">{{ number_format($total) }}đ</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-primary text-on-primary font-label-md text-label-md py-4 rounded-full shadow-lg hover:shadow-xl hover:bg-primary/90 hover:-translate-y-0.5 transition-all duration-300" type="submit">
                            Xác nhận Đặt hàng
                        </button>
                    </section>
                </div>
            </div>
        </form>
    </main>
</x-layouts.app>
