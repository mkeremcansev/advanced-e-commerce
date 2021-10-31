<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::name('Web.')->middleware('User')->group(function () {
    // Route::get('/account', function () {
    //     return view('Web.Layouts.Account.account');
    // })->name('account');
    Route::get('/account', [\App\Http\Controllers\Web\AccountController::class, 'account'])->name('Account');
    Route::post('/account-update', [\App\Http\Controllers\Web\AccountController::class, 'put'])->name('Account.update');
    Route::post('/review-add', [\App\Http\Controllers\Web\ReviewController::class, 'create'])->name('Review.add');
});

Route::name('Web.')->middleware('UserIsLogin')->group(function () {
    Route::get('/login-register', function () {
        return view('Web.Layouts.main-login-register');
    })->name('login-register');
});

Route::name('Web.')->group(
    function () {
        Route::get('/', function () {
            return view('Web.index');
        })->name('main');
        Route::get('/cart', function () {
            return view('Web.Layouts.main-cart');
        })->name('cart');
        Route::get('/wishlist', function () {
            return view('Web.Layouts.main-wishlist');
        })->name('wishlist');
        Route::get('/compare', function () {
            return view('Web.Layouts.main-compare');
        })->name('compare');

        //Cart route
        Route::post('/cart-add', [\App\Http\Controllers\Web\CartController::class, 'create'])->name('Cart.add');
        Route::post('/cart-update/{id}', [\App\Http\Controllers\Web\CartController::class, 'put'])->name('Cart.update');
        Route::get('/cart-delete/{id}', [\App\Http\Controllers\Web\CartController::class, 'delete'])->name('Cart.delete');
        Route::get('/cart-destroy', [\App\Http\Controllers\Web\CartController::class, 'destroy'])->name('Cart.destroy');

        //Wihlist route
        Route::post('/wishlist-add', [\App\Http\Controllers\Web\WishlistController::class, 'create'])->name('Wishlist.add');
        Route::get('/wishlist-delete/{id}', [\App\Http\Controllers\Web\WishlistController::class, 'delete'])->name('Wishlist.delete');

        //Compare route
        Route::post('/compare-add', [\App\Http\Controllers\Web\CompareController::class, 'create'])->name('Compare.add');
        Route::get('/compare-delete/{id}', [\App\Http\Controllers\Web\CompareController::class, 'delete'])->name('Compare.delete');

        //Login - Register Route
        Route::post('/register', [\App\Http\Controllers\Web\RegisterController::class, 'register'])->name('Register.add');
        Route::post('/login', [\App\Http\Controllers\Web\LoginController::class, 'login'])->name('Login.add');
        Route::get('/logout', [\App\Http\Controllers\Web\LoginController::class, 'logout'])->name('Logout.add');

        //Product route
        Route::get('/category/{slug}', [\App\Http\Controllers\Web\ProductController::class, 'category'])->name('category.products');
        Route::get('/campaign/{slug}', [\App\Http\Controllers\Web\ProductController::class, 'campaign'])->name('campaign.products');
        Route::get('/product/{slug}', [\App\Http\Controllers\Web\ProductController::class, 'single'])->name('product.single');
    }
);
