<x-layouts.app title="Điều khoản sử dụng - MiniMart">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                Điều khoản sử dụng
            </span>
        </nav>

        <!-- Pill Header -->
        <div class="pt-2 pb-8 w-full flex justify-center">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-white/50 rounded-full px-8 md:px-12 py-3.5 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-2xl md:text-3xl">gavel</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-green-900">Điều Khoản Sử Dụng Dịch Vụ</h1>
            </div>
        </div>

        <!-- Central Liquid Glass Pane -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-12 space-y-10 relative overflow-hidden">
            <!-- Lời mở đầu -->
            <div class="bg-gradient-to-r from-amber-500/10 via-green-500/10 to-emerald-500/10 p-6 rounded-2xl border border-green-600/20 flex flex-col sm:flex-row items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-600 to-green-700 text-white flex items-center justify-center shrink-0 shadow-lg shadow-green-700/30">
                    <span class="material-symbols-outlined text-3xl">contract</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-green-900 mb-1">Thỏa Thuận Người Dùng & Dịch Vụ MiniMart</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Chào mừng quý khách đến với hệ thống thương mại điện tử MiniMart. Việc quý khách truy cập, đăng ký tài khoản hoặc hoàn tất đặt hàng đồng nghĩa với việc quý khách đã đồng ý và tuân thủ các điều khoản dịch vụ được nêu dưới đây.
                    </p>
                </div>
            </div>

            <!-- Mục 1: Nguyên tắc chung -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">1</div>
                    <h2 class="text-xl font-bold text-gray-900">Quy Định Chung & Đối Tượng Sử Dụng</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <p class="leading-relaxed">
                        Dịch vụ của MiniMart hướng đến việc cung cấp thực phẩm tươi sống, nông sản, hóa mỹ phẩm gia dụng tiêu dùng cho cá nhân và gia đình tại Việt Nam. Khách hàng sử dụng nền tảng phải có năng lực hành vi dân sự đầy đủ theo luật định để thực hiện các giao dịch thanh toán trực tuyến hoặc mua sắm hàng hóa.
                    </p>
                </div>
            </section>

            <!-- Mục 2: Tài khoản & Trách nhiệm -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">2</div>
                    <h2 class="text-xl font-bold text-gray-900">Quản Lý Tài Khoản & Mật Khẩu</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">verified_user</span>
                            Tính Chính Xác Của Thông Tin
                        </div>
                        <p class="text-gray-600 leading-relaxed">Khách hàng có nghĩa vụ cung cấp thông tin liên hệ, số điện thoại và địa chỉ nhận hàng trung thực để nhân viên xử lý giao nhận kịp thời.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">key</span>
                            Bảo Mật Thông Tin Đăng Nhập
                        </div>
                        <p class="text-gray-600 leading-relaxed">Quý khách chịu trách nhiệm tự bảo vệ mật khẩu của mình và cần thông báo ngay cho ban quản trị nếu phát hiện dấu hiệu xâm nhập trái phép.</p>
                    </div>
                </div>
            </section>

            <!-- Mục 3: Đặt hàng & Giá bán -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">3</div>
                    <h2 class="text-xl font-bold text-gray-900">Giá Cả, Đặt Hàng & Thanh Toán</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <ul class="list-disc pl-5 space-y-2 text-gray-600 leading-relaxed">
                        <li><strong>Giá niêm yết:</strong> Toàn bộ giá bán sản phẩm hiển thị trên website là giá đã bao gồm thuế Giá trị gia tăng (VAT). Giá chưa bao gồm cước phí vận chuyển (nếu có đối với đơn dưới 300.000đ).</li>
                        <li><strong>Xác nhận đơn hàng:</strong> Sau khi hoàn tất đặt hàng qua giao diện web, hệ thống sẽ gửi thông báo xác nhận và mã đơn hàng tương ứng. MiniMart có quyền liên hệ xác minh thông tin đơn hàng trước khi xuất kho.</li>
                        <li><strong>Phương thức thanh toán:</strong> MiniMart hỗ trợ các hình thức thanh toán đa dạng: Tiền mặt khi nhận hàng (COD), Ví điện tử MoMo và chuyển khoản bảo mật.</li>
                    </ul>
                </div>
            </section>

            <!-- Mục 4: Quyền sở hữu trí tuệ -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">4</div>
                    <h2 class="text-xl font-bold text-gray-900">Bản Quyền & Quyền Sở Hữu Trí Tuệ</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <p class="leading-relaxed">
                        Mọi tài sản thuộc bản quyền gồm biểu tượng thương hiệu MiniMart, hình ảnh chụp sản phẩm thực tế, video, bộ giao diện tương tác phong cách Liquid Glass và nội dung văn bản đều thuộc quyền sở hữu hợp pháp của MiniMart. Mọi hành vi sao chép, trích xuất dữ liệu tự động hoặc tái sử dụng nhằm mục đích thương mại khi chưa có văn bản chấp thuận đều là vi phạm pháp luật.
                    </p>
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
