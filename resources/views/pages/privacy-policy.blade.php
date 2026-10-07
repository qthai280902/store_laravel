<x-layouts.app title="Chính sách bảo mật - MiniMart">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                Chính sách bảo mật
            </span>
        </nav>

        <!-- Pill Header -->
        <div class="pt-2 pb-8 w-full flex justify-center">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-white/50 rounded-full px-8 md:px-12 py-3.5 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-2xl md:text-3xl">security</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-green-900">Chính Sách Bảo Mật Thông Tin</h1>
            </div>
        </div>

        <!-- Central Liquid Glass Pane -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-12 space-y-10 relative overflow-hidden">
            <!-- Cam kết bảo mật -->
            <div class="bg-gradient-to-r from-blue-500/10 via-green-500/10 to-emerald-500/10 p-6 rounded-2xl border border-green-600/20 flex flex-col sm:flex-row items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-green-700 to-teal-600 text-white flex items-center justify-center shrink-0 shadow-lg shadow-teal-700/30">
                    <span class="material-symbols-outlined text-3xl">lock</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-green-900 mb-1">Bảo Vệ Quyền Riêng Tư Tuyệt Đối</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        MiniMart hiểu rằng thông tin cá nhân là tài sản vô giá của khách hàng. Chúng tôi cam kết ứng dụng các tiêu chuẩn an toàn bảo mật cao nhất (Mã hóa SSL 256-bit, chuẩn Bcrypt) để giữ an toàn tuyệt đối cho mọi dữ liệu của bạn.
                    </p>
                </div>
            </div>

            <!-- Mục 1: Mục đích thu thập -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">1</div>
                    <h2 class="text-xl font-bold text-gray-900">Mục Đích Thu Thập Dữ Liệu</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">shopping_bag</span>
                            Xử Lý & Điều Phối Đơn Hàng
                        </div>
                        <p class="text-gray-600 leading-relaxed">Xác nhận đơn, liên hệ địa chỉ giao nhận và phân bổ nhân sự vận chuyển đúng thời hạn cam kết.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">notifications_active</span>
                            Cập Nhật Trạng Thái Đơn
                        </div>
                        <p class="text-gray-600 leading-relaxed">Thông báo tiến độ đơn hàng qua SMS, Email hoặc thông báo đẩy trong hệ sinh thái MiniMart.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">support_agent</span>
                            Chăm Sóc & Hỗ Trợ Đổi Trả
                        </div>
                        <p class="text-gray-600 leading-relaxed">Hỗ trợ tra cứu lịch sử mua sắm để thực hiện bảo hành, đổi mới sản phẩm lỗi hoặc bồi hoàn nhanh chóng.</p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">auto_awesome</span>
                            Nâng Cao Trải Nghiệm Mua Sắm
                        </div>
                        <p class="text-gray-600 leading-relaxed">Gợi ý các mặt hàng rau quả, thực phẩm phù hợp với thói quen và khẩu vị yêu thích của từng gia đình.</p>
                    </div>
                </div>
            </section>

            <!-- Mục 2: Phạm vi thu thập -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">2</div>
                    <h2 class="text-xl font-bold text-gray-900">Phạm Vi Thu Thập Thông Tin</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <p class="text-gray-600 leading-relaxed">Các trường thông tin được ghi nhận khi quý khách đăng ký tài khoản hoặc tiến hành mua hàng bao gồm:</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-2 text-gray-800">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">badge</span>
                            <span>Họ tên đầy đủ & ngày sinh</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-800">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">phone</span>
                            <span>Số điện thoại liên hệ</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-800">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">mail</span>
                            <span>Địa chỉ thư điện tử (Email)</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-800">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">home</span>
                            <span>Địa chỉ nhận hàng chi tiết</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mục 3: Cam kết không chia sẻ dữ liệu -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">3</div>
                    <h2 class="text-xl font-bold text-gray-900">Nguyên Tắc Chia Sẻ & Bảo Mật Dữ Liệu</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <p class="leading-relaxed">
                        MiniMart <strong>tuyệt đối không kinh doanh, trao đổi, cho thuê hoặc tiết lộ</strong> thông tin cá nhân của người tiêu dùng cho bất kỳ bên thứ ba nào vì mục đích thương mại ngoài phạm vi dịch vụ của chúng tôi.
                    </p>
                    <p class="leading-relaxed">
                        Thông tin chỉ được chia sẻ trong trường hợp bắt buộc đối với đơn vị vận chuyển (để shipper liên lạc giao hàng) và cổng đối tác thanh toán tài chính (MoMo, Ngân hàng) theo giao thức bảo mật cao nhất hoặc theo yêu cầu bằng văn bản của cơ quan pháp luật có thẩm quyền.
                    </p>
                </div>
            </section>

            <!-- Mục 4: Quyền của người dùng -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">4</div>
                    <h2 class="text-xl font-bold text-gray-900">Quyền Của Quý Khách Đối Với Dữ Liệu</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <ul class="list-disc pl-5 space-y-2 text-gray-600">
                        <li>Truy cập, tra cứu, chỉnh sửa và cập nhật lại thông tin cá nhân mọi lúc tại mục <a href="{{ route('profile') }}" class="text-green-700 font-bold hover:underline">Hồ sơ người dùng</a>.</li>
                        <li>Yêu cầu ngừng tiếp nhận các bản tin khuyến mãi hoặc thông báo quảng cáo qua email/SMS.</li>
                        <li>Yêu cầu xóa toàn bộ dữ liệu tài khoản khi không còn nhu cầu sử dụng dịch vụ bằng cách liên hệ tổng đài <strong>1900 1234</strong>.</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
