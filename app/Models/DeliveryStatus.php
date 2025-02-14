<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    use HasFactory;

    protected $table = 'delivery_status';
    protected $fillable = [
        'status',
        'message',
        'order_id',
    ];
    public $timestamps = true;

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
