<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;

    protected $table = 'user_coupon';
    protected $fillable = [
        'coupon_id',
        'user_id',
        'amount',
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function coupons()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
