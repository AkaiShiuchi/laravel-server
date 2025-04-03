<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurant';
    protected $fillable = [
        'name',
        'bio',
        'rating',
        'delivery_cost',
        'delivery_vehicle',
        'delivery_time',
        'lat',
        'long',
        'image'
    ];
    public $timestamps = true;
}
