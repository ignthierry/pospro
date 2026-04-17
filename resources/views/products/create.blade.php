<x-app-layout>
    <div class="px-6 py-4 pb-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('products.index') }}" class="text-on-surface-variant p-2 -ml-2"><span class="material-symbols-outlined">arrow_back</span></a>
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Add Product</h2>
        </div>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Product Name</label>
                <input type="text" name="name" id="name" required placeholder="e.g. Arabica Latte"
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                @error('name') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Category</label>
                <select name="category_id" id="category_id" required
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Price</label>
                    <input type="number" name="price" id="price" required placeholder="0"
                        class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                    @error('price') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="stock" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Stock</label>
                    <input type="number" name="stock" id="stock" required placeholder="0"
                        class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                    @error('stock') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="image" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Image URL (Optional)</label>
                <input type="url" name="image" id="image" placeholder="https://..."
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-sm">
                @error('image') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full h-16 bg-primary text-on-primary rounded-full font-manrope font-bold text-xl shadow-lg active:scale-95 transition-transform">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
