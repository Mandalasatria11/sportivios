<x-layout title="Profile Settings - SPORTIVIOS">
    <div class="bg-[#f8fafc] min-h-screen py-8 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back to Home & Flash Alert -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="inline-flex items-center space-x-2 text-xs font-semibold text-gray-700 bg-white hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-lg shadow-2xs transition group">
                    <span class="transform group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Kembali ke Beranda</span>
                </a>

                @if(session('success'))
                    <div class="p-2.5 px-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-xs font-medium flex items-center space-x-2">
                        <span>✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if($errors->any())
                    <div class="p-2.5 px-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-xs font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>

            <!-- Main Layout Grid: Sidebar + Profile Content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

                <!-- Left Sidebar: Profile Settings Menu (3 cols) -->
                <div class="lg:col-span-3 bg-white rounded-2xl border border-gray-100 shadow-xs p-5 space-y-4">

                    <!-- Sidebar Header with Cyan Accent Bar -->
                    <div class="flex items-center space-x-2.5 pb-3 border-b border-gray-100">
                        <div class="w-1.5 h-6 bg-[#0891b2] rounded-full"></div>
                        <h2 class="text-base font-extrabold text-gray-900 tracking-tight">
                            Pengaturan Akun
                        </h2>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="space-y-1.5">
                        <!-- Account Overview (Active) -->
                        <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-bold bg-[#0F172A] text-white shadow-xs transition">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span>Ringkasan Akun</span>
                        </a>

                        <!-- My Orders -->
                        <a href="{{ route('orders') }}" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
                            <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span>Pesanan Saya</span>
                        </a>

                        @if(Auth::check() && Auth::user()->isAdmin())
                            <!-- Admin Dashboard Shortcut -->
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-xs sm:text-sm font-bold text-cyan-800 bg-cyan-50 hover:bg-cyan-100 transition">
                                <span class="text-base">⚡</span>
                                <span>Panel Admin</span>
                            </a>
                        @endif

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="pt-2 border-t border-gray-100">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50 transition">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                <span>Keluar (Logout)</span>
                            </button>
                        </form>
                    </nav>

                </div>

                <!-- Right Main Area (9 cols) -->
                <div class="lg:col-span-9 space-y-6">

                    <!-- Top User Profile Card with Soft Teal Gradient Background -->
                    <div class="bg-gradient-to-r from-[#f0fdfa] via-white to-[#f0f9ff] rounded-2xl border border-gray-100 shadow-xs p-6 sm:p-7 relative overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 relative z-10">

                            <!-- Profile Picture with Badge -->
                            <div class="relative flex-shrink-0">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden border-2 border-white shadow-md bg-slate-900 flex items-center justify-center text-cyan-400 text-3xl font-black">
                                    @if(!empty($user->avatar))
                                        <img
                                            src="{{ asset($user->avatar) }}"
                                            alt="{{ $user->name }}"
                                            class="w-full h-full object-cover"
                                        />
                                    @else
                                        <span>{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                    @endif
                                </div>
                                <span class="absolute bottom-1 right-1 bg-[#8ee0ec] text-[#044e54] text-[10px] font-black tracking-wider px-2 py-0.5 rounded-full uppercase shadow-xs border border-white">
                                    {{ $user->role === 'admin' ? 'ADMIN' : 'MEMBER' }}
                                </span>
                            </div>

                            <!-- Name, Email, and Badges -->
                            <div class="text-center sm:text-left space-y-2">
                                <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight font-display uppercase">
                                    {{ $user->name }}
                                </h1>
                                <p class="text-xs sm:text-sm text-gray-500 font-medium">
                                    {{ $user->email }}
                                </p>

                                <!-- Badges Row -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5 pt-1">
                                    <!-- Role Badge -->
                                    <div class="inline-flex items-center space-x-1.5 bg-[#e0f7fa] border border-[#b2ebf2] text-[#006064] text-xs font-semibold px-3 py-1.5 rounded-lg shadow-2xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                        </svg>
                                        <span>Status: {{ ucfirst($user->role) }}</span>
                                    </div>

                                    <!-- Verification Badge -->
                                    <div class="inline-flex items-center space-x-1.5 bg-[#f1f5f9] border border-gray-200 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-2xs">
                                        <span class="text-emerald-500 font-bold">●</span>
                                        <span>Terdaftar sejak {{ $user->created_at ? $user->created_at->format('M Y') : '2026' }}</span>
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
                                    Informasi Pribadi & Kontak
                                </h3>
                                <button
                                    type="button"
                                    @click="isEditing = !isEditing"
                                    class="inline-flex items-center space-x-1 text-xs font-bold text-cyan-700 hover:text-cyan-900 uppercase tracking-wider transition"
                                >
                                    <svg class="w-3.5 h-3.5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    <span x-text="isEditing ? 'BATAL' : 'UBAH DATA'">UBAH DATA</span>
                                </button>
                            </div>

                            <!-- Real Update Form -->
                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-3.5">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        NAMA LENGKAP <span class="text-rose-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        :readonly="!isEditing"
                                        required
                                        class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        EMAIL (TERDAFTAR)
                                    </label>
                                    <input
                                        type="email"
                                        value="{{ $user->email }}"
                                        readonly
                                        disabled
                                        class="w-full px-3.5 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-xs font-medium text-gray-500 cursor-not-allowed"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                        NOMOR TELEPON / WHATSAPP
                                    </label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{ old('phone', $user->phone ?? '+62 812-3456-7890') }}"
                                        :readonly="!isEditing"
                                        placeholder="+62 8xx-xxxx-xxxx"
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
                                        <span>ALAMAT PENGIRIMAN</span>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">
                                            ALAMAT LENGKAP
                                        </label>
                                        <textarea
                                            name="address"
                                            rows="3"
                                            :readonly="!isEditing"
                                            placeholder="Contoh: Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18, Jakarta Selatan"
                                            class="w-full px-3.5 py-2.5 bg-[#f8fafc] border border-gray-200 rounded-lg text-xs font-medium text-gray-800 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:bg-white"
                                        >{{ old('address', $user->address ?? 'Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802, Jakarta Selatan') }}</textarea>
                                    </div>
                                </div>

                                <div x-show="isEditing" class="pt-2" style="display: none;">
                                    <button
                                        type="submit"
                                        class="w-full py-2.5 bg-[#0F172A] hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider rounded-lg transition shadow-sm"
                                    >
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                        </div>

                        <!-- Right: Recent Orders Card -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs p-6 space-y-5">

                            <!-- Card Header -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <h3 class="text-sm font-extrabold text-gray-900 tracking-tight">
                                    Pesanan Terbaru
                                </h3>
                                <a href="{{ route('orders') }}" class="inline-flex items-center text-xs font-bold text-cyan-700 hover:text-cyan-900 uppercase tracking-wider transition group">
                                    <span>LIHAT SEMUA</span>
                                    <span class="ml-1 transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </a>
                            </div>

                            <!-- Orders List -->
                            <div class="space-y-4">
                                @forelse($orders as $order)
                                    <div class="border border-gray-100 rounded-xl p-4 bg-white hover:border-gray-200 hover:shadow-2xs transition">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="text-xs font-extrabold text-gray-900">
                                                #{{ $order->invoice_code ?? 'SPV-' . $order->id }}
                                            </div>
                                            @php
                                                $status = $order->status ?? 'diproses';
                                                $badgeStyle = match($status) {
                                                    'selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    'dalam_perjalanan' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
                                                    'dibatalkan' => 'bg-rose-100 text-rose-800 border-rose-200',
                                                    default => 'bg-amber-100 text-amber-800 border-amber-200'
                                                };
                                            @endphp
                                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider border {{ $badgeStyle }}">
                                                {{ str_replace('_', ' ', $status) }}
                                            </span>
                                        </div>
                                        <p class="text-[11px] text-gray-400 mb-2">
                                            {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : 'Baru saja' }}
                                        </p>

                                        <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-gray-50 rounded-lg border border-gray-100 p-1 flex-shrink-0 flex items-center justify-center">
                                                    <img
                                                        src="{{ asset($order->product->image ?? 'images/products/shoe.jpg') }}"
                                                        alt="{{ $order->product->name ?? 'Product' }}"
                                                        class="w-full h-full object-contain"
                                                    >
                                                </div>
                                                <div>
                                                    <h4 class="text-xs font-bold text-gray-900 line-clamp-1">
                                                        {{ $order->product->name ?? 'Sportivios Athletic Product' }}
                                                    </h4>
                                                    <p class="text-[11px] text-gray-500">Jumlah: {{ $order->quantity ?? 1 }} pcs</p>
                                                </div>
                                            </div>
                                            <div class="text-xs font-black text-gray-900">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        <div class="mt-3 flex items-center justify-between text-[11px] font-bold">
                                            @if(!empty($order->resi))
                                                <span class="text-gray-500">Resi: <span class="text-slate-900 font-mono">{{ $order->resi }}</span></span>
                                            @else
                                                <span class="text-gray-400 font-normal">Resi segera diperbarui</span>
                                            @endif
                                            <a href="{{ route('tracking', $order->invoice_code ?? $order->id) }}" class="text-cyan-700 hover:underline">
                                                Lacak Pesanan &rarr;
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 px-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                        <p class="text-xs text-gray-500 mb-3">Belum ada transaksi pesanan.</p>
                                        <a href="{{ route('katalog') }}" class="inline-flex px-3 py-1.5 bg-[#0F172A] hover:bg-slate-800 text-white text-xs font-bold rounded-lg transition">
                                            Belanja Sekarang
                                        </a>
                                    </div>
                                @endforelse
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layout>
