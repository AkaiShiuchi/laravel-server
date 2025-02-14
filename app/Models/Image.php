<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';
    protected $fillable = [
        'url',
        'target_type',
        'target_id',
    ];
    public $timestamps = true;
}
