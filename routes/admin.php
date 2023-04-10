<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\FreeLancerController;
use App\Http\Controllers\admin\OwnerPercentageController;



Route::middleware("auth", "is_admin")->group(function(){

    Route::get('admin', function () {
        return view('Admin.dashboard');
    })->name('dashboard');

    // Users
    Route::resource('users', UserController::class);

    // Freelancers
    Route::resource('freelancers', FreeLancerController::class);

    // Requests
    Route::get('public_requests', [HomeController::class, 'public_requests'])->name('public_requests');
    Route::get('private_requests', [HomeController::class, 'private_requests'])->name('private_requests');

    // Payments Details
    Route::get('payments_details', [HomeController::class, 'payments_details'])->name('payments_details');

    // Cash withdrawal
    Route::get('manage_cash_withdrawal', [HomeController::class, 'manage_cash_withdrawal'])->name('manage_cash_withdrawal');
    Route::post('cash_withdrawal/status/{id}', [HomeController::class, 'changeStatus'])->name('cash_withdrawal.status');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // About us
    Route::resource('about_us', AboutUsController::class);

    // Contact us
    Route::get('contact_us', [HomeController::class, 'contact_us'])->name('contact_us');

    // Owner Percentage
    Route::resource('ownerPercentage', OwnerPercentageController::class);
});
