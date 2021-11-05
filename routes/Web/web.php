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
    Route::get('/verify', [\App\Http\Controllers\Web\AccountController::class, 'verify'])->name('Account.verify');
    Route::get('/verification/{code}', [\App\Http\Controllers\Web\AccountController::class, 'verification'])->name('Account.verification');
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

        //Cart route
        Route::get('/cart', function () {
            return view('Web.Layouts.main-cart');
        })->name('cart');
        Route::post('/cart-add', [\App\Http\Controllers\Web\CartController::class, 'create'])->name('Cart.add');
        Route::post('/cart-update/{id}', [\App\Http\Controllers\Web\CartController::class, 'put'])->name('Cart.update');
        Route::get('/cart-delete/{id}', [\App\Http\Controllers\Web\CartController::class, 'delete'])->name('Cart.delete');
        Route::get('/cart-destroy', [\App\Http\Controllers\Web\CartController::class, 'destroy'])->name('Cart.destroy');

        //Wihlist route
        Route::get('/wishlist', function () {
            return view('Web.Layouts.main-wishlist');
        })->name('wishlist');
        Route::post('/wishlist-add', [\App\Http\Controllers\Web\WishlistController::class, 'create'])->name('Wishlist.add');
        Route::get('/wishlist-delete/{id}', [\App\Http\Controllers\Web\WishlistController::class, 'delete'])->name('Wishlist.delete');

        //Compare route
        Route::get('/compare', function () {
            return view('Web.Layouts.main-compare');
        })->name('compare');
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

        Route::post('/coupon', [\App\Http\Controllers\Web\CouponController::class, 'create'])->name('Coupon.add');

        //Contract area
        Route::get('/contract/account-contracts', function () {
            return view('Web.Layouts.Contracts.account-contracts');
        })->name('Contract.account-contracts');
        Route::get('/contract/return-conditions', function () {
            return view('Web.Layouts.Contracts.return-conditions');
        })->name('Contract.return-conditions');
        Route::get('/contract/distance-sales-agreement', function () {
            return view('Web.Layouts.Contracts.distance-sales-agreement');
        })->name('Contract.distance-sales-agreement');
        Route::get('/contract/illumination-and-consent-text', function () {
            return view('Web.Layouts.Contracts.illumination-and-consent-text');
        })->name('Contract.illumination-and-consent-text');
        Route::get('/contract/privacy-policy', function () {
            return view('Web.Layouts.Contracts.privacy-policy');
        })->name('Contract.privacy-policy');
    }
);
