<x-app-layout>
    <div x-data="posSystem()" class="px-4 pb-12 animate-in">
        <!-- Hero Banner -->
        <div class="mt-4 mb-6 rounded-[2.5rem] overflow-hidden h-32 relative shadow-md group">
            <img src="{{ asset('assets/pos_banner.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="The Atelier Banner">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0e12]/80 to-transparent flex flex-col justify-end p-6">
                <h4 class="text-white font-manrope font-extrabold text-xl tracking-tight">Artisanal Selection</h4>
                <p class="text-white/80 text-[8px] font-bold uppercase tracking-[0.2em]">Handcrafted Daily</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="sticky top-16 bg-surface dark:bg-[#1a1b23] z-40 -mx-4 px-4 pb-2 transition-colors duration-300">
            <!-- Search -->
            <div class="relative mt-2">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant dark:text-white/40">search</span>
                <input type="text" x-model="search" placeholder="Search product..." 
                    class="w-full h-12 pl-12 pr-4 bg-surface-container dark:bg-white/5 dark:text-white rounded-2xl border-none focus:ring-2 focus:ring-primary text-sm font-inter transition-all">
            </div>

            <!-- Category Tabs -->
            <nav class="flex gap-2 py-4 overflow-x-auto no-scrollbar">
                <button @click="selectedCategory = 'all'" 
                    :class="selectedCategory === 'all' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high dark:bg-white/5 text-on-surface-variant dark:text-white/60'"
                    class="whitespace-nowrap px-6 py-3 rounded-full font-manrope font-bold text-sm transition-all scale-on-press">
                    All
                </button>
                @foreach($categories as $category)
                <button @click="selectedCategory = '{{ $category->id }}'" 
                    :class="selectedCategory == '{{ $category->id }}' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high dark:bg-white/5 text-on-surface-variant dark:text-white/60'"
                    class="whitespace-nowrap px-6 py-3 rounded-full font-manrope font-semibold text-sm transition-all scale-on-press">
                    {{ $category->name }}
                </button>
                @endforeach
            </nav>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 gap-4 mt-2">
            <template x-for="product in filteredProducts()" :key="product.id">
                <div @click="addToCart(product)" 
                    class="bg-surface-container-lowest dark:bg-white/5 rounded-3xl p-3 shadow-sm transition-all scale-on-press relative overflow-hidden group"
                    :class="isInCart(product.id) ? 'bg-surface-container-highest dark:bg-white/10 ring-2 ring-primary ring-inset' : ''">
                    <div x-show="isInCart(product.id)" 
                        class="absolute top-3 right-3 bg-primary text-on-primary w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold z-10 animate-in" 
                        x-text="getItemQty(product.id)"></div>
                    <div class="aspect-square w-full rounded-2xl overflow-hidden bg-surface-container dark:bg-white/5 mb-3">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" :src="product.image || 'https://via.placeholder.com/150'" :alt="product.name"/>
                    </div>
                    <h3 class="font-manrope font-bold text-sm text-on-surface dark:text-[#f1f0fb] line-clamp-1 leading-tight px-1" x-text="product.name"></h3>
                    <p class="font-body text-primary font-semibold mt-1 px-1" x-text="formatCurrency(product.price)"></p>
                </div>
            </template>
        </div>

        <!-- Floating View Cart Button -->
        <div x-show="cart.length > 0" 
            x-transition:enter="transition ease-out duration-500 transform" 
            x-transition:enter-start="translate-y-full opacity-0 scale-90" 
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-end="translate-y-full opacity-0"
            class="fixed bottom-24 left-1/2 -translate-x-1/2 w-full max-w-md px-6 z-40">
            <button @click="isCartOpen = true" class="w-full h-16 bg-gradient-to-r from-primary to-primary-container text-on-primary rounded-full shadow-2xl shadow-primary/40 flex items-center justify-between px-7 active:scale-95 transition-all">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined">shopping_basket</span>
                    <span class="font-manrope font-bold text-sm" x-text="cartTotalItems() + ' Items'"></span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-manrope font-extrabold text-lg" x-text="formatCurrency(cartTotalPrice())"></span>
                    <span class="material-symbols-outlined">arrow_forward_ios</span>
                </div>
            </button>
        </div>

        <!-- Cart Modal -->
        <div x-show="isCartOpen" class="fixed inset-0 z-50 flex items-end justify-center px-4 pb-24">
            <div x-show="isCartOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" @click="isCartOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div x-show="isCartOpen" x-transition:enter="transition ease-out duration-500 transform" x-transition:enter-start="translate-y-full" class="bg-surface dark:bg-[#1a1b23] w-full max-w-md rounded-[3rem] p-8 relative z-10 shadow-2xl transition-colors duration-300 flex flex-col max-h-[75vh]">
                <div class="w-12 h-1.5 bg-surface-container-highest dark:bg-white/10 rounded-full mx-auto mb-8 shrink-0"></div>
                
                <h3 class="font-manrope font-extrabold text-2xl text-on-surface dark:text-[#f1f0fb] mb-6 shrink-0">Your Cart</h3>
                
                <div class="flex-grow overflow-y-auto space-y-4 mb-6 no-scrollbar">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="flex items-center justify-between bg-surface-container-low dark:bg-white/5 p-4 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm">
                                    <img :src="item.image || 'https://via.placeholder.com/150'" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-manrope font-bold text-sm text-on-surface dark:text-[#f1f0fb]" x-text="item.name"></h4>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-wider" x-text="formatCurrency(item.price)"></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-surface dark:bg-white/5 rounded-full px-1 py-1 shadow-inner">
                                <button @click="decrementQty(index)" class="w-8 h-8 rounded-full bg-surface-container-high dark:bg-white/10 flex items-center justify-center text-primary transition-all active:scale-90"><span class="material-symbols-outlined text-sm font-bold">remove</span></button>
                                <span class="font-manrope font-extrabold text-on-surface dark:text-[#f1f0fb] w-4 text-center" x-text="item.quantity"></span>
                                <button @click="incrementQty(index)" class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center transition-all active:scale-90 shadow-md"><span class="material-symbols-outlined text-sm font-bold">add</span></button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Customer Selection -->
                <div class="mb-6 shrink-0">
                    <label class="font-manrope font-bold text-xs text-on-surface-variant dark:text-white/40 block mb-2 px-1 uppercase tracking-widest">Select Consumer</label>
                    <select x-model="selectedCustomer" class="w-full h-14 bg-surface-container-low dark:bg-white/5 dark:text-white border-none rounded-2xl focus:ring-2 focus:ring-primary font-inter text-sm transition-all">
                        <option value="">Guest (Pelanggan Umum)</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-4 pt-4 border-t border-outline-variant/15 dark:border-white/10 shrink-0">
                    <div class="flex justify-between items-center px-2">
                        <span class="font-manrope font-bold text-on-surface-variant dark:text-white/40">Total Amount</span>
                        <span class="font-manrope font-extrabold text-2xl text-primary" x-text="formatCurrency(cartTotalPrice())"></span>
                    </div>
                    <button @click="isCartOpen = false; isCheckoutOpen = true" class="w-full h-16 bg-primary text-on-primary rounded-full font-manrope font-bold text-xl shadow-lg shadow-primary/30 active:scale-95 transition-all">
                        Complete Transaction
                    </button>
                </div>
            </div>
        </div>

        <!-- Checkout Selection (Numpad) -->
        <div x-show="isCheckoutOpen" class="fixed inset-0 z-[70] flex items-end justify-center px-4 pb-24 transition-all">
             <div x-show="isCheckoutOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" @click="isCheckoutOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
             
             <div x-show="isCheckoutOpen" x-transition:enter="transition ease-out duration-500 transform" x-transition:enter-start="translate-y-full"
                class="relative bg-surface dark:bg-[#1a1b23] w-full max-w-md rounded-[3rem] p-8 shadow-2xl flex flex-col transition-colors duration-300 max-h-[85vh] overflow-y-auto no-scrollbar">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-manrope text-2xl font-manrope font-extrabold text-on-surface dark:text-[#f1f0fb] tracking-tight">Payment</h2>
                    <button @click="isCheckoutOpen = false" class="text-on-surface-variant dark:text-white/40 p-2"><span class="material-symbols-outlined">close</span></button>
                </div>

                <div class="bg-surface-container-lowest dark:bg-white/5 p-6 rounded-[2rem] mb-6 text-center shadow-inner">
                    <p class="text-on-surface-variant dark:text-white/40 font-manrope font-bold text-xs uppercase tracking-widest mb-2">Grand Total</p>
                    <h3 class="text-4xl font-manrope font-extrabold text-primary" x-text="formatCurrency(cartTotalPrice())"></h3>
                </div>

                <!-- Payment Input Display -->
                <div class="mb-6 relative">
                    <div class="w-full h-24 flex items-center justify-center text-4xl font-manrope font-extrabold text-on-surface dark:text-[#f1f0fb] bg-surface-container-low dark:bg-white/5 rounded-[2rem] border-2 border-transparent focus-within:border-primary transition-all" 
                        x-text="formatCurrency(Number(paidInput) || 0)"></div>
                </div>

                <!-- Numeric Keypad -->
                <div class="grid grid-cols-3 gap-2 mb-6">
                    <template x-for="n in ['1','2','3','4','5','6','7','8','9','0','00','del']">
                        <button @click="handleNumpad(n)" 
                            class="h-16 rounded-2xl bg-surface-container-low dark:bg-white/5 text-on-surface dark:text-[#f1f0fb] font-manrope font-extrabold text-2xl active:bg-primary active:text-on-primary transition-all shadow-sm">
                            <span x-show="n !== 'del'" x-text="n"></span>
                            <span x-show="n === 'del'" class="material-symbols-outlined text-2xl">backspace</span>
                        </button>
                    </template>
                </div>

                <!-- Change Calculation -->
                <div x-show="Number(paidInput) >= cartTotalPrice()" 
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="scale-95 opacity-0"
                    class="bg-secondary/10 dark:bg-secondary/20 p-5 rounded-[2rem] mb-6 flex justify-between items-center border border-secondary/20">
                    <span class="text-secondary font-manrope font-bold">Money Back</span>
                    <span class="text-secondary font-manrope font-extrabold text-2xl" x-text="formatCurrency(Number(paidInput) - cartTotalPrice())"></span>
                </div>

                <button @click="processPayment()" :disabled="processing || Number(paidInput) < cartTotalPrice()" 
                    class="w-full h-20 bg-primary text-on-primary disabled:opacity-30 rounded-full font-manrope font-bold text-2xl flex items-center justify-center gap-3 shadow-xl shadow-primary/40 active:scale-95 transition-all">
                    <span x-show="!processing">Print & Finalize</span>
                    <span x-show="processing" class="animate-spin material-symbols-outlined text-3xl">refresh</span>
                </button>
             </div>
        </div>
    </div>

    <script>
        function posSystem() {
            return {
                products: @json($products),
                cart: [],
                search: '',
                selectedCategory: 'all',
                isCartOpen: false,
                isCheckoutOpen: false,
                selectedCustomer: '',
                paidInput: '',
                processing: false,

                filteredProducts() {
                    return this.products.filter(p => {
                        const matchCat = this.selectedCategory === 'all' || p.category_id == this.selectedCategory;
                        const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        return matchCat && matchSearch;
                    });
                },

                addToCart(product) {
                    const index = this.cart.findIndex(item => item.id === product.id);
                    if (index > -1) {
                        this.cart[index].quantity++;
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            image: product.image,
                            quantity: 1
                        });
                    }
                },

                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },

                incrementQty(index) {
                    this.cart[index].quantity++;
                },

                decrementQty(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    } else {
                        this.removeFromCart(index);
                    }
                },

                isInCart(id) {
                    return this.cart.some(item => item.id === id);
                },

                getItemQty(id) {
                    const item = this.cart.find(item => item.id === id);
                    return item ? item.quantity : 0;
                },

                cartTotalItems() {
                    return this.cart.reduce((sum, item) => sum + item.quantity, 0);
                },

                cartTotalPrice() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
                },

                handleNumpad(val) {
                    if (val === 'del') {
                        this.paidInput = this.paidInput.slice(0, -1);
                    } else {
                        this.paidInput += val;
                    }
                },

                async processPayment() {
                    if (this.processing) return;
                    this.processing = true;

                    try {
                        const response = await fetch('{{ route("pos.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                customer_id: this.selectedCustomer,
                                cart: this.cart,
                                total_amount: this.cartTotalPrice(),
                                paid_amount: Number(this.paidInput)
                            })
                        });

                        const result = await response.json();
                        if (result.success) {
                            window.location.href = result.redirect_url;
                        } else {
                            alert('Payment failed');
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Error processing payment');
                    } finally {
                        this.processing = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
