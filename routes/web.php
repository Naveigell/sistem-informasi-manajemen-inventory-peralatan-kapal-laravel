<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')
    ->name('admin.')
    ->middleware('redirect.if.not.authenticated')
    ->group(function () {

        Route::resource('dashboards', \App\Http\Controllers\Admin\DashboardController::class)->only('index');
        Route::resource('suppliers', \App\Http\Controllers\Admin\SupplierController::class)->except('show');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except('show');
        Route::resource('products.snapshots', \App\Http\Controllers\Admin\ProductSnapshotController::class)->only('index')->shallow();
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except('show');
        Route::resource('shippings', \App\Http\Controllers\Admin\ShippingController::class)->except('show', 'destroy');

        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->except('show');
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::resource('notes', \App\Http\Controllers\Admin\OrderNoteController::class)->only('edit', 'update')->parameter('notes', 'order');
        });
        Route::resource('request-orders', \App\Http\Controllers\Admin\RequestOrderController::class)
            ->except('show')
            ->parameter('request-orders', 'requestOrder');
});

Route::redirect('/', '/login')->name('index');

Route::view('/login', 'auth.login')->name('login.index');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.store');

Route::get('/logout', function () {
    auth()->logout();

    return redirect(\route('index'));
})->name('logout.store');
