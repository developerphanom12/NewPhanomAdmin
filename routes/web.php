<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DriverRuleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GlobalSettingController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RideBookingController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\API\UserSOSController;

use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Connected successfully to DB!";
    } catch (\Exception $e) {
        return "❌ Connection failed: " . $e->getMessage();
    }
});
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

// Authentication Routes (Public)
Route::get('/', [AuthController::class, 'showSignIn'])->name('/');
Route::get('/login', [AuthController::class, 'showSignIn'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showSignUp'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Explicit destination store route for testing
    Route::post('/destination/store', [App\Http\Controllers\DestinationController::class, 'store'])->name('screen.destination.store');

    // User Management Routes


    Route::get('/godseye', function () {
        return view('screen.godseye');
    })->name('screen.godseye');

    // Blog Management Routes
    Route::get('/allblogs', function () {
        return view('screen.blogs.allblogs');
    })->name('screen.blogs.allblogs');

    Route::get('/addblog', function () {
        return view('screen.blogs.addblog');
    })->name('screen.blogs.addblog');

    Route::get('/category', function () {
        return view('screen.blogs.category');
    })->name('screen.blogs.category');


    // Route::get('/userlist', function () {
    //     return view('screen.userlist');
    // })->name('screen.userlist');

    Route::get('/userlist', [App\Http\Controllers\UserController::class, 'allUsers'])
        ->name('screen.userlist');
    

Route::get('/users/add/{id}', [UserController::class, 'userDetails'])
        ->name('screen.users.add');

    // Driver Management Routes
    Route::get('/alldrivers', [App\Http\Controllers\DriverDocumentController::class, 'allDrivers'])
        ->name('screen.drivers.alldrivers');

    Route::get('/drivers/approvedriver', [App\Http\Controllers\DriverDocumentController::class, 'approvedDrivers'])
        ->name('screen.drivers.approvedriver');

    Route::get('/drivers/approvepending', [App\Http\Controllers\DriverDocumentController::class, 'pendingDrivers'])
        ->name('screen.drivers.approvepending');

    Route::get('/drivers/alldriver/document/{id}', [App\Http\Controllers\DriverDocumentController::class, 'showDriverDocuments'])
        ->name('screen.drivers.alldriver.document');

    Route::post('/drivers/document/update', [App\Http\Controllers\DriverDocumentController::class, 'updateDocumentStatus'])
        ->name('screen.drivers.document.update');

    // Banner Management Routes
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/banner/deleted', [BannerController::class, 'deleted'])->name('banner.deleted');
    Route::get('/banner/{id}/restore', [BannerController::class, 'restore'])->name('banner.restore');
    Route::delete('/banner/{id}/force-delete', [BannerController::class, 'forceDelete'])->name('banner.force-delete');
    Route::post('/banner/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banner.toggle-status');
    Route::get('/banner/{banner}', [BannerController::class, 'show'])->name('banner.show');
    Route::get('/banner/{banner}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/banner/{banner}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/banner/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy');

    // Destination routes
    Route::prefix('destination')->group(function () {
        Route::get('/', [DestinationController::class, 'index'])->name('screen.destination.destinations');
        Route::get('/create', [DestinationController::class, 'create'])->name('screen.destination.createdestination');
        Route::post('/store', [DestinationController::class, 'store'])->name('screen.destination.store');
        Route::get('/upload', [DestinationController::class, 'showUploadForm'])->name('screen.destination.uploadexelsheet');
        Route::post('/import', [DestinationController::class, 'importExcel'])->name('screen.destination.import');
        Route::get('/download-sample', [DestinationController::class, 'downloadSampleExcel'])->name('screen.destination.download-sample');
        Route::get('/{destination}', [DestinationController::class, 'show'])->name('screen.destination.show');
        Route::get('/{destination}/edit', [DestinationController::class, 'edit'])->name('screen.destination.edit');
        Route::put('/{destination}/update', [DestinationController::class, 'update'])->name('screen.destination.update');
        Route::delete('/{destination}/destroy', [DestinationController::class, 'destroy'])->name('screen.destination.destroy');
    });

    // Local Rides (Intra City) Costing Routes
    Route::prefix('local-rides')->group(function () {
        Route::get('/create', [App\Http\Controllers\LocalRidesController::class, 'create'])->name('local-rides.create');
        Route::get('/edit', [App\Http\Controllers\LocalRidesController::class, 'edit'])->name('local-rides.edit');
        Route::post('/store', [App\Http\Controllers\LocalRidesController::class, 'store'])->name('local-rides.store');
        Route::post('/update', [App\Http\Controllers\LocalRidesController::class, 'update'])->name('local-rides.update');
    });

    // All other protected routes...
    // Keep all the existing routes but group them within the auth middleware

    // ... rest of the existing routes ...
});

// Add any public routes here that don't require authentication

Route::get('/users/edit', function () {
    return view('screen.users.edit');
})->name('screen.users.edit');


Route::get('/carcategory', function () {
    return view('screen.carcategory');
})->name('screen.carcategory');

Route::get('/payments/payout', function () {
    return view('screen.payments.payout');
})->name('screen.payments.payout');

Route::get('/payments/driverwallet', function () {
    return view('screen.payments.driverwallet');
})->name('screen.payments.driverwallet');

Route::get('/payments/userwallet', function () {
    return view('screen.payments.userwallet');
})->name('screen.payments.userwallet');

Route::get('/payments/adminwallet', function () {
    return view('screen.payments.adminwallet');
})->name('screen.payments.adminwallet');

Route::get('/viewpay/paymentview', function () {
    return view('screen.viewpay.paymentview');
})->name('screen.viewpay.paymentview');

// Route::get('/sos', function () {
//     return view('screen.sos.sos');
// })->name('screen.sos.sos');

Route::get('/sos', [UserSOSController::class, 'showSOS'])->name('screen.sos.sos');
Route::get('/sos/edit/{id}', [UserSOSController::class, 'showSOSEdit'])->name('screen.sos.editsos');

// Route::get('/sos/edit', function () {
//     return view('screen.sos.editsos');
// })->name('screen.sos.editsos');

Route::get('/currencies/appcurrencies', function () {
    return view('screen.currencies.appcurrencies');
})->name('screen.currencies.appcurrencies');

Route::get('/currencies/createcurrencies', function () {
    return view('screen.currencies.createcurrencies');
})->name('screen.currencies.createcurrencies');

Route::get('/currencies/editcurrencies', function () {
    return view('screen.currencies.editcurrencies');
})->name('screen.currencies.editcurrencies');

Route::get('language/alllaguage', function () {
    return view('screen.language.alllanguage');
})->name('screen.language.alllanguage');

Route::get('language/createlanguage', function () {
    return view('screen.language.createlanguage');
})->name('screen.language.createlanguage');

Route::get('language/editlanguage', function () {
    return view('screen.language.editlanguage');
})->name('screen.language.editlanguage');

Route::get('deletelanguage/deletelanguage', function () {
    return view('screen.deletelanguage.deletelanguage');
})->name('screen.deletelanguage.deletelanguage');

Route::get('/customer/feedback', function () {
    return view('screen.customer.feedback');
})->name('screen.customer.feedback');

Route::get('/createdriver/createrule', function () {
    return view('screen.createdriver.createrule');
})->name('screen.createdriver.createrule');

Route::get('/setting/userwallet', function () {
    return view('screen.setting.userwallet');
})->name('screen.setting.userwallet');


Route::get('paymentmethod/strip', function () {
    return view('screen.paymentmethod.strip');
})->name('screen.paymentmethod.strip');

Route::get('/setting/privacy', [PrivacyController::class, 'showPrivacy'])->name('screen.setting.privacy');
Route::post('/setting/privacy', [PrivacyController::class, 'updatePrivacy'])->name('setting.privacy.update');

Route::get('/setting/condition', [TermsController::class, 'showPrivacy'])->name('screen.setting.condition');
Route::post('/setting/condition', [TermsController::class, 'updatePrivacy'])->name('setting.condition.update');


Route::get('/rides/intercity/view/{id}', [RideBookingController::class, 'showRidesView'])->name('screen.rides.intercityview');


// Route::get('/setting/condition', function () {
//     return view('screen.setting.condition');
// })->name('screen.setting.condition');

// rides
// Route::get('/rides/intercity', function () {
//     return view('screen.rides.intercity');
// })->name('screen.rides.intercity');
Route::get('/rides/intercity', [RideBookingController::class, 'showRides'])->name('screen.rides.intercity');
Route::get('/rides/localride', function () {
    return view('screen.rides.localride');
})->name('screen.rides.localride');

Route::get('/rides/rental', function () {
    return view('screen.rides.rental');
})->name('screen.rides.rental');

Route::get('/rides/adminride', function () {
    return view('screen.rides.adminride');
})->name('screen.rides.adminride');

Route::get('/documents/alldocuments', function () {
    return view('screen.documents.alldocuments');
})->name('screen.documents.alldocuments');

Route::get('/documents/delete', function () {
    return view('screen.documents.delete');
})->name('screen.documents.delete');

Route::get('/reports/userreport', function () {
    return view('screen.reports.userreport');
})->name('screen.reports.userreport');

Route::get('/reports/driverreport', function () {
    return view('screen.reports.driverreport');
})->name('screen.reports.driverreport');

Route::get('/reports/ridereport', function () {
    return view('screen.reports.ridereport');
})->name('screen.reports.ridereport');

Route::get('/reports/transaction', function () {
    return view('screen.reports.transaction');
})->name('screen.reports.transaction');

Route::get('/vechicle/addvechicle', function () {
    return view('screen.vechicle.addvechicle');
})->name('screen.vechicle.addvechicle');

Route::get('/vechicle/addfuel', function () {
    return view('screen.vechicle.addfuel');
})->name('screen.vechicle.addfuel');

Route::get('/blogs/view', function () {
    return view('screen.blogs.allblogs.view');
})->name('screen.blogs.allblogs.view');

Route::get('/blogs/editblogs', function () {
    return view('screen.blogs.allblogs.editblogs');
})->name('screen.blogs.allblogs.editblogs');

Route::get('/blogs/addblog', function () {
    return view('screen.blogs.allblogs.addblog');
})->name('screen.blogs.allblogs.addblog');

Route::get('/blogs/editcategory', function () {
    return view('screen.blogs.blogcategory.editcategory');
})->name('screen.blogs.blogcategory.editcategory');

Route::get('/documents/editdocument', function () {
    return view('screen.documents.alldocument.editalldocument');
})->name('screen.documents.alldocument.editalldocument');

Route::get('/documents/createdocument', function () {
    return view('screen.documents.alldocument.createdocument');
})->name('screen.documents.alldocument.createdocument');

// payment route
Route::get('paymentmethod/cod', function () {
    return view('screen.paymentmethod.cod');
})->name('screen.paymentmethod.cod');

Route::get('paymentmethod/razopay', function () {
    return view('screen.paymentmethod.razopay');
})->name('screen.paymentmethod.razopay');

Route::get('paymentmethod/paypal', function () {
    return view('screen.paymentmethod.paypal');
})->name('screen.paymentmethod.paypal');

Route::get('paymentmethod/paytm', function () {
    return view('screen.paymentmethod.paytm');
})->name('screen.paymentmethod.paytm');

Route::get('paymentmethod/wallet', function () {
    return view('screen.paymentmethod.wallet');
})->name('screen.paymentmethod.wallet');

Route::get('paymentmethod/payfast', function () {
    return view('screen.paymentmethod.payfast');
})->name('screen.paymentmethod.payfast');

Route::get('paymentmethod/paystack', function () {
    return view('screen.paymentmethod.paystack');
})->name('screen.paymentmethod.paystack');

Route::get('paymentmethod/flutterwave', function () {
    return view('screen.paymentmethod.flutterwave');
})->name('screen.paymentmethod.flutterwave');

Route::get('paymentmethod/mercadopago', function () {
    return view('screen.paymentmethod.mercadopago');
})->name('screen.paymentmethod.mercadopago');

// FAQs Routes
Route::get('/faqs/deleted', [FaqController::class, 'deleted'])->name('faq.deleted');
Route::post('/faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faq.toggle-status');
Route::post('/faqs/{id}/restore', [FaqController::class, 'restore'])->name('faq.restore');
Route::delete('/faqs/{id}/force-delete', [FaqController::class, 'forceDelete'])->name('faq.force-delete');
Route::resource('faq', FaqController::class);

// Tax Management Routes
Route::resource('taxes', TaxController::class);

// Coupon Management Routes
Route::resource('coupons', CouponController::class);

// Driver Rule Management Routes
Route::get('driver-rules/trashed', [DriverRuleController::class, 'trashed'])->name('driver-rules.trashed');
Route::post('driver-rules/{id}/restore', [DriverRuleController::class, 'restore'])->name('driver-rules.restore');
Route::delete('driver-rules/{id}/force-delete', [DriverRuleController::class, 'forceDelete'])->name('driver-rules.force-delete');
Route::resource('driver-rules', DriverRuleController::class);

// Route::get('/setting/globalsetting', function () {
//     return view('screen.setting.globalsetting');
// })->name('screen.setting.globalsetting');
Route::get('setting/globalsetting', [GlobalSettingController::class,'getGlobalSettings'])->name('screen.setting.globalsetting');

Route::get('/admin/contact', [ContactController::class, 'getContact']);
Route::post('/admin/contact/save', [ContactController::class, 'saveOrUpdate']);


Route::post('/rides/{ride}/assign-drivers', [RideController::class, 'assignDrivers'])->name('rides.assignDrivers');





//Local rides
Route::get('/settings/localRides/create', function () {
    return redirect()->route('local-rides.create');
})->name('screen.destination.localRides.create');



