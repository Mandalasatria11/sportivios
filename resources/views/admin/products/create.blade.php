<x-layouts.admin title="Tambah Produk Baru">
    <x-slot:pageHeader>
        TAMBAH PRODUK BARU
    </x-slot:pageHeader>

    <div class="max-w-4xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white flex items-center space-x-1">
                <span>&larr;</span>
                <span>Kembali ke Daftar Produk</span>
            </a>
        </div>

        @if ($errors->any())
            <div class="p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl text-xs text-rose-400 space-y-1">
                <span class="font-bold">Gagal menyimpan produk:</span>
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xs">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Produk -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Nama Produk <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Contoh: AeroGlide Pro X Marathon Shoes"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Kategori Utama <span class="text-rose-500">*</span>
                        </label>
                        <select
                            name="category"
                            id="categorySelect"
                            onchange="updateSizePresets(this.value)"
                            required
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                            <option value="shoes" {{ old('category') === 'shoes' ? 'selected' : '' }}>Shoes (Sepatu Olahraga)</option>
                            <option value="apparel" {{ old('category') === 'apparel' ? 'selected' : '' }}>Apparel (Pakaian: Baju / Celana / Jaket)</option>
                            <option value="accessories" {{ old('category') === 'accessories' ? 'selected' : '' }}>Accessories (Aksesoris: Tas / Botol / Non-Ukuran)</option>
                        </select>
                    </div>

                    <!-- Sub Kategori -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Sub-Kategori / Tagline
                        </label>
                        <input
                            type="text"
                            name="sub_category"
                            value="{{ old('sub_category') }}"
                            placeholder="Contoh: Men's Running Shoes"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Pengaturan Ukuran (Size System) -->
                    <div class="sm:col-span-2 p-4 bg-slate-950/70 border border-slate-800 rounded-xl space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold uppercase tracking-wider text-cyan-400">
                                📏 Sistem Pilihan Ukuran Produk
                            </label>
                            <span id="sizeCategoryHint" class="text-[11px] text-slate-400 font-mono">
                                Mode: Sepatu (Angka)
                            </span>
                        </div>

                        <div>
                            <input
                                type="text"
                                name="sizes"
                                id="sizesInput"
                                value="{{ old('sizes', '39, 40, 41, 42, 43, 44') }}"
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

                    <!-- Harga (IDR) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Harga Satuan (IDR) <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', 1500000) }}"
                            min="0"
                            step="1000"
                            required
                            placeholder="1500000"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Stok Awal -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Jumlah Stok Awal <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="stock"
                            value="{{ old('stock', 20) }}"
                            min="0"
                            required
                            placeholder="20"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Badge Promo -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Label Badge (Opsional)
                        </label>
                        <input
                            type="text"
                            name="badge"
                            value="{{ old('badge') }}"
                            placeholder="Contoh: NEW RELEASE, SALE, BEST SELLER"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                    </div>

                    <!-- Badge Type -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Warna Badge
                        </label>
                        <select
                            name="badge_type"
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                        >
                            <option value="cyan" {{ old('badge_type') === 'cyan' ? 'selected' : '' }}>Cyan Glow (New/Popular)</option>
                            <option value="red" {{ old('badge_type') === 'red' ? 'selected' : '' }}>Red Flame (Sale/Discount)</option>
                        </select>
                    </div>

                    <!-- Upload Foto Gambar -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Foto Produk (PNG/JPG/WEBP maks 2MB)
                        </label>
                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-cyan-400 hover:file:bg-slate-700 cursor-pointer"
                        >
                        <p class="text-[11px] text-slate-500 mt-1.5">Jika dikosongkan, gambar template standar akan digunakan.</p>
                    </div>

                    <!-- Deskripsi Lengkap -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Deskripsi Produk <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            required
                            placeholder="Jelaskan fitur teknis, keunggulan material, dan kenyamanan perlengkapan olahraga ini..."
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 resize-none"
                        >{{ old('description') }}</textarea>
                    </div>
                </div>

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
                        Simpan Produk
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
            document.getElementById('sizesInput').value = val;
        }
    </script>
</x-layouts.admin>
