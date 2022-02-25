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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin\v1','prefix'=>'admin', 'middleware'=>['preventBackHistory','loginAuth']], function () {

    /**********Auth Functionality***********/
    Route::match(['get','post'],'/','AuthController@login');  
    Route::match(['get','post'],'/login','AuthController@login');
    Route::match(['get','post'],'/forgot-password','AuthController@forgotPassword');
    Route::match(['get','post'],'/verify-otp','AuthController@verifyOtp');
    Route::match(['get','post'],'/change-password','AuthController@changePassword');
    Route::match(['get','post'],'/resend-otp','AuthController@resendOtp');

});


Route::group(['namespace' => 'Admin\v1','prefix'=>'admin', 'middleware'=>['preventBackHistory','afterLoginAuth']], function () {
    
    Route::match(['get','post'],'/logout','AuthController@logout');
    Route::match(['get','post'],'/dashboard','AdminController@dashboard');

    // User Management
    Route::match(['get','post'],'/users','UserController@index');
    Route::match(['get','post'],'/user/view/{id}','UserController@view');
    Route::match(['get','post'],'/user/add','UserController@add');
    Route::match(['get','post'],'/user/edit/{id}','UserController@edit');
    Route::match(['get','post'],'/user/delete/{id}','UserController@delete');

    // Brand Management
    Route::match(['get','post'],'/brands','BrandController@index');
    Route::match(['get','post'],'/brand/add','BrandController@add');
    Route::match(['get','post'],'/brand/status/{id}/{status}','BrandController@updateStatus');

    // Store Management
    Route::match(['get','post'],'/stores','StoreController@index');
    Route::match(['get','post'],'/store/add','StoreController@add');
    Route::match(['get','post'],'/store/status/{id}/{status}','StoreController@updateStatus');

    // CMS Management
    Route::match(['get','post'],'/cms','CMSController@index');
    Route::match(['get','post'],'/cms/edit/{id}','CMSController@edit');

    // Policy Management
    Route::match(['get','post'],'/policy','CMSController@listPolicy');
    Route::match(['get','post'],'/policy/add','CMSController@addPolicy');
    Route::match(['get','post'],'/policy/edit/{id}','CMSController@editPolicy');
    Route::match(['get','post'],'/policy/delete/{id}','CMSController@deletePolicy');

    // Order Management
    Route::match(['get','post'],'/orders','OrderController@index');
    Route::match(['get','post'],'/order/view/{id}','OrderController@view');
    Route::match(['get','post'],'/order/download/{id}','OrderController@download');
    Route::match(['get','post'],'/order/status/{id}','OrderController@updateStatus');

    //Homepage Management
    Route::match(['get','post'],'/homepage','HomepageController@index');
    Route::post('/homepage'    , 'HomepageController@save_image')->name('/homepage');
   
    Route::match(['get','post'],'/homepage/delete/{id}','HomepageController@delete_img');


    //Offer Management

    Route::match(['get','post'],'/offer','OfferController@index');
    Route::match(['get','post'],'/offer/add','OfferController@addoffer');
    Route::match(['get','post'],'/offer/edit/{id}','OfferController@editoffer');
    Route::match(['get','post'],'/offer/delete/{id}','OfferController@deleteoffer');



});