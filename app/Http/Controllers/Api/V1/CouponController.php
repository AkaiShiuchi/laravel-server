<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function getListCoupon(Request $request) {
        $coupons = Coupon::getAllCoupon();
        
        return response()->json($coupons, 200);
    }
}
