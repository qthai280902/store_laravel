<x-layouts.app title="Chính sách đổi trả 24h - MiniMart">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                Chính sách đổi trả 24h
            </span>
        </nav>

        <!-- Pill Header -->
        <div class="pt-2 pb-8 w-full flex justify-center">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-white/50 rounded-full px-8 md:px-12 py-3.5 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-2xl md:text-3xl">published_with_changes</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-green-900">Chính Sách Đổi Trả 24 Giờ</h1>
            </div>
        </div>

        <!-- Central Liquid Glass Pane -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-12 space-y-10 relative overflow-hidden">
            <!-- Cam kết mở đầu -->
            <div class="bg-gradient-to-r from-green-500/10 via-emerald-500/10 to-transparent p-6 rounded-2xl border border-green-600/20 flex flex-col sm:flex-row items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-green-600 text-white flex items-center justify-center shrink-0 shadow-lg shadow-green-600/30">
                    <span class="material-symbols-outlined text-3xl">verified</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-green-900 mb-1">Cam kết 100% Thực phẩm Tươi Sạch</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        MiniMart luôn đặt trải nghiệm và sự an tâm của khách hàng lên hàng đầu. Bất kỳ sản phẩm tươi sống, rau củ quả hay thực phẩm nào không đạt tiêu chuẩn tươi ngon, quý khách đều được quyền yêu cầu đổi mới 100% hoặc hoàn tiền ngay trong 24 giờ.
                    </p>
                </div>
            </div>

            <!-- Mục 1: Điều kiện áp dụng đổi trả -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">1</div>
                    <h2 class="text-xl font-bold text-gray-900">Trường Hợp Được Áp Dụng Đổi Trả</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                            Rau củ & Trái cây
                        </div>
                        <p class="text-gray-600 leading-relaxed">Bị dập úng, héo úa, sâu bệnh bên trong hoặc có dấu hiệu hư hỏng không thể sử dụng.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                            Thịt, Cá & Thủy hải sản
                        </div>
                        <p class="text-gray-600 leading-relaxed">Mất độ tươi, có mùi lạ, bị đổi màu hoặc bao bì hút chân không bị xì, rách khi nhận hàng.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                            Giao Sai Hoặc Thiếu Hàng
                        </div>
                        <p class="text-gray-600 leading-relaxed">Sản phẩm thực nhận không đúng quy cách, trọng lượng hoặc loại mặt hàng đã đặt trong hóa đơn.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                            Hàng Lỗi Kỹ Thuật / Hết Hạn
                        </div>
                        <p class="text-gray-600 leading-relaxed">Hàng hóa đóng gói cận ngày hoặc quá hạn sử dụng (EXP), bao bì móp méo gây ảnh hưởng chất lượng.</p>
                    </div>
                </div>
            </section>

            <!-- Mục 2: Thời hạn thông báo đổi trả -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">2</div>
                    <h2 class="text-xl font-bold text-gray-900">Thời Gian Tiếp Nhận Yêu Cầu</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm">
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-[20px] mt-0.5 shrink-0">timer</span>
                            <span><strong>Thực phẩm tươi sống, rau củ quả, đồ đông lạnh:</strong> Trong vòng <strong>24 giờ</strong> kể từ thời điểm nhận hàng thành công.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-[20px] mt-0.5 shrink-0">schedule</span>
                            <span><strong>Thực phẩm khô, bơ sữa đóng hộp, gia vị, bánh kẹo:</strong> Trong vòng <strong>48 giờ</strong> kể từ thời điểm nhận hàng.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-[20px] mt-0.5 shrink-0">event_note</span>
                            <span><strong>Hóa mỹ phẩm & Đồ gia dụng:</strong> Trong vòng <strong>03 ngày</strong> (yêu cầu sản phẩm chưa mở niêm phong).</span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Mục 3: Quy trình 3 bước xử lý -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">3</div>
                    <h2 class="text-xl font-bold text-gray-900">Quy Trình Xử Lý Đổi Trả Đơn Giản</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-2xl p-5 text-center space-y-3">
                        <div class="w-12 h-12 mx-auto rounded-full bg-green-100 text-green-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">photo_camera</span>
                        </div>
                        <h4 class="font-bold text-green-900">Bước 1: Chụp Ảnh Lỗi</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Chụp ảnh hoặc quay video ngắn sản phẩm bị lỗi kèm hóa đơn hoặc tem dán trên bao bì.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-2xl p-5 text-center space-y-3">
                        <div class="w-12 h-12 mx-auto rounded-full bg-green-100 text-green-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">headset_mic</span>
                        </div>
                        <h4 class="font-bold text-green-900">Bước 2: Gửi Yêu Cầu</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Liên hệ Hotline <strong>1900 1234</strong> hoặc nhắn tin qua Zalo CSKH MiniMart để cung cấp thông tin.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-2xl p-5 text-center space-y-3">
                        <div class="w-12 h-12 mx-auto rounded-full bg-green-100 text-green-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">swap_horiz</span>
                        </div>
                        <h4 class="font-bold text-green-900">Bước 3: Đổi Hàng Tận Nơi</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Shipper sẽ giao sản phẩm mới đổi tận nhà hoặc tài khoản của quý khách được hoàn tiền ngay.</p>
                    </div>
                </div>
            </section>

            <!-- Mục 4: Phương thức hoàn tiền -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">4</div>
                    <h2 class="text-xl font-bold text-gray-900">Hình Thức Hoàn Tiền</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                        <div class="p-4 rounded-xl bg-green-50/50 border border-green-100">
                            <span class="material-symbols-outlined text-green-600 text-3xl mb-2">account_balance_wallet</span>
                            <div class="font-bold text-gray-900 text-sm">Ví Điện Tử / MoMo</div>
                            <div class="text-xs text-gray-500 mt-1">Hoàn tức thì trong 15 phút</div>
                        </div>
                        <div class="p-4 rounded-xl bg-green-50/50 border border-green-100">
                            <span class="material-symbols-outlined text-green-600 text-3xl mb-2">credit_card</span>
                            <div class="font-bold text-gray-900 text-sm">Tài Khoản Ngân Hàng</div>
                            <div class="text-xs text-gray-500 mt-1">Xử lý trong 24h - 48h làm việc</div>
                        </div>
                        <div class="p-4 rounded-xl bg-green-50/50 border border-green-100">
                            <span class="material-symbols-outlined text-green-600 text-3xl mb-2">confirmation_number</span>
                            <div class="font-bold text-gray-900 text-sm">Voucher MiniMart</div>
                            <div class="text-xs text-gray-500 mt-1">Cộng thêm 10% giá trị bồi hoàn</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Khối Hỗ trợ khẩn cấp -->
            <div class="p-6 rounded-2xl bg-white/70 backdrop-blur-md border border-white/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <div>
                    <h4 class="font-bold text-green-900 text-base">Cần hỗ trợ đổi trả ngay lập tức?</h4>
                    <p class="text-sm text-gray-600 mt-0.5">Tổng đài viên MiniMart luôn sẵn sàng đồng hành cùng quý khách từ 07:00 đến 22:00.</p>
                </div>
                <a href="tel:19001234" class="px-6 py-3 rounded-full bg-gradient-to-r from-green-600 to-emerald-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2 shrink-0">
                    <span class="material-symbols-outlined text-[18px]">phone_in_talk</span>
                    Hotline: 1900 1234
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
