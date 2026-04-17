<x-app-layout>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Products</h2>
            <a href="{{ route('products.create') }}" class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                <span class="material-symbols-outlined">add</span>
            </a>
        </div>

        <div class="space-y-4">
            @forelse($products as $product)
            <div class="bg-surface-container-lowest p-3 rounded-2xl shadow-sm flex items-center gap-4 group">
                <div class="w-16 h-16 rounded-xl overflow-hidden bg-surface-container shrink-0">
                    <img src="{{ $product->image ?: 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h4 class="font-manrope font-bold text-on-surface leading-tight">{{ $product->name }}</h4>
                    <p class="text-xs text-on-surface-variant font-medium">{{ $product->category->name }} • {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-[10px] mt-0.5 {{ $product->stock < 10 ? 'text-error font-bold' : 'text-on-surface-variant' }}">Stock: {{ $product->stock }}</p>
                </div>
                <div class="flex gap-1">
                    <a href="{{ route('products.edit', $product->id) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <p class="text-on-surface-variant font-medium">No products found.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            <a href="{{ route('master.hub') }}" class="flex items-center gap-2 text-primary font-bold text-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Back to Hub
            </a>
        </div>
    </div>
</x-app-layout>
