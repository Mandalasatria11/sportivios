<x-layouts.admin title="Manajemen Produk">
    <x-slot:pageHeader>
        MANAJEMEN KATALOG PRODUK
    </x-slot:pageHeader>

    <div class="space-y-6">

        <!-- Top Action Bar: Search, Category Filter, and Add Button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap items-center gap-2 flex-1 max-w-xl">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari nama produk, kategori, atau sub-kategori..."
                    class="px-3.5 py-2 bg-slate-900 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 flex-1 min-w-[200px]"
                >
                <select
                    name="category"
                    onchange="this.form.submit()"
                    class="px-3 py-2 bg-slate-900 border border-slate-800 rounded-xl text-xs text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                >
                    <option value="">Semua Kategori</option>
                    <option value="shoes" {{ request('category') === 'shoes' ? 'selected' : '' }}>Shoes</option>
                    <option value="apparel" {{ request('category') === 'apparel' ? 'selected' : '' }}>Apparel</option>
                    <option value="accessories" {{ request('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
                </select>
                <button type="submit" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-xs font-bold transition">
                    Cari
                </button>
                @if(request('q') || request('category'))
                    <a href="{{ route('admin.products.index') }}" class="text-xs text-slate-400 hover:text-white underline">
                        Reset
                    </a>
                @endif
            </form>

            <a
                href="{{ route('admin.products.create') }}"
                class="px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl transition flex items-center justify-center space-x-1.5 self-start sm:self-auto"
            >
                <span>+</span>
                <span>Tambah Produk Baru</span>
            </a>
        </div>

        <!-- Products Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-950/60 text-slate-400 border-b border-slate-800">
                            <th class="py-3.5 px-5 font-bold uppercase tracking-wider">Produk</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Kategori</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Harga (IDR)</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Stok</th>
                            <th class="py-3.5 px-4 font-bold uppercase tracking-wider">Badge</th>
                            <th class="py-3.5 px-5 font-bold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-800/40 transition">
                                <!-- Image & Title -->
                                <td class="py-3 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="w-12 h-12 bg-slate-800 rounded-lg p-1 flex-shrink-0 flex items-center justify-center border border-slate-700">
                                            <img
                                                src="{{ asset($product->image ?? 'images/products/shoe.jpg') }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-contain"
                                            >
                                        </div>
                                        <div class="min-w-0">
                                            <h3 class="font-bold text-white text-xs sm:text-sm line-clamp-1">
                                                {{ $product->name }}
                                            </h3>
                                            <p class="text-[11px] text-slate-400 truncate">{{ $product->sub_category }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category & Sizes -->
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-800 text-cyan-400 border border-slate-700">
                                        {{ $product->category }}
                                    </span>
                                    <div class="text-[10px] text-slate-400 mt-1 font-mono">
                                        {{ $product->hasMultipleSizes() ? implode(', ', $product->available_sizes) : 'All Size' }}
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="py-3 px-4 font-bold text-white">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <!-- Stock -->
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold {{ $product->stock <= 10 ? 'bg-rose-500/10 text-rose-400 border border-rose-500/30' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' }}">
                                        {{ $product->stock }} unit
                                    </span>
                                </td>

                                <!-- Badge -->
                                <td class="py-3 px-4">
                                    @if(!empty($product->badge))
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider {{ $product->badge_type === 'red' ? 'bg-rose-500/20 text-rose-300' : 'bg-cyan-500/20 text-cyan-300' }}">
                                            {{ $product->badge }}
                                        </span>
                                    @else
                                        <span class="text-slate-600">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="py-3 px-5 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a
                                            href="{{ route('products.show', $product->id) }}"
                                            target="_blank"
                                            class="p-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg transition"
                                            title="Lihat di Toko"
                                        >
                                            👁️
                                        </a>
                                        <a
                                            href="{{ route('admin.products.edit', $product->id) }}"
                                            class="px-2.5 py-1.5 bg-slate-800 hover:bg-cyan-500 hover:text-slate-950 text-cyan-400 rounded-lg font-bold text-xs transition"
                                        >
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="px-2.5 py-1.5 bg-rose-500/10 hover:bg-rose-500 hover:text-white text-rose-400 rounded-lg font-bold text-xs transition border border-rose-500/30"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-500">
                                    Tidak ada produk ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if($products->hasPages())
                <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layouts.admin>
