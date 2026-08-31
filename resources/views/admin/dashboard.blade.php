<x-layouts.admin title="Tổng quan Admin">
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-extrabold text-green-900 tracking-tight">Tổng quan</h2>
            <p class="text-gray-600 mt-2 font-medium">Báo cáo hoạt động kinh doanh hôm nay</p>
        </div>
        <div class="flex gap-3">
            <button class="glass-card px-4 py-2 rounded-xl text-green-800 font-bold hover:bg-white/80 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                Hôm nay
                <span class="material-symbols-outlined text-[20px]">expand_more</span>
            </button>
            <button class="bg-green-800 text-white px-4 py-2 rounded-xl font-bold hover:bg-green-900 transition-colors shadow-lg shadow-green-900/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Xuất Báo Cáo
            </button>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue -->
        <div class="glass-panel p-6 rounded-[24px]" data-aos="fade-up" data-aos-delay="50">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-white/60 rounded-2xl text-green-700 shadow-sm border border-white">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span class="flex items-center text-sm font-bold text-green-600 bg-green-100/50 px-2 py-1 rounded-lg">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span> +12.5%
                </span>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-1">Doanh thu (Hôm nay)</h3>
            <p class="text-3xl font-extrabold text-gray-900">24.500.000₫</p>
        </div>

        <!-- Orders -->
        <div class="glass-panel p-6 rounded-[24px]" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-white/60 rounded-2xl text-orange-600 shadow-sm border border-white">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
                <span class="flex items-center text-sm font-bold text-green-600 bg-green-100/50 px-2 py-1 rounded-lg">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span> +5.2%
                </span>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-1">Đơn hàng mới</h3>
            <p class="text-3xl font-extrabold text-gray-900">156</p>
        </div>

        <!-- Customers -->
        <div class="glass-panel p-6 rounded-[24px]" data-aos="fade-up" data-aos-delay="150">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-white/60 rounded-2xl text-blue-600 shadow-sm border border-white">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <span class="flex items-center text-sm font-bold text-red-600 bg-red-100/50 px-2 py-1 rounded-lg">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_down</span> -2.1%
                </span>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-1">Khách hàng mới</h3>
            <p class="text-3xl font-extrabold text-gray-900">42</p>
        </div>

        <!-- Conversion -->
        <div class="glass-panel p-6 rounded-[24px]" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-white/60 rounded-2xl text-purple-600 shadow-sm border border-white">
                    <span class="material-symbols-outlined">insights</span>
                </div>
                <span class="flex items-center text-sm font-bold text-green-600 bg-green-100/50 px-2 py-1 rounded-lg">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span> +1.8%
                </span>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-1">Tỷ lệ chuyển đổi</h3>
            <p class="text-3xl font-extrabold text-gray-900">4.8%</p>
        </div>
    </div>

    <!-- Charts & Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 glass-panel p-6 rounded-[32px] flex flex-col" data-aos="fade-up" data-aos-delay="250">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-gray-900">Biểu đồ doanh thu</h3>
                <button class="p-2 hover:bg-white/50 rounded-full text-gray-500 transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            <div class="flex-1 w-full relative min-h-[300px]">
                <!-- Placeholder for chart -->
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="glass-panel p-6 rounded-[32px] flex flex-col" data-aos="fade-up" data-aos-delay="300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-gray-900">Đơn hàng gần đây</h3>
                <a href="#" class="text-sm font-bold text-green-700 hover:text-green-900 transition-colors">Xem tất cả</a>
            </div>
            <div class="flex flex-col gap-4">
                <!-- Order Item -->
                <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/40 transition-colors cursor-pointer border border-transparent hover:border-white/60">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold border border-white">
                            DH
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">#ORD-0921</p>
                            <p class="text-xs text-gray-500">2 phút trước</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-sm">450.000₫</p>
                        <span class="inline-block px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-[10px] font-bold mt-1">Chờ xử lý</span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/40 transition-colors cursor-pointer border border-transparent hover:border-white/60">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-white">
                            TK
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">#ORD-0920</p>
                            <p class="text-xs text-gray-500">15 phút trước</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-sm">1.250.000₫</p>
                        <span class="inline-block px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold mt-1">Đang giao</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-white/40 transition-colors cursor-pointer border border-transparent hover:border-white/60">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold border border-white">
                            NA
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">#ORD-0919</p>
                            <p class="text-xs text-gray-500">1 giờ trước</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-sm">320.000₫</p>
                        <span class="inline-block px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-[10px] font-bold mt-1">Hoàn thành</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            // Gradient for chart area
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(22, 101, 52, 0.5)'); // green-800 with opacity
            gradient.addColorStop(1, 'rgba(22, 101, 52, 0)');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                    datasets: [{
                        label: 'Doanh thu (Triệu VNĐ)',
                        data: [12, 19, 15, 25, 22, 30, 28],
                        borderColor: '#166534', // green-800
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#166534',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // curvy lines
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#000',
                            bodyColor: '#000',
                            borderColor: 'rgba(0,0,0,0.1)',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Triệu VNĐ';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false },
                            ticks: { font: { family: 'Plus Jakarta Sans' } }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: 'Plus Jakarta Sans' } }
                        }
                    }
                }
            });
        });
    </script>
</x-layouts.admin>
