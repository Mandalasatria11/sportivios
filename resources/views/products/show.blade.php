<x-layout :title="($product['name'] ?? 'AeroGlide Pro X') . ' - SPORTIVIOS'">
    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-xs text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-black transition">Home</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ url('/product') }}" class="hover:text-black transition">Men</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ url('/product/' . strtolower($product['category'])) }}" class="hover:text-black transition">{{ ucfirst($product['category']) }}</a>
                <span class="text-gray-400">&gt;</span>
                <span class="font-medium text-gray-900">{{ $product['name'] }}</span>
            </nav>

            <!-- Back to Catalog Link -->
            <div class="mb-6">
                <a href="{{ url('/product') }}" class="inline-flex items-center text-xs font-bold text-gray-700 hover:text-cyan-600 uppercase tracking-wider transition group">
                    <span class="mr-2 transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>BACK TO CATALOG</span>
                </a>
            </div>

            <!-- Product Detail Main Section (2 Columns Grid) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start" x-data="productDetailHandler()">
                
                <!-- Left: Thumbnails + Main Image Gallery (5 cols on lg) -->
                <div class="lg:col-span-7 flex flex-col sm:flex-row gap-4">
                    
                    <!-- Thumbnails Column (Left vertical) -->
                    <div class="flex sm:flex-col gap-3 order-2 sm:order-1 overflow-x-auto sm:overflow-visible">
                        @foreach ($product['thumbnails'] as $index => $thumb)
                            <button 
                                type="button" 
                                onclick="changeMainImage('{{ $thumb }}', {{ $index }})"
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg border-2 bg-gray-50 overflow-hidden flex-shrink-0 transition-all p-1"
                                id="thumb-btn-{{ $index }}"
                            >
                                <img src="{{ $thumb }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-contain">
                            </button>
                        @endforeach
                    </div>

                    <!-- Main Display Image Container -->
                    <div class="flex-1 order-1 sm:order-2 bg-[#f6f7f9] rounded-2xl p-6 sm:p-10 relative flex items-center justify-center min-h-[360px] sm:min-h-[460px] border border-gray-100 shadow-xs">
                        <!-- Badge Top Left -->
                        @if (!empty($product['badge']))
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-[#8ee0ec] text-[#044e54] text-[11px] font-black tracking-widest px-3 py-1 rounded uppercase shadow-xs">
                                    {{ $product['badge'] }}
                                </span>
                            </div>
                        @endif

                        <img 
                            id="mainProductImage" 
                            src="{{ $product['image'] }}" 
                            alt="{{ $product['name'] }}" 
                            class="w-full max-h-[380px] sm:max-h-[420px] object-contain transform transition-all duration-300"
                        >
                    </div>

                </div>

                <!-- Right: Product Info & Purchase Options (5 cols on lg) -->
                <div class="lg:col-span-5 flex flex-col space-y-6">
                    
                    <!-- Title & Price & Reviews -->
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 font-display">
                            {{ $product['name'] }}
                        </h1>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex items-baseline space-x-2">
                                <span class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                                    ${{ number_format($product['price'], 2) }}
                                </span>
                                @if (!empty($product['old_price']))
                                    <span class="text-base text-gray-400 line-through font-medium">
                                        ${{ number_format($product['old_price'], 2) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Star Rating -->
                            <div class="flex items-center space-x-1">
                                <div class="flex items-center text-amber-400">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-600 font-semibold underline cursor-pointer ml-1">
                                    {{ $product['rating'] }} ({{ $product['reviews'] }} Reviews)
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed border-b border-gray-100 pb-5">
                        {{ $product['description'] }}
                    </p>

                    <!-- Color Selection -->
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-900 mb-2">
                            <span>Color: <span id="selectedColorName" class="font-normal text-gray-600">{{ $product['colors'][0]['name'] ?? 'Phantom White / Cyber Cyan' }}</span></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            @foreach ($product['colors'] as $cIndex => $col)
                                <button 
                                    type="button" 
                                    onclick="selectColor('{{ $col['name'] }}', {{ $cIndex }})"
                                    class="w-7 h-7 rounded-full border-2 p-0.5 transition flex items-center justify-center cursor-pointer shadow-xs"
                                    id="color-btn-{{ $cIndex }}"
                                    style="background-color: {{ $col['hex'] }};"
                                    title="{{ $col['name'] }}"
                                >
                                    @if ($cIndex === 0)
                                        <svg class="w-3.5 h-3.5 text-black stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Size Selector -->
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-gray-900 mb-2">
                            <span>Size (US Men's)</span>
                            <a href="#" onclick="alert('Size Guide: Standard athletic fit. We recommend ordering your true size.')" class="text-gray-400 hover:text-black underline font-normal text-[11px]">
                                Size Guide
                            </a>
                        </div>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach ($product['sizes'] as $sIndex => $sz)
                                @php
                                    $isSelected = ($sz == '9.5');
                                @endphp
                                <button 
                                    type="button" 
                                    onclick="selectSize('{{ $sz }}', this)"
                                    class="py-2.5 rounded-lg border text-xs font-bold transition text-center size-btn {{ $isSelected ? 'border-black bg-black text-white shadow-xs' : 'border-gray-200 text-gray-800 hover:border-black bg-white' }}"
                                >
                                    {{ $sz }}
                                </button>
                            @endforeach
                        </div>
                        
                        <!-- Low Stock Indicator -->
                        <div class="mt-2 text-[11px] font-semibold text-rose-600 flex items-center space-x-1">
                            <span>ⓘ Only 2 left in Size <span id="activeSizeLabel">9.5</span></span>
                        </div>
                    </div>

                    <!-- CTA Buttons (Add to Cart & Wishlist) -->
                    <div class="space-y-3 pt-2">
                        <button 
                            type="button" 
                            onclick="addToCartAnimation()"
                            class="w-full py-3.5 bg-[#8ee0ec] hover:bg-[#78d6e3] text-slate-950 font-black uppercase text-xs sm:text-sm rounded-lg tracking-widest transition-all shadow-[0_4px_14px_rgba(142,224,236,0.5)] transform active:scale-98 flex items-center justify-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span id="addToCartText">ADD TO CART</span>
                        </button>

                        <button 
                            type="button" 
                            onclick="alert('❤️ Added to your Wishlist!')"
                            class="w-full py-3 bg-white border border-gray-300 hover:border-gray-900 text-gray-900 font-bold text-xs rounded-lg transition flex items-center justify-center space-x-2 shadow-xs"
                        >
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            <span>Add to Wishlist</span>
                        </button>
                    </div>

                    <!-- Accordion Sections -->
                    <div class="border-t border-gray-200 pt-4 space-y-3">
                        
                        <!-- Accordion 1: Technical Features -->
                        <div class="border-b border-gray-100 pb-3">
                            <button 
                                type="button" 
                                onclick="toggleAccordion('acc-tech')"
                                class="w-full flex items-center justify-between text-xs font-bold text-gray-900 py-1 text-left"
                            >
                                <span>Technical Features</span>
                                <svg id="acc-tech-icon" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="acc-tech-content" class="mt-2 text-xs text-gray-600 space-y-1.5 leading-relaxed">
                                @if (!empty($product['tech_features']))
                                    <ul class="list-disc pl-4 space-y-1 text-gray-700">
                                        @foreach ($product['tech_features'] as $tf)
                                            <li>{{ $tf }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Responsive kinetic midsole with 85% energy return. Seamless Aero-Mesh upper for maximum cooling.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Accordion 2: Shipping & Returns -->
                        <div class="pb-2">
                            <button 
                                type="button" 
                                onclick="toggleAccordion('acc-shipping')"
                                class="w-full flex items-center justify-between text-xs font-bold text-gray-900 py-1 text-left"
                            >
                                <span>Shipping &amp; Returns</span>
                                <svg id="acc-shipping-icon" class="w-4 h-4 transform transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="acc-shipping-content" class="mt-2 text-xs text-gray-600 space-y-1 hidden">
                                <p>• Free express shipping on orders over $100.</p>
                                <p>• 30-day hassle-free return &amp; exchange guarantee.</p>
                                <p>• Ships within 24 hours with real-time GPS tracking.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Client-side gallery & interactive handlers -->
    <script>
        function changeMainImage(src, index) {
            const img = document.getElementById('mainProductImage');
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = src;
                img.style.opacity = 1;
            }, 150);

            // Highlight thumbnail
            document.querySelectorAll('[id^="thumb-btn-"]').forEach(btn => {
                btn.classList.remove('border-cyan-500', 'ring-2', 'ring-cyan-400');
                btn.classList.add('border-gray-200');
            });
            const activeBtn = document.getElementById(`thumb-btn-${index}`);
            if (activeBtn) {
                activeBtn.classList.remove('border-gray-200');
                activeBtn.classList.add('border-cyan-500', 'ring-2', 'ring-cyan-400');
            }
        }

        function selectColor(name, index) {
            document.getElementById('selectedColorName').textContent = name;
        }

        function selectSize(size, el) {
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.className = 'py-2.5 rounded-lg border text-xs font-bold transition text-center size-btn border-gray-200 text-gray-800 hover:border-black bg-white';
            });
            el.className = 'py-2.5 rounded-lg border text-xs font-bold transition text-center size-btn border-black bg-black text-white shadow-xs';
            document.getElementById('activeSizeLabel').textContent = size;
        }

        function toggleAccordion(id) {
            const content = document.getElementById(`${id}-content`);
            const icon = document.getElementById(`${id}-icon`);
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        function addToCartAnimation() {
            const text = document.getElementById('addToCartText');
            text.textContent = 'ADDED TO CART! ✓';
            setTimeout(() => {
                window.location.href = "{{ url('/cart') }}";
            }, 700);
        }

        // Initialize first thumbnail
        document.addEventListener('DOMContentLoaded', () => {
            changeMainImage("{{ $product['image'] }}", 0);
        });
    </script>
</x-layout>
