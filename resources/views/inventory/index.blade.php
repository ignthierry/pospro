<x-app-layout>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Inventory</h2>
            <div class="flex gap-2">
                 <a href="{{ route('master.hub') }}" class="w-10 h-10 bg-surface-container-highest text-primary rounded-full flex items-center justify-center shadow-sm active:scale-90 transition-transform">
                    <span class="material-symbols-outlined">settings</span>
                </a>
            </div>
        </div>

        <!-- Stock Overview -->
        <div class="bg-surface-container-lowest p-6 rounded-[2rem] shadow-sm mb-6 flex justify-between items-center">
            <div>
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Total Products</p>
                <h3 class="text-2xl font-manrope font-extrabold text-on-surface">{{ $products->count() }}</h3>
            </div>
            <div class="text-right">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Low Stock</p>
                <h3 class="text-2xl font-manrope font-extrabold text-error">{{ $products->where('stock', '<', 10)->count() }}</h3>
            </div>
        </div>

        <!-- Inventory List -->
        <div class="space-y-4">
            @foreach($products as $product)
            <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl overflow-hidden bg-surface-container shrink-0">
                    <img src="{{ $product->image ?: 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h4 class="font-manrope font-bold text-sm text-on-surface mb-1">{{ $product->name }}</h4>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] bg-surface-container px-2 py-0.5 rounded-full font-bold text-on-surface-variant">{{ $product->category->name }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs font-manrope font-bold {{ $product->stock < 10 ? 'text-error' : 'text-on-surface-variant' }}">Stock</p>
                    <p class="text-lg font-manrope font-extrabold {{ $product->stock < 10 ? 'text-error' : 'text-on-surface' }}">{{ $product->stock }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
