<x-layout :title="'Pesanan Berhasil #' . $transaction->invoice_code . ' - SPORTIVIOS'">
    <div class="bg-gray-50 min-h-screen py-8 sm:py-14 print:bg-white print:py-0">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Notification Card Header -->
            <div class="text-center mb-8 print:hidden">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-emerald-100 text-emerald-600 rounded-full mb-4 shadow-sm animate-bounce">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 uppercase font-display tracking-tight">
                    Transaksi Berhasil Dibuat!
                </h1>
                <p class="text-sm text-gray-600 mt-2 max-w-lg mx-auto">
                    Terima kasih telah berbelanja di SPORTIVIOS. Pesanan Anda telah resmi tercatat di database dan sedang disiapkan oleh tim fulfillment kami.
                </p>
            </div>

            <!-- Invoice Document Paper Container -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_10px_35px_rgba(0,0,0,0.05)] overflow-hidden print:shadow-none print:border-none">
                
                <!-- Invoice Header Bar -->
                <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-cyan-900 text-white p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <span class="text-xs uppercase font-bold tracking-widest text-cyan-400 block mb-1">
                            Official Order Invoice
                        </span>
                        <div class="text-xl sm:text-2xl font-black tracking-wider font-mono">
                            {{ $transaction->invoice_code }}
                        </div>
                        <div class="text-xs text-gray-300 mt-1">
                            Waktu Transaksi: {{ $transaction->created_at ? $transaction->created_at->format('d M Y, H:i') . ' WIB' : date('d M Y, H:i') . ' WIB' }}
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                            Tercatat di Database
                        </span>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-8">
                    
                    <!-- Information Grid: Penerima & Kurir -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/70 p-6 rounded-2xl border border-gray-100">
                        
                        <!-- Penerima Info -->
                        <div>
                            <h2 class="text-xs font-bold uppercase tracking-wider text-cyan-800 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                                Data Penerima Paket
                            </h2>
                            <div class="space-y-1.5 text-xs sm:text-sm">
                                <div class="font-bold text-gray-900 text-base">
                                    {{ $transaction->buyer_name }}
                                </div>
                                <div class="text-gray-600 flex items-center">
                                    <span class="font-medium text-gray-500 mr-1.5">No. HP:</span>
                                    <span class="font-mono text-gray-900">{{ $transaction->buyer_phone }}</span>
                                </div>
                                <div class="text-gray-600 pt-1 leading-relaxed">
                                    <span class="font-medium text-gray-500 block">Alamat Tujuan:</span>
                                    <span class="text-gray-800">{{ $transaction->buyer_address }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kurir & Logistik Info -->
                        <div class="md:border-l md:border-gray-200 md:pl-6">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-cyan-800 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75"/>
                                </svg>
                                Layanan Pengiriman
                            </h2>
                            <div class="space-y-2 text-xs sm:text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg font-bold text-gray-900 shadow-2xs">
                                        {{ $transaction->courier }}
                                    </span>
                                    <span class="text-gray-500 text-xs">Layanan Reguler Prioritas</span>
                                </div>
                                <div class="text-gray-600 pt-1">
                                    <span class="font-medium text-gray-500">Biaya Ongkir:</span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-gray-600">
                                    <span class="font-medium text-gray-500">Estimasi Pengantaran:</span>
                                    <span class="text-gray-800">2 - 3 Hari Kerja</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Purchased Product Details Table -->
                    <div>
                        <h2 class="text-xs font-bold uppercase tracking-wider text-gray-900 mb-4">
                            Rincian Barang yang Dipesan
                        </h2>

                        <div class="border border-gray-100 rounded-2xl overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 text-[11px] uppercase font-bold text-gray-500 tracking-wider border-b border-gray-100">
                                        <th class="py-3 px-4">Produk</th>
                                        <th class="py-3 px-4 text-center">Qty</th>
                                        <th class="py-3 px-4 text-right">Harga Satuan</th>
                                        <th class="py-3 px-4 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-xs sm:text-sm">
                                    <tr>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                @php
                                                    $productImage = $transaction->product->image ?? 'images/products/shoe.jpg';
                                                    if (!str_starts_with($productImage, 'http://') && !str_starts_with($productImage, 'https://')) {
                                                        $productImage = str_starts_with($productImage, 'images/') ? asset($productImage) : asset('images/' . $productImage);
                                                    }
                                                @endphp
                                                <div class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center p-1 overflow-hidden">
                                                    <img src="{{ $productImage }}" alt="{{ $transaction->product->name ?? 'Produk' }}" class="w-full h-full object-contain">
                                                </div>
                                                <div>
                                                    <span class="font-bold text-gray-900 block">
                                                        {{ $transaction->product->name ?? 'Produk Sportivios #' . $transaction->product_id }}
                                                    </span>
                                                    <div class="flex items-center gap-2 mt-0.5">
                                                        <span class="text-[11px] text-gray-400">
                                                            ID: #{{ $transaction->product_id }}
                                                        </span>
                                                        @if(!empty($transaction->size))
                                                            <span class="text-[10px] font-semibold bg-gray-100 text-gray-700 px-1.5 py-0.5 rounded border border-gray-200">
                                                                Ukuran: {{ $transaction->size }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center font-bold text-gray-800">
                                            {{ $transaction->quantity }}
                                        </td>
                                        <td class="py-4 px-4 text-right font-medium text-gray-700">
                                            Rp {{ number_format($transaction->product->price ?? (($transaction->total_price - $transaction->shipping_cost) / max(1, $transaction->quantity)), 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-4 text-right font-bold text-gray-900">
                                            Rp {{ number_format(($transaction->product->price ?? (($transaction->total_price - $transaction->shipping_cost) / max(1, $transaction->quantity))) * $transaction->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment Summary Breakdown -->
                    <div class="flex flex-col sm:flex-row justify-end">
                        <div class="w-full sm:w-80 space-y-3 bg-gray-50/60 p-5 rounded-2xl border border-gray-100 text-xs sm:text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal Produk</span>
                                <span class="font-semibold text-gray-900">
                                    Rp {{ number_format($transaction->total_price - $transaction->shipping_cost, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim ({{ $transaction->courier }})</span>
                                <span class="font-semibold text-gray-900">
                                    Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="pt-3 border-t border-dashed border-gray-300 flex justify-between items-baseline">
                                <span class="font-bold text-gray-900 text-sm">Total Pembayaran</span>
                                <span class="font-black text-xl sm:text-2xl text-cyan-700">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer Navigation Buttons (Hidden on Print) -->
                <div class="bg-gray-50 border-t border-gray-100 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-4 print:hidden">
                    <button 
                        type="button" 
                        onclick="window.print()" 
                        class="w-full sm:w-auto px-5 py-3 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold uppercase tracking-wider rounded-xl transition flex items-center justify-center space-x-2 cursor-pointer"
                    >
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24-1.018-.72-1.92-1.44-2.64A7.478 7.478 0 013 6.75C3 3.022 6.022 0 9.75 0c2.34 0 4.41 1.08 5.76 2.76A7.47 7.47 0 0121 6.75c0 1.83-.66 3.51-1.74 4.8-.72.72-1.2 1.62-1.44 2.64m-11.1 0h11.1m-11.1 0v6.429c0 .621.504 1.125 1.125 1.125h8.85c.621 0 1.125-.504 1.125-1.125v-6.429m-11.1 0H3.75a1.5 1.5 0 00-1.5 1.5v3.75a1.5 1.5 0 001.5 1.5h1.5m11.1-6.75h1.5a1.5 1.5 0 011.5 1.5v3.75a1.5 1.5 0 01-1.5 1.5h-1.5"/>
                        </svg>
                        <span>Cetak Invoice</span>
                    </button>

                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <a
                            href="{{ route('orders.tracking', $transaction->invoice_code) }}"
                            class="px-5 py-3 bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-xs font-bold uppercase tracking-wider rounded-xl shadow-xs transition text-center flex items-center justify-center space-x-1.5"
                        >
                            <span>🚚</span>
                            <span>Lacak Status Pesanan</span>
                        </a>

                        <a
                            href="{{ route('katalog') }}"
                            class="px-5 py-3 bg-gray-900 hover:bg-slate-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-xs transition text-center flex items-center justify-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                            <span>Belanja Lagi di Katalog</span>
                        </a>

                        <a 
                            href="{{ url('/') }}" 
                            class="px-5 py-3 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold uppercase tracking-wider rounded-xl transition text-center"
                        >
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>
