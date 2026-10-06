<x-layout title="Checkout - SPORTIVIOS">
    <div class="bg-gray-50 min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Back to Cart Link -->
            <div class="mb-4">
                <a href="{{ url('/cart') }}" class="inline-flex items-center text-xs font-bold text-gray-700 hover:text-black transition">
                    <span class="mr-1.5">&larr;</span> Back to Cart
                </a>
            </div>

            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 font-display">
                    Checkout
                </h1>
                <p class="text-xs text-gray-500 mt-1">Complete your order details below.</p>
            </div>

            <form action="{{ route('checkout.success') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Shipping Address & Payment Forms (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- 1. Shipping Details -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs space-y-4">
                        <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3 flex items-center justify-between">
                            <span>1. Shipping Information</span>
                            <span class="text-xs font-normal text-cyan-600">Pro Dispatch Active</span>
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Full Name</label>
                                <input type="text" value="Alex Vance" required class="w-full px-3.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-cyan-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Phone Number</label>
                                <input type="text" value="+62 812-3456-7890" required class="w-full px-3.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-cyan-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Shipping Address</label>
                            <textarea rows="3" required class="w-full px-3.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-cyan-500">Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802, Karet Semanggi, Setiabudi, Jakarta Selatan 12930</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Delivery Notes (Optional)</label>
                            <input type="text" value="Titipkan di lobby reception bila berhalangan" class="w-full px-3.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg focus:bg-white">
                        </div>
                    </div>

                    <!-- 2. Shipping Courier Method -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs space-y-3">
                        <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">
                            2. Delivery Method
                        </h2>
                        
                        <div class="space-y-2.5">
                            <label class="flex items-center justify-between p-3.5 border-2 border-cyan-500 bg-cyan-50/50 rounded-xl cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="shipping_method" checked class="w-4 h-4 text-cyan-600 accent-cyan-600">
                                    <div>
                                        <div class="text-xs font-bold text-gray-900">Sportivios Express Priority (JNE/SiCepat)</div>
                                        <div class="text-[11px] text-gray-500">Est. Arrival: 26 - 28 Oct 2024</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600">FREE</span>
                            </label>
                        </div>
                    </div>

                    <!-- 3. Payment Method -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs space-y-3">
                        <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">
                            3. Payment Method
                        </h2>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <label class="p-3.5 border-2 border-cyan-500 bg-cyan-50/50 rounded-xl cursor-pointer flex items-center space-x-3">
                                <input type="radio" name="payment" checked class="w-4 h-4 accent-cyan-600">
                                <span class="text-xs font-bold text-gray-900">Credit Card / QRIS</span>
                            </label>
                            <label class="p-3.5 border border-gray-200 hover:border-gray-400 bg-white rounded-xl cursor-pointer flex items-center space-x-3">
                                <input type="radio" name="payment" class="w-4 h-4 accent-cyan-600">
                                <span class="text-xs font-bold text-gray-900">Bank Transfer / VA</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Order Review Card (5 cols) -->
                <div class="lg:col-span-5 bg-[#0c101d] text-white p-6 sm:p-7 rounded-2xl shadow-xl space-y-6">
                    <h2 class="text-xl font-bold tracking-tight text-white font-display border-b border-slate-800 pb-4">
                        Review Order
                    </h2>

                    <!-- Items List -->
                    <div class="space-y-3 text-xs border-b border-slate-800 pb-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/products/shoe.jpg') }}" class="w-12 h-12 bg-white/10 rounded-lg object-contain p-1">
                            <div class="flex-1">
                                <div class="font-bold text-white">Aero Velocity Pro x1</div>
                                <div class="text-[11px] text-gray-400">Size 10.5 • Qty 1</div>
                            </div>
                            <div class="font-bold">$185.00</div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/products/tee.jpg') }}" class="w-12 h-12 bg-white/10 rounded-lg object-contain p-1">
                            <div class="flex-1">
                                <div class="font-bold text-white">Core Compression Top</div>
                                <div class="text-[11px] text-gray-400">Size L • Qty 2</div>
                            </div>
                            <div class="font-bold">$130.00</div>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs text-gray-300">
                        <div class="flex justify-between"><span>Subtotal</span><span>$315.00</span></div>
                        <div class="flex justify-between"><span>Shipping</span><span class="text-emerald-400">Free</span></div>
                        <div class="flex justify-between"><span>Tax (8%)</span><span>$25.20</span></div>
                    </div>

                    <div class="border-t border-slate-800 pt-4 flex justify-between items-baseline">
                        <span class="text-base font-bold text-white">Total Amount</span>
                        <span class="text-2xl font-black text-[#8ee0ec]">$340.20</span>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-4 bg-[#8ee0ec] hover:bg-[#74d7e6] text-slate-950 font-black uppercase text-xs sm:text-sm rounded-lg tracking-widest transition shadow-lg flex items-center justify-center space-x-2"
                    >
                        <span>PLACE ORDER NOW &rarr;</span>
                    </button>

                    <p class="text-[11px] text-gray-400 text-center">
                        By placing this order you agree to Sportivios Terms &amp; Conditions.
                    </p>
                </div>

            </form>

        </div>
    </div>
</x-layout>
