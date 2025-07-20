<?php

// Tambahkan use ini di bagian paling atas file web.php
use App\Http\Controllers\Admin\ScrapeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Buyer\PaymentController;
use App\Http\Controllers\Buyer\TopupController;
use App\Http\Controllers\Buyer\WalletController;
use App\Http\Controllers\General\VerificationAccountController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductScraperController;
use App\Http\Controllers\HomeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk menampilkan form scrape
Route::get('/superuseradminlacj5ub3lqwysaj9rik5/scrape', [ScrapeController::class, 'index'])
    ->name('admin.scrape');

// Route untuk memproses scraping (dikirim dari form POST)
Route::post('/superuseradminlacj5ub3lqwysaj9rik5/scrape', [ScrapeController::class, 'scrape'])
    ->name('admin.scrape.perform');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

/* -------------------------- MAIN ROUTES --------------------------*/

Route::get('/', [BuyerController::class, 'index']);
Route::get('/mall', [BuyerController::class, 'mall']);
Route::get('/cart', [BuyerController::class, 'cart'])->middleware('auth');
Route::get('/account', [BuyerController::class, 'account'])->middleware('auth');
Route::get('/category', [BuyerController::class, 'category']);
Route::get('/send-code', [VerificationAccountController::class, 'send_code'])->name('send-code');
Route::get('/send-mail-pc', [VerificationAccountController::class, 'send_mail_pc'])->name('send-pc');
Route::get('/shop/{shop}', [BuyerController::class, 'shop'])->name('home.shop');
Route::get('/mail/verify', [VerificationAccountController::class, 'send_mail'])->name('mail.verify');
Route::get('/shop/detail/{uuid}', [BuyerController::class, 'shopdetail']);


/* ------------------- ACCOUNT ROUTES ------------------*/
Route::get('/login', [LoginController::class, 'loginview'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'logincheck'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/signup', [LoginController::class, 'registerview'])->middleware('guest');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/update-profile', [LoginController::class, 'updateprofile'])->middleware('auth');
Route::get('/password-change', [LoginController::class, 'editpassview'])->name('pcmail.verify');
Route::post('/password-change', [LoginController::class, 'editpass']);


/* ------------------- PRODUCT ROUTES ------------------*/
Route::get('/product-detail/', [ProductController::class, 'productdetailindex']);
Route::get('/product-categ/', [ProductController::class, 'productcateg']);

/* -------------------- CART ROUTES --------------------*/
Route::post('/add-to-cart', [CartController::class, 'addtocart'])->middleware('auth');
Route::delete('/cart-delete/{id}', [CartController::class, 'deletecart'])->middleware('auth');
Route::post('/update-qty-cart', [CartController::class, 'updateqtycart'])->middleware('auth');

/* -------------------- TRANSACTION --------------------*/
Route::post('/checkout', [TransactionController::class, 'checkout'])->middleware('auth');
Route::post('/checkout/buynow', [TransactionController::class, 'checkoutbuynow'])->middleware('auth');
Route::get('/my-transaction', [TransactionController::class, 'transactionview'])->middleware('auth');
Route::get('/my-transaction/detail/{order_id}', [TransactionController::class, 'transdetail'])->middleware('auth');

/* -------------------- Group --------------------*/
Route::group(['middleware' => ['auth']], function () {
    /* -------------------- Payment --------------------*/
    Route::resource('/payment', PaymentController::class);
    Route::put('/transaction/received/{order}', [TransactionController::class, 'received'])->name('transaction.received');
    Route::put('/transaction/canceled/{order}', [TransactionController::class, 'cancelled'])->name('transaction.cancelled');
    /* -------------------- Topup --------------------*/
    Route::resource('/topup', TopupController::class);
    Route::get('/topup-select', [TopupController::class, 'method'])->name('topup-select');
    Route::get('/topup-record', [TopupController::class, 'record'])->name('topup-record');
    /* -------------------- Wallet --------------------*/
    Route::resource('/wallet', WalletController::class);
    Route::get('/billing', [WalletController::class, 'billing'])->name('billing');
    Route::get('/wallet-address', [WalletController::class, 'wallet_address'])->name('wallet-address');
    Route::post('/store-wallet-address', [WalletController::class, 'store_wallet_address'])->name('store-wallet-address');
    /* -------------------- Help --------------------*/
    Route::get('/service', [ServiceController::class, 'serviceview']);
    Route::post('/service', [ServiceController::class, 'servicecreate']);


});

