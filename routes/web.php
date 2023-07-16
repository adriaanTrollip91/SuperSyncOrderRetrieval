<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/NewOrders', function () {
    return view('NewOrders');
});

Route::get('/FulfiledOrders', function () {
    return view('FulfiledOrders');
});

Route::get('/ClientList', function () {
    return view('ClientList');
});

Route::prefix('shopify')->group(function () {
    Route::middleware('permission:write-products|read-products')->group(function () {
        Route::get('products', [ShopifyController::class, 'products'])->name('shopify.products');
        Route::get('sync/locations', [ShopifyController::class, 'syncLocations'])->name('locations.sync');
        Route::get('products/create', [ProductsController::class, 'create'])->name('shopify.product.create');
        Route::get('add_variant', [ProductsController::class, 'getHTMLForAddingVariant'])->name('product.add.variant');
        Route::get('sync/products', [ShopifyController::class, 'syncProducts'])->name('shopify.products.sync');
        Route::post('products/publish', [ProductsController::class, 'publishProduct'])->name('shopify.product.publish');
    });
    Route::middleware('permission:write-orders|read-orders')->group(function () {
        Route::get('orders', [ShopifyController::class,'orders'])->name('shopify.orders');
        Route::post('order/fulfill', [ShopifyController::class, 'fulfillOrder'])->name('shopify.order.fulfill');
        Route::get('order/{id}', [ShopifyController::class, 'showOrder'])->name('shopify.order.show');
        Route::get('order/{id}/sync', [ShopifyController::class, 'syncOrder'])->name('shopify.order.sync');
        Route::get('sync/orders', [ShopifyController::class, 'syncOrders'])->name('orders.sync');
    });
    Route::middleware('permission:write-customers|read-customers')->group(function () {
        Route::get('customers', [ShopifyController::class, 'customers'])->name('shopify.customers');
        Route::any('customerList', [ShopifyController::class, 'list'])->name('customers.list');
        Route::get('sync/customers', [ShopifyController::class, 'syncCustomers'])->name('customers.sync');
    });
    Route::get('profile', [SettingsController::class, 'profile'])->name('my.profile');
    Route::any('accept/charge', [ShopifyController::class, 'acceptCharge'])->name('accept.charge');
});
