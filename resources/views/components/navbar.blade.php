<header class="w-full bg-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-xl sm:text-2xl font-black tracking-tight text-black font-display hover:opacity-90 transition">
                    SPORTIVIOS
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <nav class="hidden md:flex items-center space-x-8 lg:space-x-12">
                <a href="#shoes" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-black transition">
                    Shoes
                </a>
                <a href="#apparel" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-black transition">
                    Apparel
                </a>
                <a href="#accessories" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-black transition">
                    Accessories
                </a>
            </nav>

            <!-- Right: Icons (Cart & User) -->
            <div class="flex items-center space-x-4 sm:space-x-5 text-gray-900">
                <!-- Shopping Cart Icon -->
                <a href="#cart" class="p-1 hover:text-blue-600 transition" aria-label="Shopping Cart">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.7 2.404-6.326A1.125 1.125 0 0019.25 6.75H5.106M7.5 14.25L5.106 6.75m0 0L4.1 3M9 20.25a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0zm10.5 0a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0z" />
                    </svg>
                </a>

                <!-- User Account Icon -->
                <a href="#account" class="p-1 hover:text-blue-600 transition" aria-label="User Account">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Sporty Decorative Blue Border Strip -->
    <div class="header-blue-texture"></div>
</header>
