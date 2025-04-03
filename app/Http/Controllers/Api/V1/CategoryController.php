<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories(Request $request){
        $categories = Category::all();
        $data = [];

        foreach($categories as $category) {
            $data[] = [
               'id' => $category->id,
               'name' => $category->name,
            ];
        }

        return response()->json($data, 200);
    }
}
