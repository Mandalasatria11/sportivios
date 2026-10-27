<section class="w-full bg-white py-10 sm:py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-6 sm:gap-8 justify-items-center items-center">
            
            <!-- 1. Nike -->
            <a href="{{ route('products.index', ['q' => 'Nike']) }}" class="flex flex-col items-center group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-black flex items-center justify-center shadow-md p-4 group-hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset('images/brands/Nike.jpeg') }}" alt="Nike" class="w-12 h-12 object-contain">
                </div>
                <span class="mt-3 text-xs sm:text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition">
                    Nike
                </span>
            </a>

            <!-- 2. Adidas -->
            <a href="{{ route('products.index', ['q' => 'Adidas']) }}" class="flex flex-col items-center group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-black flex items-center justify-center shadow-md p-4 group-hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset('images/brands/adidas.png') }}" alt="Adidas" class="w-12 h-12 object-contain">
                </div>
                <span class="mt-3 text-xs sm:text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition">
                    Adidas
                </span>
            </a>

            <!-- 3. Puma -->
            <a href="{{ route('products.index', ['q' => 'Puma']) }}" class="flex flex-col items-center group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-black flex items-center justify-center shadow-md p-4 group-hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset('images/brands/Puma.jpeg') }}" alt="Puma" class="w-12 h-12 object-contain">
                </div>
                <span class="mt-3 text-xs sm:text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition">
                    Puma
                </span>
            </a>

            <!-- 4. New Balance -->
            <a href="{{ route('products.index', ['q' => 'New Balance']) }}" class="flex flex-col items-center group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-black flex items-center justify-center shadow-md p-4 group-hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset('images/brands/New Balance.jpeg') }}" alt="New Balance" class="w-12 h-12 object-contain">
                </div>
                <span class="mt-3 text-xs sm:text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition">
                    New Balance
                </span>
            </a>

            <!-- 5. Asics -->
            <a href="{{ route('products.index', ['q' => 'Asics']) }}" class="flex flex-col items-center group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-black flex items-center justify-center shadow-md p-4 group-hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset('images/brands/Asics.jpeg') }}" alt="Asics" class="w-12 h-12 object-contain">
                </div>
                <span class="mt-3 text-xs sm:text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition">
                    Asics
                </span>
            </a>

        </div>
    </div>
</section>

