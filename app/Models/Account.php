<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';
    protected $fillable = [
        'email',
        'password',
        'phone',
        'user_id',
        'verified_at'
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function checkAccountExist($email, $userId) {
        $account = self::where('email', $email)
            ->where('user_id', $user_id)
            ->first();
        return $account;
    }
}
