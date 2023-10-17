<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'mobile_prefix',
        'mobile',
        'email',
        'email_verified_at',
        'mobile_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function makeOtp(): array
    {

//        $otp = rand(10000, 99999);
        $otp = 11111;
        $secret = Str::random(30);
        $user_otp = new UserOtp;
        $user_otp->user_id = $this->id;
        $user_otp->secret = $secret;
        $user_otp->otp = $otp;
        $user_otp->ip_address = request()->ip();
        $user_otp->save();

        return [
            'secret' => $secret,
        ];
    }


}
