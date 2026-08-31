<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Login - MiniMart</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
            100% { transform: translateY(0) scale(1); }
        }
        .orb-1 { animation: float 8s ease-in-out infinite; }
        .orb-2 { animation: float 12s ease-in-out infinite reverse; }
        .orb-3 { animation: float 10s ease-in-out infinite 2s; }
    </style>
</head>
<body class="bg-surface min-h-screen flex items-center justify-center relative overflow-hidden text-on-surface">
    <!-- Ambient Background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none bg-gradient-to-br from-[#f6fbef] to-[#eef2e7]">
        <div class="orb-1 absolute top-[20%] left-[10%] w-[400px] h-[400px] rounded-full bg-[#92d78b]/30 blur-[80px]"></div>
        <div class="orb-2 absolute bottom-[10%] right-[15%] w-[500px] h-[500px] rounded-full bg-[#ffb68b]/20 blur-[100px]"></div>
        <div class="orb-3 absolute top-[40%] right-[40%] w-[300px] h-[300px] rounded-full bg-[#ffb0c8]/20 blur-[90px]"></div>
    </div>

    <!-- Thick Glass Card -->
    <main class="z-10 w-full max-w-md p-4 sm:p-6">
        <div class="bg-white/50 backdrop-blur-[50px] border border-white/60 shadow-[0_8px_32px_rgba(0,0,0,0.08)] rounded-[24px] p-8 relative overflow-hidden">
            <!-- Shimmer effect overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col gap-8">
                <!-- Header -->
                <div class="text-center flex flex-col gap-2 items-center">
                    <div class="w-16 h-16 rounded-2xl bg-green-900 flex items-center justify-center shadow-lg mb-2">
                        <span class="material-symbols-outlined text-white text-[32px]">storefront</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-green-900 tracking-tight">MiniMart</h1>
                    <p class="text-gray-600 font-medium">Admin Portal</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-3 rounded-xl text-sm font-semibold">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form -->
                <form class="flex flex-col gap-6" method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <!-- Email Input -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700" for="email">Staff Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                            <input class="w-full bg-white/70 shadow-inner border border-white rounded-[12px] pl-10 pr-4 py-3 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-700/50 transition-all" id="email" name="email" value="{{ old('email') }}" placeholder="admin@minimart.com" type="email" required autofocus/>
                        </div>
                    </div>
                    
                    <!-- Password Input -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700" for="password">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                            <input class="w-full bg-white/70 shadow-inner border border-white rounded-[12px] pl-10 pr-4 py-3 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-700/50 transition-all" id="password" name="password" placeholder="••••••••" type="password" required/>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button class="w-full bg-green-900 text-white font-bold rounded-full py-3 mt-2 hover:bg-green-800 transition-colors shadow-md active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                        Sign In
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>
                </form>
                
                <!-- Footer -->
                <div class="text-center border-t border-white/50 pt-6">
                    <p class="text-xs text-gray-500 font-semibold">Internal operations system. Authorized access only.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
