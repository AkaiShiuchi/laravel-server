<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductClasstification extends Model
{
    use HasFactory;

    protected $table = 'product_classification';
    protected $fillable = [
        'sku',
        'product_id',
        'unit',
        'size',
        'cost',
    ];
    public $timestamps = true;

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
