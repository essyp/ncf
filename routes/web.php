<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
    Route::post('login', 'AuthController@authenticate');
    Route::view('login','admin/login');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
    Route::get('', 'AdminController@index');
    Route::get('dashboard', 'AdminController@index');
    Route::get('admin-users', 'AdminController@allAdminUsers');
    Route::post('create-admin-user', 'AdminController@createAdmin');
    Route::post('update-admin-user', 'AdminController@updateAdmin');
    Route::post('update-admin-role', 'AdminController@updateAdminRole');
    Route::get('blog', 'AdminController@getBlog');
    Route::post('create-blog', 'AdminController@createBlog');
    Route::post('update-blog', 'AdminController@updateBlog');
    Route::get('blog-categories', 'AdminController@getBlogCategory');
    Route::post('create-blog-category', 'AdminController@createBlogCategory');
    Route::post('update-blog-category', 'AdminController@updateBlogCategory');
    Route::get('ministry-setup', 'AdminController@getMinistrySettings');
    Route::post('update-company', 'AdminController@updateCompany');
    Route::get('social-accounts', 'AdminController@getSocials');
    Route::post('update-socials', 'AdminController@updateSocials');
    Route::get('messaging-settings', 'AdminController@getSettings');
    Route::post('update-message-settings', 'AdminController@updateSettings');
    Route::get('ministries', 'AdminController@getMinistries');
    Route::post('create-ministry', 'AdminController@createMinistry');
    Route::post('update-ministry', 'AdminController@updateMinistry');
    Route::get('users', 'AdminController@getUsers');
    Route::get('members', 'AdminController@getMembers');
    Route::get('products', 'AdminController@getProducts');
    Route::post('create-product', 'AdminController@createProduct');
    Route::post('update-product', 'AdminController@updateProduct');
    Route::get('product-categories', 'AdminController@getProductCategory');
    Route::post('create-product-category', 'AdminController@createProductCategory');
    Route::post('update-product-category', 'AdminController@updateProductCategory');
    Route::get('banners', 'AdminController@getBanners');
    Route::post('create-banner', 'AdminController@createBanner');
    Route::post('update-banner', 'AdminController@updateBanner');
    Route::get('programmes', 'AdminController@getProgrammes');
    Route::post('create-programme', 'AdminController@createProgramme');
    Route::post('update-programme', 'AdminController@updateProgramme');
    Route::get('banks', 'AdminController@getBanks');
    Route::post('create-bank', 'AdminController@createBank');
    Route::post('update-bank', 'AdminController@updateBank');
    Route::get('donations', 'AdminController@getDonations');
    Route::get('payments', 'AdminController@getPayments');
    Route::get('log', 'AdminController@getLog');
    Route::get('parish-messages', 'AdminController@getParishMessages');
    Route::post('create-parish-message', 'AdminController@createParishMessages');
    Route::post('update-parish-message', 'AdminController@updateParishMessages');
    Route::get('orders', 'AdminController@getOrders');
    Route::get('order/view/', 'AdminController@getOrderView');
    Route::get('enquiries', 'AdminController@getEnquiries');
    Route::get('newsletter-subscriptions', 'AdminController@getNewsletterSubscriptions');
    Route::get('account-update', 'AdminController@getProfile');
    Route::get('change-password', 'AdminController@getChangePassword');
    Route::post('update-password', 'AdminController@changePassword');
    Route::post('reset-admin-password', 'AdminController@resetPassword');
    Route::get('events', 'AdminController@getEvents');
    Route::post('create-event', 'AdminController@createEvent');
    Route::post('update-event', 'AdminController@updateEvent');
    Route::get('payment-gateways', 'AdminController@getPaymentGateway');
    Route::post('create-payment-gateway', 'AdminController@createPaymentGateway');
    Route::post('update-payment-gateway', 'AdminController@updatePaymentGateway');
    Route::get('testimonies', 'AdminController@getTestimonies');
    Route::post('create-testimony', 'AdminController@createTestimony');
    Route::post('update-testimony', 'AdminController@updateTestimony');
    Route::get('teams', 'AdminController@getTeams');
    Route::post('create-team', 'AdminController@createTeam');
    Route::post('update-team', 'AdminController@updateTeam');
    Route::get('past-teams', 'AdminController@getPastTeams');
    Route::post('create-past-team', 'AdminController@createPastTeam');
    Route::post('update-past-team', 'AdminController@updatePastTeam');
    Route::get('gallery', 'AdminController@getGalleries');
    Route::post('add-images', 'AdminController@addGalleryImage');
    Route::post('update-image', 'AdminController@updateGalleryImage');
    Route::get('benefits', 'AdminController@getBenefits');
    Route::post('create-benefit', 'AdminController@createBenefit');
    Route::post('update-benefit', 'AdminController@updateBenefit');
    Route::get('activities', 'AdminController@getActivities');
    Route::post('create-activity', 'AdminController@createActivity');
    Route::post('update-activity', 'AdminController@updateActivity');
    Route::get('messages', 'AdminController@getMessages');
    Route::post('create-message', 'AdminController@createMessage');
    Route::post('update-message', 'AdminController@updateMessage');

    Route::get('ministry-excos', 'AdminController@getMinistryExcos');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
    Route::post('ministry-status', 'StatusController@ministry');
    Route::post('programme-status', 'StatusController@programme');
    Route::post('broadcast-status', 'StatusController@broadcast');
    Route::post('product-status', 'StatusController@product');
    Route::post('product-category-status', 'StatusController@ProductCategory');
    Route::post('blog-status', 'StatusController@blog');
    Route::post('blog-category-status', 'StatusController@BlogCategory');
    Route::post('user-status', 'StatusController@user');
    Route::post('admin-status', 'StatusController@admin');
    Route::post('bank-status', 'StatusController@bank');
    Route::post('banner-status', 'StatusController@banner');
    Route::post('log-status', 'StatusController@logStatus');
    Route::post('enquiry-status', 'StatusController@enquiry');
    Route::post('event-status', 'StatusController@event');
    Route::post('payment-gateway-status', 'StatusController@paymentGateway');
    Route::post('testimony-status', 'StatusController@testimony');
    Route::post('team-status', 'StatusController@team');
    Route::post('past-team-status', 'StatusController@pastTeam');
    Route::post('gallery-status', 'StatusController@gallery');
    Route::post('benefit-status', 'StatusController@benefit');
    Route::post('activity-status', 'StatusController@activity');
    Route::post('message-status', 'StatusController@message');
});


Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'blog/'], function () {
    Route::get('', 'BlogController@getBlog');
    Route::get('category/{id}', 'BlogController@getBlogCategory');
    Route::post('search-blog', 'BlogController@findBlogSearch');
    Route::get('search', 'BlogController@blogSearch');
    Route::get('{id}', 'BlogController@getBlogDetails');
    
});

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'ministry/'], function () {
    Route::get('', 'MinistryController@getMinistry');
    Route::get('{id}', 'MinistryController@getDetails');
});

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'programme/'], function () {
    Route::get('', 'ProgrammeController@getProgrammes');
    Route::get('{id}', 'ProgrammeController@getDetails');
});

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'event/'], function () {
    Route::get('', 'EventController@getEvents');
    Route::get('{id}', 'EventController@getDetails');
});

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'shop/'], function () {
    Route::get('', 'ProductController@getProducts');
    Route::get('category/{id}', 'ProductController@getProductCategory');
    Route::post('search-product', 'ProductController@findProductSearch');
    Route::get('search', 'ProductController@productSearch');
    Route::get('{id}', 'ProductController@getDetails');
});

Route::group(['middleware' => ['user'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'user/'], function () {
    Route::get('account', 'UserController@getAccount');
    Route::get('carts', 'UserController@getCart');
    Route::get('orders', 'UserController@getOrders');
    Route::get('payments', 'UserController@getPayments');
    Route::get('change-password', 'UserController@getChangePassword');
    Route::get('account-update', 'UserController@getAccountUpdate');
    Route::post('account-update', 'UserController@accountUpdate');
    Route::post('change-password', 'UserController@changePassword');
});

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'HomeController@getHome');
    Route::get('about-us', 'HomeController@getAbout');
    Route::get('contact-us', 'HomeController@getContact');
    Route::get('leadership-team', 'HomeController@getTeams');
    Route::get('past-leadership-team', 'HomeController@getPastTeams');
    Route::get('team/{id}', 'HomeController@getTeamDetail');
    Route::get('testimonies', 'HomeController@getTestimonies');
    Route::get('testimony/{id}', 'HomeController@getTestimonyDetails');

    Route::post('send-enquiry', 'HomeController@sendEnquiry');
    
    
    Route::post('/add/cart', 'HomeController@addToCart');
    Route::post('/remove/cart', 'HomeController@removeCart');
    Route::post('/empty/cart', 'HomeController@emptyCart');
    Route::post('/increase/cart', 'HomeController@increaseCart');
    Route::post('/decrease/cart', 'HomeController@decreaseCart');
    Route::get('/checkout', 'HomeController@getCheckout');
    Route::get('/shopping-cart', 'HomeController@getCart');
    Route::post('/user/order', 'HomeController@order');
    Route::post('/transaction/verify', 'HomeController@verifyTransaction');
    Route::post('/confirm/order/payment', 'HomeController@confirmOrderPayment');
    Route::post('/user/donation', 'HomeController@donation');
    Route::post('/confirm/donation/payment', 'HomeController@confirmDonation');

    Route::get('/order/status/{ref}', 'HomeController@orderStatus')->name('orderStatus');
    Route::get('/donation/status/{ref}', 'HomeController@donationStatus')->name('donationStatus');

    Route::post('/home/ajax/newsletter', 'HomeController@newsletter');
    Route::get('gallery', 'HomeController@getGallery');
    Route::get('membership', 'HomeController@getMembers');
    Route::get('history', 'HomeController@getHistory');
    Route::get('benefits', 'HomeController@getBenefits');
    Route::get('how-to-become-a-member', 'HomeController@getHowToBecome');
    Route::get('video/messages', 'HomeController@getVideoMessages');
    Route::get('audio/messages', 'HomeController@getAudioMessages');
    Route::get('marketplace', 'ProductController@getMarketplace');
    Route::get('donation', 'HomeController@getDonation');


    
});



