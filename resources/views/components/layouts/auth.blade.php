<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'MiniMart - Authentication' }}</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Ambient Orbs */
        .orb-primary {
            background: radial-gradient(circle, var(--color-primary-fixed) 0%, rgba(255,255,255,0) 70%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            position: absolute;
            top: -100px;
            left: -100px;
            z-index: -1;
            opacity: 0.6;
            animation: float 20s ease-in-out infinite alternate;
        }

        .orb-secondary {
            background: radial-gradient(circle, var(--color-secondary-fixed) 0%, rgba(255,255,255,0) 70%);
            width: 500px;
            height: 500px;
            border-radius: 50%;
            position: absolute;
            bottom: -50px;
            right: -50px;
            z-index: -1;
            opacity: 0.5;
            animation: float 25s ease-in-out infinite alternate-reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 50px) scale(1.05); }
            100% { transform: translate(-20px, 20px) scale(0.95); }
        }
    </style>
</head>
<body class="bg-background min-h-screen overflow-y-auto pb-12 flex flex-col items-center justify-center relative font-body-lg text-body-lg text-on-surface pt-12">
    <!-- Ambient Background -->
    <div class="orb-primary"></div>
    <div class="orb-secondary"></div>
    
    <!-- Back to Home Button -->
    <a href="{{ route('home') }}" class="absolute top-6 left-6 flex items-center gap-2 glass-tier-2 rounded-full px-4 py-2 text-on-surface font-label-md text-label-md hover:-translate-y-[2px] shadow-sm hover:shadow-md transition-all z-20">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        <span class="hidden sm:inline">Quay lại cửa hàng</span>
    </a>

    <!-- Main Container -->
    <main class="w-full max-w-[480px] p-gutter relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="font-display-lg text-display-lg text-primary font-extrabold">MiniMart</h1>
        </div>
        
        <!-- Auth Card -->
        <div class="glass-tier-4 rounded-[20px] shadow-2xl p-8 relative overflow-hidden">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
