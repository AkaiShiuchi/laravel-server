<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shops';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'food_id',
        'shop_name',
        'delivery',
        'time_ship',
        'evaluate',
        'deleted_at',
    ];

    public $timestamps = true;

    /**
     * get food of foods table
     *
     * @return void
     */
    public function foods() {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }

    public static function getAllShop() {
        return self::get();
    }
}
