<x-layouts.admin title="Edit Produk">
    <x-slot:pageHeader>
        UBAH DATA PRODUK: {{ strtoupper($product->name) }}
    </x-slot:pageHeader>

    <div class="max-w-4xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white flex items-center space-x-1">
                <span>&larr;</span>
                <span>Kembali ke Daftar Produk</span>
            </a>
            <span class="text-xs font-mono text-cyan-400">ID Produk: #{{ $product->id }}</span>
        </div>

        @if ($errors->any())
            <div class="p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl text-xs text-rose-400 space-y-1">
                <span class="font-bold">Gagal memperbarui produk:</span>
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xs">
            <!-- Form Edit Produk dengan enctype multipart/form-data -->
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Produk -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Nama Produk <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Kategori Utama -->
                    <div>
                        <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Kategori Utama <span class="text-rose-500">*</span>
                        </label>
                        <select
                            name="category"
                            id="category"
                            onchange="updateSizePresets(this.value)"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                            <option value="shoes" {{ old('category', $product->category) === 'shoes' ? 'selected' : '' }}>Shoes (Sepatu Olahraga)</option>
                            <option value="apparel" {{ old('category', $product->category) === 'apparel' ? 'selected' : '' }}>Apparel (Pakaian: Baju / Celana / Jaket)</option>
                            <option value="accessories" {{ old('category', $product->category) === 'accessories' ? 'selected' : '' }}>Accessories (Aksesoris: Tas / Botol / Non-Ukuran)</option>
                        </select>
                    </div>

                    <!-- Sub Kategori -->
                    <div>
                        <label for="sub_category" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Sub-Kategori / Tagline
                        </label>
                        <input
                            type="text"
                            name="sub_category"
                            id="sub_category"
                            value="{{ old('sub_category', $product->sub_category) }}"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Pengaturan Ukuran (Size System) -->
                    <div class="sm:col-span-2 p-4 bg-slate-950/70 border border-slate-800 rounded-xl space-y-3">
                        <div class="flex items-center justify-between">
                            <label for="sizesInput" class="block text-xs font-bold uppercase tracking-wider text-cyan-400">
                                📏 Sistem Pilihan Ukuran Produk
                            </label>
                            <span id="sizeCategoryHint" class="text-[11px] text-slate-400 font-mono">
                                Mode: {{ $product->category === 'shoes' ? 'Sepatu (Angka)' : ($product->category === 'apparel' ? 'Pakaian (Huruf)' : 'Aksesoris (All Size)') }}
                            </span>
                        </div>

                        <div>
                            <input
                                type="text"
                                name="sizes"
                                id="sizesInput"
                                value="{{ old('sizes', is_array($product->available_sizes) ? implode(', ', $product->available_sizes) : ($product->sizes ?? '')) }}"
                                placeholder="Contoh: 39, 40, 41, 42 atau S, M, L, XL atau All Size"
                                class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 font-mono focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            >
                            <p id="sizeExplain" class="text-[11px] text-slate-500 mt-1.5">
                                Pisahkan dengan tanda koma jika memiliki beberapa pilihan ukuran.
                            </p>
                        </div>

                        <!-- Quick Size Presets Buttons -->
                        <div class="flex flex-wrap items-center gap-2 pt-1">
                            <span class="text-[10px] text-slate-400 uppercase font-bold">Preset Cepat:</span>
                            <button
                                type="button"
                                onclick="applySizePreset('39, 40, 41, 42, 43, 44')"
                                class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-cyan-300 rounded text-[11px] font-mono transition"
                            >
                                Sepatu: 39-44
                            </button>
                            <button
                                type="button"
                                onclick="applySizePreset('S, M, L, XL, XXL')"
                                class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-cyan-300 rounded text-[11px] font-mono transition"
                            >
                                Pakaian: S, M, L, XL, XXL
                            </button>
                            <button
                                type="button"
                                onclick="applySizePreset('All Size')"
                                class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-emerald-300 rounded text-[11px] font-mono transition"
                            >
                                Aksesoris: All Size
                            </button>
                        </div>
                    </div>

                    <!-- Harga Satuan (IDR) -->
                    <div>
                        <label for="price" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Harga Satuan (IDR) <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            step="1000"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Stok Saat Ini -->
                    <div>
                        <label for="stock" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Stok Saat Ini <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Label Badge -->
                    <div>
                        <label for="badge" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Label Badge (Opsional)
                        </label>
                        <input
                            type="text"
                            name="badge"
                            id="badge"
                            value="{{ old('badge', $product->badge) }}"
                            placeholder="Contoh: NEW, SALE, POPULAR"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Warna Badge -->
                    <div>
                        <label for="badge_type" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Warna Badge
                        </label>
                        <select
                            name="badge_type"
                            id="badge_type"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                            <option value="cyan" {{ old('badge_type', $product->badge_type) === 'cyan' ? 'selected' : '' }}>Cyan Glow (New/Popular)</option>
                            <option value="red" {{ old('badge_type', $product->badge_type) === 'red' ? 'selected' : '' }}>Red Flame (Sale/Discount)</option>
                        </select>
                    </div>

                    <!-- Foto Saat Ini & Input File Foto Baru (Opsional) -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Foto Produk
                        </label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 bg-slate-950/70 border border-slate-800 rounded-xl">
                            <!-- Thumbnail Foto Saat Ini -->
                            <div class="flex items-center space-x-3.5">
                                <div class="w-20 h-20 bg-slate-800 border border-slate-700 rounded-xl p-1.5 flex items-center justify-center flex-shrink-0 overflow-hidden shadow-inner">
                                    <img
                                        src="{{ $product->image_url }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-contain"
                                    >
                                </div>
                                <div class="text-xs">
                                    <span class="font-bold text-slate-300 block">Foto Saat Ini:</span>
                                    <span class="text-slate-400 font-mono text-[11px] break-all">{{ $product->image ?? 'Belum ada foto' }}</span>
                                </div>
                            </div>

                            <!-- Input File Foto Baru -->
                            <div class="flex-1 border-t sm:border-t-0 sm:border-l border-slate-800 pt-3 sm:pt-0 sm:pl-4">
                                <label for="image" class="block text-xs font-semibold text-slate-300 mb-1">
                                    Unggah Foto Baru
                                </label>
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-cyan-400 hover:file:bg-slate-700 cursor-pointer"
                                >
                                <p class="text-[11px] text-slate-400 mt-1.5">
                                    Unggah foto bersifat opsional (kosongkan jika tidak ingin mengganti foto).
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Lengkap -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Deskripsi Produk <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 resize-none"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <!-- Tombol Aksi Form -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-800">
                    <a
                        href="{{ route('admin.products.index') }}"
                        class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl text-xs font-bold transition"
                    >
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-cyan-500 hover:bg-cyan-400 text-slate-950 rounded-xl text-xs font-black uppercase tracking-wider transition shadow-md"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function updateSizePresets(cat) {
            const input = document.getElementById('sizesInput');
            const hint = document.getElementById('sizeCategoryHint');
            const explain = document.getElementById('sizeExplain');
            if (!input || !hint || !explain) return;

            if (cat === 'shoes') {
                input.value = '39, 40, 41, 42, 43, 44';
                hint.textContent = 'Mode: Sepatu Olahraga (Angka EU)';
                explain.textContent = 'Ukuran numerik sepatu olahraga (pisahkan dengan koma).';
            } else if (cat === 'apparel') {
                input.value = 'S, M, L, XL, XXL';
                hint.textContent = 'Mode: Pakaian Atletik (Huruf)';
                explain.textContent = 'Ukuran pakaian/baju/celana (S, M, L, XL, XXL).';
            } else {
                input.value = 'All Size';
                hint.textContent = 'Mode: Aksesoris / Non-Pakaian (Universal)';
                explain.textContent = 'Produk non-pakaian/sepatu (botol, tas, bola) menggunakan All Size (tidak memerlukan ukuran khusus).';
            }
        }

        function applySizePreset(val) {
            const input = document.getElementById('sizesInput');
            if (input) input.value = val;
        }
    </script>
</x-layouts.admin>
