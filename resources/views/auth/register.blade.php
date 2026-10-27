<x-layout title="Join the Team - SPORTIVIOS">
    <div class="bg-[#f1f5f9] min-h-screen py-10 sm:py-16 flex items-center justify-center px-4 sm:px-6">
        <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 grid grid-cols-1 md:grid-cols-12 min-h-[580px]">
            
            <!-- Left Side: Registration Form (7 cols) -->
            <div class="md:col-span-6 lg:col-span-6 p-8 sm:p-10 flex flex-col justify-between">
                
                <div>
                    <!-- Mini Logo -->
                    <div class="mb-6">
                        <a href="{{ url('/') }}" class="inline-block">
                            <span class="text-sm font-black font-display tracking-tight text-black">SPORTIVIOS</span>
                        </a>
                    </div>

                    <!-- Title & Subtitle -->
                    <h1 class="text-2xl sm:text-3xl font-black text-[#0F172A] tracking-tight font-display">
                        Join the Team
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 mb-5">
                        Start your performance journey with SPORTIVIOS.
                    </p>

                    <!-- Error Alerts -->
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Register Form -->
                    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                FULL NAME <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Alex Runner"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                EMAIL ADDRESS <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="alex@example.com"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                PASSWORD <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="password"
                                name="password"
                                placeholder="•••••••• (min. 6 karakter)"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-600 mb-1">
                                CONFIRM PASSWORD <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition"
                            >
                        </div>

                        <div class="flex items-center pt-1">
                            <input
                                type="checkbox"
                                name="terms"
                                id="terms"
                                value="1"
                                required
                                class="w-4 h-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500 accent-cyan-600"
                            >
                            <label for="terms" class="ml-2 text-xs text-gray-600 cursor-pointer">
                                I agree to the <a href="#" class="underline text-gray-900 font-semibold hover:text-cyan-600">Terms and Conditions</a>.
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-3.5 bg-[#0F172A] hover:bg-slate-800 text-white font-black text-xs uppercase tracking-widest rounded-lg transition shadow-md active:scale-98"
                        >
                            REGISTER
                        </button>
                    </form>
                </div>

                <!-- Footer Link -->
                <div class="mt-6 text-center text-xs text-gray-600">
                    Already have an account? 
                    <a href="{{ url('/login') }}" class="font-bold text-[#0F172A] hover:underline">
                        Login
                    </a>
                </div>

            </div>

            <!-- Right Side: Black and White Sprinter Track Photo (5 cols or 6 cols) -->
            <div class="hidden md:block md:col-span-6 lg:col-span-6 relative bg-slate-900 overflow-hidden">
                <img 
                    src="{{ asset('images/auth/register-track.jpg') }}" 
                    alt="Sportivios Athlete Sprinter" 
                    class="w-full h-full object-cover object-center filter grayscale contrast-125"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20"></div>
                
                <!-- Corner Watermark -->
                <div class="absolute bottom-6 right-6 text-right">
                    <span class="text-white/60 text-[10px] tracking-widest font-black uppercase">
                        PERFORMANCE FIRST
                    </span>
                </div>
            </div>

        </div>
    </div>
</x-layout>
