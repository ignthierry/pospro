<!DOCTYPE html>
@php
    $shop = \App\Models\Shop::first() ?? (object)['name' => 'The Atelier', 'logo' => ''];
@endphp
<html class="light" lang="en"
    x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
        }
    }"
    :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ config('app.name', 'The Atelier') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-surface text-on-surface dark:text-[#f1f0fb] antialiased transition-colors duration-300 flex justify-center">
    
    <div class="w-full max-w-md bg-surface dark:bg-[#1a1b23] min-h-screen relative flex flex-col transition-colors duration-300">
        
        <!-- Header -->
        <header class="fixed top-0 w-full max-w-md z-50 bg-surface/80 dark:bg-[#1a1b23]/80 backdrop-blur-md transition-colors duration-300">
            <div class="flex justify-between items-center px-6 h-16 w-full max-w-md mx-auto">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 dark:bg-white/5 rounded-xl flex items-center justify-center overflow-hidden">
                        @if($shop->logo)
                            <img src="{{ $shop->logo }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-primary">store</span>
                        @endif
                    </div>
                    <h1 class="font-manrope tracking-tight font-bold text-lg text-on-surface dark:text-[#f1f0fb] line-clamp-1">{{ $shop->name }}</h1>
                </div>
                <div class="flex items-center gap-1">
                    <button @click="toggleDarkMode()" class="text-on-surface-variant dark:text-white/40 hover:bg-surface-container-low dark:hover:bg-white/5 p-2 rounded-full transition-all active:scale-95">
                        <span class="material-symbols-outlined" x-text="darkMode ? 'light_mode' : 'dark_mode'">dark_mode</span>
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-error hover:bg-error/5 p-2 rounded-full transition-all active:scale-95">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow pt-16 pb-32">
            {{ $slot }}
        </main>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 w-full max-w-md z-50 bg-surface/80 dark:bg-[#2f3038]/80 backdrop-blur-xl border-t border-outline-variant/15 dark:border-white/10 shadow-[0_-12px_40px_rgba(26,27,35,0.06)] transition-colors duration-300">
            <div class="flex justify-around items-center h-20 px-4 w-full max-w-md mx-auto">
                <a href="{{ route('pos.index') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('pos.*') ? 'bg-surface-container-highest dark:bg-white/10 text-primary' : 'text-on-surface-variant dark:text-white/60' }} rounded-xl px-3 py-1 transition-all scale-on-press">
                    <span class="material-symbols-outlined">point_of_sale</span>
                    <span class="font-inter text-[10px] font-medium">Register</span>
                </a>
                <a href="{{ route('reports.index') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('reports.*') ? 'bg-surface-container-highest dark:bg-white/10 text-primary' : 'text-on-surface-variant dark:text-white/60' }} rounded-xl px-3 py-1 transition-all scale-on-press">
                    <span class="material-symbols-outlined">analytics</span>
                    <span class="font-inter text-[10px] font-medium">Reports</span>
                </a>
                <a href="{{ route('inventory.index') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('inventory.*') ? 'bg-surface-container-highest dark:bg-white/10 text-primary' : 'text-on-surface-variant dark:text-white/60' }} rounded-xl px-3 py-1 transition-all scale-on-press">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-inter text-[10px] font-medium">Inventory</span>
                </a>
                <a href="{{ route('master.hub') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('master.*') || request()->routeIs('categories.*') || request()->routeIs('products.*') || request()->routeIs('customers.*') ? 'bg-surface-container-highest dark:bg-white/10 text-primary' : 'text-on-surface-variant dark:text-white/60' }} rounded-xl px-3 py-1 transition-all scale-on-press">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-inter text-[10px] font-medium">Master</span>
                </a>
            </div>
        </nav>
    </div>
</body>
</html>
