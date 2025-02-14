<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $table = 'restaurant_category';
    protected $fillable = [
        'restaurant_id',
        'category_id'
    ];
    public $timestamps = true;

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
