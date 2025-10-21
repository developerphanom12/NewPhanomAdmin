<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\TopbarController;
use App\Http\Controllers\Admin\ContactQueryController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\NewsletterController;

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/

// Login
Route::get('/', [AdminAuthController::class, 'showLogin'])->name('admin.login.show');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

// Hidden Registration (only when no admin exists)
Route::get('/_admin/setup', [AdminAuthController::class, 'showRegister'])->name('admin.register.show');
Route::post('/_admin/setup', [AdminAuthController::class, 'register'])->name('admin.register');

// Logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Protected Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware('admin.auth')->group(function () {

    // ---- Dashboard ----
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/website-landing', function () {
        return view('website.landing');
    })->name('website.landing');


    /*
    |--------------------------------------------------------------------------
    | Topbar Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/topbar')->name('topbar.')->group(function () {
        Route::get('/', [TopbarController::class, 'index'])->name('index');

        // Links
        Route::post('/links', [TopbarController::class, 'storeLink'])->name('links.store');
        Route::put('/links/{link}', [TopbarController::class, 'updateLink'])->name('links.update');
        Route::patch('/links/{link}/toggle', [TopbarController::class, 'toggleLink'])->name('links.toggle');
        Route::post('/links/reorder', [TopbarController::class, 'reorderLinks'])->name('links.reorder');
        Route::delete('/links/{link}', [TopbarController::class, 'destroyLink'])->name('links.destroy');

        // Sections
        Route::post('/sections', [TopbarController::class, 'storeSection'])->name('sections.store');
        Route::put('/sections/{section}', [TopbarController::class, 'updateSection'])->name('sections.update');
        Route::patch('/sections/{section}/toggle', [TopbarController::class, 'toggleSection'])->name('sections.toggle');
        Route::post('/sections/reorder', [TopbarController::class, 'reorderSections'])->name('sections.reorder');
        Route::delete('/sections/{section}', [TopbarController::class, 'destroySection'])->name('sections.destroy');

        // Items
        Route::post('/sections/{section}/items', [TopbarController::class, 'storeItem'])->name('items.store');
        Route::put('/items/{item}', [TopbarController::class, 'updateItem'])->name('items.update');
        Route::patch('/items/{item}/toggle', [TopbarController::class, 'toggleItem'])->name('items.toggle');
        Route::post('/sections/{section}/items/reorder', [TopbarController::class, 'reorderItems'])->name('items.reorder');
        Route::delete('/items/{item}', [TopbarController::class, 'destroyItem'])->name('items.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Booking & Contact Info
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        // Old Contact Queries
        Route::get('/queries', [ContactQueryController::class, 'index'])->name('queries.index');
        Route::patch('/queries/{query}/toggle', [ContactQueryController::class, 'toggleRead'])->name('queries.toggle');

        // Booking Appointments
        Route::get('/booking-appointments', [QueryController::class, 'index'])->name('booking.index');
        Route::patch('/booking-appointments/{query}/toggle', [QueryController::class, 'toggle'])->name('booking.toggle');
        Route::delete('/booking-appointments/{query}', [QueryController::class, 'destroy'])->name('booking.destroy');

        // Contact Info
        Route::get('/contact-info', [ContactInfoController::class, 'edit'])->name('contact.edit');
        Route::post('/contact-info', [ContactInfoController::class, 'update'])->name('contact.update');
    });


    /*
    |--------------------------------------------------------------------------
    | Blog Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/blog')->name('admin.blog.')->group(function () {
        Route::resource('categories', BlogCategoryController::class)->except(['show']);
        Route::resource('posts', BlogPostController::class)->except(['show']);
    });
    

    /*
    |--------------------------------------------------------------------------
    | Newsletter (Read Only)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('newsletter', [NewsletterController::class,'index'])->name('newsletter.index');
    });
});
