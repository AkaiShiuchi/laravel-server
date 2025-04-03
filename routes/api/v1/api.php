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
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/get_list_coupon', 'CouponController@getListCoupon')->name('v1.coupon.get_list_coupon');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::post('/register', 'UserController@register')->name('users.register');
        Route::post('/login', 'UserController@login')->name('users.login');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'address'], function () {
            Route::post('user_address', 'UserAddressController@getUserAddresses')->name('customer.user_address');
            Route::post('user_info', 'UserAddressController@getUserInfo')->name('customer.user_info');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::post('get_order_detail', 'OrderController@getOrderDetail')->name('order.get_order_detail');
            Route::post('get_order_product', 'OrderController@getCartProducts')->name('order.get_order_product');
            Route::get('query_user_order', 'OrderController@queryUserOrder')->name('order.query_user_order');
        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('get_product_all', 'ProductController@getProductAll')->name('product.get_product_all');
        Route::post('get_product_detail', 'ProductController@getProductDetail')->name('product.get_product_detail');
        Route::get('get_cart_product', 'ProductController@getCartProduct')->name('product.get_cart_product');
        Route::get('get_cart_productv2', 'ProductController@getCartProductV2')->name('product.get_cart_productv2');
    });

    Route::group(['prefix' => 'restaurant'], function () {
        Route::post('get_restaurant', 'RestaurantController@getRestaurant')->name('restaurant.get_restaurant');
        Route::get('get_suggested_restaurant', 'RestaurantController@getSuggestedRestaurant')->name('restaurant.get_suggested_restaurant');
        Route::post('restaurant_detail', 'RestaurantController@restaurantDetail')->name('restaurant.restaurant_detail');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('get_category', 'CategoryController@getCategories')->name('category.get_category');
    });
});
