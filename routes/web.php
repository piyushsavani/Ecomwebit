<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\NewArrivals;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\WishlistController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(FrontendController::class)->group(function(){
    Route::get('/','index');
    Route::get('/collections','collections');
    Route::get('/collections/{categorySlug}','products');
    Route::get('/collections/{categorySlug}/{productSlug}','viewProducts');
    

});

Route::middleware(['auth'])->group(function(){
    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::get('cart', [CartController::class, 'index']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
});

Route::get('thank-you', [FrontendController::class, 'thankYou']);
Route::get('new-arrivals', [NewArrivals::class, 'newArrivals']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function()
{
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('add-category', [CategoryController::class, 'create']);
    Route::post('category', [CategoryController::class, 'insert']);
    Route::get('category/{category}', [CategoryController::class, 'edit']);
    Route::put('category/{category}', [CategoryController::class, 'update']);
    Route::get('brands', App\Http\Livewire\Admin\Brands\Index::class);
    Route::get('products',[ProductController::class, 'index']);
    Route::get('add-product',[ProductController::class, 'create']);
    Route::post('product',[ProductController::class, 'insert']);
    Route::get('product/{product}',[ProductController::class, 'edit']);
    Route::put('product/{product}',[ProductController::class, 'update']);
    Route::get('/img-remove/{img}',[ProductController::class, 'removeImage']);
    Route::get('/delete/{img}',[ProductController::class, 'destroy']);    
    Route::get('/product-color/{prod_color_id}',[ProductController::class, 'updateProduColorQuantity']);

    Route::controller(ColorController::class)->group(function(){
        Route::get('colors','index');
        Route::get('add-color','create');
        Route::post('colors','insert');
        Route::get('color/{color_id}','edit');
        Route::put('color/{color}','update');
        Route::get('delete/color/{color}','destroy');

    Route::controller(SliderController::class)->group(function(){    
        Route::get('/sliders',[SliderController::class, 'index']);
        Route::get('/sliders/create',[SliderController::class, 'create']);
        Route::post('/sliders',[SliderController::class, 'store']);
        Route::get('/sliders/{sliderId}/edit',[SliderController::class, 'edit']);
        Route::put('/sliders/{sliderId}/edit',[SliderController::class, 'update']);
        Route::get('/sliders/{sliderId}/delete',[SliderController::class, 'delete']);

    });
    });

    Route::controller(OrdersController::class)->group(function(){    
        Route::get('/orders',[OrdersController::class, 'index']);     
        Route::get('/orders/{orderId}',[OrdersController::class, 'show']);     
        Route::put('/orders/{orderId}',[OrdersController::class, 'update']);   
        
        Route::get('/order/{orderId}',[OrdersController::class, 'viewInvoice']);     
        Route::get('/order/{orderId}/generate',[OrdersController::class, 'downloadInvoice']);     

    });

});