<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Seller\{
    AuthMiddleware,
    GuestMiddleware,
    ShopMiddleware,
    VerifyAccountMiddleware
};

use App\Http\Controllers\Seller\{
    AuthController,
    DashboardController,
    OrderController,
    ProfileController,
    ShopController,
    ProductShopController,
    TopupController,
    WalletController,
    WithdrawController,
    WalletDetailsController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'seller', 'as' => 'seller.'], function () {
    Route::group(['middleware' => [GuestMiddleware::class]], function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register/store', [AuthController::class, 'store'])->name('register.store');
        Route::get('/verify-account/{email}/{token}', [AuthController::class, 'verify_account'])->name('verify-account');
    });
    Route::group(['middleware' => [AuthMiddleware::class]], function () {
        Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
        Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
        Route::get('/banned', [DashboardController::class, 'banned'])->name('banned');
        Route::group(['middleware' => [ShopMiddleware::class]], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('home');
            Route::resource('/dashboard', DashboardController::class);
            Route::resource('/profile', ProfileController::class);
            Route::group(['middleware' => [VerifyAccountMiddleware::class]], function () {
                Route::get('/shop/edit/{shop}', [ShopController::class, 'edit'])->name('shop.edit');
                Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
                Route::put('/shop/update/{shop}', [ShopController::class, 'update'])->name('shop.update');
                Route::get('/shop/edit', [ShopController::class, 'shop_edit_dummy'])->name('shop.shop_edit_dummy');
                Route::resource('/product', ProductShopController::class);
                Route::resource('/order', OrderController::class);
                Route::resource('/wallet', WalletController::class);
                Route::resource('/topup', TopupController::class);
                Route::resource('/withdraw', WithdrawController::class);
                Route::get('/billing', [WalletDetailsController::class, 'billing'])->name('billing');
                Route::get('/withdrawl-record', [WalletDetailsController::class, 'withdrawls'])->name('withdrawl-record');
                Route::get('/topup-record', [WalletDetailsController::class, 'topup'])->name('topup-record');
                Route::get('/wallet-address', [WalletDetailsController::class, 'wallet_address'])->name('wallet-address');
                Route::get('/topup-select', [WalletDetailsController::class, 'topup_select'])->name('topup-select');
                Route::get('/withdraw-select', [WalletDetailsController::class, 'withdraw_select'])->name('withdraw-select');
            });
        });
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
