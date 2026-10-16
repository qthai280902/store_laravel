@props(['product'])

@php
    $nutrition = $product->nutrition_data;
@endphp

<div class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-6 md:p-8 relative overflow-hidden">
    
    <!-- Vệt sáng phản quang Liquid Glass mép trên -->
    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-6 mb-8 border-b border-gray-200/60">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-green-700 text-2xl">vital_signs</span>
                <h3 class="text-xl font-extrabold text-green-950 tracking-tight">Giá Trị Dinh Dưỡng Ước Tính</h3>
            </div>
            <p class="text-xs text-gray-600">Thành phần dưỡng chất trung bình trên khẩu phần tiêu chuẩn (100g)</p>
        </div>

        <div class="px-4 py-2 rounded-full bg-emerald-100/80 border border-emerald-300 text-emerald-950 text-xs font-bold shadow-xs">
            Năng lượng: <span class="text-emerald-700 font-extrabold">{{ $nutrition['calories'] }}</span>
        </div>
    </div>

    <!-- 4 Chỉ Số Dinh Dưỡng Trọng Tâm -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm text-center">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Chất Đạm (Protein)</span>
            <span class="text-xl font-extrabold text-emerald-900 mt-2 block">{{ $nutrition['protein'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm text-center">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Carbohydrate</span>
            <span class="text-xl font-extrabold text-emerald-900 mt-2 block">{{ $nutrition['carbs'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm text-center">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Chất Béo (Fat)</span>
            <span class="text-xl font-extrabold text-emerald-900 mt-2 block">{{ $nutrition['fat'] }}</span>
        </div>

        <div class="p-4 rounded-2xl bg-white/70 backdrop-blur-md border border-white/90 shadow-sm text-center">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Chất Xơ (Fiber)</span>
            <span class="text-xl font-extrabold text-emerald-900 mt-2 block">{{ $nutrition['fiber'] }}</span>
        </div>
    </div>

    <!-- Lợi Ích Sức Khỏe & Cảnh Báo Dị Ứng -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 p-5 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex items-start gap-3">
            <span class="material-symbols-outlined text-green-700 text-2xl shrink-0 mt-0.5">favorite</span>
            <div>
                <h5 class="text-xs font-bold text-green-950 uppercase tracking-wider mb-1">Lợi Ích Sức Khỏe Nổi Bật</h5>
                <p class="text-xs text-gray-700 leading-relaxed">{{ $nutrition['benefits'] }}</p>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-amber-50/50 border border-amber-100 flex items-start gap-3">
            <span class="material-symbols-outlined text-amber-700 text-2xl shrink-0 mt-0.5">warning_amber</span>
            <div>
                <h5 class="text-xs font-bold text-amber-950 uppercase tracking-wider mb-1">Thông Tin Dị Ứng</h5>
                <p class="text-xs text-gray-700 leading-relaxed">{{ $nutrition['allergens'] }}</p>
            </div>
        </div>
    </div>
</div>
