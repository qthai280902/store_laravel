<x-layouts.app title="Đơn hàng của tôi - MiniMart">
    <div class="flex max-w-max_width mx-auto pt-24 md:pt-margin_desktop px-gutter min-h-screen gap-6">
        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden md:flex flex-col w-[280px] glass-tier-2 rounded-2xl p-6 h-[calc(100vh-80px)] sticky top-margin_desktop shadow-lg flex-shrink-0">
            <div class="font-display-lg text-headline-lg font-extrabold text-primary mb-8 tracking-tight">MiniMart</div>
            <nav class="flex flex-col gap-2 flex-grow">
                <a class="bg-primary-container text-on-primary-container rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all" href="#">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person</span>
                    Hồ sơ
                </a>
                <a class="text-on-surface-variant hover:bg-white/40 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all" href="{{ route('account.orders') }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Đơn hàng
                </a>
                <a class="text-on-surface-variant hover:bg-white/40 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all" href="#">
                    <span class="material-symbols-outlined">location_on</span>
                    Địa chỉ
                </a>
                <a class="text-on-surface-variant hover:bg-white/40 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all" href="#">
                    <span class="material-symbols-outlined">payment</span>
                    Phương thức thanh toán
                </a>
                <a class="text-on-surface-variant hover:bg-white/40 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    Cài đặt
                </a>
            </nav>
            <div class="mt-auto pt-6 border-t border-outline-variant/30">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-error hover:bg-error/10 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all cursor-pointer text-left">
                        <span class="material-symbols-outlined">logout</span>
                        Đăng xuất
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow flex flex-col gap-8 pb-margin_desktop w-full">
            <header>
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Bảng điều khiển tài khoản</h1>
                <p class="text-on-surface-variant">Quản lý hồ sơ, đơn hàng và tùy chọn của bạn.</p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Profile Summary -->
                <section class="lg:col-span-2 glass-tier-3 rounded-[24px] p-8 shadow-xl flex flex-col md:flex-row gap-8 items-center relative overflow-hidden">
                    <!-- Subtle background decoration -->
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-primary-fixed/20 rounded-full blur-2xl z-0"></div>
                    <div class="relative z-10 w-32 h-32 rounded-full border-4 border-white/50 overflow-hidden shadow-lg flex-shrink-0">
                        <img class="w-full h-full object-cover" data-alt="A close up portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmpeUbKQDu2lCQ-EWt_gNnrrmT4QGcvxrZe-QwuZDOTA56i-IZDuDZrYK8I_c_2W4KDjXL3z2rgkWyUuy3ByFxo0iy2_7aBtiPAxD0hTm_87rVBfHMakKZnA4MYKItIotKlubrMdr2X0mmeF3dy1rPIaqpo5HLQFVtNtxm-ThtN5Fs6WLIhJDu0VKicydLs79C9hB-EWKlMQXd3_gvicjn_VCV_39yx8AkigglhHFVALplN1miHKFY"/>
                    </div>
                    <div class="relative z-10 flex flex-col gap-2 flex-grow text-center md:text-left">
                        <h2 class="font-headline-lg text-[24px] text-primary">{{ auth()->user()->name }}</h2>
                        <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2">
                            <span class="material-symbols-outlined text-[20px]">mail</span> {{ auth()->user()->email }}
                        </p>
                        <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2">
                            <span class="material-symbols-outlined text-[20px]">phone</span> +1 (555) 123-4567
                        </p>
                        <div class="mt-4 flex gap-4 justify-center md:justify-start">
                            <button class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full shadow-md hover:opacity-90 transition-opacity">Chỉnh sửa hồ sơ</button>
                        </div>
                    </div>
                </section>

                <!-- Mini Stats -->
                <a class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group" href="#">
                    <div>
                        <h3 class="font-label-md text-label-md text-on-surface-variant mb-4 uppercase tracking-wider group-hover:text-primary transition-colors">Điểm thưởng</h3>
                        <div class="text-display-lg font-display-lg text-primary mb-1">2.450</div>
                        <p class="text-on-surface-variant text-sm">Điểm hiện có</p>
                    </div>
                    <div class="mt-6">
                        <div class="w-full bg-white/50 rounded-full h-2 mb-2 overflow-hidden">
                            <div class="bg-primary h-2 rounded-full w-3/4"></div>
                        </div>
                        <p class="text-xs text-on-surface-variant text-right">Cần 550 điểm để đạt hạng Vàng</p>
                    </div>
                </a>

                <!-- Shopping Lists -->
                <a class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group" href="#">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">list_alt</span>
                            <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider group-hover:text-primary transition-colors">Danh sách mua sắm</h3>
                        </div>
                        <div class="text-headline-lg font-headline-lg text-primary mb-1">3</div>
                        <p class="text-on-surface-variant text-sm">Danh sách đang hoạt động</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-xs text-on-surface-variant line-clamp-1">Thực phẩm hàng tuần, Đồ tiệc...</p>
                        <span class="material-symbols-outlined text-primary">arrow_forward</span>
                    </div>
                </a>
            </div>

            <!-- Recent Orders -->
            <section class="flex flex-col gap-4">
                <div class="flex justify-between items-end mb-2">
                    <h2 class="font-headline-lg text-[24px] text-primary">Đơn hàng gần đây</h2>
                    <a class="font-label-md text-label-md text-primary hover:underline" href="{{ route('account.orders') }}">Xem tất cả</a>
                </div>
                
                <div class="flex flex-col gap-3">
                    @forelse($orders as $order)
                        <div class="glass-tier-2 rounded-xl p-4 flex flex-col md:flex-row justify-between md:items-center gap-4 hover:bg-white/40 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-primary shadow-sm">
                                    <span class="material-symbols-outlined">local_mall</span>
                                </div>
                                <div>
                                    <h4 class="font-label-md text-label-md text-on-surface">Đơn hàng #{{ $order->order_number }}</h4>
                                    <p class="text-sm text-on-surface-variant">
                                        @if($order->status === 'pending') Chờ xử lý
                                        @elseif($order->status === 'processing') Đang chuẩn bị
                                        @elseif($order->status === 'completed') Đã giao
                                        @elseif($order->status === 'cancelled') Đã hủy
                                        @endif
                                        • {{ $order->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between md:justify-end gap-6 w-full md:w-auto">
                                <span class="font-label-md text-label-md text-on-surface">{{ number_format($order->total_amount) }}đ</span>
                                <button class="text-primary hover:bg-primary/10 p-2 rounded-full transition-colors flex items-center gap-2 text-sm font-semibold">
                                    <span class="material-symbols-outlined text-[20px]">refresh</span> Mua lại
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="glass-tier-2 rounded-3xl p-12 text-center">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">receipt_long</span>
                            <h3 class="text-2xl font-bold text-primary mb-2">Chưa có đơn hàng nào</h3>
                            <p class="text-on-surface-variant mb-6">Bạn chưa thực hiện bất kỳ giao dịch nào.</p>
                            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary py-3 px-8 rounded-full font-label-md text-label-md shadow-md hover:bg-primary/90 transition-colors">Bắt đầu mua sắm</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Saved Addresses -->
                <section class="flex flex-col gap-4">
                    <div class="flex justify-between items-end mb-2">
                        <h2 class="font-headline-lg text-[24px] text-primary">Địa chỉ đã lưu</h2>
                        <button class="font-label-md text-label-md text-primary flex items-center gap-1 hover:underline">
                            <span class="material-symbols-outlined text-[18px]">add</span> Thêm
                        </button>
                    </div>
                    <div class="glass-tier-2 rounded-[20px] p-5 flex flex-col gap-3 relative overflow-hidden group hover:bg-white/40 transition-all cursor-pointer">
                        <div class="absolute top-5 right-5 text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-primary text-[20px]" style="font-variation-settings: 'FILL' 1;">home</span>
                            <span class="font-label-md text-label-md text-on-surface">Nhà</span>
                            <span class="bg-primary-container text-on-primary-container text-xs px-2 py-0.5 rounded-full ml-2">Mặc định</span>
                        </div>
                        <p class="text-on-surface-variant text-sm">
                            123 Green Street, Apt 4B<br/>
                            San Francisco, CA 94105<br/>
                            United States
                        </p>
                    </div>
                </section>

                <!-- Payment Methods -->
                <section class="flex flex-col gap-4">
                    <div class="flex justify-between items-end mb-2">
                        <h2 class="font-headline-lg text-[24px] text-primary">Phương thức thanh toán</h2>
                        <button class="font-label-md text-label-md text-primary flex items-center gap-1 hover:underline">
                            <span class="material-symbols-outlined text-[18px]">add</span> Thêm
                        </button>
                    </div>
                    <div class="glass-tier-2 rounded-[20px] p-5 flex items-center gap-4 relative overflow-hidden group hover:bg-white/40 transition-all cursor-pointer">
                        <div class="absolute top-1/2 -translate-y-1/2 right-5 text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                        <div class="w-14 h-10 bg-white rounded-md flex items-center justify-center shadow-sm border border-outline-variant/30">
                            <!-- Simulated Visa Card Icon -->
                            <span class="text-blue-800 font-bold italic text-sm">VISA</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-label-md text-label-md text-on-surface flex items-center gap-2">
                                •••• •••• •••• 4242
                                <span class="bg-primary-container text-on-primary-container text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider">Mặc định</span>
                            </span>
                            <span class="text-on-surface-variant text-xs mt-1">Hết hạn 12/25</span>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-layouts.app>
