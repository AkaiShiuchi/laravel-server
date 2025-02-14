<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupon';
    protected $fillable = [
        'name',
        'discount',
        'created_day',
        'expired_day',
        'amount',
        'grant_by'
    ];
    public $timestamps = true;
}
