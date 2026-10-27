<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama overview Dashboard Admin.
     */
    public function index()
    {
        // Statistik Utama Toko
        $totalRevenue = Transaction::where('status', '!=', 'dibatalkan')->sum('total_price');
        $totalOrders = Transaction::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // 5 Transaksi Terbaru
        $recentTransactions = Transaction::with(['product', 'user'])
            ->latest()
            ->take(6)
            ->get();

        // Produk dengan Stok Menipis (stok <= 15)
        $lowStockProducts = Product::where('stock', '<=', 15)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Ringkasan Status Pesanan
        $statusCounts = [
            'diproses' => Transaction::where('status', 'diproses')->count(),
            'dalam_perjalanan' => Transaction::where('status', 'dalam_perjalanan')->count(),
            'selesai' => Transaction::where('status', 'selesai')->count(),
            'dibatalkan' => Transaction::where('status', 'dibatalkan')->count(),
        ];

        // Distribusi Kategori Produk (Shoes, Apparel, Accessories)
        $categoryCounts = [
            'shoes' => Product::where('category', 'shoes')->count(),
            'apparel' => Product::where('category', 'apparel')->count(),
            'accessories' => Product::where('category', 'accessories')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'recentTransactions',
            'lowStockProducts',
            'statusCounts',
            'categoryCounts'
        ));
    }
}
