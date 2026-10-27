<x-layout title="404 - Produk Tidak Ditemukan - SPORTIVIOS">
    <div class="bg-gray-50 min-h-[75vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-full text-center space-y-6">

            <!-- 404 Badge & Athletic Graphic -->
            <div class="relative mx-auto w-32 h-32 sm:w-40 sm:h-40 flex items-center justify-center">
                <div class="absolute inset-0 bg-cyan-100/60 rounded-full animate-ping opacity-25"></div>
                <div class="relative w-28 h-28 sm:w-36 sm:h-36 bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl shadow-xl flex flex-col items-center justify-center text-white border border-slate-700">
                    <span class="text-3xl sm:text-4xl">⚠️</span>
                    <span class="text-xs font-black tracking-widest uppercase font-mono text-cyan-400 mt-1">ERROR</span>
                </div>
            </div>

            <!-- Header Titles -->
            <div class="space-y-2">
                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black tracking-wider uppercase bg-rose-100 text-rose-700 border border-rose-200">
                    404 &bull; Not Found
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 uppercase font-display tracking-tight">
                    Produk Tidak Ditemukan
                </h1>
                <p class="text-sm sm:text-base text-gray-600 max-w-md mx-auto leading-relaxed">
                    ID produk atau alamat halaman yang Anda cari tidak ditemukan di database kami. Produk mungkin telah dihapus, dinonaktifkan, atau ID URL yang dimasukkan salah.
                </p>
            </div>

            <!-- Quick Navigation Action Buttons -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a
                    href="{{ route('katalog') }}"
                    class="w-full sm:w-auto px-6 py-3.5 bg-cyan-600 hover:bg-cyan-500 active:bg-cyan-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition flex items-center justify-center space-x-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span>Katalog Produk</span>
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="w-full sm:w-auto px-6 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition flex items-center justify-center space-x-2"
                >
                    <span>Semua Produk</span>
                </a>

                <a
                    href="{{ url('/') }}"
                    class="w-full sm:w-auto px-5 py-3.5 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 font-semibold text-xs rounded-xl transition flex items-center justify-center"
                >
                    &larr; Beranda
                </a>
            </div>

            <!-- Help Hint -->
            <p class="text-xs text-gray-400 pt-4">
                Tip: Periksa kembali nomor ID pada URL browser atau cari produk melalui bilah pencarian toko.
            </p>

        </div>
    </div>
</x-layout>
