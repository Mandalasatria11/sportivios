<x-layout title="Keranjang Belanja - SPORTIVIOS">
    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">

            <!-- Back to Shop Link -->
            <div class="mb-4">
                <a href="{{ url('/product') }}" class="inline-flex items-center text-xs font-bold text-cyan-700 hover:text-black transition group">
                    <span class="mr-1.5 transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Kembali Belanja</span>
                </a>
            </div>

            <!-- Page Title & Description & Flash message -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 font-display">
                        Keranjang Belanja
                    </h1>
                    <p class="mt-1.5 text-xs sm:text-sm text-gray-600">
                        Periksa kembali perlengkapan performa tinggi pilihan Anda sebelum checkout.
                    </p>
                </div>
                @if(count($cartItems) > 0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Kosongkan semua item di keranjang?')" class="text-xs font-semibold text-rose-600 hover:text-rose-800 underline">
                            Kosongkan Keranjang
                        </button>
                    </form>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center space-x-2">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Main Layout: Cart Items List + Order Summary Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left Column: Cart Items (7 cols) -->
                <div class="lg:col-span-7 space-y-4">

                    @forelse ($cartItems as $key => $item)
                        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col sm:flex-row items-center justify-between gap-4 transition-all duration-200">
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
                                        {{ $item['category_label'] ?? 'Sportivios' }}
                                        @if(!empty($item['size']))
                                            • <span class="font-semibold text-gray-700">{{ strtolower($item['size']) === 'all size' ? 'Universal (All Size)' : 'Ukuran ' . $item['size'] }}</span>
                                        @endif
                                    </p>

                                    <!-- Quantity Selector Form -->
                                    <div class="mt-3 flex items-center space-x-3">
                                        <div class="inline-flex items-center border border-gray-200 rounded-lg bg-gray-50">
                                            <form action="{{ route('cart.update', $key) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="decrease">
                                                <button
                                                    type="submit"
                                                    class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-black font-bold text-xs"
                                                >
                                                    &minus;
                                                </button>
                                            </form>

                                            <span class="w-8 text-center text-xs font-bold text-gray-900">
                                                {{ $item['quantity'] }}
                                            </span>

                                            <form action="{{ route('cart.update', $key) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="increase">
                                                <button
                                                    type="submit"
                                                    class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-black font-bold text-xs"
                                                >
                                                    &#43;
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Price & Remove Button -->
                            <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-0 border-gray-100">
                                <div class="text-sm sm:text-base font-extrabold text-gray-900">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </div>

                                <form action="{{ route('cart.remove', $key) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="mt-2 inline-flex items-center text-xs text-gray-400 hover:text-rose-600 transition font-medium"
                                    >
                                        <svg class="w-3.5 h-3.5 mr-1 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-bold text-gray-900">Keranjang Belanja Anda Kosong</h3>
                            <p class="mt-1 text-xs text-gray-500">Anda belum memilih perlengkapan olahraga untuk dimasukkan.</p>
                            <div class="mt-6">
                                <a href="{{ route('katalog') }}" class="inline-flex items-center px-4 py-2.5 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-xs transition">
                                    Jelajahi Katalog
                                </a>
                            </div>
                        </div>
                    @endforelse

                </div>

                <!-- Right Column: Order Summary Card (5 cols) -->
                <div class="lg:col-span-5 bg-[#0c101d] text-white p-6 sm:p-7 rounded-2xl shadow-xl space-y-6">
                    <h2 class="text-xl font-bold tracking-tight text-white font-display border-b border-slate-800 pb-4">
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-3.5 text-xs text-gray-300">
                        <div class="flex justify-between items-center">
                            <span>Subtotal ({{ $totalItems ?? 0 }} item)</span>
                            <span class="font-semibold text-white">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Estimasi Ongkir</span>
                            <span class="font-semibold text-emerald-400">Gratis Ongkir</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Biaya Layanan & Pajak</span>
                            <span class="font-semibold text-white">Rp 0 (Termasuk)</span>
                        </div>
                    </div>

                    <div class="border-t border-slate-800 pt-4 flex justify-between items-baseline">
                        <span class="text-base font-bold text-white">Total Pembayaran</span>
                        <span class="text-2xl font-black text-[#8ee0ec] tracking-tight">
                            Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Checkout CTA Button -->
                    <div>
                        @if(count($cartItems) > 0)
                            @php
                                $firstItem = reset($cartItems);
                                $checkoutParams = ['id' => $firstItem['product_id'] ?? 1];
                                if (!empty($firstItem['size'])) {
                                    $checkoutParams['size'] = $firstItem['size'];
                                }
                                $checkoutUrl = route('checkout', $checkoutParams);
                            @endphp
                            <a
                                href="{{ $checkoutUrl }}"
                                class="w-full py-3.5 bg-[#8ee0ec] hover:bg-[#77d7e4] text-slate-950 font-black uppercase text-xs sm:text-sm rounded-lg tracking-wider transition shadow-[0_4px_16px_rgba(142,224,236,0.3)] flex items-center justify-center space-x-2"
                            >
                                <span>LANJUT KE CHECKOUT</span>
                                <svg class="w-4 h-4 ml-1 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        @else
                            <button
                                disabled
                                class="w-full py-3.5 bg-slate-800 text-gray-500 font-bold uppercase text-xs sm:text-sm rounded-lg tracking-wider cursor-not-allowed"
                            >
                                KERANJANG KOSONG
                            </button>
                        @endif
                    </div>

                    <p class="text-[11px] text-gray-400 text-center flex items-center justify-center space-x-1">
                        <svg class="w-3.5 h-3.5 text-emerald-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Transaksi Terenkripsi Aman & Bebas Cemas</span>
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-layout>
