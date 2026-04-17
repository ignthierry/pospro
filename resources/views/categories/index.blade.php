<x-app-layout>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Categories</h2>
            <a href="{{ route('categories.create') }}" class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                <span class="material-symbols-outlined">add</span>
            </a>
        </div>

        <div class="space-y-3">
            @forelse($categories as $category)
            <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex justify-between items-center group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-surface-container rounded-xl flex items-center justify-center text-primary group-hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined">category</span>
                    </div>
                    <span class="font-manrope font-bold text-on-surface">{{ $category->name }}</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                <p class="text-on-surface-variant font-medium">No categories found.</p>
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
