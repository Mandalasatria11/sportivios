@props([
    'id' => null,
    'href' => null,
    'badge' => null,
    'badgeType' => 'cyan', // 'cyan' or 'red'
    'image' => '',
    'alt' => '',
    'rating' => 5,
    'reviews' => '0',
    'title' => '',
    'price' => '',
    'oldPrice' => null,
])

@php
    $targetUrl = $href ?? ($id ? url('/product/detail/' . $id) : url('/product/detail/1'));
@endphp

<a href="{{ $targetUrl }}" class="group bg-white rounded-lg border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden relative block cursor-pointer">
    
    <!-- Image & Badge Container -->
    <div class="relative w-full aspect-square bg-[#f8f9fa] flex items-center justify-center p-6 overflow-hidden">
        <!-- Badge (Top Left) -->
        @if ($badge)
            <div class="absolute top-2.5 left-2.5 z-10">
                @if ($badgeType === 'red')
                    <span class="inline-block bg-[#b91c1c] text-white text-[9px] sm:text-[10px] font-bold px-2 py-0.5 rounded-xs uppercase tracking-wider shadow-xs">
                        {{ $badge }}
                    </span>
                @else
                    <span class="inline-block bg-[#8ee0ec]/60 text-[#044e54] text-[10px] sm:text-[11px] font-bold px-2 py-0.5 rounded-xs uppercase tracking-wider shadow-xs">
                        {{ $badge }}
                    </span>
                @endif
            </div>
        @endif

        <!-- Product Image -->
        <img 
            src="{{ $image }}" 
            alt="{{ $alt ?: $title }}" 
            class="w-full h-full object-contain object-center transform group-hover:scale-108 transition-transform duration-500 ease-out"
            loading="lazy"
        />
    </div>

    <!-- Product Info (Bottom) -->
    <div class="p-3.5 sm:p-4 flex flex-col flex-grow justify-between bg-white border-t border-gray-50">
        <div>
            <!-- Star Rating & Review Count -->
            <div class="flex items-center space-x-1 mb-1.5">
                <div class="flex items-center text-[#74d7e6]">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-[11px] sm:text-xs text-gray-400 font-medium ml-1">
                    ({{ $reviews }})
                </span>
            </div>

            <!-- Product Title -->
            <h3 class="text-xs sm:text-sm font-bold text-gray-900 tracking-tight group-hover:text-blue-600 transition line-clamp-1">
                {{ $title }}
            </h3>
        </div>

        <!-- Price Container -->
        <div class="mt-2 flex items-baseline space-x-2">
            @if ($oldPrice)
                <span class="text-sm sm:text-base font-bold text-[#b91c1c]">
                    {{ $price }}
                </span>
                <span class="text-xs text-gray-400 line-through">
                    {{ $oldPrice }}
                </span>
            @else
                <span class="text-sm sm:text-base font-bold text-gray-900">
                    {{ $price }}
                </span>
            @endif
        </div>
    </div>

</a>
