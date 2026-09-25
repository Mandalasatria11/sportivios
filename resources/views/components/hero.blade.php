<section class="relative w-full overflow-hidden bg-slate-950">
    <!-- Stadium Background Image -->
    <div class="relative w-full min-h-[380px] sm:min-h-[460px] md:min-h-[520px] lg:min-h-[560px] flex items-center justify-center">
        <img 
            src="{{ asset('images/stadium.jpg') }}" 
            alt="Sportivios Stadium" 
            class="absolute inset-0 w-full h-full object-cover object-center filter brightness-[0.78] contrast-[1.08]"
        />
        
        <!-- Subtle gradient overlay for contrast -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/50"></div>

        <!-- Hero Content (Centered) -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 py-16 sm:py-24 text-center flex flex-col items-center">
            <!-- Headline -->
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black italic tracking-wider text-white uppercase font-sport drop-shadow-[0_4px_16px_rgba(0,0,0,0.8)] leading-tight">
                GEAR UP FO GREATNESS
            </h1>

            <!-- Subtitle -->
            <p class="mt-3 sm:mt-4 text-xs sm:text-sm md:text-base text-gray-200 font-normal max-w-2xl mx-auto leading-relaxed drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                Engineered for greatness. Discover professional-grade equipment designed to push your limits and elevate your game.
            </p>

            <!-- Call to Action Button -->
            <div class="mt-6 sm:mt-8">
                <a 
                    href="{{ url('/product') }}" 
                    class="inline-flex items-center justify-center px-8 sm:px-10 py-2.5 sm:py-3 rounded-full text-xs sm:text-sm font-semibold tracking-wide bg-[#8ee0ec] text-slate-900 shadow-[0_4px_14px_rgba(142,224,236,0.4)] hover:bg-[#76d6e4] hover:shadow-[0_6px_20px_rgba(142,224,236,0.6)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200"
                >
                    Shop Now
                </a>
            </div>
        </div>
    </div>
</section>
