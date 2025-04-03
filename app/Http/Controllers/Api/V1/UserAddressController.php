<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\User;

class UserAddressController extends Controller
{
    public function getUserAddresses(Request $request) {
        $user = auth()->user();
        $user = User::findOrFail($user->id);
        $userAddress = UserAddress::where('user_id', $user->id)->get();
        if ($userAddress->count() == 0) {
            return response()->json(['message' => 'User address not found'], 404);
        }
        $data = [];
        foreach($userAddress as $address) {
            $data[] = [
                "id" => $address->id,
                "user_id" => $user->id,
                "name"  => $address->name,
                "phone" => $address->phone,
                "label_as" => $address->lable_as,
                "address" => [
                    "city" => $address->city,
                    "district" => $address->district,
                    "detail" => $address->address_detail,
                ],
                "coordinators" => [
                    "latitude" => $address->lat,
                    "longitude" => $address->long
                ]
            ];
        }

        return response()->json($data, 200);
    }

    public function getUserInfo(Request $request) {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $data = [
            'f_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar' => $user->img_url,
        ];

        return response()->json($data, 200);
    }
}
