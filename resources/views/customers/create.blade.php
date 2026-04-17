<x-app-layout>
    <div class="px-6 py-4">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('customers.index') }}" class="text-on-surface-variant p-2 -ml-2"><span class="material-symbols-outlined">arrow_back</span></a>
            <h2 class="font-manrope text-2xl font-bold tracking-tight">Add Consumer</h2>
        </div>

        <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">Consumer Name</label>
                <input type="text" name="name" id="name" required placeholder="e.g. John Doe"
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                @error('name') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="font-manrope font-bold text-sm block mb-2 text-on-surface-variant">WhatsApp Number</label>
                <input type="text" name="phone" id="phone" required placeholder="e.g. 62812345678"
                    class="w-full h-14 px-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg">
                <p class="text-[10px] text-on-surface-variant mt-1 font-medium">Use country code without + or 0 (e.g. 62812...)</p>
                @error('phone') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full h-16 bg-primary text-on-primary rounded-full font-manrope font-bold text-xl shadow-lg active:scale-95 transition-transform">
                    Save Consumer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
