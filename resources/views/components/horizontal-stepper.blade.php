@props(['current' => 1])
<div class="flex items-center justify-between w-full max-w-2xl mx-auto mb-12">
    <!-- Step 1: Cart -->
    <div class="flex flex-col items-center">
        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $current >= 1 ? ($current > 1 ? 'bg-[var(--color-primary)] text-white' : 'border-2 border-[var(--color-primary)] text-[var(--color-primary)]') : 'bg-gray-200 text-gray-500' }}">1</div>
        <span class="text-xs font-bold mt-2 {{ $current >= 1 ? 'text-[var(--color-primary)]' : 'text-gray-500' }}">Cart</span>
    </div>
    
    <div class="flex-grow h-[2px] mx-2 {{ $current >= 2 ? 'bg-[var(--color-primary)]' : 'bg-gray-200' }}"></div>
    
    <!-- Step 2: Checkout -->
    <div class="flex flex-col items-center">
        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $current >= 2 ? ($current > 2 ? 'bg-[var(--color-primary)] text-white' : 'border-2 border-[var(--color-primary)] text-[var(--color-primary)]') : 'bg-gray-200 text-gray-500' }}">2</div>
        <span class="text-xs font-bold mt-2 {{ $current >= 2 ? 'text-[var(--color-primary)]' : 'text-gray-500' }}">Checkout</span>
    </div>
    
    <div class="flex-grow h-[2px] mx-2 {{ $current >= 3 ? 'bg-[var(--color-primary)]' : 'bg-gray-200' }}"></div>
    
    <!-- Step 3: Done -->
    <div class="flex flex-col items-center">
        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $current >= 3 ? 'bg-[var(--color-primary)] text-white' : 'bg-gray-200 text-gray-500' }}">3</div>
        <span class="text-xs font-bold mt-2 {{ $current >= 3 ? 'text-[var(--color-primary)]' : 'text-gray-500' }}">Done</span>
    </div>
</div>
