<x-layouts.app title="Bảng điều khiển tài khoản - MiniMart">
    <div class="flex max-w-max_width mx-auto pt-24 md:pt-margin_desktop px-gutter min-h-screen gap-6" 
         x-data="{ 
             activeTab: 'profile',
             passwordModal: {{ $errors->has('current_password') || $errors->has('password') ? 'true' : 'false' }},
             addressModal: false,
             paymentModal: false,
             avatarPreview: null,
             previewAvatar(event) {
                 const file = event.target.files[0];
                 if (file) {
                     const reader = new FileReader();
                     reader.onload = (e) => {
                         this.avatarPreview = e.target.result;
                     };
                     reader.readAsDataURL(file);
                     // Tự động submit form tải avatar lên
                     this.$nextTick(() => {
                         document.getElementById('avatarForm').submit();
                     });
                 }
             }
         }">

        <!-- Floating Glass Toast -->
        @if(session('success') || session('error'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-[-20px] scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-[-20px] scale-95"
                 class="fixed top-24 right-6 z-[120]" 
                 style="display: none;">
                @if(session('success'))
                    <div class="bg-emerald-500/20 backdrop-blur-2xl border border-emerald-400/60 shadow-[0_8px_30px_rgba(16,185,129,0.2)] text-emerald-950 px-6 py-3.5 rounded-full flex items-center gap-3 font-semibold">
                        <span class="material-symbols-outlined text-emerald-700 text-[22px]">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-500/20 backdrop-blur-2xl border border-red-400/60 shadow-[0_8px_30px_rgba(239,68,68,0.2)] text-red-950 px-6 py-3.5 rounded-full flex items-center gap-3 font-semibold">
                        <span class="material-symbols-outlined text-red-700 text-[22px]">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>
        @endif

        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden md:flex flex-col w-[280px] glass-tier-2 rounded-2xl p-6 h-[calc(100vh-80px)] sticky top-margin_desktop shadow-lg flex-shrink-0" data-aos="fade-right">
            <div class="font-display-lg text-headline-lg font-extrabold text-primary mb-8 tracking-tight">MiniMart</div>
            <nav class="flex flex-col gap-2 flex-grow">
                <button @click="activeTab = 'profile'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left cursor-pointer" :class="activeTab === 'profile' ? 'bg-primary-container text-on-primary-container shadow-sm' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'profile' ? 'font-variation-settings: \'FILL\' 1;' : ''">person</span>
                    Hồ sơ
                </button>
                <button @click="activeTab = 'orders'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left cursor-pointer" :class="activeTab === 'orders' ? 'bg-primary-container text-on-primary-container shadow-sm' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'orders' ? 'font-variation-settings: \'FILL\' 1;' : ''">receipt_long</span>
                    Đơn hàng
                </button>
                <button @click="activeTab = 'address'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left cursor-pointer" :class="activeTab === 'address' ? 'bg-primary-container text-on-primary-container shadow-sm' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'address' ? 'font-variation-settings: \'FILL\' 1;' : ''">location_on</span>
                    Địa chỉ
                </button>
                <button @click="activeTab = 'payment'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left cursor-pointer" :class="activeTab === 'payment' ? 'bg-primary-container text-on-primary-container shadow-sm' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'payment' ? 'font-variation-settings: \'FILL\' 1;' : ''">payment</span>
                    Phương thức thanh toán
                </button>
                <button @click="activeTab = 'settings'" class="rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all text-left cursor-pointer" :class="activeTab === 'settings' ? 'bg-primary-container text-on-primary-container shadow-sm' : 'text-on-surface-variant hover:bg-white/40'">
                    <span class="material-symbols-outlined" :style="activeTab === 'settings' ? 'font-variation-settings: \'FILL\' 1;' : ''">settings</span>
                    Cài đặt
                </button>
            </nav>
            <div class="mt-auto pt-6 border-t border-outline-variant/30">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-error hover:bg-error/10 rounded-xl flex items-center gap-4 p-4 font-label-md text-label-md transition-all cursor-pointer text-left font-semibold">
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
                <p class="text-on-surface-variant">Quản lý thông tin và tùy chọn tài khoản của bạn.</p>
            </header>

            <!-- TAB: PROFILE -->
            <div x-show="activeTab === 'profile'" x-transition.opacity.duration.400ms style="display: none;" class="flex flex-col gap-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Profile Summary -->
                    <section class="lg:col-span-2 glass-tier-3 rounded-[24px] p-8 shadow-xl flex flex-col md:flex-row gap-8 items-center relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-primary-fixed/20 rounded-full blur-2xl z-0"></div>
                        
                        <!-- Avatar Uploader Form -->
                        <form id="avatarForm" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" class="relative group">
                            @csrf
                            <div class="relative z-10 w-32 h-32 rounded-full border-4 border-white/80 overflow-hidden shadow-xl flex-shrink-0 bg-white ring-2 ring-green-600/30">
                                <img :src="avatarPreview ? avatarPreview : '{{ $user->avatar ? (str_starts_with($user->avatar, 'http') || str_starts_with($user->avatar, '/') ? $user->avatar : asset('storage/' . $user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=00490e&color=fff&size=200' }}'" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full object-cover">
                                
                                <label for="avatarInput" class="absolute inset-0 bg-black/40 backdrop-blur-sm flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 cursor-pointer">
                                    <span class="material-symbols-outlined text-[28px]">photo_camera</span>
                                    <span class="text-[11px] font-bold mt-1">Đổi avatar</span>
                                </label>
                                <input type="file" id="avatarInput" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" @change="previewAvatar($event)">
                            </div>
                        </form>

                        <div class="relative z-10 flex flex-col gap-2 flex-grow text-center md:text-left">
                            <h2 class="font-headline-lg text-[24px] text-primary font-bold">{{ $user->name }}</h2>
                            <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2 text-sm">
                                <span class="material-symbols-outlined text-[18px]">mail</span> {{ $user->email }}
                            </p>
                            <p class="text-on-surface-variant flex items-center justify-center md:justify-start gap-2 text-sm">
                                <span class="material-symbols-outlined text-[18px]">phone</span> {{ $user->phone ?? 'Chưa cập nhật SĐT' }}
                            </p>
                            <div class="mt-2 flex gap-4 justify-center md:justify-start">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 bg-red-500/10 backdrop-blur-md border border-red-200 text-red-700 rounded-full px-4 py-1 text-sm font-bold shadow-sm">
                                        <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span> Quản trị viên
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-white/60 backdrop-blur-md border border-green-200 text-green-800 rounded-full px-4 py-1 text-sm font-bold shadow-sm">
                                        <span class="material-symbols-outlined text-[16px]">verified</span> Khách hàng thân thiết
                                    </span>
                                @endif
                            </div>
                        </div>
                    </section>

                    <!-- Mini Stats -->
                    <div class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group">
                        <div>
                            <h3 class="font-label-md text-label-md text-on-surface-variant mb-4 uppercase tracking-wider group-hover:text-primary transition-colors font-bold">Điểm thưởng</h3>
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

                    <!-- Orders Quick Overview -->
                    <div @click="activeTab = 'orders'" class="lg:col-span-1 glass-tier-3 rounded-[24px] p-6 shadow-xl flex flex-col justify-between hover:bg-white/40 transition-colors cursor-pointer group">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">receipt_long</span>
                                <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider group-hover:text-primary transition-colors font-bold">Đơn hàng</h3>
                            </div>
                            <div class="text-headline-lg font-headline-lg text-primary mb-1">{{ isset($orders) ? $orders->count() : 0 }}</div>
                            <p class="text-on-surface-variant text-sm">Tổng đơn đã đặt</p>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-xs text-on-surface-variant">Xem chi tiết đơn</p>
                            <span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </div>
                    </div>
                </div>

                <!-- Form cập nhật thông tin -->
                <section class="glass-tier-3 rounded-[24px] p-8 shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-headline-lg text-[20px] text-primary font-bold">Cập nhật thông tin cá nhân</h3>
                        @if ($errors->any())
                            <span class="text-xs text-red-600 bg-red-100/80 px-3 py-1 rounded-full font-semibold">
                                Vui lòng kiểm tra lại thông tin
                            </span>
                        @endif
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                                @error('name')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Giới tính</label>
                                <div x-data="{ open: false, selected: '{{ old('gender', $user->gender ?? '') }}' }" class="relative">
                                    <input type="hidden" name="gender" :value="selected">
                                    <button @click="open = !open" type="button" class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all text-left flex justify-between items-center cursor-pointer">
                                        <span x-text="selected ? selected : 'Chọn giới tính'" :class="{'text-gray-500': !selected}"></span>
                                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300" :class="{'rotate-180': open}">expand_more</span>
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                         class="absolute z-50 mt-2 w-full bg-white/80 backdrop-blur-[24px] border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden" style="display: none;">
                                        <ul class="py-2">
                                            <template x-for="option in ['Nam', 'Nữ', 'Khác']">
                                                <li>
                                                    <button type="button" @click="selected = option; open = false" 
                                                            class="w-full text-left px-6 py-3 hover:bg-white/60 transition-colors text-gray-900 font-medium"
                                                            :class="{'bg-green-600/15 text-green-900 font-bold': selected === option}">
                                                        <span x-text="option"></span>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Ngày sinh</label>
                                <input type="text" x-init="flatpickr($el, {dateFormat: 'Y-m-d', altInput: true, altFormat: 'd/m/Y'})" 
                                       name="dob" value="{{ old('dob', $user->dob) }}" 
                                       placeholder="Chọn ngày sinh"
                                       class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                                @error('dob')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" 
                                       placeholder="Ví dụ: 0901234567"
                                       class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                                @error('phone')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ giao hàng mặc định</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" 
                                   placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                   class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                            @error('address')
                                <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap gap-4 pt-4 mt-6 border-t border-outline-variant/30">
                            <button type="submit" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-3.5 rounded-full shadow-md hover:bg-primary-container hover:text-on-primary-container cursor-pointer transition-all">
                                Lưu thay đổi
                            </button>
                            <button type="button" @click="passwordModal = true" class="bg-white/60 hover:bg-white/90 backdrop-blur-lg border border-white/80 shadow-sm text-green-900 font-label-md text-label-md px-8 py-3.5 rounded-full transition-all flex items-center gap-2 cursor-pointer font-bold">
                                <span class="material-symbols-outlined text-[18px]">lock_reset</span> Đổi mật khẩu
                            </button>
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
                                <div class="glass-tier-2 rounded-xl p-5 flex flex-col md:flex-row justify-between md:items-center gap-4 hover:bg-white/50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/60 rounded-xl flex items-center justify-center text-primary shadow-sm border border-white/80">
                                            <span class="material-symbols-outlined">local_mall</span>
                                        </div>
                                        <div>
                                            <h4 class="font-label-md text-label-md text-on-surface font-bold">Đơn hàng #{{ $order->order_number }}</h4>
                                            <p class="text-sm text-on-surface-variant">
                                                @if($order->status === 'pending') 
                                                    <span class="inline-block px-2 py-0.5 rounded-md bg-yellow-100 text-yellow-800 text-xs font-semibold">Chờ xử lý</span>
                                                @elseif($order->status === 'processing') 
                                                    <span class="inline-block px-2 py-0.5 rounded-md bg-blue-100 text-blue-800 text-xs font-semibold">Đang chuẩn bị</span>
                                                @elseif($order->status === 'completed') 
                                                    <span class="inline-block px-2 py-0.5 rounded-md bg-green-100 text-green-800 text-xs font-semibold">Đã giao</span>
                                                @elseif($order->status === 'cancelled') 
                                                    <span class="inline-block px-2 py-0.5 rounded-md bg-red-100 text-red-800 text-xs font-semibold">Đã hủy</span>
                                                @endif
                                                • {{ $order->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between md:justify-end gap-6 w-full md:w-auto">
                                        <span class="font-label-md text-lg text-primary font-bold">{{ number_format($order->total_amount) }}đ</span>
                                        <a href="{{ route('checkout.success', $order->id) }}" class="text-primary bg-white/60 hover:bg-white border border-white/80 px-4 py-2 rounded-full transition-all flex items-center gap-1 text-sm font-semibold shadow-sm">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span> Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="glass-tier-2 rounded-3xl p-12 text-center">
                            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4 opacity-60">receipt_long</span>
                            <h3 class="text-2xl font-bold text-primary mb-2">Chưa có đơn hàng nào</h3>
                            <p class="text-on-surface-variant mb-6">Bạn chưa thực hiện bất kỳ giao dịch nào tại MiniMart.</p>
                            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-on-primary py-3 px-8 rounded-full font-label-md text-label-md shadow-md hover:bg-primary-container hover:text-on-primary-container transition-colors font-bold">Bắt đầu mua sắm</a>
                        </div>
                    @endif
                </section>
            </div>

            <!-- TAB: ADDRESS -->
            <div x-show="activeTab === 'address'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-primary">Sổ địa chỉ</h3>
                        <button @click="addressModal = true" class="bg-primary text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-full shadow-md hover:bg-primary-container hover:text-on-primary-container transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">add</span> Thêm địa chỉ mới
                        </button>
                    </div>

                    @if($user->address)
                        <div class="p-6 bg-white/60 backdrop-blur-md rounded-2xl border border-white/80 shadow-sm flex items-start justify-between">
                            <div class="flex gap-4 items-start">
                                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-800 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined">home</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h4 class="font-bold text-gray-900">{{ $user->name }}</h4>
                                        <span class="text-xs bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full font-semibold">Mặc định</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">{{ $user->phone ?? 'Chưa có SĐT' }}</p>
                                    <p class="text-sm text-gray-800 font-medium">{{ $user->address }}</p>
                                </div>
                            </div>
                            <button @click="addressModal = true" class="text-primary hover:text-green-700 text-sm font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">edit</span> Sửa
                            </button>
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <span class="material-symbols-outlined text-[64px] text-primary/40 mb-4">location_on</span>
                            <h4 class="text-xl font-bold text-primary mb-2">Chưa thiết lập địa chỉ</h4>
                            <p class="text-on-surface-variant mb-6">Thêm địa chỉ giao hàng để trải nghiệm thanh toán thuận tiện hơn.</p>
                            <button @click="addressModal = true" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-3 rounded-full shadow-md hover:opacity-90 transition-opacity">Thêm địa chỉ ngay</button>
                        </div>
                    @endif
                </section>
            </div>

            <!-- TAB: PAYMENT -->
            <div x-show="activeTab === 'payment'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6">Phương thức thanh toán</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-6 bg-white/60 backdrop-blur-md rounded-2xl border border-white/80 shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center font-bold text-lg">
                                    MoMo
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Ví MoMo</h4>
                                    <p class="text-xs text-gray-500">Thanh toán qua quét mã QR MoMo</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs text-green-700 bg-green-100 px-3 py-1 rounded-full font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Khả dụng
                            </span>
                        </div>

                        <div class="p-6 bg-white/60 backdrop-blur-md rounded-2xl border border-white/80 shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Thanh toán khi nhận hàng (COD)</h4>
                                    <p class="text-xs text-gray-500">Thanh toán tiền mặt cho nhân viên giao vận</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs text-green-700 bg-green-100 px-3 py-1 rounded-full font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Mặc định
                            </span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- TAB: SETTINGS -->
            <div x-show="activeTab === 'settings'" x-transition.opacity.duration.400ms style="display: none;">
                <section class="glass-tier-2 rounded-[24px] p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6">Cài đặt tài khoản & thông báo</h3>
                    
                    <div class="space-y-4 max-w-xl">
                        <label class="flex items-center justify-between p-4 bg-white/60 backdrop-blur-md rounded-2xl border border-white/80 cursor-pointer">
                            <div>
                                <h4 class="font-bold text-gray-900">Thông báo khuyến mãi</h4>
                                <p class="text-xs text-gray-500">Nhận ưu đãi và mã giảm giá hàng tuần qua email</p>
                            </div>
                            <input type="checkbox" checked class="w-5 h-5 accent-green-800 rounded">
                        </label>

                        <label class="flex items-center justify-between p-4 bg-white/60 backdrop-blur-md rounded-2xl border border-white/80 cursor-pointer">
                            <div>
                                <h4 class="font-bold text-gray-900">Cập nhật đơn hàng</h4>
                                <p class="text-xs text-gray-500">Nhận thông báo khi trạng thái đơn hàng thay đổi</p>
                            </div>
                            <input type="checkbox" checked class="w-5 h-5 accent-green-800 rounded">
                        </label>
                    </div>
                </section>
            </div>

        </main>

        <!-- Liquid Glass Modal: Đổi mật khẩu -->
        <div x-show="passwordModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/30 backdrop-blur-md" 
             style="display: none;">
            
            <div @click.away="passwordModal = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="bg-white/60 backdrop-blur-3xl border border-white/80 shadow-[0_25px_60px_rgba(0,0,0,0.18)] ring-1 ring-white/60 rounded-[2.5rem] p-8 w-full max-w-md relative overflow-hidden">
                
                <!-- Hiệu ứng vệt sáng Liquid Glass -->
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white to-transparent"></div>

                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-green-900/10 text-green-900 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[22px]">lock</span>
                        </div>
                        <h3 class="font-headline-lg text-xl text-primary font-bold">Đổi mật khẩu</h3>
                    </div>
                    <button type="button" @click="passwordModal = false" class="p-2 rounded-full hover:bg-white/60 text-gray-500 hover:text-gray-800 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" required placeholder="••••••••" 
                               class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-5 py-3 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                        @error('current_password')
                            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mật khẩu mới</label>
                        <input type="password" name="password" required placeholder="Tối thiểu 8 ký tự" 
                               class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-5 py-3 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                        @error('password')
                            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu mới" 
                               class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-5 py-3 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-white/60">
                        <button type="button" @click="passwordModal = false" class="px-5 py-2.5 rounded-full text-gray-600 hover:bg-white/60 font-semibold text-sm transition-colors">Hủy</button>
                        <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-bold text-sm shadow-md hover:bg-primary-container hover:text-on-primary-container transition-all">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liquid Glass Modal: Thêm / Sửa địa chỉ -->
        <div x-show="addressModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/30 backdrop-blur-md" 
             style="display: none;">
            
            <div @click.away="addressModal = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="bg-white/60 backdrop-blur-3xl border border-white/80 shadow-[0_25px_60px_rgba(0,0,0,0.18)] ring-1 ring-white/60 rounded-[2.5rem] p-8 w-full max-w-lg relative overflow-hidden">
                
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white to-transparent"></div>

                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-green-900/10 text-green-900 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[22px]">location_on</span>
                        </div>
                        <h3 class="font-headline-lg text-xl text-primary font-bold">Cập nhật địa chỉ</h3>
                    </div>
                    <button type="button" @click="addressModal = false" class="p-2 rounded-full hover:bg-white/60 text-gray-500 hover:text-gray-800 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ $user->name }}">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Số điện thoại liên hệ</label>
                        <input type="tel" name="phone" value="{{ $user->phone }}" required
                               class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-5 py-3 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Địa chỉ giao hàng chi tiết</label>
                        <textarea name="address" rows="3" required placeholder="Số nhà, tên tòa nhà, đường, phường/xã, quận/huyện, TP..."
                                  class="bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-5 py-3 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 w-full transition-all">{{ $user->address }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-white/60">
                        <button type="button" @click="addressModal = false" class="px-5 py-2.5 rounded-full text-gray-600 hover:bg-white/60 font-semibold text-sm transition-colors">Hủy</button>
                        <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-bold text-sm shadow-md hover:bg-primary-container hover:text-on-primary-container transition-all">Lưu địa chỉ</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.app>
