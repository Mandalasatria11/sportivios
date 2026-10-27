<x-layouts.admin title="Kelola Pesanan & Resi">
    <x-slot:pageHeader>
        MANAJEMEN PESANAN &amp; LOGISTIK RESI
    </x-slot:pageHeader>

    <div class="space-y-6">

        <!-- Filter Status & Search Bar -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <!-- Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 text-xs">
                @php
                    $curStatus = request('status');
                @endphp
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="px-3.5 py-2 rounded-xl transition font-bold {{ empty($curStatus) ? 'bg-cyan-500 text-slate-950' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}"
                >
                    Semua Status
                </a>
                <a
                    href="{{ route('admin.orders.index', ['status' => 'diproses']) }}"
                    class="px-3.5 py-2 rounded-xl transition font-bold {{ $curStatus === 'diproses' ? 'bg-amber-500 text-slate-950' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}"
                >
                    Diproses
                </a>
                <a
                    href="{{ route('admin.orders.index', ['status' => 'dalam_perjalanan']) }}"
                    class="px-3.5 py-2 rounded-xl transition font-bold {{ $curStatus === 'dalam_perjalanan' ? 'bg-cyan-500 text-slate-950' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}"
                >
                    Dalam Perjalanan
                </a>
                <a
                    href="{{ route('admin.orders.index', ['status' => 'selesai']) }}"
                    class="px-3.5 py-2 rounded-xl transition font-bold {{ $curStatus === 'selesai' ? 'bg-emerald-500 text-slate-950' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}"
                >
                    Selesai
                </a>
                <a
                    href="{{ route('admin.orders.index', ['status' => 'dibatalkan']) }}"
                    class="px-3.5 py-2 rounded-xl transition font-bold {{ $curStatus === 'dibatalkan' ? 'bg-rose-500 text-slate-950' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}"
                >
                    Dibatalkan
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex items-center space-x-2">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari invoice, resi, pembeli..."
                    class="px-3.5 py-2 bg-slate-900 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 w-64"
                >
                <button type="submit" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-xs font-bold transition">
                    Cari
                </button>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-950/60 text-slate-400 border-b border-slate-800">
                            <th class="py-3.5 px-5 font-bold uppercase tracking-wider">Invoice & Waktu</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Data Pembeli</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Item Produk</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Kurir & Resi</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Total</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Status</th>
                            <th class="py-3.5 px-5 font-bold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-slate-800/40 transition">
                                <!-- Invoice & Date -->
                                <td class="py-3.5 px-5">
                                    <div class="font-mono font-bold text-white text-xs sm:text-sm">
                                        #{{ $order->invoice_code }}
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">
                                        {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}
                                    </div>
                                </td>

                                <!-- Buyer -->
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-200">{{ $order->buyer_name }}</div>
                                    <div class="text-[11px] text-slate-400 font-mono">{{ $order->buyer_phone }}</div>
                                    @if($order->user)
                                        <span class="inline-block mt-0.5 px-1.5 py-0.2 rounded text-[9px] bg-slate-800 text-cyan-400 font-mono">Member: {{ $order->user->email }}</span>
                                    @else
                                        <span class="inline-block mt-0.5 px-1.5 py-0.2 rounded text-[9px] bg-slate-800 text-slate-400">Guest Checkout</span>
                                    @endif
                                </td>

                                <!-- Product Item -->
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-white max-w-[170px] truncate">
                                        {{ $order->product->name ?? 'Produk' }}
                                    </div>
                                    <div class="text-[11px] text-slate-400">
                                        Qty: {{ $order->quantity }} pcs
                                        @if(!empty($order->size))
                                            • <span class="text-cyan-400 font-mono">Ukuran: {{ $order->size }}</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Courier & Resi -->
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-300">{{ $order->courier ?? 'JNE' }}</div>
                                    @if(!empty($order->resi))
                                        <div class="font-mono text-cyan-400 text-[11px] font-bold">
                                            {{ $order->resi }}
                                        </div>
                                    @else
                                        <div class="text-slate-500 italic text-[11px]">Belum diinput</div>
                                    @endif
                                </td>

                                <!-- Total Price -->
                                <td class="py-3.5 px-4 font-black text-cyan-400">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-4">
                                    @php
                                        $st = $order->status ?? 'diproses';
                                        $badge = match($st) {
                                            'selesai' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                            'dalam_perjalanan' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/30',
                                            'dibatalkan' => 'bg-rose-500/10 text-rose-400 border-rose-500/30',
                                            default => 'bg-amber-500/10 text-amber-400 border-amber-500/30'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded text-[10px] font-bold uppercase tracking-wider border {{ $badge }}">
                                        {{ str_replace('_', ' ', $st) }}
                                    </span>
                                </td>

                                <!-- Action -->
                                <td class="py-3.5 px-5 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a
                                            href="{{ route('tracking', $order->invoice_code) }}"
                                            target="_blank"
                                            class="p-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg transition"
                                            title="Lacak di Halaman Publik"
                                        >
                                            🚚
                                        </a>
                                        <a
                                            href="{{ route('admin.orders.show', $order->id) }}"
                                            class="px-3 py-1.5 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold rounded-lg text-xs transition"
                                        >
                                            Kelola Resi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-500">
                                    Belum ada pesanan yang sesuai dengan filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layouts.admin>
