<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Product;
use App\Models\ProductClasstification;

class RestaurantController extends Controller
{
    /**
     * get all restaurant and category
     *
     * @param Request $request
     * @return void
     */
    public function getRestaurant(Request $request) {
        $page = $request->pages;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $restaurants = Restaurant::offset($offset)->limit($perPage)->get();
        $totalPage = ceil(Restaurant::count() / $perPage);
        $totalPage = intval($totalPage);
        $record = [];
        $i = 0;
        foreach($restaurants as $restaurant) {
            $record[] = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'biography' => $restaurant->bio,
                'image' => $restaurant->image,
                'rating' => $restaurant->rating,
                'delivery_cost' => $restaurant->delivery_cost,
                'delivery_vehicle' => $restaurant->delivery_vehicle,
                'delivery_time' => $restaurant->delivery_time,
                'location' => [
                    'latitude' => $restaurant->lat,
                    'longitude' => $restaurant->long,
                ],
                'categories' => [],
            ];
            $categories = RestaurantCategory::where('restaurant_id', $restaurant->id)->get();
            $uniqueCategories = $categories->unique(function ($category) {
                return $category->categories->id;
            });
            foreach ($uniqueCategories as $category) {
                $record[$i]['categories'][] = [
                    'id' => $category->categories->id,
                    'name' =>$category->categories->name,
                ];
            }
            $i++;
        }
        $data = [
            'pages' => $totalPage,
            'records' => $restaurants->count(),
            'items' => $record,
        ];

        return response()->json($data, 200);
    }

    public function getSuggestedRestaurant(Request $request) {
        $restaurant = Restaurant::where('rating', '>=', 4.0)->get();
        $data = [];
        foreach($restaurant as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->biography,
                'images' => $item->image,
                'rating' => $item->rating,
                'delivery_cost' => $item->delivery_cost,
                'delivery_vehicle' => $item->delivery_vehicle,
                'delivery_time' => $item->delivery_time,
            ];
        }

        return response()->json($data, 200);
    }

    public function restaurantDetail(Request $request) {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        $products = Product::where('restaurant_id', $restaurant->id)->get();

        $data[] = [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'biography' => $restaurant->bio,
            'image' => $restaurant->image,
            'rating' => $restaurant->rating,
            'delivery_cost' => $restaurant->delivery_cost,
            'delivery_vehicle' => $restaurant->delivery_vehicle,
            'delivery_time' => $restaurant->delivery_time,
            'location' => [
                'latitude' => $restaurant->lat,
                'longitude' => $restaurant->long,
            ],
            'categories' => [],
            'products' => [],
        ];

        $categories = RestaurantCategory::where('restaurant_id', $restaurant->id)->get();
        $uniCategories = $categories->unique(function ($cate) {
            return $cate->categories->id;
        });
        foreach ($uniCategories as $item) {
            $data[0]['categories'][] = [
                'id' => $item->categories->id,
                'name' => $item->categories->name,
            ];
        }
        foreach ($products as $product) {
            $skuProduct = ProductClasstification::where('product_id', $product->id)->first();
            $data[0]['products'][] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'rating' => $product->rating,
                'delivery_cost' => $product->delivery_cost,
                'cooking_time' => $product->cooking_time,
                'ingredients' => $product->ingredients,
                'offer' => $product->offer,
                'serve_on' => $product->serve_on,
                'cost' => $skuProduct->cost,
                'image' => $product->image,
                'category' => [
                    'id' => $product->categories->id,
                    'name' => $product->categories->name,
                    'description' => $product->categories->description,
                ],
            ];
        }

        return response()->json($data, 200);
    }
}
