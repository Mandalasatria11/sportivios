<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sportivios Platform
|--------------------------------------------------------------------------
*/

// --- 1. Homepage & Static Showcase ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- 2. Product Catalog & Detail ---
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/shoes', fn(Request $req) => (new ProductController)->index($req, 'shoes'));
Route::get('/product/apparel', fn(Request $req) => (new ProductController)->index($req, 'apparel'));
Route::get('/product/accessories', fn(Request $req) => (new ProductController)->index($req, 'accessories'));
Route::get('/product/accecoris', fn(Request $req) => (new ProductController)->index($req, 'accessories'));

Route::get('/detail/{id?}', [ProductController::class, 'show'])->name('products.detail');
Route::get('/product/detail/{id?}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/view/{id?}', [ProductController::class, 'show']);
Route::get('/product/{id}', [ProductController::class, 'show'])->whereNumber('id');
Route::get('/id/{id}', [ProductController::class, 'show']);

// --- 3. Shopping Cart (Session Cart) ---
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{key?}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{key?}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// --- 4. Checkout, Order & Payment Flow ---
Route::get('/checkout/{id?}', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/checkout/proses', [ProductController::class, 'storeTransaction'])->name('checkout.store');
Route::get('/berhasil/{id}', [ProductController::class, 'success'])->name('checkout.success');
Route::get('/payment/success', [ProductController::class, 'checkoutSuccess'])->name('payment.success');

// Customer Order History & Logistics Tracking
Route::get('/orders', [ProductController::class, 'orders'])->name('orders.index');
Route::get('/orders-list', [ProductController::class, 'orders'])->name('orders');
Route::get('/delivery', [ProductController::class, 'orders']);
Route::get('/orders/{id}', [ProductController::class, 'tracking'])->name('orders.tracking');
Route::get('/tracking/{id?}', [ProductController::class, 'tracking'])->name('tracking');

// --- 5. Authentication & Customer Profile ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/account', [AuthController::class, 'profile'])->name('account');
});

// --- 6. Admin Dashboard & Store Management (Role: Admin) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Admin Product Management (CRUD)
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Admin Orders & Logistics Tracking Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('/orders/{id}/checkpoints', [AdminOrderController::class, 'addCheckpoint'])->name('orders.checkpoint.add');
    Route::delete('/orders/{id}/checkpoints/{index}', [AdminOrderController::class, 'deleteCheckpoint'])->name('orders.checkpoint.delete');
    Route::post('/orders/{id}/checkpoints/reset', [AdminOrderController::class, 'resetCheckpoints'])->name('orders.checkpoint.reset');
});
