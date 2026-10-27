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
                    {{ $currentCategoryTitle ?? 'All Products' }}
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
                    {{ $currentCategoryTitle ?? 'PERFORMANCE GEAR' }}
                </h1>
                <p class="mt-2 text-sm text-gray-600 max-w-3xl">
                    Discover our complete collection of professional-grade athletic equipment designed for peak performance.
                </p>
            </div>

            <!-- Mobile Filter Toggle Bar (Hidden on Desktop) -->
            <div class="lg:hidden mb-4">
                <button 
                    type="button" 
                    onclick="toggleMobileFilter()" 
                    id="mobileFilterToggleBtn"
                    class="w-full flex items-center justify-between px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-800 shadow-xs hover:border-gray-400 transition cursor-pointer"
                >
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>Filter Produk</span>
                        @php
                            $activeCount = count((array)$selectedCategories) + count((array)$selectedSizes) + (request('min_price') || request('max_price') ? 1 : 0);
                        @endphp
                        @if ($activeCount > 0)
                            <span class="px-2 py-0.5 rounded-full bg-cyan-100 text-cyan-800 text-[10px] font-extrabold">
                                {{ $activeCount }}
                            </span>
                        @endif
                    </div>
                    <span id="mobileFilterStateText" class="text-[11px] text-cyan-700 font-semibold">Buka Filter &darr;</span>
                </button>
            </div>

            <!-- Main Layout: Sidebar Filters + Products Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                
                <!-- Left Sidebar: Filters (Hidden on Mobile by default, toggled via button) -->
                <aside id="filterSidebar" class="hidden lg:block lg:col-span-1 bg-white p-5 rounded-xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.04)] sticky top-20">
                    <form id="filterForm" method="GET" action="{{ url('/product') }}">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Filter Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-2">
                                <svg class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                                </svg>
                                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wider">FILTERS</h2>
                            </div>
                            <a href="{{ url('/product') }}" class="text-[11px] font-medium text-gray-400 hover:text-cyan-600 transition">
                                Reset All
                            </a>
                        </div>

                        <!-- Filter: Categories -->
                        <div class="py-5 border-b border-gray-100">
                            <div class="flex items-center justify-between mb-3.5">
                                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Categories</h3>
                                <span class="text-[10px] text-gray-400">Pilih kategori</span>
                            </div>
                            <div class="space-y-2.5">
                                @php
                                    $categoryOptions = [
                                        ['key' => 'shoes', 'label' => 'Running Shoes'],
                                        ['key' => 'apparel', 'label' => 'Training Apparel'],
                                        ['key' => 'accessories', 'label' => 'Gym Accessories'],
                                    ];
                                @endphp

                                @foreach ($categoryOptions as $cat)
                                    @php
                                        $isChecked = in_array($cat['key'], (array)$selectedCategories);
                                    @endphp
                                    <label class="flex items-center space-x-3 cursor-pointer group select-none">
                                        <input 
                                            type="checkbox" 
                                            name="categories[]" 
                                            value="{{ $cat['key'] }}"
                                            {{ $isChecked ? 'checked' : '' }}
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
                            <h3 class="text-xs font-bold text-gray-900 mb-3.5 uppercase tracking-wider">Harga (IDR)</h3>
                            <div class="flex items-center space-x-2">
                                <div class="relative flex-1">
                                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] font-bold">Rp</span>
                                    <input
                                        type="number"
                                        name="min_price"
                                        value="{{ request('min_price') }}"
                                        placeholder="Min"
                                        step="50000"
                                        class="w-full pl-8 pr-2 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:outline-none focus:ring-1 focus:ring-cyan-500 font-mono"
                                    >
                                </div>
                                <span class="text-gray-400 text-xs">-</span>
                                <div class="relative flex-1">
                                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] font-bold">Rp</span>
                                    <input
                                        type="number"
                                        name="max_price"
                                        value="{{ request('max_price') }}"
                                        placeholder="Max"
                                        step="50000"
                                        class="w-full pl-8 pr-2 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:outline-none focus:ring-1 focus:ring-cyan-500 font-mono"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Filter: Size System -->
                        <div class="py-5">
                            <div class="flex items-center justify-between mb-3.5">
                                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Ukuran (Size)</h3>
                                <span class="text-[10px] text-gray-400">Pilih ukuran</span>
                            </div>

                            @if(($currentCategory ?? '') === 'shoes')
                                <!-- Mode Sepatu Saja: 39 - 44 -->
                                <div class="mb-2">
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">Ukuran Sepatu (EU):</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach (['39', '40', '41', '42', '43', '44'] as $sizeOption)
                                            @php
                                                $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                            @endphp
                                            <button
                                                type="button"
                                                data-size="{{ $sizeOption }}"
                                                onclick="toggleSize('{{ $sizeOption }}', this)"
                                                class="size-filter-btn py-2 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                            >
                                                {{ $sizeOption }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif(($currentCategory ?? '') === 'apparel')
                                <!-- Mode Pakaian Saja: S - XXL -->
                                <div class="mb-2">
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">Ukuran Pakaian (Letter):</span>
                                    <div class="grid grid-cols-5 gap-1.5">
                                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $sizeOption)
                                            @php
                                                $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                            @endphp
                                            <button
                                                type="button"
                                                data-size="{{ $sizeOption }}"
                                                onclick="toggleSize('{{ $sizeOption }}', this)"
                                                class="size-filter-btn py-2 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                            >
                                                {{ $sizeOption }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif(($currentCategory ?? '') === 'accessories')
                                <!-- Mode Aksesoris Saja: All Size -->
                                <div class="mb-2">
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">Tipe Ukuran Peralatan:</span>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach (['All Size', 'M', 'L'] as $sizeOption)
                                            @php
                                                $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                            @endphp
                                            <button
                                                type="button"
                                                data-size="{{ $sizeOption }}"
                                                onclick="toggleSize('{{ $sizeOption }}', this)"
                                                class="size-filter-btn py-2 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                            >
                                                {{ $sizeOption }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <!-- Mode Multi-Kategori: Sepatu + Pakaian + All Size -->
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">👟 Sepatu (EU):</span>
                                        <div class="grid grid-cols-3 gap-1.5">
                                            @foreach (['39', '40', '41', '42', '43', '44'] as $sizeOption)
                                                @php
                                                    $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                                @endphp
                                                <button
                                                    type="button"
                                                    data-size="{{ $sizeOption }}"
                                                    onclick="toggleSize('{{ $sizeOption }}', this)"
                                                    class="size-filter-btn py-1.5 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                                >
                                                    {{ $sizeOption }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">👕 Pakaian:</span>
                                        <div class="grid grid-cols-5 gap-1">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $sizeOption)
                                                @php
                                                    $isSizeSelected = in_array($sizeOption, (array)$selectedSizes);
                                                @endphp
                                                <button
                                                    type="button"
                                                    data-size="{{ $sizeOption }}"
                                                    onclick="toggleSize('{{ $sizeOption }}', this)"
                                                    class="size-filter-btn py-1.5 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ $isSizeSelected ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                                >
                                                    {{ $sizeOption }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <span class="text-[10px] font-bold uppercase text-slate-400 block mb-1.5">🎒 Aksesoris:</span>
                                        <button
                                            type="button"
                                            data-size="All Size"
                                            onclick="toggleSize('All Size', this)"
                                            class="size-filter-btn w-full py-1.5 text-xs font-semibold rounded border transition-all text-center cursor-pointer {{ in_array('All Size', (array)$selectedSizes) ? 'border-cyan-500 bg-cyan-50 text-cyan-700 shadow-xs active-size font-bold' : 'border-gray-200 text-gray-700 hover:border-gray-400 bg-white' }}"
                                        >
                                            All Size (Universal Fit)
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <!-- Hidden inputs for size -->
                            <div id="sizeInputsContainer">
                                @foreach ((array)$selectedSizes as $s)
                                    <input type="hidden" name="size[]" value="{{ $s }}">
                                @endforeach
                            </div>
                        </div>

                        <!-- Unified Filter Actions (Apply & Reset) -->
                        <div class="pt-4 border-t border-gray-100 flex flex-col gap-2">
                            <button 
                                type="submit" 
                                class="w-full py-2.5 bg-black hover:bg-gray-800 active:bg-gray-900 text-white text-xs font-bold rounded-lg transition-all duration-200 shadow-xs hover:shadow flex items-center justify-center space-x-1.5 cursor-pointer"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                                <span>Apply Filters</span>
                            </button>
                            <a 
                                href="{{ url('/product') }}" 
                                class="w-full py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg text-center transition"
                            >
                                Clear All Filters
                            </a>
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

                            @php
                                $catLabels = ['shoes' => 'Running Shoes', 'apparel' => 'Training Apparel', 'accessories' => 'Gym Accessories'];
                            @endphp

                            {{-- Selected Categories Pills --}}
                            @foreach ((array)$selectedCategories as $catKey)
                                @php
                                    $label = $catLabels[$catKey] ?? ucfirst($catKey);
                                    $remainingCats = array_values(array_diff((array)$selectedCategories, [$catKey]));
                                    $removeCatQuery = request()->except('categories', 'category', 'page');
                                    if (!empty($remainingCats)) {
                                        $removeCatQuery['categories'] = $remainingCats;
                                    }
                                    $removeCatUrl = url('/product') . (!empty($removeCatQuery) ? '?' . http_build_query($removeCatQuery) : '');
                                @endphp
                                <a href="{{ $removeCatUrl }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#e0f7fa] text-[#006064] hover:bg-[#b2ebf2] transition group" title="Hapus filter {{ $label }}">
                                    <span>{{ $label }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endforeach

                            {{-- Selected Sizes Pills --}}
                            @foreach ((array)$selectedSizes as $s)
                                @php
                                    $remainingSizes = array_values(array_diff((array)$selectedSizes, [$s]));
                                    $removeSizeQuery = request()->except('size', 'page');
                                    if (!empty($remainingSizes)) {
                                        $removeSizeQuery['size'] = $remainingSizes;
                                    }
                                    $removeSizeUrl = url()->current() . (!empty($removeSizeQuery) ? '?' . http_build_query($removeSizeQuery) : '');
                                @endphp
                                <a href="{{ $removeSizeUrl }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#e0f7fa] text-[#006064] hover:bg-[#b2ebf2] transition group" title="Hapus filter Size {{ $s }}">
                                    <span>Size: {{ $s }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endforeach

                            {{-- Selected Price Range Pill --}}
                            @if (request('min_price') || request('max_price'))
                                @php
                                    $removePriceQuery = request()->except('min_price', 'max_price', 'page');
                                    $removePriceUrl = url()->current() . (!empty($removePriceQuery) ? '?' . http_build_query($removePriceQuery) : '');
                                @endphp
                                <a href="{{ $removePriceUrl }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition" title="Hapus filter harga">
                                    <span>Harga: Rp {{ number_format(request('min_price', 0), 0, ',', '.') }} - {{ request('max_price') ? 'Rp ' . number_format(request('max_price'), 0, ',', '.') : '∞' }}</span>
                                    <svg class="w-3 h-3 ml-1.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- When no filters are active --}}
                            @if (empty($selectedCategories) && empty($selectedSizes) && !request('min_price') && !request('max_price'))
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
                                <a href="{{ route('products.show', $item['id']) }}" class="group bg-white rounded-xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden relative block cursor-pointer">
                                    
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
                                            src="{{ asset($item['image']) }}"
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
                                            <span class="text-xs sm:text-sm font-extrabold text-cyan-800">
                                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                                            </span>
                                            @if (!empty($item['old_price']))
                                                <span class="text-[11px] text-gray-400 line-through">
                                                    Rp {{ number_format($item['old_price'], 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </a>
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
        function toggleSize(size, btn) {
            const container = document.getElementById('sizeInputsContainer');
            if (!container) return;
            
            const existingInput = container.querySelector(`input[value="${size}"]`);
            if (existingInput) {
                existingInput.remove();
                if (btn) {
                    btn.classList.remove('border-cyan-500', 'bg-cyan-50', 'text-cyan-700', 'shadow-xs', 'active-size', 'font-bold');
                    btn.classList.add('border-gray-200', 'text-gray-700', 'hover:border-gray-400', 'bg-white');
                }
            } else {
                const newInput = document.createElement('input');
                newInput.type = 'hidden';
                newInput.name = 'size[]';
                newInput.value = size;
                container.appendChild(newInput);
                if (btn) {
                    btn.classList.add('border-cyan-500', 'bg-cyan-50', 'text-cyan-700', 'shadow-xs', 'active-size', 'font-bold');
                    btn.classList.remove('border-gray-200', 'text-gray-700', 'hover:border-gray-400', 'bg-white');
                }
            }
            // Fitur filter tidak langsung submit otomatis di sini,
            // melainkan aktif setelah pengguna menekan tombol "Apply Filters"
        }

        function toggleMobileFilter() {
            const sidebar = document.getElementById('filterSidebar');
            const stateText = document.getElementById('mobileFilterStateText');
            if (!sidebar) return;

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                if (stateText) stateText.innerHTML = 'Tutup Filter &uarr;';
            } else {
                sidebar.classList.add('hidden');
                if (stateText) stateText.innerHTML = 'Buka Filter &darr;';
            }
        }

        function handleSortChange(sortVal) {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', sortVal);
            currentUrl.searchParams.delete('page');
            window.location.href = currentUrl.toString();
        }
    </script>
</x-layout>
