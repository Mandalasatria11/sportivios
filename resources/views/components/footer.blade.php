<footer class="w-full bg-[#0c101d] text-gray-400 py-6 sm:py-8 border-t border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4 sm:gap-6 text-center lg:text-left">
            
            <!-- Left: Logo & Brand -->
            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-lg sm:text-xl font-black tracking-tight text-white font-display hover:opacity-90 transition">
                    SPORTIVIOS
                </a>

                <!-- Nav Links -->
                <div class="flex flex-wrap items-center justify-center gap-x-4 sm:gap-x-6 gap-y-2 text-[11px] sm:text-xs text-gray-400">
                    <a href="#privacy" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#terms" class="hover:text-white transition">Terms of Service</a>
                    <a href="#shipping" class="hover:text-white transition">Shipping Info</a>
                    <a href="#returns" class="hover:text-white transition">Returns</a>
                </div>
            </div>

            <!-- Right: Copyright & Security notice -->
            <div class="text-[10px] sm:text-[11px] text-gray-500 font-normal">
                &copy; {{ date('Y') }} SPORTIVIOS Performance System. All rights reserved. Secure encrypted checkout.
            </div>

        </div>
    </div>
</footer>
