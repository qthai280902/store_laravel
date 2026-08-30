<x-layouts.app title="Bảng điều khiển tài khoản - MiniMart">
    <div class="flex max-w-max_width mx-auto pt-24 md:pt-margin_desktop px-gutter min-h-screen gap-6" x-data="{ activeTab: 'profile' }">
        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden md:flex flex-col w-[280px] glass-tier-2 rounded-2xl p-6 h-[calc(100vh-80px)] sticky top-margin_desktop shadow-lg flex-shrink-0" data-aos="fade-right">
            <div class="font-display-lg text-headline-lg font-extrabold text-primary mb-8 tracking-tight">MiniMart</div>
            <nav class="flex flex-col gap-2 flex-grow">
                <button @click="activeTab = 'profile'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left" :class="activeTab === 'profile' ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'profile' ? 'font-variation-settings: \'FILL\' 1;' : ''">person</span>
                    Hồ sơ
                </button>
                <button @click="activeTab = 'orders'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left" :class="activeTab === 'orders' ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'orders' ? 'font-variation-settings: \'FILL\' 1;' : ''">receipt_long</span>
                    Đơn hàng
                </button>
                <button @click="activeTab = 'address'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left" :class="activeTab === 'address' ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'address' ? 'font-variation-settings: \'FILL\' 1;' : ''">location_on</span>
                    Địa chỉ
                </button>
                <button @click="activeTab = 'payment'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left" :class="activeTab === 'payment' ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'payment' ? 'font-variation-settings: \'FILL\' 1;' : ''">payment</span>
                    Phương thức thanh toán
                </button>
                <button @click="activeTab = 'settings'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left" :class="activeTab === 'settings' ? 'bg-primary-container text-on-primary-container' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'settings' ? 'font-variation-settings: \'FILL\' 1;' : ''">settings</span>
                    Cài đặt
                </button>
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
        <main class="flex-grow flex flex-col gap-8 pb-margin_desktop w-full" data-aos="fade-up" data-aos-delay="100">
            <header>
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2" x-text="
                    activeTab === 'profile' ? 'Hồ sơ cá nhân' : 
                    (activeTab === 'orders' ? 'Đơn hàng của tôi' : 
                    (activeTab === 'address' ? 'Sổ địa chỉ' : 
                    (activeTab === 'payment' ? 'Phương thức thanh toán' : 'Cài đặt tài khoản')))
                "></h1>
                <p class="text-on-surface-variant">Quản lý thông tin và tùy chọn của bạn.</p>
            </header>

            <!-- TAB: PROFILE -->
            <div x-show="activeTab === 'profile'" x-transition.opacity.duration.400ms style="display: none;" class="flex flex-col gap-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Profile Summary -->
                    <section class="lg:col-span-2 glass-tier-3 rounded-[24px] p-8 shadow-xl flex flex-col md:flex-row gap-8 items-center relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-primary-fixed/20 rounded-full blur-2xl z-0"></div>
                        <div class="relative z-10 w-32 h-32 rounded-full border-4 border-white/50 overflow-hidden shadow-lg flex-shrink-0 bg-white">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=00490e&color=fff&size=200" alt="Avatar" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="relative z-10 flex flex-col gap-2 flex-grow text-center md:text-left">
                            <h2 class="font-headline-lg text-[24px] text-primary">{{ $user->name }}</h2>
                            <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2">
                                <span class="material-symbols-outlined text-[20px]">mail</span> {{ $user->email }}
                            </p>
                            <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2">
                                <span class="material-symbols-outlined text-[20px]">phone</span> {{ $user->phone ?? 'Chưa cập nhật' }}
                            </p>
                            <div class="mt-2 flex gap-4 justify-center md:justify-start">
                                <span class="inline-block bg-white/60 backdrop-blur-md border border-green-200 text-green-800 rounded-full px-4 py-1 text-sm font-bold shadow-sm">Khách hàng</span>
                            </div>
                        </div>
                    </section>

                    <!-- Mini Stats -->
                    <div class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group">
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
                    </div>

                    <!-- Shopping Lists -->
                    <div class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">list_alt</span>
                                <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider group-hover:text-primary transition-colors">Danh sách mua sắm</h3>
                            </div>
                            <div class="text-headline-lg font-headline-lg text-primary mb-1">3</div>
                            <p class="text-on-surface-variant text-sm">Danh sách đang hoạt động</p>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-xs text-on-surface-variant line-clamp-1">Thực phẩm tuần...</p>
                            <span class="material-symbols-outlined text-primary">arrow_forward</span>
                        </div>
                    </div>
                </div>

                <!-- Form cập nhật thông tin -->
                <section class="glass-tier-3 rounded-[24px] p-8 shadow-xl">
                    <h3 class="font-headline-lg text-[20px] text-primary mb-6">Cập nhật thông tin</h3>
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tên hiển thị</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="glass-tier-2 border border-outline-variant/30 rounded-2xl px-6 py-4 outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Giới tính</label>
                                <select name="gender" class="glass-tier-2 border border-outline-variant/30 rounded-2xl px-6 py-4 outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full transition-all appearance-none cursor-pointer">
                                    <option value="" disabled {{ !$user->gender ? 'selected' : '' }}>Chọn giới tính</option>
                                    <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                    <option value="Khác" {{ $user->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Ngày sinh</label>
                                <input type="date" name="dob" value="{{ $user->dob }}" class="glass-tier-2 border border-outline-variant/30 rounded-2xl px-6 py-4 outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" name="phone" value="{{ $user->phone }}" class="glass-tier-2 border border-outline-variant/30 rounded-2xl px-6 py-4 outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ</label>
                            <input type="text" name="address" value="{{ $user->address }}" class="glass-tier-2 border border-outline-variant/30 rounded-2xl px-6 py-4 outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full transition-all">
                        </div>

                        <div class="flex gap-4 pt-4 mt-6 border-t border-outline-variant/30">
                            <button type="submit" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-3 rounded-full shadow-md hover:opacity-90 transition-opacity">Lưu thay đổi</button>
                            <button type="button" class="text-primary hover:bg-primary/10 font-label-md text-label-md px-8 py-3 rounded-full transition-colors">Đổi mật khẩu</button>
                        </div>
                    </form>
                </section>
            </div>

            <!-- TAB: ORDERS -->
            <div x-show="activeTab === 'orders'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="flex flex-col gap-4">
                    @if(isset($orders) && $orders->count() > 0)
                        <div class="flex flex-col gap-3">
                            @foreach($orders as $order)
                                <div class="glass-tier-2 rounded-xl p-4 flex flex-col md:flex-row justify-between md:items-center gap-4 hover:bg-white/40 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/60 rounded-lg flex items-center justify-center text-primary shadow-sm">
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
                            @endforeach
                        </div>
                    @else
                        <div class="glass-tier-2 rounded-3xl p-12 text-center">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">receipt_long</span>
                            <h3 class="text-2xl font-bold text-primary mb-2">Chưa có đơn hàng nào</h3>
                            <p class="text-on-surface-variant mb-6">Bạn chưa thực hiện bất kỳ giao dịch nào.</p>
                            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary py-3 px-8 rounded-full font-label-md text-label-md shadow-md hover:bg-primary/90 transition-colors">Bắt đầu mua sắm</a>
                        </div>
                    @endif
                </section>
            </div>

            <!-- TAB: ADDRESS -->
            <div x-show="activeTab === 'address'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-12 text-center">
                    <span class="material-symbols-outlined text-[64px] text-primary/40 mb-4">location_on</span>
                    <h3 class="text-2xl font-bold text-primary mb-2">Địa chỉ giao hàng</h3>
                    <p class="text-on-surface-variant mb-6">Thêm địa chỉ giao hàng để trải nghiệm mua sắm nhanh chóng hơn.</p>
                    <button class="bg-primary text-on-primary font-label-md text-label-md px-8 py-3 rounded-full shadow-md hover:opacity-90 transition-opacity">Thêm địa chỉ mới</button>
                </section>
            </div>

            <!-- TAB: PAYMENT -->
            <div x-show="activeTab === 'payment'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-12 text-center">
                    <span class="material-symbols-outlined text-[64px] text-primary/40 mb-4">credit_card</span>
                    <h3 class="text-2xl font-bold text-primary mb-2">Phương thức thanh toán</h3>
                    <p class="text-on-surface-variant mb-6">Hệ thống đang hỗ trợ thanh toán tiền mặt (COD) và Ví MoMo.</p>
                </section>
            </div>

            <!-- TAB: SETTINGS -->
            <div x-show="activeTab === 'settings'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-12 text-center">
                    <span class="material-symbols-outlined text-[64px] text-primary/40 mb-4">settings</span>
                    <h3 class="text-2xl font-bold text-primary mb-2">Cài đặt hệ thống</h3>
                    <p class="text-on-surface-variant mb-6">Tùy chỉnh nhận thông báo khuyến mãi qua email và tin nhắn.</p>
                </section>
            </div>

        </main>
    </div>
</x-layouts.app>
