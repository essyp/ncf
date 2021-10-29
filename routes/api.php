<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth/'], function () {
    Route::post('login', [AuthController::class, "loginUser"]);
    Route::post('register', [AuthController::class, "registerUser"]);
    Route::get('activate/{id}', [AuthController::class, "activateUser"]);
    Route::get('reset-password/{id}', [AuthController::class, "getPasswordReset"]);
    Route::post('reset-password', [AuthController::class, "resetPassword"]);
    Route::post('forgot-password', [AuthController::class, "forgotPassword"]);
    Route::get('logout', [AuthController::class, "logoutUser"]);
});

Route::group(['middleware' => 'api', 'prefix' => 'user/'], function () {
    Route::get('fetch-user/{id}', [UserController::class, "fetchUser"]);
    Route::post('update/{id}', [UserController::class, "updateUser"]);
    Route::post('change-password/{id}', [UserController::class, "changePassword"]);
});

Route::group(['middleware' => 'api', 'prefix' => 'home/'], function () {
    Route::post('newsletter', [HomeController::class, "newsLetter"]);
    Route::post('enquiry', [HomeController::class, "sendEnquiry"]);
});

Route::group(['middleware' => 'api', 'prefix' => 'blog/'], function () {
    Route::get('all', [BlogController::class, "fetchBlog"]);
    Route::get('featured', [BlogController::class, "featuredBlog"]);
    Route::get('single/{id}', [BlogController::class, "singleBlog"]);
    Route::get('search', [BlogController::class, "searchBlog"]);
    Route::get('by-category/{id}', [BlogController::class, "blogByCategory"]);
});

Route::group(['middleware' => 'api', 'prefix' => 'product/'], function () {
    Route::get('all', [ProductController::class, "fetchProducts"]);
    Route::get('featured', [ProductController::class, "featuredProducts"]);
    Route::get('single/{id}', [ProductController::class, "singleProduct"]);
    Route::get('search', [ProductController::class, "searchProduct"]);
    Route::get('by-category/{id}', [ProductController::class, "productByCategory"]);
});

Route::group(['middleware' => 'api', 'prefix' => 'cart/'], function () {
    Route::get('all/{user_id}', [ProductController::class, "fetchCarts"]);
    Route::post('add/{user_id}', [ProductController::class, "addToCart"]);
    Route::get('remove/{cart_id}', [ProductController::class, "removeFromCart"]);
    Route::get('empty/{user_id}', [ProductController::class, "emptyCart"]);
    Route::get('increase/{cart_id}', [ProductController::class, "increaseCart"]);
    Route::get('decrease/{cart_id}', [ProductController::class, "decreaseCart"]);
    Route::get('sum-total/{user_id}', [ProductController::class, "sumTotalCart"]);
});
