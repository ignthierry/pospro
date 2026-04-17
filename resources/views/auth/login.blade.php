<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | The Atelier</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark .glass-card {
            background: rgba(13, 14, 18, 0.6);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .bg-blur-overlay {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image: url('/assets/login_hero.png');
            background-size: cover;
            background-position: center;
            filter: blur(40px) brightness(0.7);
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-[#fbf8ff] dark:bg-[#0d0e12] transition-colors duration-500 flex items-center justify-center min-h-screen p-6 relative overflow-hidden">
    <!-- Immersive Blurred Background -->
    <div class="bg-blur-overlay"></div>
    <div class="fixed inset-0 bg-gradient-to-br from-primary/20 via-transparent to-black/40 z-[-1]"></div>

    <div class="w-full max-w-md animate-in relative z-10">
        <!-- Decoration -->
        <div class="mb-10 text-center">
            <div class="w-20 h-20 bg-white/10 dark:bg-white/5 backdrop-blur-md rounded-[2.5rem] flex items-center justify-center mx-auto mb-6 shadow-2xl border border-white/20">
                <span class="material-symbols-outlined text-4xl text-white">store</span>
            </div>
            <h1 class="font-manrope text-4xl font-extrabold text-white tracking-tight drop-shadow-md">The Atelier</h1>
            <p class="text-white/70 font-medium mt-2 drop-shadow-sm">Architectural Ledger System</p>
        </div>

        <!-- Login Form -->
        <div class="glass-card p-10 rounded-[3.5rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.3)]">
            <form action="/login" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="font-manrope font-bold text-[10px] text-white/50 block mb-2 px-1 uppercase tracking-[0.2em]">Email Access</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/30 group-focus-within:text-white transition-colors">mail</span>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="w-full h-14 pl-12 pr-4 bg-white/5 dark:bg-black/20 text-white placeholder-white/20 border border-white/10 focus:border-white/30 focus:ring-0 rounded-2xl font-inter text-lg transition-all"
                            placeholder="admin@atelier.com">
                    </div>
                    @error('email') <p class="text-red-400 text-xs mt-2 font-medium px-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 px-1">
                        <label for="password" class="font-manrope font-bold text-[10px] text-white/50 uppercase tracking-[0.2em]">Security Key</label>
                        <a href="#" class="text-[10px] text-white/40 font-bold uppercase tracking-wider hover:text-white transition-colors">Recover</a>
                    </div>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/30 group-focus-within:text-white transition-colors">lock</span>
                        <input type="password" name="password" id="password" required
                            class="w-full h-14 pl-12 pr-4 bg-white/5 dark:bg-black/20 text-white border border-white/10 focus:border-white/30 focus:ring-0 rounded-2xl font-inter text-lg transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="group w-full h-16 bg-white text-on-surface rounded-full font-manrope font-bold text-xl shadow-xl hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                        Enter Ledger
                        <span class="material-symbols-outlined text-2xl group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-10 text-center">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div class="h-[1px] w-8 bg-white/10"></div>
                <p class="text-white/30 text-[10px] font-bold uppercase tracking-widest leading-none">Powered by Atelier AI</p>
                <div class="h-[1px] w-8 bg-white/10"></div>
            </div>
        </div>
    </div>
</body>
</html>
