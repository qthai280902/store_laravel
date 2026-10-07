<x-layouts.app title="Chính sách giao hàng - MiniMart">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Breadcrumb Trail (Liquid Glass Multi-Pills) -->
        <nav class="flex items-center gap-2 mb-6 text-gray-500 text-sm overflow-x-auto whitespace-nowrap py-1 no-scrollbar">
            <a class="px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Trang chủ
            </a>
            <span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs">
                Chính sách giao hàng
            </span>
        </nav>

        <!-- Pill Header -->
        <div class="pt-2 pb-8 w-full flex justify-center">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-white/50 rounded-full px-8 md:px-12 py-3.5 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-2xl md:text-3xl">local_shipping</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-green-900">Chính Sách Vận Chuyển & Giao Hàng</h1>
            </div>
        </div>

        <!-- Central Liquid Glass Pane -->
        <div class="liquid-glass-pane bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem] p-6 md:p-12 space-y-10 relative overflow-hidden">
            <!-- Banner Khuyến Mãi Giao Hàng -->
            <div class="bg-gradient-to-r from-emerald-500/15 via-green-500/10 to-teal-500/10 p-6 rounded-2xl border border-green-600/20 flex flex-col sm:flex-row items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-green-600/30">
                    <span class="material-symbols-outlined text-3xl">electric_moped</span>
                </div>
                <div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-600 text-white mb-2">ƯU ĐÃI ĐẶC QUYỀN</span>
                    <h3 class="text-lg font-bold text-green-900 mb-1">Miễn Phí Giao Hàng Cho Đơn Từ 300.000đ</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        MiniMart giao nhanh hỏa tốc trong 2 giờ tại tất cả các quận nội thành, đảm bảo thực phẩm giữ trọn vẹn độ tươi ngon và hương vị tự nhiên từ nông trại đến bàn ăn.
                    </p>
                </div>
            </div>

            <!-- Mục 1: Các gói giao hàng -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">1</div>
                    <h2 class="text-xl font-bold text-gray-900">Các Gói Dịch Vụ Vận Chuyển</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-all">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-2xl">bolt</span>
                            </div>
                            <h3 class="font-bold text-green-900 text-base mb-1">Giao Hỏa Tốc (2 Giờ)</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Áp dụng trong phạm vi bán kính dưới 10km tính từ cửa hàng MiniMart gần nhất. Đặt hàng và nhận ngay trong 120 phút.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2.5 py-1 rounded-full">Phù hợp ăn liền, tiệc gấp</span>
                        </div>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-all">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-2xl">schedule</span>
                            </div>
                            <h3 class="font-bold text-green-900 text-base mb-1">Giao Tiêu Chuẩn Trong Ngày</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Đơn hàng đặt trước 16:00 mỗi ngày sẽ được điều phối giao tận nhà trước 20:00 cùng ngày theo lộ trình tối ưu.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full">Tiết kiệm & Phổ biến</span>
                        </div>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-all">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-2xl">calendar_clock</span>
                            </div>
                            <h3 class="font-bold text-green-900 text-base mb-1">Giao Hẹn Giờ Linh Hoạt</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Quý khách chủ động chọn khung giờ thuận tiện khi nhận hàng: Sáng (8h-11h), Chiều (14h-17h) hoặc Tối (18h-21h).
                            </p>
                        </div>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full">Chủ động thời gian cá nhân</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mục 2: Bảng cước phí giao hàng -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">2</div>
                    <h2 class="text-xl font-bold text-gray-900">Bảng Cước Phí Vận Chuyển Minh Bạch</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-green-800/5 text-green-900 font-bold border-b border-gray-100">
                                <tr>
                                    <th class="p-4">Giá trị đơn hàng</th>
                                    <th class="p-4">Khoảng cách giao</th>
                                    <th class="p-4">Thời gian nhận dự kiến</th>
                                    <th class="p-4 text-right">Mức phí áp dụng</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="p-4 font-bold text-green-700">Từ 300.000đ trở lên</td>
                                    <td class="p-4">Tất cả cự ly (&lt; 15km)</td>
                                    <td class="p-4">2 giờ hoặc theo hẹn</td>
                                    <td class="p-4 text-right font-bold text-green-600">MIỄN PHÍ (0đ)</td>
                                </tr>
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="p-4">Dưới 300.000đ</td>
                                    <td class="p-4">Dưới 5 km</td>
                                    <td class="p-4">60 - 90 phút</td>
                                    <td class="p-4 text-right font-semibold">15.000đ</td>
                                </tr>
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="p-4">Dưới 300.000đ</td>
                                    <td class="p-4">Từ 5 km - 10 km</td>
                                    <td class="p-4">90 - 120 phút</td>
                                    <td class="p-4 text-right font-semibold">25.000đ</td>
                                </tr>
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="p-4">Dưới 300.000đ</td>
                                    <td class="p-4">Từ 10 km - 15 km</td>
                                    <td class="p-4">Trong ngày</td>
                                    <td class="p-4 text-right font-semibold">35.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Mục 3: Tiêu chuẩn đóng gói lạnh (Cold Chain) -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">3</div>
                    <h2 class="text-xl font-bold text-gray-900">Quy Chuẩn Đóng Gói Bảo Quản Thực Phẩm</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600 text-[20px]">ac_unit</span>
                            Túi Đá Gel Giữ Lạnh Chuyên Dụng
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Mỗi kiện hàng thịt, cá, hải sản tươi sống và sữa chua, phô mai đều được đóng trong thùng cách nhiệt giữ mức nhiệt ổn định từ 0°C đến 4°C suốt lộ trình di chuyển.
                        </p>
                    </div>

                    <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-5 shadow-sm space-y-2">
                        <div class="font-bold text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[20px]">eco</span>
                            Bao Bì Thân Thiện & Chống Dập Nát
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Rau xanh, trái cây mềm được bọc túi thoáng khí phân hủy sinh học, đặt vào khay cứng chuyên dụng ngăn ngừa hiện tượng cọ xát hoặc đè bẹp khi xe di chuyển.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Mục 4: Quyền đồng kiểm -->
            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">4</div>
                    <h2 class="text-xl font-bold text-gray-900">Quyền Kiểm Hàng Trước Khi Nhận (Đồng Kiểm)</h2>
                </div>
                <div class="bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl p-6 shadow-sm text-sm text-gray-700 space-y-3">
                    <p class="leading-relaxed">
                        Nhằm đảm bảo quyền lợi tối đa, MiniMart khuyến khích quý khách hàng <strong>đồng kiểm tra đơn hàng cùng nhân viên giao hàng</strong> ngay khi nhận:
                    </p>
                    <ul class="list-disc pl-5 space-y-1.5 text-gray-600">
                        <li>Kiểm tra số lượng món hàng so với danh sách in trên hóa đơn đính kèm.</li>
                        <li>Kiểm tra bao bì, nhãn mác, tem niêm phong và hạn sử dụng sản phẩm.</li>
                        <li>Kiểm tra độ tươi ngon của nông sản và thực phẩm lạnh.</li>
                        <li>Nếu phát hiện bất kỳ sai sót nào, quý khách có quyền từ chối nhận món hàng đó và shipper sẽ điều chỉnh lại hóa đơn ngay lập tức.</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
