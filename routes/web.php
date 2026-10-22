<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Shop / Product Catalogue
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/shoes', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'shoes'));
Route::get('/product/apparel', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'apparel'));
Route::get('/product/accessories', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'accessories'));
Route::get('/product/accecoris', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'accessories'));

// Product Detail Page (LKPD P6 Dynamic Routing)
Route::get('/detail/{id?}', [ProductController::class, 'show'])->name('products.detail');
Route::get('/product/detail/{id?}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/view/{id?}', [ProductController::class, 'show']);

// Shopping Cart Page (matching image 5)
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// LKPD Pertemuan 7: Modul Transaksi Checkout, CSRF & Eloquent Insert
Route::get('/checkout/{id?}', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/checkout/proses', [ProductController::class, 'storeTransaction'])->name('checkout.store');
Route::get('/berhasil/{id}', [ProductController::class, 'success'])->name('checkout.success');
Route::get('/payment/success', [ProductController::class, 'checkoutSuccess'])->name('payment.success');

// Delivery History / Order List Page (matching image 4)
Route::get('/orders', [ProductController::class, 'orders'])->name('orders.index');
Route::get('/delivery', [ProductController::class, 'orders']);

// Order Tracking Detail Page (matching image 3)
Route::get('/orders/{id}', [ProductController::class, 'tracking'])->name('orders.tracking');
Route::get('/tracking/{id?}', [ProductController::class, 'tracking']);

// Profile Settings Page (Image 1)
Route::get('/profile', [ProductController::class, 'profile'])->name('profile');
Route::get('/account', [ProductController::class, 'profile'])->name('account');

// Auth Pages (Image 4 & Image 5)
Route::get('/login', [ProductController::class, 'login'])->name('login');
Route::get('/register', [ProductController::class, 'register'])->name('register');
