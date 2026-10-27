<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Tampilkan katalog seluruh produk (Filter Kategori, Pencarian, Sorting, dan Paginasi)
     * Menggunakan Database Eloquent ORM.
     */
    public function index(Request $request, ?string $category = null)
    {
        // Handle route category parameter atau direct ID
        if (in_array($category, ['shoes', 'apparel', 'accessories', 'accecoris'])) {
            if ($category === 'accecoris') {
                $category = 'accessories';
            }
        } elseif (is_numeric($category)) {
            return $this->show((int)$category);
        }

        $query = Product::query();

        // 1. Filter Kategori
        $selectedCategories = [];
        if ($request->has('categories')) {
            $rawCats = is_array($request->categories) ? $request->categories : explode(',', $request->categories);
            $selectedCategories = array_values(array_filter($rawCats));
            $query->whereIn('category', $selectedCategories);
        } elseif ($request->has('category')) {
            $selectedCategories = [$request->category];
            $query->where('category', $request->category);
        } elseif ($category) {
            $selectedCategories = [$category];
            $query->where('category', $category);
        }

        // 2. Pencarian Nama, Kategori, atau Deskripsi
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sub_category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 3. Filter Rentang Harga
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice !== null && is_numeric($minPrice)) {
            $query->where('price', '>=', (float)$minPrice);
        }
        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $query->where('price', '<=', (float)$maxPrice);
        }

        // 4. Filter Ukuran (Size)
        $selectedSizes = array_filter((array)$request->input('size', []));
        if (!empty($selectedSizes)) {
            $query->where(function ($q) use ($selectedSizes) {
                foreach ($selectedSizes as $sz) {
                    $q->orWhere('sizes', 'like', "%{$sz}%");
                }
            });
        }

        // 5. Pengurutan (Sorting)
        $sort = $request->input('sort', 'recommended');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'recommended':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(8)->withQueryString();

        $categoryTitles = [
            'shoes' => 'Shoes Collection',
            'apparel' => 'Apparel Collection',
            'accessories' => 'Accessories Collection',
        ];

        if ($category) {
            $currentCategoryTitle = $categoryTitles[$category] ?? ucfirst($category);
        } elseif (count($selectedCategories) === 1) {
            $firstCat = strtolower($selectedCategories[0]);
            $currentCategoryTitle = $categoryTitles[$firstCat] ?? ucfirst($firstCat) . ' Collection';
        } else {
            $currentCategoryTitle = 'Performance Gear';
        }

        return view('products.index', [
            'products' => $products,
            'currentCategory' => $category,
            'currentCategoryTitle' => $currentCategoryTitle,
            'selectedCategories' => $selectedCategories,
            'selectedSizes' => (array)$request->input('size', []),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'currentSort' => $sort,
            'searchQuery' => $request->input('q', ''),
            'totalCount' => $products->total(),
        ]);
    }

    /**
     * Tampilkan katalog produk untuk modul LKPD Praktikum (Eloquent ORM).
     */
    public function katalog(Request $request)
    {
        $category = $request->input('category');
        $query = Product::query();

        if ($category && in_array(strtolower($category), ['shoes', 'apparel', 'accessories'])) {
            $query->where('category', strtolower($category));
        }

        $products = $query->latest()->get();
        return view('katalog', compact('products', 'category'));
    }

    /**
     * Tampilkan halaman rincian detail 1 produk dari database.
     * Menampilkan peringatan 404 jika ID yang dicari tidak ditemukan di database.
     */
    public function show($id = null)
    {
        if ($id !== null) {
            $product = Product::findOrFail($id);
        } else {
            $product = Product::firstOrFail();
        }

        // Rekomendasi produk terkait
        $relatedProducts = Product::where('id', '!=', $product->id)->take(4)->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Tampilkan formulir checkout transaksi untuk produk tertentu (LKPD Pertemuan 7).
     * Menampilkan 404 jika ID produk tidak valid.
     */
    public function checkout($id = null)
    {
        if ($id !== null) {
            $product = Product::findOrFail($id);
        } else {
            $product = Product::firstOrFail();
        }

        return view('checkout', compact('product'));
    }

    /**
     * Proses penyimpanan data checkout transaksi ke database (LKPD Pertemuan 7).
     */
    public function storeTransaction(Request $request)
    {
        // 1. Validasi input formulir transaksi
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'buyer_name' => 'required|string|max:255',
            'buyer_phone' => 'required|string|max:50',
            'buyer_address' => 'required|string',
            'courier' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ], [
            'product_id.required' => 'Produk tidak valid.',
            'product_id.exists' => 'Produk yang dipilih tidak ditemukan di database.',
            'buyer_name.required' => 'Nama lengkap pembeli wajib diisi.',
            'buyer_phone.required' => 'Nomor Telepon/WhatsApp wajib diisi.',
            'buyer_address.required' => 'Alamat lengkap pengiriman wajib diisi.',
            'courier.required' => 'Silakan pilih jasa kurir pengiriman.',
            'quantity.required' => 'Jumlah pembelian wajib diisi.',
            'quantity.min' => 'Jumlah pembelian minimal 1 item.',
        ]);

        // 2. Keamanan Harga: Mengambil harga produk langsung dari database
        $product = Product::findOrFail($validated['product_id']);
        $originalPrice = (float) $product->price;

        // 3. Logika Tarif Ongkir & Total Pembayaran
        $courierRates = [
            'JNE' => 22000,
            'J&T' => 20000,
            'SiCepat' => 19000,
            'Pos Indonesia' => 18000,
        ];
        $courier = $validated['courier'];
        $shippingCost = $courierRates[$courier] ?? 20000;
        $quantity = (int) $validated['quantity'];
        $totalPrice = ($originalPrice * $quantity) + $shippingCost;

        // 4. Generate kode invoice unik dengan format INV-2026-XXXX
        do {
            $invoiceCode = 'INV-2026-' . strtoupper(Str::random(4));
        } while (Transaction::where('invoice_code', $invoiceCode)->exists());

        // 5. Simpan transaksi ke database menggunakan Eloquent ORM
        $size = $request->input('size') ?: $product->default_size;

        $transaction = Transaction::create([
            'invoice_code' => $invoiceCode,
            'user_id' => Auth::id(), // terisi otomatis jika login
            'product_id' => $product->id,
            'buyer_name' => $validated['buyer_name'],
            'buyer_phone' => $validated['buyer_phone'],
            'buyer_address' => $validated['buyer_address'],
            'courier' => $courier,
            'shipping_cost' => $shippingCost,
            'quantity' => $quantity,
            'size' => $size,
            'total_price' => $totalPrice,
            'status' => 'diproses',
        ]);

        // Bersihkan session cart jika ada
        session()->forget('cart');

        // 6. Redirect ke halaman invoice berhasil
        return redirect()->route('checkout.success', $transaction->id);
    }

    /**
     * Tampilkan nota invoice berhasil (LKPD Pertemuan 7).
     */
    public function success($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);

        return view('berhasil', compact('transaction'));
    }

    /**
     * Fallback redirect untuk konfirmasi pembayaran berhasil.
     */
    public function checkoutSuccess()
    {
        $lastTransaction = Transaction::latest()->first();
        if ($lastTransaction) {
            return redirect()->route('checkout.success', $lastTransaction->id);
        }
        return redirect()->route('orders.index');
    }

    /**
     * Tampilkan halaman Riwayat Pengiriman & Daftar Pesanan Pelanggan.
     */
    public function orders(Request $request)
    {
        $baseQuery = Transaction::with('product')->latest();

        if (Auth::check()) {
            $baseQuery->where('user_id', Auth::id());
        }

        // Hitung jumlah data riil untuk setiap tab filter
        $counts = [
            'semua' => (clone $baseQuery)->count(),
            'perjalanan' => (clone $baseQuery)->where('status', 'dalam_perjalanan')->count(),
            'proses' => (clone $baseQuery)->where('status', 'diproses')->count(),
            'terkirim' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'dibatalkan' => (clone $baseQuery)->where('status', 'dibatalkan')->count(),
        ];

        // Terapkan filter tab status
        $query = clone $baseQuery;
        if ($status = $request->input('status')) {
            if ($status === 'perjalanan') {
                $query->where('status', 'dalam_perjalanan');
            } elseif ($status === 'proses') {
                $query->where('status', 'diproses');
            } elseif ($status === 'terkirim' || $status === 'selesai') {
                $query->where('status', 'selesai');
            } elseif ($status === 'dibatalkan') {
                $query->where('status', 'dibatalkan');
            }
        }

        // Terapkan pencarian resi, invoice, atau nama produk
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                  ->orWhere('resi', 'like', "%{$search}%")
                  ->orWhere('buyer_name', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($p) use ($search) {
                      $p->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $transactions = $query->take(30)->get();

        // Transformasi ke format tampilan view orders/index
        $orders = $transactions->map(function ($t) {
            $status = $t->status ?? 'diproses';
            $statusLabel = match ($status) {
                'selesai' => 'Selesai / Terkirim',
                'dalam_perjalanan' => 'Dalam Perjalanan',
                'dibatalkan' => 'Dibatalkan',
                default => 'Sedang Diproses'
            };

            $statusBadge = match ($status) {
                'selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'dalam_perjalanan' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
                'dibatalkan' => 'bg-rose-100 text-rose-800 border-rose-200',
                default => 'bg-amber-100 text-amber-800 border-amber-200'
            };

            $statusNote = match ($status) {
                'selesai' => 'Paket telah diterima dengan baik oleh penerima di alamat tujuan.',
                'dalam_perjalanan' => !empty($t->resi) ? "Kurir sedang mengantar paket menuju alamat Anda (Resi: {$t->resi})." : 'Paket telah diserahkan ke jasa kurir ekspres.',
                'dibatalkan' => 'Pesanan telah dibatalkan oleh sistem / administrator.',
                default => 'Pesanan sedang diverifikasi dan disiapkan di Fulfillment Hub Sportivios.'
            };

            return [
                'id' => $t->id,
                'order_no' => $t->invoice_code ?? ('SPV-' . $t->id),
                'date' => $t->created_at ? $t->created_at->format('d M Y') : 'Hari ini',
                'resi' => $t->resi ?? 'Menunggu Resi',
                'status' => $statusLabel,
                'raw_status' => $status,
                'status_badge' => $statusBadge,
                'courier' => ($t->courier ?? 'JNE') . ' Express',
                'eta' => '2-3 Hari Kerja',
                'status_note' => $statusNote,
                'product_name' => $t->product->name ?? 'Sportivios Athletic Product',
                'product_category' => $t->product ? $t->product->category_label : 'SPORTIVIOS',
                'variant' => !empty($t->size) ? ('Ukuran: ' . $t->size) : ($t->product->sub_category ?? 'Universal Fit'),
                'qty' => $t->quantity ?? 1,
                'price' => 'Rp ' . number_format($t->total_price, 0, ',', '.'),
                'image' => asset($t->product->image ?? 'images/products/shoe.jpg'),
            ];
        })->toArray();

        return view('orders.index', compact('orders', 'counts'));
    }

    /**
     * Tampilkan halaman Pelacakan Resi dan Timeline Pengiriman Pesanan secara Real-time.
     */
    public function tracking(Request $request, $orderNo = null)
    {
        $searchKey = $orderNo ?? $request->input('q') ?? $request->input('resi') ?? $request->input('order_no');

        $transaction = null;
        if ($searchKey) {
            $transaction = Transaction::with(['product', 'user'])
                ->where('invoice_code', $searchKey)
                ->orWhere('resi', $searchKey)
                ->orWhere('id', is_numeric($searchKey) ? (int)$searchKey : 0)
                ->first();
        }

        // Jika tidak dicari secara spesifik, tampilkan transaksi milik user login atau transaksi terbaru
        if (!$transaction) {
            if (Auth::check()) {
                $transaction = Auth::user()->transactions()->with('product')->latest()->first();
            }
            if (!$transaction) {
                $transaction = Transaction::with(['product', 'user'])->latest()->first();
            }
        }

        if (!$transaction) {
            return redirect()->route('katalog')->with('error', 'Belum ada transaksi di database.');
        }

        // Ambil timeline perjalanan paket dinamis dari database (dapat dimodifikasi admin)
        $timeline = $transaction->getTimeline();
        $status = $transaction->status ?? 'diproses';
        $resi = $transaction->resi ?? 'Menunggu Nomor Resi';

        $stepNumber = match ($status) {
            'selesai' => 4,
            'dalam_perjalanan' => 3,
            'dibatalkan' => 1,
            default => 2
        };

        $stepText = match ($status) {
            'selesai' => 'Paket telah tiba dan diterima dengan baik',
            'dalam_perjalanan' => 'Kurir sedang mengantar paket menuju lokasi Anda',
            'dibatalkan' => 'Pesanan dibatalkan',
            default => 'Pesanan sedang diproses di gudang Sportivios'
        };

        $statusText = match ($status) {
            'selesai' => 'SELESAI / TERKIRIM',
            'dalam_perjalanan' => 'DALAM PERJALANAN',
            'dibatalkan' => 'DIBATALKAN',
            default => 'SEDANG DIPROSES'
        };

        $order = [
            'id' => $transaction->id,
            'order_no' => $transaction->invoice_code ?? ('SPV-' . $transaction->id),
            'resi' => $resi,
            'status' => $statusText,
            'raw_status' => $status,
            'courier' => ($transaction->courier ?? 'JNE') . ' Express Priority',
            'eta' => '2-3 Hari Kerja',
            'step_text' => $stepText,
            'step_number' => $stepNumber,
            'total_steps' => 4,
            'recipient' => [
                'name' => $transaction->buyer_name ?? 'Pelanggan Sportivios',
                'phone' => $transaction->buyer_phone ?? '+62 812-3456-7890',
                'address' => $transaction->buyer_address ?? 'Jakarta Selatan, Indonesia',
                'note' => 'Paket diasuransikan penuh oleh Sportivios Logistics',
            ],
            'item' => [
                'name' => $transaction->product->name ?? 'AeroSprint Pro Elite Runners',
                'variant' => (!empty($transaction->size) ? ('Ukuran: ' . $transaction->size) : 'Universal Fit') . ' • ' . ($transaction->product ? $transaction->product->category_label : 'Sportivios'),
                'qty' => $transaction->quantity ?? 1,
                'price' => 'Rp ' . number_format($transaction->total_price ?? 1899000, 0, ',', '.'),
                'image' => asset($transaction->product->image ?? 'images/products/shoe.jpg'),
            ],
            'timeline' => $timeline,
        ];

        return view('orders.tracking', compact('order', 'transaction'));
    }
}
