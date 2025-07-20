<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    OrderController,
    ProductController,
    ShippingController,
    SellerController,
    AdminController,
    BuyerController,
    OrderPaymentController,
    TopupController,
    WithdrawController,
    SettingController,
    HomeController,
    AuthController,
    LogsController,
    MessageController,
    ServiceChatController
};

use App\Http\Middleware\Admin\{
    AuthMiddleware,
    GuestMiddleware
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

Route::group(['prefix' => 'superuseradminlacj5ub3lqwysaj9rik5', 'as' => 'administrator.'], function () {
    Route::group(['middleware' => [GuestMiddleware::class]], function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    });
    Route::group(['middleware' => [AuthMiddleware::class]], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [HomeController::class, 'index']);
        Route::resource('/dashboard', HomeController::class);
	
	Route::get('/scrape', [\App\Http\Controllers\Admin\ScrapeController::class, 'index'])->name('scrape');
	Route::post('/scrape', [\App\Http\Controllers\Admin\ScrapeController::class, 'scrape'])->name('scrape.submit');

	
        Route::resource('/message', MessageController::class);

        Route::resource('/order', OrderController::class);
        Route::resource('/shipping', ShippingController::class);

        Route::resource('/product', ProductController::class);
        Route::resource('/shipping', ShippingController::class);

        Route::resource('/seller', SellerController::class);
        Route::resource('/admin', AdminController::class);
        Route::resource('/user', BuyerController::class);

        Route::get('/service-chat', [ServiceChatController::class, 'service_chat_view'])->name('service-chat');
        Route::get('/service-chat/user', [ServiceChatController::class, 'service_chat_detail'])->name('service-chat.user');
        Route::post('/service-chat', [ServiceChatController::class, 'service_chat_create'])->name('service-chat.create');

        Route::resource('/topup', TopupController::class);
        Route::resource('/order-payment', OrderPaymentController::class);
        Route::resource('/withdraw', WithdrawController::class);

        Route::resource('/setting', SettingController::class);
        Route::resource('/order', OrderController::class);

        Route::resource('/logs', LogsController::class);

        Route::post('/logs/download', [LogsController::class, 'download'])->name('logs.download');

        // additional

        Route::delete('/delete-image/{image}', [ProductController::class, 'delete_image'])->name('delete_image');

        Route::post('/upload-ckeditor-images', [ProductController::class, 'upload_ckeditor_images'])->name('upload_ckeditor_images');
    });
});
