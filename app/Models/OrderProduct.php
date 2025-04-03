<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';
    protected $fillable = [
        'product_sku',
        'amount',
    ];
    public $timestamps = true;

    public function sku_products()
    {
        return $this->belongsTo(ProductClasstification::class, 'product_sku', 'sku');
    }
}
