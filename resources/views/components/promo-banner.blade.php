<section class="w-full bg-white py-6 sm:py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Promo Banner Box -->
        <div class="relative w-full rounded-xl sm:rounded-2xl overflow-hidden shadow-xl min-h-[180px] sm:min-h-[220px] md:min-h-[240px] flex items-center bg-[#071328]">
            
            <!-- Glowing Blue / Cyan Wave Background -->
            <img 
                src="{{ asset('images/promo-bg.jpg') }}" 
                alt="30% Off Running Gear" 
                class="absolute inset-0 w-full h-full object-cover object-center filter brightness-95"
            />
            
            <!-- Dark Gradient Overlay for optimal readability on left -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#030914]/90 via-[#030914]/65 to-transparent"></div>

            <!-- Content Area -->
            <div class="relative z-10 px-6 sm:px-10 md:px-14 py-8 max-w-xl text-left">
                <!-- Kicker -->
                <span class="block text-[11px] sm:text-xs font-bold tracking-[0.2em] text-cyan-300 uppercase">
                    END OF SEASON
                </span>

                <!-- Headline -->
                <h3 class="mt-1.5 text-xl sm:text-2xl md:text-3xl font-black tracking-tight text-white uppercase font-display">
                    30% OFF ALL RUNNING GEAR
                </h3>

                <!-- Description -->
                <p class="mt-2 text-xs sm:text-sm text-gray-300 font-normal leading-relaxed max-w-md">
                    Upgrade your stride with professional-grade footwear and apparel. Limited time only.
                </p>

                <!-- CTA Button -->
                <div class="mt-4 sm:mt-5">
                    <a 
                        href="#claim" 
                        class="inline-flex items-center justify-center px-5 sm:px-6 py-2 sm:py-2.5 rounded-md text-xs font-bold tracking-wide bg-[#8ee0ec] text-slate-900 shadow-md hover:bg-[#74d7e6] hover:shadow-lg transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200"
                    >
                        Claim Offer
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
