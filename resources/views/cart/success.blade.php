<x-layout title="Pembayaran Berhasil - SPORTIVIOS">
    <div class="bg-[#f8fafc] min-h-screen py-10 sm:py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            
            <!-- Main Success Card -->
            <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-10 border border-gray-100 text-center relative overflow-hidden">
                
                <!-- Circular Checkmark Icon (Matching Cyan Circle in Screenshot) -->
                <div class="w-16 h-16 mx-auto rounded-full bg-[#8ee0ec]/30 text-[#0891b2] flex items-center justify-center mb-4 ring-8 ring-[#8ee0ec]/15">
                    <svg class="w-8 h-8 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>

                <!-- Status Badge -->
                <div class="mb-3">
                    <span class="inline-block bg-[#cffafe] text-[#0e7490] text-[11px] font-black tracking-widest px-4 py-1 rounded-full uppercase shadow-2xs">
                        PEMBAYARAN BERHASIL
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-2xl sm:text-3xl font-black italic tracking-wide text-gray-900 uppercase font-sport">
                    PEMBAYARAN BERHASIL!
                </h1>

                <!-- Subtitle -->
                <p class="text-xs sm:text-sm text-gray-500 mt-2 max-w-md mx-auto leading-relaxed">
                    Terima kasih. Pesanan Anda telah dikonfirmasi dan sedang diproses oleh Sportivios Fulfillment.
                </p>

                <!-- 3 Columns Order Info Box -->
                <div class="bg-[#f8fafc] border border-gray-200/80 rounded-2xl p-4 sm:p-5 mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3 text-left">
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">NO. PESANAN</span>
                        <span class="text-xs sm:text-sm font-extrabold text-gray-900 mt-0.5 block">{{ $order['order_no'] ?? '#SP-894210' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">WAKTU TRANSAKSI</span>
                        <span class="text-xs sm:text-sm font-extrabold text-gray-900 mt-0.5 block">{{ $order['transaction_time'] ?? '24 Okt 2024, 14:32' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">METODE PEMBAYARAN</span>
                        <span class="text-xs sm:text-sm font-extrabold text-gray-900 mt-0.5 block">{{ $order['payment_method'] ?? 'QRIS Instant' }}</span>
                    </div>
                </div>

                <!-- Ringkasan Pesanan Section -->
                <div class="mt-8 text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                        <h2 class="text-sm font-extrabold text-gray-900">Ringkasan Pesanan</h2>
                        <span class="text-xs text-gray-500 font-medium">1 Produk</span>
                    </div>

                    <!-- Single Product Item Matching Screenshot -->
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center space-x-3.5">
                            <div class="w-14 h-14 bg-gray-50 rounded-xl border border-gray-100 p-1 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                <img 
                                    src="{{ $order['image'] ?? asset('images/products/shoe.jpg') }}" 
                                    alt="{{ $order['product_name'] ?? 'AeroSprint Pro Elite Runners' }}" 
                                    class="w-full h-full object-contain"
                                >
                            </div>
                            <div>
                                <h3 class="text-xs sm:text-sm font-extrabold text-gray-900">
                                    {{ $order['product_name'] ?? 'AeroSprint Pro Elite Runners' }}
                                </h3>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    {{ $order['product_variant'] ?? 'EU 42 • Obsidian Black / Cyan • Qty: 1' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-xs sm:text-sm font-extrabold text-gray-900">
                            {{ $order['product_price'] ?? 'Rp 2.100.000' }}
                        </div>
                    </div>

                    <!-- Total Row -->
                    <div class="border-t border-gray-100 pt-3 flex items-center justify-between">
                        <span class="text-xs sm:text-sm font-medium text-gray-600">Total Pembayaran</span>
                        <span class="text-base sm:text-lg font-black text-gray-900">
                            {{ $order['total_payment'] ?? 'Rp 2.100.000' }}
                        </span>
                    </div>

                    <!-- Email & Delivery Notice Box -->
                    <div class="bg-[#f0fdfa] border border-[#ccfbf1] text-[#0f766e] rounded-xl p-3.5 flex items-start space-x-3 text-xs">
                        <svg class="w-4 h-4 text-[#0d9488] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span>
                            Bukti pembayaran dan estimasi tiba <strong>{{ $order['eta'] ?? '26 - 28 Okt 2024' }}</strong> dikirim ke <strong>{{ $order['notification_email'] ?? 'alex.vance@example.com' }}</strong>.
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3">
                        <a 
                            href="{{ url('/orders/' . ($order['order_code'] ?? 'SPV-894210')) }}" 
                            class="py-3 px-4 bg-[#0F172A] hover:bg-slate-800 text-white font-black text-xs uppercase tracking-wider rounded-xl transition shadow-md flex items-center justify-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.635v6.635" />
                            </svg>
                            <span>LACAK PENGIRIMAN</span>
                        </a>

                        <a 
                            href="{{ url('/') }}" 
                            class="py-3 px-4 bg-[#e2e8f0] hover:bg-[#cbd5e1] text-gray-800 font-black text-xs uppercase tracking-wider rounded-xl transition flex items-center justify-center space-x-2"
                        >
                            <span>&larr; KEMBALI KE BERANDA</span>
                        </a>
                    </div>

                    <!-- Footer Action Links -->
                    <div class="pt-3 flex items-center justify-center space-x-4 text-xs font-semibold text-gray-500">
                        <button onclick="alert('Dummy notice: Mengunduh Invoice resmi SPV-894210.pdf...')" class="hover:text-black flex items-center space-x-1">
                            <span>📥</span>
                            <span>Unduh Invoice</span>
                        </button>
                        <span class="text-gray-300">•</span>
                        <a href="https://wa.me/" target="_blank" class="hover:text-black">
                            Bantuan Pesanan
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layout>
