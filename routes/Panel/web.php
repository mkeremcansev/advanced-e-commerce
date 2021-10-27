<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::prefix('e-admin')->name('Panel.')->group(
    function () {
        //Main route
        Route::get('/', function () {
            return view('Panel.index');
        })->name('main');

        //Settinf route
        Route::get('/settings', function () {
            return view('Panel.settings');
        })->name('settings');
        Route::post('/settings', [\App\Http\Controllers\Back\SettingController::class, 'put'])->name('Setting.update');

        //Category route
        Route::get('/category-add', function () {
            return view('Panel.Create.category');
        })->name('category.add');
        Route::get('/category-list', function () {
            return view('Panel.categories');
        })->name('categories');
        Route::post('/category-add', [\App\Http\Controllers\Back\CategoryController::class, 'create'])->name('Category.add');
        Route::get('/category-update/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'update'])->name('Category.update.get');
        Route::post('/category-update/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'put'])->name('Category.update');
        Route::get('/category-delete/{id}', [\App\Http\Controllers\Back\CategoryController::class, 'delete'])->name('Category.delete');

        //Service route
        Route::get('/service-add', function () {
            return view('Panel.Create.service');
        })->name('service.add');
        Route::get('/service-list', function () {
            return view('Panel.services');
        })->name('services');
        Route::post('/service-add', [\App\Http\Controllers\Back\ServiceController::class, 'create'])->name('Service.add');
        Route::get('/service-update/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'update'])->name('Service.update.get');
        Route::post('/service-update/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'put'])->name('Service.update');
        Route::get('/service-delete/{id}', [\App\Http\Controllers\Back\ServiceController::class, 'delete'])->name('Service.delete');

        //Brand route
        Route::get('/brand-add', function () {
            return view('Panel.Create.brand');
        })->name('brand.add');
        Route::get('/brand-list', function () {
            return view('Panel.brands');
        })->name('brands');
        Route::post('/brand-add', [\App\Http\Controllers\Back\BrandController::class, 'create'])->name('Brand.add');
        Route::get('/brand-update/{id}', [\App\Http\Controllers\Back\BrandController::class, 'update'])->name('Brand.update.get');
        Route::post('/brand-update/{id}', [\App\Http\Controllers\Back\BrandController::class, 'put'])->name('Brand.update');
        Route::get('/brand-delete/{id}', [\App\Http\Controllers\Back\BrandController::class, 'delete'])->name('Brand.delete');

        //Product route
        Route::get('/product-add', function () {
            return view('Panel.Create.product');
        })->name('product.add');
        Route::get('/product-list', function () {
            return view('Panel.products');
        })->name('products');
        Route::post('/product-add', [\App\Http\Controllers\Back\ProductController::class, 'create'])->name('Product.add');
        Route::get('/product-delete/{id}', [\App\Http\Controllers\Back\ProductController::class, 'delete'])->name('Product.delete');
        Route::get('/product-update/{id}', [\App\Http\Controllers\Back\ProductController::class, 'update'])->name('Product.update.get');
        Route::post('/product-update/{id}', [\App\Http\Controllers\Back\ProductController::class, 'put'])->name('Product.update');
        Route::post('/product-image/{id}', [\App\Http\Controllers\Back\ProductController::class, 'image'])->name('Product.update.image');

        //Product variant route
        Route::get('/product-variant/{id}', [\App\Http\Controllers\Back\VariantController::class, 'variant'])->name('Variant.add.get');
        Route::post('/product-variant-add', [\App\Http\Controllers\Back\VariantController::class, 'create'])->name('Variant.add');
        Route::get('/product-variant-delete/{id}', [\App\Http\Controllers\Back\VariantController::class, 'delete'])->name('Variant.delete');
        Route::get('/product-variant-update/{id}', [\App\Http\Controllers\Back\VariantController::class, 'update'])->name('Variant.update.get');
        Route::post('/product-variant-update/{id}', [\App\Http\Controllers\Back\VariantController::class, 'put'])->name('Variant.update');

        //Product information route
        Route::get('/product-information/{id}', [\App\Http\Controllers\Back\ProductInformationController::class, 'information'])->name('Information.add.get');
        Route::post('/product-information-add', [\App\Http\Controllers\Back\ProductInformationController::class, 'create'])->name('Information.add');
        Route::get('/product-information-delete/{id}', [\App\Http\Controllers\Back\ProductInformationController::class, 'delete'])->name('Information.delete');

        //Announcement route
        Route::get('/announcement-add', function () {
            return view('Panel.Create.announcement');
        })->name('announcement.add');
        Route::get('/announcement-list', function () {
            return view('Panel.announcements');
        })->name('announcements');
        Route::post('/announcement-add', [\App\Http\Controllers\Back\AnnouncementController::class, 'create'])->name('Announcement.add');
        Route::get('/announcement-update/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'update'])->name('Announcement.update.get');
        Route::post('/announcement-update/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'put'])->name('Announcement.update');
        Route::get('/announcement-delete/{id}', [\App\Http\Controllers\Back\AnnouncementController::class, 'delete'])->name('Announcement.delete');

        //Campaign route
        Route::get('/campaign-add', function () {
            return view('Panel.Create.campaign');
        })->name('campaign.add');
        Route::get('/campaign-list', function () {
            return view('Panel.campaigns');
        })->name('campaigns');
        Route::post('/campaign-add', [\App\Http\Controllers\Back\CampaignController::class, 'create'])->name('Campaign.add');
        Route::get('/campaign-value/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'value'])->name('Campaign.add.get');
        Route::get('/campaign-update/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'update'])->name('Campaign.update.get');
        Route::post('/campaign-update/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'put'])->name('Campaign.update');
        Route::post('/campaign-value-add', [\App\Http\Controllers\Back\CampaignController::class, 'campaign'])->name('Campaign.value.add');
        Route::get('/campaign-value-delete/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'vdelete'])->name('Campaign.value.delete');
        Route::get('/campaign-delete/{id}', [\App\Http\Controllers\Back\CampaignController::class, 'delete'])->name('Campaign.delete');
        Route::get('/campaign-status/{id}/{status}', [\App\Http\Controllers\Back\CampaignController::class, 'status'])->name('Campaign.status');
    }
);
