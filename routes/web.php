<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\NotificationPageController;
use App\Http\Controllers\FreelancerRequestController;
use App\Http\Controllers\FreelancerServiceController;
use App\Http\Controllers\payment\HayperpayController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

Route::get('/', [HomeController::class, 'index'])->name("home");


// test

route::get('frelancpro',function(){
return view('user.freelancerprofile');
});
route::get('/pay',[PaymentController::class,'visa']);

Route::post('/notifications/create', [NotificationController::class, 'create'])->name('create.noti');
Route::get('/notificationsget', [NotificationPageController::class, 'getNotification'])->name('notification.get');


Route::post('/store-token', [NotificationController::class, 'storeToken'])->name('store.token');
Route::get('/test',function(){
    return view('visitor.test');
});


Route::get('/notifications', [NotificationController::class, 'index']);
// Route::get('/test', function(){
//     return view('test');
// });

// end test



Route::get('/privacy&policy', function(){
    return view('visitor.privacy');
})->name('privacy&poilcy');

Route::get('products', [ProductController::class, 'displayAllProducts'])->name('products');


Route::get('/product/{id}', [ProductController::class, 'usershowproduct'])->name("product");

Route::get('/photo/{id}',[PhotoController::class, 'showPhoto'] )->name("photo");

route::get('/download/{name}',[HelperController::class,'download'])->name('download');

// Route::get('/freelancer/{id}', [UserController::class, 'FreelancerProfile'])->name("freelancer"
Route::get('/showFreelancerDetails/{id}', [UserController::class, 'showFreelancerDetails'])->name("showFreelancerDetails");

Route::get("freelancers", [UserController::class, 'allFreelancers'])->name("freelancers");
Route::get("ajax_search", [SearchController::class, 'ajax_search'])->name("search.ajax");

Route::get('filter', [ProductController::class, 'filter'])->name('filter');

########################################## Start Freelancer ##############################################

Route::prefix("freelancer")->name("freelanc.")->middleware('auth','is_freelancer')->group(function(){

    Route::post('updateFreelancerProfile/{id}', [UserController::class, 'updateFreelancerProfile'])->name('updateFreelancerProfile');

    Route::get("/products",function(){
        return view("freelancer.products");
    });

    Route::get("/profile",function(){
        return view("freelancer.profile");
    })->name("profile");


    Route::get("/mywork",function(){
        return view("freelancer.mywork");
    })->name("mywork");


    Route::get("/neworder",[FreelancerRequestController::class,'getneworder'])->name("neworder");
    Route::get("/mywork",[FreelancerRequestController::class,'getmywork'])->name("mywork");

    Route::post('/sendoffer/{id}',[FreelancerRequestController::class,'sendoffer'])->name("sendoffer");
    Route::post('/editoffer/{id}',[FreelancerRequestController::class,'editoffer'])->name("requests.editoffer");
    Route::get('/cancelRequest/{id}',[FreelancerRequestController::class,'cancel'])->name("requests.cancel");
    Route::get('/request/finish/{id}',[FreelancerRequestController::class,'finishRequest'])->name("finishrequest");


// Route::middleware("is_photgrapher")->group(function() {
    
// });

   
    Route::resource('photo', PhotoController::class);
    Route::resource('product', ProductController::class);


    // get all services of one category
    Route::get('category/{id}', [ProductController::class, 'getCategoryServices'])->name('getCategoryServices');

    Route::get("/reservation", [ReservationController::class, 'freelancerReservations'])->name("reservation");
    Route::post('/reservation/status/{id}', [ReservationController::class, 'changeStatus'])->name('reservations.status');

    Route::get('/rejectResevation/{id}',[ReservationController::class,'rejectReservation'])->name('reservation.reject');
    // Route::get('/rejectResevation/{id}',[ReservationController::class,'rejectReservation'])->name('reservation.cancel');

    Route::post('/cancelResevation/{id}',[ReservationController::class,'cancelReservation'])->name('reservation.cancelReservation');
    Route::post('/postResevation/{id}',[ReservationController::class,'postReservation'])->name('reservation.postReservation');

    Route::get('/sendoffer/{id}',[ReservationController::class,'sendoffer'])->name('reservation.sendoffer');

    Route::get('/editoffer/{id}',[ReservationController::class,'editOffer'])->name('reservation.editoffer');

    Route::get('/finish/{id}',[ReservationController::class,'finish'])->name('reservation.finish');





    //profile
    Route::get("/files", [FreelancerController::class, 'FreelancerFiles'])->name("files");

    Route::get("/wallet",[UserController::class,'freelancerwallet'])->name("wallet");


    Route::get("/reviews",function(){
        return view("freelancer.reviews");
    })->name("reviews");

    Route::post('service/add',[FreelancerServiceController::class,'addservice'])->name('addservice');

});
########################################## End Freelancer ##############################################




########################################## Start Customer ##############################################

Route::prefix("user")->name("user.")->middleware('auth')->group(function(){

    Route::get("/profile",[UserController::class,'getprofile'])->name("profile");

    Route::post('updateUserProfile/{id}', [UserController::class, 'updateUserProfile'])->name('updateUserProfile');

    Route::get("/notification",[NotificationPageController::class,'getNotification'])->name("notification");

    Route::resource("/cart", CartController::class);

    Route::get("/freelancer/profile",function(){
        return view("user.freelancerprofile");
    })->name("freelancer");


    // Reservations
    Route::get('/requestreservation/{freelancer_id}', [ReservationController::class,'index'])->name('requestreservation');
    Route::post('/requestreservation/store/{freelancer_id}', [ReservationController::class, 'store'])->name('requestreservation.store');
    Route::get('/reservaion/visa',[ReservationController::class, 'reservationVisaPay'])->name('reservation.visapay');

    Route::get('/reservations', [ReservationController::class, 'show'])->name('reservations');
    Route::post('/reviewReservation/{id}',[ReservationController::class, 'review'])->name("reservation.review");
    Route::post('/cancelReservation/{id}', [ReservationController::class, 'cancel'])->name("reservation.cancel");

    Route::get('/reservationPay/{id}',[ReservationController::class,'reservationPay'])->name('reservation.pay');
    
    Route::get('/reservationcempelete/{id}',[ReservationController::class,'compelete'])->name('reservation.compelete');
    Route::post('/rejectOffer/{id}',[ReservationController::class,'rejectOffer'])->name('reservation.rejectOffer');
    Route::post('/acceptdelay/{id}',[ReservationController::class,'acceptdelay'])->name('reservation.acceptdelay');


    Route::get('/showpublicrequest', [RequestController::class, 'publicRequests'])->name("showpublicrequest");
    Route::get('/showprivaterequest', [RequestController::class, 'privateRequests'])->name("showprivaterequest");


// request route
    Route::get('/requestpublic', [RequestController::class, 'requestpublicservice'])->name("requestpublic");
    Route::post('/StoreRequest/{freelancer_id?}', [RequestController::class, 'store'])->name("request.store");
    Route::post('/cancelRequest/{id}', [RequestController::class, 'cancel'])->name("request.cancel");
    Route::post('/reviewRequest/{id}',[RequestController::class, 'review'])->name("request.review");
    // get all services of one category
    Route::get('category/{id}', [RequestController::class, 'getCategoryServices'])->name('getCategoryServices');


    Route::get('/requestprivate/{id}', [RequestController::class, 'requestUserToFreelancer'])->name("requestprivate");
// form that chose if private or reservation   reuest
    Route::post('/choserequest/{id}', [RequestController::class, 'choseRequestOrReservation'])->name("choseRequestOrReservation");
//get offer request

    Route::get('/getrequestoffer/{id}', [RequestController::class, 'getrequestoffer'])->name("getrequestoffer");
    Route::get('/rejectofferrequest', [RequestController::class, 'rejectofferrequest'])->name("rejectofferrequest");
    Route::get('/acceptoffertopay/{id}/{re}', [RequestController::class, 'acceptoffertopay'])->name("acceptoffertopay");

    Route::post('/search/newoffer/{id}', [RequestController::class, 'searchNewOffer'])->name("searchnewoffer");

    // payment


    Route::post('/walletpay', [PaymentController::class, 'walletpay'])->name("walletpay");
    Route::get('request/walletpay/{request_id}/{offer_id}', [PaymentController::class, 'bankpay'])->name("request.bankpay");
    // end payment


    // add or delete likes
    Route::get('/addorremovelikes/{id}',[UserController::class,'addorremovelikes']);

    // add cart
    Route::get('/addtocart/{id}',[CartController::class,'addToCart'])->name('addtocart');
    Route::get('/addPromoCode',[CartController::class,'addPromoCode'])->name('addPromoCode');
    Route::get('/cartpay/{discount_key?}',[CartController::class,'cartpay'])->name('cartpay');


    Route::resource('/chat',ChatController::class);




Route::get('/request/completed/{id}',[RequestController::class,'completeRequest'])->name("completerequest");
Route::post('/private/request/rejectoffer/{id}',[RequestController::class,'privaterejectoffer'])->name("privaterejectoffer");
Route::post('/private/request/aceptoffer/{id}',[RequestController::class,'privateracceptoffer'])->name("privateracceptoffer");

Route::get('/request/checkout',[RequestController::class,'checkoutvisaid'])->name("request.checkoutid");


// switch to freelancer

Route::post('/switchtofreelancer',[UserController::class,'switchToFreelancer'])->name("switchToFreelancer");




// route::get('/checkout/{price}',[HayperpayController::class,'checkout']);

Route::get('/checkout',[CartController::class,'getHayperpayVisaId'])->name('cart.checkoutid');

Route::get('/notifcation/count',[NotificationPageController::class,'getCount'])->name('notifcation.count');

});



########################################## End Customer ##############################################


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
