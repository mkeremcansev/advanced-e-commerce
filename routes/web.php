<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




//Main routes
Route::get('/cart', function () {
    return view('Front.cart');
})->name('Front.cart');
Route::get('/wishlist', function () {
    return view('Front.wishlist');
})->name('Front.wishlist');
Route::get('/compare', function () {
    return view('Front.compare');
})->name('Front.compare');
Route::get('/', function () {
    return view('Front.index');
})->name('Front.main');
Route::get('/login-register', function () {
    return view('Front.login-register');
})->name('Front.login-register');
Route::get('/account', function () {
    return view('Front.account');
})->name('Front.account')->middleware('auth');

Route::post('/cart-add', [\App\Http\Controllers\Front\CartController::class, 'create'])->name('Cart.add');
Route::post('/cart-update/{id}', [\App\Http\Controllers\Front\CartController::class, 'put'])->name('Cart.update');
Route::get('/cart-delete/{id}', [\App\Http\Controllers\Front\CartController::class, 'delete'])->name('Cart.delete');
Route::get('/cart-destroy', [\App\Http\Controllers\Front\CartController::class, 'destroy'])->name('Cart.destroy');

Route::post('/wishlist-add', [\App\Http\Controllers\Front\WishlistController::class, 'create'])->name('Wishlist.add');
Route::get('/wishlist-delete/{id}', [\App\Http\Controllers\Front\WishlistController::class, 'delete'])->name('Wishlist.delete');

Route::post('/compare-add', [\App\Http\Controllers\Front\CompareController::class, 'create'])->name('Compare.add');
Route::get('/compare-delete/{id}', [\App\Http\Controllers\Front\CompareController::class, 'delete'])->name('Compare.delete');

//Login - Register Routes
Route::post('/register', [\App\Http\Controllers\Front\RegisterController::class, 'register'])->name('Register.add');
Route::post('/login', [\App\Http\Controllers\Front\LoginController::class, 'login'])->name('Login.add');
Route::get('/logout', [\App\Http\Controllers\Front\LoginController::class, 'logout'])->name('Logout.add');

//Account-update routes
Route::post('/account-update', [\App\Http\Controllers\Front\AccountController::class, 'put'])->name('Account.update');

Route::prefix('e-admin')->group(
    function () {
        //Main routes
        Route::get('/', function () {
            return view('Back.index');
        })->name('Back.main');

        //Create routes
        Route::get('/category-add', function () {
            return view('Back.Create.category');
        })->name('Back.category.add');
        Route::get('/service-add', function () {
            return view('Back.Create.service');
        })->name('Back.service.add');
        Route::get('/product-add', function () {
            return view('Back.Create.product');
        })->name('Back.product.add');
        Route::get('/brand-add', function () {
            return view('Back.Create.brand');
        })->name('Back.brand.add');
        Route::get('/announcement-add', function () {
            return view('Back.Create.announcement');
        })->name('Back.announcement.add');
        Route::get('/campaign-add', function () {
            return view('Back.Create.campaign');
        })->name('Back.campaign.add');
        Route::get('/opportunity-add', function () {
            return view('Back.Create.opportunity');
        })->name('Back.opportunity.add');

        //List routes
        Route::get('/settings', function () {
            return view('Back.settings');
        })->name('Back.settings');
        Route::get('/category-list', function () {
            return view('Back.categories');
        })->name('Back.categories');
        Route::get('/service-list', function () {
            return view('Back.services');
        })->name('Back.services');
        Route::get('/product-list', function () {
            return view('Back.products');
        })->name('Back.products');
        Route::get('/brand-list', function () {
            return view('Back.brands');
        })->name('Back.brands');
        Route::get('/announcement-list', function () {
            return view('Back.announcements');
        })->name('Back.announcements');
        Route::get('/campaign-list', function () {
            return view('Back.campaigns');
        })->name('Back.campaigns');
        Route::get('/opportunity-list', function () {
            return view('Back.opportunitys');
        })->name('Back.opportunitys');

        Route::post('/settings', [\App\Http\Controllers\Back\SettingController::class, 'put'])->name('Setting.update');

        Route::post('/category-add', [\App\Http\Controllers\Back\CategoryController::class, 'create'])->name('Category.add');
        Route::get('/category-update/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'update'])->name('Category.update.get');
        Route::post('/category-update/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'put'])->name('Category.update');
        Route::get('/category-delete/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'delete'])->name('Category.delete');

        Route::post('/service-add', [\App\Http\Controllers\Back\ServiceController::class, 'create'])->name('Service.add');
        Route::get('/service-update/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'update'])->name('Service.update.get');
        Route::post('/service-update/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'put'])->name('Service.update');
        Route::get('/service-delete/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'delete'])->name('Service.delete');

        Route::post('/brand-add', [\App\Http\Controllers\Back\BrandController::class, 'create'])->name('Brand.add');
        Route::get('/brand-update/{id}', [\App\Http\Controllers\Back\BrandController::class, 'update'])->name('Brand.update.get');
        Route::post('/brand-update/{id}', [\App\Http\Controllers\Back\BrandController::class, 'put'])->name('Brand.update');
        Route::get('/brand-delete/{id}', [\App\Http\Controllers\Back\BrandController::class, 'delete'])->name('Brand.delete');

        Route::post('/product-add', [\App\Http\Controllers\Back\ProductController::class, 'create'])->name('Product.add');
        Route::get('/product-delete/{id}', [\App\Http\Controllers\Back\ProductController::class, 'delete'])->name('Product.delete');
        Route::get('/product-update/{id}', [\App\Http\Controllers\Back\ProductController::class, 'update'])->name('Product.update.get');
        Route::post('/product-update/{id}', [\App\Http\Controllers\Back\ProductController::class, 'put'])->name('Product.update');
        Route::post('/product-image/{id}', [\App\Http\Controllers\Back\ProductController::class, 'image'])->name('Product.update.image');

        Route::get('/product-variant/{id}', [\App\Http\Controllers\Back\VariantController::class, 'variant'])->name('Variant.add.get');
        Route::post('/product-variant-add', [\App\Http\Controllers\Back\VariantController::class, 'create'])->name('Variant.add');
        Route::get('/product-variant-delete/{id}', [\App\Http\Controllers\Back\VariantController::class, 'delete'])->name('Variant.delete');
        Route::get('/product-variant-update/{id}', [\App\Http\Controllers\Back\VariantController::class, 'update'])->name('Variant.update.get');
        Route::post('/product-variant-update/{id}', [\App\Http\Controllers\Back\VariantController::class, 'put'])->name('Variant.update');

        Route::get('/product-information/{id}', [\App\Http\Controllers\Back\ProductInformationController::class, 'information'])->name('Information.add.get');
        Route::post('/product-information-add', [\App\Http\Controllers\Back\ProductInformationController::class, 'create'])->name('Information.add');
        Route::get('/product-information-delete/{id}', [\App\Http\Controllers\Back\ProductInformationController::class, 'delete'])->name('Information.delete');

        Route::post('/announcement-add', [\App\Http\Controllers\Back\AnnouncementController::class, 'create'])->name('Announcement.add');
        Route::get('/announcement-update/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'update'])->name('Announcement.update.get');
        Route::post('/announcement-update/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'put'])->name('Announcement.update');
        Route::get('/announcement-delete/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'delete'])->name('Announcement.delete');

        Route::post('/campaign-add', [\App\Http\Controllers\Back\CampaignController::class, 'create'])->name('Campaign.add');
        Route::get('/campaign-value/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'value'])->name('Campaign.add.get');
        Route::get('/campaign-update/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'update'])->name('Campaign.update.get');
        Route::post('/campaign-update/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'put'])->name('Campaign.update');
        Route::post('/campaign-value-add', [\App\Http\Controllers\Back\CampaignController::class, 'campaign'])->name('Campaign.value.add');
        Route::get('/campaign-value-delete/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'vdelete'])->name('Campaign.value.delete');
        Route::get('/campaign-delete/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'delete'])->name('Campaign.delete');
        Route::get('/campaign-status/{id}/{status}', [\App\Http\Controllers\Back\CampaignController::class, 'status'])->name('Campaign.status');

        Route::post('/opportunity-add', [\App\Http\Controllers\Back\OpportunityController::class, 'create'])->name('Opportunity.add');
        Route::get('/opportunity-update/{id}', [\App\Http\Controllers\Back\OpportunityController::class, 'update'])->name('Opportunity.update.get');
        Route::post('/opportunity-update/{id}', [\App\Http\Controllers\Back\OpportunityController::class, 'put'])->name('Opportunity.update');
        Route::get('/opportunity-delete/{id}', [\App\Http\Controllers\Back\OpportunityController::class, 'delete'])->name('Opportunity.delete');
    }
);
Route::get('/product/{slug}', [\App\Http\Controllers\Front\ProductController::class, 'single'])->name('Front.product.single');
