<x-layout title="Status Pengiriman #{{ $order['order_no'] }} - SPORTIVIOS">
    <div class="bg-[#f8fafc] min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Top Header & Navigation -->
            <div class="flex items-center justify-between text-xs text-gray-500 mb-6">
                <a href="{{ url('/orders') }}" class="inline-flex items-center text-xs font-bold text-gray-700 hover:text-black transition group">
                    <span class="mr-1.5 transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Kembali ke Pesanan Saya</span>
                </a>
                <div class="font-bold text-gray-900">
                    Pesanan <span class="text-cyan-700">#{{ $order['order_no'] }}</span>
                </div>
            </div>

            <!-- Top Delivery Status Banner Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-[0_2px_16px_rgba(0,0,0,0.03)] mb-8 space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <!-- Status Badge & Carrier -->
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-[#e0f7fa] text-[#006064] uppercase tracking-wider">
                                ● {{ $order['status'] }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium">
                                {{ $order['courier'] }}
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black italic tracking-wide text-gray-900 uppercase font-sport">
                            STATUS PENGIRIMAN
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                            Estimasi tiba: <strong class="text-gray-900 font-bold">{{ $order['eta'] }}</strong>
                        </p>
                    </div>

                    <!-- Resi Box with Copy Button -->
                    <div class="bg-slate-50 border border-gray-200 p-3.5 rounded-xl flex items-center space-x-3 self-start md:self-auto">
                        <div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">NOMOR RESI</div>
                            <div class="text-sm font-mono font-black text-gray-900">{{ $order['resi'] }}</div>
                        </div>
                        <button 
                            onclick="navigator.clipboard.writeText('{{ $order['resi'] }}'); alert('Resi disalin: {{ $order['resi'] }}')"
                            class="p-2 text-gray-500 hover:text-black hover:bg-white rounded-lg transition border border-gray-200 bg-white"
                            title="Salin No Resi"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Progress Step Bar -->
                <div class="pt-2">
                    <div class="flex justify-between items-center text-xs font-bold text-gray-900 mb-2">
                        <span class="flex items-center text-cyan-800">
                            <svg class="w-4 h-4 mr-1.5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ $order['step_text'] }}
                        </span>
                        <span class="text-gray-400 font-normal">Tahap {{ $order['step_number'] }} dari {{ $order['total_steps'] }}</span>
                    </div>
                    <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-600 to-teal-500 rounded-full transition-all duration-1000" style="width: 75%;"></div>
                    </div>
                </div>
            </div>

            <!-- Main Layout: 2 Columns Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Package Journey Timeline (7 cols) -->
                <div class="lg:col-span-7 bg-white p-6 sm:p-7 rounded-2xl border border-gray-100 shadow-[0_2px_14px_rgba(0,0,0,0.03)] space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <h2 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            PERJALANAN PAKET
                        </h2>
                        <span class="text-[11px] font-mono text-gray-400">WIB (UTC+7)</span>
                    </div>

                    <!-- Vertical Timeline -->
                    <div class="relative pl-6 space-y-8 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200">
                        @foreach ($order['timeline'] as $tIndex => $step)
                            <div class="relative group">
                                <!-- Node Circle -->
                                @if ($step['active'])
                                    <div class="absolute -left-[31px] top-0.5 w-5 h-5 rounded-full bg-cyan-600 border-4 border-cyan-100 shadow-xs flex items-center justify-center">
                                        <div class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></div>
                                    </div>
                                @else
                                    <div class="absolute -left-[30px] top-1 w-4 h-4 rounded-full bg-gray-300 border-2 border-white"></div>
                                @endif

                                <!-- Event Details -->
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xs sm:text-sm font-bold {{ $step['active'] ? 'text-cyan-900' : 'text-gray-800' }}">
                                            {{ $step['title'] }}
                                        </h3>
                                        <span class="text-[11px] font-mono text-gray-400 whitespace-nowrap ml-2">
                                            {{ $step['time'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        {{ $step['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Recipient Address & Product Summary (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- 1. Address Card -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_14px_rgba(0,0,0,0.03)] space-y-3">
                        <h2 class="text-xs font-extrabold text-gray-900 uppercase tracking-wider flex items-center border-b border-gray-100 pb-3">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            ALAMAT PENERIMA
                        </h2>
                        
                        <div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-900">{{ $order['recipient']['name'] }}</span>
                                <span class="text-[11px] text-gray-500 font-mono">{{ $order['recipient']['phone'] }}</span>
                            </div>
                            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">
                                {{ $order['recipient']['address'] }}
                            </p>
                        </div>

                        @if (!empty($order['recipient']['note']))
                            <div class="bg-cyan-50/70 border border-cyan-100 p-2.5 rounded-lg text-[11px] text-cyan-800 flex items-start space-x-1.5">
                                <span class="font-bold">ⓘ</span>
                                <span>Catatan: {{ $order['recipient']['note'] }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- 2. Ordered Item Card -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_14px_rgba(0,0,0,0.03)] space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h2 class="text-xs font-extrabold text-gray-900 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                ITEM PESANAN
                            </h2>
                            <span class="text-[11px] font-semibold text-gray-500">1 Barang</span>
                        </div>

                        <div class="flex items-center space-x-4 bg-gray-50/70 p-3.5 rounded-xl border border-gray-100">
                            <div class="w-16 h-16 bg-white rounded-lg p-1 border border-gray-200 flex-shrink-0 flex items-center justify-center">
                                <img src="{{ $order['item']['image'] }}" alt="{{ $order['item']['name'] }}" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 truncate">
                                    {{ $order['item']['name'] }}
                                </h3>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    {{ $order['item']['variant'] }}
                                </p>
                                <div class="flex justify-between items-center mt-2 text-xs">
                                    <span class="text-gray-500">{{ $order['item']['qty'] }}x</span>
                                    <span class="font-extrabold text-gray-900">{{ $order['item']['price'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Bottom Protection Guarantee & Contact Courier Bar -->
            <div class="mt-8 bg-white p-4 sm:p-5 rounded-2xl border border-gray-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-600 font-medium flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Dilindungi Jaminan Ketepatan Pengiriman Sportivios</span>
                </div>

                <div class="flex items-center space-x-3 w-full sm:w-auto">
                    <button onclick="alert('Menghubungi Kurir Budi Santoso (+62 812-9988-xxxx)...')" class="flex-1 sm:flex-none px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-900 font-bold text-xs rounded-xl transition flex items-center justify-center space-x-1.5">
                        <span>📞 Hubungi Kurir</span>
                    </button>
                    <button onclick="alert('Menghubungkan dengan Bantuan CS...')" class="flex-1 sm:flex-none px-4 py-2.5 bg-black hover:bg-gray-800 text-white font-bold text-xs rounded-xl transition shadow-xs flex items-center justify-center space-x-1.5">
                        <span>💬 Bantuan Layanan (CS)</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-layout>
