<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\PoliceVerificationController;
use App\Http\Controllers\Api\DriverLicenseController;
use App\Http\Controllers\Api\AadhaarCardController;
use App\Http\Controllers\Api\PollutionVerificationController;
use App\Http\Controllers\Api\InsuranceVerificationController;
use App\Http\Controllers\Api\VehicleRegistrationController;
use App\Http\Controllers\API\BannerApiController;
use App\Http\Controllers\DriverVehicleController;
use App\Http\Controllers\UserBankDetailController;
use App\Http\Controllers\DriverOnlineOffiline;
use App\Http\Controllers\GlobalSettingController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\RideBookingController;
use App\Http\Controllers\DriverRuleController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\UserWalletController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserOTPController;
use App\Http\Controllers\API\UserSOSController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Api\LocalRidesPricingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// User API routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/profile/update', [UserController::class, 'updateProfile']);
Route::post('/user/get', [UserController::class, 'getUserById']);

// Driver API routes
Route::post('/driver/register', [DriverController::class, 'register']);
Route::post('/driver/login', [DriverController::class, 'login']);
Route::get('/driver/profile', [DriverController::class, 'getProfile']);
Route::post('/driver/profile/update', [DriverController::class, 'updateDriverProfile']);

// Police Verification API routes
Route::post('/driver/police-verification/upload', [PoliceVerificationController::class, 'uploadVerification']);
Route::get('/driver/police-verification', [PoliceVerificationController::class, 'getVerification']);

// Driver License API routes
Route::post('/driver/license/upload', [DriverLicenseController::class, 'uploadLicense']);
Route::get('/driver/license', [DriverLicenseController::class, 'getLicense']);

// Aadhaar Card API routes
Route::post('/driver/aadhaar/upload', [AadhaarCardController::class, 'uploadAadhaar']);
Route::get('/driver/aadhaar', [AadhaarCardController::class, 'getAadhaar']);

// Pollution Verification API routes
Route::post('/driver/pollution/upload', [PollutionVerificationController::class, 'uploadPollution']);
Route::get('/driver/pollution', [PollutionVerificationController::class, 'getPollution']);

// Insurance Verification API routes
Route::post('/driver/insurance/upload', [InsuranceVerificationController::class, 'uploadInsurance']);
Route::get('/driver/insurance', [InsuranceVerificationController::class, 'getInsurance']);

// Vehicle Registration API routes
Route::post('/driver/vehicle-registration/upload', [VehicleRegistrationController::class, 'uploadRegistration']);
Route::get('/driver/vehicle-registration', [VehicleRegistrationController::class, 'getRegistration']);

// Banner API routes
Route::get('/banners', [BannerApiController::class, 'getActiveBanners']);

// FAQ API routes
Route::get('/faqs', [App\Http\Controllers\Api\FaqApiController::class, 'getActiveFaqs']);
Route::get('/faqs/category/{category}', [App\Http\Controllers\Api\FaqApiController::class, 'getFaqsByCategory']);


// Driver evhicle details registration
Route::post('/vehicle/register', [DriverVehicleController::class, 'store']);

// Driver Bank Detail Submission
Route::post('/user-bank-details', [UserBankDetailController::class, 'store']);
Route::get('/get-user-bank-details/{id}', [UserBankDetailController::class, 'getDetails']);

// Driver Online and Offline
Route::get('/isOnlineOffline/{userId}', [DriverOnlineOffiline::class, 'getStatus']);


// Get Admin Contact Information
Route::get('/contactInformation', [GlobalSettingController::class, 'getContact']);


// Get DRIVER RULE
Route::get('/getDriverRule', [DriverRuleController::class, 'showRules']);

// Get Privacy Policy and Terms and Conditions
Route::get('/privacyPolicy', [PrivacyController::class, 'showPrivacyPolicy']);
Route::get('/termsCondition', [TermsController::class, 'showTermCondition']);


// Get Boarding and Destination Points
Route::get('/boarding-points', [DestinationController::class, 'getBoardingPoints']);
Route::post('/destination-points', [DestinationController::class, 'getDestinations']);

//Submit Driver Vehicle registration
Route::post('/vehicle/submit', [VehicleController::class, 'store']);
Route::get('/getVehicle/{id}', [VehicleController::class, 'getVehicle']);


//User Wallet Transactions
Route::get('/getUserBalance/{user_id}', [UserWalletController::class, 'getBalance']);
Route::post('/wallet/add', [UserWalletController::class, 'addToWallet']);
Route::post('/wallet/delete', [UserWalletController::class, 'debitFromWallet']);
Route::get('/getUserTransaction/{user_id}', [UserWalletController::class, 'getTransaction']);

// Get Fare Details
Route::post('/fare-details', [DestinationController::class, 'getFareDetails']);


// User Ride Booking

Route::get('/getUserRides/{user_id}', [RideBookingController::class, 'getUserRides']);
Route::get('/getUserLastRide/{user_id}', [RideBookingController::class, 'getUserLastRide']);
Route::post('/ride-booking', [RideBookingController::class, 'store']);
Route::post('/ride-booking/{id}/status', [RideBookingController::class, 'updateStatus']);



// get User rides
Route::get('/driver/{driverId}/rides', [RideController::class, 'getDriverRides']);

//get driver rides
Route::get('/getDriverActiveRides/{driver_id}', [RideController::class, 'getDriverActiveRides']);


Route::post('/user-otp', [UserOTPController::class, 'store']);
Route::get('/get-otp', [UserOTPController::class, 'getOTP']);
Route::get('/getUserOTP', [UserOTPController::class, 'getUserOTP']);

// Accept User Rides by getDriverRides
Route::post('/accept-booking/{ride_id},{driver_id}', [RideController::class, 'acceptRideByDrivers']);


//sending User SOS

Route::post('/sos/send', [UserSOSController::class, 'sendSOS']);


//Route get Banner
Route::get('/getBanner', [BannerController::class, 'getBanner']);

// Local Rides Pricing API
Route::get('/local-rides-pricing', [LocalRidesPricingController::class, 'getPricing']);
