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
Route::get('/', 'App\Http\Controllers\AdminController@index');

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
    Route::post('login', 'AuthController@authenticate');
    Route::view('login','admin/login');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
    Route::get('/', 'AdminController@index');
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
    Route::get('business-setup', 'AdminController@getMinistrySettings');
    Route::post('update-company', 'AdminController@updateCompany');
    Route::get('social-accounts', 'AdminController@getSocials');
    Route::post('update-socials', 'AdminController@updateSocials');
    Route::get('messaging-settings', 'AdminController@getSettings');
    Route::post('update-message-settings', 'AdminController@updateSettings');
    Route::get('users', 'AdminController@getUsers');
    Route::get('products', 'AdminController@getProducts');
    Route::post('create-product', 'AdminController@createProduct');
    Route::post('update-product', 'AdminController@updateProduct');
    Route::get('product-categories', 'AdminController@getProductCategory');
    Route::post('create-product-category', 'AdminController@createProductCategory');
    Route::post('update-product-category', 'AdminController@updateProductCategory');
    Route::get('banners', 'AdminController@getBanners');
    Route::post('create-banner', 'AdminController@createBanner');
    Route::post('update-banner', 'AdminController@updateBanner');
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
    Route::get('gallery', 'AdminController@getGalleries');
    Route::post('add-images', 'AdminController@addGalleryImage');
    Route::post('update-image', 'AdminController@updateGalleryImage');
    Route::get('benefits', 'AdminController@getBenefits');
    Route::post('create-benefit', 'AdminController@createBenefit');
    Route::post('update-benefit', 'AdminController@updateBenefit');
    Route::get('messages', 'AdminController@getMessages');
    Route::post('create-message', 'AdminController@createMessage');
    Route::post('update-message', 'AdminController@updateMessage');
    Route::get('page-banners', 'AdminController@getPageBanners');
    Route::post('update-page-banner', 'AdminController@updatePageBanner');
    Route::get('membership-corporate', 'AdminController@getCorporateMembership');
    Route::get('membership-individual', 'AdminController@getIndividualMembership');
    Route::get('reports', 'AdminController@getReports');
    Route::post('add-report', 'AdminController@addReport');
    Route::post('update-report', 'AdminController@updateReport');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'App\Http\Controllers', 'prefix' => 'admin/'], function () {
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
    Route::post('gallery-status', 'StatusController@gallery');
    Route::post('benefit-status', 'StatusController@benefit');
    Route::post('message-status', 'StatusController@message');
    Route::post('report-status', 'StatusController@report');
});



