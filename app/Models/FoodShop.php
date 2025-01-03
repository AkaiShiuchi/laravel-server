<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodShop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'food_shop';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'user_id',
        'shop_id',
        'food_id',
        'price',
        'payment_status',
        'deleted_at',
    ];

    public $timestamps = true;

    /**
     * get user of users table
     *
     * @return void
     */
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    /**
     * get shop of shops table
     *
     * @return void
     */
    public function shops() {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    /**
     * get food of foods table
     *
     * @return void
     */
    public function foods() {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
}
