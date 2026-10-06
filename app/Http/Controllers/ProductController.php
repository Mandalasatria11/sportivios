<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Master list of dummy products.
     */
    public static function getDummyProducts(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'AeroGlide Pro X',
                'category' => 'shoes',
                'sub_category' => "Men's Running Shoe",
                'price' => 129.99,
                'old_price' => 159.99,
                'badge' => 'NEW RELEASE',
                'badge_type' => 'cyan',
                'image' => asset('images/products/shoe.jpg'),
                'thumbnails' => [
                    asset('images/products/shoe.jpg'),
                    asset('images/products/shoe-sole.jpg'),
                    asset('images/products/shoe-heel.jpg'),
                    asset('images/products/shoe-action.jpg'),
                ],
                'sizes' => ['8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12'],
                'colors' => [
                    ['name' => 'Phantom White / Cyber Cyan', 'hex' => '#e0f7fa'],
                    ['name' => 'Stealth Black', 'hex' => '#111827'],
                    ['name' => 'Neon Volt', 'hex' => '#ccff00'],
                ],
                'rating' => 4.8,
                'reviews' => 124,
                'description' => 'Engineered for relentless speed and supreme comfort. The AeroGlide Pro X features our responsive kinetic foam midsole and a breathable precision-knit upper, delivering a frictionless ride from 5K to marathon distances.',
                'tech_features' => [
                    'Midsole: Kinetic-React Foam for 85% energy return.',
                    'Upper: Seamless Aero-Mesh for adaptive fit and cooling.',
                    'Outsole: High-abrasion carbon rubber zones for durability.',
                    'Weight: 8.2 oz (Men\'s Size 9).',
                    'Drop: 8mm (Heel: 34mm, Forefoot: 26mm).',
                ],
                'created_at' => '2026-03-01',
            ],
            [
                'id' => 2,
                'name' => 'AeroSprint Pro Elite Runners',
                'category' => 'shoes',
                'sub_category' => "Footwear • Racing",
                'price' => 180.00,
                'old_price' => 210.00,
                'badge' => 'POPULAR',
                'badge_type' => 'cyan',
                'image' => asset('images/products/shoe.jpg'),
                'thumbnails' => [
                    asset('images/products/shoe.jpg'),
                    asset('images/products/shoe.jpg'),
                ],
                'sizes' => ['8', '9', '9.5', '10', '10.5', '11'],
                'colors' => [
                    ['name' => 'Obsidian / Cyan', 'hex' => '#0891b2'],
                    ['name' => 'Volt Yellow', 'hex' => '#ccff00'],
                ],
                'rating' => 4.9,
                'reviews' => 196,
                'description' => 'Elite carbon-plated road racing shoe built for personal bests.',
                'tech_features' => [
                    'Plate: Full-length 3D Carbon Fiber plate.',
                    'Midsole: Ultra-light Pebax foam.',
                ],
                'created_at' => '2026-02-15',
            ],
            [
                'id' => 3,
                'name' => 'Velocity Tech Tee',
                'category' => 'apparel',
                'sub_category' => 'Training Apparel',
                'price' => 45.00,
                'old_price' => null,
                'badge' => null,
                'badge_type' => 'cyan',
                'image' => asset('images/products/tee.jpg'),
                'thumbnails' => [
                    asset('images/products/tee.jpg'),
                    asset('images/products/tee.jpg'),
                ],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => [
                    ['name' => 'Midnight Navy', 'hex' => '#1e293b'],
                    ['name' => 'Slate Gray', 'hex' => '#64748b'],
                ],
                'rating' => 4.9,
                'reviews' => 88,
                'description' => 'Ultra-lightweight sweat-wicking t-shirt with ergonomic flatlock seams.',
                'tech_features' => [
                    'Fabric: 88% Recycled Polyester, 12% Elastane.',
                    'Anti-Odor Technology keeps gear fresh.',
                ],
                'created_at' => '2026-02-28',
            ],
            [
                'id' => 4,
                'name' => 'Core Compression Tight',
                'category' => 'apparel',
                'sub_category' => "Women's Training",
                'price' => 65.00,
                'old_price' => 80.00,
                'badge' => 'SALE',
                'badge_type' => 'red',
                'image' => asset('images/products/tights.jpg'),
                'thumbnails' => [
                    asset('images/products/tights.jpg'),
                ],
                'sizes' => ['S', 'M', 'L'],
                'colors' => [
                    ['name' => 'Black / Cyan Stripe', 'hex' => '#0e7490'],
                ],
                'rating' => 4.9,
                'reviews' => 124,
                'description' => 'High-waisted targeted compression tights for maximum stability and leg recovery.',
                'tech_features' => [
                    'Graduated compression improves circulation.',
                    'Dual phone pockets on hips.',
                ],
                'created_at' => '2026-01-10',
            ],
            [
                'id' => 5,
                'name' => 'Velocity Wind Shield Jacket',
                'category' => 'apparel',
                'sub_category' => 'Outerwear Jacket',
                'price' => 120.00,
                'old_price' => null,
                'badge' => null,
                'badge_type' => 'cyan',
                'image' => asset('images/products/jacket.jpg'),
                'thumbnails' => [
                    asset('images/products/jacket.jpg'),
                ],
                'sizes' => ['M', 'L', 'XL'],
                'colors' => [
                    ['name' => 'Charcoal Wind', 'hex' => '#334155'],
                ],
                'rating' => 4.7,
                'reviews' => 84,
                'description' => 'Packable wind-resistant shell for storm running and chill protection.',
                'tech_features' => [
                    'DWR water-repellent finish.',
                    '360-degree reflective trim.',
                ],
                'created_at' => '2026-02-05',
            ],
            [
                'id' => 6,
                'name' => 'HydroFlow Smart Flask',
                'category' => 'accessories',
                'sub_category' => 'Accessories',
                'price' => 35.00,
                'old_price' => null,
                'badge' => null,
                'badge_type' => 'cyan',
                'image' => asset('images/products/flask.jpg'),
                'thumbnails' => [
                    asset('images/products/flask.jpg'),
                ],
                'sizes' => ['S', 'M', 'L'],
                'colors' => [
                    ['name' => 'Matte Black', 'hex' => '#0f172a'],
                ],
                'rating' => 5.0,
                'reviews' => 205,
                'description' => 'Smart thermal flask with LED temp display and hydration timer.',
                'tech_features' => [
                    'Capacity: 750ml.',
                    '24h cold insulation.',
                ],
                'created_at' => '2026-03-05',
            ],
            [
                'id' => 7,
                'name' => 'Titan Grip Gloves',
                'category' => 'accessories',
                'sub_category' => 'Gym Accessories',
                'price' => 35.00,
                'old_price' => null,
                'badge' => 'HOT',
                'badge_type' => 'red',
                'image' => asset('images/products/gloves.jpg'),
                'thumbnails' => [
                    asset('images/products/gloves.jpg'),
                ],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => [
                    ['name' => 'Tactical Black', 'hex' => '#1e293b'],
                ],
                'rating' => 4.9,
                'reviews' => 212,
                'description' => 'Heavy duty silicone padded lifting gloves with wrist wrap support.',
                'tech_features' => [
                    'Reinforced palm grip.',
                    'Integrated quick pull-tabs.',
                ],
                'created_at' => '2026-01-25',
            ],
            [
                'id' => 8,
                'name' => 'Core Duffel Bag 40L',
                'category' => 'accessories',
                'sub_category' => 'Gym Accessories',
                'price' => 59.99,
                'old_price' => 85.00,
                'badge' => 'SALE',
                'badge_type' => 'red',
                'image' => asset('images/products/duffel.jpg'),
                'thumbnails' => [
                    asset('images/products/duffel.jpg'),
                ],
                'sizes' => ['40L'],
                'colors' => [
                    ['name' => 'Midnight Blue', 'hex' => '#1e3a8a'],
                ],
                'rating' => 4.8,
                'reviews' => 58,
                'description' => 'Waterproof gym duffel with ventilated shoe compartment and wet gear pocket.',
                'tech_features' => [
                    'Capacity: 40 Liters.',
                    'Water-resistant tarpaulin base.',
                ],
                'created_at' => '2026-02-20',
            ],
        ];
    }

    /**
     * Display product listing (All or by Category).
     */
    public function index(Request $request, ?string $category = null)
    {
        // Handle alias or direct category matching
        if (in_array($category, ['shoes', 'apparel', 'accessories', 'accecoris'])) {
            if ($category === 'accecoris') {
                $category = 'accessories';
            }
        } else {
            // If category parameter is an ID, delegate to detail page
            if (is_numeric($category)) {
                return $this->show((int)$category);
            }
        }

        $allProducts = collect(self::getDummyProducts());

        $selectedCategories = [];
        if ($category) {
            $selectedCategories = [$category];
        } elseif ($request->has('categories')) {
            $selectedCategories = is_array($request->categories) ? $request->categories : explode(',', $request->categories);
        } elseif ($request->has('category')) {
            $selectedCategories = [$request->category];
        }

        $filtered = $allProducts;

        if (!empty($selectedCategories)) {
            $filtered = $filtered->filter(function ($item) use ($selectedCategories) {
                return in_array(strtolower($item['category']), array_map('strtolower', $selectedCategories));
            });
        }

        if ($search = $request->input('q')) {
            $filtered = $filtered->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), strtolower($search)) ||
                       str_contains(strtolower($item['sub_category']), strtolower($search));
            });
        }

        $selectedSizes = [];
        if ($request->has('size')) {
            $selectedSizes = is_array($request->size) ? $request->size : explode(',', $request->size);
            if (!empty($selectedSizes)) {
                $filtered = $filtered->filter(function ($item) use ($selectedSizes) {
                    return !empty(array_intersect($selectedSizes, $item['sizes'] ?? []));
                });
            }
        }

        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice !== null && is_numeric($minPrice)) {
            $filtered = $filtered->filter(fn($item) => $item['price'] >= (float)$minPrice);
        }
        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $filtered = $filtered->filter(fn($item) => $item['price'] <= (float)$maxPrice);
        }

        $sort = $request->input('sort', 'recommended');
        switch ($sort) {
            case 'price_asc':
                $filtered = $filtered->sortBy('price');
                break;
            case 'price_desc':
                $filtered = $filtered->sortByDesc('price');
                break;
            case 'newest':
                $filtered = $filtered->sortByDesc('created_at');
                break;
            case 'recommended':
            default:
                $filtered = $filtered->sortByDesc('rating');
                break;
        }

        $perPage = 8;
        $currentPage = (int)$request->input('page', 1);
        $totalItems = $filtered->count();
        $itemsForCurrentPage = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedProducts = new LengthAwarePaginator(
            $itemsForCurrentPage,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $categoryTitles = [
            'shoes' => 'Shoes Collection',
            'apparel' => 'Apparel Collection',
            'accessories' => 'Accessories Collection',
        ];

        $currentCategoryTitle = $category ? ($categoryTitles[$category] ?? ucfirst($category)) : 'Performance Gear';

        return view('products.index', [
            'products' => $paginatedProducts,
            'currentCategory' => $category,
            'currentCategoryTitle' => $currentCategoryTitle,
            'selectedCategories' => $selectedCategories,
            'selectedSizes' => $selectedSizes,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'currentSort' => $sort,
            'searchQuery' => $request->input('q', ''),
            'totalCount' => $totalItems,
        ]);
    }

    /**
     * Display single product detail page.
     */
    public function show($id = 1)
    {
        $products = collect(self::getDummyProducts());
        $product = $products->firstWhere('id', (int)$id) ?? $products->first();

        // Suggested related items
        $relatedProducts = $products->where('id', '!=', $product['id'])->take(4);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Display Shopping Cart page.
     */
    public function cart()
    {
        // Dummy cart items matching Image 5
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Aero Velocity Pro x1',
                'category_label' => "Men's Running Shoes",
                'color' => 'Black/Cyan',
                'size' => '10.5',
                'price' => 185.00,
                'quantity' => 1,
                'image' => asset('images/products/shoe.jpg'),
            ],
            [
                'id' => 3,
                'name' => 'Core Compression Top',
                'category_label' => 'Unisex Base Layer',
                'color' => 'Midnight',
                'size' => 'L',
                'price' => 65.00,
                'quantity' => 2,
                'image' => asset('images/products/tee.jpg'),
            ],
        ];

        return view('cart.index', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Display Checkout page.
     */
    public function checkout()
    {
        return view('cart.checkout');
    }

    /**
     * Display Order Delivery / History page.
     */
    public function orders()
    {
        // Dummy order list matching Image 4
        $orders = [
            [
                'order_no' => 'SPV-894210',
                'date' => '24 Okt 2024',
                'resi' => 'SPV-EXP-99201948210',
                'status' => 'Dalam Perjalanan',
                'status_badge' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
                'courier' => 'Sportivios Priority Logistics x JNE',
                'eta' => '26 - 28 Okt 2024',
                'status_note' => 'Kurir sedang mengantar paket ke alamat tujuan (Jakarta Selatan',
                'product_name' => 'AeroSprint Pro Elite Runners',
                'product_category' => 'FOOTWEAR • RACING',
                'variant' => 'EU 42 • Obsidian Black / Cyan',
                'qty' => 1,
                'price' => 'Rp 2.100.000',
                'image' => asset('images/products/shoe.jpg'),
            ],
            [
                'order_no' => 'SPV-893104',
                'date' => '22 Okt 2024',
                'resi' => 'SPV-EXP-88491023',
                'status' => 'Sedang Diproses',
                'status_badge' => 'bg-amber-100 text-amber-800 border-amber-200',
                'courier' => 'SiCepat Cargo Express',
                'eta' => '27 - 29 Okt 2024',
                'status_note' => 'Pesanan sedang disiapkan di Hub Fulfillment SPORTIVIOS',
                'product_name' => 'HyperVent Dry-Fit Running Singlet',
                'product_category' => 'APPAREL • TRAINING',
                'variant' => 'Size L • Deep Navy',
                'qty' => 2,
                'price' => 'Rp 798.000',
                'image' => asset('images/products/tee.jpg'),
            ],
            [
                'order_no' => 'SPV-882049',
                'date' => '15 Okt 2024',
                'resi' => 'SPV-EXP-77192044',
                'status' => 'Selesai / Terkirim',
                'status_badge' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'courier' => 'J&T Super Priority',
                'eta' => 'Diterima 18 Okt 2024',
                'status_note' => 'Paket telah diterima oleh Alex Vance (Penerima yang bersangkutan)',
                'product_name' => 'Endurance Pro 12L Trail Vest',
                'product_category' => 'GEAR • TRAIL RUNNING',
                'variant' => 'One Size • Stealth Black',
                'qty' => 1,
                'price' => 'Rp 1.450.000',
                'image' => asset('images/products/gloves.jpg'),
            ],
        ];

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display Order Tracking Detail page.
     */
    public function tracking($orderNo = 'SPV-894210')
    {
        // Dummy order tracking details matching Image 3
        $order = [
            'order_no' => $orderNo,
            'resi' => 'SPV-EXP-99201948210',
            'status' => 'DALAM PERJALANAN',
            'courier' => 'Sportivios Express Priority',
            'eta' => '26 – 28 Oktober 2024',
            'step_text' => 'Kurir sedang mengantar paket',
            'step_number' => 3,
            'total_steps' => 4,
            'recipient' => [
                'name' => 'Alex Vance',
                'phone' => '+62 812-3456-7890',
                'address' => 'Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802, Karet Semanggi, Setiabudi, Jakarta Selatan 12930',
                'note' => 'Titipkan di lobby reception bila berhalangan',
            ],
            'item' => [
                'name' => 'AeroSprint Pro Elite Runners',
                'variant' => 'EU 42 • Obsidian / Cyan',
                'qty' => 1,
                'price' => 'Rp 2.250.000',
                'image' => asset('images/products/shoe.jpg'),
            ],
            'timeline' => [
                [
                    'title' => 'Dalam Pengantaran ke Alamat Tujuan',
                    'time' => 'Hari ini • 09:15',
                    'desc' => 'Paket dibawa oleh kurir Budi Santoso (+62 812-9988-xxxx) menuju alamat Anda.',
                    'active' => true,
                ],
                [
                    'title' => 'Tiba di Sorting Center Jakarta Selatan',
                    'time' => '24 Okt • 21:40',
                    'desc' => 'Paket telah disortir dan siap didistribusikan ke hub terdekat.',
                    'active' => false,
                ],
                [
                    'title' => 'Diserahkan ke Kurir Logistik',
                    'time' => '24 Okt • 18:10',
                    'desc' => 'Paket diserahkan oleh Sportivios Fulfillment Lab ke armada pengiriman ekspres.',
                    'active' => false,
                ],
                [
                    'title' => 'Pesanan Diproses & Dikemas',
                    'time' => '24 Okt • 14:32',
                    'desc' => 'Pembayaran diverifikasi dan produk lolos pemeriksaan kualitas.',
                    'active' => false,
                ],
            ]
        ];

        return view('orders.tracking', [
            'order' => $order,
        ]);
    }

    /**
     * Display Profile Settings Page (Image 1).
     */
    public function profile()
    {
        $user = [
            'name' => 'Andrew AKA Peter Parker',
            'display_name' => 'PETER PARKER',
            'email' => 'parker@gmail.com',
            'phone' => '+1 (555) 019-2834',
            'avatar' => asset('images/users/peter-parker.jpg'),
            'membership' => "Pro Member Since '22",
            'points' => '2,450 Points',
            'address' => [
                'street' => 'Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12930',
            ],
            'recent_orders' => [
                [
                    'order_no' => 'SP-8829',
                    'date' => 'Oct 24, 2024',
                    'status' => 'SHIPPED',
                    'product_title' => 'AeroSprint Pro Runners',
                    'subtitle' => 'Size 10.5',
                    'price' => '$145.00',
                    'image' => asset('images/products/shoe.jpg'),
                    'tracking_url' => url('/orders/SPV-894210'),
                ],
                [
                    'order_no' => 'SP-7401',
                    'date' => 'Sep 12, 2024',
                    'status' => 'DELIVERED',
                    'product_title' => '2 Items',
                    'subtitle' => 'Delivered to Jakarta Selatan',
                    'price' => '$85.50',
                    'image' => asset('images/products/tee.jpg'),
                    'tracking_url' => url('/orders/SPV-882049'),
                ],
            ],
        ];

        return view('profile.index', compact('user'));
    }

    /**
     * Display Payment / Order Success Page (Image 2).
     */
    public function checkoutSuccess()
    {
        $order = [
            'order_no' => '#SP-894210',
            'order_code' => 'SPV-894210',
            'transaction_time' => '24 Okt 2024, 14:32',
            'payment_method' => 'QRIS Instant',
            'product_name' => 'AeroSprint Pro Elite Runners',
            'product_variant' => 'EU 42 • Obsidian Black / Cyan • Qty: 1',
            'product_price' => 'Rp 2.100.000',
            'total_payment' => 'Rp 2.100.000',
            'notification_email' => 'alex.vance@example.com',
            'eta' => '26 - 28 Okt 2024',
            'image' => asset('images/products/shoe.jpg'),
        ];

        return view('cart.success', compact('order'));
    }

    /**
     * Display Login Page (Image 5).
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Display Register Page (Image 4).
     */
    public function register()
    {
        return view('auth.register');
    }
}

