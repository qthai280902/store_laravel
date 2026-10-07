<x-layouts.app title="Câu hỏi thường gặp (FAQ) - MiniMart">
    <div class="max-w-5xl mx-auto px-4 py-8" 
         x-data="{ 
            active: 1, 
            currentCategory: 'all',
            searchQuery: '',
            matches(cat, text) {
                const matchCat = (this.currentCategory === 'all' || this.currentCategory === cat);
                const matchSearch = (!this.searchQuery || text.toLowerCase().includes(this.searchQuery.toLowerCase()));
                return matchCat && matchSearch;
            }
         }">
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                Câu hỏi thường gặp
            </span>
        </nav>

        <!-- Pill Header -->
        <div class="pt-2 pb-8 w-full flex justify-center">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-white/50 rounded-full px-8 md:px-12 py-3.5 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-2xl md:text-3xl">help</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-green-900">Câu Hỏi Thường Gặp (FAQ)</h1>
            </div>
        </div>

        <!-- Central Liquid Glass Pane -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-12 space-y-8 relative overflow-hidden">
            <!-- Search Bar FAQ -->
            <div class="relative max-w-xl mx-auto">
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Tìm kiếm câu hỏi (đổi trả, phí ship, thanh toán, tài khoản...)" 
                       class="w-full bg-white/60 backdrop-blur-xl border border-white/80 rounded-full px-6 py-4 pl-14 text-sm text-gray-800 shadow-[0_8px_30px_rgb(0,0,0,0.04)] focus:outline-none focus:ring-2 focus:ring-green-600 transition-all placeholder:text-gray-400">
                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-2xl">search</span>
                <button x-show="searchQuery" 
                        @click="searchQuery = ''" 
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
                <button @click="currentCategory = 'all'" 
                        :class="currentCategory === 'all' ? 'bg-green-700 text-white shadow-md' : 'bg-white/50 text-gray-700 hover:bg-white/80'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all border border-white/60">
                    Tất cả
                </button>
                <button @click="currentCategory = 'orders'" 
                        :class="currentCategory === 'orders' ? 'bg-green-700 text-white shadow-md' : 'bg-white/50 text-gray-700 hover:bg-white/80'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all border border-white/60">
                    📦 Đơn hàng
                </button>
                <button @click="currentCategory = 'payments'" 
                        :class="currentCategory === 'payments' ? 'bg-green-700 text-white shadow-md' : 'bg-white/50 text-gray-700 hover:bg-white/80'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all border border-white/60">
                    💳 Thanh toán
                </button>
                <button @click="currentCategory = 'shipping'" 
                        :class="currentCategory === 'shipping' ? 'bg-green-700 text-white shadow-md' : 'bg-white/50 text-gray-700 hover:bg-white/80'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all border border-white/60">
                    🚚 Vận chuyển
                </button>
                <button @click="currentCategory = 'account'" 
                        :class="currentCategory === 'account' ? 'bg-green-700 text-white shadow-md' : 'bg-white/50 text-gray-700 hover:bg-white/80'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all border border-white/60">
                    👤 Tài khoản
                </button>
            </div>

            <!-- Accordion List -->
            <div class="space-y-4 pt-4">
                <!-- Question 1: Đơn hàng -->
                <div x-show="matches('orders', 'Làm thế nào để đặt hàng tại MiniMart?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 1 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 1 ? null : 1)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">1</span>
                            Làm thế nào để đặt mua thực phẩm tại MiniMart?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 1 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Quý khách chỉ cần chọn món hàng mong muốn trên website, nhấp nút "Thêm vào giỏ" (+), mở giỏ hàng và chọn "Thanh toán". Điền địa chỉ nhận hàng, số điện thoại và chọn phương thức thanh toán phù hợp. Hệ thống sẽ gửi thông báo và điều phối giao hàng ngay lập tức.
                    </div>
                </div>

                <!-- Question 2: Đơn hàng -->
                <div x-show="matches('orders', 'Tôi có thể chỉnh sửa hoặc hủy đơn hàng đã đặt không?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 2 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 2 ? null : 2)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">2</span>
                            Tôi có thể chỉnh sửa hoặc hủy đơn hàng sau khi đặt không?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 2 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Quý khách hoàn toàn có thể hủy hoặc sửa đơn hàng nếu đơn hàng đang ở trạng thái "Chờ xử lý" bằng cách gọi ngay đến tổng đài <strong>1900 1234</strong>. Nếu đơn hàng đã bàn giao cho nhân viên giao hàng, quý khách có thể thực hiện kiểm tra và từ chối nhận món khi shipper giao đến.
                    </div>
                </div>

                <!-- Question 3: Thanh toán -->
                <div x-show="matches('payments', 'MiniMart hỗ trợ các phương thức thanh toán nào?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 3 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 3 ? null : 3)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">3</span>
                            MiniMart hỗ trợ các phương thức thanh toán nào?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 3 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Chúng tôi hỗ trợ 3 hình thức thanh toán an toàn, thuận tiện:
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li><strong>Thanh toán khi nhận hàng (COD):</strong> Trả tiền mặt trực tiếp cho nhân viên giao hàng sau khi đã đồng kiểm tra thực phẩm.</li>
                            <li><strong>Ví điện tử MoMo:</strong> Quét mã QR thanh toán tức thời, không lo tiền lẻ.</li>
                            <li><strong>Chuyển khoản ngân hàng:</strong> Chuyển tiền trực tiếp đến tài khoản công ty với mã nội dung là Mã đơn hàng.</li>
                        </ul>
                    </div>
                </div>

                <!-- Question 4: Thanh toán -->
                <div x-show="matches('payments', 'Nếu thanh toán MoMo bị trừ tiền nhưng đơn hàng chưa cập nhật thì xử lý ra sao?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 4 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 4 ? null : 4)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">4</span>
                            Thanh toán ví điện tử bị trừ tiền nhưng đơn chưa ghi nhận thì làm sao?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 4 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Hệ thống đối soát tự động của MiniMart xử lý phản hồi trong vòng 1-2 phút. Trong trường hợp nghẽn mạng phía cổng ngân hàng, quý khách vui lòng chụp lại biên lai trừ tiền có chứa "Mã giao dịch MoMo" và gửi qua Zalo CSKH hoặc hotline <strong>1900 1234</strong> để kỹ thuật viên kích hoạt đơn ngay lập tức.
                    </div>
                </div>

                <!-- Question 5: Vận chuyển -->
                <div x-show="matches('shipping', 'Thời gian giao hàng mất bao lâu và có giao hẹn giờ không?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 5 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 5 ? null : 5)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">5</span>
                            Thời gian giao hàng bao lâu và tôi có thể hẹn giờ nhận không?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 5 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 5" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        MiniMart cung cấp 2 phương thức: Giao hỏa tốc trong vòng <strong>2 giờ</strong> hoặc giao hẹn giờ theo 3 khung thời gian trong ngày (Sáng 8h-11h, Chiều 14h-17h, Tối 18h-21h). Quý khách hoàn toàn chủ động lựa chọn khung giờ phù hợp với lịch sinh hoạt của gia đình.
                    </div>
                </div>

                <!-- Question 6: Vận chuyển -->
                <div x-show="matches('shipping', 'Thực phẩm đông lạnh và tươi sống được bảo quản thế nào khi đi đường?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 6 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 6 ? null : 6)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">6</span>
                            Thịt cá và thực phẩm tươi sống bảo quản thế nào khi shipper đi đường?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 6 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 6" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Mỗi kiện hàng thịt cá, hải sản và đồ lạnh đều được đặt trong túi/thùng cách nhiệt chuyên dụng kèm đá gel giữ lạnh tiêu chuẩn thực phẩm, duy trì nhiệt độ bảo quản lý tưởng từ 0°C đến 4°C trong suốt thời gian di chuyển ngoài trời.
                    </div>
                </div>

                <!-- Question 7: Tài khoản -->
                <div x-show="matches('account', 'Làm sao để đổi mật khẩu hoặc cập nhật địa chỉ giao hàng?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 7 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 7 ? null : 7)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">7</span>
                            Làm sao để đổi mật khẩu hoặc cập nhật lại địa chỉ nhận hàng?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 7 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 7" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Quý khách đăng nhập và truy cập trang <a href="{{ route('profile') }}" class="text-green-700 font-bold hover:underline">Hồ sơ người dùng</a>. Tại đây, quý khách có thể cập nhật họ tên, số điện thoại, địa chỉ mặc định, thay đổi ảnh đại diện và đổi mật khẩu mới trong tích tắc.
                    </div>
                </div>

                <!-- Question 8: Tài khoản -->
                <div x-show="matches('account', 'Chương trình tích điểm và ưu đãi thành viên hoạt động thế nào?')"
                     class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden transition-all shadow-sm"
                     :class="active === 8 ? 'ring-2 ring-green-600/60 bg-white/70 shadow-md' : 'hover:bg-white/65'">
                    <button @click="active = (active === 8 ? null : 8)" 
                            class="w-full p-5 text-left font-bold text-gray-900 flex justify-between items-center gap-4">
                        <span class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold">8</span>
                            Chương trình tích điểm thành viên và voucher ưu đãi hoạt động ra sao?
                        </span>
                        <span class="material-symbols-outlined transition-transform duration-300 text-green-700" 
                              :class="active === 8 ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === 8" x-collapse class="px-5 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100/60 pt-4">
                        Mỗi đơn hàng giao dịch thành công đều được tích lũy điểm thưởng theo tỉ lệ: 10.000đ = 1 điểm. Điểm tích lũy có thể quy đổi thành voucher giảm giá trực tiếp từ 20.000đ đến 200.000đ khi thanh toán đơn hàng tiếp theo.
                    </div>
                </div>
            </div>

            <!-- Khối Chưa tìm thấy câu trả lời -->
            <div class="mt-8 p-6 rounded-2xl bg-white/70 backdrop-blur-md border border-white/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <div>
                    <h4 class="font-bold text-green-900 text-base">Bạn vẫn còn câu hỏi chưa được giải đáp?</h4>
                    <p class="text-sm text-gray-600 mt-0.5">Đội ngũ hỗ trợ MiniMart luôn túc trực để giải đáp mọi thắc mắc của bạn.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="tel:19001234" class="px-5 py-2.5 rounded-full bg-green-700 text-white font-bold text-xs shadow-md hover:bg-green-800 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">call</span>
                        1900 1234
                    </a>
                    <a href="mailto:support@minimart.vn" class="px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-700 font-bold text-xs shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        support@minimart.vn
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
