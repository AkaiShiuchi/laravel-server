<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = [
        'amount',
        'content',
        'order_id',
    ];
    public $timestamps = true;

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
