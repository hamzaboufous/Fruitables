<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Routes produits
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Routes panier
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Routes authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes mot de passe oublié
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Routes protégées
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AuthController::class, 'account'])->name('account');
    Route::put('/account', [AuthController::class, 'updateAccount'])->name('account.update');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('account.password');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order/success/{order}', [CartController::class, 'orderSuccess'])->name('order.success');
    Route::get('/order/invoice/{order}', [CartController::class, 'orderInvoice'])->name('order.invoice');
    Route::get('/mes-commandes/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/mes-commandes/{order}/delete', [OrderController::class, 'destroy'])->name('orders.destroy');
    
    // Routes pour les commentaires
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
});

// Routes Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/export', [DashboardController::class, 'export'])->name('admin.export');
    
    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('/orders/{order}/update-payment', [AdminOrderController::class, 'updatePayment'])->name('admin.orders.update-payment');
    
    // Customers
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
    
    // Messages
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
    
    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
});
