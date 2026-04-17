<x-app-layout>
    <div class="px-6 py-4 animate-in">
        <h2 class="font-manrope text-2xl font-bold tracking-tight mb-6 dark:text-[#f1f0fb]">Business Dashboard</h2>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-4 mb-8">
            <div class="bg-primary text-on-primary p-6 rounded-[2.5rem] shadow-lg shadow-primary/20 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full transition-transform group-hover:scale-120"></div>
                <p class="font-manrope font-bold text-sm opacity-80 mb-1">Today's Turnover</p>
                <h3 class="font-manrope text-3xl font-extrabold tracking-tight">Rp {{ number_format($dailyOmset, 0, ',', '.') }}</h3>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-surface-container-highest dark:bg-white/5 p-5 rounded-[2rem] transition-all hover:bg-surface-variant dark:hover:bg-white/10">
                    <p class="font-manrope font-bold text-[10px] text-on-surface-variant dark:text-white/40 uppercase tracking-wider mb-1">This Week</p>
                    <h4 class="font-manrope text-lg font-extrabold text-primary">Rp {{ number_format($weeklyOmset, 0, ',', '.') }}</h4>
                </div>
                <div class="bg-surface-container-high dark:bg-white/5 p-5 rounded-[2rem] transition-all hover:bg-surface-variant dark:hover:bg-white/10">
                    <p class="font-manrope font-bold text-[10px] text-on-surface-variant dark:text-white/40 uppercase tracking-wider mb-1">This Month</p>
                    <h4 class="font-manrope text-lg font-extrabold text-on-surface dark:text-[#f1f0fb]">Rp {{ number_format($monthlyOmset, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-manrope font-bold text-lg text-on-surface dark:text-[#f1f0fb]">Recent Transactions</h3>
            <a href="#" class="text-primary text-sm font-bold">View All</a>
        </div>

        <div class="space-y-3">
            @forelse($transactions as $tx)
            <div class="bg-surface-container-lowest dark:bg-white/5 p-4 rounded-2xl shadow-sm flex items-center gap-4 transition-all hover:translate-x-1">
                <div class="w-12 h-12 bg-surface-container dark:bg-white/10 rounded-xl flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">receipt_long</span>
                </div>
                <div class="flex-grow">
                    <h5 class="font-manrope font-bold text-sm text-on-surface dark:text-[#f1f0fb]">#{{ $tx->invoice_number }}</h5>
                    <p class="text-xs text-on-surface-variant dark:text-white/40">{{ $tx->customer ? $tx->customer->name : 'Pelanggan Umum' }} • {{ $tx->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <p class="font-manrope font-bold text-sm text-on-surface dark:text-[#f1f0fb]">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</p>
                    <span class="text-[10px] bg-secondary-container dark:bg-secondary/20 text-secondary px-2 py-0.5 rounded-full font-bold">Success</span>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <p class="text-on-surface-variant font-medium">No transactions yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
