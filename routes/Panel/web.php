<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Panel login route
Route::prefix('admin')->middleware('AdminIsLogin')->name('Panel.')->group(
    function () {
        Route::get('/login', function () {
            return view('Panel.login');
        })->name('login.get');
        Route::post('/login', [\App\Http\Controllers\Panel\LoginController::class, 'login'])->name('login');
    }
);

//Panel middleware route
Route::prefix('admin')->middleware('Admin')->name('Panel.')->group(
    function () {
        //Main route
        Route::get('/', function () {
            return view('Panel.index');
        })->name('main');

        //Setting route
        Route::get('/settings', function () {
            return view('Panel.settings');
        })->name('settings');
        Route::post('/settings', [\App\Http\Controllers\Panel\SettingController::class, 'put'])->name('Setting.update');

        //Contract route
        Route::get('/contracts', function () {
            return view('Panel.contracts');
        })->name('contracts');
        Route::post('/contracts', [\App\Http\Controllers\Panel\ContractController::class, 'contract'])->name('Contract.update');

        //Theme route
        Route::get('/theme', function () {
            return view('Panel.Update.theme');
        })->name('theme');
        Route::post('/theme', [\App\Http\Controllers\Panel\ThemeController::class, 'put'])->name('Theme.update');

        //Logout route
        Route::get('/logout', [\App\Http\Controllers\Panel\LoginController::class, 'logout'])->name('logout');

        //Admins route
        Route::get('/admins', function () {
            return view('Panel.admins');
        })->name('admins');

        Route::get('/admin-to-member/{id}', [\App\Http\Controllers\Panel\UserController::class, 'member'])->name('admin-to-member.update');

        //Active review route
        Route::get('/active-reviews', function () {
            return view('Panel.Review.active');
        })->name('Active.reviews');
        Route::get('/passive-reviews', function () {
            return view('Panel.Review.passive');
        })->name('Passive.reviews');
        Route::get('/review-status/{id}', [\App\Http\Controllers\Panel\ReviewController::class, 'status'])->name('Status.review');

        //Users route
        Route::get('/members', function () {
            return view('Panel.members');
        })->name('members');
        Route::get('/user/{id}', [\App\Http\Controllers\Panel\UserController::class, 'detail'])->name('User.detail');

        Route::get('/member-to-admin/{id}', [\App\Http\Controllers\Panel\UserController::class, 'admin'])->name('member-to-admin.update');

        Route::get('/banned/{id}', [\App\Http\Controllers\Panel\UserController::class, 'banned'])->name('banned');

        //Blockeds route
        Route::get('/blockeds', function () {
            return view('Panel.blockeds');
        })->name('blockeds');

        Route::get('/unbanned/{id}', [\App\Http\Controllers\Panel\UserController::class, 'unbanned'])->name('unbanned');

        //Category route
        Route::get('/category-add', function () {
            return view('Panel.Create.category');
        })->name('category.add');
        Route::get('/category-list', function () {
            return view('Panel.categories');
        })->name('categories');
        Route::post('/category-add', [\App\Http\Controllers\Panel\CategoryController::class, 'create'])->name('Category.add');
        Route::get('/category-update/{id}', [\App\Http\Controllers\Panel\CategoryController::class, 'update'])->name('Category.update.get');
        Route::post('/category-update/{id}', [\App\Http\Controllers\Panel\CategoryController::class, 'put'])->name('Category.update');
        Route::get('/category-delete/{id}', [\App\Http\Controllers\Panel\CategoryController::class, 'delete'])->name('Category.delete');

        //Service route
        Route::get('/service-add', function () {
            return view('Panel.Create.service');
        })->name('service.add');
        Route::get('/service-list', function () {
            return view('Panel.services');
        })->name('services');
        Route::post('/service-add', [\App\Http\Controllers\Panel\ServiceController::class, 'create'])->name('Service.add');
        Route::get('/service-update/{id}', [\App\Http\Controllers\Panel\ServiceController::class, 'update'])->name('Service.update.get');
        Route::post('/service-update/{id}', [\App\Http\Controllers\Panel\ServiceController::class, 'put'])->name('Service.update');
        Route::get('/service-delete/{id}', [\App\Http\Controllers\Panel\ServiceController::class, 'delete'])->name('Service.delete');

        //Brand route
        Route::get('/brand-add', function () {
            return view('Panel.Create.brand');
        })->name('brand.add');
        Route::get('/brand-list', function () {
            return view('Panel.brands');
        })->name('brands');
        Route::post('/brand-add', [\App\Http\Controllers\Panel\BrandController::class, 'create'])->name('Brand.add');
        Route::get('/brand-update/{id}', [\App\Http\Controllers\Panel\BrandController::class, 'update'])->name('Brand.update.get');
        Route::post('/brand-update/{id}', [\App\Http\Controllers\Panel\BrandController::class, 'put'])->name('Brand.update');
        Route::get('/brand-delete/{id}', [\App\Http\Controllers\Panel\BrandController::class, 'delete'])->name('Brand.delete');

        //Product route
        Route::get('/product-add', function () {
            return view('Panel.Create.product');
        })->name('product.add');
        Route::get('/product-list', function () {
            return view('Panel.products');
        })->name('products');
        Route::post('/product-add', [\App\Http\Controllers\Panel\ProductController::class, 'create'])->name('Product.add');
        Route::get('/product-delete/{id}', [\App\Http\Controllers\Panel\ProductController::class, 'delete'])->name('Product.delete');
        Route::get('/product-update/{id}', [\App\Http\Controllers\Panel\ProductController::class, 'update'])->name('Product.update.get');
        Route::post('/product-update/{id}', [\App\Http\Controllers\Panel\ProductController::class, 'put'])->name('Product.update');
        Route::post('/product-image/{id}', [\App\Http\Controllers\Panel\ProductController::class, 'image'])->name('Product.update.image');

        //Product variant route
        Route::get('/product-variant/{id}', [\App\Http\Controllers\Panel\VariantController::class, 'variant'])->name('Variant.add.get');
        Route::post('/product-variant-add', [\App\Http\Controllers\Panel\VariantController::class, 'create'])->name('Variant.add');
        Route::get('/product-variant-delete/{id}', [\App\Http\Controllers\Panel\VariantController::class, 'delete'])->name('Variant.delete');
        Route::get('/product-variant-update/{id}', [\App\Http\Controllers\Panel\VariantController::class, 'update'])->name('Variant.update.get');
        Route::post('/product-variant-update/{id}', [\App\Http\Controllers\Panel\VariantController::class, 'put'])->name('Variant.update');

        //Product information route
        Route::get('/product-information/{id}', [\App\Http\Controllers\Panel\ProductInformationController::class, 'information'])->name('Information.add.get');
        Route::post('/product-information-add', [\App\Http\Controllers\Panel\ProductInformationController::class, 'create'])->name('Information.add');
        Route::get('/product-information-delete/{id}', [\App\Http\Controllers\Panel\ProductInformationController::class, 'delete'])->name('Information.delete');

        //Announcement route
        Route::get('/announcement-add', function () {
            return view('Panel.Create.announcement');
        })->name('announcement.add');
        Route::get('/announcement-list', function () {
            return view('Panel.announcements');
        })->name('announcements');
        Route::post('/announcement-add', [\App\Http\Controllers\Panel\AnnouncementController::class, 'create'])->name('Announcement.add');
        Route::get('/announcement-update/{id}', [\App\Http\Controllers\Panel\AnnouncementController::class, 'update'])->name('Announcement.update.get');
        Route::post('/announcement-update/{id}', [\App\Http\Controllers\Panel\AnnouncementController::class, 'put'])->name('Announcement.update');
        Route::get('/announcement-delete/{id}', [\App\Http\Controllers\Panel\AnnouncementController::class, 'delete'])->name('Announcement.delete');

        //Campaign route
        Route::get('/campaign-add', function () {
            return view('Panel.Create.campaign');
        })->name('campaign.add');
        Route::get('/campaign-list', function () {
            return view('Panel.campaigns');
        })->name('campaigns');
        Route::post('/campaign-add', [\App\Http\Controllers\Panel\CampaignController::class, 'create'])->name('Campaign.add');
        Route::get('/campaign-value/{id}', [\App\Http\Controllers\Panel\CampaignController::class, 'value'])->name('Campaign.add.get');
        Route::get('/campaign-update/{id}', [\App\Http\Controllers\Panel\CampaignController::class, 'update'])->name('Campaign.update.get');
        Route::post('/campaign-update/{id}', [\App\Http\Controllers\Panel\CampaignController::class, 'put'])->name('Campaign.update');
        Route::post('/campaign-value-add', [\App\Http\Controllers\Panel\CampaignController::class, 'campaign'])->name('Campaign.value.add');
        Route::get('/campaign-value-delete/{id}', [\App\Http\Controllers\Panel\CampaignController::class, 'vdelete'])->name('Campaign.value.delete');
        Route::get('/campaign-delete/{id}', [\App\Http\Controllers\Panel\CampaignController::class, 'delete'])->name('Campaign.delete');
        Route::get('/campaign-status/{id}/{status}', [\App\Http\Controllers\Panel\CampaignController::class, 'status'])->name('Campaign.status');

        //Coupon route
        Route::get('/coupon-add', function () {
            return view('Panel.Create.coupon');
        })->name('coupon.add');
        Route::get('/coupon-list', function () {
            return view('Panel.coupons');
        })->name('coupons');
        Route::post('/coupon-add', [\App\Http\Controllers\Panel\CouponController::class, 'create'])->name('Coupon.add');
        Route::get('/coupon-update/{id}', [\App\Http\Controllers\Panel\CouponController::class, 'update'])->name('Coupon.update.get');
        Route::post('/coupon-update/{id}', [\App\Http\Controllers\Panel\CouponController::class, 'put'])->name('Coupon.update');
        Route::get('/coupon-delete/{id}', [\App\Http\Controllers\Panel\CouponController::class, 'delete'])->name('Coupon.delete');
    }
);
