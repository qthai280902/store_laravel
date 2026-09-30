@props(['product'])

@php
    $reviews = $product->reviews()->with('user')->latest()->get();
    $totalReviews = $reviews->count();
    $avgRating = $totalReviews > 0 ? round($reviews->avg('rating'), 1) : 5.0;

    $ratingCounts = [
        5 => $reviews->where('rating', 5)->count(),
        4 => $reviews->where('rating', 4)->count(),
        3 => $reviews->where('rating', 3)->count(),
        2 => $reviews->where('rating', 2)->count(),
        1 => $reviews->where('rating', 1)->count(),
    ];
@endphp

<div id="reviews-section" class="bg-white/50 backdrop-blur-2xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2rem] p-6 md:p-8 relative overflow-hidden"
     x-data="{ showReviewForm: false, userRating: 5, userHoverRating: 0 }">
    
    <!-- Vệt sáng phản quang Liquid Glass mép trên -->
    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-white/80 to-transparent pointer-events-none"></div>

    <!-- Header & Thống Kê Điểm -->
    <div class="flex flex-col lg:flex-row gap-8 items-start lg:items-center justify-between pb-8 mb-8 border-b border-gray-200/60">
        <!-- Điểm Trung Bình -->
        <div class="flex items-center gap-6">
            <div class="flex flex-col items-center justify-center w-28 h-28 rounded-3xl bg-white/70 backdrop-blur-md border border-white/90 shadow-inner">
                <span class="text-4xl font-extrabold text-green-950 tracking-tight">{{ $avgRating }}</span>
                <div class="flex text-amber-400 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined text-[16px]" style="{{ $i <= round($avgRating) ? 'font-variation-settings: \'FILL\' 1;' : '' }}">star</span>
                    @endfor
                </div>
                <span class="text-[11px] text-gray-500 font-semibold mt-0.5">{{ $totalReviews }} nhận xét</span>
            </div>

            <!-- Thanh Tỉ Lệ Sao -->
            <div class="flex flex-col gap-1.5 w-48 sm:w-64">
                @foreach([5, 4, 3, 2, 1] as $star)
                    @php
                        $count = $ratingCounts[$star] ?? 0;
                        $pct = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0;
                    @endphp
                    <div class="flex items-center gap-2 text-xs">
                        <span class="w-3 text-right font-bold text-gray-700">{{ $star }}</span>
                        <span class="material-symbols-outlined text-[14px] text-amber-400" style="font-variation-settings: 'FILL' 1;">star</span>
                        <div class="flex-1 h-2 bg-gray-200/70 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-400 rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                        </div>
                        <span class="w-6 text-right text-[11px] text-gray-500">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Nút Gửi Đánh Giá Nhanh -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            @auth
                <button type="button" 
                        @click="showReviewForm = !showReviewForm" 
                        class="px-6 py-3 rounded-full bg-green-900 text-white font-bold text-sm shadow-md hover:bg-green-800 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98">
                    <span class="material-symbols-outlined text-[18px]">rate_review</span>
                    <span x-text="showReviewForm ? 'Đóng biểu mẫu' : 'Viết đánh giá sản phẩm'">Viết đánh giá sản phẩm</span>
                </button>
            @else
                <a href="{{ route('login') }}" 
                   class="px-6 py-3 rounded-full bg-white/70 hover:bg-white text-green-900 border border-white/80 font-bold text-sm shadow-sm transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">login</span>
                    Đăng nhập để đánh giá
                </a>
            @endauth
        </div>
    </div>

    <!-- Form Gửi Đánh Giá Mới (Liquid Glass Accordion/Modal) -->
    @auth
        <div x-show="showReviewForm" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="mb-8 p-6 rounded-3xl bg-white/70 backdrop-blur-xl border border-white/90 shadow-[inset_0_2px_6px_rgba(0,0,0,0.03)]" 
             style="display: none;">
            
            <h4 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-700">edit_note</span>
                Chia sẻ trải nghiệm của bạn về {{ $product->name }}
            </h4>

            <form action="{{ route('products.reviews.store', $product->id) }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="rating" :value="userRating">

                <!-- Chọn số sao tương tác -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Đánh giá chung:</label>
                    <div class="flex items-center gap-1.5 cursor-pointer">
                        <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                            <button type="button" 
                                    @click="userRating = star"
                                    @mouseenter="userHoverRating = star"
                                    @mouseleave="userHoverRating = 0"
                                    class="p-1 focus:outline-none transition-transform hover:scale-120">
                                <span class="material-symbols-outlined text-[28px]" 
                                      :class="(userHoverRating ? star <= userHoverRating : star <= userRating) ? 'text-amber-400' : 'text-gray-300'"
                                      style="font-variation-settings: 'FILL' 1;">star</span>
                            </button>
                        </template>
                        <span class="ml-3 text-sm font-semibold text-gray-700" 
                              x-text="['Rất tệ', 'Tệ', 'Bình thường', 'Hài lòng', 'Rất hài lòng'][userRating - 1]"></span>
                    </div>
                </div>

                <!-- Ô nhận xét -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nhận xét chi tiết:</label>
                    <textarea name="comment" rows="3" required minlength="5" placeholder="Chia sẻ cảm nhận về độ tươi, chất lượng bao bì, hương vị..."
                              class="w-full bg-white/80 backdrop-blur-md border border-white/80 rounded-2xl p-4 text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:ring-2 focus:ring-green-500/50 outline-none transition-all shadow-inner"></textarea>
                    @error('comment')
                        <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="showReviewForm = false" class="px-5 py-2.5 rounded-full text-xs font-bold text-gray-600 hover:bg-white/60 transition-colors">
                        Hủy
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-green-900 text-white text-xs font-bold shadow-md hover:bg-green-800 transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">send</span> Gửi đánh giá
                    </button>
                </div>
            </form>
        </div>
    @endauth

    <!-- Danh Sách Đánh Giá Thực Tế Từ Database -->
    <div class="space-y-4">
        @forelse($reviews as $review)
            <div class="p-5 rounded-2xl bg-white/40 hover:bg-white/60 backdrop-blur-md border border-white/70 shadow-sm transition-all flex flex-col gap-3 group">
                <div class="flex items-start justify-between gap-4">
                    <!-- User Avatar & Info -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-green-100 border border-white shadow-sm shrink-0">
                            @if($review->user->avatar)
                                <img src="{{ $review->user->avatar }}" alt="{{ $review->user->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=00490e&color=fff&size=100" alt="{{ $review->user->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h5 class="text-sm font-bold text-gray-900">{{ $review->user->name }}</h5>
                                <span class="inline-flex items-center gap-0.5 text-[10px] font-semibold text-emerald-700 bg-emerald-100/70 border border-emerald-200 px-2 py-0.5 rounded-full">
                                    <span class="material-symbols-outlined text-[12px]">verified</span> Đã mua hàng
                                </span>
                            </div>
                            <span class="text-[11px] text-gray-400 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Stars -->
                    <div class="flex text-amber-400">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-[16px]" style="{{ $i <= $review->rating ? 'font-variation-settings: \'FILL\' 1;' : '' }}">star</span>
                        @endfor
                    </div>
                </div>

                <!-- Review Content -->
                <p class="text-sm text-gray-700 leading-relaxed pl-13">
                    {{ $review->comment }}
                </p>
            </div>
        @empty
            <div class="py-12 text-center bg-white/20 rounded-2xl border border-white/60">
                <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">rate_review</span>
                <p class="text-sm text-gray-600 font-medium">Chưa có đánh giá nào cho sản phẩm này.</p>
                <p class="text-xs text-gray-400 mt-1">Hãy là khách hàng đầu tiên chia sẻ cảm nhận thực tế!</p>
            </div>
        @endforelse
    </div>
</div>
