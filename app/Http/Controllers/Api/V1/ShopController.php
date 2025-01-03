<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Food;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function getShopList(Request $request) {
        
        $shop = Shop::getAllShop();

        foreach ($shop as $s) {
            $foodIds = json_decode($s->food_id);
            $foodNames = [];

            foreach ($foodIds as $food) {
                $foo = Food::findOrFail($food->food_id);
                $foodNames[] = $foo->name;
            }
            unset($s->created_at, $s->updated_at, $s->deleted_at, $s->food_id);
            $s['food_names'] = $foodNames;
        }

        $data = [
            'shop' => $shop

        ];

        return response()->json($data, 200);
    }
}
