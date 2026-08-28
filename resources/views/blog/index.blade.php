<x-layouts.app title="Blog & Tin tức - MiniMart">
    <!-- Header -->
    <header class="mb-12 mt-6 text-center">
        <h1 class="font-headline-lg text-headline-lg md:font-display-lg md:text-display-lg text-primary mb-4">
            Blog & Tin Tức
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
            Cập nhật những thông tin mới nhất về nông sản sạch, mẹo vặt bảo quản và sức khỏe từ MiniMart.
        </p>
    </header>

    <!-- Blog Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <article class="glass-tier-2 rounded-[24px] flex flex-col overflow-hidden group">
                <a href="{{ route('posts.show', $post->slug) }}" class="block w-full h-56 relative overflow-hidden">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-tertiary text-on-tertiary font-label-md text-xs px-3 py-1 rounded-full z-10 shadow-sm">
                        {{ $post->category }}
                    </div>
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <p class="font-label-md text-xs text-on-surface-variant mb-2">
                        {{ $post->created_at->format('d/m/Y') }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <h2 class="font-headline-lg text-lg text-primary hover:text-secondary transition-colors mb-3 line-clamp-2">
                            {{ $post->title }}
                        </h2>
                    </a>
                    <p class="font-body-lg text-sm text-on-surface-variant line-clamp-3 mb-4 flex-grow">
                        {{ strip_tags($post->content) }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1 font-label-md text-sm text-primary hover:text-secondary transition-colors">
                        Đọc tiếp <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full glass-tier-2 rounded-[24px] p-12 text-center">
                <h3 class="text-2xl font-bold text-primary mb-2">Chưa có bài viết nào</h3>
                <p class="text-on-surface-variant">Vui lòng quay lại sau.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>
</x-layouts.app>
