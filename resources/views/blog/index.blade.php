<x-layouts.app title="Blog & Tin tức - MiniMart">
    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="pt-8 pb-4 w-full flex flex-col items-center justify-center text-center">
            <div class="w-max mx-auto bg-white/20 backdrop-blur-md border border-white/40 shadow-sm rounded-full px-10 py-3 mb-6">
                <h1 class="text-3xl font-extrabold text-green-900">Blog & Tin tức</h1>
            </div>
            <p class="text-gray-600 text-base mb-4">Cập nhật tin tức mới nhất, mẹo vặt dinh dưỡng và kiến thức hữu ích từ MiniMart.</p>
        </div>

        <div class="bg-white/20 backdrop-blur-md border border-white/40 shadow-sm rounded-[2.5rem] p-8 md:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main List (col-span-2) -->
            <div class="lg:col-span-2 space-y-8">
                @forelse($posts as $post)
                    <article class="bg-white/80 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row group hover:shadow-md transition-all duration-300 fade-item">
                        <a href="{{ route('posts.show', $post->slug) }}" class="md:w-64 lg:w-72 h-52 md:h-auto shrink-0 relative overflow-hidden bg-gray-100 block">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @if($post->category)
                                <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                                    {{ $post->category }}
                                </span>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col justify-between flex-grow">
                            <div>
                                <div class="flex items-center gap-3 text-xs text-gray-500 font-medium mb-2">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                        {{ $post->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">person</span>
                                        MiniMart Team
                                    </span>
                                </div>
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <h2 class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-green-700 transition-colors line-clamp-2 mb-2">
                                        {{ $post->title }}
                                    </h2>
                                </a>
                                <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed mb-4">
                                    {{ strip_tags($post->content) }}
                                </p>
                            </div>
                            <div class="pt-2 border-t border-gray-100/80">
                                <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-700 hover:text-green-800 transition-colors">
                                    Đọc tiếp <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-12 text-center border border-gray-100 shadow-sm fade-item">
                        <span class="material-symbols-outlined text-5xl text-gray-300 mb-3 block">article</span>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Chưa có bài viết nào</h3>
                        <p class="text-gray-500 text-sm">Vui lòng quay lại sau để đón đọc các bài viết mới nhất.</p>
                    </div>
                @endforelse

                @if($posts->hasPages())
                    <div class="pt-4 fade-item">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar (col-span-1) -->
            <div class="lg:col-span-1">
                <div class="bg-white/30 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm fade-item sticky top-28">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">trending_up</span>
                        Bài viết nổi bật
                    </h3>
                    <div class="space-y-4 divide-y divide-gray-100">
                        @forelse($posts->take(5) as $featuredPost)
                            <a href="{{ route('posts.show', $featuredPost->slug) }}" class="flex items-center gap-4 group pt-4 first:pt-0 hover:opacity-90 transition-opacity">
                                <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-gray-100 border border-gray-100">
                                    <img src="{{ $featuredPost->image_url }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 group-hover:text-green-700 transition-colors line-clamp-2 leading-snug">
                                        {{ $featuredPost->title }}
                                    </h4>
                                    <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                        {{ $featuredPost->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Chưa có bài viết nổi bật.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</x-layouts.app>
