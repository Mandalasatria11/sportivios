<x-layout :title="'Checkout Pesanan - ' . $product->name . ' - SPORTIVIOS'">
    <div class="bg-gray-50 min-h-screen py-8 sm:py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center space-x-2 text-xs text-gray-500 mb-6" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-black transition">Home</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ route('katalog') }}" class="hover:text-black transition">Katalog</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ route('products.detail', $product->id) }}" class="hover:text-black transition">{{ $product->name }}</a>
                <span class="text-gray-400">&gt;</span>
                <span class="font-medium text-gray-900">Checkout Transaksi</span>
            </nav>

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-cyan-600 text-white font-bold text-sm">
                        1
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-gray-900 uppercase font-display tracking-tight">
                        Formulir Pembelian Produk
                    </h1>
                </div>
                <p class="text-sm text-gray-600 mt-2 ml-11">
                    Silakan lengkapi data penerima dan pilih kurir pengiriman untuk memproses transaksi pesanan Anda.
                </p>
            </div>

            <!-- Error Summary Alert (jika ada error validasi) -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <span class="font-bold">Terdapat beberapa kesalahan pengisian form:</span>
                            <ul class="list-disc list-inside mt-1 text-xs text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Checkout Form Grid -->
            <form 
                action="{{ url('/checkout/proses') }}" 
                method="POST" 
                id="checkoutForm"
                class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
            >
                <!-- Keamanan CSRF: Wajib menyertakan direktif @csrf untuk mencegah serangan Cross-Site Request Forgery -->
                @csrf

                @php
                    $selectedSize = request('size') ?: old('size', $product->default_size);
                @endphp

                <!-- Hidden Inputs: Product ID & Size -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" value="{{ $selectedSize }}">

                <!-- Left Column (Cols 1-7): Data Pembeli & Kurir -->
                <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-[0_4px_25px_rgba(0,0,0,0.04)] space-y-6">
                    
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-lg font-bold text-gray-900 tracking-tight flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                            Informasi Pengiriman & Penerima
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Pastikan data di bawah terisi dengan benar untuk menghindari kendala pengiriman.
                        </p>
                    </div>

                    <!-- Field: Nama Lengkap -->
                    <div>
                        <label for="buyer_name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                            Nama Lengkap Pembeli <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="buyer_name"
                            name="buyer_name"
                            value="{{ old('buyer_name', Auth::check() ? Auth::user()->name : '') }}"
                            required
                            placeholder="Contoh: Budi Santoso"
                            class="w-full px-4 py-3 rounded-xl border @error('buyer_name') border-red-500 bg-red-50/30 @else border-gray-200 @enderror focus:border-cyan-600 focus:ring-2 focus:ring-cyan-500/20 text-sm text-gray-900 transition outline-none"
                        >
                        @error('buyer_name')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Field: No Telepon / WhatsApp -->
                    <div>
                        <label for="buyer_phone" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                            Nomor Telepon / WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="buyer_phone"
                            name="buyer_phone"
                            value="{{ old('buyer_phone', Auth::check() ? Auth::user()->phone : '') }}"
                            required
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-3 rounded-xl border @error('buyer_phone') border-red-500 bg-red-50/30 @else border-gray-200 @enderror focus:border-cyan-600 focus:ring-2 focus:ring-cyan-500/20 text-sm text-gray-900 transition outline-none"
                        >
                        @error('buyer_phone')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Field: Alamat Lengkap -->
                    <div>
                        <label for="buyer_address" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                            Alamat Lengkap Pengiriman <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="buyer_address"
                            name="buyer_address"
                            rows="3"
                            required
                            placeholder="Masukkan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota, dan kode pos..."
                            class="w-full px-4 py-3 rounded-xl border @error('buyer_address') border-red-500 bg-red-50/30 @else border-gray-200 @enderror focus:border-cyan-600 focus:ring-2 focus:ring-cyan-500/20 text-sm text-gray-900 transition outline-none resize-none"
                        >{{ old('buyer_address', Auth::check() ? Auth::user()->address : '') }}</textarea>
                        @error('buyer_address')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Field: Kurir & Jumlah Beli (2 Cols) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <!-- Dropdown Kurir -->
                        <div>
                            <label for="courier" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                Pilihan Kurir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    id="courier" 
                                    name="courier" 
                                    required 
                                    class="w-full px-4 py-3 pr-10 rounded-xl border @error('courier') border-red-500 bg-red-50/30 @else border-gray-200 @enderror focus:border-cyan-600 focus:ring-2 focus:ring-cyan-500/20 text-sm text-gray-900 transition outline-none appearance-none bg-white cursor-pointer"
                                >
                                    <option value="" disabled {{ old('courier') ? '' : 'selected' }}>Pilih Jasa Ekspedisi</option>
                                    <option value="JNE" data-cost="22000" {{ old('courier') == 'JNE' ? 'selected' : '' }}>JNE Regular (Rp 22.000)</option>
                                    <option value="J&T" data-cost="20000" {{ old('courier') == 'J&T' ? 'selected' : '' }}>J&T Express (Rp 20.000)</option>
                                    <option value="SiCepat" data-cost="19000" {{ old('courier') == 'SiCepat' ? 'selected' : '' }}>SiCepat HALU (Rp 19.000)</option>
                                    <option value="Pos Indonesia" data-cost="18000" {{ old('courier') == 'Pos Indonesia' ? 'selected' : '' }}>Pos Kilat Khusus (Rp 18.000)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('courier')
                                <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <!-- Input Quantity -->
                        <div>
                            <label for="quantity" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                Jumlah Beli (Qty) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center">
                                <button 
                                    type="button" 
                                    id="btnQtyMinus" 
                                    class="w-11 h-11 border border-gray-200 rounded-l-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold text-lg flex items-center justify-center transition active:bg-gray-200"
                                >
                                    -
                                </button>
                                <input 
                                    type="number" 
                                    id="quantity" 
                                    name="quantity" 
                                    min="1" 
                                    value="{{ old('quantity', 1) }}" 
                                    required 
                                    class="w-full text-center py-3 border-y border-gray-200 text-sm font-bold text-gray-900 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                >
                                <button 
                                    type="button" 
                                    id="btnQtyPlus" 
                                    class="w-11 h-11 border border-gray-200 rounded-r-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold text-lg flex items-center justify-center transition active:bg-gray-200"
                                >
                                    +
                                </button>
                            </div>
                            @error('quantity')
                                <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Security Badge Note -->
                    <div class="mt-6 p-3.5 bg-cyan-50/50 rounded-2xl border border-cyan-100 flex items-center space-x-3">
                        <svg class="w-5 h-5 text-cyan-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs text-cyan-900 leading-relaxed">
                            <span class="font-bold">Transaksi Aman:</span> Dilindungi oleh CSRF Token Laravel & sistem verifikasi integritas harga dari database.
                        </p>
                    </div>

                </div>

                <!-- Right Column (Cols 8-12): Ringkasan Produk & Kalkulasi Pembayaran -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-[0_4px_25px_rgba(0,0,0,0.04)] sticky top-24">
                        
                        <h2 class="text-lg font-bold text-gray-900 tracking-tight pb-4 border-b border-gray-100">
                            Ringkasan Pesanan
                        </h2>

                        <!-- Product Mini Card -->
                        <div class="flex items-center space-x-4 py-4 border-b border-gray-100">
                            @php
                                $imgSrc = $product->image;
                                if (!str_starts_with($imgSrc, 'http://') && !str_starts_with($imgSrc, 'https://')) {
                                    $imgSrc = str_starts_with($imgSrc, 'images/') ? asset($imgSrc) : asset('images/' . $imgSrc);
                                }
                            @endphp
                            <div class="w-20 h-20 bg-gray-50 rounded-2xl border border-gray-100 flex-shrink-0 flex items-center justify-center p-2 overflow-hidden">
                                <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap mb-1">
                                    <span class="text-[9px] uppercase font-bold text-cyan-700 bg-cyan-50 px-2 py-0.5 rounded border border-cyan-200 tracking-wider">
                                        {{ $product->category_label }}
                                    </span>
                                    <span class="text-[9px] font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                        Ukuran: {{ $selectedSize }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 truncate">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    Harga Satuan: <span class="font-semibold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Calculation Breakdown -->
                        <div class="py-4 space-y-3 text-xs sm:text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal Produk (<span id="summaryQty">1</span> item)</span>
                                <span class="font-semibold text-gray-900" id="summarySubtotal">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim (<span id="summaryCourierName">Pilih Kurir</span>)</span>
                                <span class="font-semibold text-gray-900" id="summaryShipping">
                                    Rp 0
                                </span>
                            </div>

                            <div class="pt-3 border-t border-dashed border-gray-200 flex justify-between items-baseline">
                                <span class="text-sm font-bold text-gray-900">Total Pembayaran</span>
                                <span class="text-xl sm:text-2xl font-black text-cyan-700" id="summaryGrandTotal">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button 
                                type="submit" 
                                id="btnSubmitOrder"
                                class="w-full py-4 px-6 bg-gray-900 hover:bg-cyan-600 active:bg-cyan-700 text-white font-bold uppercase tracking-wider text-xs sm:text-sm rounded-xl shadow-lg transition-all duration-200 flex items-center justify-center space-x-2 cursor-pointer"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                                </svg>
                                <span>Konfirmasi & Buat Pesanan</span>
                            </button>

                            <a 
                                href="{{ route('products.detail', $product->id) }}" 
                                class="w-full mt-3 py-3 text-center text-xs font-semibold text-gray-500 hover:text-gray-900 block transition"
                            >
                                &larr; Batalkan dan kembali ke detail produk
                            </a>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- Client-side Realtime Calculation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const unitPrice = {{ (float) $product->price }};
            const qtyInput = document.getElementById('quantity');
            const btnMinus = document.getElementById('btnQtyMinus');
            const btnPlus = document.getElementById('btnQtyPlus');
            const courierSelect = document.getElementById('courier');

            const summaryQty = document.getElementById('summaryQty');
            const summarySubtotal = document.getElementById('summarySubtotal');
            const summaryCourierName = document.getElementById('summaryCourierName');
            const summaryShipping = document.getElementById('summaryShipping');
            const summaryGrandTotal = document.getElementById('summaryGrandTotal');

            const courierRates = {
                'JNE': 22000,
                'J&T': 20000,
                'SiCepat': 19000,
                'Pos Indonesia': 18000
            };

            function formatRupiah(amount) {
                return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
            }

            function recalculate() {
                let qty = parseInt(qtyInput.value) || 1;
                if (qty < 1) {
                    qty = 1;
                    qtyInput.value = 1;
                }

                const selectedCourier = courierSelect.value;
                const shippingCost = courierRates[selectedCourier] || 0;
                const subtotal = unitPrice * qty;
                const grandTotal = subtotal + shippingCost;

                summaryQty.textContent = qty;
                summarySubtotal.textContent = formatRupiah(subtotal);
                summaryCourierName.textContent = selectedCourier ? selectedCourier : 'Pilih Kurir';
                summaryShipping.textContent = formatRupiah(shippingCost);
                summaryGrandTotal.textContent = formatRupiah(grandTotal);
            }

            btnMinus.addEventListener('click', function () {
                let current = parseInt(qtyInput.value) || 1;
                if (current > 1) {
                    qtyInput.value = current - 1;
                    recalculate();
                }
            });

            btnPlus.addEventListener('click', function () {
                let current = parseInt(qtyInput.value) || 1;
                qtyInput.value = current + 1;
                recalculate();
            });

            qtyInput.addEventListener('input', recalculate);
            courierSelect.addEventListener('change', recalculate);

            // Inisialisasi awal
            recalculate();
        });
    </script>
</x-layout>
