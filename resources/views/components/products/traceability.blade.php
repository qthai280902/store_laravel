@props(['product'])

@php
    $trace = $product->traceability_data;
@endphp

<div class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-6 md:p-8 relative overflow-hidden"
     x-data="{ qrModalOpen: false }">
    
    <!-- Vệt sáng viền kính Liquid Glass -->
    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-6 mb-6 border-b border-gray-200/60">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="material-symbols-outlined text-green-700 text-2xl">verified_user</span>
                <h3 class="text-xl font-extrabold text-green-950 tracking-tight">Minh Bạch Nguồn Gốc & Canh Tác</h3>
            </div>
            <p class="text-xs text-gray-600">Truy xuất trực tiếp chuỗi cung ứng thực phẩm sạch từ trang trại liên kết</p>
        </div>

        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100/80 border border-emerald-300 text-emerald-900 text-xs font-bold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            100% Đạt Kiểm Định ATVSTP
        </div>
    </div>

    <!-- Grid Thông Tin Nông Trại & Lô Thu Hoạch -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm flex flex-col justify-between">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Mã Lô Hàng</span>
            <span class="text-sm font-extrabold text-gray-900 mt-2 font-mono text-green-850">{{ $trace['batch_id'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm flex flex-col justify-between">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Trang Trại / Nơi Sản Xuất</span>
            <span class="text-sm font-bold text-gray-800 mt-2 line-clamp-2">{{ $trace['farm'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm flex flex-col justify-between">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Thời Điểm Thu Hoạch</span>
            <span class="text-sm font-bold text-gray-800 mt-2">{{ $trace['harvest_date'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm flex flex-col justify-between">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Chứng Nhận Áp Dụng</span>
            <span class="text-sm font-bold text-emerald-700 mt-2">{{ $trace['cert'] }}</span>
        </div>
    </div>

    <!-- Banner Quét Mã QR Truy Xuất -->
    <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-emerald-900 to-green-950 text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-lg">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-white p-1.5 shadow-md shrink-0 flex items-center justify-center cursor-pointer hover:scale-105 transition-transform"
                 @click="qrModalOpen = true">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url()->current() . '?batch=' . $trace['batch_id']) }}" 
                     alt="QR Nông sản sạch" 
                     class="w-full h-full object-contain">
            </div>
            <div>
                <h4 class="font-bold text-sm text-emerald-100 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
                    Hệ Thống Tem Truy Xuất Điện Tử MiniMart
                </h4>
                <p class="text-xs text-emerald-300 mt-0.5">Quét QR trên bao bì để kiểm tra chứng nhận kiểm dịch và nhật ký bảo quản nhiệt độ</p>
            </div>
        </div>

        <button type="button" 
                @click="qrModalOpen = true"
                class="px-5 py-2.5 rounded-full bg-emerald-500 hover:bg-emerald-400 text-green-950 font-extrabold text-xs shadow-md transition-all whitespace-nowrap cursor-pointer active:scale-95">
            Xem Chi Tiết Tem QR
        </button>
    </div>

    <!-- Modal Chi Tiết Tem QR (Liquid Glass Modal) -->
    <div x-show="qrModalOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         @keydown.escape.window="qrModalOpen = false">
        
        <div class="bg-white/90 backdrop-blur-3xl border border-white/80 shadow-2xl rounded-3xl max-w-md w-full p-6 sm:p-8 relative text-center"
             @click.away="qrModalOpen = false">
            <button @click="qrModalOpen = false" class="absolute top-4 right-4 p-2 rounded-full text-gray-500 hover:text-gray-900 hover:bg-black/5 transition-all">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>

            <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">verified</span>
            </div>

            <h3 class="text-lg font-black text-gray-900 mb-1">Mã Tem Nông Sản Sạch Chuẩn Hóa</h3>
            <p class="text-xs text-gray-500 mb-6 font-mono">ID: {{ $trace['batch_id'] }}</p>

            <div class="w-48 h-48 mx-auto bg-white p-3 rounded-2xl border border-gray-200 shadow-inner mb-6">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(url()->current() . '?batch=' . $trace['batch_id']) }}" 
                     alt="Mã QR tra cứu nguồn gốc" 
                     class="w-full h-full object-contain">
            </div>

            <div class="text-left bg-gray-50/80 rounded-2xl p-4 text-xs space-y-2 border border-gray-200/60 mb-6">
                <div class="flex justify-between">
                    <span class="text-gray-500">Sản phẩm:</span>
                    <span class="font-bold text-gray-800">{{ $product->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Trang trại:</span>
                    <span class="font-bold text-gray-800">{{ $trace['farm'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tiêu chuẩn:</span>
                    <span class="font-bold text-emerald-700">{{ $trace['cert'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Trạng thái:</span>
                    <span class="font-bold text-emerald-700">Đã kiểm nghiệm âm tính dư lượng</span>
                </div>
            </div>

            <button type="button" @click="qrModalOpen = false" class="w-full py-3 rounded-full bg-green-900 text-white font-bold text-xs shadow-md hover:bg-green-800 transition-all">
                Đóng Cửa Sổ Tra Cứu
            </button>
        </div>
    </div>
</div>
