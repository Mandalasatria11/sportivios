<x-layouts.admin title="Overview Dashboard">
    <x-slot:pageHeader>
        OVERVIEW DASHBOARD PENJUALAN
    </x-slot:pageHeader>

    <div class="space-y-8">

        <!-- Stat KPI Metric Cards (4 Cards Grid) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- 1. Total Revenue -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Total Pendapatan</span>
                    <span class="p-2 bg-emerald-500/10 text-emerald-400 rounded-lg text-sm">💰</span>
                </div>
                <div>
                    <div class="text-2xl font-black text-white font-sport italic">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <p class="text-[11px] text-emerald-400 mt-1 font-semibold">● Terverifikasi dari database</p>
                </div>
            </div>

            <!-- 2. Total Orders -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Total Pesanan</span>
                    <span class="p-2 bg-cyan-500/10 text-cyan-400 rounded-lg text-sm">📦</span>
                </div>
                <div>
                    <div class="text-2xl font-black text-white font-sport italic">
                        {{ $totalOrders }} <span class="text-xs font-normal text-slate-400">Transaksi</span>
                    </div>
                    <p class="text-[11px] text-cyan-400 mt-1 font-semibold">● {{ $statusCounts['dalam_perjalanan'] ?? 0 }} sedang dalam pengiriman</p>
                </div>
            </div>

            <!-- 3. Total Products -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Total Produk Aktif</span>
                    <span class="p-2 bg-amber-500/10 text-amber-400 rounded-lg text-sm">👟</span>
                </div>
                <div>
                    <div class="text-2xl font-black text-white font-sport italic">
                        {{ $totalProducts }} <span class="text-xs font-normal text-slate-400">SKU</span>
                    </div>
                    <p class="text-[11px] text-amber-400 mt-1 font-semibold">● Siap dipesan di katalog</p>
                </div>
            </div>

            <!-- 4. Total Customers -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Pelanggan Terdaftar</span>
                    <span class="p-2 bg-purple-500/10 text-purple-400 rounded-lg text-sm">👥</span>
                </div>
                <div>
                    <div class="text-2xl font-black text-white font-sport italic">
                        {{ $totalCustomers }} <span class="text-xs font-normal text-slate-400">Member</span>
                    </div>
                    <p class="text-[11px] text-purple-400 mt-1 font-semibold">● Akun atlet Sportivios</p>
                </div>
            </div>
        </div>

        <!-- 2 Columns Grid: Recent Transactions + Low Stock Alert -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left: 5 Recent Transactions (8 cols) -->
            <div class="lg:col-span-8 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-slate-800 mb-4">
                    <div>
                        <h2 class="text-base font-extrabold text-white tracking-wide uppercase font-sport">
                            Transaksi Terbaru Pelanggan
                        </h2>
                        <p class="text-xs text-slate-400">Perbarui status pesanan dan logistik resi dengan cepat</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-cyan-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800">
                                <th class="pb-3 font-bold uppercase tracking-wider">Invoice</th>
                                <th class="pb-3 font-bold uppercase tracking-wider">Pembeli</th>
                                <th class="pb-3 font-bold uppercase tracking-wider">Produk</th>
                                <th class="pb-3 font-bold uppercase tracking-wider">Total</th>
                                <th class="pb-3 font-bold uppercase tracking-wider">Status</th>
                                <th class="pb-3 font-bold uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse ($recentTransactions as $tx)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="py-3.5 font-mono font-bold text-white">
                                        #{{ $tx->invoice_code }}
                                    </td>
                                    <td class="py-3.5 text-slate-200">
                                        {{ $tx->buyer_name }}
                                        <div class="text-[10px] text-slate-500 font-mono">{{ $tx->buyer_phone }}</div>
                                    </td>
                                    <td class="py-3.5 text-slate-300 max-w-[160px] truncate">
                                        {{ $tx->product->name ?? 'Produk' }}
                                    </td>
                                    <td class="py-3.5 font-bold text-cyan-400">
                                        Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3.5">
                                        @php
                                            $st = $tx->status ?? 'diproses';
                                            $badge = match($st) {
                                                'selesai' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                                'dalam_perjalanan' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/30',
                                                'dibatalkan' => 'bg-rose-500/10 text-rose-400 border-rose-500/30',
                                                default => 'bg-amber-500/10 text-amber-400 border-amber-500/30'
                                            };
                                        @endphp
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border {{ $badge }}">
                                            {{ str_replace('_', ' ', $st) }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 text-right">
                                        <a href="{{ route('admin.orders.show', $tx->id) }}" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-white rounded text-[11px] font-bold transition">
                                            Kelola
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-500">
                                        Belum ada transaksi di database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Low Stock Alert (4 cols) -->
            <div class="lg:col-span-4 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h2 class="text-sm font-extrabold text-white tracking-wide uppercase font-sport flex items-center">
                        <span class="mr-2 text-rose-400">⚠️</span>
                        <span>Stok Menipis (Perlu Restock)</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">Produk dengan sisa stok &le; 15 unit</p>
                </div>

                <div class="space-y-3">
                    @forelse($lowStockProducts as $lp)
                        <div class="p-3 bg-slate-950/60 rounded-xl border border-slate-800 flex items-center justify-between">
                            <div class="min-w-0 flex-1 mr-3">
                                <h4 class="text-xs font-bold text-white truncate">{{ $lp->name }}</h4>
                                <span class="text-[10px] text-slate-400 uppercase font-mono">{{ $lp->category }}</span>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-0.5 rounded text-xs font-black {{ $lp->stock <= 10 ? 'bg-rose-500/20 text-rose-400 border border-rose-500/40' : 'bg-amber-500/20 text-amber-400 border border-amber-500/40' }}">
                                    {{ $lp->stock }} pcs
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 text-center py-4">Semua stok produk dalam kondisi aman.</p>
                    @endforelse
                </div>

                <a href="{{ route('admin.products.index') }}" class="block text-center py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl text-xs font-bold transition">
                    Kelola Semua Produk
                </a>

                <!-- Category Breakdown Card -->
                <div class="border-t border-slate-800 pt-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300">
                            Distribusi Kategori
                        </h3>
                        <span class="text-[10px] text-cyan-400 font-mono">3 Kategori FE & BE</span>
                    </div>

                    <div class="grid grid-cols-1 gap-2 text-xs">
                        <a href="{{ route('admin.products.index', ['category' => 'shoes']) }}" class="p-2.5 bg-slate-950/80 rounded-xl border border-slate-800 hover:border-cyan-500/50 flex items-center justify-between transition group">
                            <div class="flex items-center space-x-2">
                                <span>👟</span>
                                <span class="font-bold text-white group-hover:text-cyan-400 transition">Shoes (Sepatu)</span>
                            </div>
                            <span class="px-2 py-0.5 bg-slate-800 text-cyan-300 rounded font-mono font-bold text-[11px]">
                                {{ $categoryCounts['shoes'] ?? 0 }} SKU
                            </span>
                        </a>

                        <a href="{{ route('admin.products.index', ['category' => 'apparel']) }}" class="p-2.5 bg-slate-950/80 rounded-xl border border-slate-800 hover:border-cyan-500/50 flex items-center justify-between transition group">
                            <div class="flex items-center space-x-2">
                                <span>👕</span>
                                <span class="font-bold text-white group-hover:text-cyan-400 transition">Apparel (Pakaian)</span>
                            </div>
                            <span class="px-2 py-0.5 bg-slate-800 text-cyan-300 rounded font-mono font-bold text-[11px]">
                                {{ $categoryCounts['apparel'] ?? 0 }} SKU
                            </span>
                        </a>

                        <a href="{{ route('admin.products.index', ['category' => 'accessories']) }}" class="p-2.5 bg-slate-950/80 rounded-xl border border-slate-800 hover:border-cyan-500/50 flex items-center justify-between transition group">
                            <div class="flex items-center space-x-2">
                                <span>🎒</span>
                                <span class="font-bold text-white group-hover:text-cyan-400 transition">Accessories (Peralatan)</span>
                            </div>
                            <span class="px-2 py-0.5 bg-slate-800 text-cyan-300 rounded font-mono font-bold text-[11px]">
                                {{ $categoryCounts['accessories'] ?? 0 }} SKU
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layouts.admin>
