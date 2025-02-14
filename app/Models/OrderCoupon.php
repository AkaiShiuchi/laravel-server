<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCoupon extends Model
{
    use HasFactory;

    protected $table = 'order_coupon';
    protected $fillable = [
        'order_id',
        'user_coupon_id',
    ];
    public $timestamps = true;

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function userCoupons()
    {
        return $this->belongsTo(UserCoupon::class, 'user_coupon_id', 'id');
    }
}
