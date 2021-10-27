<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('Web.')->group(
    function () {
        Route::get('/cart', function () {
            return view('Web.cart');
        })->name('cart');
        Route::get('/wishlist', function () {
            return view('Web.wishlist');
        })->name('wishlist');
        Route::get('/compare', function () {
            return view('Web.compare');
        })->name('compare');
        Route::get('/', function () {
            return view('Web.index');
        })->name('main');
        Route::get('/login-register', function () {
            return view('Web.login-register');
        })->name('login-register');
        Route::get('/account', function () {
            return view('Web.account');
        })->name('account')->middleware('auth');

        Route::post('/cart-add', [\App\Http\Controllers\Web\CartController::class, 'create'])->name('Cart.add');
        Route::post('/cart-update/{id}', [\App\Http\Controllers\Web\CartController::class, 'put'])->name('Cart.update');
        Route::get('/cart-delete/{id}', [\App\Http\Controllers\Web\CartController::class, 'delete'])->name('Cart.delete');
        Route::get('/cart-destroy', [\App\Http\Controllers\Web\CartController::class, 'destroy'])->name('Cart.destroy');

        Route::post('/wishlist-add', [\App\Http\Controllers\Web\WishlistController::class, 'create'])->name('Wishlist.add');
        Route::get('/wishlist-delete/{id}', [\App\Http\Controllers\Web\WishlistController::class, 'delete'])->name('Wishlist.delete');

        Route::post('/compare-add', [\App\Http\Controllers\Web\CompareController::class, 'create'])->name('Compare.add');
        Route::get('/compare-delete/{id}', [\App\Http\Controllers\Web\CompareController::class, 'delete'])->name('Compare.delete');

        //Login - Register Routes
        Route::post('/register', [\App\Http\Controllers\Web\RegisterController::class, 'register'])->name('Register.add');
        Route::post('/login', [\App\Http\Controllers\Web\LoginController::class, 'login'])->name('Login.add');
        Route::get('/logout', [\App\Http\Controllers\Web\LoginController::class, 'logout'])->name('Logout.add');

        //Account-update routes
        Route::post('/account-update', [\App\Http\Controllers\Web\AccountController::class, 'put'])->name('Account.update');
        Route::get('/product/{slug}', [\App\Http\Controllers\Web\ProductController::class, 'single'])->name('product.single');
    }
);