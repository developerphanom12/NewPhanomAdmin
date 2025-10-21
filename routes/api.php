<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TopbarLink;
use App\Models\ServiceSection;
use App\Http\Controllers\Api\Admin\TopbarApiController;
use App\Http\Controllers\Api\Public\ContactController;
use App\Http\Controllers\Api\PublicQueryController;
use App\Http\Controllers\Api\Public\BlogController as PublicBlogController;
use App\Http\Controllers\Api\Public\NewsletterController as PublicNewsletterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FreelancerController;
use App\Http\Controllers\Api\SuggestionController;
use App\Http\Controllers\Api\RazorpayController;
use App\Http\Controllers\Api\TestController;





// PUBLIC: fetch enabled links (sorted)
Route::get('/topbar', function () {
  return TopbarLink::where('is_enabled', true)->orderBy('sort_order')->get([
    'id','label','url','icon','is_external','target'
  ]);
});

// PUBLIC: fetch services structure (enabled only, sorted)
Route::get('/services', function () {
  return ServiceSection::where('is_enabled', true)
    ->orderBy('sort_order')
    ->with(['items' => function($q){
      $q->where('is_enabled', true)->orderBy('sort_order')->get(['id','label','url','service_section_id']);
    }])
    ->get(['id','title']);
});


Route::middleware('auth:sanctum') // ya JWT middleware
  ->prefix('admin')
  ->group(function () {
    // Links
    Route::get('/topbar/links', [TopbarApiController::class,'linksIndex']);
    Route::post('/topbar/links', [TopbarApiController::class,'linksStore']);
    Route::put('/topbar/links/{link}', [TopbarApiController::class,'linksUpdate']);
    Route::patch('/topbar/links/{link}/toggle', [TopbarApiController::class,'linksToggle']);
    Route::post('/topbar/links/reorder', [TopbarApiController::class,'linksReorder']);
    Route::delete('/topbar/links/{link}', [TopbarApiController::class,'linksDestroy']);

    // Sections
    Route::get('/services/sections', [TopbarApiController::class,'sectionsIndex']);
    Route::post('/services/sections', [TopbarApiController::class,'sectionsStore']);
    Route::put('/services/sections/{section}', [TopbarApiController::class,'sectionsUpdate']);
    Route::patch('/services/sections/{section}/toggle', [TopbarApiController::class,'sectionsToggle']);
    Route::post('/services/sections/reorder', [TopbarApiController::class,'sectionsReorder']);
    Route::delete('/services/sections/{section}', [TopbarApiController::class,'sectionsDestroy']);

    // Items
    Route::get('/services/sections/{section}/items', [TopbarApiController::class,'itemsIndex']);
    Route::post('/services/sections/{section}/items', [TopbarApiController::class,'itemsStore']);
    Route::put('/services/items/{item}', [TopbarApiController::class,'itemsUpdate']);
    Route::patch('/services/items/{item}/toggle', [TopbarApiController::class,'itemsToggle']);
    Route::post('/services/sections/{section}/items/reorder', [TopbarApiController::class,'itemsReorder']);
    Route::delete('/services/items/{item}', [TopbarApiController::class,'itemsDestroy']);
});


Route::post('/contact', [ContactController::class, 'store']);
Route::post('/booking-appointments', [PublicQueryController::class,'store']);
Route::get('/contact-info', [PublicQueryController::class,'contact']);

Route::prefix('blog')->group(function () {
    Route::get('/categories', [PublicBlogController::class,'categories']);
    Route::get('/posts', [PublicBlogController::class,'posts']);              // ?page=&per_page=&category=&search=
    Route::get('/posts/{slug}', [PublicBlogController::class,'show']);
});

Route::post('/newsletter/subscribe', [PublicNewsletterController::class,'subscribe']);




Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/suggestions', [SuggestionController::class,'suggest']); // OpenAI suggestions
Route::post('/razorpay/order', [RazorpayController::class,'createOrder']); // can be public but better auth
Route::post('/razorpay/verify', [RazorpayController::class,'verify']);

// Booking / contact etc can be here too...

// Protected routes (token)
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/freelancer/upsert', [FreelancerController::class,'upsert']);
    Route::get('/freelancer/me', [FreelancerController::class,'me']);
    Route::post('/freelancer/mark-test', [FreelancerController::class,'markTestGiven']);

    // Razorpay endpoints for auth users
    Route::post('/razorpay/order/auth', [RazorpayController::class,'createOrder']);
    Route::post('/razorpay/verify/auth', [RazorpayController::class,'verify']);

    // Tests
    Route::get('/test/status', [TestController::class,'status']);
    Route::post('/test/submit', [TestController::class,'submit']);
});
