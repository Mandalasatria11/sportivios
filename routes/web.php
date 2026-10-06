<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Shop / Product Catalogue
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/shoes', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'shoes'));
Route::get('/product/apparel', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'apparel'));
Route::get('/product/accessories', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'accessories'));
Route::get('/product/accecoris', fn(Illuminate\Http\Request $req) => (new ProductController)->index($req, 'accessories'));

// Product Detail Page (matching image 1 & 2)
Route::get('/product/detail/{id?}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/view/{id?}', [ProductController::class, 'show']);

// Shopping Cart Page (matching image 5)
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// Checkout Page
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [ProductController::class, 'checkoutSuccess'])->name('checkout.success');
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
