<section id="featured" class="w-full bg-white py-10 sm:py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-black italic tracking-wide text-gray-900 uppercase font-sport">
                FEATURED PRODUCTS
            </h2>
            <a href="#all-products" class="inline-flex items-center text-xs sm:text-sm font-bold text-[#147d8e] hover:text-[#0b5460] transition group">
                <span>View All</span>
                <svg class="w-3.5 h-3.5 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        <!-- Product Cards Grid (4 Columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            
            <!-- 1. AeroSprint Pro X1 -->
            <x-product-card 
                badge="NEW"
                badgeType="cyan"
                :image="asset('images/products/shoe.jpg')"
                title="AeroSprint Pro X1"
                reviews="128"
                price="$189.99"
            />

            <!-- 2. Velocity Wind Shield -->
            <x-product-card 
                :image="asset('images/products/jacket.jpg')"
                title="Velocity Wind Shield"
                reviews="84"
                price="$120.00"
            />

            <!-- 3. Titan Grip Gloves -->
            <x-product-card 
                badge="LIMITED STOCK"
                badgeType="red"
                :image="asset('images/products/gloves.jpg')"
                title="Titan Grip Gloves"
                reviews="212"
                price="$35.00"
            />

            <!-- 4. Core Duffel Bag 40L -->
            <x-product-card 
                badge="SALE"
                badgeType="red"
                :image="asset('images/products/duffel.jpg')"
                title="Core Duffel Bag 40L"
                reviews="58"
                price="$59.99"
                oldPrice="$85.00"
            />

        </div>

    </div>
</section>
