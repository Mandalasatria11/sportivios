<section class="w-full bg-[#f8f9fa] py-14 sm:py-20 border-t border-gray-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        
        <!-- Mail Icon -->
        <div class="flex justify-center mb-3">
            <svg class="w-8 h-8 sm:w-9 sm:h-9 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <!-- Inbox / Mail with open flap badge -->
                <rect x="2" y="5" width="20" height="14" rx="2" />
                <path d="M2 7l10 7 10-7" />
            </svg>
        </div>

        <!-- Headline -->
        <h2 class="text-xl sm:text-2xl font-black tracking-tight text-gray-900 uppercase font-display">
            STAY IN THE ZONE
        </h2>

        <!-- Subtitle -->
        <p class="mt-2 text-xs sm:text-sm text-gray-500 max-w-lg mx-auto leading-relaxed">
            Subscribe to get insider access to new drops, exclusive promotions, and training tips.
        </p>

        <!-- Newsletter Subscription Form -->
        <form class="mt-6 sm:mt-8 flex flex-col sm:flex-row items-center justify-center gap-2.5 max-w-md mx-auto" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Sportivios!');">
            <div class="w-full relative">
                <input 
                    type="email" 
                    placeholder="Enter your email address" 
                    required
                    class="w-full px-4 py-2.5 sm:py-2.5 text-xs sm:text-sm bg-white border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:border-black focus:ring-1 focus:ring-black shadow-xs transition"
                />
            </div>
            <button 
                type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 text-xs sm:text-sm font-semibold text-white bg-black hover:bg-neutral-800 rounded-md transition shadow-sm flex-shrink-0 cursor-pointer"
            >
                Subscribe
            </button>
        </form>

    </div>
</section>
