@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Điều hướng phân trang" class="flex items-center justify-center my-8">
        <div class="inline-flex items-center gap-1.5 p-2 rounded-full bg-white/40 backdrop-blur-2xl border border-white/80 shadow-[0_8px_30px_rgba(0,0,0,0.06)] ring-1 ring-white/50">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 cursor-not-allowed select-none" aria-disabled="true" aria-label="Trang trước">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-700 bg-white/60 hover:bg-white hover:text-emerald-800 transition-all shadow-xs border border-white/80 hover:scale-105 active:scale-95 cursor-pointer" aria-label="Trang trước" title="Trang trước">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-8 h-10 flex items-center justify-center text-gray-400 text-sm font-semibold select-none">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-700 text-white font-extrabold text-sm shadow-md border border-emerald-500/40 select-none transform scale-105 ring-2 ring-emerald-500/30">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-700 font-semibold text-sm hover:bg-white/80 hover:text-emerald-900 transition-all border border-transparent hover:border-white/80 hover:shadow-xs active:scale-95 cursor-pointer">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-700 bg-white/60 hover:bg-white hover:text-emerald-800 transition-all shadow-xs border border-white/80 hover:scale-105 active:scale-95 cursor-pointer" aria-label="Trang sau" title="Trang sau">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
            @else
                <span class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 cursor-not-allowed select-none" aria-disabled="true" aria-label="Trang sau">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </span>
            @endif
        </div>
    </nav>
@endif
