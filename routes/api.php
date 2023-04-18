<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FreelancerOrder;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\StripePaymentController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function($router){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


// Settings
Route::get('contactUs', [MainController::class, 'contactUs']);
Route::get('aboutUs', [MainController::class, 'aboutUs']);


// Categories
Route::get('categories', [MainController::class, 'getAllCategories']);
Route::get('ProductsOfCategory/{cat_id}/{serv_id?}', [MainController::class, 'ProductsOfCategory']);
Route::get('FreelancersOfCategory/{cat_id}/{serv_id?}', [MainController::class, 'FreelancersOfCategory']);


//Services
Route::get('services', [MainController::class, 'getAllServices']);


// Get Services Of Categories
Route::get('getServicesOfCategories/{cat_id}', [MainController::class, 'getServicesOfCategories']);
Route::get('addServiceToFreelancer/{cat_id}/{serv_id}', [MainController::class, 'addServiceToFreelancer']);


// Cart
Route::get('allProductsInCart',[MainController::class, 'allProductsInCart'])->middleware('auth:api')->middleware('auth:api');
Route::get('cartBankPay/{user_id}/{discount_key?}',[PaymentController::class, 'cartBankPay']);
Route::get('checkCartPay/{total}',[PaymentController::class,'checkCartPay'])->middleware('auth:api');
Route::post('cartCalcDiscount',[CartController::class, 'cartCalcDiscount'])->middleware('auth:api');



// Customers
Route::put('switchToFreelancerAccount/{user_id}', [UserController::class, 'switchToFreelancerAccount']);
Route::get('getCustomerById/{id}', [UserController::class, 'getCustomerById']);
Route::put('editCustomer/{id}', [UserController::class, 'editCustomer']);



// Freelancers
Route::get('allFreelancers/{id?}', [UserController::class, 'allFreelancers']);
Route::get('getFreelancerById/{id}', [UserController::class, 'getFreelancerById']);
Route::put('editFreelancer/{id}', [UserController::class, 'editFreelancer']);
Route::get('allFiles/{id}', [UserController::class, 'allFiles']);
Route::get('deleteFile/{id}', [UserController::class, 'deleteFile'])->middleware('auth:api');



// Products
Route::get('products',[ProductController::class, 'index']);
Route::post('createProduct', [ProductController::class, 'createProduct'])->middleware('auth:api');
Route::get('getProduct/{id}', [ProductController::class, 'getProduct']);
Route::put('editProduct/{id}', [ProductController::class, 'editProduct']);
Route::delete('delete/{id}', [ProductController::class, 'destroy'])->middleware('auth:api');
Route::get('/addOrRemoveProductLikes/{id}',[ProductController::class, 'addOrRemoveProductLikes'])->middleware('auth:api');
Route::get('/addProductToCart/{id}',[ProductController::class,'addProductToCart'])->middleware('auth:api');
Route::get('/removeProductFromCart/{id}',[ProductController::class,'removeProductFromCart'])->middleware('auth:api');



// Photos
Route::get('photos', [PhotoController::class, 'index']);
Route::post('createPhoto', [PhotoController::class, 'createPhoto'])->middleware('auth:api');
Route::get('show/{id}', [PhotoController::class, 'show']);
Route::put('update/{id}', [PhotoController::class, 'update'])->middleware('auth:api');
Route::delete('delete/{id}', [PhotoController::class, 'destroy'])->middleware('auth:api');
Route::get('/addOrRemovePhotoLikes/{id}',[PhotoController::class, 'addOrRemovePhotoLikes'])->middleware('auth:api');



// Requests
Route::get('publicRequests/{id}', [RequestController::class, 'publicRequests']);
Route::get('privateRequests/{id}', [RequestController::class, 'privateRequests']);
Route::post('createRequest', [RequestController::class, 'createRequest']);      // Requests
Route::get('getPublicRequestById/{id}', [RequestController::class, 'getPublicRequestById']);
Route::get('getPrivateRequestById/{id}', [RequestController::class, 'getPrivateRequestById']);
Route::post('changeStatus/{id}', [RequestController::class, 'changeStatus']);
Route::post('requestWalletPay/{user_id}',[PaymentController::class,'requestWalletPay']);
Route::post('requestBankPay/{id}/{request_id}/{offer_id}',[PaymentController::class,'requestBankPay']);
Route::get('cancelRequest/{id}',[RequestController::class,"cancelRequest"]);
Route::post('rejectOfferRequest',[RequestController::class,'rejectOfferRequest']);





// Reservations
Route::get('allReservations',  [ReservationController::class, 'allReservations'])->middleware('auth:api');
Route::post('createBookingPhotoShot/{freelancer_id}', [ReservationController::class, 'createBookingPhotoShot']); // Create Reservation
Route::get('getReservationById/{id}', [ReservationController::class, 'getReservationById'])->middleware('auth:api');
Route::post('changeReservationStatus/{id}', [ReservationController::class, 'changeReservationStatus']);


// order

Route::get('getPublicRequests/{freelancer_id}',[OrderController::class,'getPublicRequests'])->middleware('auth:api');

Route::get('getPrivateRequests/{freelancer_id}',[OrderController::class,'getPrivateRequests'])->middleware('auth:api');

Route::get('getMyWork/{freelancer_id}',[FreelancerOrder::class,'getMyWork'])->middleware('auth:api');


//chat

Route::post('getMessages',[ChatController::class,'getMessages'])->middleware('auth:api');
Route::post('sendMessage',[ChatController::class,'sendMessage'])->middleware('auth:api');


// offer

Route::post('sendOffer/{id}',[RequestController::class,'sendOffer'])->middleware('auth:api');