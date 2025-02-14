<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = [
        'delivery_method',
        'delivery_vehicle',
        'payment_method',
        'order_date',
        'status',
        'address_id',
        'user_id',
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addresses()
    {
        return $this->belongsTo(UserAddress::class, 'address_id', 'id');
    }
}
