<x-layout :title="$product->name . ' - Detail Produk SPORTIVIOS'">
    <div class="bg-gray-50 min-h-screen py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dynamic Breadcrumb Navigation -->
            <nav class="flex items-center flex-wrap gap-2 text-xs text-gray-500 mb-6" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-black transition">Home</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ route('katalog') }}" class="hover:text-black transition">Katalog</a>
                <span class="text-gray-400">&gt;</span>
                <span class="font-medium text-gray-900 truncate max-w-xs sm:max-w-md">{{ $product->name }}</span>
            </nav>

            <!-- Back to Catalog Link -->
            <div class="mb-6">
                <a href="{{ route('katalog') }}" class="inline-flex items-center text-xs font-bold text-gray-700 hover:text-cyan-600 uppercase tracking-wider transition group">
                    <span class="mr-2 transform group-hover:-translate-x-1 transition-transform font-mono text-sm">&larr;</span>
                    <span>Kembali ke Katalog</span>
                </a>
            </div>

            <!-- Product Detail Container -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_25px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 p-6 sm:p-10 lg:p-12 items-start">
                    
                    <!-- Left Column: Product Image Gallery -->
                    <div class="lg:col-span-6 flex flex-col items-center justify-center">
                        <div class="relative w-full aspect-square bg-[#f8fafc] rounded-2xl flex items-center justify-center p-8 border border-gray-100 overflow-hidden shadow-2xs">
                            <span class="absolute top-4 left-4 bg-cyan-600 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-xs">
                                Original Product
                            </span>
                            
                            @php
                                $imgSrc = $product->image;
                                if (!str_starts_with($imgSrc, 'http://') && !str_starts_with($imgSrc, 'https://')) {
                                    $imgSrc = str_starts_with($imgSrc, 'images/') ? asset($imgSrc) : asset('images/' . $imgSrc);
                                }
                            @endphp

                            <img 
                                src="{{ $imgSrc }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-contain object-center transform hover:scale-105 transition-transform duration-500 ease-out"
                            />
                        </div>

                        <!-- Micro trust badges below image -->
                        <div class="grid grid-cols-3 gap-3 w-full mt-4 text-center">
                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-3">
                                <span class="text-xs font-bold text-gray-900 block">100% Original</span>
                                <span class="text-[10px] text-gray-500">Jaminan Garansi</span>
                            </div>
                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-3">
                                <span class="text-xs font-bold text-gray-900 block">Fast Delivery</span>
                                <span class="text-[10px] text-gray-500">Kirim Seluruh RI</span>
                            </div>
                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-3">
                                <span class="text-xs font-bold text-gray-900 block">7 Hari Retur</span>
                                <span class="text-[10px] text-gray-500">Tukar Ukuran</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Product Information & Purchase Section -->
                    <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                        
                        <div>
                            <!-- Category / Sub-badge -->
                            <div class="flex items-center space-x-2 text-xs font-semibold text-cyan-600 uppercase tracking-wider mb-2">
                                <span>Sportivios Performance</span>
                                <span>•</span>
                                <span>ID: #{{ $product->id }}</span>
                            </div>

                            <!-- Product Name (Dynamic) -->
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-gray-900 tracking-tight font-display leading-tight">
                                {{ $product->name }}
                            </h1>

                            <!-- Rating & Reviews (Visual Mock) -->
                            <div class="mt-3 flex items-center space-x-2">
                                <div class="flex text-amber-400">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs font-bold text-gray-700">4.9 / 5.0</span>
                                <span class="text-xs text-gray-400">• Verified Sportivios Gear</span>
                            </div>

                            <!-- Product Price (Dynamic with number_format) -->
                            <div class="mt-6 p-4 rounded-2xl bg-cyan-50/60 border border-cyan-100 flex items-baseline justify-between">
                                <div>
                                    <span class="block text-[11px] font-bold uppercase text-cyan-800 tracking-wider">Harga Resmi</span>
                                    <span class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Stok Tersedia
                                </span>
                            </div>

                            <!-- Product Description (Dynamic) -->
                            <div class="mt-6">
                                <h2 class="text-xs font-bold uppercase text-gray-900 tracking-wider mb-2">
                                    Deskripsi Produk
                                </h2>
                                <p class="text-sm text-gray-600 leading-relaxed bg-gray-50/70 p-4 rounded-xl border border-gray-100">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                            <a 
                                href="{{ url('/checkout') }}" 
                                class="flex-1 py-3.5 px-6 bg-gray-900 hover:bg-cyan-600 text-white text-xs sm:text-sm font-bold uppercase tracking-wider rounded-xl shadow-xs transition-colors duration-200 text-center flex items-center justify-center space-x-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                                <span>Beli Sekarang</span>
                            </a>
                            
                            <a 
                                href="{{ route('katalog') }}" 
                                class="py-3.5 px-6 bg-white hover:bg-gray-100 border border-gray-200 text-gray-800 text-xs sm:text-sm font-bold uppercase tracking-wider rounded-xl transition text-center"
                            >
                                Pilih Produk Lain
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layout>
