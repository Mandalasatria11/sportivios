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
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20"></div>

                <!-- Bottom Tagline -->
                <div class="absolute bottom-6 left-6 text-left">
                    <span class="text-white/80 text-[10px] tracking-widest font-black uppercase drop-shadow-sm">
                        ELEVATE YOUR GAME
                    </span>
                </div>
            </div>

            <!-- Right Side: Login Form (6/7 cols) -->
            <div class="md:col-span-6 lg:col-span-6 p-8 sm:p-10 flex flex-col justify-between">
                
                <div>
                    <!-- Mini Logo -->
                    <div class="mb-6 flex items-center justify-between">
                        <a href="{{ url('/') }}" class="inline-block">
                            <span class="text-sm font-black font-display tracking-tight text-black">SPORTIVIOS</span>
                        </a>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">ATHLETE ID</span>
                    </div>

                    <!-- Title & Subtitle -->
                    <h1 class="text-2xl sm:text-3xl font-black text-[#0F172A] tracking-tight font-display">
                        Login
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 mb-6">
                        Welcome back! Please enter your details.
                    </p>

                    <!-- Login Form -->
                    <form action="{{ url('/profile') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                Email or Username
                            </label>
                            <input 
                                type="text" 
                                placeholder="Enter your email" 
                                value="parker@gmail.com"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#0F172A] focus:border-[#0F172A] transition"
                            >
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                Password
                            </label>
                            <input 
                                type="password" 
                                placeholder="••••••••" 
                                value="password123"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#0F172A] focus:border-[#0F172A] transition"
                            >
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="remember" 
                                    checked
                                    class="w-4 h-4 rounded border-gray-300 text-[#0F172A] focus:ring-[#0F172A] accent-[#0F172A]"
                                >
                                <label for="remember" class="ml-2 text-xs text-gray-600 cursor-pointer">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" onclick="alert('Dummy notice: Link reset password dikirim ke email.')" class="text-xs font-semibold text-gray-700 hover:text-black">
                                Forgot Password?
                            </a>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-3.5 bg-[#0F172A] hover:bg-slate-800 text-white font-black text-xs uppercase tracking-widest rounded-lg transition shadow-md active:scale-98"
                        >
                            LOGIN
                        </button>
                    </form>
                </div>

                <!-- Footer Link -->
                <div class="mt-6 text-center text-xs text-gray-600">
                    Don't have an account? 
                    <a href="{{ url('/register') }}" class="font-bold text-[#0F172A] hover:underline">
                        Sign up
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-layout>
