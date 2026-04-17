<x-app-layout>
    <div class="px-6 py-4 animate-in">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('master.hub') }}" class="text-on-surface-variant p-2 -ml-2 transition-all active:scale-90">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-manrope text-2xl font-bold tracking-tight dark:text-[#f1f0fb]">Shop Identity</h2>
        </div>

        <form action="{{ route('shop.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Logo Preview -->
            <div class="flex flex-col items-center justify-center p-8 bg-surface-container-low dark:bg-white/5 rounded-[2.5rem] border-2 border-dashed border-outline-variant/30 dark:border-white/10 group transition-all">
                <div class="w-24 h-24 rounded-3xl overflow-hidden shadow-xl mb-4 bg-surface dark:bg-white/5 transition-transform group-hover:scale-105">
                    <img src="{{ $shop->logo }}" id="logo-preview" class="w-full h-full object-cover">
                </div>
                <p class="text-[10px] text-on-surface-variant dark:text-white/40 font-bold uppercase tracking-widest">Shop Logo Preview</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="name" class="font-manrope font-bold text-xs text-on-surface-variant dark:text-white/40 block mb-2 px-1 uppercase tracking-widest">Shop Name</label>
                    <input type="text" name="name" id="name" required value="{{ $shop->name }}"
                        class="w-full h-14 px-4 bg-surface-container-low dark:bg-white/5 dark:text-white border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg transition-all">
                </div>

                <div>
                    <label for="logo" class="font-manrope font-bold text-xs text-on-surface-variant dark:text-white/40 block mb-2 px-1 uppercase tracking-widest">Logo URL</label>
                    <input type="url" name="logo" id="logo" value="{{ $shop->logo }}"
                        oninput="document.getElementById('logo-preview').src = this.value"
                        class="w-full h-14 px-4 bg-surface-container-low dark:bg-white/5 dark:text-white border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-sm transition-all">
                </div>

                <div>
                    <label for="phone" class="font-manrope font-bold text-xs text-on-surface-variant dark:text-white/40 block mb-2 px-1 uppercase tracking-widest">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ $shop->phone }}"
                        class="w-full h-14 px-4 bg-surface-container-low dark:bg-white/5 dark:text-white border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-lg transition-all">
                </div>

                <div>
                    <label for="address" class="font-manrope font-bold text-xs text-on-surface-variant dark:text-white/40 block mb-2 px-1 uppercase tracking-widest">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full p-4 bg-surface-container-low dark:bg-white/5 dark:text-white border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-sm transition-all">{{ $shop->address }}</textarea>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full h-16 bg-primary text-on-primary rounded-full font-manrope font-bold text-xl shadow-lg shadow-primary/30 active:scale-95 transition-all">
                    Update Identity
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
