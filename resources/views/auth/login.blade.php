<x-layout title="Login - SPORTIVIOS">
    <div class="bg-[#f1f5f9] min-h-screen py-10 sm:py-16 flex items-center justify-center px-4 sm:px-6">
        <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 grid grid-cols-1 md:grid-cols-12 min-h-[540px]">

            <!-- Left Side: Dramatic Basketball Hoop Photo (5/6 cols) -->
            <div class="hidden md:block md:col-span-6 lg:col-span-6 relative bg-slate-900 overflow-hidden">
                <img
                    src="{{ asset('images/auth/login-basketball.jpg') }}"
                    alt="Sportivios Basketball"
                    class="w-full h-full object-cover object-center filter brightness-95 contrast-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>

                <!-- Bottom Tagline & Quick Test Account Badges -->
                <div class="absolute bottom-6 left-6 right-6 text-left space-y-2">
                    <span class="text-cyan-400 text-[10px] tracking-widest font-black uppercase drop-shadow-sm block">
                        ELEVATE YOUR GAME
                    </span>
                    <p class="text-xs text-gray-300">
                        Masuk untuk melacak status pesanan, kurir, dan klaim benefit member atlet Sportivios.
                    </p>
                </div>
            </div>

            <!-- Right Side: Login Form (6/7 cols) -->
            <div class="md:col-span-6 lg:col-span-6 p-8 sm:p-10 flex flex-col justify-between">

                <div>
                    <!-- Mini Logo -->
                    <div class="mb-5 flex items-center justify-between">
                        <a href="{{ url('/') }}" class="inline-block">
                            <span class="text-sm font-black font-display tracking-tight text-black">SPORTIVIOS</span>
                        </a>
                        <span class="text-[11px] font-bold text-cyan-700 bg-cyan-50 px-2.5 py-0.5 rounded-full uppercase tracking-wider">ATHLETE AUTH</span>
                    </div>

                    <!-- Title & Subtitle -->
                    <h1 class="text-2xl sm:text-3xl font-black text-[#0F172A] tracking-tight font-display">
                        Login Akun
                    </h1>
                    <p class="text-xs text-gray-500 mt-1 mb-5">
                        Masukkan email dan password terdaftar Anda.
                    </p>

                    <!-- Flash / Error Alerts -->
                    @if (session('warning'))
                        <div class="mb-4 p-3 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-xs">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Quick Demo Credentials Selector -->
                    <div class="mb-4 p-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs space-y-1.5">
                        <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block">Akun Uji Coba Cepat:</span>
                        <div class="flex gap-2">
                            <button
                                type="button"
                                onclick="fillAuth('admin@sportivios.com', 'admin123')"
                                class="px-2.5 py-1 bg-slate-900 hover:bg-slate-800 text-cyan-400 rounded-lg font-bold text-[11px] transition shadow-2xs"
                            >
                                ⚡ Admin
                            </button>
                            <button
                                type="button"
                                onclick="fillAuth('parker@gmail.com', 'password123')"
                                class="px-2.5 py-1 bg-white hover:bg-gray-100 text-gray-800 border border-gray-200 rounded-lg font-bold text-[11px] transition shadow-2xs"
                            >
                                👤 Customer (Peter P.)
                            </button>
                        </div>
                    </div>

                    <!-- Real Login Form (POST) -->
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="loginEmailField"
                                placeholder="name@example.com"
                                value="{{ old('email', 'parker@gmail.com') }}"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600">
                                    Password <span class="text-rose-500">*</span>
                                </label>
                                <a href="#" onclick="alert('Fitur reset password dapat diakses via email administrator.')" class="text-[11px] font-semibold text-cyan-600 hover:underline">
                                    Lupa Password?
                                </a>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="loginPasswordField"
                                placeholder="••••••••"
                                value="password123"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    checked
                                    class="w-4 h-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500 accent-cyan-600"
                                >
                                <label for="remember" class="ml-2 text-xs text-gray-600 cursor-pointer">
                                    Ingat saya di perangkat ini
                                </label>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-3.5 bg-[#0F172A] hover:bg-slate-800 text-white font-black text-xs uppercase tracking-widest rounded-lg transition shadow-md active:scale-98 flex items-center justify-center space-x-2"
                        >
                            <span>MASUK KE SPORTIVIOS</span>
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Footer Link -->
                <div class="mt-6 text-center text-xs text-gray-600">
                    Belum memiliki akun Sportivios?
                    <a href="{{ route('register') }}" class="font-bold text-cyan-700 hover:underline">
                        Daftar Akun Baru
                    </a>
                </div>

            </div>

        </div>
    </div>

    <script>
        function fillAuth(email, pass) {
            document.getElementById('loginEmailField').value = email;
            document.getElementById('loginPasswordField').value = pass;
        }
    </script>
</x-layout>
