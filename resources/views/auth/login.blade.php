<x-layouts.auth title="Đăng nhập - MiniMart">
    <!-- Tabs -->
    <div class="flex border-b border-outline-variant/30 mb-8">
        <a href="{{ route('login') }}" class="flex-1 pb-4 text-center font-label-md text-label-md text-primary border-b-2 border-primary transition-colors">
            Đăng nhập
        </a>
        <a href="{{ route('register') }}" class="flex-1 pb-4 text-center font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors">
            Đăng ký
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-error/10 text-error p-4 rounded-xl mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-6">
        @csrf
        
        <!-- Email Input -->
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-label-md text-on-surface" for="email">Địa chỉ Email</label>
            <input class="w-full bg-white border border-outline-variant rounded-xl px-4 py-3 font-body-lg text-body-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-shadow" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" type="email" required autofocus/>
        </div>
        
        <!-- Password Input -->
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="font-label-md text-label-md text-on-surface" for="password">Mật khẩu</label>
                <a class="font-label-md text-label-md text-primary hover:underline" href="#">Quên mật khẩu?</a>
            </div>
            <input class="w-full bg-white border border-outline-variant rounded-xl px-4 py-3 font-body-lg text-body-lg text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-shadow" id="password" name="password" placeholder="••••••••" type="password" required/>
        </div>
        
        <!-- Submit Button -->
        <button class="w-full bg-primary text-on-primary font-label-md text-label-md rounded-full py-4 shadow-lg hover:bg-primary-container hover:text-on-primary-container cursor-pointer transition-all mt-2" type="submit">
            Đăng nhập
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-8">
        <div class="h-px bg-outline-variant/50 flex-1"></div>
        <span class="font-label-md text-label-md text-on-surface-variant">hoặc tiếp tục với</span>
        <div class="h-px bg-outline-variant/50 flex-1"></div>
    </div>

    <!-- Social Logins -->
    <div class="flex gap-4">
        <button class="flex-1 glass-tier-2 rounded-xl py-3 flex items-center justify-center gap-2 hover:bg-white/40 transition-colors">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">mail</span>
            <span class="font-label-md text-label-md">Google</span>
        </button>
        <button class="flex-1 glass-tier-2 rounded-xl py-3 flex items-center justify-center gap-2 hover:bg-white/40 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
            </svg>
            <span class="font-label-md text-label-md">Số điện thoại</span>
        </button>
    </div>
</x-layouts.auth>
