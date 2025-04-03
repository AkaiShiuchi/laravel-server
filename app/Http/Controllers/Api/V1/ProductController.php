<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProductClasstification;
use App\Models\Restaurant;

class ProductController extends Controller
{
    /**
     * get all product
     *
     * @param Request $request
     * @return void
     */
    public function getProductAll(Request $request){
        $product = Product::all();
        $data = [];
        foreach ($product as $item){
            $skuProduct = ProductClasstification::where('product_id', $item->id)->first();
            $resta = $item->restaurants;
            $categ = $item->categories;
            $data[] = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'rating' => $item->rating,
                'delivery_cost' => $item->delivery_cost,
                'cooking_time' => $item->cooking_time,
                'ingredients' => $item->ingredients,
                'offer' => $item->offer,
                'serve_on' => $item->serve_on,
                'cost' => $skuProduct->cost,
                'image' => $item->image,
                'restaurant' => [
                    'name' => $resta->name,
                    'rating' => $resta->rating,
                    'delivery_cost' => $resta->delivery_cost,
                    'delivery_time' => $resta->delivery_time,
                    'latitude' => $resta->lat,
                    'longitude' => $resta->long,
                ],
                'category' => [
                    'name' => $categ->name,
                    'description' => $categ->description,
                ],
            ];
        }
        
        return response()->json($data, 200);
    }

    public function getCartProduct(Request $request) {
        $orderProducts = OrderProduct::get();
        $records = [];
        foreach ($orderProducts as $item) {
            $sku = ProductClasstification::findOrFail($item->product_sku);

            $records []= [
                'sku' => $sku->id,
                'unit' => $sku->unit,
                'size' => $sku->size,
                'cost' => $sku->cost,
                'amount' => $item->amount,
                'product_detail' => [
                    'id' => $sku->product_id,
                    'name'=> $sku->products->name,
                    'image' => $sku->products->image,
                ]
            ];
        }

        $data = [
            'total' => $orderProducts->count(),
            'items' => $records
        ];

        return response()->json($data, 200);
    }

    public function getCartProductV2(Request $request) {
        $restaurants = Restaurant::get();
        $data = [];
        $flag = true;

        foreach ($restaurants as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->name,
                'bio' => $item->bio,
                'rating' => $item->rating,
                'delivery_cost' => $item->delivery_cost,
                'delivery_vehicle' => $item->delivery_vehicle,
                'delivery_time' => $item->delivery_time,
                'images' => $item->image,
                'location' => [
                    'latitude' => $item->lat,
                    'longitude' => $item->long,
                ],
                'products' => [],
            ];
            $products = Product::where('restaurant_id', $item->id)->get();
            foreach ($products as $product) {
                $data[$item->id - 1]['products'][] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'rating' => $product->rating,
                    'cooking_time' => $product->cooking_time,
                    'offer' => $product->offer,
                    'serve_on' => $product->serve_on,
                    'category' => [
                        'id' => $product->categories->id,
                        'name' => $product->categories->name,
                    ],
                    'sku_products' => [],
                ];
                $skus = ProductClasstification::where('product_id', $product->id)->get();
                foreach ($skus as $sku) {
                    $orderProducts = OrderProduct::where('product_sku', $sku->sku)->get();
                    $data[$item->id - 1]['products']['sku_products'][] = [
                        'sku' => $sku->sku,
                        'unit' => $sku->unit,
                        'size' => $sku->size,
                        'cost' => $sku->cost,
                        'amount' => 0,
                    ];
                    foreach ($orderProducts as $order) {
                        foreach ($data[$item->id - 1]['products']['sku_products'] as &$skuProduct) {
                            if ($skuProduct['sku'] == $sku->sku) {
                                $skuProduct['amount'] += $order->amount;
                            }
                        }
                    }
                }
            }
        }

        return response()->json($data, 200);
    }

    public function getProductDetail(Request $request) {
        $product = Product::find($request->product_id);
        $sku_product = ProductClasstification::where('product_id', $product->id)
            ->where('size', $request->size)->first();

        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'rating' => $product->rating,
            'delivery_cost' => $product->delivery_cost,
            'cooking_time' => $product->cooking_time,
            'ingredients' => $product->ingredients,
            'offer' => $product->offer,
            'serve_on' => $product->serve_on,
            'sku' => [
                'unit' => $sku_product->unit,
                'size' => $sku_product->size,
                'cost' => $sku_product->cost,
                'image' => $product->image,
            ],
        ];

        return response()->json($data, 200);
    }
}
