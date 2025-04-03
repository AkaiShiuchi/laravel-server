<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Shipper;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductClasstification;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * get order by user
     *
     * @param Request $request
     * @return void
     */
    public function getOrderDetail(Request $request) {
        $order = Order::findOrFail($request->order_id);
        
        $data = [];
        $address = UserAddress::findOrFail($order->user_address_id);
        $shipper = Shipper::findOrFail($order->shipper_id);
        $list_product = $order->list_products;
        $productIds = explode(',', $list_product); 
        $prod = [];
        foreach ($productIds as $product_id) {
            $skuProduct = ProductClasstification::where('product_id', $product_id)->inRandomOrder()->first();
            $restaurant = Restaurant::findOrFail($skuProduct->products->restaurant_id);
            $prod[] = [
                "order_id" => $order->id,
                "skuId" => $skuProduct->id,
                "product_name" => $skuProduct->products->name,
                "amount" => 1,
                "size" => $skuProduct->size,
                "cost" => $skuProduct->cost,
            ];
        }
        $data[] =[
            "id" => $order->id,
            "delivery_vehicle" => $order->delivery_vehicle,
            "payment_method" => $order->payment_method,
            "order_date" => $order->order_date,
            "amount" => $order->amount,
            "status" => $order->status,
            "id" => $address->id,
            "user_id" => $order->user_id,
            "name"  => $address->name,
            "phone" => $address->phone,
            "lable_as" => $address->lable_as,
            "restaurant" => [
                "id" => $restaurant->id,
                "name" => $restaurant->name,
                "bio" => $restaurant->bio,
                "rating" => $restaurant->rating,
                "delivery_cost" => $restaurant->delivery_cost,
                "delivery_vehicle" => $restaurant->delivery_vehicle,
                "delivery_time" => $restaurant->delivery_time,
                "location" => [
                    "latitude" => $restaurant->lat,
                    "longitude" => $restaurant->long,
                ],
            ],
            "address" => [
                "id" => $address->id,
                "name"  => $address->name,
                "phone" => $address->phone,
                "country" => $address->country,
                "lable_as" => $address->lable_as,
                "city" => $address->city,
                "district" => $address->district,
                "address_details" => $address->address_detail,
                "lat" => $address->lat,
                "long" => $address->long
            ],
            "user_id" => $order->user_id,
            "shipper" => $shipper->id,
            "products" => $prod,
        ];

        return response()->json($data, 200);
    }

    public function queryUserOrder(Request $request) {
        $orders = Order::get();
        $data = [];
        foreach($orders as $order) {
            $data[] = [
                'id' => $order->id,
                'delivery_vehicle' => $order->delivery_vehicle,
                'payment_method' => $order->payment_method,
                'ordered_date' => $order->ordered_date,
                'status' => $order->status,
                'amount' => $order->amount,
                'user_id' => $order->user_id,
                'shipper_id' => $order->shipper_id,
                'address' => [
                    'id' => $order->addresses->id,
                    'name' => $order->addresses->name,
                    'label_as' => $order->addresses->label_as,
                    'country' => $order->addresses->country,
                    'city' => $order->addresses->city,
                    'district' => $order->addresses->district,
                    'address_details' => $order->addresses->address_details,
                    'location' => [
                        'latitude' => $order->addresses->lat,
                        'longitude' => $order->addresses->long,
                    ],
                    'phone' => $order->addresses->phone,
                ],
                'restaurant' => [],
            ];
            $data[$order->id]['restaurant'] = [];
            $restaurant_ids = [];
            $list_product = explode(',', $order->list_products);
            for ($i = 0; $i < count($list_product); $i++) {
                $product = Product::findOrFail($list_product[$i]);
                $restaurant_ids[] = $product->restaurant_id;
            }
            $restaurant_id = array_unique($restaurant_ids)[0];
            $restaurant = Restaurant::findOrFail($restaurant_id);
            $data[$order->id]['restaurant'][] = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'bio' => $restaurant->bio,
                'rating' => $restaurant->rating,
                'images' => $restaurant->image,
                'delivery_cost' => $restaurant->delivery_cost,
                'delivery_vehicle' => $restaurant->delivery_vehicle,
                'delivery_time' => $restaurant->delivery_time,
                'location' => [
                    'latitude' => $restaurant->lat,
                    'longitude' => $restaurant->long,
                ],
            ];
        }

        return response()->json($data, 200);
    }
}
