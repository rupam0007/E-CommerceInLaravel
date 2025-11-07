<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegistrationController as AdminRegistrationController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
// Choice pages
Route::view('/login', 'auth.login_choice')->name('login');
Route::view('/register', 'auth.registration_choice')->name('register');
// User forms
Route::get('/login/user', [App\Http\Controllers\auth\LoginController::class, 'showLoginForm'])->name('login.user');
Route::post('/login', [App\Http\Controllers\auth\LoginController::class, 'login']);
Route::get('/register/user', [App\Http\Controllers\auth\RegistrationController::class, 'showRegistrationForm'])->name('register.user');
Route::post('/register', [App\Http\Controllers\auth\RegistrationController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Public product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category}/products', [ProductController::class, 'byCategory'])->name('products.category');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
// Cart count (public; returns 0 for guests)
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
// Wishlist count (public; returns 0 for guests)
Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

// Categories route (placeholder)
Route::get('/categories', function () {
    return redirect()->route('products.index');
})->name('categories.index');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Redirect bare /admin to admin dashboard to avoid 404
Route::redirect('/admin', '/admin/dashboard');

// Admin authentication routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
        Route::get('/register', [AdminRegistrationController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AdminRegistrationController::class, 'register']);
    });

    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
});

// Admin routes protected by admin guard
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
});

