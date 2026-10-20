<x-layout title="Katalog Produk - SPORTIVIOS">
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-xs text-gray-500 mb-4" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-black transition">Home</a>
                <span class="text-gray-400">&gt;</span>
                <span class="font-medium text-gray-900">Katalog Produk</span>
            </nav>

            <!-- Page Header Title & Subtitle -->
            <div class="mb-8 border-b border-gray-200 pb-5 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-gray-900 uppercase font-display">
                        Katalog Produk Sportivios
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 max-w-2xl">
                        Koleksi perlengkapan dan busana olahraga premium berkualitas tinggi yang diambil secara langsung dari basis data melalui Eloquent ORM.
                    </p>
                </div>
                <div class="text-xs font-semibold text-gray-500 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-xs self-start md:self-auto">
                    Total: <span class="text-gray-900 font-bold">{{ count($products) }}</span> Item
                </div>
            </div>

            <!-- Product Grid using forelse directive -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($products as $product)
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">
                        
                        <!-- Product Image Container -->
                        <div class="relative w-full aspect-square bg-[#f8fafc] flex items-center justify-center p-6 overflow-hidden">
                            <span class="absolute top-3 left-3 bg-[#0891b2] text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-xs">
                                Original
                            </span>

                            <img 
                                src="{{ asset($product->image) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-contain object-center transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                loading="lazy"
                            />
                        </div>

                        <!-- Product Information Details -->
                        <div class="p-5 flex flex-col flex-grow justify-between bg-white border-t border-gray-50">
                            <div>
                                <h2 class="text-base font-bold text-gray-900 tracking-tight group-hover:text-cyan-600 transition line-clamp-1">
                                    {{ $product->name }}
                                </h2>
                                
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Price & Action Button -->
                            <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-gray-400 tracking-wider">Harga</span>
                                    <span class="text-lg font-black text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <button type="button" class="inline-flex items-center justify-center px-3.5 py-2 bg-gray-900 hover:bg-cyan-600 text-white text-xs font-semibold rounded-xl shadow-xs transition-colors duration-200">
                                    Beli Sekarang
                                </button>
                            </div>
                        </div>

                    </div>
                @empty
                    <!-- Empty State Elegan -->
                    <div class="col-span-full py-16 px-6 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200 my-6 shadow-xs">
                        <div class="mx-auto w-20 h-20 rounded-full bg-cyan-50 flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Produk Belum Tersedia...
                        </h3>
                        <p class="text-sm text-gray-500 max-w-md mx-auto mb-6">
                            Saat ini belum ada produk yang terdaftar di basis data kami. Silakan jalankan seeder atau tambahkan data produk baru.
                        </p>
                        <div class="inline-flex items-center space-x-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-xs font-mono border border-gray-200">
                            <span>Jalankan seeder:</span>
                            <span class="font-bold text-black">php artisan db:seed</span>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-layout>
