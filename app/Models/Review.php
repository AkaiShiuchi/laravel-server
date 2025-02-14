<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $fillable = [
        'title',
        'content',
        'rating',
        'user_id',
        'restaurant_id',
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }
}
