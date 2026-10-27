@php
    $featuredProducts = \App\Models\Product::latest()->take(4)->get();
@endphp

<section id="featured" class="w-full bg-white py-10 sm:py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-black italic tracking-wide text-gray-900 uppercase font-sport">
                FEATURED PRODUCTS
            </h2>
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-xs sm:text-sm font-bold text-[#147d8e] hover:text-[#0b5460] transition group">
                <span>View All</span>
                <svg class="w-3.5 h-3.5 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        <!-- Product Cards Grid (4 Columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            @forelse ($featuredProducts as $item)
                <x-product-card
                    :id="$item->id"
                    :badge="$item->badge"
                    :badgeType="$item->badge_type ?? 'cyan'"
                    :image="asset($item->image ?? 'images/products/shoe.jpg')"
                    :title="$item->name"
                    reviews="128"
                    :price="'Rp ' . number_format($item->price, 0, ',', '.')"
                />
            @empty
                <!-- Fallback Mock Cards if Database empty -->
                <x-product-card
                    id="1"
                    badge="NEW"
                    badgeType="cyan"
                    :image="asset('images/products/shoe.jpg')"
                    title="AeroGlide Pro X"
                    reviews="128"
                    price="Rp 1.850.000"
                />
                <x-product-card
                    id="2"
                    :image="asset('images/products/jacket.jpg')"
                    title="Velocity Wind Shield"
                    reviews="84"
                    price="Rp 850.000"
                />
                <x-product-card
                    id="3"
                    badge="LIMITED"
                    badgeType="red"
                    :image="asset('images/products/gloves.jpg')"
                    title="Titan Grip Gloves"
                    reviews="212"
                    price="Rp 350.000"
                />
                <x-product-card
                    id="4"
                    badge="SALE"
                    badgeType="red"
                    :image="asset('images/products/duffel.jpg')"
                    title="Core Duffel Bag 40L"
                    reviews="58"
                    price="Rp 650.000"
                />
            @endforelse
        </div>

    </div>
</section>
