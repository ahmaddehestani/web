<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'secret',
        'otp',
        'ip_address',
        'try_count',
        'used_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
