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

Route::group(['namespace' => 'Api\V1'], function () {
    
    Route::group(['prefix' => 'products'], function () {
        Route::get('get_list_foods', 'ProductController@get_popular_products');
        Route::get('recommended', 'ProductController@get_recommended_products');
        Route::get('test', 'ProductController@test_get_recommended_products');
    }); 
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('register', 'CustomerAuthController@register');
        Route::post('login', 'CustomerAuthController@login');
    });
   
        
    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('info', 'CustomerController@info');

        Route::group(['prefix' => 'address'], function () {
            Route::get('list', 'CustomerController@address_list');
            Route::post('add', 'CustomerController@add_new_address');
            Route::put('update/{id}', 'CustomerController@update_address');
        });
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'OrderController@get_order_list');
            Route::post('place', 'OrderController@place_order');
        });
    });
            
    Route::group(['prefix' => 'config'], function () {
        Route::get('/get-zone-id', 'ConfigController@get_zone');
        Route::get('geocode-api', 'ConfigController@geocode_api');
    });

    Route::group(['prefix' => 'shop'], function () {
        Route::get('/get-shop-list', 'ShopController@getShopList')->name('v1.shop.get_shop_list');
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/get_list_coupon', 'CouponController@getListCoupon')->name('v1.coupon.get_list_coupon');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::post('/register', 'UserController@register')->name('users.register');
        Route::post('/login', 'UserController@login')->name('users.login');
    });
});
