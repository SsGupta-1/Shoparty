<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api\v1',"prefix"=>"v1"], function () {

    /****** Auth controller Api's **************************/

    Route::post('signup','AuthController@signup');
    Route::post('login','AuthController@login');
    Route::post('verify-otp','AuthController@verifyOtp');
    Route::post('resend-otp','AuthController@resendOtp');
    Route::get('logout','AuthController@logout');

    /*************List of Routes Without Token **************/
    Route::post('pin-code-check','PartialController@pinCodeCheck');
    Route::get('list-countries','PartialController@listCountries');
    Route::post('order-details','OrderController@orderDetails');
    Route::post('product-details','ProductController@productDetail');
    Route::get('list-vouchers','PartialController@listVouchers');
    Route::post('static-pages','PartialController@staticPages');
    Route::post('list-colors','PartialController@listColors');
    Route::post('list-categories','PartialController@listCategories');
    Route::post('list-theames','PartialController@listTheames');
    Route::post('list-brands','PartialController@listBrands');
    Route::post('list-seasons','PartialController@listSeasons');
    Route::get('list-ages','PartialController@listAges');
    Route::post('list-font-names','PartialController@listFontNames');
    Route::get('list-font-sizes','PartialController@listFontSizes');
    Route::post('list-branches','PartialController@ListBranches');
    Route::post('sidebar/product/categories','PartialController@sidebarCategories');

    Route::post('product-list','ProductController@ProductList');
    Route::post('arrival/and/top/list','ProductController@ArrivalandTopList');
    Route::post('home-screen','PartialController@HomeScreen');
    Route::post('list-deals','PartialController@listDeals');
    Route::post('offers/discounted/products','PartialController@OffersAndDiscountedItems');
    Route::post('list-categories-products','PartialController@listCategoriesProduct');
    Route::post('home/screen/search','PartialController@HomeScreenSearch');


    /**************End of Routes******************************/

    Route::group(['middleware'=>['apiMiddleware']], function(){
        /****************** Routes for Partial Controller *********/
        /***************End of Routes for Partial Controller *******/

        Route::post('list-orders','OrderController@myOrders');
        Route::post('cancel-order','OrderController@cancelOrder');
        Route::post('order-details','OrderController@orderDetails');


        /****************** Routes for User Controller *********/
        Route::post('add-card','UserController@addCard');
        Route::post('add-address','UserController@addAddress');
        Route::post('edit-address','UserController@updateAddress');
        Route::get('list-addresses','UserController@listAddress');
        Route::post('delete-address','UserController@deleteAddress');

        /***************End of Routes for User Controller *******/

        /****************** Routes for Auth Controller *********/
        Route::get('profile-details','AuthController@profileDetails');
        Route::post('update-profile','AuthController@updateProfile');
        /***************End of Routes for Auth Controller *******/

        Route::post('add-wishlist','CartController@addToWishList');
        Route::post('my-wishlist','CartController@myWishlist');
        Route::post('save-to-bag','CartController@saveCustomizedProduct');
        Route::post('add-to-bag','CartController@addToBag');
        Route::post('delete-cart-product','CartController@deleteCartProduct');
        Route::post('shopping-list','CartController@ShoppingList');
        Route::post('check-customized','PartialController@checkCustomizedProduct');



    });
});
