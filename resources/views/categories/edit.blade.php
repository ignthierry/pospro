<x-app-layout>
    <div class="px-6 py-4">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('categories.index') }}" class="text-on-surface-variant p-2 -ml-2"><span class="material-symbols-outlined">arrow_back</span></a>
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Edit Category</h2>
        </div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Category Name</label>
                <input type="text" name="name" id="name" required value="{{ $category->name }}"
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                @error('name') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full h-16 bg-primary text-on-primary rounded-full font-manrope font-bold text-xl shadow-lg active:scale-95 transition-transform">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
