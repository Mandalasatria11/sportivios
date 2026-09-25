<x-layout title="Your Cart - SPORTIVIOS">
    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Back to Shop Link -->
            <div class="mb-4">
                <a href="{{ url('/product') }}" class="inline-flex items-center text-xs font-bold text-[#0e7490] hover:text-black transition group">
                    <span class="mr-1.5 transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Back to Shop</span>
                </a>
            </div>

            <!-- Page Title & Description -->
            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 font-display">
                    Your Cart
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm text-gray-600">
                    Review your high-performance gear before checkout.
                </p>
            </div>

            <!-- Main Layout: Cart Items List + Order Summary Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" x-data="cartManager()">
                
                <!-- Left Column: Cart Items (8 cols) -->
                <div class="lg:col-span-7 space-y-4">
                    
                    @foreach ($cartItems as $index => $item)
                        <div 
                            id="cart-item-{{ $index }}" 
                            class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col sm:flex-row items-center justify-between gap-4 transition-all duration-300"
                        >
                            <!-- Image + Info Container -->
                            <div class="flex items-center space-x-4 w-full sm:w-auto">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-[#f4f5f7] rounded-xl flex-shrink-0 flex items-center justify-center p-2">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-sm sm:text-base font-bold text-gray-900 tracking-tight">
                                        {{ $item['name'] }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $item['category_label'] }} • {{ $item['color'] }} • Size {{ $item['size'] }}
                                    </p>

                                    <!-- Quantity Selector (Mobile/Desktop) -->
                                    <div class="mt-3 flex items-center space-x-2">
                                        <div class="inline-flex items-center border border-gray-200 rounded-lg bg-gray-50">
                                            <button 
                                                type="button" 
                                                onclick="updateQty({{ $index }}, -1)"
                                                class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-black font-bold text-xs"
                                            >
                                                &minus;
                                            </button>
                                            <span id="qty-val-{{ $index }}" class="w-8 text-center text-xs font-bold text-gray-900">
                                                {{ $item['quantity'] }}
                                            </span>
                                            <button 
                                                type="button" 
                                                onclick="updateQty({{ $index }}, 1)"
                                                class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-black font-bold text-xs"
                                            >
                                                &#43;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Price & Remove Button -->
                            <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-0 border-gray-100">
                                <div class="text-base sm:text-lg font-extrabold text-gray-900">
                                    $<span id="item-price-{{ $index }}">{{ number_format($item['price'], 2) }}</span>
                                </div>

                                <button 
                                    type="button" 
                                    onclick="removeItem({{ $index }})"
                                    class="mt-2 inline-flex items-center text-xs text-gray-400 hover:text-rose-600 transition font-medium"
                                >
                                    <svg class="w-3.5 h-3.5 mr-1 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    <span>Remove</span>
                                </button>
                            </div>

                        </div>
                    @endforeach

                    <!-- Empty state if all items removed -->
                    <div id="cartEmptyState" class="hidden text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-bold text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-xs text-gray-500">Looks like you haven't added any gear yet.</p>
                        <div class="mt-6">
                            <a href="{{ url('/product') }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-black hover:bg-gray-800 rounded-lg shadow-xs transition">
                                Start Shopping
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Order Summary Card (5 cols) -->
                <div class="lg:col-span-5 bg-[#0c101d] text-white p-6 sm:p-7 rounded-2xl shadow-xl space-y-6">
                    <h2 class="text-xl font-bold tracking-tight text-white font-display border-b border-slate-800 pb-4">
                        Order Summary
                    </h2>

                    <div class="space-y-3.5 text-xs text-gray-300">
                        <div class="flex justify-between items-center">
                            <span>Subtotal (<span id="summaryTotalItems">3</span> items)</span>
                            <span class="font-semibold text-white">$<span id="summarySubtotal">315.00</span></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Estimated Shipping</span>
                            <span class="font-semibold text-emerald-400">Free</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Estimated Tax</span>
                            <span class="font-semibold text-white">$<span id="summaryTax">25.20</span></span>
                        </div>
                    </div>

                    <div class="border-t border-slate-800 pt-4 flex justify-between items-baseline">
                        <span class="text-base font-bold text-white">Total</span>
                        <span class="text-2xl font-black text-[#8ee0ec] tracking-tight">
                            $<span id="summaryGrandTotal">340.20</span>
                        </span>
                    </div>

                    <!-- Checkout CTA Button -->
                    <div>
                        <a 
                            href="{{ url('/checkout') }}" 
                            class="w-full py-3.5 bg-[#8ee0ec] hover:bg-[#77d7e4] text-slate-950 font-black uppercase text-xs sm:text-sm rounded-lg tracking-wider transition shadow-[0_4px_16px_rgba(142,224,236,0.3)] flex items-center justify-center space-x-2"
                        >
                            <span>PROCEED TO CHECKOUT</span>
                            <svg class="w-4 h-4 ml-1 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>

                    <p class="text-[11px] text-gray-400 text-center flex items-center justify-center space-x-1">
                        <svg class="w-3.5 h-3.5 text-emerald-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Secure SSL Encrypted Checkout</span>
                    </p>
                </div>

            </div>

        </div>
    </div>

    <!-- Client-side Cart dynamic calculations -->
    <script>
        const cartState = [
            { price: 185.00, qty: 1 },
            { price: 65.00, qty: 2 }
        ];

        function updateQty(index, change) {
            if (!cartState[index]) return;
            cartState[index].qty = Math.max(1, cartState[index].qty + change);
            document.getElementById(`qty-val-${index}`).textContent = cartState[index].qty;
            recalculateTotals();
        }

        function removeItem(index) {
            const el = document.getElementById(`cart-item-${index}`);
            if (el) {
                el.style.opacity = 0;
                setTimeout(() => {
                    el.remove();
                    cartState[index].qty = 0;
                    recalculateTotals();
                }, 300);
            }
        }

        function recalculateTotals() {
            let subtotal = 0;
            let totalItems = 0;
            let activeCount = 0;

            cartState.forEach(item => {
                if (item.qty > 0) {
                    subtotal += item.price * item.qty;
                    totalItems += item.qty;
                    activeCount++;
                }
            });

            if (activeCount === 0) {
                document.getElementById('cartEmptyState').classList.remove('hidden');
            }

            const tax = subtotal * 0.08;
            const grandTotal = subtotal + tax;

            document.getElementById('summaryTotalItems').textContent = totalItems;
            document.getElementById('summarySubtotal').textContent = subtotal.toFixed(2);
            document.getElementById('summaryTax').textContent = tax.toFixed(2);
            document.getElementById('summaryGrandTotal').textContent = grandTotal.toFixed(2);
        }
    </script>
</x-layout>
