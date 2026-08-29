<x-layouts.app title="{{ $post->title }} - MiniMart">
    <article class="max-w-4xl mx-auto mt-8">
        <!-- Header -->
        <header class="mb-8 text-center">
            <div class="inline-block bg-tertiary text-on-tertiary font-label-md text-xs px-3 py-1 rounded-full shadow-sm mb-4">
                {{ $post->category }}
            </div>
            <h1 class="font-headline-lg text-headline-lg md:font-display-lg md:text-display-lg text-primary mb-4">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-on-surface-variant font-label-md text-sm">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    {{ $post->created_at->format('d/m/Y') }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    MiniMart Team
                </span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->image_url)
        <div class="w-full h-80 md:h-[480px] rounded-3xl overflow-hidden mb-12 shadow-lg">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Content -->
        <div class="glass-tier-1 rounded-[24px] p-8 md:p-12">
            <article class="prose prose-lg prose-green max-w-none">{!! $post->content !!}</article>
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary rounded-full transition-colors font-label-md">
                <span class="material-symbols-outlined">arrow_back</span>
                Quay lại Blog
            </a>
        </div>
    </article>
</x-layouts.app>
