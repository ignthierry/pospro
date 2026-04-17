<x-app-layout>
    <div class="px-6 py-4 animate-in">
        <h2 class="font-manrope text-2xl font-bold tracking-tight mb-6 dark:text-[#f1f0fb]">Master Data Hub</h2>

        <div class="space-y-4">
            <!-- Categories Hub Card -->
            <a href="{{ route('categories.index') }}" class="block bg-surface-container-lowest dark:bg-white/5 p-6 rounded-[2.5rem] shadow-sm transition-all scale-on-press group relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-primary/5 dark:bg-primary/20 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center transition-transform group-hover:rotate-12">
                        <span class="material-symbols-outlined text-3xl">category</span>
                    </div>
                    <div>
                        <h3 class="font-manrope font-bold text-lg text-on-surface dark:text-[#f1f0fb]">Categories</h3>
                        <p class="text-xs text-on-surface-variant dark:text-white/40 font-medium">{{ $counts['categories'] }} items defined</p>
                    </div>
                </div>
            </a>

            <!-- Products Hub Card -->
            <a href="{{ route('products.index') }}" class="block bg-surface-container-lowest dark:bg-white/5 p-6 rounded-[2.5rem] shadow-sm transition-all scale-on-press group relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-secondary/5 dark:bg-secondary/20 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center transition-transform group-hover:-rotate-12">
                        <span class="material-symbols-outlined text-3xl">inventory_2</span>
                    </div>
                    <div>
                        <h3 class="font-manrope font-bold text-lg text-on-surface dark:text-[#f1f0fb]">Products</h3>
                        <p class="text-xs text-on-surface-variant dark:text-white/40 font-medium">{{ $counts['products'] }} items in inventory</p>
                    </div>
                </div>
            </a>

            <!-- Customers Hub Card -->
            <a href="{{ route('customers.index') }}" class="block bg-surface-container-lowest dark:bg-white/5 p-6 rounded-[2.5rem] shadow-sm transition-all scale-on-press group relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-tertiary/5 dark:bg-tertiary/20 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-tertiary/10 text-tertiary rounded-2xl flex items-center justify-center transition-transform group-hover:rotate-12">
                        <span class="material-symbols-outlined text-3xl">group</span>
                    </div>
                    <div>
                        <h3 class="font-manrope font-bold text-lg text-on-surface dark:text-[#f1f0fb]">Customers</h3>
                        <p class="text-xs text-on-surface-variant dark:text-white/40 font-medium">{{ $counts['customers'] }} registered members</p>
                    </div>
                </div>
            <!-- Shop Hub Card -->
            <a href="{{ route('shop.index') }}" class="block bg-surface-container-lowest dark:bg-white/5 p-6 rounded-[2.5rem] shadow-sm transition-all scale-on-press group relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-primary/10 dark:bg-primary/30 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-primary/20 text-primary rounded-2xl flex items-center justify-center transition-transform group-hover:rotate-12">
                        <span class="material-symbols-outlined text-3xl">store</span>
                    </div>
                    <div>
                        <h3 class="font-manrope font-bold text-lg text-on-surface dark:text-[#f1f0fb]">Master Toko</h3>
                        <p class="text-xs text-on-surface-variant dark:text-white/40 font-medium">Store Identity & Branding</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="mt-8 p-6 bg-surface-container-high rounded-[2rem]">
            <h4 class="font-manrope font-bold text-on-surface mb-2">Management Note</h4>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Changes made here will reflect immediately in the Point of Sale and Inventory modules. Use these tools to keep your catalog and customer base updated.
            </p>
        </div>
    </div>
</x-app-layout>
