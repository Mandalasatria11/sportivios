<x-layout title="Profile Settings - SPORTIVIOS">
    <div class="bg-[#f8fafc] min-h-screen py-8 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Back to Home Button -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-gray-700 bg-white hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-lg shadow-2xs transition group">
                    <span class="transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Back to Home</span>
                </a>
            </div>

            <!-- Main Layout Grid: Sidebar + Profile Content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- Left Sidebar: Profile Settings Menu (3 cols) -->
                <div class="lg:col-span-3 bg-white rounded-2xl border border-gray-100 shadow-xs p-5 space-y-4">
                    
                    <!-- Sidebar Header with Cyan Accent Bar -->
                    <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100">
                        <div class="w-1.5 h-6 bg-[#0891b2] rounded-full"></div>
                        <h2 class="text-base font-extrabold text-gray-900 tracking-tight">
                            Profile Settings
                        </h2>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="space-y-1.5">
                        <!-- Account Overview (Active) -->
                        <a href="{{ url('/profile') }}" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-bold bg-[#0F172A] text-white shadow-xs transition">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span>Account Overview</span>
                        </a>

                        <!-- My Orders -->
                        <a href="{{ url('/orders') }}" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
                            <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span>My Orders</span>
                        </a>

                        <!-- Payment Methods -->
                        <a href="#payment-methods" onclick="alert('Dummy notice: Payment methods management is ready for integration.')" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
                            <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            <span>Payment Methods</span>
                        </a>

                        <!-- Settings -->
                        <a href="#settings" onclick="alert('Dummy notice: Profile & notification preferences ready.')" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
                            <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </a>
                    </nav>

                </div>

                <!-- Right Main Area (9 cols) -->
                <div class="lg:col-span-9 space-y-6">
                    
                    <!-- Top User Profile Card with Soft Teal Gradient Background -->
                    <div class="bg-gradient-to-r from-[#f0fdfa] via-white to-[#f0f9ff] rounded-2xl border border-gray-100 shadow-xs p-6 sm:p-7 relative overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-center sm:items-center space-y-4 sm:space-y-0 sm:space-x-6 relative z-10">
                            
                            <!-- Profile Picture with "PRO" Badge on bottom right -->
                            <div class="relative flex-shrink-0">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden border-2 border-white shadow-md bg-gray-900">
                                    <img 
                                        src="{{ $user['avatar'] ?? asset('images/users/peter-parker.jpg') }}" 
                                        alt="{{ $user['name'] }}" 
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <span class="absolute bottom-1 right-1 bg-[#8ee0ec] text-[#044e54] text-[10px] font-black tracking-wider px-2 py-0.5 rounded-full uppercase shadow-xs border border-white">
                                    PRO
                                </span>
                            </div>

                            <!-- Name, Email, and Badges -->
                            <div class="text-center sm:text-left space-y-2">
                                <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight font-display uppercase">
                                    {{ $user['display_name'] ?? 'PETER PARKER' }}
                                </h1>
                                <p class="text-xs sm:text-sm text-gray-500 font-medium">
                                    {{ $user['email'] ?? 'parker@gmail.com' }}
                                </p>

                                <!-- Badges Row -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5 pt-1">
                                    <!-- Pro Member Badge -->
                                    <div class="inline-flex items-center space-x-1.5 bg-[#e0f7fa] border border-[#b2ebf2] text-[#006064] text-xs font-semibold px-3 py-1.5 rounded-lg shadow-2xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                        </svg>
                                        <span>{{ $user['membership'] ?? "Pro Member Since '22" }}</span>
                                    </div>

                                    <!-- Points Badge -->
                                    <div class="inline-flex items-center space-x-1.5 bg-[#f1f5f9] border border-gray-200 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-2xs">
                                        <svg class="w-3.5 h-3.5 text-amber-500 fill-amber-500" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>{{ $user['points'] ?? '2,450 Points' }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Bottom Grid: Personal Information (Left) & Recent Orders (Right) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                        
                        <!-- Left: Personal Information Card -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs p-6 space-y-5" x-data="{ isEditing: false }">
                            
                            <!-- Card Header -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <h3 class="text-sm font-extrabold text-gray-900 tracking-tight">
                                    Personal Information
                                </h3>
                                <button 
                                    type="button" 
                                    @click="isEditing = !isEditing"
                                    class="inline-flex items-center space-x-1 text-xs font-bold text-gray-600 hover:text-black uppercase tracking-wider transition"
                                >
                                    <svg class="w-3.5 h-3.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    <span x-text="isEditing ? 'SAVE' : 'EDIT'">EDIT</span>
                                </button>
                            </div>

                            <!-- Form Fields Matching Screenshot -->
                            <div class="space-y-3.5">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        FULL NAME
                                    </label>
                                    <input 
                                        type="text" 
                                        value="{{ $user['name'] ?? 'Andrew AKA Peter Parker' }}" 
                                        :readonly="!isEditing"
                                        class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        EMAIL ADDRESS
                                    </label>
                                    <input 
                                        type="email" 
                                        value="{{ $user['email'] ?? 'parker@gmail.com' }}" 
                                        :readonly="!isEditing"
                                        class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        PHONE NUMBER
                                    </label>
                                    <input 
                                        type="text" 
                                        value="{{ $user['phone'] ?? '+1 (555) 019-2834' }}" 
                                        :readonly="!isEditing"
                                        class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                    >
                                </div>

                                <!-- Shipping Address Sub-Section -->
                                <div class="pt-2 border-t border-gray-100">
                                    <div class="flex items-center space-x-1.5 text-[#0891b2] text-[11px] font-bold uppercase tracking-wider mb-2.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span>SHIPPING ADDRESS</span>
                                    </div>

                                    <div class="space-y-2.5">
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                                STREET ADDRESS
                                            </label>
                                            <input 
                                                type="text" 
                                                value="{{ $user['address']['street'] ?? 'Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802' }}" 
                                                :readonly="!isEditing"
                                                class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                            >
                                        </div>

                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                                    CITY / DISTRICT
                                                </label>
                                                <input 
                                                    type="text" 
                                                    value="{{ $user['address']['city'] ?? 'Jakarta Selatan' }}" 
                                                    :readonly="!isEditing"
                                                    class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                                    POSTAL CODE
                                                </label>
                                                <input 
                                                    type="text" 
                                                    value="{{ $user['address']['postal_code'] ?? '12930' }}" 
                                                    :readonly="!isEditing"
                                                    class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right: Recent Orders Card -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs p-6 space-y-5">
                            
                            <!-- Card Header -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <h3 class="text-sm font-extrabold text-gray-900 tracking-tight">
                                    Recent Orders
                                </h3>
                                <a href="{{ url('/orders') }}" class="inline-flex items-center text-xs font-bold text-gray-600 hover:text-black uppercase tracking-wider transition group">
                                    <span>VIEW ALL</span>
                                    <span class="ml-1 transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </a>
                            </div>

                            <!-- Orders List Matching Screenshot -->
                            <div class="space-y-4">
                                
                                <!-- Order 1: Shipped -->
                                <div class="border border-gray-100 rounded-xl p-4 bg-white hover:border-gray-200 hover:shadow-2xs transition">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="text-xs font-extrabold text-gray-900">
                                            ORDER #SP-8829
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-cyan-100 text-cyan-800 border border-cyan-200">
                                            SHIPPED
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mb-3">Oct 24, 2024</p>
                                    
                                    <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-gray-50 rounded-lg border border-gray-100 p-1 flex-shrink-0 flex items-center justify-center">
                                                <img src="{{ asset('images/products/shoe.jpg') }}" alt="AeroSprint Pro Runners" class="w-full h-full object-contain">
                                            </div>
                                            <div>
                                                <h4 class="text-xs font-bold text-gray-900">AeroSprint Pro Runners</h4>
                                                <p class="text-[11px] text-gray-500">Size 10.5</p>
                                            </div>
                                        </div>
                                        <div class="text-sm font-extrabold text-gray-900">
                                            $145.00
                                        </div>
                                    </div>
                                    <div class="mt-3 text-right">
                                        <a href="{{ url('/orders/SPV-894210') }}" class="text-[11px] font-bold text-cyan-700 hover:underline">
                                            Track Order &rarr;
                                        </a>
                                    </div>
                                </div>

                                <!-- Order 2: Delivered -->
                                <div class="border border-gray-100 rounded-xl p-4 bg-white hover:border-gray-200 hover:shadow-2xs transition">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="text-xs font-extrabold text-gray-900">
                                            ORDER #SP-7401
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            DELIVERED
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mb-3">Sep 12, 2024</p>
                                    
                                    <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                                        <div class="text-xs text-gray-600 font-medium">
                                            2 Items
                                        </div>
                                        <div class="text-sm font-extrabold text-gray-900">
                                            $85.50
                                        </div>
                                    </div>
                                    <div class="mt-3 text-right">
                                        <a href="{{ url('/orders/SPV-882049') }}" class="text-[11px] font-bold text-cyan-700 hover:underline">
                                            View Details &rarr;
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layout>
