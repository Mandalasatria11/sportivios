<header class="w-full bg-white sticky top-0 z-50 border-b border-gray-100 shadow-[0_1px_3px_rgba(0,0,0,0.03)]" x-data="navHandler()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16">
            
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-xl sm:text-2xl font-black tracking-tight text-black font-display hover:opacity-90 transition flex items-center">
                    <span>SPORTIVIOS</span>
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <nav class="hidden md:flex items-center space-x-8 lg:space-x-12">
                @php
                    $isShoes = request()->is('product/shoes*') || request('category') === 'shoes';
                    $isApparel = request()->is('product/apparel*') || request('category') === 'apparel';
                    $isAccessories = request()->is('product/accessories*') || request()->is('product/accecoris*') || request('category') === 'accessories';
                @endphp
                
                <a href="{{ url('/product/shoes') }}" class="text-xs sm:text-sm font-semibold transition pb-1 border-b-2 {{ $isShoes ? 'text-black border-cyan-500 font-bold' : 'text-gray-700 hover:text-black border-transparent' }}">
                    Shoes
                </a>
                <a href="{{ url('/product/apparel') }}" class="text-xs sm:text-sm font-semibold transition pb-1 border-b-2 {{ $isApparel ? 'text-black border-cyan-500 font-bold' : 'text-gray-700 hover:text-black border-transparent' }}">
                    Apparel
                </a>
                <a href="{{ url('/product/accessories') }}" class="text-xs sm:text-sm font-semibold transition pb-1 border-b-2 {{ $isAccessories ? 'text-black border-cyan-500 font-bold' : 'text-gray-700 hover:text-black border-transparent' }}">
                    Accessories
                </a>
            </nav>

            <!-- Right: Icons (Search, User Auth, Cart) & Mobile Hamburger -->
            <div class="flex items-center space-x-3 sm:space-x-4 text-gray-900">
                
                <!-- Search Button -->
                <button 
                    type="button" 
                    onclick="toggleSearchModal()"
                    class="p-1.5 text-gray-700 hover:text-cyan-600 transition rounded-full hover:bg-gray-100"
                    aria-label="Search"
                >
                    <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                </button>

                <!-- User Account / Login & Register Button -->
                <div class="relative">
                    <button 
                        type="button" 
                        onclick="toggleAuthModal()" 
                        class="flex items-center space-x-1.5 p-1.5 text-gray-700 hover:text-cyan-600 transition rounded-full hover:bg-gray-100"
                        id="userAuthBtn"
                        aria-label="User Account"
                    >
                        <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                        <span id="navUserBadge" class="hidden text-xs font-semibold text-gray-900 max-w-[90px] truncate sm:inline-block">Alex J.</span>
                    </button>
                </div>

                <!-- Shopping Cart Icon with Dummy Badge -->
                <a href="{{ url('/cart') }}" class="relative p-1.5 text-gray-700 hover:text-cyan-600 transition rounded-full hover:bg-gray-100" aria-label="Cart">
                    <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.7 2.404-6.326A1.125 1.125 0 0019.25 6.75H5.106M7.5 14.25L5.106 6.75m0 0L4.1 3M9 20.25a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0zm10.5 0a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0z" />
                    </svg>
                    <span class="absolute top-0.5 right-0.5 w-4 h-4 bg-cyan-500 text-slate-950 font-black text-[9px] flex items-center justify-center rounded-full">2</span>
                </a>

                <!-- Mobile Menu Button -->
                <button 
                    type="button" 
                    onclick="toggleMobileMenu()" 
                    class="md:hidden p-1.5 text-gray-700 hover:text-black rounded-lg hover:bg-gray-100"
                    aria-label="Toggle Navigation"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-gray-100 py-3 space-y-1">
            <a href="{{ url('/product/shoes') }}" class="block px-3 py-2 text-sm font-semibold rounded-md {{ $isShoes ? 'bg-cyan-50 text-cyan-800' : 'text-gray-700 hover:bg-gray-50' }}">
                Shoes
            </a>
            <a href="{{ url('/product/apparel') }}" class="block px-3 py-2 text-sm font-semibold rounded-md {{ $isApparel ? 'bg-cyan-50 text-cyan-800' : 'text-gray-700 hover:bg-gray-50' }}">
                Apparel
            </a>
            <a href="{{ url('/product/accessories') }}" class="block px-3 py-2 text-sm font-semibold rounded-md {{ $isAccessories ? 'bg-cyan-50 text-cyan-800' : 'text-gray-700 hover:bg-gray-50' }}">
                Accessories
            </a>
            <div class="pt-2 border-t border-gray-100 mt-2 flex items-center justify-between px-3">
                <button onclick="toggleAuthModal()" class="text-xs font-bold text-cyan-700 hover:underline">
                    Login / Register (Dummy)
                </button>
                <a href="{{ url('/product') }}" class="text-xs text-gray-500">
                    View All Shop
                </a>
            </div>
        </div>

    </div>

    <!-- Sporty Decorative Blue Border Strip -->
    <div class="header-blue-texture"></div>

    <!-- Search Overlay Modal -->
    <div id="searchModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-start justify-center pt-20 px-4">
        <div class="bg-white w-full max-w-xl rounded-2xl shadow-2xl p-5 border border-gray-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Search Products</h3>
                <button onclick="toggleSearchModal()" class="text-gray-400 hover:text-gray-600 text-lg font-bold">&times;</button>
            </div>
            <form action="{{ url('/product') }}" method="GET" class="mt-4">
                <div class="relative">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Search shoes, tech tee, tights, gloves..." 
                        class="w-full pl-10 pr-24 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:bg-white"
                        autofocus
                    >
                    <svg class="w-5 h-5 absolute left-3.5 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <button type="submit" class="absolute right-2 top-2 px-4 py-1.5 bg-black hover:bg-gray-800 text-white rounded-lg text-xs font-bold transition">
                        Search
                    </button>
                </div>
            </form>
            <div class="mt-4 flex flex-wrap gap-2 text-xs text-gray-500">
                <span class="font-medium text-gray-400">Popular:</span>
                <a href="{{ url('/product/shoes') }}" class="px-2 py-1 bg-gray-100 hover:bg-cyan-50 hover:text-cyan-700 rounded-md transition">Running Shoes</a>
                <a href="{{ url('/product/apparel') }}" class="px-2 py-1 bg-gray-100 hover:bg-cyan-50 hover:text-cyan-700 rounded-md transition">Compression Tight</a>
                <a href="{{ url('/product/accessories') }}" class="px-2 py-1 bg-gray-100 hover:bg-cyan-50 hover:text-cyan-700 rounded-md transition">Smart Flask</a>
            </div>
        </div>
    </div>

    <!-- Auth (Login / Register) Modal with Dummy Data -->
    <div id="authModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 sm:p-7 border border-gray-100 relative">
            
            <!-- Close Button -->
            <button onclick="toggleAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl font-bold w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
                &times;
            </button>

            <!-- Brand Header -->
            <div class="text-center mb-6">
                <span class="text-xl font-black font-display tracking-tight text-black">SPORTIVIOS</span>
                <p class="text-xs text-gray-500 mt-1">Athlete Club &amp; Performance Account</p>
            </div>

            <!-- Login / Register Tabs -->
            <div class="flex border-b border-gray-200 mb-5">
                <button 
                    type="button" 
                    id="tabLoginBtn" 
                    onclick="switchAuthTab('login')" 
                    class="flex-1 pb-3 text-xs sm:text-sm font-bold border-b-2 border-cyan-500 text-cyan-600 transition"
                >
                    Sign In
                </button>
                <button 
                    type="button" 
                    id="tabRegisterBtn" 
                    onclick="switchAuthTab('register')" 
                    class="flex-1 pb-3 text-xs sm:text-sm font-semibold border-b-2 border-transparent text-gray-400 hover:text-gray-700 transition"
                >
                    Create Account
                </button>
            </div>

            <!-- Notice: Dummy Data State & Quick Links -->
            <div class="mb-4 bg-cyan-50/70 border border-cyan-200 text-cyan-800 px-3 py-2 rounded-lg text-xs flex items-center justify-between">
                <span>💡 <strong>Dummy Demo Mode</strong>: Form siap diuji coba.</span>
                <button type="button" onclick="fillDummyData()" class="underline font-bold text-[11px] ml-2 text-cyan-900 hover:text-cyan-700">
                    Auto-Fill
                </button>
            </div>

            <!-- Quick Frontend Page Shortcuts -->
            <div class="mb-4 p-2 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-around text-xs font-semibold text-gray-700">
                <a href="{{ url('/orders') }}" class="hover:text-cyan-700 flex items-center">
                    <span class="mr-1">🚚</span> Order History
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ url('/cart') }}" class="hover:text-cyan-700 flex items-center">
                    <span class="mr-1">🛒</span> My Cart
                </a>
            </div>

            <!-- Tab Content: LOGIN FORM -->
            <div id="loginTabContent" class="space-y-4">
                <form id="dummyLoginForm" onsubmit="handleDummyAuth(event, 'login')">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            id="loginEmail" 
                            value="alex.johnson@sportivios.com"
                            required
                            class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold text-gray-700">Password</label>
                            <a href="#" onclick="alert('Dummy notice: Password reset link sent to dummy email.')" class="text-[11px] text-cyan-600 hover:underline">Forgot?</a>
                        </div>
                        <input 
                            type="password" 
                            id="loginPassword" 
                            value="sports12345"
                            required
                            class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                    </div>

                    <div class="mt-3 flex items-center">
                        <input type="checkbox" id="rememberMe" checked class="w-3.5 h-3.5 text-cyan-600 rounded border-gray-300 accent-cyan-600">
                        <label for="rememberMe" class="ml-2 text-xs text-gray-600">Remember this device</label>
                    </div>

                    <button 
                        type="submit" 
                        class="mt-5 w-full py-2.5 bg-black hover:bg-gray-800 text-white font-bold text-xs sm:text-sm rounded-lg transition shadow-md flex items-center justify-center space-x-2"
                    >
                        <span>Sign In to SPORTIVIOS</span>
                    </button>
                </form>
            </div>

            <!-- Tab Content: REGISTER FORM -->
            <div id="registerTabContent" class="hidden space-y-4">
                <form id="dummyRegisterForm" onsubmit="handleDummyAuth(event, 'register')">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Full Name</label>
                        <input 
                            type="text" 
                            id="regName" 
                            placeholder="e.g. Alex Johnson"
                            value="Alex Johnson"
                            required
                            class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                    </div>
                    <div class="mt-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            id="regEmail" 
                            placeholder="athlete@example.com"
                            value="alex.johnson@sportivios.com"
                            required
                            class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                    </div>
                    <div class="mt-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Primary Sport / Focus</label>
                        <select id="regSport" class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option>Running &amp; Marathon</option>
                            <option>Gym &amp; Crossfit Training</option>
                            <option>Football &amp; Team Sports</option>
                            <option>Outdoor &amp; Trail</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            id="regPassword" 
                            placeholder="••••••••"
                            value="athlete2026"
                            required
                            class="w-full px-3.5 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="mt-5 w-full py-2.5 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs sm:text-sm rounded-lg transition shadow-md flex items-center justify-center space-x-2"
                    >
                        <span>Create Performance Account</span>
                    </button>
                </form>
            </div>

            <!-- Simulated Logged In State Notification -->
            <div id="dummyAuthSuccess" class="hidden mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg text-xs text-emerald-800 text-center font-medium">
                ✅ Berhasil masuk sebagai <strong>Alex Johnson</strong> (Pro Athlete Member)
            </div>

        </div>
    </div>
</header>

<script>
    function toggleSearchModal() {
        const modal = document.getElementById('searchModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }

    function toggleAuthModal() {
        const modal = document.getElementById('authModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }

    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }

    function switchAuthTab(tab) {
        const loginContent = document.getElementById('loginTabContent');
        const regContent = document.getElementById('registerTabContent');
        const loginBtn = document.getElementById('tabLoginBtn');
        const regBtn = document.getElementById('tabRegisterBtn');

        if (tab === 'login') {
            loginContent.classList.remove('hidden');
            regContent.classList.add('hidden');
            loginBtn.className = "flex-1 pb-3 text-xs sm:text-sm font-bold border-b-2 border-cyan-500 text-cyan-600 transition";
            regBtn.className = "flex-1 pb-3 text-xs sm:text-sm font-semibold border-b-2 border-transparent text-gray-400 hover:text-gray-700 transition";
        } else {
            loginContent.classList.add('hidden');
            regContent.classList.remove('hidden');
            regBtn.className = "flex-1 pb-3 text-xs sm:text-sm font-bold border-b-2 border-cyan-500 text-cyan-600 transition";
            loginBtn.className = "flex-1 pb-3 text-xs sm:text-sm font-semibold border-b-2 border-transparent text-gray-400 hover:text-gray-700 transition";
        }
    }

    function fillDummyData() {
        document.getElementById('loginEmail').value = 'alex.johnson@sportivios.com';
        document.getElementById('loginPassword').value = 'sports12345';
        document.getElementById('regName').value = 'Alex Johnson';
        document.getElementById('regEmail').value = 'alex.johnson@sportivios.com';
        document.getElementById('regPassword').value = 'sports12345';
        alert('Dummy credentials loaded: alex.johnson@sportivios.com');
    }

    function handleDummyAuth(e, action) {
        e.preventDefault();
        const successBox = document.getElementById('dummyAuthSuccess');
        const navBadge = document.getElementById('navUserBadge');
        
        let name = action === 'login' ? 'Alex Johnson' : document.getElementById('regName').value;
        successBox.innerHTML = `✅ Sukses ${action === 'login' ? 'Masuk' : 'Daftar'}! Selamat datang <strong>${name}</strong> (Athlete Pro Member)`;
        successBox.classList.remove('hidden');
        
        if (navBadge) {
            navBadge.textContent = name.split(' ')[0] + ' ✓';
            navBadge.classList.remove('hidden');
        }

        setTimeout(() => {
            toggleAuthModal();
            successBox.classList.add('hidden');
        }, 1500);
    }
</script>
