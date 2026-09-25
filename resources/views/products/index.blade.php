<x-layout :title="($currentCategoryTitle ?? 'Shop All Products') . ' - SPORTIVIOS'">
    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-xs text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-black transition">Home</a>
                <span class="text-gray-400">&gt;</span>
                <a href="{{ url('/product') }}" class="hover:text-black transition">Shop</a>
                <span class="text-gray-400">&gt;</span>
                <span class="font-medium text-gray-900">
                    @if ($currentCategory)
                        {{ ucfirst($currentCategory) }}
                    @else
                        All Products
                    @endif
                </span>
            </nav>

            <!-- Back Link -->
            <div class="mb-4">
                <a href="{{ url('/') }}" class="inline-flex items-center text-xs font-semibold text-gray-700 hover:text-blue-600 transition group">
                    <span class="mr-1.5 transition-transform group-hover:-translate-x-1">&larr;</span>
                    <span>Back</span>
                </a>
            </div>

            <!-- Page Header Title & Description -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-[#0e4868] uppercase font-display">
                    @if ($currentCategory)
                        {{ $currentCategoryTitle }}
                    @else
                        PERFORMANCE GEAR
                    @endif
                </h1>
                <p class="mt-2 text-sm text-gray-600 max-w-3xl">
                    Discover our complete collection of professional-grade athletic equipment designed for peak performance.
                </p>
            </div>

            <!-- Main Layout: Sidebar Filters + Products Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                
                <!-- Left Sidebar: Filters -->
                <aside class="lg:col-span-1 bg-white p-5 rounded-xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.04)] sticky top-20">
                    <form id="filterForm" method="GET" action="{{ $currentCategory ? url('/product/' . $currentCategory) : url('/product') }}">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Filter Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wider">FILTERS</h2>
                            <a href="{{ $currentCategory ? url('/product/' . $currentCategory) : url('/product') }}" class="text-[11px] font-medium text-gray-400 hover:text-blue-600 transition">
                                Clear All
                            </a>
                        </div>

                        <!-- Filter: Categories -->
                        <div class="py-5 border-b border-gray-100">
                            <h3 class="text-xs font-bold text-gray-900 mb-3.5">Categories</h3>
                            <div class="space-y-2.5">
                                @php
                                    $categoryOptions = [
                                        ['key' => 'shoes', 'label' => 'Running Shoes', 'url' => url('/product/shoes')],
                                        ['key' => 'apparel', 'label' => 'Training Apparel', 'url' => url('/product/apparel')],
                                        ['key' => 'accessories', 'label' => 'Gym Accessories', 'url' => url('/product/accessories')],
                                    ];
                                @endphp

                                @foreach ($categoryOptions as $cat)
                                    @php
                                        $isChecked = ($currentCategory === $cat['key']) || in_array($cat['key'], (array)$selectedCategories);
                                    @endphp
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input 
                                            type="checkbox" 
                                            name="categories[]" 
                                            value="{{ $cat['key'] }}"
                                            {{ $isChecked ? 'checked' : '' }}
                                            onchange="window.location.href = '{{ $cat['url'] }}'"
                                            class="w-4 h-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500 accent-[#0891b2] cursor-pointer"
                                        >
                                        <span class="text-xs text-gray-700 group-hover:text-black {{ $isChecked ? 'font-semibold text-black' : '' }}">
                                            {{ $cat['label'] }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter: Price Range -->
                        <div class="py-5 border-b border-gray-100">
                            <h3 class="text-xs font-bold text-gray-900 mb-3.5">Price</h3>
                            <div class="flex items-center space-x-2">
                                <div class="relative flex-1">
                                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                    <input 
                                        type="number" 
                                        name="min_price" 
                                        value="{{ request('min_price') }}" 
                                        placeholder="Min"
                                        class="w-full pl-6 pr-2 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                                    >
                                </div>
                                <span class="text-gray-400 text-xs">-</span>
                                <div class="relative flex-1">
                                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                    <input 
                                        type="number" 
                                        name="max_price" 
                                        value="{{ request('max_price') }}" 
                                        placeholder="Max"
                                        class="w-full pl-6 pr-2 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:outline-none focus:ring-1 focus:ring-cyan-500"
                                    >
                                </div>
                            </div>
                            <button type="submit" class="mt-3 w-full py-1.5 bg-gray-900 hover:bg-black text-white text-[11px] font-semibold rounded-md transition shadow-xs">
                                Apply Price
                            </button>
                        </div>

                        <!-- Filter: Size -->
                        <div class="pt-5">
                            <h3 class="text-xs font-bold text-gray-900 mb-3.5">Size</h3>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach (['S', 'M', 'L', 'XL'] as $sizeOption)
                                    @php
                                        $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                    @endphp
                                    <button 
                                        type="button"
                                        onclick="toggleSize('{{ $sizeOption }}')"
                                        class="py-2 text-xs font-semibold rounded border transition-all text-center {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                    >
                                        {{ $sizeOption }}
                                    </button>
                                @endforeach
                            </div>
                            <!-- Hidden inputs for size -->
                            <div id="sizeInputsContainer">
                                @foreach ((array)$selectedSizes as $s)
                                    <input type="hidden" name="size[]" value="{{ $s }}">
                                @endforeach
                            </div>
                        </div>

                    </form>
                </aside>

                <!-- Right Content Area: Active Filters, Sort & Product Grid -->
                <main class="lg:col-span-3">
                    
                    <!-- Top Bar: Active Filter Badges & Sort Dropdown -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 pb-2">
                        
                        <!-- Active Filter Pills -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs text-gray-500 font-medium mr-1">Active Filters:</span>

                            @if ($currentCategory)
                                @php
                                    $catLabels = ['shoes' => 'Running Shoes', 'apparel' => 'Training Apparel', 'accessories' => 'Gym Accessories'];
                                    $catLabel = $catLabels[$currentCategory] ?? ucfirst($currentCategory);
                                @endphp
                                <a href="{{ url('/product') }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#e0f7fa] text-[#006064] hover:bg-[#b2ebf2] transition group">
                                    <span>{{ $catLabel }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif

                            @foreach ((array)$selectedSizes as $s)
                                @php
                                    $remainingSizes = array_diff((array)$selectedSizes, [$s]);
                                    $removeSizeQuery = request()->except('size', 'page');
                                    if (!empty($remainingSizes)) {
                                        $removeSizeQuery['size'] = $remainingSizes;
                                    }
                                    $removeSizeUrl = url()->current() . '?' . http_build_query($removeSizeQuery);
                                @endphp
                                <a href="{{ $removeSizeUrl }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#e0f7fa] text-[#006064] hover:bg-[#b2ebf2] transition group">
                                    <span>Size: {{ $s }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endforeach

                            @if (request('min_price') || request('max_price'))
                                @php
                                    $removePriceQuery = request()->except('min_price', 'max_price', 'page');
                                    $removePriceUrl = url()->current() . '?' . http_build_query($removePriceQuery);
                                @endphp
                                <a href="{{ $removePriceUrl }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                    <span>Price: ${{ request('min_price', 0) }} - ${{ request('max_price', '∞') }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif

                            @if (!$currentCategory && empty($selectedSizes) && !request('min_price') && !request('max_price'))
                                <span class="text-xs text-gray-400 italic">None (Showing All)</span>
                            @endif
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="flex items-center space-x-2 self-end sm:self-auto">
                            <label for="sortDropdown" class="text-xs text-gray-500 whitespace-nowrap">Sort by:</label>
                            <div class="relative">
                                <select 
                                    id="sortDropdown" 
                                    onchange="handleSortChange(this.value)"
                                    class="appearance-none bg-white border border-gray-200 text-gray-800 text-xs font-semibold py-1.5 pl-3 pr-8 rounded-md focus:outline-none focus:ring-1 focus:ring-cyan-500 cursor-pointer shadow-xs"
                                >
                                    <option value="recommended" {{ $currentSort === 'recommended' ? 'selected' : '' }}>Recommended</option>
                                    <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Product Grid -->
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-6">
                            @foreach ($products as $item)
                                <div class="group bg-white rounded-xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden relative">
                                    
                                    <!-- Product Image Container -->
                                    <div class="relative w-full aspect-square bg-[#f4f5f7] flex items-center justify-center p-4 overflow-hidden">
                                        
                                        <!-- Badge (NEW / SALE) -->
                                        @if (!empty($item['badge']))
                                            <div class="absolute top-3 left-3 z-10">
                                                @if ($item['badge_type'] === 'red' || $item['badge'] === 'SALE' || $item['badge'] === 'HOT')
                                                    <span class="inline-block bg-[#cf2222] text-white text-[10px] font-bold px-2 py-0.5 rounded tracking-wider shadow-xs uppercase">
                                                        {{ $item['badge'] }}
                                                    </span>
                                                @else
                                                    <span class="inline-block bg-[#8ee0ec] text-[#044e54] text-[10px] font-bold px-2 py-0.5 rounded tracking-wider shadow-xs uppercase">
                                                        {{ $item['badge'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <img 
                                            src="{{ $item['image'] }}" 
                                            alt="{{ $item['name'] }}" 
                                            class="w-full h-full object-contain object-center transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                            loading="lazy"
                                        />
                                    </div>

                                    <!-- Product Details -->
                                    <div class="p-4 flex flex-col flex-grow justify-between bg-white border-t border-gray-50">
                                        <div>
                                            <h3 class="text-xs sm:text-sm font-bold text-gray-900 tracking-tight group-hover:text-blue-600 transition line-clamp-1">
                                                {{ $item['name'] }}
                                            </h3>
                                            <p class="text-[11px] text-gray-500 mt-0.5 font-normal">
                                                {{ $item['sub_category'] }}
                                            </p>
                                        </div>

                                        <!-- Price -->
                                        <div class="mt-3 flex items-baseline space-x-2">
                                            @if (!empty($item['old_price']))
                                                <span class="text-sm sm:text-base font-extrabold text-[#cf2222]">
                                                    ${{ number_format($item['price'], 2) }}
                                                </span>
                                                <span class="text-xs text-gray-400 line-through">
                                                    ${{ number_format($item['old_price'], 2) }}
                                                </span>
                                            @else
                                                <span class="text-sm sm:text-base font-extrabold text-gray-900">
                                                    ${{ number_format($item['price'], 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination UI matching screenshot -->
                        <div class="mt-12 flex items-center justify-center space-x-1 sm:space-x-2">
                            <!-- Prev button -->
                            @if ($products->onFirstPage())
                                <span class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-300 cursor-not-allowed text-xs">
                                    &larr;
                                </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-xs">
                                    &larr;
                                </a>
                            @endif

                            <!-- Page numbers -->
                            @for ($page = 1; $page <= max($products->lastPage(), 4); $page++)
                                @if ($page == $products->currentPage())
                                    <span class="w-8 h-8 flex items-center justify-center rounded-md bg-black text-white text-xs font-bold shadow-xs">
                                        {{ $page }}
                                    </span>
                                @elseif ($page <= $products->lastPage())
                                    <a href="{{ $products->url($page) }}" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-xs font-medium">
                                        {{ $page }}
                                    </a>
                                @else
                                    <span class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-100 text-gray-300 text-xs font-medium">
                                        {{ $page }}
                                    </span>
                                @endif
                            @endfor

                            @if ($products->lastPage() > 4)
                                <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs">
                                    ...
                                </span>
                            @endif

                            <!-- Next button -->
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-xs">
                                    &rarr;
                                </a>
                            @else
                                <span class="w-8 h-8 flex items-center justify-center rounded-md border border-gray-200 text-gray-300 cursor-not-allowed text-xs">
                                    &rarr;
                                </span>
                            @endif
                        </div>

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-bold text-gray-900">No products found</h3>
                            <p class="mt-1 text-xs text-gray-500">Try adjusting your filters or search term to find what you're looking for.</p>
                            <div class="mt-6">
                                <a href="{{ url('/product') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-md shadow-xs text-white bg-black hover:bg-gray-800 transition">
                                    Reset All Filters
                                </a>
                            </div>
                        </div>
                    @endif

                </main>

            </div>

        </div>
    </div>

    <!-- Client-side filter helpers -->
    <script>
        function toggleSize(size) {
            const form = document.getElementById('filterForm');
            const container = document.getElementById('sizeInputsContainer');
            
            // Check if input exists
            const existingInput = container.querySelector(`input[value="${size}"]`);
            if (existingInput) {
                existingInput.remove();
            } else {
                const newInput = document.createElement('input');
                newInput.type = 'hidden';
                newInput.name = 'size[]';
                newInput.value = size;
                container.appendChild(newInput);
            }
            form.submit();
        }

        function handleSortChange(sortVal) {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', sortVal);
            currentUrl.searchParams.delete('page');
            window.location.href = currentUrl.toString();
        }
    </script>
</x-layout>
