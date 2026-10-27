<x-layout title="Daftar Pengiriman Pesanan - SPORTIVIOS">
    <div class="bg-[#f8fafc] min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Sub-Header Breadcrumb -->
            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                <div class="flex items-center space-x-2">
                    <a href="{{ url('/') }}" class="hover:text-black">Akun Saya</a>
                    <span>/</span>
                    <span class="font-semibold text-gray-900">Daftar Pengiriman</span>
                </div>
                <a href="{{ url('/') }}" class="inline-flex items-center text-xs font-bold text-[#0891b2] hover:underline">
                    &larr; Kembali ke Akun Saya
                </a>
            </div>

            <!-- Page Title Header & Top Stat Cards -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-1.5 px-2.5 py-1 bg-slate-900 text-cyan-400 text-[10px] font-extrabold uppercase rounded tracking-wider mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span>LIVE DISPATCH FEED</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-black italic tracking-wide text-gray-900 uppercase font-sport">
                        DAFTAR PENGIRIMAN PESANAN
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1 max-w-2xl">
                        Pantau status distribusi logistik dan rincian resi perlengkapan performa Anda secara real-time.
                    </p>
                </div>

                <!-- Right Stat Boxes -->
                <div class="flex items-center space-x-3 self-start md:self-auto">
                    <div class="bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-xs text-center min-w-[100px]">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">AKTIF DIKIRIM</div>
                        <div class="text-lg font-black text-cyan-700">{{ ($counts['perjalanan'] ?? 0) + ($counts['proses'] ?? 0) }} <span class="text-xs font-normal text-gray-500">Paket</span></div>
                    </div>
                    <div class="bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-xs text-center min-w-[100px]">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">TIBA / SELESAI</div>
                        <div class="text-lg font-black text-gray-900">{{ $counts['terkirim'] ?? 0 }} <span class="text-xs font-normal text-gray-500">Paket</span></div>
                    </div>
                </div>
            </div>

            <!-- Filter Tabs & Search Bar -->
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 mb-6">

                <!-- Filter Pills as Functional Links -->
                @php $currentStatus = request('status'); @endphp
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    <a
                        href="{{ route('orders.index', request()->only('q')) }}"
                        class="px-4 py-2 rounded-xl transition {{ empty($currentStatus) ? 'bg-black text-white font-bold shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-black' }}"
                    >
                        Semua <span class="ml-1 text-[10px] opacity-80">{{ $counts['semua'] ?? 0 }}</span>
                    </a>

                    <a
                        href="{{ route('orders.index', array_merge(request()->only('q'), ['status' => 'perjalanan'])) }}"
                        class="px-4 py-2 rounded-xl transition {{ $currentStatus === 'perjalanan' ? 'bg-cyan-600 text-white font-bold shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-cyan-600' }}"
                    >
                        Dalam Perjalanan <span class="ml-1 text-[10px] px-1.5 py-0.5 rounded-full bg-cyan-100 text-cyan-800">{{ $counts['perjalanan'] ?? 0 }}</span>
                    </a>

                    <a
                        href="{{ route('orders.index', array_merge(request()->only('q'), ['status' => 'proses'])) }}"
                        class="px-4 py-2 rounded-xl transition {{ $currentStatus === 'proses' ? 'bg-amber-600 text-white font-bold shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-amber-600' }}"
                    >
                        Sedang Diproses <span class="ml-1 text-[10px] px-1.5 py-0.5 rounded-full bg-amber-100 text-amber-800">{{ $counts['proses'] ?? 0 }}</span>
                    </a>

                    <a
                        href="{{ route('orders.index', array_merge(request()->only('q'), ['status' => 'terkirim'])) }}"
                        class="px-4 py-2 rounded-xl transition {{ in_array($currentStatus, ['terkirim', 'selesai']) ? 'bg-emerald-600 text-white font-bold shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-emerald-600' }}"
                    >
                        Terkirim <span class="ml-1 text-[10px] px-1.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">{{ $counts['terkirim'] ?? 0 }}</span>
                    </a>

                    <a
                        href="{{ route('orders.index', array_merge(request()->only('q'), ['status' => 'dibatalkan'])) }}"
                        class="px-4 py-2 rounded-xl transition {{ $currentStatus === 'dibatalkan' ? 'bg-gray-800 text-white font-bold' : 'bg-white text-gray-700 border border-gray-200' }}"
                    >
                        Dibatalkan <span class="ml-1 text-[10px] opacity-60">{{ $counts['dibatalkan'] ?? 0 }}</span>
                    </a>
                </div>

                <!-- Search Input Right Form -->
                <form action="{{ route('orders.index') }}" method="GET" class="relative w-full lg:w-72">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari no. resi, invoice, atau produk..."
                        class="w-full pl-9 pr-8 py-2 text-xs bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-cyan-500 shadow-xs"
                    >
                    <button type="submit" class="absolute left-3 top-2.5 text-gray-400 hover:text-black">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    @if(request('q'))
                        <a href="{{ route('orders.index', request()->only('status')) }}" class="absolute right-2.5 top-2 text-xs text-gray-400 hover:text-red-500 font-bold" title="Hapus pencarian">
                            &times;
                        </a>
                    @endif
                </form>

            </div>

            <!-- Orders Cards List -->
            <div class="space-y-6">
                
                @forelse ($orders as $oIndex => $ord)
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-[0_2px_14px_rgba(0,0,0,0.03)] overflow-hidden">
                        
                        <!-- Order Top Header Info Bar -->
                        <div class="bg-gray-50/80 px-5 py-3.5 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="font-extrabold text-gray-900">#{{ $ord['order_no'] }}</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-gray-500">{{ $ord['date'] }}</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center space-x-1">
                                    <span class="text-gray-500">Resi:</span>
                                    <span class="font-mono font-bold text-gray-800">{{ $ord['resi'] }}</span>
                                    <button onclick="navigator.clipboard.writeText('{{ $ord['resi'] }}'); alert('Resi disalin: {{ $ord['resi'] }}')" class="text-gray-400 hover:text-black p-0.5" title="Copy Resi">
                                        📋
                                    </button>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $ord['status_badge'] }}">
                                    ● {{ $ord['status'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content Grid -->
                        <div class="p-5 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                            
                            <!-- Left Product Details (7 cols) -->
                            <div class="lg:col-span-7 flex items-center space-x-4">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-[#f4f5f7] rounded-xl flex-shrink-0 flex items-center justify-center p-2 border border-gray-100">
                                    <img src="{{ $ord['image'] }}" alt="{{ $ord['product_name'] }}" class="w-full h-full object-contain">
                                </div>
                                <div class="space-y-1">
                                    <div class="text-[10px] font-bold text-cyan-700 tracking-wider uppercase">
                                        {{ $ord['product_category'] }}
                                    </div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900 tracking-tight">
                                        {{ $ord['product_name'] }}
                                    </h3>
                                    <div class="text-xs text-gray-500 font-medium">
                                        {{ $ord['variant'] }}
                                    </div>
                                    <div class="text-xs font-bold text-gray-900 pt-1">
                                        Qty: {{ $ord['qty'] }} pcs <span class="text-gray-300 mx-1">•</span> <span class="text-cyan-700">{{ $ord['price'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Logistics & Delivery Progress Box (5 cols) -->
                            <div class="lg:col-span-5 bg-slate-50/70 p-4 rounded-xl border border-gray-200/70 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        {{ $ord['courier'] }}
                                    </span>
                                    <span class="text-[11px] font-semibold text-cyan-800 bg-cyan-100/80 px-2 py-0.5 rounded">
                                        Estimasi: {{ $ord['eta'] }}
                                    </span>
                                </div>
                                
                                <div class="text-[11px] text-gray-600 leading-relaxed border-t border-gray-200/60 pt-2">
                                    <strong class="text-gray-800">Status Terkini:</strong> {{ $ord['status_note'] }}
                                </div>
                            </div>

                        </div>

                        <!-- Card Footer Action Buttons -->
                        <div class="bg-gray-50/50 px-5 py-3 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                            <div class="text-emerald-700 font-medium text-[11px] flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                🛡️ Sportivios Guaranteed Safe Delivery Transit
                            </div>

                            <div class="flex flex-wrap items-center gap-2 self-end sm:self-auto">
                                @if(Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ route('admin.orders.show', $ord['id']) }}" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-cyan-400 font-bold rounded-lg transition text-xs border border-slate-700">
                                        ⚙️ Kelola Admin
                                    </a>
                                @endif

                                @if ($ord['raw_status'] === 'selesai')
                                    <button onclick="alert('Terima kasih atas ulasan bintang 5 Anda!')" class="px-4 py-2 border border-gray-300 hover:border-black text-gray-800 font-bold rounded-lg transition shadow-2xs">
                                        Beri Ulasan
                                    </button>
                                    <a href="{{ route('orders.tracking', $ord['order_no']) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-900 font-bold rounded-lg transition text-xs">
                                        Rincian Pengiriman
                                    </a>
                                @else
                                    <a href="{{ route('orders.tracking', $ord['order_no']) }}" class="px-4 py-2 border border-gray-300 hover:border-black text-gray-800 font-bold rounded-lg transition shadow-2xs">
                                        Detail Pesanan
                                    </a>
                                    <a href="{{ route('orders.tracking', $ord['order_no']) }}" class="px-4 py-2 bg-black hover:bg-gray-800 text-white font-bold rounded-lg transition shadow-xs flex items-center space-x-1">
                                        <span>Lacak Pengiriman</span>
                                        <span>&rarr;</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200 p-8 shadow-xs">
                        <div class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Belum Ada Riwayat Pengiriman</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">
                            Pesanan yang Anda buat akan langsung muncul di sini beserta nomor resi pengiriman real-time.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('katalog') }}" class="inline-flex items-center px-5 py-2.5 bg-black hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition shadow-xs">
                                Mulai Belanja di Katalog
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- Bottom Support & Guarantee Card -->
            <div class="mt-12 bg-[#0c101d] text-white p-6 sm:p-8 rounded-2xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-slate-800">
                <div class="space-y-1 text-center md:text-left">
                    <div class="text-xs font-bold text-cyan-400 uppercase tracking-wider flex items-center justify-center md:justify-start">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        ⓘ BANTUAN DISTRIBUSI &amp; GARANSI
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold tracking-tight">
                        Mengalami Kendala dengan Pengiriman Anda?
                    </h3>
                    <p class="text-xs text-gray-400 max-w-xl">
                        Tim Sportivios Performance Dispatch siap membantu pelacakan kurir prioritas atau penyesuaian alamat sebelum paket keluar hub pusat.
                    </p>
                </div>

                <div class="flex items-center space-x-3 flex-shrink-0">
                    <button onclick="alert('Menghubungkan dengan Tim Ekspedisi...')" class="px-4 py-2.5 bg-[#0891b2] hover:bg-[#06b6d4] text-white font-bold text-xs rounded-xl transition shadow-md">
                        Chat Tim Ekspedisi
                    </button>
                    <button onclick="alert('Pusat Bantuan Sportivios 24/7')" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-gray-200 font-bold text-xs rounded-xl transition border border-slate-700">
                        Pusat Bantuan
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-layout>
