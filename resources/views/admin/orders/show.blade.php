<x-layouts.admin title="Kelola Pesanan #{{ $order->invoice_code }}">
    <x-slot:pageHeader>
        DETAIL PESANAN: #{{ $order->invoice_code }}
    </x-slot:pageHeader>

    <div class="max-w-5xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white flex items-center space-x-1">
                <span>&larr;</span>
                <span>Kembali ke Daftar Pesanan</span>
            </a>
            <a
                href="{{ route('tracking', $order->invoice_code) }}"
                target="_blank"
                class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-cyan-400 rounded-lg text-xs font-bold transition flex items-center space-x-1"
            >
                <span>Lihat Pelacakan Publik ↗</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Left: Order Summary & Customer Info (7 cols) -->
            <div class="lg:col-span-7 space-y-6">

                <!-- 1. Product Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-800 pb-3">
                        Produk yang Dipesan
                    </h3>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-slate-800 rounded-xl p-1 flex-shrink-0 flex items-center justify-center border border-slate-700">
                            <img src="{{ asset($order->product->image ?? 'images/products/shoe.jpg') }}" alt="{{ $order->product->name ?? 'Produk' }}" class="w-full h-full object-contain">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-white truncate">
                                {{ $order->product->name ?? 'Sportivios Product' }}
                            </h4>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Kategori: {{ ucfirst($order->product->category ?? 'Footwear') }} • Jumlah: {{ $order->quantity }} pcs
                                @if(!empty($order->size))
                                    • <span class="text-cyan-400 font-bold">Ukuran: {{ $order->size }}</span>
                                @endif
                            </p>
                            <div class="text-xs font-mono text-cyan-400 mt-1">
                                Rp {{ number_format($order->product->price ?? 0, 0, ',', '.') }} / unit
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Customer & Shipping Info Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-800 pb-3">
                        Informasi Penerima &amp; Alamat Kirim
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-500 block uppercase text-[10px] font-bold">Nama Pembeli</span>
                            <span class="text-white font-bold text-sm">{{ $order->buyer_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block uppercase text-[10px] font-bold">Nomor WhatsApp / Telp</span>
                            <span class="text-white font-mono font-bold">{{ $order->buyer_phone }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-slate-500 block uppercase text-[10px] font-bold">Alamat Lengkap</span>
                            <p class="text-slate-200 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-800">
                                {{ $order->buyer_address }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 3. Financial Breakdown -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xs space-y-3 text-xs">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-800 pb-3">
                        Rincian Pembayaran
                    </h3>
                    <div class="flex justify-between text-slate-400">
                        <span>Harga Produk ({{ $order->quantity }} item)</span>
                        <span class="text-white font-mono">Rp {{ number_format(($order->total_price - ($order->shipping_cost ?? 20000)), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-400">
                        <span>Ongkos Kirim ({{ $order->courier ?? 'JNE' }})</span>
                        <span class="text-white font-mono">Rp {{ number_format($order->shipping_cost ?? 20000, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-slate-800 pt-3 flex justify-between items-baseline font-bold">
                        <span class="text-white text-sm">Total Bayar</span>
                        <span class="text-cyan-400 text-lg font-black font-sport italic">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

            </div>

            <!-- Right: Status & Resi Logistics Management Form (5 cols) -->
            <div class="lg:col-span-5 bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-7 shadow-xs space-y-5">
                <div class="border-b border-slate-800 pb-3">
                    <h2 class="text-sm font-extrabold text-white tracking-wide uppercase font-sport flex items-center">
                        <span class="text-cyan-400 mr-2">📦</span>
                        <span>Update Status &amp; Resi Pengiriman</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Perubahan ini langsung memutakhirkan timeline pelacakan pembeli.
                    </p>
                </div>

                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Status Pesanan Saat Ini
                        </label>
                        <select
                            name="status"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500 font-semibold"
                        >
                            <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>
                                🟡 Sedang Diproses (Packaging / Quality Control)
                            </option>
                            <option value="dalam_perjalanan" {{ $order->status === 'dalam_perjalanan' ? 'selected' : '' }}>
                                🔵 Dalam Perjalanan (Diserahkan ke Kurir Logistik)
                            </option>
                            <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>
                                🟢 Selesai / Terkirim (Diterima Pembeli)
                            </option>
                            <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>
                                🔴 Dibatalkan
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Nomor Resi Logistik (Airwaybill)
                        </label>
                        <input
                            type="text"
                            name="resi"
                            value="{{ old('resi', $order->resi) }}"
                            placeholder="Contoh: SPV-JNE-882049182"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 font-mono focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                        <p class="text-[11px] text-slate-500 mt-1.5">
                            Jika status diubah ke "Dalam Perjalanan" dan resi kosong, nomor resi resmi Sportivios akan digenerate otomatis.
                        </p>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-black text-xs uppercase tracking-wider rounded-xl transition shadow-md flex items-center justify-center space-x-2"
                        >
                            <span>Simpan Status &amp; Resi</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </form>

                <div class="p-3.5 bg-slate-950 rounded-xl border border-slate-800 text-xs space-y-1 text-slate-400">
                    <span class="font-bold text-white block">Catatan Logistik:</span>
                    <p>• Kurir terpilih: <strong class="text-cyan-400">{{ $order->courier ?? 'JNE' }} Express</strong></p>
                    <p>• Dibuat pada: {{ $order->created_at ? $order->created_at->format('d M Y, H:i:s') : '-' }}</p>
                    <p>• Terakhir diperbarui: {{ $order->updated_at ? $order->updated_at->format('d M Y, H:i:s') : '-' }}</p>
                </div>
            </div>

        </div>

        <!-- Checkpoints & Journey Tracking Management Section (Admin Control) -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-4">
                <div>
                    <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 bg-cyan-950 text-cyan-400 text-[10px] font-bold rounded uppercase tracking-wider mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span>LIVE TIMELINE LOGISTICS</span>
                    </div>
                    <h2 class="text-lg font-black text-white uppercase tracking-wide font-sport flex items-center">
                        <span>Kelola Perjalanan Paket (Tracking Checkpoints)</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Tahapan di bawah ini ditampilkan secara langsung kepada pembeli di halaman <strong>/orders/{{ $order->invoice_code }}</strong>. Anda dapat menambah tahapan kustom secara leluasa.
                    </p>
                </div>

                <div class="flex items-center space-x-2">
                    <form action="{{ route('admin.orders.checkpoint.reset', $order->id) }}" method="POST" onsubmit="return confirm('Reset timeline ke tahapan otomatis berdasarkan status pesanan saat ini?')">
                        @csrf
                        <button
                            type="submit"
                            class="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl text-xs font-bold transition border border-slate-700 flex items-center space-x-1.5"
                            title="Reset timeline ke format kalkulasi otomatis"
                        >
                            <span>↺ Reset ke Otomatis</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left: List of Active Checkpoints (7 cols) -->
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                        <span>Daftar Riwayat Perjalanan Paket ({{ count($timeline) }} Checkpoint)</span>
                        <span class="text-[10px] text-cyan-400 font-mono">Urutan: Terbaru di Atas</span>
                    </h3>

                    @if(empty($timeline))
                        <div class="p-8 bg-slate-950 rounded-xl border border-dashed border-slate-800 text-center text-xs text-slate-500">
                            Belum ada tahapan checkpoint untuk pesanan ini.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($timeline as $cIndex => $cp)
                                <div class="p-4 bg-slate-950 border {{ !empty($cp['active']) ? 'border-cyan-500/50 bg-cyan-950/10' : 'border-slate-800' }} rounded-xl flex items-start justify-between gap-4 transition hover:border-slate-700">
                                    <div class="flex items-start space-x-3 min-w-0">
                                        <div class="mt-1 flex-shrink-0">
                                            @if(!empty($cp['active']))
                                                <span class="w-3 h-3 rounded-full bg-cyan-400 inline-block shadow-sm shadow-cyan-500/50 animate-pulse"></span>
                                            @else
                                                <span class="w-3 h-3 rounded-full bg-slate-700 inline-block"></span>
                                            @endif
                                        </div>
                                        <div class="space-y-1 min-w-0">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xs sm:text-sm font-bold text-white">
                                                    {{ $cp['title'] }}
                                                </h4>
                                                @if(!empty($cp['active']))
                                                    <span class="px-2 py-0.5 bg-cyan-500/20 text-cyan-400 text-[10px] font-extrabold rounded uppercase tracking-wider border border-cyan-500/30">
                                                        Posisi Terkini
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] text-slate-400 font-mono">
                                                <span>🕒 {{ $cp['time'] }}</span>
                                                @if(!empty($cp['location']))
                                                    <span class="text-slate-600">•</span>
                                                    <span class="text-slate-300">📍 {{ $cp['location'] }}</span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-slate-300 leading-relaxed pt-1">
                                                {{ $cp['desc'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.orders.checkpoint.delete', [$order->id, $cIndex]) }}" method="POST" onsubmit="return confirm('Hapus checkpoint: {{ $cp['title'] }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-slate-500 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-900 transition"
                                            title="Hapus Checkpoint"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Form Tambah Checkpoint Baru (5 cols) -->
                <div class="lg:col-span-5 bg-slate-950 border border-slate-800 rounded-xl p-5 space-y-4">
                    <div class="border-b border-slate-800 pb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-white flex items-center space-x-1.5">
                            <span class="text-cyan-400">+</span>
                            <span>Tambah Checkpoint Logistik Baru</span>
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Checkpoint baru otomatis menjadi status paling atas dan teraktif.
                        </p>
                    </div>

                    <form action="{{ route('admin.orders.checkpoint.add', $order->id) }}" method="POST" class="space-y-3.5">
                        @csrf

                        <!-- Preset Quick Buttons -->
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1.5">Preset Cepat:</span>
                            <div class="flex flex-wrap gap-1.5">
                                <button type="button" onclick="document.getElementById('cp_title').value='Tiba di Hub Sortir Regional'; document.getElementById('cp_loc').value='Hub Logistik Distribusi'; document.getElementById('cp_desc').value='Paket telah tiba di fasilitas sortir regional untuk proses pemilahan rute antar.'" class="px-2 py-1 bg-slate-900 hover:bg-slate-800 text-cyan-400 border border-slate-700 rounded text-[10px] font-semibold transition">
                                    + Sortir Regional
                                </button>
                                <button type="button" onclick="document.getElementById('cp_title').value='Kurir Mengantar ke Alamat Penerima'; document.getElementById('cp_loc').value='Area Tujuan Penerima'; document.getElementById('cp_desc').value='Paket dibawa kurir ekspres menuju alamat tujuan penerima. Pastikan nomor penerima dapat dihubungi.'" class="px-2 py-1 bg-slate-900 hover:bg-slate-800 text-cyan-400 border border-slate-700 rounded text-[10px] font-semibold transition">
                                    + Kurir Mengantar
                                </button>
                                <button type="button" onclick="document.getElementById('cp_title').value='Paket Telah Tiba & Diterima'; document.getElementById('cp_loc').value='Alamat Penerima'; document.getElementById('cp_desc').value='Paket berhasil diserahterimakan kepada pihak penerima dengan kondisi baik dan tersegel.'" class="px-2 py-1 bg-slate-900 hover:bg-slate-800 text-emerald-400 border border-slate-700 rounded text-[10px] font-semibold transition">
                                    + Selesai Diterima
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-1">
                                Judul Checkpoint / Status Event *
                            </label>
                            <input
                                type="text"
                                id="cp_title"
                                name="checkpoint_title"
                                required
                                placeholder="Contoh: Paket Tiba di Sorting Hub Surabaya"
                                class="w-full px-3 py-2 bg-slate-900 border border-slate-800 rounded-lg text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 font-medium"
                            >
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Lokasi / Fasilitas
                                </label>
                                <input
                                    type="text"
                                    id="cp_loc"
                                    name="checkpoint_location"
                                    placeholder="Contoh: Hub Logistik Jakarta Pusat"
                                    class="w-full px-3 py-2 bg-slate-900 border border-slate-800 rounded-lg text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                                >
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Waktu / Tanggal
                                </label>
                                <input
                                    type="text"
                                    name="checkpoint_time"
                                    value="{{ now()->format('d M Y • H:i') }}"
                                    class="w-full px-3 py-2 bg-slate-900 border border-slate-800 rounded-lg text-xs text-white placeholder-slate-500 font-mono focus:outline-none focus:ring-1 focus:ring-cyan-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-1">
                                Deskripsi Rincian Logistik
                            </label>
                            <textarea
                                id="cp_desc"
                                name="checkpoint_desc"
                                rows="3"
                                placeholder="Jelaskan progres kurir atau informasi keamanan paket..."
                                class="w-full px-3 py-2 bg-slate-900 border border-slate-800 rounded-lg text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 leading-relaxed"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-400 hover:to-teal-400 text-slate-950 font-black text-xs uppercase tracking-wider rounded-lg transition shadow-md flex items-center justify-center space-x-1.5"
                        >
                            <span>+ Terbitkan Checkpoint Baru</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-layouts.admin>
